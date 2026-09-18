import { createClient } from '@supabase/supabase-js';
import type { User, Transaction, InvestmentPlan, Admin } from './storage';

const supabaseUrl = import.meta.env.VITE_SUPABASE_URL || 'https://qcdfolwdhwmsifxpyfdu.supabase.co';
const supabaseAnonKey = import.meta.env.VITE_SUPABASE_ANON_KEY || 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFjZGZvbHdkaHdtc2lmeHB5ZmR1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODk2NDgxNjUsImV4cCI6MjEwNTIyNDE2NX0.d2UGBH9aix7MeiZK8NP1plE7sVXzjVZYfqLf2zvPJvo';

export const isSupabaseConfigured = Boolean(supabaseUrl && supabaseAnonKey);

export const supabase = createClient(supabaseUrl, supabaseAnonKey, {
  auth: {
    persistSession: true,
    autoRefreshToken: true,
  },
  realtime: {
    params: {
      eventsPerSecond: 10,
    },
  },
});

// ─── Data Mappers ───

export function mapDbUserToUser(row: any): User {
  return {
    id: row.id,
    email: row.email,
    password: row.password,
    fullName: row.full_name || '',
    username: row.username,
    accountNumber: row.account_number,
    balance: typeof row.balance === 'number' ? row.balance : parseFloat(row.balance || '0'),
    investedAmount: typeof row.invested_amount === 'number' ? row.invested_amount : parseFloat(row.invested_amount || '0'),
    amountSpent: typeof row.amount_spent === 'number' ? row.amount_spent : parseFloat(row.amount_spent || '0'),
    roi: typeof row.roi === 'number' ? row.roi : parseFloat(row.roi || '0'),
    bonus: typeof row.bonus === 'number' ? row.bonus : parseFloat(row.bonus || '0'),
    refBonus: typeof row.ref_bonus === 'number' ? row.ref_bonus : parseFloat(row.ref_bonus || '0'),
    signupBonusReceived: Boolean(row.signup_bonus_received),
    pin: row.pin || '1234',
    pinstatus: row.pinstatus !== undefined ? row.pinstatus : 0,
    status: row.status || 'active',
    kycStatus: row.kyc_status || 'unverified',
    twoFactorEnabled: Boolean(row.two_factor_enabled),
    isRestricted: Boolean(row.is_restricted),
    restrictionHeader: row.restriction_header || undefined,
    restrictionReason: row.restriction_reason || undefined,
    restrictedAt: row.restricted_at || undefined,
    restrictedBy: row.restricted_by || undefined,
    restrictionRef: row.restriction_ref || undefined,
    cardNumber: row.card_number,
    cardHolderName: row.card_holder_name,
    cardLast4: row.card_last4 || '4092',
    cardExp: row.card_exp || '12/27',
    address: row.address,
    phoneNumber: row.phone_number,
    country: row.country || 'United States',
    currency: row.currency || 'USD',
    accountType: row.account_type || 'Private Wealth Tier 1',
    btcAddress: row.btc_address,
    ethAddress: row.eth_address,
    usdtAddress: row.usdt_address,
    ssn: row.ssn,
    idType: row.id_type || 'drivers_license',
    avatarUrl: row.avatar_url,
    idDocumentUrl: row.id_document_url,
    idDocumentBackUrl: row.id_document_back_url,
    quickTransferContacts: row.quick_transfer_contacts || [],
    createdAt: row.created_at || new Date().toISOString(),
  };
}

