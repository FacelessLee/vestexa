import http from 'http';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';
import { getInitialDatabase } from './defaultData.js';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const PORT = process.env.PORT || 3000;
const DIST_DIR = path.resolve(__dirname, '..', 'dist');
const DATA_DIR = path.resolve(__dirname, 'data');
const DB_FILE = path.join(DATA_DIR, 'db.json');

const sseClients = new Set();

function readDatabase() {
  try {
    if (!fs.existsSync(DATA_DIR)) {
      fs.mkdirSync(DATA_DIR, { recursive: true });
    }
    if (fs.existsSync(DB_FILE)) {
      return JSON.parse(fs.readFileSync(DB_FILE, 'utf-8'));
    }
    const initial = getInitialDatabase();
    fs.writeFileSync(DB_FILE, JSON.stringify(initial, null, 2), 'utf-8');
    return initial;
  } catch (e) {
    console.error('Error reading db:', e);
  }
  return getInitialDatabase();
}

function writeDatabase(data) {
  try {
    if (!fs.existsSync(DATA_DIR)) {
      fs.mkdirSync(DATA_DIR, { recursive: true });
    }
    data.updatedAt = new Date().toISOString();
    data.version = (data.version || 0) + 1;
    fs.writeFileSync(DB_FILE, JSON.stringify(data, null, 2), 'utf-8');
  } catch (e) {
    console.error('Error writing db:', e);
  }
}

function broadcastSSE(event) {
  const payload = `data: ${JSON.stringify(event)}\n\n`;
  for (const client of sseClients) {
    try {
      client.write(payload);
    } catch {
      sseClients.delete(client);
    }
  }
}

function parseJsonBody(req) {
  return new Promise((resolve) => {
    let body = '';
    req.on('data', chunk => { body += chunk; });
    req.on('end', () => {
      try { resolve(body ? JSON.parse(body) : {}); }
      catch { resolve({}); }
    });
    req.on('error', () => resolve({}));
  });
}

function sendJson(res, statusCode, data) {
  res.statusCode = statusCode;
  res.setHeader('Content-Type', 'application/json');
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Headers', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
  res.end(JSON.stringify(data));
}

const MIME_TYPES = {
  '.html': 'text/html',
  '.js': 'text/javascript',
  '.css': 'text/css',
  '.json': 'application/json',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.svg': 'image/svg+xml',
  '.ico': 'image/x-icon',
  '.webp': 'image/webp',
  '.mp4': 'video/mp4',
};

