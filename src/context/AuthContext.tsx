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

  useEffect(() => {
    setUser(getCurrentUser());
    setAdmin(getCurrentAdmin());
  }, []);

  const loginUser = useCallback((email: string, password: string): User | null => {
    const u = authenticateUser(email, password);
    if (u) {
      setCurrentUser(u);
      setUser(u);
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
  }, []);

  const logoutAdmin = useCallback(() => {
    setCurrentAdmin(null);
    setAdmin(null);
  }, []);

  const refreshUser = useCallback(() => {
    const current = getCurrentUser();
    if (current) {
      const fresh = getUserById(current.id);
      if (fresh) {
        setCurrentUser(fresh);
        setUser(fresh);
      }
    }
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
