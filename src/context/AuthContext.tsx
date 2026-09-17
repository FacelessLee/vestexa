import React, { createContext, useContext, useState, useEffect, useCallback } from 'react';
import type { User, Admin } from '../lib/storage';
import {
  getCurrentUser,
  setCurrentUser,
  getCurrentAdmin,
  setCurrentAdmin,
  authenticateUser,
  authenticateAdmin,
  getUserById,
  verifyUserPin,
  broadcastUserUpdate,
} from '../lib/storage';

interface AuthContextType {
  user: User | null;
  admin: Admin | null;
  loginUser: (email: string, password: string) => User | null;
  verifyPin: (pin: string) => { success: boolean; message: string };
  loginAdmin: (email: string, password: string) => Admin | null;
  logoutUser: () => void;
  logoutAdmin: () => void;
  refreshUser: () => void;
}

const AuthContext = createContext<AuthContextType | null>(null);

export function AuthProvider({ children }: { children: React.ReactNode }) {
  const [user, setUser] = useState<User | null>(() => getCurrentUser());
  const [admin, setAdmin] = useState<Admin | null>(() => getCurrentAdmin());

  const refreshUser = useCallback(() => {
    const current = getCurrentUser();
    if (current && current.id) {
      const fresh = getUserById(current.id);
      if (fresh) {
        const merged: User = {
          ...fresh,
          pinstatus: current.pinstatus !== undefined ? current.pinstatus : fresh.pinstatus,
        };
        setCurrentUser(merged);
        setUser(merged);
      }
    } else {
      setUser(null);
    }
  }, []);

  useEffect(() => {
    setUser(getCurrentUser());
    setAdmin(getCurrentAdmin());

    const handleUpdate = () => {
      refreshUser();
      setAdmin(getCurrentAdmin());
    };

    window.addEventListener('vestexa_user_updated', handleUpdate);
    window.addEventListener('storage', handleUpdate);

    let bc: BroadcastChannel | null = null;
    try {
      if (typeof BroadcastChannel !== 'undefined') {
        bc = new BroadcastChannel('vestexa_channel');
        bc.onmessage = (event) => {
          if (event.data?.type === 'user_updated' || event.data?.type === 'session_updated') {
            handleUpdate();
          }
        };
      }
    } catch {
      // ignore
    }

    return () => {
      window.removeEventListener('vestexa_user_updated', handleUpdate);
      window.removeEventListener('storage', handleUpdate);
      if (bc) {
        bc.close();
      }
    };
  }, [refreshUser]);

  const loginUser = useCallback((email: string, password: string): User | null => {
    const u = authenticateUser(email, password);
    if (u) {
      setCurrentUser(u);
      setUser(u);
      broadcastUserUpdate(u.id);
    }
    return u;
  }, []);

  const verifyPin = useCallback((pin: string): { success: boolean; message: string } => {
    const currentUser = getCurrentUser();
    if (!currentUser) {
      return { success: false, message: 'No active session. Please sign in.' };
    }
    const res = verifyUserPin(currentUser.id, pin);
    if (res.success) {
      const updated = getUserById(currentUser.id);
      if (updated) {
        const fresh = { ...updated, pinstatus: 0 };
        setCurrentUser(fresh);
        setUser(fresh);
        broadcastUserUpdate(fresh.id);
      }
    }
    return res;
  }, []);

  const loginAdmin = useCallback((email: string, password: string): Admin | null => {
    const a = authenticateAdmin(email, password);
    if (a) {
      setCurrentAdmin(a);
      setAdmin(a);
    }
    return a;
  }, []);

  const logoutUser = useCallback(() => {
    setCurrentUser(null);
    setUser(null);
    broadcastUserUpdate();
  }, []);

  const logoutAdmin = useCallback(() => {
    setCurrentAdmin(null);
    setAdmin(null);
  }, []);

  return (
    <AuthContext.Provider value={{ user, admin, loginUser, verifyPin, loginAdmin, logoutUser, logoutAdmin, refreshUser }}>
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth(): AuthContextType {
  const ctx = useContext(AuthContext);
  if (!ctx) throw new Error('useAuth must be used within AuthProvider');
  return ctx;
}
