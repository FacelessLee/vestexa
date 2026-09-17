import type { Plugin } from 'vite';
import fs from 'fs';
import path from 'path';
import type { IncomingMessage, ServerResponse } from 'http';

const DATA_DIR = path.resolve(process.cwd(), 'server', 'data');
const DB_FILE = path.join(DATA_DIR, 'db.json');

// Store active Server-Sent Events client connections
const sseClients = new Set<ServerResponse>();

export interface StorageData {
  users: any[];
  admins: any[];
  transactions: any[];
  investmentPlans: any[];
  userInvestments: any[];
  withdrawals: any[];
  notifications: any[];
  loans: any[];
  beneficiaries: any[];
  appSettings: any;
  version: number;
  updatedAt: string;
}

import { getInitialDatabase } from './defaultData.js';


export function readDatabase(): StorageData {
  try {
    if (!fs.existsSync(DATA_DIR)) {
      fs.mkdirSync(DATA_DIR, { recursive: true });
    }
    if (!fs.existsSync(DB_FILE)) {
      const initial = getInitialDatabase();
      fs.writeFileSync(DB_FILE, JSON.stringify(initial, null, 2), 'utf-8');
      return initial;
    }
    const raw = fs.readFileSync(DB_FILE, 'utf-8');
    return JSON.parse(raw) as StorageData;
  } catch (err) {
    console.error('[storage-api] Error reading database, returning initial fallback:', err);
    return getInitialDatabase();
  }
}

export function writeDatabase(data: StorageData): void {
  try {
    if (!fs.existsSync(DATA_DIR)) {
      fs.mkdirSync(DATA_DIR, { recursive: true });
    }
    data.updatedAt = new Date().toISOString();
    data.version = (data.version || 0) + 1;
    fs.writeFileSync(DB_FILE, JSON.stringify(data, null, 2), 'utf-8');
  } catch (err) {
    console.error('[storage-api] Error writing database to disk:', err);
  }
}

// Broadcast an event to all connected SSE clients across any browser
export function broadcastSSE(event: { type: string; [key: string]: any }): void {
  const payload = `data: ${JSON.stringify(event)}\n\n`;
  for (const client of sseClients) {
    try {
      client.write(payload);
    } catch {
      sseClients.delete(client);
    }
  }
}

function parseJsonBody(req: IncomingMessage): Promise<any> {
  return new Promise((resolve) => {
    let body = '';
    req.on('data', chunk => {
      body += chunk;
    });
    req.on('end', () => {
      try {
        resolve(body ? JSON.parse(body) : {});
      } catch {
        resolve({});
      }
    });
    req.on('error', () => resolve({}));
  });
}

function sendJson(res: ServerResponse, statusCode: number, data: any): void {
  res.statusCode = statusCode;
  res.setHeader('Content-Type', 'application/json');
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Headers', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
  res.end(JSON.stringify(data));
}

