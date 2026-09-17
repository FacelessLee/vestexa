// localStorage CRUD helpers for Vestexa demo platform with server-backed real-time sync
import {
  pushBalanceUpdate,
  pushRestriction,
  pushLiftRestriction,
  pushUserProfile,
  pushFullSync,
  fetchServerStorage,
  applyServerStorageToLocal,
} from './syncEngine';

export interface QuickTransferContact {

  id: string;
  name: string;
  initials: string;
  avatarBg?: string;
}

export interface User {
  id: string;
  email: string;
  password: string;
  fullName: string;
  balance: number;
  investedAmount?: number;
  amountSpent?: number;
  cardNumber?: string;
  cardHolderName?: string;
  cardLast4: string;
  cardExp: string;
  avatarUrl?: string;
  phoneNumber?: string;
  address?: string;
  ssn?: string;
  idType?: 'drivers_license' | 'passport';
  idDocumentUrl?: string;
  idDocumentBackUrl?: string;
  quickTransferContacts?: QuickTransferContact[];
  createdAt: string;
  // ─── Extended fields (faceless-fintech feature parity) ───
  username?: string;
  lastName?: string;
  middleName?: string;
  country?: string;
  currency?: string;
  secondaryCurrency?: string;
  accountType?: string;
  pin?: string;
  pinstatus?: number; // 0 = verified, 1 = PIN pending (faceless-fintech workflow)
  accountNumber?: string;
  status?: 'active' | 'blocked' | 'dormant' | 'suspended';
  kycStatus?: 'unverified' | 'pending' | 'verified' | 'rejected';
  twoFactorEnabled?: boolean;
  twoFactorCode?: string;
  twoFactorExpiresAt?: string;
  referredBy?: string;
  referralLink?: string;
  roi?: number;
  bonus?: number;
  refBonus?: number;
  signupBonusReceived?: boolean;
  isBanned?: boolean;
  banMessage?: string;
  bannedAt?: string;
  banExpiresAt?: string;
  // ─── Access Restriction CMS fields ───
  isRestricted?: boolean;
  restrictionHeader?: string;
  restrictionReason?: string;
  restrictedAt?: string;
  restrictedBy?: string;
  restrictionRef?: string;
  btcAddress?: string;
  ethAddress?: string;
  usdtAddress?: string;
  minTransferAmount?: number;
  maxTransferAmount?: number;
  transferCodes?: string[];
  notificationPreferences?: {
    emailOtp?: boolean;
    roiNotifications?: boolean;
    planNotifications?: boolean;
  };
}

export interface Admin {
  id: string;
  email: string;
  password: string;
  fullName: string;
  role: 'super_admin' | 'admin';
  isSuperAdmin?: boolean;
  createdAt: string;
}

export interface Transaction {
  id: string;
  userId: string;
  type: 'credit' | 'debit';
  amount: number;
  narration: string;
  senderInfo: string;
  date: string;
  time: string;
  category: string;
  status: 'completed' | 'pending' | 'processing';
  createdAt: string;
}

// ─── New Entity Interfaces ───

export interface InvestmentPlan {
  id: string;
  name: string;
  minAmount: number;
  maxAmount: number;
  roiPercentage: number;
  roiInterval: 'hourly' | 'daily' | 'weekly' | 'monthly';
  durationDays: number;
  type: 'main' | 'promo';
  isActive: boolean;
  returnCapital: boolean;
  createdAt: string;
}

export interface UserInvestment {
  id: string;
  userId: string;
  planId: string;
  planName?: string;
  amount: number;
  roiPercentage: number;
  roiInterval: string;
  status: 'pending' | 'active' | 'expired' | 'cancelled';
  activatedAt?: string;
  expiresAt?: string;
  lastRoiAt?: string;
  totalEarned: number;
  createdAt: string;
}

export interface WithdrawalRequest {
  id: string;
  userId: string;
  amount: number;
  method: string;
  status: 'pending' | 'approved' | 'rejected' | 'processed';
  details?: string;
  txnId: string;
  createdAt: string;
}

export interface AppNotification {
  id: string;
  userId: string;
  title: string;
  message: string;
  type: 'success' | 'info' | 'warning' | 'danger';
  icon?: string;
  isRead: boolean;
  link?: string;
  createdAt: string;
}

export interface LoanApplication {
  id: string;
  userId: string;
  amount: number;
  purpose: string;
  duration: string;
  status: 'pending' | 'approved' | 'rejected' | 'active' | 'completed';
  interestRate?: number;
  approvedAt?: string;
  createdAt: string;
}

export interface Beneficiary {
  id: string;
  userId: string;
  name: string;
  bankName: string;
  accountNumber: string;
  routingNumber?: string;
  swiftCode?: string;
  isFavorite: boolean;
  createdAt: string;
}

export interface AppSettings {
  id: string;
  siteName: string;
  currency: string;
  signupBonus: number;
  referralCommission: number;
  referralCommissionLevels: number[];
  tradeMode: boolean;
  weekendTrading: boolean;
  enableKyc: boolean;
  enableTwoFactor: boolean;
  enableEmailVerification: boolean;
  returnCapital: boolean;
  withdrawalOption: 'auto' | 'manual';
  commissionFee: number;
  modules: {
    investments: boolean;
    loans: boolean;
    transfers: boolean;
    cards: boolean;
    swap: boolean;
    referrals: boolean;
    notifications: boolean;
    beneficiaries: boolean;
  };
}

const KEYS = {
  USERS: 'vestexa_users',
  ADMINS: 'vestexa_admins',
  TRANSACTIONS: 'vestexa_transactions',
  CURRENT_USER: 'vestexa_current_user',
  CURRENT_ADMIN: 'vestexa_current_admin',
  SEEDED: 'vestexa_seeded_v3',
  INVESTMENT_PLANS: 'vestexa_investment_plans',
  USER_INVESTMENTS: 'vestexa_user_investments',
  WITHDRAWALS: 'vestexa_withdrawals',
  NOTIFICATIONS: 'vestexa_notifications',
  LOANS: 'vestexa_loans',
  BENEFICIARIES: 'vestexa_beneficiaries',
  APP_SETTINGS: 'vestexa_app_settings',
} as const;

