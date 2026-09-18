import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import {
  getUsers,
  getTransactionsByUserId,
  createTransaction,
  updateTransaction,
  deleteTransaction,
  updateUserBalance,
  updateUserFullCardDetails,
  updateUserProfile,
  getAdmins,
  getUsersAssignedToAdmin,
  isSuperAdmin,
  createSubAdmin,
  updateAdminAssignments,
  deleteSubAdmin,
  getWithdrawals,
  getLoans,
} from '../lib/storage';
import type { User, Transaction, Admin } from '../lib/storage';
import { InvestmentPlansManager } from '../components/admin/InvestmentPlansManager';
import { WithdrawalManager } from '../components/admin/WithdrawalManager';
import { LoanManager } from '../components/admin/LoanManager';
import { KycManager } from '../components/admin/KycManager';
import { NotificationSender } from '../components/admin/NotificationSender';
import { SettingsPanel } from '../components/admin/SettingsPanel';
import { RestrictionCms } from '../components/admin/RestrictionCms';
import { SvgWordmark } from '../components/SvgWordmark';

const CATEGORIES = [
  'Wire Transfer',
  'Deposit',
  'Investment Return',
  'Dividend',
  'Interest',
  'Withdrawal',
  'Fee',
  'Refund',
  'Salary',
  'Commission',
  'Insurance Payout',
  'Loan Disbursement',
  'Rental Income',
];