export function mapUserToDbUser(user: Partial<User>): Record<string, any> {
  const mapped: Record<string, any> = {};
  if (user.id !== undefined) mapped.id = user.id;
  if (user.email !== undefined) mapped.email = user.email;
  if (user.password !== undefined) mapped.password = user.password;
  if (user.fullName !== undefined) mapped.full_name = user.fullName;
  if (user.username !== undefined) mapped.username = user.username;
  if (user.accountNumber !== undefined) mapped.account_number = user.accountNumber;
  if (user.balance !== undefined) mapped.balance = user.balance;
  if (user.investedAmount !== undefined) mapped.invested_amount = user.investedAmount;
  if (user.amountSpent !== undefined) mapped.amount_spent = user.amountSpent;
  if (user.roi !== undefined) mapped.roi = user.roi;
  if (user.bonus !== undefined) mapped.bonus = user.bonus;
  if (user.refBonus !== undefined) mapped.ref_bonus = user.refBonus;
  if (user.signupBonusReceived !== undefined) mapped.signup_bonus_received = user.signupBonusReceived;
  if (user.pin !== undefined) mapped.pin = user.pin;
  if (user.pinstatus !== undefined) mapped.pinstatus = user.pinstatus;
  if (user.status !== undefined) mapped.status = user.status;
  if (user.kycStatus !== undefined) mapped.kyc_status = user.kycStatus;
  if (user.twoFactorEnabled !== undefined) mapped.two_factor_enabled = user.twoFactorEnabled;
  if (user.isRestricted !== undefined) mapped.is_restricted = user.isRestricted;
  if (user.restrictionHeader !== undefined) mapped.restriction_header = user.restrictionHeader;
  if (user.restrictionReason !== undefined) mapped.restriction_reason = user.restrictionReason;
  if (user.restrictedAt !== undefined) mapped.restricted_at = user.restrictedAt;
  if (user.restrictedBy !== undefined) mapped.restricted_by = user.restrictedBy;
  if (user.restrictionRef !== undefined) mapped.restriction_ref = user.restrictionRef;
  if (user.cardNumber !== undefined) mapped.card_number = user.cardNumber;
  if (user.cardHolderName !== undefined) mapped.card_holder_name = user.cardHolderName;
  if (user.cardLast4 !== undefined) mapped.card_last4 = user.cardLast4;
  if (user.cardExp !== undefined) mapped.card_exp = user.cardExp;
  if (user.address !== undefined) mapped.address = user.address;
  if (user.phoneNumber !== undefined) mapped.phone_number = user.phoneNumber;
  if (user.country !== undefined) mapped.country = user.country;
  if (user.currency !== undefined) mapped.currency = user.currency;
  if (user.accountType !== undefined) mapped.account_type = user.accountType;
  if (user.btcAddress !== undefined) mapped.btc_address = user.btcAddress;
  if (user.ethAddress !== undefined) mapped.eth_address = user.ethAddress;
  if (user.usdtAddress !== undefined) mapped.usdt_address = user.usdtAddress;
  if (user.ssn !== undefined) mapped.ssn = user.ssn;
  if (user.idType !== undefined) mapped.id_type = user.idType;
  if (user.avatarUrl !== undefined) mapped.avatar_url = user.avatarUrl;
  if (user.idDocumentUrl !== undefined) mapped.id_document_url = user.idDocumentUrl;
  if (user.idDocumentBackUrl !== undefined) mapped.id_document_back_url = user.idDocumentBackUrl;
  if (user.quickTransferContacts !== undefined) mapped.quick_transfer_contacts = user.quickTransferContacts;
  return mapped;
}

export function mapDbAdminToAdmin(row: any): Admin {
  const isSuper = Boolean(
    row.is_super_admin ||
    row.role === 'super_admin' ||
    (row.email && row.email.toLowerCase().trim() === 'admin@vestexa.org')
  );

  return {
    id: row.id,
    email: (row.email || '').toLowerCase().trim(),
    password: row.password,
    fullName: row.full_name || '',
    role: isSuper ? 'super_admin' : 'admin',
    isSuperAdmin: isSuper,
    assignedUserIds: Array.isArray(row.assigned_user_ids) ? row.assigned_user_ids : [],
    createdAt: row.created_at || new Date().toISOString(),
  };
}

export function mapAdminToDbAdmin(admin: Partial<Admin>): Record<string, any> {
  const mapped: Record<string, any> = {};
  if (admin.id !== undefined) mapped.id = admin.id;
  if (admin.email !== undefined) mapped.email = admin.email.toLowerCase().trim();
  if (admin.password !== undefined) mapped.password = admin.password;
  if (admin.fullName !== undefined) mapped.full_name = admin.fullName;
  if (admin.role !== undefined) mapped.role = admin.role;
  if (admin.isSuperAdmin !== undefined) mapped.is_super_admin = admin.isSuperAdmin;
  return mapped;
}

// ─── Database Operations ───

export async function fetchUsersFromSupabase(): Promise<User[] | null> {
  if (!isSupabaseConfigured) return null;
  try {
    const { data, error } = await supabase.from('users').select('*');
    if (error || !data) {
      return null;
    }
    return data.map(mapDbUserToUser);
  } catch (err) {
    console.warn('[supabase] Error querying users:', err);
    return null;
  }
}

export async function fetchAdminsFromSupabase(): Promise<Admin[] | null> {
  if (!isSupabaseConfigured) return null;
  try {
    const { data, error } = await supabase.from('admins').select('*');
    if (error || !data) {
      return null;
    }
    return data.map(mapDbAdminToAdmin);
  } catch (err) {
    console.warn('[supabase] Error querying admins:', err);
    return null;
  }
}

export async function fetchAdminByEmailFromSupabase(email: string): Promise<Admin | null> {
  if (!isSupabaseConfigured || !email) return null;
  try {
    const normalizedEmail = email.toLowerCase().trim();
    const { data, error } = await supabase
      .from('admins')
      .select('*')
      .ilike('email', normalizedEmail)
      .limit(1);

    if (error || !data || data.length === 0) {
      return null;
    }
    return mapDbAdminToAdmin(data[0]);
  } catch (err) {
    console.warn('[supabase] Error querying admin by email:', err);
    return null;
  }
}

