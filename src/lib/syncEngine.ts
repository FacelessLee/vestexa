// Real-time synchronization engine connecting browser localStorage with Supabase cloud database
// Guarantees cross-browser, cross-session consistency for balances, restrictions, and user accounts.

import {
  isSupabaseConfigured,
  fetchUsersFromSupabase,
  fetchAdminsFromSupabase,
  createAdminInSupabase,
  deleteAdminInSupabase,
  updateUserBalanceInSupabase,
  restrictUsersInSupabase,
  liftUserRestrictionInSupabase,
  updateUserProfileInSupabase,
  initSupabaseRealtime,
} from './supabase';

const API_BASE = '';

let eventSource: EventSource | null = null;
let isSyncing = false;
let hasInitialized = false;

// ─── Direct API Calls ───

export async function fetchServerStorage(): Promise<any | null> {
  // 1. Prioritize Supabase Cloud Database
  if (isSupabaseConfigured) {
    try {
      const [supabaseUsers, supabaseAdmins] = await Promise.all([
        fetchUsersFromSupabase(),
        fetchAdminsFromSupabase(),
      ]);
      const result: Record<string, any> = {};
      if (supabaseUsers && supabaseUsers.length > 0) {
        result.users = supabaseUsers;
      }
      if (supabaseAdmins && supabaseAdmins.length > 0) {
        result.admins = supabaseAdmins;
      }
      if (Object.keys(result).length > 0) {
        return result;
      }
    } catch {
      // fallback
    }
  }

  // 2. Fallback to local server API
  try {
    const res = await fetch(`${API_BASE}/api/storage`, {
      method: 'GET',
      headers: { 'Accept': 'application/json' },
    });
    if (!res.ok) return null;
    return await res.json();
  } catch {
    return null;
  }
}

export async function pushBalanceUpdate(userId: string, balance: number): Promise<boolean> {
  // Push to Supabase Cloud Database
  if (isSupabaseConfigured) {
    updateUserBalanceInSupabase(userId, balance).catch((err) => {
      console.warn('[syncEngine] Supabase balance update error:', err);
    });
  }

  // Also push to local server API
  try {
    const res = await fetch(`${API_BASE}/api/users/update-balance`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ userId, balance }),
    });
    return res.ok;
  } catch {
    return false;
  }
}

export async function pushRestriction(
  userIds: string[],
  header: string,
  reason: string,
  restrictedBy?: string
): Promise<boolean> {
  // Push to Supabase Cloud Database
  if (isSupabaseConfigured) {
    restrictUsersInSupabase(userIds, header, reason, restrictedBy).catch((err) => {
      console.warn('[syncEngine] Supabase restriction error:', err);
    });
  }

  // Also push to local server API
  try {
    const res = await fetch(`${API_BASE}/api/users/restrict`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ userIds, header, reason, restrictedBy }),
    });
    return res.ok;
  } catch {
    return false;
  }
}

export async function pushLiftRestriction(userIds: string[] | string): Promise<boolean> {
  // Push to Supabase Cloud Database
  if (isSupabaseConfigured) {
    liftUserRestrictionInSupabase(userIds).catch((err) => {
      console.warn('[syncEngine] Supabase lift restriction error:', err);
    });
  }

  // Also push to local server API
  try {
    const list = Array.isArray(userIds) ? userIds : [userIds];
    const res = await fetch(`${API_BASE}/api/users/lift-restriction`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ userIds: list }),
    });
    return res.ok;
  } catch {
    return false;
  }
}

export async function pushUserProfile(userId: string, profileData: any): Promise<boolean> {
  // Push to Supabase Cloud Database
  if (isSupabaseConfigured) {
    updateUserProfileInSupabase(userId, profileData).catch((err) => {
      console.warn('[syncEngine] Supabase profile update error:', err);
    });
  }

  // Also push to local server API
  try {
    const res = await fetch(`${API_BASE}/api/users/update-profile`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ userId, profileData }),
    });
    return res.ok;
  } catch {
    return false;
  }
}