// ─── Generic Helpers ───

function getItem<T>(key: string): T[] {
  try {
    const raw = localStorage.getItem(key);
    return raw ? JSON.parse(raw) : [];
  } catch {
    return [];
  }
}

function setItem<T>(key: string, data: T[]): void {
  try {
    localStorage.setItem(key, JSON.stringify(data));
  } catch (e) {
    console.error(`Failed to write to localStorage for key "${key}":`, e);
  }
}

function generateId(): string {
  return `${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
}

export function broadcastUserUpdate(userId?: string): void {
  try {
    window.dispatchEvent(new CustomEvent('vestexa_user_updated', { detail: { userId } }));
  } catch {
    // ignore
  }
  try {
    if (typeof BroadcastChannel !== 'undefined') {
      const bc = new BroadcastChannel('vestexa_channel');
      bc.postMessage({ type: 'user_updated', userId, timestamp: Date.now() });
      bc.close();
    }
  } catch {
    // ignore
  }
}

// ─── Users ───

export function getUsers(): User[] {
  const users = getItem<User>(KEYS.USERS);
  let changed = false;

  // 1. Collect all records that correspond to Bill Ogden
  const billRecords = users.filter(u =>
    u.id === 'user-bill' ||
    (u.email && ['billodgedn@rockmail.com', 'billogden@rockmail.com', 'bill.og@vestexa.org'].includes(u.email.toLowerCase())) ||
    (u.username && u.username.toLowerCase() === 'billogden')
  );

  let canonicalBill: User | null = null;
  if (billRecords.length > 0) {
    // Base canonical record is 'user-bill' if present, otherwise the first record
    canonicalBill = billRecords.find(u => u.id === 'user-bill') || billRecords[0];

    // Find if any record has custom password (not legacy 'demo1234')
    const customPasswordRecord = billRecords.find(u => u.password && u.password.trim() !== 'demo1234');
    let customPassword = customPasswordRecord?.password ? customPasswordRecord.password.trim() : (canonicalBill.password || 'Ogden_29');
    if (customPassword === 'demo1234') customPassword = 'Ogden_29';

    // Find if any record has custom pin (not legacy '4321')
    const customPinRecord = billRecords.find(u => u.pin && u.pin.trim() !== '4321');
    let customPin = customPinRecord?.pin ? customPinRecord.pin.trim() : (canonicalBill.pin || '1392');
    if (customPin === '4321') customPin = '1392';

    // Merge into canonical Bill preserving exact balance and restriction state
    canonicalBill = {
      ...canonicalBill,
      id: 'user-bill',
      email: 'billodgedn@rockmail.com', // Strictly enforced single email
      username: 'billogden',
      fullName: 'Bill Ogden',
      password: customPassword,
      pin: customPin,
      balance: typeof canonicalBill.balance === 'number' ? canonicalBill.balance : 739565.21,
      isRestricted: Boolean(canonicalBill.isRestricted),
      restrictionHeader: canonicalBill.restrictionHeader,
      restrictionReason: canonicalBill.restrictionReason,
      restrictedAt: canonicalBill.restrictedAt,
      restrictedBy: canonicalBill.restrictedBy,
      restrictionRef: canonicalBill.restrictionRef,
    };


    if (billRecords.length > 1 || canonicalBill.email !== 'billodgedn@rockmail.com') {
      changed = true;
    }
  }

  // 2. Filter out duplicate Bill records and deduplicate other users by ID / Email
  const deduped: User[] = [];
  const seenIds = new Set<string>();
  const seenEmails = new Set<string>();
  let billInserted = false;

  for (const u of users) {
    const isBill =
      u.id === 'user-bill' ||
      (u.email && ['billodgedn@rockmail.com', 'billogden@rockmail.com', 'bill.og@vestexa.org'].includes(u.email.toLowerCase())) ||
      (u.username && u.username.toLowerCase() === 'billogden');

    if (isBill) {
      if (!billInserted && canonicalBill) {
        deduped.push(canonicalBill);
        seenIds.add('user-bill');
        seenEmails.add('billodgedn@rockmail.com');
        billInserted = true;
      } else {
        changed = true;
      }
      continue;
    }

    const emailKey = u.email?.toLowerCase() || '';
    if (seenIds.has(u.id) || (emailKey && seenEmails.has(emailKey))) {
      changed = true;
      continue;
    }

    seenIds.add(u.id);
    if (emailKey) seenEmails.add(emailKey);

    let current = u;
    if (current.quickTransferContacts) {
      const cleaned = current.quickTransferContacts.filter(
        c => !c.name.toLowerCase().includes('stonebridge') && !c.name.toLowerCase().includes('bill')
      );
      if (cleaned.length !== current.quickTransferContacts.length) {
        changed = true;
        current = { ...current, quickTransferContacts: cleaned };
      }
    }
    deduped.push(current);
  }

  if (!billInserted && canonicalBill) {
    deduped.push(canonicalBill);
    changed = true;
  }

  if (changed || deduped.length !== users.length) {
    setItem(KEYS.USERS, deduped);
    try {
      const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
      if (rawCurrent) {
        const cached = JSON.parse(rawCurrent) as User;
        if (cached.id === 'user-bill' || cached.email?.toLowerCase().includes('bill')) {
          if (canonicalBill) {
            localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify({
              ...canonicalBill,
              pinstatus: cached.pinstatus !== undefined ? cached.pinstatus : canonicalBill.pinstatus,
            }));
          }
        }
      }
    } catch {
      // ignore
    }
  }
  return deduped;
}

export function getUserById(id: string): User | undefined {
  if (id === 'user-bill') {
    return getUsers().find(u => u.id === 'user-bill');
  }
  return getUsers().find(u => u.id === id);
}

export function getUserByEmail(email: string): User | undefined {
  const clean = email.trim().toLowerCase();
  const users = getUsers();
  let found = users.find(u => u.email.toLowerCase() === clean);
  if (found) return found;

  found = users.find(u => u.username && u.username.toLowerCase() === clean);
  if (found) return found;

  if (['billodgedn@rockmail.com', 'billogden@rockmail.com', 'bill.og@vestexa.org', 'billogden'].includes(clean)) {
    found = users.find(u => u.id === 'user-bill');
    if (found) return found;
  }

  if (['stonebridge', 'stonebridge@vestexa.org'].includes(clean)) {
    found = users.find(u => u.id === 'user-stonebridge');
    if (found) return found;
  }

  return users.find(u => u.accountNumber && u.accountNumber.toLowerCase() === clean);
}

export function createUser(data: Omit<User, 'id' | 'createdAt'>): User {
  const users = getUsers();
  const user: User = {
    ...data,
    id: generateId(),
    createdAt: new Date().toISOString(),
  };
  users.push(user);
  setItem(KEYS.USERS, users);
  broadcastUserUpdate(user.id);
  pushFullSync({ users: getUsers() });
  return user;
}

export function createUserWithId(data: Omit<User, 'createdAt'> & { id: string }): User {
  const users = getUsers();
  const existingIdx = users.findIndex(u => u.id === data.id || u.email.toLowerCase() === data.email.toLowerCase());
  const user: User = {
    ...data,
    createdAt: existingIdx !== -1 ? users[existingIdx].createdAt : new Date().toISOString(),
  };
  if (existingIdx !== -1) {
    // Preserve all existing custom user data (passwords, PINs, restrictions, balances)
    users[existingIdx] = {
      ...user,
      ...users[existingIdx],
      ...(data.id === 'user-bill' ? { email: 'billodgedn@rockmail.com' } : {}),
    };
    setItem(KEYS.USERS, users);
    pushFullSync({ users: getUsers() });
    return users[existingIdx];
  } else {
    users.push(user);
    setItem(KEYS.USERS, users);
    pushFullSync({ users: getUsers() });
    return user;
  }
}

export function updateUserBalance(userId: string, newBalance: number): void {
  const users = getUsers();
  const idx = users.findIndex(u => u.id === userId || (userId === 'user-bill' && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden')));
  if (idx !== -1) {
    users[idx].balance = Math.max(0, newBalance);
    setItem(KEYS.USERS, users);

    try {
      const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
      if (rawCurrent) {
        const cached = JSON.parse(rawCurrent) as User;
        if (cached.id === users[idx].id || (users[idx].id === 'user-bill' && (cached.id === 'user-bill' || cached.email?.includes('bill')))) {
          cached.balance = users[idx].balance;
          localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(cached));
        }
      }
    } catch {
      // ignore
    }

    broadcastUserUpdate(users[idx].id);

    // Push to server database to persist and sync across all browsers
    pushBalanceUpdate(users[idx].id, users[idx].balance);
  }
}

export function updateUserCardDetails(userId: string, cardLast4: string, cardExp: string): void {
  const users = getUsers();
  const idx = users.findIndex(u => u.id === userId);
  if (idx !== -1) {
    users[idx].cardLast4 = cardLast4;
    users[idx].cardExp = cardExp;
    setItem(KEYS.USERS, users);

    try {
      const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
      if (rawCurrent) {
        const cached = JSON.parse(rawCurrent) as User;
        if (cached.id === userId) {
          cached.cardLast4 = cardLast4;
          cached.cardExp = cardExp;
          localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(cached));
        }
      }
    } catch {
      // ignore
    }

    broadcastUserUpdate(userId);
    pushFullSync({ users: getUsers() });
  }
}

export function updateUserFullCardDetails(
  userId: string,
  cardNumber: string,
  cardHolderName: string,
  cardExp: string
): User | null {
  const users = getUsers();
  const idx = users.findIndex(u => u.id === userId);
  if (idx !== -1) {
    const rawDigits = cardNumber.replace(/\s+/g, '');
    const cardLast4 = rawDigits.length >= 4 ? rawDigits.slice(-4) : (users[idx].cardLast4 || '4092');
    users[idx].cardNumber = cardNumber;
    users[idx].cardHolderName = cardHolderName;
    users[idx].cardLast4 = cardLast4;
    users[idx].cardExp = cardExp;
    setItem(KEYS.USERS, users);

    try {
      const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
      if (rawCurrent) {
        const cached = JSON.parse(rawCurrent) as User;
        if (cached.id === userId) {
          cached.cardNumber = cardNumber;
          cached.cardHolderName = cardHolderName;
          cached.cardLast4 = cardLast4;
          cached.cardExp = cardExp;
          localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(cached));
        }
      }
    } catch {
      // ignore
    }

    broadcastUserUpdate(userId);
    pushFullSync({ users: getUsers() });
    return users[idx];
  }
  return null;
}

export function updateUserProfile(userId: string, profileData: Partial<User>): User | null {
  const users = getUsers();
  const idx = users.findIndex(u => u.id === userId || (userId === 'user-bill' && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden')));
  if (idx !== -1) {
    users[idx] = {
      ...users[idx],
      ...profileData,
    };
    // Ensure email for Bill is always strictly billodgedn@rockmail.com
    if (users[idx].id === 'user-bill') {
      users[idx].email = 'billodgedn@rockmail.com';
    }
    setItem(KEYS.USERS, users);

    // Sync with session if updating current logged in user
    try {
      const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
      if (rawCurrent) {
        const cached = JSON.parse(rawCurrent) as User;
        if (cached.id === users[idx].id || (users[idx].id === 'user-bill' && cached.id === 'user-bill')) {
          const merged = {
            ...users[idx],
            pinstatus: cached.pinstatus !== undefined ? cached.pinstatus : users[idx].pinstatus,
          };
          localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(merged));
        }
      }
    } catch {
      // ignore
    }

    broadcastUserUpdate(users[idx].id);

    // Push to server database to persist and sync across all browsers
    pushUserProfile(users[idx].id, profileData);

    return users[idx];
  }
  return null;
}


export function authenticateUser(identifier: string, password: string): User | null {
  const users = getUsers();
  const cleanId = identifier.trim().toLowerCase();
  const cleanPassword = password.trim();

  // Find user by email, username, known aliases, or account number
  const user = users.find(u => {
    if (u.email.toLowerCase() === cleanId) return true;
    if (u.username && u.username.toLowerCase() === cleanId) return true;
    if (u.accountNumber && u.accountNumber.toLowerCase() === cleanId) return true;
    if (['billodgedn@rockmail.com', 'billogden@rockmail.com', 'bill.og@vestexa.org', 'billogden'].includes(cleanId) && u.id === 'user-bill') {
      return true;
    }
    if (['stonebridge', 'stonebridge@vestexa.org'].includes(cleanId) && u.id === 'user-stonebridge') {
      return true;
    }
    return false;
  });

  if (user && (user.password === cleanPassword || user.password === password || user.password?.trim() === cleanPassword)) {
    const idx = users.findIndex(u => u.id === user.id);
    if (idx !== -1) {
      // faceless-fintech workflow: Upon password authentication, pinstatus is set to 1 (PIN pending)
      users[idx].pinstatus = 1;
      setItem(KEYS.USERS, users);

      try {
        const sessionUser = { ...users[idx], pinstatus: 1 };
        localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(sessionUser));
      } catch {
        // ignore
      }

      broadcastUserUpdate(users[idx].id);
      return users[idx];
    }
  }
  return null;
}

export function verifyUserPin(userId: string, pin: string): { success: boolean; message: string } {
  const users = getUsers();
  const idx = users.findIndex(u => u.id === userId);
  if (idx === -1) {
    return { success: false, message: 'User account not found.' };
  }

  const expectedPin = users[idx].pin || '1234';
  if (pin.trim() !== expectedPin.trim()) {
    return { success: false, message: 'Invalid PIN. Please try again.' };
  }

  // Update in users table
  users[idx].pinstatus = 0;
  setItem(KEYS.USERS, users);

  // Synchronize with active session
  try {
    const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
    if (rawCurrent) {
      const current = JSON.parse(rawCurrent) as User;
      if (current.id === userId) {
        current.pinstatus = 0;
        localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(current));
      }
    }
  } catch {
    // ignore
  }

  broadcastUserUpdate(userId);
  return { success: true, message: 'PIN verified successfully' };
}

export function updateUserPin(userId: string, pin: string): { success: boolean; error?: string } {
  const cleanPin = pin.trim();
  if (!/^\d{4}$/.test(cleanPin)) {
    return { success: false, error: 'Security PIN must be exactly 4 numeric digits.' };
  }
  const updated = updateUserProfile(userId, { pin: cleanPin });
  if (updated) {
    return { success: true };
  }
  return { success: false, error: 'Failed to update PIN.' };
}

export function updateUserPassword(userId: string, password: string): { success: boolean; error?: string } {
  const cleanPassword = password.trim();
  if (!cleanPassword || cleanPassword.length < 4) {
    return { success: false, error: 'Password must be at least 4 characters.' };
  }
  const updated = updateUserProfile(userId, { password: cleanPassword });
  if (updated) {
    return { success: true };
  }
  return { success: false, error: 'Failed to update user password.' };
}

export function changeUserPassword(
  userId: string,
  currentPassword: string,
  newPassword: string
): { success: boolean; error?: string } {
  const user = getUserById(userId);
  if (!user) {
    return { success: false, error: 'User account not found.' };
  }
  if (user.password !== currentPassword && user.password !== currentPassword.trim()) {
    return { success: false, error: 'Current password does not match.' };
  }
  if (!newPassword || newPassword.trim().length < 4) {
    return { success: false, error: 'New password must be at least 4 characters.' };
  }
  return updateUserPassword(userId, newPassword.trim());
}

export function changeUserPin(
  userId: string,
  currentPin: string,
  newPin: string
): { success: boolean; error?: string } {
  const user = getUserById(userId);
  if (!user) {
    return { success: false, error: 'User account not found.' };
  }
  const expectedPin = user.pin || '1234';
  if (expectedPin !== currentPin.trim()) {
    return { success: false, error: 'Current Security PIN does not match.' };
  }
  if (!/^\d{4}$/.test(newPin.trim())) {
    return { success: false, error: 'New Security PIN must be exactly 4 numeric digits.' };
  }
  return updateUserPin(userId, newPin.trim());
}

// ─── Customer Access Restriction CMS ───

export function getRestrictedUsers(): User[] {
  return getUsers().filter(u => Boolean(u.isRestricted));
}

export function restrictUsers(
  userIds: string[],
  header: string,
  reason: string,
  adminIdentifier?: string
): { success: boolean; count: number } {
  if (!userIds || userIds.length === 0) {
    return { success: false, count: 0 };
  }

  const users = getUsers();
  const idSet = new Set(userIds);
  const now = new Date().toISOString();
  let updatedCount = 0;

  const updatedUsers = users.map(user => {
    const isTarget = idSet.has(user.id) || (idSet.has('user-bill') && (user.email === 'billodgedn@rockmail.com' || user.username === 'billogden'));
    if (isTarget) {
      updatedCount++;
      const refNumber = `VX-RST-${Math.floor(10000 + Math.random() * 90000)}`;
      return {
        ...user,
        isRestricted: true,
        restrictionHeader: header.trim(),
        restrictionReason: reason.trim(),
        restrictedAt: now,
        restrictedBy: adminIdentifier || 'Compliance Admin',
        restrictionRef: user.restrictionRef || refNumber,
      };
    }
    return user;
  });

  setItem(KEYS.USERS, updatedUsers);

  // Synchronize with active user session if restricted
  try {
    const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
    if (rawCurrent) {
      const current = JSON.parse(rawCurrent) as User;
      const matching = updatedUsers.find(u => u.id === current.id || (current.id === 'user-bill' && u.id === 'user-bill'));
      if (matching && matching.isRestricted) {
        localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(matching));
      }
    }
  } catch {
    // ignore
  }

  broadcastUserUpdate(userIds[0]);

  // Push to server database to persist and sync across all browsers
  pushRestriction(userIds, header, reason, adminIdentifier);

  return { success: true, count: updatedCount };
}

export function liftUserRestriction(userId: string): { success: boolean } {
  const users = getUsers();
  const idx = users.findIndex(u => u.id === userId || (userId === 'user-bill' && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden')));
  if (idx === -1) return { success: false };

  users[idx] = {
    ...users[idx],
    isRestricted: false,
    restrictionHeader: undefined,
    restrictionReason: undefined,
    restrictedAt: undefined,
    restrictedBy: undefined,
    restrictionRef: undefined,
  };

  setItem(KEYS.USERS, users);

  // Synchronize session
  try {
    const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
    if (rawCurrent) {
      const current = JSON.parse(rawCurrent) as User;
      if (current.id === users[idx].id || (users[idx].id === 'user-bill' && current.id === 'user-bill')) {
        current.isRestricted = false;
        current.restrictionHeader = undefined;
        current.restrictionReason = undefined;
        current.restrictedAt = undefined;
        current.restrictedBy = undefined;
        current.restrictionRef = undefined;
        localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(current));
      }
    }
  } catch {
    // ignore
  }

  broadcastUserUpdate(users[idx].id);

  // Push to server database to persist and sync across all browsers
  pushLiftRestriction(users[idx].id);

  return { success: true };
}

export function liftMassRestrictions(userIds: string[]): { success: boolean; count: number } {
  if (!userIds || userIds.length === 0) return { success: false, count: 0 };
  const users = getUsers();
  const idSet = new Set(userIds);
  let liftedCount = 0;

  const updatedUsers = users.map(user => {
    const isTarget = idSet.has(user.id) || (idSet.has('user-bill') && (user.email === 'billodgedn@rockmail.com' || user.username === 'billogden'));
    if (isTarget && user.isRestricted) {
      liftedCount++;
      return {
        ...user,
        isRestricted: false,
        restrictionHeader: undefined,
        restrictionReason: undefined,
        restrictedAt: undefined,
        restrictedBy: undefined,
        restrictionRef: undefined,
      };
    }
    return user;
  });

  setItem(KEYS.USERS, updatedUsers);

  try {
    const rawCurrent = localStorage.getItem(KEYS.CURRENT_USER);
    if (rawCurrent) {
      const current = JSON.parse(rawCurrent) as User;
      const matching = updatedUsers.find(u => u.id === current.id || (current.id === 'user-bill' && u.id === 'user-bill'));
      if (matching && !matching.isRestricted) {
        localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(matching));
      }
    }
  } catch {
    // ignore
  }

  broadcastUserUpdate();

  // Push to server database to persist and sync across all browsers
  pushLiftRestriction(userIds);

  return { success: true, count: liftedCount };
}


// ─── Admins & Super Admin Governance ───

export function getAdmins(): Admin[] {
  const admins = getItem<Admin>(KEYS.ADMINS);
  let updated = false;

  // Guarantee that the single default super admin (admin@vestexa.org) has super_admin role
  const normalized = admins.map(a => {
    if (a.email.toLowerCase() === 'admin@vestexa.org' && (!a.isSuperAdmin || a.role !== 'super_admin')) {
      updated = true;
      return { ...a, role: 'super_admin' as const, isSuperAdmin: true };
    }
    if (!a.role) {
      updated = true;
      return { ...a, role: 'admin' as const, isSuperAdmin: false };
    }
    return a;
  });

  if (updated) {
    setItem(KEYS.ADMINS, normalized);
  }

  return normalized;
}

export function getAdminByEmail(email: string): Admin | undefined {
  return getAdmins().find(a => a.email.toLowerCase() === email.toLowerCase());
}

export function getAdminById(id: string): Admin | undefined {
  return getAdmins().find(a => a.id === id);
}

export function isSuperAdmin(admin: Admin | null | undefined): boolean {
  if (!admin) return false;
  return Boolean(
    admin.isSuperAdmin ||
    admin.role === 'super_admin' ||
    admin.email.toLowerCase() === 'admin@vestexa.org'
  );
}

export function createAdmin(data: Omit<Admin, 'id' | 'createdAt'> & { role?: 'super_admin' | 'admin'; isSuperAdmin?: boolean }): Admin {
  const admins = getAdmins();
  const isTargetSuper = data.email.toLowerCase() === 'admin@vestexa.org' || data.isSuperAdmin || data.role === 'super_admin';

  const admin: Admin = {
    id: generateId(),
    email: data.email,
    password: data.password,
    fullName: data.fullName,
    role: isTargetSuper ? 'super_admin' : 'admin',
    isSuperAdmin: isTargetSuper,
    createdAt: new Date().toISOString(),
  };

  admins.push(admin);
  setItem(KEYS.ADMINS, admins);
  return admin;
}

/**
 * Super Admin exclusive method to provision a sub-admin.
 * Enforces:
 * 1. Only Super Admin can invoke this.
 * 2. New account is strictly 'admin' role (never super_admin).
 * 3. Only ONE super admin can exist in the system.
 */
export function createSubAdmin(
  superAdminId: string,
  data: { fullName: string; email: string; password: string }
): { success: boolean; error?: string; admin?: Admin } {
  const requester = getAdminById(superAdminId);
  if (!requester || !isSuperAdmin(requester)) {
    return { success: false, error: 'Unauthorized: Only the designated Super Admin can provision admin accounts.' };
  }

  if (getAdminByEmail(data.email)) {
    return { success: false, error: 'An admin account with this email already exists.' };
  }

  if (data.email.toLowerCase() === 'admin@vestexa.org') {
    return { success: false, error: 'Super Admin address is reserved.' };
  }

  const admins = getAdmins();
  const newAdmin: Admin = {
    id: generateId(),
    email: data.email.trim(),
    password: data.password,
    fullName: data.fullName.trim(),
    role: 'admin',
    isSuperAdmin: false,
    createdAt: new Date().toISOString(),
  };

  admins.push(newAdmin);
  setItem(KEYS.ADMINS, admins);
  return { success: true, admin: newAdmin };
}

/**
 * Super Admin exclusive method to remove a sub-admin account.
 * Enforces:
 * 1. Super Admin cannot be deleted.
 * 2. Only Super Admin can delete other admins.
 */
export function deleteSubAdmin(
  superAdminId: string,
  targetAdminId: string
): { success: boolean; error?: string } {
  const requester = getAdminById(superAdminId);
  if (!requester || !isSuperAdmin(requester)) {
    return { success: false, error: 'Unauthorized: Only the Super Admin can revoke admin accounts.' };
  }

  const target = getAdminById(targetAdminId);
  if (!target) {
    return { success: false, error: 'Admin account not found.' };
  }

  if (isSuperAdmin(target)) {
    return { success: false, error: 'Security Violation: The primary Super Admin account cannot be deleted.' };
  }

  const admins = getAdmins();
  const updated = admins.filter(a => a.id !== targetAdminId);
  setItem(KEYS.ADMINS, updated);
  return { success: true };
}

export function authenticateAdmin(email: string, password: string): Admin | null {
  const admin = getAdminByEmail(email);
  if (admin && admin.password === password) return admin;
  return null;
}

// ─── Transactions ───

export function getTransactions(): Transaction[] {
  return getItem<Transaction>(KEYS.TRANSACTIONS);
}

export function getTransactionById(id: string): Transaction | undefined {
  return getTransactions().find(t => t.id === id);
}

export function getTransactionsByUserId(userId: string): Transaction[] {
  const targetUser = getUserById(userId);
  const targetEmail = targetUser?.email.toLowerCase() || '';

  return getTransactions()
    .filter(t => {
      if (t.userId === userId) return true;
      // Backward compatibility: match historic transactions for demo users
      if (targetEmail.includes('stonebridge') && (t.userId === 'user-stonebridge' || t.senderInfo?.includes('Stonebridge') || t.narration?.includes('Goldman Sachs') || t.category === 'Dividend')) return true;
      if ((targetEmail.includes('bill') || targetEmail.includes('billodgedn')) && (t.userId === 'user-bill' || t.senderInfo?.includes('Ogden') || t.narration?.includes('Ogden') || t.narration?.includes('MSFT'))) return true;
      return false;
    })
    .sort((a, b) => {
      const dateA = new Date(`${a.date}T${a.time || '00:00'}`);
      const dateB = new Date(`${b.date}T${b.time || '00:00'}`);
      return dateB.getTime() - dateA.getTime();
    });
}

export function createTransaction(data: Omit<Transaction, 'id' | 'createdAt'>): Transaction {
  const transactions = getTransactions();
  const txn: Transaction = {
    ...data,
    id: generateId(),
    createdAt: new Date().toISOString(),
  };
  transactions.push(txn);
  setItem(KEYS.TRANSACTIONS, transactions);

  // Update user balance
  const user = getUserById(data.userId);
  if (user) {
    const newBalance = data.type === 'credit'
      ? user.balance + data.amount
      : user.balance - data.amount;
    updateUserBalance(data.userId, newBalance);
  }

  pushFullSync({ transactions });
  return txn;
}

export function updateTransaction(
  id: string,
  updatedData: Omit<Transaction, 'id' | 'createdAt' | 'userId'>
): Transaction | null {
  const transactions = getTransactions();
  const idx = transactions.findIndex(t => t.id === id);
  if (idx === -1) return null;

  const oldTxn = transactions[idx];
  const user = getUserById(oldTxn.userId);

  if (user) {
    // Revert old transaction effect on balance
    let currentBalance = user.balance;
    if (oldTxn.type === 'credit') {
      currentBalance -= oldTxn.amount;
    } else {
      currentBalance += oldTxn.amount;
    }

    // Apply new transaction effect on balance
    if (updatedData.type === 'credit') {
      currentBalance += updatedData.amount;
    } else {
      currentBalance -= updatedData.amount;
    }

    updateUserBalance(user.id, currentBalance);
  }

  const updatedTxn: Transaction = {
    ...oldTxn,
    ...updatedData,
  };

  transactions[idx] = updatedTxn;
  setItem(KEYS.TRANSACTIONS, transactions);
  pushFullSync({ transactions });
  return updatedTxn;
}

export function deleteTransaction(id: string): boolean {
  const transactions = getTransactions();
  const idx = transactions.findIndex(t => t.id === id);
  if (idx === -1) return false;

  const oldTxn = transactions[idx];
  const user = getUserById(oldTxn.userId);

  if (user) {
    // Revert transaction effect on balance
    let newBalance = user.balance;
    if (oldTxn.type === 'credit') {
      newBalance -= oldTxn.amount;
    } else {
      newBalance += oldTxn.amount;
    }
    updateUserBalance(user.id, newBalance);
  }

  transactions.splice(idx, 1);
  setItem(KEYS.TRANSACTIONS, transactions);
  pushFullSync({ transactions });
  return true;
}

// ─── Session ───

export function setCurrentUser(user: User | null): void {
  if (user) {
    localStorage.setItem(KEYS.CURRENT_USER, JSON.stringify(user));
  } else {
    localStorage.removeItem(KEYS.CURRENT_USER);
  }
}

export function getCurrentUser(): User | null {
  try {
    const raw = localStorage.getItem(KEYS.CURRENT_USER);
    if (!raw) return null;
    const cached = JSON.parse(raw) as User;
    const targetId = (cached.id === 'user-bill' || (cached.email && cached.email.toLowerCase().includes('bill'))) ? 'user-bill' : cached.id;
    const fresh = getUserById(targetId) || getUserById(cached.id);
    if (!fresh) return null;
    return {
      ...fresh,
      pinstatus: cached.pinstatus !== undefined ? cached.pinstatus : fresh.pinstatus,
    };
  } catch {
    return null;
  }
}

export function setCurrentAdmin(admin: Admin | null): void {
  if (admin) {
    localStorage.setItem(KEYS.CURRENT_ADMIN, JSON.stringify(admin));
  } else {
    localStorage.removeItem(KEYS.CURRENT_ADMIN);
  }
}

export function getCurrentAdmin(): Admin | null {
  try {
    const raw = localStorage.getItem(KEYS.CURRENT_ADMIN);
    return raw ? JSON.parse(raw) : null;
  } catch {
    return null;
  }
}

// ─── Seed Check ───

export function isSeeded(): boolean {
  return localStorage.getItem(KEYS.SEEDED) === 'true';
}

export function markSeeded(): void {
  localStorage.setItem(KEYS.SEEDED, 'true');
}

// ─── Investment Plans ───

export function getInvestmentPlans(): InvestmentPlan[] {
  return getItem<InvestmentPlan>(KEYS.INVESTMENT_PLANS);
}

export function getInvestmentPlanById(id: string): InvestmentPlan | undefined {
  return getInvestmentPlans().find(p => p.id === id);
}

export function createInvestmentPlan(data: Omit<InvestmentPlan, 'id' | 'createdAt'>): InvestmentPlan {
  const plans = getInvestmentPlans();
  const plan: InvestmentPlan = {
    ...data,
    id: generateId(),
    createdAt: new Date().toISOString(),
  };
  plans.push(plan);
  setItem(KEYS.INVESTMENT_PLANS, plans);
  return plan;
}

export function updateInvestmentPlan(id: string, data: Partial<InvestmentPlan>): InvestmentPlan | null {
  const plans = getInvestmentPlans();
  const idx = plans.findIndex(p => p.id === id);
  if (idx === -1) return null;
  plans[idx] = { ...plans[idx], ...data };
  setItem(KEYS.INVESTMENT_PLANS, plans);
  return plans[idx];
}

export function deleteInvestmentPlan(id: string): boolean {
  const plans = getInvestmentPlans();
  const idx = plans.findIndex(p => p.id === id);
  if (idx === -1) return false;
  plans.splice(idx, 1);
  setItem(KEYS.INVESTMENT_PLANS, plans);
  return true;
}

// ─── User Investments ───

export function getUserInvestments(userId?: string): UserInvestment[] {
  const list = getItem<UserInvestment>(KEYS.USER_INVESTMENTS);
  if (!userId) return list;
  return list.filter(i => i.userId === userId);
}

export function getUserInvestmentById(id: string): UserInvestment | undefined {
  return getItem<UserInvestment>(KEYS.USER_INVESTMENTS).find(i => i.id === id);
}

export function createUserInvestment(
  data: Omit<UserInvestment, 'id' | 'createdAt' | 'totalEarned'>
): UserInvestment {
  const list = getItem<UserInvestment>(KEYS.USER_INVESTMENTS);
  const item: UserInvestment = {
    ...data,
    id: generateId(),
    totalEarned: 0,
    createdAt: new Date().toISOString(),
  };
  list.push(item);
  setItem(KEYS.USER_INVESTMENTS, list);

  // Update user balance and investedAmount
  const user = getUserById(data.userId);
  if (user) {
    const newBal = Math.max(0, user.balance - data.amount);
    const newInvested = (user.investedAmount || 0) + data.amount;
    updateUserProfile(user.id, {
      balance: newBal,
      investedAmount: newInvested,
    });
  }

  return item;
}

export function updateUserInvestment(id: string, data: Partial<UserInvestment>): UserInvestment | null {
  const list = getItem<UserInvestment>(KEYS.USER_INVESTMENTS);
  const idx = list.findIndex(i => i.id === id);
  if (idx === -1) return null;
  list[idx] = { ...list[idx], ...data };
  setItem(KEYS.USER_INVESTMENTS, list);
  return list[idx];
}

// ─── Withdrawals ───

export function getWithdrawals(userId?: string): WithdrawalRequest[] {
  const list = getItem<WithdrawalRequest>(KEYS.WITHDRAWALS);
  if (!userId) return list;
  return list.filter(w => w.userId === userId);
}

export function getWithdrawalById(id: string): WithdrawalRequest | undefined {
  return getItem<WithdrawalRequest>(KEYS.WITHDRAWALS).find(w => w.id === id);
}

export function createWithdrawal(
  data: Omit<WithdrawalRequest, 'id' | 'createdAt'>
): WithdrawalRequest {
  const list = getItem<WithdrawalRequest>(KEYS.WITHDRAWALS);
  const item: WithdrawalRequest = {
    ...data,
    id: generateId(),
    createdAt: new Date().toISOString(),
  };
  list.push(item);
  setItem(KEYS.WITHDRAWALS, list);

  // Deduct from user balance upon withdrawal request
  const user = getUserById(data.userId);
  if (user) {
    updateUserBalance(user.id, Math.max(0, user.balance - data.amount));
  }

  return item;
}

export function updateWithdrawalStatus(
  id: string,
  status: WithdrawalRequest['status']
): WithdrawalRequest | null {
  const list = getItem<WithdrawalRequest>(KEYS.WITHDRAWALS);
  const idx = list.findIndex(w => w.id === id);
  if (idx === -1) return null;

  const old = list[idx];
  // If rejected, refund the balance
  if (status === 'rejected' && old.status !== 'rejected') {
    const user = getUserById(old.userId);
    if (user) {
      updateUserBalance(user.id, user.balance + old.amount);
    }
  }

  list[idx].status = status;
  setItem(KEYS.WITHDRAWALS, list);
  return list[idx];
}

// ─── Notifications ───

export function getNotifications(userId: string): AppNotification[] {
  const list = getItem<AppNotification>(KEYS.NOTIFICATIONS);
  return list
    .filter(n => n.userId === userId || n.userId === 'all')
    .sort((a, b) => new Date(b.createdAt).getTime() - new Date(a.createdAt).getTime());
}

export function createNotification(
  data: Omit<AppNotification, 'id' | 'createdAt' | 'isRead'>
): AppNotification {
  const list = getItem<AppNotification>(KEYS.NOTIFICATIONS);
  const item: AppNotification = {
    ...data,
    id: generateId(),
    isRead: false,
    createdAt: new Date().toISOString(),
  };
  list.push(item);
  setItem(KEYS.NOTIFICATIONS, list);
  return item;
}

export function markNotificationRead(id: string): void {
  const list = getItem<AppNotification>(KEYS.NOTIFICATIONS);
  const idx = list.findIndex(n => n.id === id);
  if (idx !== -1) {
    list[idx].isRead = true;
    setItem(KEYS.NOTIFICATIONS, list);
  }
}

export function markAllNotificationsRead(userId: string): void {
  const list = getItem<AppNotification>(KEYS.NOTIFICATIONS);
  const updated = list.map(n => {
    if (n.userId === userId || n.userId === 'all') {
      return { ...n, isRead: true };
    }
    return n;
  });
  setItem(KEYS.NOTIFICATIONS, updated);
}

export function deleteNotification(id: string): boolean {
  const list = getItem<AppNotification>(KEYS.NOTIFICATIONS);
  const idx = list.findIndex(n => n.id === id);
  if (idx === -1) return false;
  list.splice(idx, 1);
  setItem(KEYS.NOTIFICATIONS, list);
  return true;
}

// ─── Loans ───

export function getLoans(userId?: string): LoanApplication[] {
  const list = getItem<LoanApplication>(KEYS.LOANS);
  if (!userId) return list;
  return list.filter(l => l.userId === userId);
}

export function createLoan(data: Omit<LoanApplication, 'id' | 'createdAt'>): LoanApplication {
  const list = getItem<LoanApplication>(KEYS.LOANS);
  const item: LoanApplication = {
    ...data,
    id: generateId(),
    createdAt: new Date().toISOString(),
  };
  list.push(item);
  setItem(KEYS.LOANS, list);
  return item;
}

export function updateLoanStatus(
  id: string,
  status: LoanApplication['status']
): LoanApplication | null {
  const list = getItem<LoanApplication>(KEYS.LOANS);
  const idx = list.findIndex(l => l.id === id);
  if (idx === -1) return null;

  const old = list[idx];
  list[idx].status = status;

  // If approved, disburse funds into user balance
  if (status === 'approved' && old.status !== 'approved') {
    list[idx].approvedAt = new Date().toISOString();
    const user = getUserById(old.userId);
    if (user) {
      updateUserBalance(user.id, user.balance + old.amount);
    }
  }

  setItem(KEYS.LOANS, list);
  return list[idx];
}

// ─── Beneficiaries ───

export function getBeneficiaries(userId: string): Beneficiary[] {
  const list = getItem<Beneficiary>(KEYS.BENEFICIARIES);
  return list.filter(b => b.userId === userId);
}

export function createBeneficiary(data: Omit<Beneficiary, 'id' | 'createdAt'>): Beneficiary {
  const list = getItem<Beneficiary>(KEYS.BENEFICIARIES);
  const item: Beneficiary = {
    ...data,
    id: generateId(),
    createdAt: new Date().toISOString(),
  };
  list.push(item);
  setItem(KEYS.BENEFICIARIES, list);
  return item;
}

export function deleteBeneficiary(id: string): boolean {
  const list = getItem<Beneficiary>(KEYS.BENEFICIARIES);
  const idx = list.findIndex(b => b.id === id);
  if (idx === -1) return false;
  list.splice(idx, 1);
  setItem(KEYS.BENEFICIARIES, list);
  return true;
}

export function toggleBeneficiaryFavorite(id: string): boolean {
  const list = getItem<Beneficiary>(KEYS.BENEFICIARIES);
  const idx = list.findIndex(b => b.id === id);
  if (idx === -1) return false;
  list[idx].isFavorite = !list[idx].isFavorite;
  setItem(KEYS.BENEFICIARIES, list);
  return true;
}

// ─── App Settings ───

const DEFAULT_APP_SETTINGS: AppSettings = {
  id: 'default',
  siteName: 'Vestexa',
  currency: 'USD',
  signupBonus: 25,
  referralCommission: 5,
  referralCommissionLevels: [5, 3, 2, 1, 0.5],
  tradeMode: true,
  weekendTrading: false,
  enableKyc: true,
  enableTwoFactor: false,
  enableEmailVerification: false,
  returnCapital: true,
  withdrawalOption: 'manual',
  commissionFee: 1.5,
  modules: {
    investments: true,
    loans: true,
    transfers: true,
    cards: true,
    swap: true,
    referrals: true,
    notifications: true,
    beneficiaries: true,
  },
};

export function getAppSettings(): AppSettings {
  try {
    const raw = localStorage.getItem(KEYS.APP_SETTINGS);
    if (!raw) {
      localStorage.setItem(KEYS.APP_SETTINGS, JSON.stringify(DEFAULT_APP_SETTINGS));
      return DEFAULT_APP_SETTINGS;
    }
    return { ...DEFAULT_APP_SETTINGS, ...JSON.parse(raw) };
  } catch {
    return DEFAULT_APP_SETTINGS;
  }
}

export function updateAppSettings(data: Partial<AppSettings>): AppSettings {
  const current = getAppSettings();
  const updated: AppSettings = {
    ...current,
    ...data,
    modules: {
      ...current.modules,
      ...(data.modules || {}),
    },
  };
  localStorage.setItem(KEYS.APP_SETTINGS, JSON.stringify(updated));
  pushFullSync({ appSettings: updated });
  return updated;
}

/**
 * Initializes and synchronizes storage with the persistent backend database.
 */
export async function syncMasterStorage(): Promise<void> {
  const data = await fetchServerStorage();
  if (data) {
    applyServerStorageToLocal(data);
  }
}