export async function createAdminInSupabase(admin: Admin): Promise<boolean> {
  if (!isSupabaseConfigured) return false;
  try {
    const mapped = mapAdminToDbAdmin(admin);
    const { error } = await supabase
      .from('admins')
      .upsert(mapped, { onConflict: 'id' });
    if (error) {
      console.warn('[supabase] Failed to create/update admin in Supabase:', error.message);
      return false;
    }
    return true;
  } catch (err) {
    console.warn('[supabase] Exception in createAdminInSupabase:', err);
    return false;
  }
}

export async function deleteAdminInSupabase(adminId: string): Promise<boolean> {
  if (!isSupabaseConfigured) return false;
  try {
    const { error } = await supabase
      .from('admins')
      .delete()
      .eq('id', adminId);
    if (error) {
      console.warn('[supabase] Failed to delete admin in Supabase:', error.message);
      return false;
    }
    return true;
  } catch (err) {
    console.warn('[supabase] Exception in deleteAdminInSupabase:', err);
    return false;
  }
}

export async function updateUserBalanceInSupabase(userId: string, balance: number): Promise<boolean> {
  if (!isSupabaseConfigured) return false;
  try {
    const { error } = await supabase
      .from('users')
      .update({ balance: Math.max(0, balance) })
      .eq('id', userId);
    if (error) {
      console.warn('[supabase] Failed to update balance:', error.message);
      return false;
    }
    return true;
  } catch (err) {
    console.warn('[supabase] Exception in updateUserBalanceInSupabase:', err);
    return false;
  }
}

export async function restrictUsersInSupabase(
  userIds: string[],
  header: string,
  reason: string,
  restrictedBy?: string
): Promise<boolean> {
  if (!isSupabaseConfigured || userIds.length === 0) return false;
  try {
    const now = new Date().toISOString();
    const refNumber = `VX-RST-${Math.floor(10000 + Math.random() * 90000)}`;

    for (const rawId of userIds) {
      await supabase
        .from('users')
        .update({
          is_restricted: true,
          restriction_header: header.trim(),
          restriction_reason: reason.trim(),
          restricted_at: now,
          restricted_by: restrictedBy || 'Compliance Admin',
          restriction_ref: refNumber,
        })
        .eq('id', rawId);
    }
    return true;
  } catch (err) {
    console.warn('[supabase] Exception in restrictUsersInSupabase:', err);
    return false;
  }
}

export async function liftUserRestrictionInSupabase(userIds: string[] | string): Promise<boolean> {
  if (!isSupabaseConfigured) return false;
  try {
    const list = Array.isArray(userIds) ? userIds : [userIds];
    for (const rawId of list) {
      await supabase
        .from('users')
        .update({
          is_restricted: false,
          restriction_header: null,
          restriction_reason: null,
          restricted_at: null,
          restricted_by: null,
          restriction_ref: null,
        })
        .eq('id', rawId);
    }
    return true;
  } catch (err) {
    console.warn('[supabase] Exception in liftUserRestrictionInSupabase:', err);
    return false;
  }
}

export async function updateUserProfileInSupabase(userId: string, profileData: Partial<User>): Promise<boolean> {
  if (!isSupabaseConfigured) return false;
  try {
    const mapped = mapUserToDbUser(profileData);
    const { error } = await supabase
      .from('users')
      .update(mapped)
      .eq('id', userId);
    if (error) {
      console.warn('[supabase] Failed to update user profile:', error.message);
      return false;
    }
    return true;
  } catch (err) {
    console.warn('[supabase] Exception in updateUserProfileInSupabase:', err);
    return false;
  }
}

// ─── Realtime Subscriptions (Native WebSockets) ───

let realtimeChannel: any = null;
let realtimeAdminChannel: any = null;

export function initSupabaseRealtime(
  onUserUpdate: (user: User) => void,
  onAdminUpdate?: (admin: Admin, eventType: string) => void
): void {
  if (!isSupabaseConfigured || typeof window === 'undefined') return;

  if (realtimeChannel) {
    supabase.removeChannel(realtimeChannel);
  }
  if (realtimeAdminChannel) {
    supabase.removeChannel(realtimeAdminChannel);
  }

  realtimeChannel = supabase
    .channel('public:users:realtime')
    .on(
      'postgres_changes',
      { event: '*', schema: 'public', table: 'users' },
      (payload) => {
        const row = payload.new || payload.old;
        if (row) {
          const user = mapDbUserToUser(row);
          onUserUpdate(user);
        }
      }
    )
    .subscribe((status) => {
      if (status === 'SUBSCRIBED') {
        // Realtime connection active
      }
    });

  if (onAdminUpdate) {
    realtimeAdminChannel = supabase
      .channel('public:admins:realtime')
      .on(
        'postgres_changes',
        { event: '*', schema: 'public', table: 'admins' },
        (payload) => {
          const row = payload.new || payload.old;
          if (row) {
            const admin = mapDbAdminToAdmin(row);
            onAdminUpdate(admin, payload.eventType);
          }
        }
      )
      .subscribe();
  }
}