export function storageHandler(req: IncomingMessage, res: ServerResponse, next: () => void): void {
  const url = req.url ? req.url.split('?')[0] : '';

  // Handle CORS preflight
  if (req.method === 'OPTIONS') {
    res.statusCode = 204;
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Headers', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    res.end();
    return;
  }

  // 1. SSE Stream: /api/storage/events
  if (url === '/api/storage/events' && req.method === 'GET') {
    res.writeHead(200, {
      'Content-Type': 'text/event-stream',
      'Cache-Control': 'no-cache, no-transform',
      'Connection': 'keep-alive',
      'Access-Control-Allow-Origin': '*',
    });
    res.write(`data: ${JSON.stringify({ type: 'connected', timestamp: Date.now() })}\n\n`);

    sseClients.add(res);

    // Heartbeat every 15s to keep proxy connections alive
    const interval = setInterval(() => {
      try {
        res.write(': heartbeat\n\n');
      } catch {
        clearInterval(interval);
        sseClients.delete(res);
      }
    }, 15000);

    req.on('close', () => {
      clearInterval(interval);
      sseClients.delete(res);
    });
    return;
  }

  // 2. Fetch full storage: GET /api/storage
  if (url === '/api/storage' && req.method === 'GET') {
    const db = readDatabase();
    sendJson(res, 200, db);
    return;
  }

  // 3. Full / Partial sync: POST /api/storage/sync
  if (url === '/api/storage/sync' && req.method === 'POST') {
    parseJsonBody(req).then(body => {
      const db = readDatabase();
      let modified = false;

      if (body.users && Array.isArray(body.users)) {
        db.users = body.users;
        modified = true;
      }
      if (body.transactions && Array.isArray(body.transactions)) {
        db.transactions = body.transactions;
        modified = true;
      }
      if (body.admins && Array.isArray(body.admins)) {
        db.admins = body.admins;
        modified = true;
      }
      if (body.investmentPlans && Array.isArray(body.investmentPlans)) {
        db.investmentPlans = body.investmentPlans;
        modified = true;
      }
      if (body.userInvestments && Array.isArray(body.userInvestments)) {
        db.userInvestments = body.userInvestments;
        modified = true;
      }
      if (body.withdrawals && Array.isArray(body.withdrawals)) {
        db.withdrawals = body.withdrawals;
        modified = true;
      }
      if (body.notifications && Array.isArray(body.notifications)) {
        db.notifications = body.notifications;
        modified = true;
      }
      if (body.loans && Array.isArray(body.loans)) {
        db.loans = body.loans;
        modified = true;
      }
      if (body.beneficiaries && Array.isArray(body.beneficiaries)) {
        db.beneficiaries = body.beneficiaries;
        modified = true;
      }
      if (body.appSettings && typeof body.appSettings === 'object') {
        db.appSettings = body.appSettings;
        modified = true;
      }

      if (modified) {
        writeDatabase(db);
        broadcastSSE({ type: 'storage_synced', version: db.version, timestamp: Date.now() });
      }

      sendJson(res, 200, { success: true, version: db.version });
    });
    return;
  }

  // 4. Update user balance: POST /api/users/update-balance
  if (url === '/api/users/update-balance' && req.method === 'POST') {
    parseJsonBody(req).then(body => {
      const { userId, balance } = body;
      if (!userId || typeof balance !== 'number') {
        sendJson(res, 400, { success: false, error: 'Missing userId or valid balance' });
        return;
      }

      const db = readDatabase();
      const idx = db.users.findIndex(u => u.id === userId || (userId === 'user-bill' && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden')));
      if (idx === -1) {
        sendJson(res, 404, { success: false, error: 'User not found' });
        return;
      }

      db.users[idx].balance = Math.max(0, balance);
      writeDatabase(db);

      broadcastSSE({
        type: 'balance_updated',
        userId: db.users[idx].id,
        balance: db.users[idx].balance,
        timestamp: Date.now(),
      });

      sendJson(res, 200, { success: true, user: db.users[idx] });
    });
    return;
  }

  // 5. Restrict user(s): POST /api/users/restrict
  if (url === '/api/users/restrict' && req.method === 'POST') {
    parseJsonBody(req).then(body => {
      const { userIds, header, reason, restrictedBy } = body;
      if (!Array.isArray(userIds) || userIds.length === 0) {
        sendJson(res, 400, { success: false, error: 'Missing userIds array' });
        return;
      }

      const db = readDatabase();
      const idSet = new Set(userIds);
      const now = new Date().toISOString();
      let count = 0;

      db.users = db.users.map(u => {
        const isTarget = idSet.has(u.id) || (idSet.has('user-bill') && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden'));
        if (isTarget) {
          count++;
          const refNumber = `VX-RST-${Math.floor(10000 + Math.random() * 90000)}`;
          return {
            ...u,
            isRestricted: true,
            restrictionHeader: (header || 'Access Restricted by Compliance').trim(),
            restrictionReason: (reason || 'Account pending administrative compliance review.').trim(),
            restrictedAt: now,
            restrictedBy: restrictedBy || 'Compliance Admin',
            restrictionRef: u.restrictionRef || refNumber,
          };
        }
        return u;
      });

      writeDatabase(db);

      broadcastSSE({
        type: 'restriction_updated',
        userIds,
        isRestricted: true,
        header,
        reason,
        restrictedBy,
        restrictedAt: now,
        timestamp: Date.now(),
      });

      sendJson(res, 200, { success: true, count });
    });
    return;
  }

  // 6. Lift user restriction(s): POST /api/users/lift-restriction
  if (url === '/api/users/lift-restriction' && req.method === 'POST') {
    parseJsonBody(req).then(body => {
      const { userIds } = body;
      const targetIds = Array.isArray(userIds) ? userIds : (body.userId ? [body.userId] : []);
      if (targetIds.length === 0) {
        sendJson(res, 400, { success: false, error: 'Missing userIds or userId' });
        return;
      }

      const db = readDatabase();
      const idSet = new Set(targetIds);
      let count = 0;

      db.users = db.users.map(u => {
        const isTarget = idSet.has(u.id) || (idSet.has('user-bill') && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden'));
        if (isTarget) {
          count++;
          return {
            ...u,
            isRestricted: false,
            restrictionHeader: undefined,
            restrictionReason: undefined,
            restrictedAt: undefined,
            restrictedBy: undefined,
            restrictionRef: undefined,
          };
        }
        return u;
      });

      writeDatabase(db);

      broadcastSSE({
        type: 'restriction_updated',
        userIds: targetIds,
        isRestricted: false,
        timestamp: Date.now(),
      });

      sendJson(res, 200, { success: true, count });
    });
    return;
  }

  // 7. Update user profile / credentials: POST /api/users/update-profile
  if (url === '/api/users/update-profile' && req.method === 'POST') {
    parseJsonBody(req).then(body => {
      const { userId, profileData } = body;
      if (!userId || !profileData || typeof profileData !== 'object') {
        sendJson(res, 400, { success: false, error: 'Missing userId or profileData' });
        return;
      }

      const db = readDatabase();
      const idx = db.users.findIndex(u => u.id === userId || (userId === 'user-bill' && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden')));
      if (idx === -1) {
        sendJson(res, 404, { success: false, error: 'User not found' });
        return;
      }

      db.users[idx] = {
        ...db.users[idx],
        ...profileData,
      };
      if (db.users[idx].id === 'user-bill') {
        db.users[idx].email = 'billodgedn@rockmail.com';
      }

      writeDatabase(db);

      broadcastSSE({
        type: 'user_updated',
        userId: db.users[idx].id,
        timestamp: Date.now(),
      });

      sendJson(res, 200, { success: true, user: db.users[idx] });
    });
    return;
  }

  // Pass non-matching requests to next middleware
  next();
}

export function storagePlugin(): Plugin {
  return {
    name: 'vestexa-storage-api',
    configureServer(server) {
      server.middlewares.use(storageHandler);
    },
    configurePreviewServer(server) {
      server.middlewares.use(storageHandler);
    },
  };
}