export async function pushFullSync(data: Record<string, any>): Promise<boolean> {
  try {
    const res = await fetch(`${API_BASE}/api/storage/sync`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    });
    return res.ok;
  } catch {
    return false;
  }
}

export async function pushAdmin(admin: any): Promise<boolean> {
  if (isSupabaseConfigured) {
    createAdminInSupabase(admin).catch((err) => {
      console.warn('[syncEngine] Supabase create admin error:', err);
    });
  }

  const raw = localStorage.getItem('vestexa_admins');
  const admins = raw ? JSON.parse(raw) : [admin];
  return pushFullSync({ admins });
}

export async function pushDeleteAdmin(adminId: string): Promise<boolean> {
  if (isSupabaseConfigured) {
    deleteAdminInSupabase(adminId).catch((err) => {
      console.warn('[syncEngine] Supabase delete admin error:', err);
    });
  }

  const raw = localStorage.getItem('vestexa_admins');
  const admins = raw ? JSON.parse(raw).filter((a: any) => a.id !== adminId) : [];
  return pushFullSync({ admins });
}

// ─── Local Storage Reconciliation ───

export function applyServerStorageToLocal(serverData: any): void {
  if (!serverData || typeof serverData !== 'object') return;

  try {
    if (Array.isArray(serverData.users)) {
      localStorage.setItem('vestexa_users', JSON.stringify(serverData.users));

      // Synchronize active current user session if present
      const rawCurrent = localStorage.getItem('vestexa_current_user');
      if (rawCurrent) {
        const current = JSON.parse(rawCurrent);
        if (current && current.id) {
          const fresh = serverData.users.find(
            (u: any) => u.id === current.id
          );
          if (fresh) {
            localStorage.setItem(
              'vestexa_current_user',
              JSON.stringify({
                ...fresh,
                pinstatus: current.pinstatus !== undefined ? current.pinstatus : fresh.pinstatus,
              })
            );
          }
        }
      }
    }

    if (Array.isArray(serverData.admins) && serverData.admins.length > 0) {
      const rawCurrentAdmins = localStorage.getItem('vestexa_admins');
      let localAdmins: any[] = [];
      try {
        if (rawCurrentAdmins) localAdmins = JSON.parse(rawCurrentAdmins);
      } catch {
        localAdmins = [];
      }

      const adminMap = new Map<string, any>();
      // Place server admins
      for (const sa of serverData.admins) {
        if (sa && sa.email) {
          adminMap.set(sa.email.toLowerCase().trim(), sa);
        }
      }
      // Preserve any local admins and their assignedUserIds
      for (const la of localAdmins) {
        if (la && la.email) {
          const key = la.email.toLowerCase().trim();
          const existing = adminMap.get(key);
          if (!existing) {
            adminMap.set(key, la);
          } else {
            if (Array.isArray(la.assignedUserIds) && la.assignedUserIds.length > 0 && (!existing.assignedUserIds || existing.assignedUserIds.length === 0)) {
              existing.assignedUserIds = la.assignedUserIds;
            }
          }
        }
      }

      const merged = Array.from(adminMap.values());
      localStorage.setItem('vestexa_admins', JSON.stringify(merged));
      window.dispatchEvent(new CustomEvent('vestexa_admins_updated', { detail: { admins: merged } }));
    }
    if (Array.isArray(serverData.transactions)) {
      localStorage.setItem('vestexa_transactions', JSON.stringify(serverData.transactions));
    }
    if (Array.isArray(serverData.investmentPlans)) {
      localStorage.setItem('vestexa_investment_plans', JSON.stringify(serverData.investmentPlans));
    }
    if (Array.isArray(serverData.userInvestments)) {
      localStorage.setItem('vestexa_user_investments', JSON.stringify(serverData.userInvestments));
    }
    if (Array.isArray(serverData.withdrawals)) {
      localStorage.setItem('vestexa_withdrawals', JSON.stringify(serverData.withdrawals));
    }
    if (Array.isArray(serverData.notifications)) {
      localStorage.setItem('vestexa_notifications', JSON.stringify(serverData.notifications));
    }
    if (Array.isArray(serverData.loans)) {
      localStorage.setItem('vestexa_loans', JSON.stringify(serverData.loans));
    }
    if (Array.isArray(serverData.beneficiaries)) {
      localStorage.setItem('vestexa_beneficiaries', JSON.stringify(serverData.beneficiaries));
    }
    if (serverData.appSettings) {
      localStorage.setItem('vestexa_app_settings', JSON.stringify(serverData.appSettings));
    }

    // Mark seeded so client doesn't overwrite with default seed
    localStorage.setItem('vestexa_seeded_v3', 'true');

    // Notify all client components
    window.dispatchEvent(new CustomEvent('vestexa_user_updated', { detail: { source: 'server_sync' } }));
    window.dispatchEvent(new CustomEvent('storage'));
  } catch (e) {
    console.error('[syncEngine] Error applying server storage to local:', e);
  }
}