const server = http.createServer(async (req, res) => {
  const url = req.url ? req.url.split('?')[0] : '';

  if (req.method === 'OPTIONS') {
    res.statusCode = 204;
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Headers', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    res.end();
    return;
  }

  // 1. SSE Stream
  if (url === '/api/storage/events' && req.method === 'GET') {
    res.writeHead(200, {
      'Content-Type': 'text/event-stream',
      'Cache-Control': 'no-cache, no-transform',
      'Connection': 'keep-alive',
      'Access-Control-Allow-Origin': '*',
    });
    res.write(`data: ${JSON.stringify({ type: 'connected', timestamp: Date.now() })}\n\n`);
    sseClients.add(res);

    const interval = setInterval(() => {
      try { res.write(': heartbeat\n\n'); }
      catch { clearInterval(interval); sseClients.delete(res); }
    }, 15000);

    req.on('close', () => {
      clearInterval(interval);
      sseClients.delete(res);
    });
    return;
  }

  // 2. Fetch Storage
  if (url === '/api/storage' && req.method === 'GET') {
    sendJson(res, 200, readDatabase());
    return;
  }

  // 3. Storage Sync
  if (url === '/api/storage/sync' && req.method === 'POST') {
    const body = await parseJsonBody(req);
    const db = readDatabase();
    let modified = false;

    for (const key of ['users', 'transactions', 'admins', 'investmentPlans', 'userInvestments', 'withdrawals', 'notifications', 'loans', 'beneficiaries', 'appSettings']) {
      if (body[key]) {
        db[key] = body[key];
        modified = true;
      }
    }

    if (modified) {
      writeDatabase(db);
      broadcastSSE({ type: 'storage_synced', version: db.version, timestamp: Date.now() });
    }
    sendJson(res, 200, { success: true, version: db.version });
    return;
  }

  // 4. Update Balance
  if (url === '/api/users/update-balance' && req.method === 'POST') {
    const { userId, balance } = await parseJsonBody(req);
    if (!userId || typeof balance !== 'number') {
      sendJson(res, 400, { success: false, error: 'Invalid parameters' });
      return;
    }
    const db = readDatabase();
    const idx = db.users.findIndex(u => u.id === userId || (userId === 'user-bill' && (u.email === 'billogden@rocketmail.com' || u.username === 'billogden')));
    if (idx === -1) {
      sendJson(res, 404, { success: false, error: 'User not found' });
      return;
    }
    db.users[idx].balance = Math.max(0, balance);
    writeDatabase(db);
    broadcastSSE({ type: 'balance_updated', userId: db.users[idx].id, balance: db.users[idx].balance, timestamp: Date.now() });
    sendJson(res, 200, { success: true, user: db.users[idx] });
    return;
  }

  // 5. Restrict User
  if (url === '/api/users/restrict' && req.method === 'POST') {
    const { userIds, header, reason, restrictedBy } = await parseJsonBody(req);
    if (!Array.isArray(userIds) || userIds.length === 0) {
      sendJson(res, 400, { success: false, error: 'Missing userIds' });
      return;
    }
    const db = readDatabase();
    const idSet = new Set(userIds);
    const now = new Date().toISOString();
    let count = 0;
    db.users = db.users.map(u => {
      const isTarget = idSet.has(u.id);
      if (isTarget) {
        count++;
        const refNumber = `VX-RST-${Math.floor(10000 + Math.random() * 90000)}`;
        return {
          ...u,
          isRestricted: true,
          restrictionHeader: (header || 'Access Restricted by Compliance').trim(),
          restrictionReason: (reason || 'Account pending administrative review.').trim(),
          restrictedAt: now,
          restrictedBy: restrictedBy || 'Compliance Admin',
          restrictionRef: u.restrictionRef || refNumber,
        };
      }
      return u;
    });
    writeDatabase(db);
    broadcastSSE({ type: 'restriction_updated', userIds, isRestricted: true, timestamp: Date.now() });
    sendJson(res, 200, { success: true, count });
    return;
  }

  // 6. Lift Restriction
  if (url === '/api/users/lift-restriction' && req.method === 'POST') {
    const body = await parseJsonBody(req);
    const targetIds = Array.isArray(body.userIds) ? body.userIds : (body.userId ? [body.userId] : []);
    if (targetIds.length === 0) {
      sendJson(res, 400, { success: false, error: 'Missing user id(s)' });
      return;
    }
    const db = readDatabase();
    const idSet = new Set(targetIds);
    let count = 0;
    db.users = db.users.map(u => {
      const isTarget = idSet.has(u.id);
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
    broadcastSSE({ type: 'restriction_updated', userIds: targetIds, isRestricted: false, timestamp: Date.now() });
    sendJson(res, 200, { success: true, count });
    return;
  }

  // 7. Update Profile
  if (url === '/api/users/update-profile' && req.method === 'POST') {
    const { userId, profileData } = await parseJsonBody(req);
    const db = readDatabase();
    const idx = db.users.findIndex(u => u.id === userId || (userId === 'user-bill' && (u.email === 'billogden@rocketmail.com' || u.username === 'billogden')));
    if (idx === -1) {
      sendJson(res, 404, { success: false, error: 'User not found' });
      return;
    }
    db.users[idx] = { ...db.users[idx], ...profileData };
    writeDatabase(db);
    broadcastSSE({ type: 'user_updated', userId: db.users[idx].id, timestamp: Date.now() });
    sendJson(res, 200, { success: true, user: db.users[idx] });
    return;
  }

  // Static file serving for production dist
  let filePath = path.join(DIST_DIR, url === '/' ? 'index.html' : url);
  if (!fs.existsSync(filePath) || fs.statSync(filePath).isDirectory()) {
    filePath = path.join(DIST_DIR, 'index.html');
  }

  if (fs.existsSync(filePath)) {
    const ext = path.extname(filePath);
    const mime = MIME_TYPES[ext] || 'application/octet-stream';
    res.writeHead(200, { 'Content-Type': mime });
    fs.createReadStream(filePath).pipe(res);
  } else {
    res.statusCode = 404;
    res.end('Not Found');
  }
});

server.listen(PORT, () => {
  console.log(`[vestexa-server] Production server listening on http://localhost:${PORT}`);
});