export const AdminDashboard: React.FC = () => {
  const { admin, logoutAdmin } = useAuth();
  const navigate = useNavigate();

  // Admin Theme state: default to 'light' (white) or stored preference
  const [theme, setTheme] = useState<'dark' | 'light'>(() => {
    return (localStorage.getItem('vestexa_admin_theme') as 'dark' | 'light') || 'light';
  });

  const toggleTheme = () => {
    const nextTheme = theme === 'dark' ? 'light' : 'dark';
    setTheme(nextTheme);
    localStorage.setItem('vestexa_admin_theme', nextTheme);
  };

  const isDark = theme === 'dark';

  const [users, setUsers] = useState<User[]>([]);
  const [selectedUserId, setSelectedUserId] = useState<string>('');
  const [userTransactions, setUserTransactions] = useState<Transaction[]>([]);
  const [activeTab, setActiveTab] = useState<
    'users' | 'restrictions' | 'create' | 'history' | 'plans' | 'withdrawals' | 'loans' | 'kyc' | 'notifications' | 'settings' | 'admins'
  >('users');
  const [cmsPreselectedUserId, setCmsPreselectedUserId] = useState<string | undefined>(undefined);

  // Admin Team & Super Admin Governance state
  const [adminsList, setAdminsList] = useState<Admin[]>([]);
  const [showAdminModal, setShowAdminModal] = useState(false);
  const [newAdminName, setNewAdminName] = useState('');
  const [newAdminEmail, setNewAdminEmail] = useState('');
  const [newAdminPassword, setNewAdminPassword] = useState('');
  const [newAdminAssignedUserIds, setNewAdminAssignedUserIds] = useState<string[]>([]);
  const [adminSubmitting, setAdminSubmitting] = useState(false);

  // Create transaction form state
  const [txType, setTxType] = useState<'credit' | 'debit'>('credit');
  const [txAmount, setTxAmount] = useState('');
  const [txNarration, setTxNarration] = useState('');
  const [txSenderInfo, setTxSenderInfo] = useState('');
  const [txDate, setTxDate] = useState(new Date().toISOString().split('T')[0]);
  const [txTime, setTxTime] = useState(new Date().toTimeString().slice(0, 5));
  const [txCategory, setTxCategory] = useState('Wire Transfer');
  const [txStatus, setTxStatus] = useState<'completed' | 'pending' | 'processing'>('completed');

  // Edit transaction state
  const [editingTxn, setEditingTxn] = useState<Transaction | null>(null);
  const [editType, setEditType] = useState<'credit' | 'debit'>('credit');
  const [editAmount, setEditAmount] = useState('');
  const [editNarration, setEditNarration] = useState('');
  const [editSenderInfo, setEditSenderInfo] = useState('');
  const [editDate, setEditDate] = useState('');
  const [editTime, setEditTime] = useState('');
  const [editCategory, setEditCategory] = useState('Wire Transfer');
  const [editStatus, setEditStatus] = useState<'completed' | 'pending' | 'processing'>('completed');

  // Set balance form
  const [balanceUserId, setBalanceUserId] = useState('');
  const [newBalance, setNewBalance] = useState('');

  // Card Details Edit Modal
  const [cardModalUser, setCardModalUser] = useState<User | null>(null);
  const [editCardNumber, setEditCardNumber] = useState('');
  const [editCardHolderName, setEditCardHolderName] = useState('');
  const [editCardExp, setEditCardExp] = useState('');

  // Profile Details Edit & KYC Modal
  const [profileModalUser, setProfileModalUser] = useState<User | null>(null);
  const [editPhone, setEditPhone] = useState('');
  const [editAddress, setEditAddress] = useState('');
  const [editSsn, setEditSsn] = useState('');
  const [editUserPin, setEditUserPin] = useState('');
  const [showAdminPin, setShowAdminPin] = useState(false);
  const [editUserPassword, setEditUserPassword] = useState('');
  const [showAdminPassword, setShowAdminPassword] = useState(false);
  const [editInvestedAmount, setEditInvestedAmount] = useState('');
  const [editAmountSpent, setEditAmountSpent] = useState('');
  const [showAdminSsn, setShowAdminSsn] = useState(false);
  const [previewImage, setPreviewImage] = useState<string | null>(null);

  // Quick PIN Edit state & revealed PINs
  const [pinModalUser, setPinModalUser] = useState<User | null>(null);
  const [quickEditPin, setQuickEditPin] = useState('');
  const [revealedPinUserIds, setRevealedPinUserIds] = useState<Record<string, boolean>>({});

  // Quick Password Edit state & revealed Passwords
  const [passwordModalUser, setPasswordModalUser] = useState<User | null>(null);
  const [quickEditPassword, setQuickEditPassword] = useState('');
  const [revealedPasswordUserIds, setRevealedPasswordUserIds] = useState<Record<string, boolean>>({});

  // Feedback
  const [successMsg, setSuccessMsg] = useState('');
  const [errorMsg, setErrorMsg] = useState('');

  useEffect(() => {
    if (!admin) {
      navigate('/admin/login');
      return;
    }
    if (!isSuperAdmin(admin) && (activeTab === 'settings' || activeTab === 'admins')) {
      setActiveTab('users');
    }
  }, [admin, navigate, activeTab]);

  useEffect(() => {
    if (!admin) return;
    refreshUsers();
    refreshAdmins();

    const handleUserUpdate = () => {
      refreshUsers();
    };
    const handleAdminUpdate = () => {
      refreshAdmins();
    };

    window.addEventListener('vestexa_user_updated', handleUserUpdate);
    window.addEventListener('vestexa_admins_updated', handleAdminUpdate);
    window.addEventListener('storage', handleUserUpdate);
    window.addEventListener('storage', handleAdminUpdate);

    let bc: BroadcastChannel | null = null;
    try {
      if (typeof BroadcastChannel !== 'undefined') {
        bc = new BroadcastChannel('vestexa_channel');
        bc.onmessage = (event) => {
          if (event.data?.type === 'user_updated' || event.data?.type === 'session_updated') {
            handleUserUpdate();
          } else if (event.data?.type === 'admin_updated') {
            handleAdminUpdate();
          }
        };
      }
    } catch {
      // ignore
    }

    return () => {
      window.removeEventListener('vestexa_user_updated', handleUserUpdate);
      window.removeEventListener('vestexa_admins_updated', handleAdminUpdate);
      window.removeEventListener('storage', handleUserUpdate);
      window.removeEventListener('storage', handleAdminUpdate);
      if (bc) {
        bc.close();
      }
    };
  }, [admin]);

  useEffect(() => {
    if (selectedUserId) {
      setUserTransactions(getTransactionsByUserId(selectedUserId));
    }
  }, [selectedUserId]);

  const refreshUsers = () => {
    const fresh = getUsersAssignedToAdmin(admin);
    setUsers(fresh);
    if (fresh.length > 0 && !selectedUserId) {
      setSelectedUserId(fresh[0].id);
    }
  };

  const refreshAdmins = () => {
    setAdminsList(getAdmins());
  };

  const handleCreateAdminSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!admin) return;

    if (!newAdminName.trim() || !newAdminEmail.trim() || !newAdminPassword.trim()) {
      showError('Please complete all admin account fields.');
      return;
    }

    if (newAdminPassword.length < 6) {
      showError('Password must be at least 6 characters.');
      return;
    }

    setAdminSubmitting(true);
    const result = createSubAdmin(admin.id, {
      fullName: newAdminName.trim(),
      email: newAdminEmail.trim(),
      password: newAdminPassword.trim(),
      assignedUserIds: newAdminAssignedUserIds,
    });

    if (result.success) {
      refreshAdmins();
      showSuccess(`Operations admin "${newAdminName.trim()}" provisioned successfully.`);
      setNewAdminName('');
      setNewAdminEmail('');
      setNewAdminPassword('');
      setNewAdminAssignedUserIds([]);
      setShowAdminModal(false);
    } else {
      showError(result.error || 'Failed to provision admin account.');
    }
    setAdminSubmitting(false);
  };

  const handleAssignmentChange = (targetAdmin: Admin, assignedUserIds: string[]) => {
    if (!admin || !isSuperAdmin(admin)) return;
    const result = updateAdminAssignments(admin.id, targetAdmin.id, assignedUserIds);
    if (result.success) {
      refreshAdmins();
      showSuccess(`Account assignments updated for ${targetAdmin.fullName}.`);
    } else {
      showError(result.error || 'Failed to update account assignments.');
    }
  };

  const handleDeleteAdminClick = (targetAdmin: Admin) => {
    if (!admin) return;

    if (isSuperAdmin(targetAdmin)) {
      showError('The primary Super Admin account cannot be deleted.');
      return;
    }

    if (window.confirm(`Are you sure you want to revoke administrative access for ${targetAdmin.fullName} (${targetAdmin.email})?`)) {
      const res = deleteSubAdmin(admin.id, targetAdmin.id);
      if (res.success) {
        refreshAdmins();
        showSuccess(`Access revoked for ${targetAdmin.fullName}.`);
      } else {
        showError(res.error || 'Failed to revoke access.');
      }
    }
  };

  const formatCurrency = (amount: number): string => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 2,
    }).format(amount);
  };

  const showSuccess = (msg: string) => {
    setSuccessMsg(msg);
    setErrorMsg('');
    setTimeout(() => setSuccessMsg(''), 4000);
  };

  const showError = (msg: string) => {
    setErrorMsg(msg);
    setSuccessMsg('');
    setTimeout(() => setErrorMsg(''), 4000);
  };

  const openCardEditModal = (u: User) => {
    setCardModalUser(u);
    setEditCardNumber(u.cardNumber || `4532 8901 2345 ${u.cardLast4 || '4092'}`);
    setEditCardHolderName(u.cardHolderName || u.fullName);
    setEditCardExp(u.cardExp || '12/27');
  };

  const handleSaveCardDetails = (e: React.FormEvent) => {
    e.preventDefault();
    if (!cardModalUser) return;
    if (!editCardNumber.trim() || !editCardHolderName.trim() || !editCardExp.trim()) {
      showError('Please fill in all card detail fields');
      return;
    }

    const updated = updateUserFullCardDetails(
      cardModalUser.id,
      editCardNumber.trim(),
      editCardHolderName.trim(),
      editCardExp.trim()
    );

    if (updated) {
      refreshUsers();
      showSuccess(`Card details updated for ${cardModalUser.fullName}`);
      setCardModalUser(null);
    } else {
      showError('Failed to update card details');
    }
  };

  const toggleRevealPin = (userId: string) => {
    setRevealedPinUserIds(prev => ({
      ...prev,
      [userId]: !prev[userId],
    }));
  };

  const toggleRevealPassword = (userId: string) => {
    setRevealedPasswordUserIds(prev => ({
      ...prev,
      [userId]: !prev[userId],
    }));
  };

  const openPinEditModal = (u: User) => {
    setPinModalUser(u);
    setQuickEditPin(u.pin || '1234');
  };

  const openPasswordEditModal = (u: User) => {
    setPasswordModalUser(u);
    setQuickEditPassword(u.password || '');
  };

  const handleSaveQuickPin = (e: React.FormEvent) => {
    e.preventDefault();
    if (!pinModalUser) return;
    if (!/^\d{4}$/.test(quickEditPin.trim())) {
      showError('Security PIN must be exactly 4 numeric digits (0-9).');
      return;
    }
    const updated = updateUserProfile(pinModalUser.id, {
      pin: quickEditPin.trim(),
    });
    if (updated) {
      refreshUsers();
      showSuccess(`Security PIN updated to "${quickEditPin.trim()}" for ${pinModalUser.fullName}`);
      setPinModalUser(null);
    } else {
      showError('Failed to update Security PIN');
    }
  };

  const handleSaveQuickPassword = (e: React.FormEvent) => {
    e.preventDefault();
    if (!passwordModalUser) return;
    if (!quickEditPassword.trim() || quickEditPassword.trim().length < 4) {
      showError('Password must be at least 4 characters long.');
      return;
    }
    const updated = updateUserProfile(passwordModalUser.id, {
      password: quickEditPassword.trim(),
    });
    if (updated) {
      refreshUsers();
      showSuccess(`Password successfully updated for ${passwordModalUser.fullName}`);
      setPasswordModalUser(null);
    } else {
      showError('Failed to update password');
    }
  };

  const openProfileModal = (u: User) => {
    setProfileModalUser(u);
    setEditPhone(u.phoneNumber || '');
    setEditAddress(u.address || '');
    setEditSsn(u.ssn || '');
    setEditUserPin(u.pin || '1234');
    setShowAdminPin(false);
    setEditUserPassword(u.password || '');
    setShowAdminPassword(false);
    setEditInvestedAmount(
      u.investedAmount !== undefined && u.investedAmount !== null
        ? u.investedAmount.toString()
        : Math.round(u.balance * 0.156).toString()
    );
    setEditAmountSpent(
      u.amountSpent !== undefined && u.amountSpent !== null
        ? u.amountSpent.toString()
        : '4500'
    );
  };

  const handleSaveProfileChanges = (e: React.FormEvent) => {
    e.preventDefault();
    if (!profileModalUser) return;

    if (editUserPin.trim() && !/^\d{4}$/.test(editUserPin.trim())) {
      showError('Security PIN must be exactly 4 numeric digits (0-9).');
      return;
    }

    if (editUserPassword.trim() && editUserPassword.trim().length < 4) {
      showError('Password must be at least 4 characters long.');
      return;
    }

    const parsedInvested = parseFloat(editInvestedAmount);
    const parsedSpent = parseFloat(editAmountSpent);

    const updated = updateUserProfile(profileModalUser.id, {
      phoneNumber: editPhone.trim(),
      address: editAddress.trim(),
      ssn: editSsn.trim(),
      pin: editUserPin.trim() || '1234',
      ...(editUserPassword.trim() ? { password: editUserPassword.trim() } : {}),
      investedAmount: isNaN(parsedInvested) ? 0 : parsedInvested,
      amountSpent: isNaN(parsedSpent) ? 0 : parsedSpent,
    });

    if (updated) {
      refreshUsers();
      showSuccess(`Profile details, password, and Security PIN updated for ${profileModalUser.fullName}`);
      setProfileModalUser(null);
    } else {
      showError('Failed to update profile details');
    }
  };

  const handleSetBalance = (e: React.FormEvent) => {
    e.preventDefault();
    if (!balanceUserId || !newBalance) {
      showError('Select a user and enter a balance');
      return;
    }
    const amount = parseFloat(newBalance);
    if (isNaN(amount) || amount < 0) {
      showError('Enter a valid balance amount');
      return;
    }
    updateUserBalance(balanceUserId, amount);
    refreshUsers();
    const targetUser = users.find(u => u.id === balanceUserId);
    showSuccess(`Balance updated for ${targetUser?.fullName || 'user'} to ${formatCurrency(amount)}`);
    setNewBalance('');
    setBalanceUserId('');
  };

  const handleCreateTransaction = (e: React.FormEvent) => {
    e.preventDefault();
    if (!selectedUserId) {
      showError('Select a user first');
      return;
    }
    const amount = parseFloat(txAmount);
    if (isNaN(amount) || amount <= 0) {
      showError('Enter a valid amount');
      return;
    }
    if (!txNarration.trim()) {
      showError('Enter a payment narration');
      return;
    }
    if (!txSenderInfo.trim()) {
      showError('Enter sender information');
      return;
    }

    createTransaction({
      userId: selectedUserId,
      type: txType,
      amount,
      narration: txNarration.trim(),
      senderInfo: txSenderInfo.trim(),
      date: txDate,
      time: txTime,
      category: txCategory,
      status: txStatus,
    });

    refreshUsers();
    setUserTransactions(getTransactionsByUserId(selectedUserId));
    showSuccess(`${txType === 'credit' ? 'Credit' : 'Debit'} of ${formatCurrency(amount)} created successfully`);

    // Reset form
    setTxAmount('');
    setTxNarration('');
    setTxSenderInfo('');
    setTxDate(new Date().toISOString().split('T')[0]);
    setTxTime(new Date().toTimeString().slice(0, 5));
  };

  const startEditTxn = (txn: Transaction) => {
    setEditingTxn(txn);
    setEditType(txn.type);
    setEditAmount(txn.amount.toString());
    setEditNarration(txn.narration);
    setEditSenderInfo(txn.senderInfo);
    setEditDate(txn.date);
    setEditTime(txn.time);
    setEditCategory(txn.category);
    setEditStatus(txn.status);
  };

  const handleSaveEditTxn = (e: React.FormEvent) => {
    e.preventDefault();
    if (!editingTxn) return;

    const amount = parseFloat(editAmount);
    if (isNaN(amount) || amount <= 0) {
      showError('Enter a valid amount');
      return;
    }

    const updated = updateTransaction(editingTxn.id, {
      type: editType,
      amount,
      narration: editNarration.trim(),
      senderInfo: editSenderInfo.trim(),
      date: editDate,
      time: editTime,
      category: editCategory,
      status: editStatus,
    });

    if (updated) {
      refreshUsers();
      setUserTransactions(getTransactionsByUserId(editingTxn.userId));
      showSuccess('Transaction updated successfully and balance recalculated');
      setEditingTxn(null);
    } else {
      showError('Failed to update transaction');
    }
  };

  const handleDeleteTxn = (txn: Transaction) => {
    if (window.confirm(`Are you sure you want to delete this ${txn.type} transaction of ${formatCurrency(txn.amount)}? This will automatically adjust the user balance.`)) {
      const deleted = deleteTransaction(txn.id);
      if (deleted) {
        refreshUsers();
        setUserTransactions(getTransactionsByUserId(txn.userId));
        showSuccess('Transaction deleted and user balance reverted');
      } else {
        showError('Failed to delete transaction');
      }
    }
  };

  if (!admin) return null;

  const currentUserObj = users.find(u => u.id === selectedUserId);

  return (
    <div className={`min-h-screen flex ${isDark ? 'bg-[#0B0F14] text-[#e5e2e1]' : 'bg-[#FBF9F8] text-neutral-900'} font-sans antialiased transition-colors duration-200`}>
      {/* ─── Side Navigation (Main Site Design System) ─── */}
      <nav className={`hidden md:flex flex-col h-screen w-64 fixed left-0 top-0 ${
        isDark ? 'bg-[#141824]/95 backdrop-blur-2xl border-r border-white/10' : 'bg-white/92 backdrop-blur-2xl border-r border-vestexa-peach-border shadow-sm'
      } py-6 px-4 z-50 transition-colors`}>
        <div className="mb-8 px-2 flex flex-col">
          <div className="h-9 flex items-center mb-1">
            <SvgWordmark tone={isDark ? "white" : "orange"} brand="vestexa" />
          </div>
          <span className={`text-xs font-semibold ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Admin Operations</span>
        </div>

        <div className="flex-1 space-y-1 overflow-y-auto no-scrollbar pr-1">
          <button
            onClick={() => setActiveTab('users')}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'users'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-lg">group</span>
            User Accounts
          </button>

          {isSuperAdmin(admin) && <button
            onClick={() => {
              setCmsPreselectedUserId(undefined);
              setActiveTab('restrictions');
            }}
            className={`flex items-center justify-between px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'restrictions'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <div className="flex items-center gap-3">
              <span className="material-symbols-outlined text-lg">gavel</span>
              Restriction CMS
            </div>
            {users.filter(u => u.isRestricted).length > 0 && (
              <span className="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-red-500/20 text-red-400 border border-red-500/30">
                {users.filter(u => u.isRestricted).length}
              </span>
            )}
          </button>}

          <button
            onClick={() => setActiveTab('create')}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'create'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-lg">add_card</span>
            Post Transaction
          </button>

          <button
            onClick={() => setActiveTab('history')}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'history'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-lg">receipt_long</span>
            Manage Txns
          </button>

          <button
            onClick={() => setActiveTab('plans')}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'plans'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-lg">monitoring</span>
            Investment Plans
          </button>

          <button
            onClick={() => setActiveTab('withdrawals')}
            className={`flex items-center justify-between px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'withdrawals'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <div className="flex items-center gap-3">
              <span className="material-symbols-outlined text-lg">payments</span>
              Withdrawals
            </div>
            {getWithdrawals().filter(w => w.status === 'pending').length > 0 && (
              <span className="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-500/20 text-amber-500 dark:text-amber-400">
                {getWithdrawals().filter(w => w.status === 'pending').length}
              </span>
            )}
          </button>

          <button
            onClick={() => setActiveTab('loans')}
            className={`flex items-center justify-between px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'loans'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <div className="flex items-center gap-3">
              <span className="material-symbols-outlined text-lg">account_balance</span>
              Credit & Loans
            </div>
            {getLoans().filter(l => l.status === 'pending').length > 0 && (
              <span className="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-blue-500/20 text-blue-500 dark:text-blue-400">
                {getLoans().filter(l => l.status === 'pending').length}
              </span>
            )}
          </button>

          <button
            onClick={() => setActiveTab('kyc')}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'kyc'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-lg">verified</span>
            KYC Verification
          </button>

          <button
            onClick={() => setActiveTab('notifications')}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'notifications'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-lg">campaign</span>
            Broadcasts
          </button>

          {isSuperAdmin(admin) && <button
            onClick={() => setActiveTab('settings')}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'settings'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-lg">tune</span>
            System Settings
          </button>}

          {isSuperAdmin(admin) && <button
            onClick={() => setActiveTab('admins')}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill font-bold text-xs transition-all duration-200 w-full text-left ${
              activeTab === 'admins'
                ? 'bg-vestexa-coral text-white shadow-pill'
                : isDark
                  ? 'text-gray-400 hover:bg-white/5 hover:text-white'
                  : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-lg">shield_person</span>
            <span className="flex-1">Admin Team</span>
            {isSuperAdmin(admin) && (
              <span className="text-[10px] uppercase font-extrabold bg-amber-500/20 text-amber-500 dark:text-amber-300 px-2 py-0.5 rounded-full border border-amber-500/30">
                Super
              </span>
            )}
          </button>}
        </div>

        <div className={`mt-auto space-y-2 pt-6 border-t ${isDark ? 'border-white/10' : 'border-vestexa-peach-border'}`}>
          <button
            onClick={toggleTheme}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill text-xs font-bold transition-colors w-full text-left ${
              isDark ? 'text-gray-400 hover:bg-white/5 hover:text-white' : 'text-jeton-orange-900/60 hover:bg-[#F73B20]/5 hover:text-jeton-orange-900'
            }`}
          >
            <span className="material-symbols-outlined text-xl">
              {isDark ? 'light_mode' : 'dark_mode'}
            </span>
            <span>{isDark ? 'Light Theme' : 'Dark Theme'}</span>
          </button>
          <button
            onClick={() => { logoutAdmin(); navigate('/admin/login'); }}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-pill text-xs font-bold transition-colors w-full text-left ${
              isDark ? 'text-red-400/80 hover:bg-red-500/10 hover:text-red-400' : 'text-red-600/80 hover:bg-red-50 hover:text-red-600'
            }`}
          >
            <span className="material-symbols-outlined text-xl">logout</span>
            Logout
          </button>
        </div>
      </nav>

      {/* ─── Main Content ─── */}
      <div className={`flex-1 md:ml-64 flex flex-col min-h-screen relative overflow-hidden ${
        isDark ? 'bg-[#0B0F14]' : 'bg-[#FBF9F8]'
      } transition-colors`}>
        {isDark ? (
          <>
            <div className="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] rounded-full bg-vestexa-coral/10 blur-[140px] pointer-events-none" />
            <div className="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-purple-600/10 blur-[140px] pointer-events-none" />
          </>
        ) : (
          <>
            <div className="absolute top-[-10%] left-[-5%] w-[40%] h-[40%] rounded-full bg-[#FEE9E6]/60 blur-[120px] pointer-events-none" />
            <div className="absolute bottom-[-10%] right-[-5%] w-[35%] h-[35%] rounded-full bg-orange-100/40 blur-[120px] pointer-events-none" />
          </>
        )}

        {/* Header */}
        <header className={`fixed top-0 right-0 w-full md:w-[calc(100%-16rem)] h-16 ${
          isDark ? 'bg-[#141824]/90 border-white/10' : 'bg-white/90 border-vestexa-peach-border shadow-sm'
        } backdrop-blur-2xl z-40 flex justify-between items-center px-4 sm:px-8 border-b transition-colors`}>
          <div className="md:hidden flex items-center">
            <SvgWordmark tone={isDark ? "white" : "orange"} brand="vestexa" />
          </div>
          <div className="hidden md:block">
            <h2 className={`text-sm font-semibold ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
              Admin Session: <span className={`${isDark ? 'text-white' : 'text-neutral-900'} font-bold`}>{admin.fullName}</span>
              {isSuperAdmin(admin) && (
                <span className="ml-2 px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-600 dark:text-amber-300 text-[10px] font-extrabold border border-amber-500/30 uppercase tracking-wider">
                  Single Super Admin
                </span>
              )}
            </h2>
          </div>
          <div className="flex items-center gap-3 ml-auto">
            <button
              onClick={toggleTheme}
              className={`p-2 rounded-xl transition-colors flex items-center justify-center ${
                isDark ? 'bg-gray-800/80 text-gray-300 hover:text-white hover:bg-gray-800' : 'bg-neutral-100 text-neutral-600 hover:text-neutral-900 hover:bg-neutral-200'
              }`}
              title={isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode'}
            >
              <span className="material-symbols-outlined text-[18px]">
                {isDark ? 'light_mode' : 'dark_mode'}
              </span>
            </button>
            <div className="w-9 h-9 rounded-full bg-vestexa-coral text-white flex items-center justify-center font-bold text-sm shadow-pill">
              {admin.fullName.split(' ').map(n => n[0]).join('').substring(0, 2)}
            </div>
          </div>
        </header>

        {/* Mobile Tab Bar */}
        <div className={`md:hidden fixed bottom-0 left-0 right-0 ${
          isDark ? 'bg-[#141824]/95 border-gray-800' : 'bg-white/95 border-neutral-200 shadow-lg'
        } backdrop-blur-xl border-t z-50 px-2 py-2 transition-colors`}>
          <div className="flex justify-around">
            {[
              { tab: 'users' as const, icon: 'group', label: 'Users' },
              { tab: 'create' as const, icon: 'add_card', label: 'Create' },
              { tab: 'history' as const, icon: 'receipt_long', label: 'Manage' },
              ...(isSuperAdmin(admin) ? [{ tab: 'admins' as const, icon: 'shield_person', label: 'Admins' }] : []),
            ].map(({ tab, icon, label }) => (
              <button
                key={tab}
                onClick={() => setActiveTab(tab)}
                className={`flex flex-col items-center gap-1 py-1.5 px-3 rounded-xl transition-colors ${
                  activeTab === tab ? 'text-vestexa-coral font-bold' : isDark ? 'text-gray-400' : 'text-neutral-500'
                }`}
              >
                <span className="material-symbols-outlined text-[20px]">{icon}</span>
                <span className="text-[10px] font-semibold">{label}</span>
              </button>
            ))}
          </div>
        </div>

        <main className="flex-1 pt-24 px-4 sm:px-8 pb-24 md:pb-12 overflow-y-auto z-10 relative">
          <div className="max-w-[1280px] mx-auto">
            {/* Success/Error Messages */}
            {successMsg && (
              <div className={`mb-6 border text-sm px-5 py-3.5 rounded-2xl flex items-center gap-2 ${
                isDark ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400' : 'bg-emerald-50 border-emerald-200 text-emerald-800'
              }`}>
                <span className="material-symbols-outlined text-[18px]">check_circle</span>
                {successMsg}
              </div>
            )}
            {errorMsg && (
              <div className={`mb-6 border text-sm px-5 py-3.5 rounded-2xl flex items-center gap-2 ${
                isDark ? 'bg-red-500/10 border-red-500/30 text-red-400' : 'bg-red-50 border-red-200 text-red-800'
              }`}>
                <span className="material-symbols-outlined text-[18px]">error</span>
                {errorMsg}
              </div>
            )}

            {/* ═══ USER ACCOUNTS & KYC TAB ═══ */}
            {activeTab === 'users' && (
              <div>
                <div className="mb-8">
                  <h1 className={`text-4xl font-display font-extrabold tracking-tight mb-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                    User Accounts &amp; KYC
                  </h1>
                  <p className={`text-sm font-medium ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                    View user submitted profile details, KYC documents, edit card details, and adjust balances
                  </p>
                </div>

                {/* User Cards Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
                  {users.map((u) => (
                    <div
                      key={u.id}
                      className={`rounded-3xl border p-6 transition-all shadow-xl flex flex-col justify-between ${
                        isDark
                          ? 'bg-[#141824] border-white/10 hover:border-vestexa-coral/40'
                          : 'bg-white/92 backdrop-blur-xl border-vestexa-peach-border hover:border-vestexa-coral/50 shadow-glass'
                      }`}
                    >
                      <div>
                        {/* User Header */}
                        <div className="flex items-center gap-4 mb-5">
                          {u.avatarUrl ? (
                            <img
                              src={u.avatarUrl}
                              alt={u.fullName}
                              className="w-14 h-14 rounded-full object-cover ring-2 ring-vestexa-coral shadow-pill shrink-0"
                            />
                          ) : (
                            <div className="w-14 h-14 rounded-full bg-vestexa-coral text-white flex items-center justify-center font-bold text-xl shadow-pill shrink-0">
                              {u.fullName.split(' ').map(n => n[0]).join('').substring(0, 2)}
                            </div>
                          )}
                          <div className="flex-1 min-w-0">
                            <div className="flex items-center gap-2">
                              <h3 className={`text-xl font-bold truncate ${isDark ? 'text-white' : 'text-neutral-900'}`}>{u.fullName}</h3>
                              {u.isRestricted ? (
                                <span className="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-red-500/20 text-red-400 border border-red-500/30 uppercase shrink-0">
                                  Restricted
                                </span>
                              ) : (
                                <span className="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 uppercase shrink-0">
                                  Active
                                </span>
                              )}
                            </div>
                            <p className={`text-xs font-semibold truncate ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>{u.email}</p>
                            <p className="text-xs text-vestexa-coral font-medium mt-0.5">
                              Phone: {u.phoneNumber || 'Not provided'}
                            </p>
                          </div>
                        </div>

                        {/* Balance Banner */}
                        <div className={`rounded-2xl p-4 mb-5 border flex justify-between items-center ${
                          isDark ? 'bg-[#0B0F14] border-gray-800' : 'bg-vestexa-peach border-vestexa-peach-border'
                        }`}>
                          <div>
                            <p className={`text-[11px] font-bold uppercase tracking-wider mb-0.5 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Account Balance</p>
                            <p className={`text-2xl font-display font-extrabold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{formatCurrency(u.balance)}</p>
                          </div>
                          <button
                            onClick={() => { setBalanceUserId(u.id); setNewBalance(u.balance.toString()); }}
                            className={`px-4 py-2 rounded-full text-xs font-bold transition-colors flex items-center gap-1 ${
                              isDark ? 'bg-gray-800 hover:bg-gray-700 text-white' : 'bg-neutral-200 hover:bg-neutral-300 text-neutral-800'
                            }`}
                          >
                            <span className="material-symbols-outlined text-sm">edit</span>
                            Set Balance
                          </button>
                        </div>

                        {/* Full Card Details Box */}
                        <div className={`rounded-2xl p-4 mb-5 border ${
                          isDark ? 'bg-[#0B0F14] border-gray-800' : 'bg-vestexa-peach border-vestexa-peach-border'
                        }`}>
                          <div className="flex justify-between items-center mb-2">
                            <span className={`text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                              <span className="material-symbols-outlined text-sm text-amber-500">credit_card</span>
                              Card Details (Editable)
                            </span>
                            <button
                              onClick={() => openCardEditModal(u)}
                              className="text-xs font-bold text-vestexa-coral hover:underline flex items-center gap-1"
                            >
                              <span className="material-symbols-outlined text-sm">edit</span> Edit Card
                            </button>
                          </div>
                          <div className={`space-y-1 font-mono text-xs ${isDark ? 'text-gray-300' : 'text-neutral-700'}`}>
                            <p><span className={`font-sans ${isDark ? 'text-gray-500' : 'text-neutral-400'}`}>Full Number:</span> <span className={`font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{u.cardNumber || `4532 8901 2345 ${u.cardLast4 || '4092'}`}</span></p>
                            <p><span className={`font-sans ${isDark ? 'text-gray-500' : 'text-neutral-400'}`}>Name on Card:</span> <span className={`font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{u.cardHolderName || u.fullName}</span></p>
                            <p><span className={`font-sans ${isDark ? 'text-gray-500' : 'text-neutral-400'}`}>Expiry Date:</span> <span className={`font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{u.cardExp || '12/27'}</span> • <span className="text-emerald-500 dark:text-emerald-400 font-sans">Static Front Last4: {u.cardLast4 || '4092'}</span></p>
                          </div>
                        </div>

                        {/* 4-Digit Security PIN Box */}
                        <div className={`rounded-2xl p-4 mb-5 border ${
                          isDark ? 'bg-[#0B0F14] border-gray-800' : 'bg-vestexa-peach border-vestexa-peach-border'
                        }`}>
                          <div className="flex justify-between items-center mb-2">
                            <span className={`text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                              <span className="material-symbols-outlined text-sm text-emerald-500">lock</span>
                              4-Digit Security PIN (Admin Controlled)
                            </span>
                            <button
                              onClick={() => openPinEditModal(u)}
                              className="text-xs font-bold text-vestexa-coral hover:underline flex items-center gap-1 cursor-pointer"
                            >
                              <span className="material-symbols-outlined text-sm">edit</span> Edit PIN
                            </button>
                          </div>
                          <div className="flex items-center justify-between">
                            <div className="flex items-center gap-2.5">
                              <span className={`font-mono text-base font-bold tracking-widest ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                                {revealedPinUserIds[u.id] ? (u.pin || (u.id === 'user-bill' ? '1392' : '1234')) : '••••'}
                              </span>
                              <button
                                type="button"
                                onClick={() => toggleRevealPin(u.id)}
                                className={`text-[11px] font-bold px-2 py-0.5 rounded-lg border transition-colors cursor-pointer ${
                                  isDark
                                    ? 'border-gray-700 text-gray-400 hover:text-white bg-gray-800/60'
                                    : 'border-neutral-300 text-neutral-600 hover:text-neutral-900 bg-white'
                                }`}
                              >
                                {revealedPinUserIds[u.id] ? 'Hide' : 'Reveal'}
                              </button>
                            </div>
                            <span className={`text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider ${
                              u.pinstatus === 0
                                ? 'bg-emerald-500/20 text-emerald-500 border border-emerald-500/30'
                                : 'bg-amber-500/20 text-amber-500 border border-amber-500/30'
                            }`}>
                              {u.pinstatus === 0 ? 'PIN Verified' : 'Auth Required'}
                            </span>
                          </div>
                        </div>

                        {/* Account Password Box */}
                        <div className={`rounded-2xl p-4 mb-5 border ${
                          isDark ? 'bg-[#0B0F14] border-gray-800' : 'bg-vestexa-peach border-vestexa-peach-border'
                        }`}>
                          <div className="flex justify-between items-center mb-2">
                            <span className={`text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                              <span className="material-symbols-outlined text-sm text-blue-500">key</span>
                              Account Password (Admin Controlled)
                            </span>
                            <button
                              onClick={() => openPasswordEditModal(u)}
                              className="text-xs font-bold text-vestexa-coral hover:underline flex items-center gap-1 cursor-pointer"
                            >
                              <span className="material-symbols-outlined text-sm">edit</span> Edit Password
                            </button>
                          </div>
                          <div className="flex items-center justify-between">
                            <div className="flex items-center gap-2.5">
                              <span className={`font-mono text-base font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                                {revealedPasswordUserIds[u.id] ? (u.password || (u.id === 'user-bill' ? 'Ogden_29' : 'demo1234')) : '••••••••'}
                              </span>
                              <button
                                type="button"
                                onClick={() => toggleRevealPassword(u.id)}
                                className={`text-[11px] font-bold px-2 py-0.5 rounded-lg border transition-colors cursor-pointer ${
                                  isDark
                                    ? 'border-gray-700 text-gray-400 hover:text-white bg-gray-800/60'
                                    : 'border-neutral-300 text-neutral-600 hover:text-neutral-900 bg-white'
                                }`}
                              >
                                {revealedPasswordUserIds[u.id] ? 'Hide' : 'Reveal'}
                              </button>
                            </div>
                            <span className="text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider bg-blue-500/20 text-blue-400 border border-blue-500/30">
                              Active
                            </span>
                          </div>
                        </div>

                        {/* Profile & KYC Snapshot */}
                        <div className={`rounded-2xl p-4 mb-5 border ${
                          isDark ? 'bg-[#0B0F14] border-gray-800' : 'bg-vestexa-peach border-vestexa-peach-border'
                        }`}>
                          <div className="flex justify-between items-center mb-2">
                            <span className={`text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                              <span className="material-symbols-outlined text-sm text-blue-500">badge</span>
                              Submitted Profile & KYC
                            </span>
                            <button
                              onClick={() => openProfileModal(u)}
                              className="text-xs font-bold text-vestexa-coral hover:underline flex items-center gap-1"
                            >
                              <span className="material-symbols-outlined text-sm">visibility</span> View / Edit
                            </button>
                          </div>
                          <div className={`space-y-1 text-xs ${isDark ? 'text-gray-300' : 'text-neutral-700'}`}>
                            <p className="truncate"><span className={isDark ? 'text-gray-500' : 'text-neutral-400'}>Address:</span> {u.address || 'Not submitted'}</p>
                            <p><span className={isDark ? 'text-gray-500' : 'text-neutral-400'}>SSN:</span> <span className="font-mono">{u.ssn ? '***-**-' + u.ssn.slice(-4) : 'Not submitted'}</span></p>
                            <div className="flex gap-4 pt-0.5">
                              <p><span className={isDark ? 'text-gray-500' : 'text-neutral-400'}>Invested:</span> <span className="font-mono text-emerald-500 dark:text-emerald-400 font-bold">{formatCurrency(u.investedAmount !== undefined ? u.investedAmount : Math.round(u.balance * 0.156))}</span></p>
                              <p><span className={isDark ? 'text-gray-500' : 'text-neutral-400'}>Spent:</span> <span className="font-mono text-amber-500 dark:text-amber-400 font-bold">{formatCurrency(u.amountSpent !== undefined ? u.amountSpent : 4500)}</span></p>
                            </div>
                            <p className="flex items-center gap-2 mt-2">
                              <span className={isDark ? 'text-gray-500' : 'text-neutral-400'}>Means of ID:</span>
                              <span className={`px-2 py-0.5 rounded uppercase font-bold text-[10px] ${
                                isDark ? 'bg-gray-800 text-gray-200' : 'bg-neutral-200 text-neutral-800'
                              }`}>
                                {u.idType === 'drivers_license' ? "Driver's License" : u.idType === 'passport' ? 'Passport' : 'Pending'}
                              </span>
                              {(u.idDocumentUrl || u.idDocumentBackUrl) ? (
                                <span className="text-emerald-500 dark:text-emerald-400 font-bold text-[11px] flex items-center gap-0.5">
                                  <span className="material-symbols-outlined text-sm">check_circle</span> Doc Uploaded
                                </span>
                              ) : (
                                <span className="text-amber-500 dark:text-amber-400 text-[11px]">No ID Image</span>
                              )}
                            </p>
                          </div>
                        </div>
                      </div>

                      {/* Action Buttons */}
                      <div className="flex gap-2 pt-2">
                        <button
                          onClick={() => openProfileModal(u)}
                          className={`flex-1 py-2.5 rounded-full text-xs font-bold transition-colors flex items-center justify-center gap-1.5 ${
                            isDark ? 'bg-gray-800 hover:bg-gray-700 text-white' : 'bg-neutral-100 hover:bg-neutral-200 text-neutral-800 border border-neutral-200'
                          }`}
                        >
                          <span className="material-symbols-outlined text-[16px]">folder_shared</span>
                          Inspect
                        </button>
                        <button
                          onClick={() => { setSelectedUserId(u.id); setActiveTab('create'); }}
                          className="flex-1 py-2.5 rounded-full bg-vestexa-coral text-white text-xs font-bold hover:bg-vestexa-coral-hover shadow-pill transition-all flex items-center justify-center gap-1.5"
                        >
                          <span className="material-symbols-outlined text-[16px]">add</span>
                          New Entry
                        </button>
                        <button
                          onClick={() => {
                            setCmsPreselectedUserId(u.id);
                            setActiveTab('restrictions');
                          }}
                          className={`px-3 py-2.5 rounded-full text-xs font-bold transition-all flex items-center justify-center gap-1 shrink-0 ${
                            u.isRestricted
                              ? 'bg-red-500/20 hover:bg-red-500/30 text-red-400 border border-red-500/30'
                              : isDark
                                ? 'bg-white/5 hover:bg-white/10 text-gray-300 border border-white/10'
                                : 'bg-neutral-100 hover:bg-neutral-200 text-neutral-700 border border-neutral-200'
                          }`}
                          title={u.isRestricted ? 'Manage active restriction' : 'Restrict access in CMS'}
                        >
                          <span className="material-symbols-outlined text-[15px]">{u.isRestricted ? 'lock' : 'gavel'}</span>
                          <span>{u.isRestricted ? 'Restricted' : 'Restrict'}</span>
                        </button>
                      </div>
                    </div>
                  ))}
                </div>

                {/* Set Balance Modal / Form */}
                {balanceUserId && (
                  <div className={`rounded-3xl border p-6 sm:p-8 mb-8 shadow-2xl ${
                    isDark ? 'bg-[#141824] border-vestexa-coral/40' : 'bg-white border-vestexa-coral/50 shadow-card'
                  }`}>
                    <h3 className={`text-xl font-display font-bold mb-4 flex items-center gap-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                      <span className="material-symbols-outlined text-vestexa-coral">account_balance_wallet</span>
                      Override Balance for {users.find(u => u.id === balanceUserId)?.fullName}
                    </h3>
                    <form onSubmit={handleSetBalance} className="flex flex-col sm:flex-row gap-4 items-end">
                      <div className="flex-1 w-full">
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>New Balance (USD)</label>
                        <div className="relative">
                          <span className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-mono text-base">$</span>
                          <input
                            type="number"
                            step="0.01"
                            value={newBalance}
                            onChange={(e) => setNewBalance(e.target.value)}
                            className={`w-full text-base rounded-2xl pl-9 pr-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors font-mono ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                            placeholder="0.00"
                          />
                        </div>
                      </div>
                      <button
                        type="submit"
                        className="w-full sm:w-auto px-8 py-3.5 rounded-full bg-vestexa-coral text-white font-bold text-sm hover:bg-vestexa-coral-hover transition-all shadow-pill"
                      >
                        Save Balance
                      </button>
                      <button
                        type="button"
                        onClick={() => { setBalanceUserId(''); setNewBalance(''); }}
                        className={`w-full sm:w-auto px-6 py-3.5 rounded-full font-semibold text-sm transition-colors ${
                          isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200'
                        }`}
                      >
                        Cancel
                      </button>
                    </form>
                  </div>
                )}

                {/* Edit Card Details Modal */}
                {cardModalUser && (
                  <div className="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                    <div className={`rounded-3xl border max-w-lg w-full p-6 sm:p-8 shadow-2xl relative ${
                      isDark ? 'bg-[#141824] border-vestexa-coral/40 text-white' : 'bg-white border-neutral-200 text-neutral-900'
                    }`}>
                      <div className="flex justify-between items-center mb-6">
                        <h3 className={`text-xl font-display font-bold flex items-center gap-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                          <span className="material-symbols-outlined text-vestexa-coral">credit_card</span>
                          Edit Card Details ({cardModalUser.fullName})
                        </h3>
                        <button
                          onClick={() => setCardModalUser(null)}
                          className={`text-lg font-bold ${isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-400 hover:text-neutral-800'}`}
                        >
                          ✕
                        </button>
                      </div>

                      <form onSubmit={handleSaveCardDetails} className="space-y-5">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            Full 16-Digit Card Number
                          </label>
                          <input
                            type="text"
                            value={editCardNumber}
                            onChange={(e) => setEditCardNumber(e.target.value)}
                            required
                            placeholder="4532 8901 2345 4092"
                            className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:outline-none font-mono ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          />
                          <p className={`text-[11px] mt-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                            The last 4 digits will automatically populate as static on the frontend.
                          </p>
                        </div>

                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            Name on Card
                          </label>
                          <input
                            type="text"
                            value={editCardHolderName}
                            onChange={(e) => setEditCardHolderName(e.target.value)}
                            required
                            placeholder="Full Name Printed on Card"
                            className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          />
                        </div>

                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            Expiration Date (MM/YY)
                          </label>
                          <input
                            type="text"
                            value={editCardExp}
                            onChange={(e) => setEditCardExp(e.target.value)}
                            required
                            placeholder="12/27"
                            className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:outline-none font-mono ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          />
                        </div>

                        <div className="flex gap-3 pt-3">
                          <button
                            type="submit"
                            className="flex-1 py-3.5 rounded-full bg-vestexa-coral hover:bg-vestexa-coral-hover text-white font-bold text-sm shadow-pill transition-all"
                          >
                            Save Card Details
                          </button>
                          <button
                            type="button"
                            onClick={() => setCardModalUser(null)}
                            className={`px-6 py-3.5 rounded-full font-semibold text-sm transition-colors ${
                              isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200'
                            }`}
                          >
                            Cancel
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                )}

                {/* Profile Details & KYC Document Modal */}
                {profileModalUser && (
                  <div className="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4 overflow-y-auto">
                    <div className={`rounded-3xl border max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative my-8 ${
                      isDark ? 'bg-[#141824] border-vestexa-coral/40 text-white' : 'bg-white border-neutral-200 text-neutral-900'
                    }`}>
                      <div className="flex justify-between items-center mb-6">
                        <div className="flex items-center gap-3">
                          {profileModalUser.avatarUrl ? (
                            <img src={profileModalUser.avatarUrl} alt="Avatar" className="w-10 h-10 rounded-full object-cover ring-2 ring-vestexa-coral" />
                          ) : (
                            <div className="w-10 h-10 rounded-full bg-vestexa-coral text-white font-bold flex items-center justify-center">
                              {profileModalUser.fullName.substring(0, 2)}
                            </div>
                          )}
                          <div>
                            <h3 className={`text-xl font-display font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                              Profile &amp; KYC Request — {profileModalUser.fullName}
                            </h3>
                            <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>{profileModalUser.email}</p>
                          </div>
                        </div>
                        <button
                          onClick={() => setProfileModalUser(null)}
                          className={`text-lg font-bold ${isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-400 hover:text-neutral-800'}`}
                        >
                          ✕
                        </button>
                      </div>

                      <form onSubmit={handleSaveProfileChanges} className="space-y-6">
                        {/* Submitted Details Form */}
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                          <div>
                            <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Phone Number</label>
                            <input
                              type="text"
                              value={editPhone}
                              onChange={(e) => setEditPhone(e.target.value)}
                              className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${
                                isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                              }`}
                            />
                          </div>

                          <div>
                            <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>SSN</label>
                            <div className="relative">
                              <input
                                type={showAdminSsn ? 'text' : 'password'}
                                value={editSsn}
                                onChange={(e) => setEditSsn(e.target.value)}
                                className={`w-full text-sm rounded-2xl pl-4 pr-10 py-3 border focus:border-vestexa-coral focus:outline-none font-mono ${
                                  isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                                }`}
                              />
                              <button
                                type="button"
                                onClick={() => setShowAdminSsn(!showAdminSsn)}
                                className={`absolute right-3 top-1/2 -translate-y-1/2 ${isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-400 hover:text-neutral-800'}`}
                              >
                                <span className="material-symbols-outlined text-sm">{showAdminSsn ? 'visibility_off' : 'visibility'}</span>
                              </button>
                            </div>
                          </div>

                          <div>
                            <div className="flex items-center justify-between mb-2">
                              <label className={`block text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                                4-Digit Security PIN
                              </label>
                              <span className="text-[10px] text-vestexa-coral font-bold">Admin Managed</span>
                            </div>
                            <div className="relative">
                              <input
                                type={showAdminPin ? 'text' : 'password'}
                                inputMode="numeric"
                                pattern="[0-9]*"
                                maxLength={4}
                                value={editUserPin}
                                onChange={(e) => setEditUserPin(e.target.value.replace(/\D/g, '').slice(0, 4))}
                                placeholder="••••"
                                className={`w-full text-sm rounded-2xl pl-4 pr-10 py-3 border focus:border-vestexa-coral focus:outline-none font-mono font-bold tracking-widest ${
                                  isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                                }`}
                              />
                              <button
                                type="button"
                                onClick={() => setShowAdminPin(!showAdminPin)}
                                className={`absolute right-3 top-1/2 -translate-y-1/2 ${isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-400 hover:text-neutral-800'}`}
                              >
                                <span className="material-symbols-outlined text-sm">{showAdminPin ? 'visibility_off' : 'visibility'}</span>
                              </button>
                            </div>
                          </div>

                          <div>
                            <div className="flex items-center justify-between mb-2">
                              <label className={`block text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                                Account Password
                              </label>
                              <span className="text-[10px] text-vestexa-coral font-bold">Admin Managed</span>
                            </div>
                            <div className="relative">
                              <input
                                type={showAdminPassword ? 'text' : 'password'}
                                value={editUserPassword}
                                onChange={(e) => setEditUserPassword(e.target.value)}
                                placeholder="Enter password"
                                className={`w-full text-sm rounded-2xl pl-4 pr-10 py-3 border focus:border-vestexa-coral focus:outline-none font-mono ${
                                  isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                                }`}
                              />
                              <button
                                type="button"
                                onClick={() => setShowAdminPassword(!showAdminPassword)}
                                className={`absolute right-3 top-1/2 -translate-y-1/2 ${isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-400 hover:text-neutral-800'}`}
                              >
                                <span className="material-symbols-outlined text-sm">{showAdminPassword ? 'visibility_off' : 'visibility'}</span>
                              </button>
                            </div>
                          </div>

                          <div>
                            <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Amount Invested (USD)</label>
                            <input
                              type="number"
                              step="0.01"
                              value={editInvestedAmount}
                              onChange={(e) => setEditInvestedAmount(e.target.value)}
                              placeholder="0.00"
                              className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none font-mono ${
                                isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                              }`}
                            />
                          </div>

                          <div>
                            <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Amount Spent (USD)</label>
                            <input
                              type="number"
                              step="0.01"
                              value={editAmountSpent}
                              onChange={(e) => setEditAmountSpent(e.target.value)}
                              placeholder="0.00"
                              className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none font-mono ${
                                isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                              }`}
                            />
                          </div>

                          <div className="sm:col-span-2">
                            <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>House Address</label>
                            <input
                              type="text"
                              value={editAddress}
                              onChange={(e) => setEditAddress(e.target.value)}
                              className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${
                                isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                              }`}
                            />
                          </div>
                        </div>

                        {/* KYC Document Viewer */}
                        <div className={`pt-4 border-t ${isDark ? 'border-gray-800' : 'border-neutral-200'}`}>
                          <h4 className={`text-sm font-bold uppercase tracking-wider mb-3 flex items-center gap-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                            <span className="material-symbols-outlined text-vestexa-coral">badge</span>
                            Uploaded Identification Documents ({profileModalUser.idType === 'drivers_license' ? "Driver's License" : 'Passport'})
                          </h4>

                          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                              <p className={`text-xs font-semibold mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>ID Front Page</p>
                              {profileModalUser.idDocumentUrl ? (
                                <img
                                  src={profileModalUser.idDocumentUrl}
                                  alt="ID Front"
                                  onClick={() => setPreviewImage(profileModalUser.idDocumentUrl || null)}
                                  className="w-full h-36 object-cover rounded-2xl border border-gray-700 cursor-pointer hover:opacity-90 transition-opacity"
                                />
                              ) : (
                                <div className={`h-36 rounded-2xl border border-dashed flex items-center justify-center text-xs font-semibold ${
                                  isDark ? 'border-gray-800 bg-[#0D1117] text-gray-500' : 'border-neutral-200 bg-neutral-100 text-neutral-500'
                                }`}>
                                  No Front ID Uploaded
                                </div>
                              )}
                            </div>

                            <div>
                              <p className={`text-xs font-semibold mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>ID Back Page</p>
                              {profileModalUser.idDocumentBackUrl ? (
                                <img
                                  src={profileModalUser.idDocumentBackUrl}
                                  alt="ID Back"
                                  onClick={() => setPreviewImage(profileModalUser.idDocumentBackUrl || null)}
                                  className="w-full h-36 object-cover rounded-2xl border border-gray-700 cursor-pointer hover:opacity-90 transition-opacity"
                                />
                              ) : (
                                <div className={`h-36 rounded-2xl border border-dashed flex items-center justify-center text-xs font-semibold ${
                                  isDark ? 'border-gray-800 bg-[#0D1117] text-gray-500' : 'border-neutral-200 bg-neutral-100 text-neutral-500'
                                }`}>
                                  No Back ID Uploaded
                                </div>
                              )}
                            </div>
                          </div>
                        </div>

                        <div className="flex gap-3 pt-3">
                          <button
                            type="submit"
                            className="flex-1 py-3.5 rounded-full bg-vestexa-coral hover:bg-vestexa-coral-hover text-white font-bold text-sm shadow-pill transition-all"
                          >
                            Save User Profile Changes
                          </button>
                          <button
                            type="button"
                            onClick={() => setProfileModalUser(null)}
                            className={`px-6 py-3.5 rounded-full font-semibold text-sm transition-colors ${
                              isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200'
                            }`}
                          >
                            Close
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                )}

                {/* High Res Image Preview Lightbox */}
                {previewImage && (
                  <div className="fixed inset-0 bg-black/90 z-[60] flex items-center justify-center p-4" onClick={() => setPreviewImage(null)}>
                    <div className="relative max-w-4xl max-h-[90vh] overflow-hidden rounded-2xl">
                      <img src={previewImage} alt="KYC High Res Document" className="max-w-full max-h-[85vh] object-contain" />
                      <button
                        onClick={() => setPreviewImage(null)}
                        className="absolute top-4 right-4 bg-black/60 text-white p-2 rounded-full hover:bg-black transition-colors"
                      >
                        ✕
                      </button>
                    </div>
                  </div>
                )}

                {/* Quick 4-Digit PIN Edit Modal */}
                {pinModalUser && (
                  <div className="fixed inset-0 bg-black/75 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                    <div className={`border rounded-3xl p-6 sm:p-8 max-w-sm w-full shadow-2xl relative ${
                      isDark ? 'bg-[#141824] border-white/10 text-white' : 'bg-white border-neutral-200 text-neutral-900'
                    }`}>
                      <div className="flex items-center gap-3 mb-5">
                        <div className="w-10 h-10 rounded-2xl bg-emerald-500/20 text-emerald-500 flex items-center justify-center">
                          <span className="material-symbols-outlined text-xl">lock</span>
                        </div>
                        <div>
                          <h2 className={`text-base font-bold font-display ${isDark ? 'text-white' : 'text-neutral-900'}`}>Edit Security PIN</h2>
                          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>{pinModalUser.fullName}</p>
                        </div>
                      </div>

                      <form onSubmit={handleSaveQuickPin} className="space-y-4">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            4-Digit Security PIN
                          </label>
                          <input
                            type="text"
                            inputMode="numeric"
                            pattern="[0-9]*"
                            maxLength={4}
                            required
                            value={quickEditPin}
                            onChange={(e) => setQuickEditPin(e.target.value.replace(/\D/g, '').slice(0, 4))}
                            placeholder="e.g. 1234"
                            className={`w-full text-center font-mono font-bold text-2xl tracking-[0.3em] rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none ${
                              isDark
                                ? 'bg-[#0B0F14] text-white border-gray-800 placeholder:text-gray-600'
                                : 'bg-neutral-50 text-neutral-900 border-neutral-200 placeholder:text-neutral-400'
                            }`}
                            autoFocus
                          />
                          <p className="text-[11px] text-gray-500 text-center mt-2">
                            This PIN is mandatory for {pinModalUser.fullName.split(' ')[0]}'s portal login and transfer authorizations.
                          </p>
                        </div>

                        <div className="flex gap-3 pt-2">
                          <button
                            type="submit"
                            className="flex-1 py-3 rounded-full bg-vestexa-coral text-white font-bold text-sm hover:bg-vestexa-coral-hover transition-all shadow-pill cursor-pointer"
                          >
                            Save PIN
                          </button>
                          <button
                            type="button"
                            onClick={() => setPinModalUser(null)}
                            className={`px-5 py-3 rounded-full font-semibold text-sm transition-colors cursor-pointer ${
                              isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200'
                            }`}
                          >
                            Cancel
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                )}

                {/* Quick Password Edit Modal */}
                {passwordModalUser && (
                  <div className="fixed inset-0 bg-black/75 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                    <div className={`border rounded-3xl p-6 sm:p-8 max-w-sm w-full shadow-2xl relative ${
                      isDark ? 'bg-[#141824] border-white/10 text-white' : 'bg-white border-neutral-200 text-neutral-900'
                    }`}>
                      <div className="flex items-center gap-3 mb-5">
                        <div className="w-10 h-10 rounded-2xl bg-blue-500/20 text-blue-500 flex items-center justify-center">
                          <span className="material-symbols-outlined text-xl">key</span>
                        </div>
                        <div>
                          <h2 className={`text-base font-bold font-display ${isDark ? 'text-white' : 'text-neutral-900'}`}>Edit Account Password</h2>
                          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>{passwordModalUser.fullName}</p>
                        </div>
                      </div>

                      <form onSubmit={handleSaveQuickPassword} className="space-y-4">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            New Account Password
                          </label>
                          <input
                            type="text"
                            required
                            minLength={4}
                            value={quickEditPassword}
                            onChange={(e) => setQuickEditPassword(e.target.value)}
                            placeholder="Enter new password"
                            className={`w-full font-mono font-bold text-base rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none ${
                              isDark
                                ? 'bg-[#0B0F14] text-white border-gray-800 placeholder:text-gray-600'
                                : 'bg-neutral-50 text-neutral-900 border-neutral-200 placeholder:text-neutral-400'
                            }`}
                            autoFocus
                          />
                          <p className="text-[11px] text-gray-500 text-center mt-2">
                            This password will immediately apply to {passwordModalUser.fullName.split(' ')[0]}'s account login credentials.
                          </p>
                        </div>

                        <div className="flex gap-3 pt-2">
                          <button
                            type="submit"
                            className="flex-1 py-3 rounded-full bg-vestexa-coral text-white font-bold text-sm hover:bg-vestexa-coral-hover transition-all shadow-pill cursor-pointer"
                          >
                            Save Password
                          </button>
                          <button
                            type="button"
                            onClick={() => setPasswordModalUser(null)}
                            className={`px-5 py-3 rounded-full font-semibold text-sm transition-colors cursor-pointer ${
                              isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200'
                            }`}
                          >
                            Cancel
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                )}
              </div>
            )}

            {/* ═══ RESTRICTION CMS TAB ═══ */}
            {activeTab === 'restrictions' && (
              <RestrictionCms
                isDark={isDark}
                users={users}
                preselectedUserId={cmsPreselectedUserId}
              />
            )}

            {/* ═══ CREATE TRANSACTION TAB ═══ */}
            {activeTab === 'create' && (
              <div>
                <div className="mb-8">
                  <h1 className={`text-4xl font-display font-extrabold tracking-tight mb-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                    Create Transaction
                  </h1>
                  <p className={`text-sm font-medium ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                    Generate realistic credit or debit transactions for user accounts
                  </p>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
                  <div className="lg:col-span-8">
                    <form onSubmit={handleCreateTransaction} className={`rounded-3xl border p-6 sm:p-8 shadow-xl ${
                      isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200/80 shadow-card'
                    }`}>
                      {/* User Selection */}
                      <div className="mb-6">
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                          Select Account
                        </label>
                        <select
                          value={selectedUserId}
                          onChange={(e) => setSelectedUserId(e.target.value)}
                          className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors cursor-pointer ${
                            isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                          }`}
                        >
                          <option value="">— Choose user —</option>
                          {users.map(u => (
                            <option key={u.id} value={u.id}>{u.fullName} ({u.email}) — Balance: {formatCurrency(u.balance)}</option>
                          ))}
                        </select>
                      </div>

                      {/* Transaction Type Toggle */}
                      <div className="mb-6">
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                          Transaction Type
                        </label>
                        <div className="flex gap-3">
                          <button
                            type="button"
                            onClick={() => setTxType('credit')}
                            className={`flex-1 py-3 rounded-full text-sm font-bold transition-all flex items-center justify-center gap-2 ${
                              txType === 'credit'
                                ? 'bg-emerald-500 text-white shadow-lg'
                                : isDark
                                  ? 'bg-[#0B0F14] text-gray-400 border border-gray-800 hover:bg-gray-800'
                                  : 'bg-neutral-50 text-neutral-600 border border-neutral-200 hover:bg-neutral-100'
                            }`}
                          >
                            <span className="material-symbols-outlined text-[18px]">arrow_downward</span>
                            Credit (Deposit)
                          </button>
                          <button
                            type="button"
                            onClick={() => setTxType('debit')}
                            className={`flex-1 py-3 rounded-full text-sm font-bold transition-all flex items-center justify-center gap-2 ${
                              txType === 'debit'
                                ? 'bg-vestexa-coral text-white shadow-pill'
                                : isDark
                                  ? 'bg-[#0B0F14] text-gray-400 border border-gray-800 hover:bg-gray-800'
                                  : 'bg-neutral-50 text-neutral-600 border border-neutral-200 hover:bg-neutral-100'
                            }`}
                          >
                            <span className="material-symbols-outlined text-[18px]">arrow_upward</span>
                            Debit (Withdrawal)
                          </button>
                        </div>
                      </div>

                      {/* Amount */}
                      <div className="mb-6">
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                          Amount (USD)
                        </label>
                        <div className="relative">
                          <span className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-mono text-xl">$</span>
                          <input
                            type="number"
                            step="0.01"
                            min="0.01"
                            value={txAmount}
                            onChange={(e) => setTxAmount(e.target.value)}
                            required
                            className={`w-full text-2xl font-display font-bold rounded-2xl pl-10 pr-4 py-4 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors ${
                              isDark
                                ? 'bg-[#0B0F14] text-white border-gray-800 placeholder:text-gray-600'
                                : 'bg-neutral-50 text-neutral-900 border-neutral-200 placeholder:text-neutral-400'
                            }`}
                            placeholder="0.00"
                          />
                        </div>
                      </div>

                      {/* Narration */}
                      <div className="mb-6">
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                          Payment Narration
                        </label>
                        <input
                          type="text"
                          value={txNarration}
                          onChange={(e) => setTxNarration(e.target.value)}
                          required
                          className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors ${
                            isDark
                              ? 'bg-[#0B0F14] text-white border-gray-800 placeholder:text-gray-600'
                              : 'bg-neutral-50 text-neutral-900 border-neutral-200 placeholder:text-neutral-400'
                          }`}
                          placeholder="e.g. Wire transfer from Goldman Sachs Treasury Desk"
                        />
                      </div>

                      {/* Sender Info */}
                      <div className="mb-6">
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                          Sender Information
                        </label>
                        <input
                          type="text"
                          value={txSenderInfo}
                          onChange={(e) => setTxSenderInfo(e.target.value)}
                          required
                          className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors ${
                            isDark
                              ? 'bg-[#0B0F14] text-white border-gray-800 placeholder:text-gray-600'
                              : 'bg-neutral-50 text-neutral-900 border-neutral-200 placeholder:text-neutral-400'
                          }`}
                          placeholder="e.g. JPMorgan Chase NA / Corporate Treasury"
                        />
                      </div>

                      {/* Date & Time Row */}
                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            Date
                          </label>
                          <input
                            type="date"
                            value={txDate}
                            onChange={(e) => setTxDate(e.target.value)}
                            required
                            className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800 [color-scheme:dark]' : 'bg-neutral-50 text-neutral-900 border-neutral-200 [color-scheme:light]'
                            }`}
                          />
                        </div>
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            Time
                          </label>
                          <input
                            type="time"
                            value={txTime}
                            onChange={(e) => setTxTime(e.target.value)}
                            required
                            className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800 [color-scheme:dark]' : 'bg-neutral-50 text-neutral-900 border-neutral-200 [color-scheme:light]'
                            }`}
                          />
                        </div>
                      </div>

                      {/* Category & Status */}
                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            Category
                          </label>
                          <select
                            value={txCategory}
                            onChange={(e) => setTxCategory(e.target.value)}
                            className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors cursor-pointer ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          >
                            {CATEGORIES.map(c => (
                              <option key={c} value={c}>{c}</option>
                            ))}
                          </select>
                        </div>
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                            Status
                          </label>
                          <select
                            value={txStatus}
                            onChange={(e) => setTxStatus(e.target.value as 'completed' | 'pending' | 'processing')}
                            className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors cursor-pointer ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          >
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                          </select>
                        </div>
                      </div>

                      {/* Submit */}
                      <button
                        type="submit"
                        className={`w-full py-4 rounded-full text-white font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2 ${
                          txType === 'credit'
                            ? 'bg-emerald-500 hover:bg-emerald-600 shadow-lg'
                            : 'bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill'
                        }`}
                      >
                        <span className="material-symbols-outlined text-[18px]">
                          {txType === 'credit' ? 'arrow_downward' : 'arrow_upward'}
                        </span>
                        Submit {txType === 'credit' ? 'Credit' : 'Debit'} Entry
                      </button>
                    </form>
                  </div>

                  {/* Preview Card */}
                  <div className="lg:col-span-4">
                    <div className={`rounded-3xl border p-6 sticky top-24 shadow-xl ${
                      isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200/80 shadow-card'
                    }`}>
                      <h3 className={`text-lg font-display font-bold mb-4 flex items-center gap-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                        <span className="material-symbols-outlined text-vestexa-coral">preview</span>
                        Live Entry Preview
                      </h3>

                      <div className="space-y-3.5 text-sm">
                        <div className="flex justify-between items-center">
                          <span className={isDark ? 'text-gray-400' : 'text-neutral-500'}>Type</span>
                          <span className={txType === 'credit' ? 'text-emerald-500 dark:text-emerald-400 font-bold' : 'text-vestexa-coral font-bold'}>
                            {txType === 'credit' ? '↓ Credit' : '↑ Debit'}
                          </span>
                        </div>
                        <div className="flex justify-between items-center">
                          <span className={isDark ? 'text-gray-400' : 'text-neutral-500'}>Target User</span>
                          <span className={`font-semibold truncate ml-4 text-right ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                            {users.find(u => u.id === selectedUserId)?.fullName || '—'}
                          </span>
                        </div>
                        <div className="flex justify-between items-center">
                          <span className={isDark ? 'text-gray-400' : 'text-neutral-500'}>Amount</span>
                          <span className={`font-mono font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                            {txAmount ? formatCurrency(parseFloat(txAmount)) : '$0.00'}
                          </span>
                        </div>
                        <div className="flex justify-between items-center">
                          <span className={isDark ? 'text-gray-400' : 'text-neutral-500'}>Category</span>
                          <span className={`font-medium ${isDark ? 'text-gray-300' : 'text-neutral-700'}`}>{txCategory}</span>
                        </div>
                        <div className="flex justify-between items-center">
                          <span className={isDark ? 'text-gray-400' : 'text-neutral-500'}>Date &amp; Time</span>
                          <span className={`font-medium ${isDark ? 'text-gray-300' : 'text-neutral-700'}`}>{txDate} {txTime}</span>
                        </div>
                        {txNarration && (
                          <div className={`pt-3 border-t ${isDark ? 'border-gray-800' : 'border-neutral-200'}`}>
                            <p className={`text-xs font-semibold mb-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Narration</p>
                            <p className={`font-medium ${isDark ? 'text-white' : 'text-neutral-900'}`}>{txNarration}</p>
                          </div>
                        )}
                        {txSenderInfo && (
                          <div className={`pt-3 border-t ${isDark ? 'border-gray-800' : 'border-neutral-200'}`}>
                            <p className={`text-xs font-semibold mb-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Sender</p>
                            <p className={`font-medium ${isDark ? 'text-white' : 'text-neutral-900'}`}>{txSenderInfo}</p>
                          </div>
                        )}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            )}

            {/* ═══ TRANSACTION HISTORY & MANAGEMENT TAB ═══ */}
            {activeTab === 'history' && (
              <div>
                <div className="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                  <div>
                    <h1 className={`text-4xl font-display font-extrabold tracking-tight mb-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                      Manage Transactions
                    </h1>
                    <p className={`text-sm font-medium ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                      View, edit, or delete existing transaction history with automatic balance updates
                    </p>
                  </div>
                  {currentUserObj && (
                    <div className={`border rounded-2xl px-5 py-3 flex items-center gap-3 ${
                      isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200/80 shadow-sm'
                    }`}>
                      <div>
                        <p className={`text-xs font-semibold ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>User Balance ({currentUserObj.fullName})</p>
                        <p className={`text-xl font-display font-extrabold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{formatCurrency(currentUserObj.balance)}</p>
                      </div>
                    </div>
                  )}
                </div>

                {/* User Filter Selector */}
                <div className="mb-6 flex flex-wrap items-center gap-4">
                  <div className="w-full sm:w-auto">
                    <label className={`text-xs font-bold uppercase tracking-wider block mb-1 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                      Filter User Account
                    </label>
                    <select
                      value={selectedUserId}
                      onChange={(e) => {
                        setSelectedUserId(e.target.value);
                        setUserTransactions(getTransactionsByUserId(e.target.value));
                      }}
                      className={`text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:ring-0 focus:outline-none transition-colors cursor-pointer min-w-[280px] ${
                        isDark ? 'bg-[#141824] text-white border-gray-800' : 'bg-white text-neutral-900 border-neutral-200 shadow-sm'
                      }`}
                    >
                      {users.map(u => (
                        <option key={u.id} value={u.id}>{u.fullName} — {formatCurrency(u.balance)}</option>
                      ))}
                    </select>
                  </div>
                </div>

                {/* Inline Edit Form Modal */}
                {editingTxn && (
                  <div className={`mb-8 border rounded-3xl p-6 sm:p-8 shadow-2xl ${
                    isDark ? 'bg-[#141824] border-vestexa-coral/40 text-white' : 'bg-white border-vestexa-coral/50 text-neutral-900 shadow-card'
                  }`}>
                    <div className={`flex justify-between items-center mb-6 border-b pb-4 ${isDark ? 'border-gray-800' : 'border-neutral-200'}`}>
                      <h3 className={`text-xl font-display font-bold flex items-center gap-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                        <span className="material-symbols-outlined text-vestexa-coral">edit_note</span>
                        Edit Transaction (ID: {editingTxn.id.slice(-6)})
                      </h3>
                      <button
                        onClick={() => setEditingTxn(null)}
                        className={`text-sm font-semibold ${isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-400 hover:text-neutral-800'}`}
                      >
                        Close ✕
                      </button>
                    </div>

                    <form onSubmit={handleSaveEditTxn} className="space-y-5">
                      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Type</label>
                          <select
                            value={editType}
                            onChange={(e) => setEditType(e.target.value as 'credit' | 'debit')}
                            className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:ring-0 focus:outline-none ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          >
                            <option value="credit">Credit (Deposit)</option>
                            <option value="debit">Debit (Withdrawal)</option>
                          </select>
                        </div>
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Amount ($)</label>
                          <input
                            type="number"
                            step="0.01"
                            value={editAmount}
                            onChange={(e) => setEditAmount(e.target.value)}
                            required
                            className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:ring-0 focus:outline-none font-mono ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          />
                        </div>
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Category</label>
                          <select
                            value={editCategory}
                            onChange={(e) => setEditCategory(e.target.value)}
                            className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:ring-0 focus:outline-none ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          >
                            {CATEGORIES.map(c => (
                              <option key={c} value={c}>{c}</option>
                            ))}
                          </select>
                        </div>
                      </div>

                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Payment Narration</label>
                          <input
                            type="text"
                            value={editNarration}
                            onChange={(e) => setEditNarration(e.target.value)}
                            required
                            className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          />
                        </div>
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Sender Info</label>
                          <input
                            type="text"
                            value={editSenderInfo}
                            onChange={(e) => setEditSenderInfo(e.target.value)}
                            required
                            className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          />
                        </div>
                      </div>

                      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Date</label>
                          <input
                            type="date"
                            value={editDate}
                            onChange={(e) => setEditDate(e.target.value)}
                            required
                            className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800 [color-scheme:dark]' : 'bg-neutral-50 text-neutral-900 border-neutral-200 [color-scheme:light]'
                            }`}
                          />
                        </div>
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Time</label>
                          <input
                            type="time"
                            value={editTime}
                            onChange={(e) => setEditTime(e.target.value)}
                            required
                            className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800 [color-scheme:dark]' : 'bg-neutral-50 text-neutral-900 border-neutral-200 [color-scheme:light]'
                            }`}
                          />
                        </div>
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>Status</label>
                          <select
                            value={editStatus}
                            onChange={(e) => setEditStatus(e.target.value as 'completed' | 'pending' | 'processing')}
                            className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:ring-0 focus:outline-none ${
                              isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'
                            }`}
                          >
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                          </select>
                        </div>
                      </div>

                      <div className="flex gap-3 pt-2">
                        <button
                          type="submit"
                          className="px-8 py-3 rounded-full bg-vestexa-coral text-white font-bold text-sm hover:bg-vestexa-coral-hover transition-all shadow-pill"
                        >
                          Save Changes &amp; Recalculate Balance
                        </button>
                        <button
                          type="button"
                          onClick={() => setEditingTxn(null)}
                          className={`px-6 py-3 rounded-full font-semibold text-sm transition-colors ${
                            isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200'
                          }`}
                        >
                          Cancel
                        </button>
                      </div>
                    </form>
                  </div>
                )}

                {/* Transaction Table */}
                <div className={`rounded-3xl border overflow-hidden shadow-xl ${
                  isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200/80 shadow-card'
                }`}>
                  <div className={`grid grid-cols-12 gap-4 px-6 py-4 text-xs font-bold uppercase tracking-wider border-b ${
                    isDark ? 'border-gray-800 bg-[#0D1117]/80 text-gray-400' : 'border-neutral-200 bg-neutral-100/80 text-neutral-600'
                  }`}>
                    <div className="col-span-3">Narration</div>
                    <div className="col-span-2">Sender</div>
                    <div className="col-span-2">Category</div>
                    <div className="col-span-2">Date / Time</div>
                    <div className="col-span-1">Type</div>
                    <div className="col-span-2 text-right">Amount / Actions</div>
                  </div>

                  <div className="max-h-[600px] overflow-y-auto">
                    {userTransactions.length === 0 ? (
                      <div className="text-center py-16 text-gray-500">
                        <span className="material-symbols-outlined text-4xl mb-3 block">receipt_long</span>
                        <p className="text-sm font-medium">No transactions for this account</p>
                      </div>
                    ) : (
                      userTransactions.map((txn, idx) => (
                        <div
                          key={txn.id}
                          className={`grid grid-cols-12 gap-4 px-6 py-4 items-center text-sm transition-colors border-b ${
                            isDark ? 'hover:bg-gray-800/50 border-gray-800/40' : 'hover:bg-neutral-50 border-neutral-100'
                          } ${
                            idx % 2 === 1 ? (isDark ? 'bg-[#0D1117]/30' : 'bg-neutral-50/50') : ''
                          }`}
                        >
                          <div className={`col-span-3 font-medium truncate ${isDark ? 'text-white' : 'text-neutral-900'}`}>{txn.narration}</div>
                          <div className={`col-span-2 truncate text-xs ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>{txn.senderInfo}</div>
                          <div className="col-span-2">
                            <span className={`px-2.5 py-1 rounded-full text-xs font-semibold ${
                              isDark ? 'bg-gray-800 text-gray-300' : 'bg-neutral-100 text-neutral-700 border border-neutral-200'
                            }`}>{txn.category}</span>
                          </div>
                          <div className={`col-span-2 text-xs font-medium ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>{txn.date} {txn.time}</div>
                          <div className="col-span-1">
                            <span className={`text-xs font-extrabold ${txn.type === 'credit' ? 'text-emerald-500 dark:text-emerald-400' : 'text-vestexa-coral'}`}>
                              {txn.type === 'credit' ? 'CR' : 'DR'}
                            </span>
                          </div>
                          <div className="col-span-2 text-right flex flex-col items-end gap-1.5">
                            <span className={`font-mono font-bold ${txn.type === 'credit' ? 'text-emerald-500 dark:text-emerald-400' : (isDark ? 'text-white' : 'text-neutral-900')}`}>
                              {txn.type === 'credit' ? '+' : '-'}{formatCurrency(txn.amount)}
                            </span>
                            <div className="flex items-center gap-2">
                              <button
                                onClick={() => startEditTxn(txn)}
                                className={`text-xs font-bold px-2 py-0.5 rounded transition-colors flex items-center gap-1 ${
                                  isDark ? 'bg-gray-800 text-gray-300 hover:text-white hover:bg-gray-700' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200'
                                }`}
                              >
                                <span className="material-symbols-outlined text-[14px]">edit</span> Edit
                              </button>
                              <button
                                onClick={() => handleDeleteTxn(txn)}
                                className={`text-xs font-bold px-2 py-0.5 rounded transition-colors flex items-center gap-1 ${
                                  isDark ? 'bg-red-500/10 text-red-400 hover:bg-red-500/20' : 'bg-red-50 text-red-600 hover:bg-red-100 border border-red-200'
                                }`}
                              >
                                <span className="material-symbols-outlined text-[14px]">delete</span> Delete
                              </button>
                            </div>
                          </div>
                        </div>
                      ))
                    )}
                  </div>
                </div>
              </div>
            )}

            {/* ═══ INVESTMENT PLANS TAB ═══ */}
            {activeTab === 'plans' && (
              <InvestmentPlansManager formatCurrency={formatCurrency} isDark={isDark} />
            )}

            {/* ═══ WITHDRAWALS TAB ═══ */}
            {activeTab === 'withdrawals' && (
              <WithdrawalManager users={users} formatCurrency={formatCurrency} isDark={isDark} />
            )}

            {/* ═══ LOANS & CREDIT TAB ═══ */}
            {activeTab === 'loans' && (
              <LoanManager users={users} formatCurrency={formatCurrency} isDark={isDark} />
            )}

            {/* ═══ KYC COMPLIANCE TAB ═══ */}
            {activeTab === 'kyc' && (
              <KycManager users={users} isDark={isDark} />
            )}

            {/* ═══ NOTIFICATIONS BROADCAST TAB ═══ */}
            {activeTab === 'notifications' && (
              <NotificationSender users={users} allowBroadcast={isSuperAdmin(admin)} isDark={isDark} />
            )}

            {/* ═══ SYSTEM SETTINGS TAB ═══ */}
            {isSuperAdmin(admin) && activeTab === 'settings' && (
              <SettingsPanel isDark={isDark} />
            )}

            {/* ═══ ADMIN TEAM & GOVERNANCE TAB ═══ */}
            {isSuperAdmin(admin) && activeTab === 'admins' && (
              <div>
                <div className="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                  <div>
                    <h1 className={`text-4xl font-display font-extrabold tracking-tight mb-2 ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                      Admin Team &amp; Governance
                    </h1>
                    <p className={`text-sm font-medium ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                      Single Super Admin protocol • Internal staff account provisioning and authority audit
                    </p>
                  </div>

                  {isSuperAdmin(admin) && (
                    <button
                      onClick={() => setShowAdminModal(true)}
                      className="px-6 py-3 rounded-full bg-vestexa-coral hover:bg-vestexa-coral-hover text-white text-sm font-bold transition-all shadow-pill flex items-center gap-2 cursor-pointer self-start sm:self-auto active:scale-95"
                    >
                      <span className="material-symbols-outlined text-[18px]">person_add</span>
                      <span>Provision Operations Admin</span>
                    </button>
                  )}
                </div>

                {/* Governance Policy Banner */}
                <div className={`mb-8 p-6 rounded-3xl border shadow-xl relative overflow-hidden ${
                  isDark ? 'bg-[#141824] border-amber-500/30' : 'bg-amber-50/60 border-amber-200'
                }`}>
                  <div className="absolute top-0 right-0 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl pointer-events-none" />
                  <div className="flex items-start gap-4">
                    <div className="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-500 dark:text-amber-400 flex items-center justify-center shrink-0 border border-amber-500/30">
                      <span className="material-symbols-outlined text-2xl">verified_user</span>
                    </div>
                    <div className="space-y-1.5 flex-1">
                      <div className="flex items-center gap-2">
                        <h2 className={`text-base font-bold font-display ${isDark ? 'text-white' : 'text-neutral-900'}`}>Single Super Admin Protocol Active</h2>
                        <span className="px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-[10px] font-extrabold uppercase tracking-wider border border-emerald-500/30">
                          Enforced
                        </span>
                      </div>
                      <p className={`text-xs leading-relaxed max-w-3xl ${isDark ? 'text-gray-300' : 'text-neutral-700'}`}>
                        Public registration for administrators from the login screen has been permanently deactivated.
                        Only the current single Super Administrator (<strong className={isDark ? 'text-white' : 'text-neutral-900'}>admin@vestexa.org</strong>) possesses
                        the cryptographic authority to provision new operations staff accounts. The system strictly restricts Super Admin status to one overall account.
                      </p>
                    </div>
                  </div>
                </div>

                {/* Admins Table */}
                <div className={`rounded-3xl border overflow-hidden shadow-xl ${
                  isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200/80 shadow-card'
                }`}>
                  <div className={`px-6 py-4 border-b flex items-center justify-between ${isDark ? 'border-gray-800' : 'border-neutral-200'}`}>
                    <div>
                      <h3 className={`text-sm font-bold uppercase tracking-wider ${isDark ? 'text-white' : 'text-neutral-900'}`}>Authorized Administrative Personnel</h3>
                      <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Total Provisioned: {adminsList.length}</p>
                    </div>
                  </div>

                  <div className={`divide-y ${isDark ? 'divide-gray-800/60' : 'divide-neutral-200'}`}>
                    {adminsList.map((a) => {
                      const isSuper = isSuperAdmin(a);
                      return (
                        <div
                          key={a.id}
                          className={`px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition-colors ${
                            isDark ? 'hover:bg-gray-800/30' : 'hover:bg-neutral-50'
                          }`}
                        >
                          <div className="flex items-center gap-3">
                            <div className={`w-10 h-10 rounded-2xl flex items-center justify-center font-bold text-sm ${
                              isSuper ? 'bg-amber-500/20 text-amber-600 dark:text-amber-300 border border-amber-500/40' : 'bg-blue-500/20 text-blue-600 dark:text-blue-300'
                            }`}>
                              {a.fullName.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase()}
                            </div>
                            <div>
                              <div className="flex items-center gap-2">
                                <span className={`text-sm font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{a.fullName}</span>
                                {isSuper ? (
                                  <span className="px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-600 dark:text-amber-300 text-[10px] font-extrabold border border-amber-500/30 uppercase tracking-wider flex items-center gap-1">
                                    <span className="material-symbols-outlined text-[12px]">shield</span>
                                    Super Admin
                                  </span>
                                ) : (
                                  <span className="px-2 py-0.5 rounded-full bg-blue-500/20 text-blue-600 dark:text-blue-300 text-[10px] font-bold border border-blue-500/30 uppercase tracking-wider">
                                    Operations Staff
                                  </span>
                                )}
                              </div>
                              <span className={`text-xs font-mono ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>{a.email}</span>
                              {!isSuper && isSuperAdmin(admin) && (
                                <label className={`block mt-2 text-[11px] font-semibold ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                                  Assigned accounts
                                  <select
                                    multiple
                                    value={a.assignedUserIds || []}
                                    onChange={(event) => handleAssignmentChange(a, Array.from(event.target.selectedOptions, option => option.value))}
                                    className={`block mt-1 min-w-[220px] rounded-xl border px-2 py-1.5 text-xs ${isDark ? 'bg-[#0B0F14] border-gray-800 text-white' : 'bg-white border-neutral-200 text-neutral-900'}`}
                                  >
                                    {users.map(user => <option key={user.id} value={user.id}>{user.fullName}</option>)}
                                  </select>
                                </label>
                              )}
                            </div>
                          </div>

                          <div className="flex items-center gap-4 text-xs">
                            <div className={`text-right ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                              <span className={`block text-[10px] uppercase tracking-wider ${isDark ? 'text-gray-500' : 'text-neutral-400'}`}>Provisioned On</span>
                              <span>{new Date(a.createdAt).toLocaleDateString()}</span>
                            </div>

                            {isSuper ? (
                              <span className={`px-3 py-1.5 rounded-xl text-xs font-semibold flex items-center gap-1 ${
                                isDark ? 'bg-gray-800/60 text-gray-400' : 'bg-neutral-100 text-neutral-600 border border-neutral-200'
                              }`}>
                                <span className="material-symbols-outlined text-[14px]">lock</span>
                                Protected
                              </span>
                            ) : (
                              isSuperAdmin(admin) && (
                                <button
                                  onClick={() => handleDeleteAdminClick(a)}
                                  className={`px-3 py-1.5 rounded-xl text-xs font-bold transition-colors flex items-center gap-1 ${
                                    isDark ? 'bg-red-500/10 hover:bg-red-500/20 text-red-400' : 'bg-red-50 hover:bg-red-100 text-red-600 border border-red-200'
                                  }`}
                                >
                                  <span className="material-symbols-outlined text-[14px]">person_remove</span>
                                  Revoke
                                </button>
                              )
                            )}
                          </div>
                        </div>
                      );
                    })}
                  </div>
                </div>
              </div>
            )}

            {/* ═══ PROVISION NEW ADMIN MODAL ═══ */}
            {showAdminModal && (
              <div className="fixed inset-0 bg-black/75 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                <div className={`border rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl relative ${
                  isDark ? 'bg-[#141824] border-white/10 text-white' : 'bg-white border-neutral-200 text-neutral-900'
                }`}>
                  <div className="flex items-center gap-3 mb-6">
                    <div className="w-10 h-10 rounded-2xl bg-vestexa-coral/20 text-vestexa-coral flex items-center justify-center">
                      <span className="material-symbols-outlined text-xl">person_add</span>
                    </div>
                    <div>
                      <h2 className={`text-lg font-bold font-display ${isDark ? 'text-white' : 'text-neutral-900'}`}>Provision Operations Admin</h2>
                      <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Internal creation under Super Admin authority</p>
                    </div>
                  </div>

                  <form onSubmit={handleCreateAdminSubmit} className="space-y-4">
                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                        Staff Full Name
                      </label>
                      <input
                        type="text"
                        value={newAdminName}
                        onChange={(e) => setNewAdminName(e.target.value)}
                        required
                        placeholder="e.g. Marcus Vance"
                        className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none ${
                          isDark
                            ? 'bg-[#0B0F14] text-white border-gray-800 placeholder:text-gray-600'
                            : 'bg-neutral-50 text-neutral-900 border-neutral-200 placeholder:text-neutral-400'
                        }`}
                      />
                    </div>

                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                        Staff Email Address
                      </label>
                      <input
                        type="email"
                        value={newAdminEmail}
                        onChange={(e) => setNewAdminEmail(e.target.value)}
                        required
                            placeholder="e.g. m.vance@vestexa.org"
                        className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none ${
                          isDark
                            ? 'bg-[#0B0F14] text-white border-gray-800 placeholder:text-gray-600'
                            : 'bg-neutral-50 text-neutral-900 border-neutral-200 placeholder:text-neutral-400'
                        }`}
                      />
                    </div>

                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                        Temporary Password
                      </label>
                      <input
                        type="password"
                        value={newAdminPassword}
                        onChange={(e) => setNewAdminPassword(e.target.value)}
                        required
                        placeholder="Minimum 6 characters"
                        className={`w-full text-sm rounded-2xl px-4 py-3.5 border focus:border-vestexa-coral focus:ring-0 focus:outline-none ${
                          isDark
                            ? 'bg-[#0B0F14] text-white border-gray-800 placeholder:text-gray-600'
                            : 'bg-neutral-50 text-neutral-900 border-neutral-200 placeholder:text-neutral-400'
                        }`}
                      />
                    </div>

                    <div className={`p-3 rounded-2xl border text-xs font-medium space-y-1 ${
                      isDark ? 'bg-blue-500/10 border-blue-500/20 text-blue-300' : 'bg-blue-50 border-blue-200 text-blue-800'
                    }`}>
                      <span className={`font-bold flex items-center gap-1 ${isDark ? 'text-blue-200' : 'text-blue-900'}`}>
                        <span className="material-symbols-outlined text-[14px]">info</span>
                        Role: Operations Staff
                      </span>
                      <p className={`text-[11px] ${isDark ? 'text-blue-300/80' : 'text-blue-700'}`}>
                        Account will have administrative operational capabilities but cannot create or delete other admins. Only the single Super Administrator holds provisioning authority.
                      </p>
                    </div>

                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
                        Assigned User Accounts
                      </label>
                      <select
                        multiple
                        value={newAdminAssignedUserIds}
                        onChange={(event) => setNewAdminAssignedUserIds(Array.from(event.target.selectedOptions, option => option.value))}
                        className={`w-full min-h-28 text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${isDark ? 'bg-[#0B0F14] text-white border-gray-800' : 'bg-neutral-50 text-neutral-900 border-neutral-200'}`}
                      >
                        {users.map(user => <option key={user.id} value={user.id}>{user.fullName} ({user.email})</option>)}
                      </select>
                      <p className={`text-[11px] mt-1.5 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                        Hold Ctrl (or Cmd) to select specific client accounts. If none are selected, staff can oversee all client accounts.
                      </p>
                    </div>

                    <div className="flex gap-3 pt-2">
                      <button
                        type="submit"
                        disabled={adminSubmitting}
                        className="flex-1 py-3.5 rounded-full bg-vestexa-coral text-white font-bold text-sm hover:bg-vestexa-coral-hover transition-all shadow-pill disabled:opacity-50"
                      >
                        {adminSubmitting ? 'Provisioning...' : 'Provision Admin'}
                      </button>
                      <button
                        type="button"
                        onClick={() => setShowAdminModal(false)}
                        className={`px-6 py-3.5 rounded-full font-semibold text-sm transition-colors ${
                          isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200'
                        }`}
                      >
                        Cancel
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            )}
          </div>
        </main>
      </div>
    </div>
  );
};