// ─── Real-Time Push Stream (Supabase WebSockets + Server SSE) ───

export function initRealtimeSync(): void {
  if (typeof window === 'undefined') return;

  // 1. Pull initial master state from Supabase or server immediately
  fetchServerStorage().then((data) => {
    if (data) {
      applyServerStorageToLocal(data);
    }
  });

  if (hasInitialized) return;
  hasInitialized = true;

  // 2. Subscribe to Supabase Native WebSockets for instant cross-device live sync
  if (isSupabaseConfigured) {
    try {
      initSupabaseRealtime(
        (updatedUser) => {
          const rawUsers = localStorage.getItem('vestexa_users');
          if (rawUsers) {
            const users = JSON.parse(rawUsers);
            const idx = users.findIndex(
              (u: any) => u.id === updatedUser.id
            );
            if (idx !== -1) {
              users[idx] = { ...users[idx], ...updatedUser };
            } else {
              users.push(updatedUser);
            }
            localStorage.setItem('vestexa_users', JSON.stringify(users));

            // Synchronize active session if current user
            const rawCurrent = localStorage.getItem('vestexa_current_user');
            if (rawCurrent) {
              const current = JSON.parse(rawCurrent);
              if (current.id === updatedUser.id) {
                localStorage.setItem(
                  'vestexa_current_user',
                  JSON.stringify({
                    ...updatedUser,
                    pinstatus: current.pinstatus !== undefined ? current.pinstatus : updatedUser.pinstatus,
                  })
                );
              }
            }
          }
          window.dispatchEvent(
            new CustomEvent('vestexa_user_updated', { detail: { userId: updatedUser.id, user: updatedUser } })
          );
          window.dispatchEvent(new CustomEvent('storage'));
        },
        (updatedAdmin, eventType) => {
          const rawAdmins = localStorage.getItem('vestexa_admins');
          let admins = rawAdmins ? JSON.parse(rawAdmins) : [];
          if (eventType === 'DELETE') {
            admins = admins.filter(
              (a: any) => a.id !== updatedAdmin.id && a.email.toLowerCase().trim() !== updatedAdmin.email.toLowerCase().trim()
            );
          } else {
            const idx = admins.findIndex(
              (a: any) => a.id === updatedAdmin.id || a.email.toLowerCase().trim() === updatedAdmin.email.toLowerCase().trim()
            );
            if (idx !== -1) {
              admins[idx] = { ...admins[idx], ...updatedAdmin };
            } else {
              admins.push(updatedAdmin);
            }
          }
          localStorage.setItem('vestexa_admins', JSON.stringify(admins));
          window.dispatchEvent(new CustomEvent('vestexa_admins_updated', { detail: { admin: updatedAdmin } }));
          window.dispatchEvent(new CustomEvent('storage'));
        }
      );
    } catch (e) {
      console.warn('[syncEngine] Error setting up Supabase Realtime:', e);
    }
  }

  // 3. Fallback EventSource for local Vite dev server SSE
  const connectSSE = () => {
    if (typeof EventSource === 'undefined') return;

    try {
      if (eventSource) {
        eventSource.close();
      }

      eventSource = new EventSource('/api/storage/events');

      eventSource.onmessage = (event) => {
        try {
          const data = JSON.parse(event.data);
          if (data.type === 'connected') return;

          if (data.type === 'balance_updated') {
            const rawUsers = localStorage.getItem('vestexa_users');
            if (rawUsers) {
              const users = JSON.parse(rawUsers);
              const idx = users.findIndex(
                (u: any) => u.id === data.userId
              );
              if (idx !== -1) {
                users[idx].balance = data.balance;
                localStorage.setItem('vestexa_users', JSON.stringify(users));

                const rawCurrent = localStorage.getItem('vestexa_current_user');
                if (rawCurrent) {
                  const current = JSON.parse(rawCurrent);
                  if (current.id === users[idx].id) {
                    current.balance = data.balance;
                    localStorage.setItem('vestexa_current_user', JSON.stringify(current));
                  }
                }
              }
            }
            window.dispatchEvent(new CustomEvent('vestexa_user_updated', { detail: { userId: data.userId } }));
            window.dispatchEvent(new CustomEvent('storage'));
          } else if (data.type === 'restriction_updated') {
            const rawUsers = localStorage.getItem('vestexa_users');
            if (rawUsers) {
              const users = JSON.parse(rawUsers);
              const idSet = new Set(data.userIds);
              const updatedUsers = users.map((u: any) => {
                const isTarget = idSet.has(u.id);
                if (isTarget) {
                  if (data.isRestricted) {
                    return {
                      ...u,
                      isRestricted: true,
                      restrictionHeader: data.header || u.restrictionHeader,
                      restrictionReason: data.reason || u.restrictionReason,
                      restrictedAt: data.restrictedAt || new Date().toISOString(),
                      restrictedBy: data.restrictedBy || 'Compliance Admin',
                      restrictionRef: u.restrictionRef || `VX-RST-${Math.floor(10000 + Math.random() * 90000)}`,
                    };
                  } else {
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
                }
                return u;
              });
              localStorage.setItem('vestexa_users', JSON.stringify(updatedUsers));

              const rawCurrent = localStorage.getItem('vestexa_current_user');
              if (rawCurrent) {
                const current = JSON.parse(rawCurrent);
                const matching = updatedUsers.find(
                  (u: any) => u.id === current.id
                );
                if (matching) {
                  localStorage.setItem(
                    'vestexa_current_user',
                    JSON.stringify({
                      ...matching,
                      pinstatus: current.pinstatus !== undefined ? current.pinstatus : matching.pinstatus,
                    })
                  );
                }
              }
            }
            window.dispatchEvent(new CustomEvent('vestexa_user_updated', { detail: { userIds: data.userIds } }));
            window.dispatchEvent(new CustomEvent('storage'));
          } else if (data.type === 'user_updated' || data.type === 'storage_synced') {
            fetchServerStorage().then((latest) => {
              if (latest) applyServerStorageToLocal(latest);
            });
          }
        } catch {
          // ignore
        }
      };

      eventSource.onerror = () => {
        if (eventSource) {
          eventSource.close();
          eventSource = null;
        }
        setTimeout(connectSSE, 4000);
      };
    } catch {
      // EventSource fallback
    }
  };

  connectSSE();

  // 4. Background polling fallback (every 5s)
  setInterval(() => {
    if (document.visibilityState === 'visible' && !isSyncing) {
      isSyncing = true;
      fetchServerStorage()
        .then((latest) => {
          isSyncing = false;
          if (latest) applyServerStorageToLocal(latest);
        })
        .catch(() => {
          isSyncing = false;
        });
    }
  }, 5000);
}
