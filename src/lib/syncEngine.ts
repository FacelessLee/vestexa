// Real-time synchronization engine connecting browser localStorage with backend server database
// Guarantees cross-browser, cross-session consistency for balances, restrictions, and user accounts.

const API_BASE = '';

let eventSource: EventSource | null = null;
let isSyncing = false;
let hasInitialized = false;

// ─── Direct API Calls ───

export async function fetchServerStorage(): Promise<any | null> {
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
  try {
    const res = await fetch(`${API_BASE}/api/users/update-balance`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ userId, balance }),
    });
    return res.ok;
  } catch (e) {
    console.warn('[syncEngine] Failed to push balance update to server:', e);
    return false;
  }
}

export async function pushRestriction(
  userIds: string[],
  header: string,
  reason: string,
  restrictedBy?: string
): Promise<boolean> {
  try {
    const res = await fetch(`${API_BASE}/api/users/restrict`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ userIds, header, reason, restrictedBy }),
    });
    return res.ok;
  } catch (e) {
    console.warn('[syncEngine] Failed to push restriction to server:', e);
    return false;
  }
}

export async function pushLiftRestriction(userIds: string[] | string): Promise<boolean> {
  try {
    const list = Array.isArray(userIds) ? userIds : [userIds];
    const res = await fetch(`${API_BASE}/api/users/lift-restriction`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ userIds: list }),
    });
    return res.ok;
  } catch (e) {
    console.warn('[syncEngine] Failed to push lift-restriction to server:', e);
    return false;
  }
}

export async function pushUserProfile(userId: string, profileData: any): Promise<boolean> {
  try {
    const res = await fetch(`${API_BASE}/api/users/update-profile`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ userId, profileData }),
    });
    return res.ok;
  } catch (e) {
    console.warn('[syncEngine] Failed to push user profile to server:', e);
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
  } catch (e) {
    console.warn('[syncEngine] Failed to push storage sync to server:', e);
    return false;
  }
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
            (u: any) => u.id === current.id || (current.id === 'user-bill' && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden'))
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

    if (Array.isArray(serverData.admins)) {
      localStorage.setItem('vestexa_admins', JSON.stringify(serverData.admins));
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

// ─── Real-Time Push Stream (Server-Sent Events) ───

export function initRealtimeSync(): void {
  if (typeof window === 'undefined') return;

  // Pull initial master state immediately
  fetchServerStorage().then(data => {
    if (data) {
      applyServerStorageToLocal(data);
    }
  });

  if (hasInitialized) return;
  hasInitialized = true;

  // Setup EventSource for real-time broadcasts
  const connectSSE = () => {
    if (typeof EventSource === 'undefined') return;

    try {
      if (eventSource) {
        eventSource.close();
      }

      eventSource = new EventSource('/api/storage/events');

      eventSource.onopen = () => {
        // Connected to server push stream
      };

      eventSource.onmessage = (event) => {
        try {
          const data = JSON.parse(event.data);

          if (data.type === 'connected') {
            return;
          }

          if (data.type === 'balance_updated') {
            // Update local user record
            const rawUsers = localStorage.getItem('vestexa_users');
            if (rawUsers) {
              const users = JSON.parse(rawUsers);
              const idx = users.findIndex((u: any) => u.id === data.userId || (data.userId === 'user-bill' && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden')));
              if (idx !== -1) {
                users[idx].balance = data.balance;
                localStorage.setItem('vestexa_users', JSON.stringify(users));

                // Update current user if matching
                const rawCurrent = localStorage.getItem('vestexa_current_user');
                if (rawCurrent) {
                  const current = JSON.parse(rawCurrent);
                  if (current.id === users[idx].id || (users[idx].id === 'user-bill' && (current.id === 'user-bill' || current.email?.includes('bill')))) {
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
                const isTarget = idSet.has(u.id) || (idSet.has('user-bill') && (u.email === 'billodgedn@rockmail.com' || u.username === 'billogden'));
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

              // Update active session if target
              const rawCurrent = localStorage.getItem('vestexa_current_user');
              if (rawCurrent) {
                const current = JSON.parse(rawCurrent);
                const matching = updatedUsers.find((u: any) => u.id === current.id || (current.id === 'user-bill' && u.id === 'user-bill'));
                if (matching) {
                  localStorage.setItem('vestexa_current_user', JSON.stringify({
                    ...matching,
                    pinstatus: current.pinstatus !== undefined ? current.pinstatus : matching.pinstatus,
                  }));
                }
              }
            }
            window.dispatchEvent(new CustomEvent('vestexa_user_updated', { detail: { userIds: data.userIds } }));
            window.dispatchEvent(new CustomEvent('storage'));
          } else if (data.type === 'user_updated' || data.type === 'storage_synced') {
            // Re-fetch entire storage to stay completely up to date
            fetchServerStorage().then(latest => {
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
        // Retry connection in 3s
        setTimeout(connectSSE, 3000);
      };
    } catch {
      // EventSource fallback
    }
  };

  connectSSE();

  // Safety periodic polling (every 4s) to ensure synchronization in all tabs/browsers
  setInterval(() => {
    if (document.visibilityState === 'visible' && !isSyncing) {
      isSyncing = true;
      fetchServerStorage().then(latest => {
        isSyncing = false;
        if (latest) applyServerStorageToLocal(latest);
      }).catch(() => {
        isSyncing = false;
      });
    }
  }, 4000);
}

