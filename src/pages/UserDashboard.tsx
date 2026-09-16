import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { getTransactionsByUserId, updateUserProfile, getNotifications } from '../lib/storage';
import { getBtcPrice, usdToBtc } from '../lib/btcPrice';
import { compressImage } from '../lib/imageCompressor';
import type { Transaction, QuickTransferContact } from '../lib/storage';
import { SvgWordmark } from '../components/SvgWordmark';
import { InvestmentsSection } from '../components/dashboard/InvestmentsSection';
import { TransfersSection } from '../components/dashboard/TransfersSection';
import { LoansSection } from '../components/dashboard/LoansSection';
import { BeneficiariesSection } from '../components/dashboard/BeneficiariesSection';
import { NotificationsSection } from '../components/dashboard/NotificationsSection';
import { ReferralsSection } from '../components/dashboard/ReferralsSection';

export const UserDashboard: React.FC = () => {
  const { user, logoutUser, refreshUser } = useAuth();
  const navigate = useNavigate();
  const [transactions, setTransactions] = useState<Transaction[]>([]);
  const [btcPrice, setBtcPrice] = useState<number>(97850);
  const [activeNav, setActiveNav] = useState('Dashboard');
  const [searchQuery, setSearchQuery] = useState('');

  // Theme state: default to 'dark' or stored preference
  const [theme, setTheme] = useState<'dark' | 'light'>(() => {
    return (localStorage.getItem('vestexa_theme') as 'dark' | 'light') || 'dark';
  });

  // Profile editing state
  const [phoneNumber, setPhoneNumber] = useState('');
  const [address, setAddress] = useState('');
  const [ssn, setSsn] = useState('');
  const [showSsn, setShowSsn] = useState(false);
  const [idType, setIdType] = useState<'drivers_license' | 'passport'>('drivers_license');
  const [avatarUrl, setAvatarUrl] = useState<string | undefined>(undefined);
  const [idDocumentUrl, setIdDocumentUrl] = useState<string | undefined>(undefined);
  const [idDocumentBackUrl, setIdDocumentBackUrl] = useState<string | undefined>(undefined);
  const [profileSuccessMsg, setProfileSuccessMsg] = useState('');
  const [uploadingAvatar, setUploadingAvatar] = useState(false);
  const [uploadingIdFront, setUploadingIdFront] = useState(false);
  const [uploadingIdBack, setUploadingIdBack] = useState(false);

  // Security & Crypto state
  const [userPin, setUserPin] = useState('');
  const [twoFactorEnabled, setTwoFactorEnabled] = useState(false);
  const [btcAddress, setBtcAddress] = useState('');
  const [ethAddress, setEthAddress] = useState('');
  const [usdtAddress, setUsdtAddress] = useState('');
  const [copiedAcc, setCopiedAcc] = useState(false);

  // Quick Transfer states
  const [showAddContactModal, setShowAddContactModal] = useState(false);
  const [newContactName, setNewContactName] = useState('');
  const [newContactInitials, setNewContactInitials] = useState('');
  const [newContactBg, setNewContactBg] = useState('bg-blue-500/20 text-blue-400');
  const [selectedRecipient, setSelectedRecipient] = useState<string | null>(null);
  const [quickAmount, setQuickAmount] = useState('');
  const [quickSuccessMsg, setQuickSuccessMsg] = useState('');

  const toggleTheme = () => {
    const nextTheme = theme === 'dark' ? 'light' : 'dark';
    setTheme(nextTheme);
    localStorage.setItem('vestexa_theme', nextTheme);
  };

  useEffect(() => {
    if (!user) {
      navigate('/login');
      return;
    }
    // faceless-fintech workflow: Ensure 4-digit PIN authentication is verified
    if (user.pinstatus !== 0) {
      navigate('/pin');
      return;
    }
    refreshUser();
  }, [user, navigate]);

  useEffect(() => {
    if (user) {
      setTransactions(getTransactionsByUserId(user.id));
      setPhoneNumber(user.phoneNumber || '');
      setAddress(user.address || '');
      setSsn(user.ssn || '');
      setIdType(user.idType || 'drivers_license');
      setAvatarUrl(user.avatarUrl);
      setIdDocumentUrl(user.idDocumentUrl);
      setIdDocumentBackUrl(user.idDocumentBackUrl);
      setUserPin(user.pin || '');
      setTwoFactorEnabled(Boolean(user.twoFactorEnabled));
      setBtcAddress(user.btcAddress || '');
      setEthAddress(user.ethAddress || '');
      setUsdtAddress(user.usdtAddress || '');
    }
  }, [user]);

  useEffect(() => {
    getBtcPrice().then(setBtcPrice);
  }, []);

  // Poll for transaction updates every 3 seconds
  useEffect(() => {
    if (!user) return;
    const interval = setInterval(() => {
      refreshUser();
      setTransactions(getTransactionsByUserId(user.id));
    }, 3000);
    return () => clearInterval(interval);
  }, [user, refreshUser]);

  if (!user || user.pinstatus !== 0) return null;

  const isDark = theme === 'dark';
  const notifications = user ? getNotifications(user.id) : [];
  const unreadCount = notifications.filter(n => !n.isRead).length;

  const navItems = [
    { name: 'Dashboard', icon: 'dashboard' },
    { name: 'Investments', icon: 'trending_up' },
    { name: 'Transfers', icon: 'swap_horiz' },
    { name: 'Loans', icon: 'account_balance' },
    { name: 'Beneficiaries', icon: 'group' },
    { name: 'Refer & Earn', icon: 'share' },
    { name: 'Notifications', icon: 'notifications', badge: unreadCount },
    { name: 'Profile', icon: 'person' },
    { name: 'Transactions', icon: 'receipt_long' },
    { name: 'Analytics', icon: 'leaderboard' },
    { name: 'Settings', icon: 'settings' },
  ];

  const formatCurrency = (amount: number): string => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 2,
    }).format(amount);
  };

  const formatDate = (date: string, time: string): string => {
    const now = new Date();
    const txDate = new Date(`${date}T${time || '00:00'}`);
    const diffMs = now.getTime() - txDate.getTime();
    const diffDays = Math.floor(diffMs / 86400000);

    if (diffDays === 0) return `Today, ${formatTime(time)}`;
    if (diffDays === 1) return 'Yesterday';
    if (diffDays < 7) return `${diffDays} days ago`;

    return txDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
  };

  const formatTime = (time: string): string => {
    if (!time) return '';
    const [h, m] = time.split(':').map(Number);
    const ampm = h >= 12 ? 'PM' : 'AM';
    const hour = h % 12 || 12;
    return `${hour}:${m.toString().padStart(2, '0')} ${ampm}`;
  };

  const getCategoryColor = (category: string): string => {
    const colors: Record<string, string> = {
      'Interest': isDark ? 'bg-vestexa-peach text-vestexa-coral' : 'bg-rose-100 text-vestexa-coral',
      'Deposit': isDark ? 'bg-purple-500/10 text-purple-400' : 'bg-purple-100 text-purple-700',
      'Wire Transfer': isDark ? 'bg-blue-500/10 text-blue-400' : 'bg-blue-100 text-blue-700',
      'Dividend': isDark ? 'bg-emerald-500/10 text-emerald-400' : 'bg-emerald-100 text-emerald-700',
      'Investment Return': isDark ? 'bg-purple-500/10 text-purple-400' : 'bg-purple-100 text-purple-700',
      'Fee': isDark ? 'bg-red-500/10 text-red-400' : 'bg-red-100 text-red-700',
      'Withdrawal': isDark ? 'bg-orange-500/10 text-orange-400' : 'bg-orange-100 text-orange-700',
    };
    return colors[category] || (isDark ? 'bg-gray-800 text-gray-300' : 'bg-slate-200 text-slate-700');
  };

  const handleAvatarUpload = async (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (!file || !user) return;
    try {
      setUploadingAvatar(true);
      const compressedUrl = await compressImage(file, 400, 400, 0.85);
      setAvatarUrl(compressedUrl);
      updateUserProfile(user.id, { avatarUrl: compressedUrl });
      refreshUser();
      setProfileSuccessMsg('Profile picture uploaded and saved successfully!');
      setTimeout(() => setProfileSuccessMsg(''), 4000);
    } catch (err) {
      console.error('Failed to process profile photo:', err);
      setProfileSuccessMsg('Failed to process image. Please try a different photo.');
    } finally {
      setUploadingAvatar(false);
      e.target.value = '';
    }
  };

  const handleRemoveAvatar = () => {
    if (!user) return;
    setAvatarUrl(undefined);
    updateUserProfile(user.id, { avatarUrl: '' });
    refreshUser();
    setProfileSuccessMsg('Profile picture removed.');
    setTimeout(() => setProfileSuccessMsg(''), 4000);
  };

  const handleIdFrontUpload = async (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (!file || !user) return;
    try {
      setUploadingIdFront(true);
      const compressedUrl = await compressImage(file, 1000, 1000, 0.85);
      setIdDocumentUrl(compressedUrl);
      updateUserProfile(user.id, { idDocumentUrl: compressedUrl });
      refreshUser();
      setProfileSuccessMsg('ID Front document uploaded and saved successfully!');
      setTimeout(() => setProfileSuccessMsg(''), 4000);
    } catch (err) {
      console.error('Failed to process ID document:', err);
    } finally {
      setUploadingIdFront(false);
      e.target.value = '';
    }
  };

  const handleRemoveIdFront = () => {
    if (!user) return;
    setIdDocumentUrl(undefined);
    updateUserProfile(user.id, { idDocumentUrl: '' });
    refreshUser();
    setProfileSuccessMsg('ID Front document removed.');
    setTimeout(() => setProfileSuccessMsg(''), 4000);
  };

  const handleIdBackUpload = async (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (!file || !user) return;
    try {
      setUploadingIdBack(true);
      const compressedUrl = await compressImage(file, 1000, 1000, 0.85);
      setIdDocumentBackUrl(compressedUrl);
      updateUserProfile(user.id, { idDocumentBackUrl: compressedUrl });
      refreshUser();
      setProfileSuccessMsg('ID Back document uploaded and saved successfully!');
      setTimeout(() => setProfileSuccessMsg(''), 4000);
    } catch (err) {
      console.error('Failed to process ID back document:', err);
    } finally {
      setUploadingIdBack(false);
      e.target.value = '';
    }
  };

  const handleRemoveIdBack = () => {
    if (!user) return;
    setIdDocumentBackUrl(undefined);
    updateUserProfile(user.id, { idDocumentBackUrl: '' });
    refreshUser();
    setProfileSuccessMsg('ID Back document removed.');
    setTimeout(() => setProfileSuccessMsg(''), 4000);
  };

  const handleSaveProfile = (e: React.FormEvent) => {
    e.preventDefault();
    if (!user) return;
    updateUserProfile(user.id, {
      phoneNumber,
      address,
      ssn,
      idType,
      avatarUrl: avatarUrl || '',
      idDocumentUrl: idDocumentUrl || '',
      idDocumentBackUrl: idDocumentBackUrl || '',
      pin: userPin,
      twoFactorEnabled,
      btcAddress,
      ethAddress,
      usdtAddress,
    });
    refreshUser();
    setProfileSuccessMsg('Profile details and security credentials saved successfully!');
    setTimeout(() => setProfileSuccessMsg(''), 4000);
  };

  const handleAddContact = (e: React.FormEvent) => {
    e.preventDefault();
    if (!newContactName.trim() || !user) return;
    const name = newContactName.trim();
    const initials = newContactInitials.trim()
      ? newContactInitials.trim().toUpperCase().slice(0, 3)
      : name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);

    const newContact: QuickTransferContact = {
      id: `contact-${Date.now()}`,
      name,
      initials: initials || 'QT',
      avatarBg: newContactBg,
    };

    const updated = [...(user.quickTransferContacts || []), newContact];
    updateUserProfile(user.id, { quickTransferContacts: updated });
    refreshUser();
    setNewContactName('');
    setNewContactInitials('');
    setShowAddContactModal(false);
  };

  const handleDeleteContact = (e: React.MouseEvent, contactId: string) => {
    e.stopPropagation();
    if (!user) return;
    const updated = (user.quickTransferContacts || []).filter(c => c.id !== contactId);
    updateUserProfile(user.id, { quickTransferContacts: updated });
    refreshUser();
    if (selectedRecipient === contactId) {
      setSelectedRecipient(null);
    }
  };

  const totalInvested = user.investedAmount !== undefined && user.investedAmount !== null
    ? user.investedAmount
    : Math.round(user.balance * 0.156);

  const amountSpent = user.amountSpent !== undefined && user.amountSpent !== null
    ? user.amountSpent
    : 4500;

  const spentPercent = Math.min(100, Math.max(0, Math.round((amountSpent / 10000) * 100)));
  const rewardPoints = Math.round(user.balance * 0.0334);

  const filteredTransactions = searchQuery
    ? transactions.filter(t =>
        t.narration.toLowerCase().includes(searchQuery.toLowerCase()) ||
        t.category.toLowerCase().includes(searchQuery.toLowerCase()) ||
        t.senderInfo.toLowerCase().includes(searchQuery.toLowerCase())
      )
    : transactions;

  const quickContacts = user.quickTransferContacts || [];

  return (
    <div className={`min-h-screen flex font-sans antialiased transition-colors duration-300 ${
      isDark ? 'bg-[#0B0F14] text-[#e5e2e1]' : 'bg-[#FBF9F8] text-neutral-900'
    }`}>
      {/* ─── Side Navigation (Jeton Style) ─── */}
      <nav className={`hidden md:flex flex-col h-screen w-64 fixed left-0 top-0 py-6 px-4 z-50 transition-colors duration-300 ${
        isDark ? 'bg-[#141824] border-r border-white/10' : 'bg-white border-r border-neutral-200/80 shadow-sm'
      }`}>
        {/* Brand */}
        <div className="mb-8 px-2 flex flex-col">
          <div className="flex items-center gap-2 mb-1.5">
            <SvgWordmark tone={isDark ? 'white' : 'orange'} brand="vestexa" />
          </div>
          <span className={`text-[11px] font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
            Private Investment
          </span>
        </div>

        {/* CTA Button — Jeton Coral Pill */}
        <button
          onClick={() => setActiveNav('Transfers')}
          className="w-full py-3 rounded-full text-white font-display text-xs font-bold mb-6 bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all duration-200 flex items-center justify-center gap-2 transform hover:-translate-y-0.5 active:scale-95"
        >
          <span className="material-symbols-outlined text-sm" style={{ fontVariationSettings: "'FILL' 1" }}>add</span>
          New Transfer
        </button>

        {/* Nav Links */}
        <div className="flex-1 space-y-1 overflow-y-auto no-scrollbar pr-1">
          {navItems.map((item) => {
            const isActive = activeNav === item.name;
            return (
              <a
                key={item.name}
                href="#"
                onClick={(e) => { e.preventDefault(); setActiveNav(item.name); }}
                className={`flex items-center gap-3 px-4 py-2.5 rounded-2xl font-bold text-xs transition-all duration-200 ${
                  isActive
                    ? 'bg-vestexa-coral text-white shadow-pill'
                    : isDark
                      ? 'text-gray-400 hover:bg-gray-800/60 hover:text-white'
                      : 'text-neutral-600 hover:bg-vestexa-coral/10 hover:text-vestexa-coral'
                }`}
              >
                <span
                  className="material-symbols-outlined text-lg"
                  style={isActive ? { fontVariationSettings: "'FILL' 1" } : undefined}
                >
                  {item.icon}
                </span>
                <span className="flex-1">{item.name}</span>
                {Boolean(item.badge && item.badge > 0) && (
                  <span className="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-vestexa-coral text-white shadow-sm">
                    {item.badge}
                  </span>
                )}
              </a>
            );
          })}
        </div>

        {/* Footer Links & Theme Toggle */}
        <div className={`mt-auto space-y-2 pt-4 border-t ${isDark ? 'border-white/10' : 'border-neutral-200'}`}>
          {/* Theme Switcher Button */}
          <button
            onClick={toggleTheme}
            className={`flex items-center justify-between px-4 py-3 rounded-2xl text-sm font-semibold transition-all w-full ${
              isDark
                ? 'bg-gray-800/60 text-gray-200 hover:bg-gray-800'
                : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200'
            }`}
          >
            <div className="flex items-center gap-3">
              <span className="material-symbols-outlined text-xl text-amber-500">
                {isDark ? 'dark_mode' : 'light_mode'}
              </span>
              <span>{isDark ? 'Dark Mode' : 'Light Mode'}</span>
            </div>
            <span className="text-xs font-bold px-2 py-0.5 rounded-full bg-vestexa-coral/20 text-vestexa-coral">
              Toggle
            </span>
          </button>

          <a href="#" className={`flex items-center gap-3 px-4 py-2.5 rounded-2xl text-sm font-semibold transition-colors ${
            isDark ? 'text-gray-400 hover:bg-gray-800/60 hover:text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900'
          }`}>
            <span className="material-symbols-outlined text-xl">help</span>
            <span>Support</span>
          </a>
          <button
            onClick={() => { logoutUser(); navigate('/login'); }}
            className={`flex items-center gap-3 px-4 py-2.5 rounded-2xl text-sm font-semibold transition-colors w-full text-left ${
              isDark ? 'text-gray-400 hover:bg-gray-800/60 hover:text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900'
            }`}
          >
            <span className="material-symbols-outlined text-xl">logout</span>
            <span>Logout</span>
          </button>
        </div>
      </nav>

      {/* ─── Main Content ─── */}
      <div className={`flex-1 md:ml-64 flex flex-col min-h-screen relative overflow-hidden transition-colors duration-300 ${
        isDark ? 'bg-[#0B0F14]' : 'bg-[#FBF9F8]'
      }`}>
        {/* Ambient Glows */}
        {isDark ? (
          <>
            <div className="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] rounded-full bg-vestexa-coral/10 blur-[140px] pointer-events-none" />
            <div className="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-purple-600/10 blur-[140px] pointer-events-none" />
          </>
        ) : (
          <>
            <div className="absolute top-[-10%] right-[-5%] w-[45%] h-[45%] rounded-full bg-vestexa-coral/5 blur-[120px] pointer-events-none" />
            <div className="absolute bottom-[-10%] left-[-5%] w-[35%] h-[35%] rounded-full bg-rose-500/5 blur-[120px] pointer-events-none" />
          </>
        )}

        {/* ─── Top App Bar ─── */}
        <header className={`fixed top-0 right-0 w-full md:w-[calc(100%-16rem)] h-16 backdrop-blur-xl z-40 flex justify-between items-center px-4 sm:px-8 border-b transition-colors duration-300 ${
          isDark
            ? 'bg-[#141824]/90 border-white/10 text-white'
            : 'bg-white/90 border-neutral-200/80 shadow-sm text-neutral-900'
        }`}>
          {/* Mobile Brand */}
          <div className="md:hidden flex items-center gap-2">
            <SvgWordmark tone={isDark ? 'white' : 'orange'} brand="vestexa" />
          </div>

          {/* Search */}
          <div className="hidden md:flex items-center flex-1 max-w-md relative group">
            <span className="material-symbols-outlined absolute left-3.5 text-neutral-400 group-focus-within:text-vestexa-coral transition-colors">search</span>
            <input
              className={`w-full text-sm rounded-full pl-10 pr-4 py-2 border transition-all focus:outline-none ${
                isDark
                  ? 'bg-[#0D1117] text-white border-white/10 focus:border-vestexa-coral placeholder:text-gray-500'
                  : 'bg-neutral-50 text-neutral-900 border-neutral-200 focus:border-vestexa-coral focus:bg-white focus:ring-2 focus:ring-vestexa-coral/20 placeholder:text-neutral-400'
              }`}
              placeholder="Search transactions, accounts..."
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
            />
          </div>

          {/* Right Actions */}
          <div className="flex items-center gap-3 ml-auto">
            {/* Theme Toggle Button Header */}
            <button
              onClick={toggleTheme}
              title={`Switch to ${isDark ? 'Light' : 'Dark'} Mode`}
              className={`p-2 rounded-full transition-all flex items-center justify-center ${
                isDark
                  ? 'text-amber-400 hover:bg-gray-800'
                  : 'text-neutral-700 hover:bg-neutral-100 border border-neutral-200 shadow-sm'
              }`}
            >
              <span className="material-symbols-outlined text-xl">
                {isDark ? 'light_mode' : 'dark_mode'}
              </span>
            </button>

            <button
              onClick={() => setActiveNav('Notifications')}
              title="Notifications"
              className={`p-2 rounded-full transition-all relative ${
                isDark ? 'text-gray-400 hover:text-white hover:bg-gray-800/60' : 'text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100'
              }`}
            >
              <span className="material-symbols-outlined text-xl">notifications</span>
              {unreadCount > 0 && (
                <span className="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-vestexa-coral ring-2 ring-[#141824]" />
              )}
            </button>
            <button className={`hidden sm:flex p-2 rounded-full transition-all ${
              isDark ? 'text-gray-400 hover:text-white hover:bg-gray-800/60' : 'text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100'
            }`}>
              <span className="material-symbols-outlined text-xl">help_outline</span>
            </button>
            <div className={`h-6 w-px mx-1 hidden sm:block ${isDark ? 'bg-white/10' : 'bg-neutral-200'}`} />

            {/* User Avatar Clickable to Profile */}
            <button
              onClick={() => setActiveNav('Profile')}
              className="flex items-center gap-2 group cursor-pointer focus:outline-none"
            >
              {user.avatarUrl ? (
                <img
                  src={user.avatarUrl}
                  alt={user.fullName}
                  className="w-9 h-9 rounded-full object-cover ring-2 ring-vestexa-coral shadow-pill"
                />
              ) : (
                <div className="w-9 h-9 rounded-full bg-vestexa-coral text-white flex items-center justify-center font-bold text-sm shadow-pill">
                  {user.fullName.split(' ').map(n => n[0]).join('').substring(0, 2)}
                </div>
              )}
            </button>
          </div>
        </header>

        {/* ─── Page Content ─── */}
        <main className="flex-1 pt-24 px-4 sm:px-8 pb-12 overflow-y-auto z-10 relative">
          <div className="max-w-[1440px] mx-auto">
            {/* ═══ INVESTMENTS VIEW ═══ */}
            {activeNav === 'Investments' && (
              <InvestmentsSection
                user={user}
                isDark={isDark}
                onUserUpdate={refreshUser}
                formatCurrency={formatCurrency}
              />
            )}

            {/* ═══ TRANSFERS VIEW ═══ */}
            {activeNav === 'Transfers' && (
              <TransfersSection
                user={user}
                isDark={isDark}
                onUserUpdate={refreshUser}
                formatCurrency={formatCurrency}
              />
            )}

            {/* ═══ LOANS VIEW ═══ */}
            {activeNav === 'Loans' && (
              <LoansSection
                user={user}
                isDark={isDark}
                onUserUpdate={refreshUser}
                formatCurrency={formatCurrency}
              />
            )}

            {/* ═══ BENEFICIARIES VIEW ═══ */}
            {activeNav === 'Beneficiaries' && (
              <BeneficiariesSection
                user={user}
                isDark={isDark}
                onNavigateToTransfers={() => setActiveNav('Transfers')}
              />
            )}

            {/* ═══ REFERRALS VIEW ═══ */}
            {(activeNav === 'Refer & Earn' || activeNav === 'Referrals') && (
              <ReferralsSection
                user={user}
                isDark={isDark}
                formatCurrency={formatCurrency}
              />
            )}

            {/* ═══ NOTIFICATIONS VIEW ═══ */}
            {activeNav === 'Notifications' && (
              <NotificationsSection
                user={user}
                isDark={isDark}
              />
            )}

            {/* ═══ PROFILE VIEW ═══ */}
            {activeNav === 'Profile' ? (
              <div>
                <div className="mb-8">
                  <h1 className={`text-4xl font-display font-extrabold tracking-tight mb-2 ${isDark ? 'text-white' : 'text-slate-900'}`}>
                    Account Profile & KYC
                  </h1>
                  <p className={`text-sm font-medium ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                    Manage your personal details, profile picture, and identification documents
                  </p>
                </div>

                {profileSuccessMsg && (
                  <div className="mb-6 bg-emerald-500/10 border border-emerald-500/30 text-emerald-500 text-sm px-5 py-3.5 rounded-2xl flex items-center gap-2">
                    <span className="material-symbols-outlined text-[18px]">check_circle</span>
                    {profileSuccessMsg}
                  </div>
                )}

                <form onSubmit={handleSaveProfile} className="space-y-8 max-w-4xl">
                  {/* Account Identity & Tier Card */}
                  <div className={`p-6 sm:p-8 rounded-3xl border ${
                    isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-card'
                  }`}>
                    <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                      <div>
                        <span className={`text-[11px] font-bold uppercase tracking-wider block mb-1 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          Account Number & Identity
                        </span>
                        <div className="flex items-center gap-3">
                          <span className="font-mono text-2xl font-extrabold text-vestexa-coral">
                            {user.accountNumber || 'VX-89210041'}
                          </span>
                          <button
                            type="button"
                            onClick={() => {
                              navigator.clipboard.writeText(user.accountNumber || 'VX-89210041');
                              setCopiedAcc(true);
                              setTimeout(() => setCopiedAcc(false), 2000);
                            }}
                            className="p-1.5 rounded-xl bg-vestexa-coral/10 text-vestexa-coral hover:bg-vestexa-coral/20 text-xs font-bold transition-all flex items-center gap-1"
                          >
                            <span className="material-symbols-outlined text-sm">{copiedAcc ? 'check' : 'content_copy'}</span>
                            {copiedAcc ? 'Copied' : 'Copy'}
                          </button>
                        </div>
                      </div>

                      <div className="flex flex-wrap gap-2">
                        <span className="px-3 py-1.5 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center gap-1">
                          <span className="material-symbols-outlined text-sm">workspace_premium</span>
                          {user.accountType || 'Private Wealth Tier 1'}
                        </span>
                        <span className="px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center gap-1">
                          <span className="material-symbols-outlined text-sm">verified</span>
                          KYC {user.kycStatus || 'Verified'}
                        </span>
                        <span className={`px-3 py-1.5 rounded-full text-xs font-bold border ${
                          isDark ? 'bg-gray-800 border-gray-700 text-gray-300' : 'bg-slate-100 border-slate-200 text-slate-700'
                        }`}>
                          {user.country || 'United States'} ({user.currency || 'USD'})
                        </span>
                      </div>
                    </div>
                  </div>

                  {/* Display Picture Upload Box */}
                  <div className={`p-6 sm:p-8 rounded-3xl border ${
                    isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-card'
                  }`}>
                    <h3 className={`text-xl font-display font-bold mb-4 ${isDark ? 'text-white' : 'text-slate-900'}`}>
                      Profile Display Picture (DP)
                    </h3>
                    <div className="flex flex-col sm:flex-row items-center gap-6">
                      <div className="relative">
                        {avatarUrl ? (
                          <img
                            src={avatarUrl}
                            alt="Profile DP"
                            className="w-24 h-24 rounded-full object-cover ring-4 ring-vestexa-coral shadow-lg"
                          />
                        ) : (
                          <div className="w-24 h-24 rounded-full bg-vestexa-coral text-white font-display text-3xl font-extrabold flex items-center justify-center shadow-pill">
                            {user.fullName.split(' ').map(n => n[0]).join('').substring(0, 2)}
                          </div>
                        )}
                      </div>

                      <div className="flex flex-col gap-2 w-full sm:w-auto">
                        <label className={`cursor-pointer px-6 py-3 rounded-full text-white font-bold text-xs transition-all shadow-pill inline-flex items-center justify-center gap-2 ${
                          uploadingAvatar ? 'bg-gray-600 cursor-not-allowed' : 'bg-vestexa-coral hover:bg-vestexa-coral-hover'
                        }`}>
                          <span className={`material-symbols-outlined text-sm ${uploadingAvatar ? 'animate-spin' : ''}`}>
                            {uploadingAvatar ? 'sync' : 'photo_camera'}
                          </span>
                          {uploadingAvatar ? 'Processing & Saving...' : 'Upload New Picture'}
                          <input
                            type="file"
                            accept="image/*"
                            onChange={handleAvatarUpload}
                            disabled={uploadingAvatar}
                            className="hidden"
                          />
                        </label>
                        {avatarUrl && (
                          <button
                            type="button"
                            onClick={handleRemoveAvatar}
                            className={`px-6 py-2 rounded-full text-xs font-semibold transition-colors ${
                              isDark ? 'text-red-400 hover:bg-red-500/10' : 'text-red-600 hover:bg-red-50'
                            }`}
                          >
                            Remove Picture
                          </button>
                        )}
                        <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          Supported formats: JPG, PNG, WEBP (Auto-optimized)
                        </p>
                      </div>
                    </div>
                  </div>

                  {/* Personal Information Form */}
                  <div className={`p-6 sm:p-8 rounded-3xl border ${
                    isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-card'
                  }`}>
                    <h3 className={`text-xl font-display font-bold mb-6 ${isDark ? 'text-white' : 'text-slate-900'}`}>
                      Personal Details
                    </h3>

                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                      <div>
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          Full Name
                        </label>
                        <input
                          type="text"
                          value={user.fullName}
                          disabled
                          className={`w-full text-sm rounded-2xl px-4 py-3 border opacity-75 cursor-not-allowed ${
                            isDark ? 'bg-[#0D1117] text-gray-300 border-gray-800' : 'bg-slate-100 text-slate-600 border-slate-200'
                          }`}
                        />
                      </div>

                      <div>
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          Email Address
                        </label>
                        <input
                          type="email"
                          value={user.email}
                          disabled
                          className={`w-full text-sm rounded-2xl px-4 py-3 border opacity-75 cursor-not-allowed ${
                            isDark ? 'bg-[#0D1117] text-gray-300 border-gray-800' : 'bg-slate-100 text-slate-600 border-slate-200'
                          }`}
                        />
                      </div>

                      <div>
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          Phone Number
                        </label>
                        <input
                          type="text"
                          value={phoneNumber}
                          onChange={(e) => setPhoneNumber(e.target.value)}
                          placeholder="+1 (555) 000-0000"
                          className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none transition-colors ${
                            isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                          }`}
                        />
                      </div>

                      <div>
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          Social Security Number (SSN)
                        </label>
                        <div className="relative">
                          <input
                            type={showSsn ? 'text' : 'password'}
                            value={ssn}
                            onChange={(e) => setSsn(e.target.value)}
                            placeholder="XXX-XX-XXXX"
                            className={`w-full text-sm rounded-2xl pl-4 pr-12 py-3 border focus:border-vestexa-coral focus:outline-none transition-colors font-mono ${
                              isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                            }`}
                          />
                          <button
                            type="button"
                            onClick={() => setShowSsn(!showSsn)}
                            className="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-vestexa-coral transition-colors"
                          >
                            <span className="material-symbols-outlined text-lg">
                              {showSsn ? 'visibility_off' : 'visibility'}
                            </span>
                          </button>
                        </div>
                      </div>

                      <div className="sm:col-span-2">
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          House Address
                        </label>
                        <input
                          type="text"
                          value={address}
                          onChange={(e) => setAddress(e.target.value)}
                          placeholder="Full Street Address, City, State/Province, ZIP & Country"
                          className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none transition-colors ${
                            isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                          }`}
                        />
                      </div>
                    </div>
                  </div>

                  {/* Security Credentials & Crypto Payout Settings */}
                  <div className={`p-6 sm:p-8 rounded-3xl border ${
                    isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-card'
                  }`}>
                    <h3 className={`text-xl font-display font-bold mb-6 ${isDark ? 'text-white' : 'text-slate-900'}`}>
                      Security Credentials & Crypto Payout Rails
                    </h3>

                    <div className="space-y-6">
                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                            4-Digit Transaction PIN
                          </label>
                          <input
                            type="password"
                            maxLength={4}
                            value={userPin}
                            onChange={(e) => setUserPin(e.target.value)}
                            placeholder="e.g. 1234"
                            className={`w-full text-sm font-mono font-bold rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                            }`}
                          />
                          <p className={`text-[11px] mt-1.5 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                            Required to authorize outbound wire transfers and withdrawals.
                          </p>
                        </div>

                        <div className="flex flex-col justify-between">
                          <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                            Two-Factor Authentication (2FA)
                          </label>
                          <div className={`flex items-center justify-between p-3.5 rounded-2xl border ${
                            isDark ? 'bg-[#0D1117] border-gray-800' : 'bg-slate-50 border-slate-200'
                          }`}>
                            <span className={`text-xs font-semibold ${isDark ? 'text-gray-300' : 'text-slate-700'}`}>
                              {twoFactorEnabled ? '2FA Protection Enabled' : '2FA Protection Disabled'}
                            </span>
                            <button
                              type="button"
                              onClick={() => setTwoFactorEnabled(!twoFactorEnabled)}
                              className={`px-4 py-1.5 rounded-full text-xs font-bold transition-all ${
                                twoFactorEnabled
                                  ? 'bg-emerald-500/20 text-emerald-400'
                                  : 'bg-gray-700 text-gray-400'
                              }`}
                            >
                              {twoFactorEnabled ? 'Active' : 'Enable'}
                            </button>
                          </div>
                        </div>
                      </div>

                      <div className="pt-4 border-t border-inherit space-y-4">
                        <span className={`block text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          Saved Cold Storage Withdrawal Addresses
                        </span>

                        <div>
                          <label className={`block text-[11px] font-bold mb-1 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                            Bitcoin (BTC) Destination Address
                          </label>
                          <input
                            type="text"
                            value={btcAddress}
                            onChange={(e) => setBtcAddress(e.target.value)}
                            placeholder="bc1q..."
                            className={`w-full text-xs font-mono rounded-2xl px-4 py-2.5 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                            }`}
                          />
                        </div>

                        <div>
                          <label className={`block text-[11px] font-bold mb-1 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                            Ethereum (ETH) ERC20 Address
                          </label>
                          <input
                            type="text"
                            value={ethAddress}
                            onChange={(e) => setEthAddress(e.target.value)}
                            placeholder="0x..."
                            className={`w-full text-xs font-mono rounded-2xl px-4 py-2.5 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                            }`}
                          />
                        </div>

                        <div>
                          <label className={`block text-[11px] font-bold mb-1 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                            Tether (USDT) TRC20 Address
                          </label>
                          <input
                            type="text"
                            value={usdtAddress}
                            onChange={(e) => setUsdtAddress(e.target.value)}
                            placeholder="TXv..."
                            className={`w-full text-xs font-mono rounded-2xl px-4 py-2.5 border focus:border-vestexa-coral focus:outline-none ${
                              isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                            }`}
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  {/* Identification Upload (KYC Means of ID) */}
                  <div className={`p-6 sm:p-8 rounded-3xl border ${
                    isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-card'
                  }`}>
                    <h3 className={`text-xl font-display font-bold mb-2 ${isDark ? 'text-white' : 'text-slate-900'}`}>
                      Means of Identification (KYC)
                    </h3>
                    <p className={`text-xs mb-6 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                      Please select your official identification document and upload clear images of the front and back.
                    </p>

                    <div className="mb-6">
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-3 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                        Document Type
                      </label>
                      <div className="flex gap-4">
                        <label className={`flex-1 flex items-center justify-center gap-2 p-4 rounded-2xl border cursor-pointer font-bold text-xs transition-all ${
                          idType === 'drivers_license'
                            ? 'bg-vestexa-coral text-white border-vestexa-coral shadow-pill'
                            : isDark ? 'bg-[#0D1117] text-gray-400 border-gray-800 hover:bg-gray-800' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'
                        }`}>
                          <input
                            type="radio"
                            name="idType"
                            value="drivers_license"
                            checked={idType === 'drivers_license'}
                            onChange={() => setIdType('drivers_license')}
                            className="hidden"
                          />
                          <span className="material-symbols-outlined text-lg">badge</span>
                          Driver's License
                        </label>

                        <label className={`flex-1 flex items-center justify-center gap-2 p-4 rounded-2xl border cursor-pointer font-bold text-xs transition-all ${
                          idType === 'passport'
                            ? 'bg-vestexa-coral text-white border-vestexa-coral shadow-pill'
                            : isDark ? 'bg-[#0D1117] text-gray-400 border-gray-800 hover:bg-gray-800' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'
                        }`}>
                          <input
                            type="radio"
                            name="idType"
                            value="passport"
                            checked={idType === 'passport'}
                            onChange={() => setIdType('passport')}
                            className="hidden"
                          />
                          <span className="material-symbols-outlined text-lg">flight_takeoff</span>
                          International Passport
                        </label>
                      </div>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                      {/* Document Front */}
                      <div>
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          ID Front Page / Photo ID
                        </label>
                        {idDocumentUrl ? (
                          <div className="relative rounded-2xl overflow-hidden border border-gray-700 group">
                            <img src={idDocumentUrl} alt="ID Front" className="w-full h-40 object-cover" />
                            <button
                              type="button"
                              onClick={handleRemoveIdFront}
                              className="absolute top-2 right-2 bg-red-600 text-white p-1.5 rounded-full hover:bg-red-700 transition-colors shadow-md"
                            >
                              <span className="material-symbols-outlined text-sm">close</span>
                            </button>
                          </div>
                        ) : (
                          <label className={`border-2 border-dashed rounded-2xl p-6 flex flex-col items-center justify-center gap-2 cursor-pointer hover:border-vestexa-coral transition-colors ${
                            isDark ? 'border-gray-800 bg-[#0D1117]' : 'border-slate-300 bg-slate-50'
                          }`}>
                            <span className={`material-symbols-outlined text-3xl text-gray-400 ${uploadingIdFront ? 'animate-spin' : ''}`}>
                              {uploadingIdFront ? 'sync' : 'upload_file'}
                            </span>
                            <span className={`text-xs font-semibold ${isDark ? 'text-gray-300' : 'text-slate-700'}`}>
                              {uploadingIdFront ? 'Processing ID Front...' : 'Click to upload ID Front'}
                            </span>
                            <input
                              type="file"
                              accept="image/*"
                              onChange={handleIdFrontUpload}
                              disabled={uploadingIdFront}
                              className="hidden"
                            />
                          </label>
                        )}
                      </div>

                      {/* Document Back */}
                      <div>
                        <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                          ID Back Page / Address Page
                        </label>
                        {idDocumentBackUrl ? (
                          <div className="relative rounded-2xl overflow-hidden border border-gray-700 group">
                            <img src={idDocumentBackUrl} alt="ID Back" className="w-full h-40 object-cover" />
                            <button
                              type="button"
                              onClick={handleRemoveIdBack}
                              className="absolute top-2 right-2 bg-red-600 text-white p-1.5 rounded-full hover:bg-red-700 transition-colors shadow-md"
                            >
                              <span className="material-symbols-outlined text-sm">close</span>
                            </button>
                          </div>
                        ) : (
                          <label className={`border-2 border-dashed rounded-2xl p-6 flex flex-col items-center justify-center gap-2 cursor-pointer hover:border-vestexa-coral transition-colors ${
                            isDark ? 'border-gray-800 bg-[#0D1117]' : 'border-slate-300 bg-slate-50'
                          }`}>
                            <span className={`material-symbols-outlined text-3xl text-gray-400 ${uploadingIdBack ? 'animate-spin' : ''}`}>
                              {uploadingIdBack ? 'sync' : 'upload_file'}
                            </span>
                            <span className={`text-xs font-semibold ${isDark ? 'text-gray-300' : 'text-slate-700'}`}>
                              {uploadingIdBack ? 'Processing ID Back...' : 'Click to upload ID Back'}
                            </span>
                            <input
                              type="file"
                              accept="image/*"
                              onChange={handleIdBackUpload}
                              disabled={uploadingIdBack}
                              className="hidden"
                            />
                          </label>
                        )}
                      </div>
                    </div>
                  </div>

                  <button
                    type="submit"
                    className="w-full py-4 rounded-full bg-vestexa-coral hover:bg-vestexa-coral-hover text-white font-bold text-sm shadow-pill transition-all transform hover:-translate-y-0.5"
                  >
                    Save Profile & KYC Information
                  </button>
                </form>
              </div>
            ) : (
              <>
                {/* ═══ MAIN DASHBOARD VIEW ═══ */}
                {/* Welcome Section */}
                <div className="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                  <div>
                    <p className={`text-sm font-semibold mb-1 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>Welcome back,</p>
                    <h1 className={`text-4xl sm:text-5xl font-display font-extrabold tracking-tight ${isDark ? 'text-white' : 'text-slate-900'}`}>
                      {user.fullName.split(' ')[0]}
                    </h1>
                  </div>
                  <div className="flex gap-3">
                    <button className={`flex items-center gap-2 border px-5 py-2.5 rounded-full text-xs font-bold transition-all shadow-sm ${
                      isDark
                        ? 'border-gray-800 bg-[#161B22] hover:bg-gray-800 text-white'
                        : 'border-slate-200 bg-white hover:bg-slate-100 text-slate-800'
                    }`}>
                      <span className="material-symbols-outlined text-sm">download</span>
                      Statement
                    </button>
                  </div>
                </div>

                {/* Bento Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
                  {/* Left Column: Balances, Cards, Matrix, and Activity */}
                  <div className="lg:col-span-8 space-y-8">
                    {/* Balance Card (The Vault) */}
                    <div
                      className={`rounded-3xl p-8 relative overflow-hidden group shadow-xl transition-all duration-300 ${
                        isDark
                          ? 'border border-white/10 bg-[#141824] text-white'
                          : 'border border-neutral-200/80 bg-white text-neutral-900 shadow-sm'
                      }`}
                      style={
                        isDark
                          ? {
                              backgroundImage:
                                'radial-gradient(at 0% 0%, hsla(355, 100%, 65%, 0.12) 0, transparent 50%), radial-gradient(at 100% 100%, hsla(270, 70%, 50%, 0.1) 0, transparent 50%)',
                              backdropFilter: 'blur(20px)',
                            }
                          : {
                              backgroundImage:
                                'linear-gradient(135deg, #FFFFFF 0%, #FFF6F5 100%)',
                            }
                      }
                    >
                      <div className="absolute top-0 right-0 w-40 h-40 bg-vestexa-coral/10 rounded-full blur-3xl group-hover:bg-vestexa-coral/20 transition-all duration-700 pointer-events-none" />

                      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative z-10">
                        <div>
                          <p className={`text-xs font-bold uppercase tracking-wider mb-2 flex items-center gap-2 ${
                            isDark ? 'text-gray-400' : 'text-neutral-500'
                          }`}>
                            Total Balance
                            <span className="material-symbols-outlined text-[16px] text-emerald-500">trending_up</span>
                          </p>
                          <div className="flex items-baseline gap-3">
                            <h2 className={`text-4xl sm:text-5xl font-display font-extrabold tracking-tight ${
                              isDark ? 'text-white' : 'text-neutral-900'
                            }`}>
                              {formatCurrency(user.balance)}
                            </h2>
                            <span className="font-mono text-sm text-emerald-500 font-bold">+2.4%</span>
                          </div>

                          {/* BTC Equivalent */}
                          <div className={`mt-3 inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full border text-xs ${
                            isDark ? 'bg-gray-900/80 border-white/10' : 'bg-white/80 border-neutral-200 shadow-sm'
                          }`}>
                            <span className={isDark ? 'text-gray-400' : 'text-neutral-600'}>BTC Equivalent:</span>
                            <span className="font-mono font-bold text-amber-500">
                              ≈ {usdToBtc(user.balance, btcPrice)} BTC
                            </span>
                            <span className={`text-[10px] ${isDark ? 'text-gray-500' : 'text-neutral-400'}`}>
                              (@ {formatCurrency(btcPrice)})
                            </span>
                          </div>
                        </div>

                        <div className="flex gap-3 w-full sm:w-auto">
                          <button
                            onClick={() => setActiveNav('Transfers')}
                            className="flex-1 sm:flex-none px-7 py-3 rounded-full text-white text-xs font-bold shadow-pill hover:bg-vestexa-coral-hover transition-all flex items-center justify-center gap-2 bg-vestexa-coral transform hover:-translate-y-0.5 active:scale-95"
                          >
                            <span className="material-symbols-outlined text-[18px]">send</span>
                            Send
                          </button>
                          <button
                            onClick={() => setActiveNav('Transfers')}
                            className={`flex-1 sm:flex-none border px-7 py-3 rounded-full text-xs font-bold transition-all flex items-center justify-center gap-2 shadow-sm ${
                            isDark
                              ? 'border-white/10 bg-white/5 hover:bg-white/10 text-white'
                              : 'border-neutral-200 bg-white hover:bg-neutral-100 text-neutral-800'
                          }`}>
                            <span className="material-symbols-outlined text-[18px]">currency_exchange</span>
                            Exchange
                          </button>
                        </div>
                      </div>

                      {/* Quick Stats */}
                      <div className={`grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-6 border-t relative z-10 ${
                        isDark ? 'border-white/10' : 'border-neutral-200/80'
                      }`}>
                        <div>
                          <p className={`text-xs font-semibold mb-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Available</p>
                          <p className={`font-mono text-sm font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{formatCurrency(user.balance)}</p>
                        </div>
                        <div>
                          <p className={`text-xs font-semibold mb-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Invested</p>
                          <p className={`font-mono text-sm font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{formatCurrency(totalInvested)}</p>
                        </div>
                        <div>
                          <p className={`text-xs font-semibold mb-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Monthly Spend</p>
                          <p className={`font-mono text-sm font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>{formatCurrency(amountSpent)}</p>
                        </div>
                        <div>
                          <p className={`text-xs font-semibold mb-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Rewards</p>
                          <p className="font-mono text-sm font-bold text-vestexa-coral">{rewardPoints.toLocaleString()} pts</p>
                        </div>
                      </div>
                    </div>

                    {/* FinTech Performance Matrix (ROI & Network Metrics) */}
                    <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                      <div
                        onClick={() => setActiveNav('Investments')}
                        className={`p-5 rounded-3xl border transition-all cursor-pointer group ${
                          isDark ? 'bg-[#141824] border-white/10 hover:border-vestexa-coral/40' : 'bg-white border-neutral-200/80 shadow-sm hover:shadow-md hover:border-vestexa-coral/40'
                        }`}
                      >
                        <div className="flex items-center justify-between mb-2">
                          <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                            Active Portfolio
                          </span>
                          <span className="p-1.5 rounded-xl bg-vestexa-coral/10 text-vestexa-coral material-symbols-outlined text-base group-hover:translate-x-0.5 transition-transform">
                            trending_up
                          </span>
                        </div>
                        <div className={`text-xl font-display font-extrabold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                          {formatCurrency(totalInvested)}
                        </div>
                        <p className="text-[11px] text-emerald-500 font-semibold mt-1">
                          Automated Yield Active
                        </p>
                      </div>

                      <div
                        onClick={() => setActiveNav('Investments')}
                        className={`p-5 rounded-3xl border transition-all cursor-pointer group ${
                          isDark ? 'bg-[#141824] border-white/10 hover:border-emerald-500/40' : 'bg-white border-neutral-200/80 shadow-sm hover:shadow-md hover:border-emerald-500/40'
                        }`}
                      >
                        <div className="flex items-center justify-between mb-2">
                          <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                            Total Accrued Yield
                          </span>
                          <span className="p-1.5 rounded-xl bg-emerald-500/10 text-emerald-400 material-symbols-outlined text-base">
                            savings
                          </span>
                        </div>
                        <div className="text-xl font-display font-extrabold text-emerald-400">
                          +{formatCurrency(user.roi || 0)}
                        </div>
                        <p className={`text-[11px] ${isDark ? 'text-gray-400' : 'text-neutral-500'} mt-1`}>
                          Algorithmic ROI Returns
                        </p>
                      </div>

                      <div
                        onClick={() => setActiveNav('Refer & Earn')}
                        className={`p-5 rounded-3xl border transition-all cursor-pointer group ${
                          isDark ? 'bg-[#141824] border-white/10 hover:border-purple-500/40' : 'bg-white border-neutral-200/80 shadow-sm hover:shadow-md hover:border-purple-500/40'
                        }`}
                      >
                        <div className="flex items-center justify-between mb-2">
                          <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                            Affiliate Rewards
                          </span>
                          <span className="p-1.5 rounded-xl bg-purple-500/10 text-purple-400 material-symbols-outlined text-base">
                            diversity_3
                          </span>
                        </div>
                        <div className={`text-xl font-display font-extrabold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                          {formatCurrency(user.refBonus || 0)}
                        </div>
                        <p className={`text-[11px] ${isDark ? 'text-gray-400' : 'text-neutral-500'} mt-1`}>
                          5-Tier Network Program
                        </p>
                      </div>
                    </div>

                    {/* ─── Transaction History ─── */}
                    <div className={`rounded-3xl border flex flex-col shadow-xl transition-all duration-300 ${
                      isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200/80 shadow-sm'
                    }`} style={{ minHeight: '500px' }}>
                      <div className={`p-6 border-b flex justify-between items-center ${
                        isDark ? 'border-white/10' : 'border-neutral-200/80'
                      }`}>
                        <h3 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>Recent Activity</h3>
                        <button className="text-vestexa-coral text-xs font-bold hover:underline transition-colors flex items-center gap-1">
                          View All <span className="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </button>
                      </div>

                      <div className="flex-1 overflow-y-auto p-2">
                        {/* Headers */}
                        <div className={`grid grid-cols-12 gap-4 px-4 py-3 text-xs font-bold uppercase tracking-wider sticky top-0 backdrop-blur z-10 border-b ${
                          isDark ? 'bg-[#141824]/95 border-white/10 text-neutral-400' : 'bg-neutral-50/95 border-neutral-200/80 text-neutral-600'
                        }`}>
                          <div className="col-span-5 sm:col-span-4">Description</div>
                          <div className="col-span-3 hidden sm:block">Category</div>
                          <div className="col-span-3 hidden sm:block">Date</div>
                          <div className="col-span-7 sm:col-span-2 text-right">Amount</div>
                        </div>

                        {/* Rows */}
                        <div className="space-y-1 mt-2">
                          {filteredTransactions.length === 0 ? (
                            <div className="text-center py-16 text-neutral-400">
                              <span className="material-symbols-outlined text-4xl mb-3 block">receipt_long</span>
                              <p className="text-sm font-medium">No transactions found</p>
                            </div>
                          ) : (
                            filteredTransactions.map((txn, idx) => (
                              <div
                                key={txn.id}
                                className={`grid grid-cols-12 gap-4 px-4 py-3.5 items-center rounded-2xl border border-transparent transition-all group cursor-pointer ${
                                  isDark
                                    ? `hover:bg-white/5 hover:border-vestexa-coral/30 ${idx % 2 === 1 ? 'bg-white/[0.02]' : ''}`
                                    : `hover:bg-orange-500/5 hover:border-neutral-300 ${idx % 2 === 1 ? 'bg-neutral-50/60' : ''}`
                                }`}
                              >
                                <div className="col-span-5 sm:col-span-4 flex items-center gap-3">
                                  <div className={`w-10 h-10 rounded-full ${
                                    txn.type === 'credit'
                                      ? 'bg-emerald-500/15 text-emerald-500'
                                      : 'bg-vestexa-coral/15 text-vestexa-coral'
                                  } flex items-center justify-center shrink-0`}>
                                    <span className="material-symbols-outlined text-[20px]">
                                      {txn.type === 'credit' ? 'arrow_downward' : 'arrow_upward'}
                                    </span>
                                  </div>
                                  <div className="min-w-0">
                                    <p className={`text-sm font-semibold truncate ${isDark ? 'text-white' : 'text-neutral-900'}`}>{txn.narration}</p>
                                    <p className={`text-xs sm:hidden truncate ${isDark ? 'text-neutral-400' : 'text-neutral-500'}`}>{txn.category} • {formatDate(txn.date, txn.time)}</p>
                                  </div>
                                </div>
                                <div className="col-span-3 hidden sm:block">
                                  <span className={`${getCategoryColor(txn.category)} px-3 py-1 rounded-full text-xs font-bold`}>
                                    {txn.category}
                                  </span>
                                </div>
                                <div className={`col-span-3 hidden sm:block text-sm font-medium ${isDark ? 'text-neutral-400' : 'text-neutral-600'}`}>
                                  {formatDate(txn.date, txn.time)}
                                </div>
                                <div className="col-span-7 sm:col-span-2 text-right">
                                  <p className={`font-mono text-sm font-bold ${
                                    txn.type === 'credit' ? 'text-emerald-500' : isDark ? 'text-white' : 'text-neutral-900'
                                  }`}>
                                    {txn.type === 'credit' ? '+' : '-'}{formatCurrency(txn.amount)}
                                  </p>
                                  <p className="text-[11px] text-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity font-semibold">
                                    {txn.status === 'completed' ? 'Completed' : txn.status === 'pending' ? 'Pending' : 'Processing'}
                                  </p>
                                </div>
                              </div>
                            ))
                          )}
                        </div>
                      </div>
                    </div>
                  </div>

                  {/* ─── Right Column (Span 4) ─── */}
                  <div className="lg:col-span-4 flex flex-col gap-6">
                    {/* Vestexa Card Visual (Showing exact user card details) */}
                    <div className={`rounded-3xl border p-6 shadow-xl transition-all duration-300 ${
                      isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200/80 shadow-sm'
                    }`}>
                      <div className="flex justify-between items-center mb-6">
                        <h3 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>My Card</h3>
                        <button className={`${isDark ? 'text-neutral-400 hover:text-white' : 'text-neutral-500 hover:text-neutral-900'} transition-colors`}>
                          <span className="material-symbols-outlined text-xl">credit_card</span>
                        </button>
                      </div>

                      {/* Physical Metal Card Representation — Luxury Titanium Centurion styling */}
                      <div className="h-48 rounded-2xl p-6 flex flex-col justify-between relative overflow-hidden group shadow-2xl border border-white/15 bg-gradient-to-br from-[#1E232E] via-[#13161F] to-[#0A0D12] text-white">
                        <div className="absolute inset-0 bg-gradient-to-tr from-transparent via-white/[0.04] to-orange-500/10 pointer-events-none" />
                        <div className="absolute -top-12 -right-12 w-36 h-36 bg-vestexa-coral/20 blur-2xl rounded-full pointer-events-none" />

                        {/* Top Row: Wordmark & Contactless */}
                        <div className="flex justify-between items-center relative z-10">
                          <SvgWordmark tone="white" brand="vestexa" />
                          <span className="material-symbols-outlined text-white/80" style={{ fontSize: '28px' }}>contactless</span>
                        </div>

                        {/* Middle: EMV Gold Chip */}
                        <div className="relative z-10 my-auto">
                          <div className="w-10 h-7 rounded-md bg-gradient-to-br from-amber-200 via-amber-400 to-amber-600 border border-amber-300/70 relative overflow-hidden shadow-sm flex items-center justify-center">
                            <div className="w-full h-px bg-amber-800/40 absolute top-2" />
                            <div className="w-full h-px bg-amber-800/40 absolute bottom-2" />
                            <div className="h-full w-px bg-amber-800/40 absolute left-3" />
                            <div className="h-full w-px bg-amber-800/40 absolute right-3" />
                          </div>
                        </div>

                        {/* Bottom: Card Details */}
                        <div className="relative z-10">
                          <p className="font-mono text-sm text-neutral-200 tracking-[0.2em] mb-2 font-bold drop-shadow-sm">
                            •••• •••• •••• {user.cardLast4 || (user.cardNumber ? user.cardNumber.slice(-4) : '4092')}
                          </p>
                          <div className="flex justify-between items-end">
                            <div>
                              <p className="text-[9px] text-neutral-400 font-bold uppercase tracking-wider">Cardholder</p>
                              <p className="text-xs font-semibold text-white truncate max-w-[140px] uppercase tracking-wide">{user.cardHolderName || user.fullName}</p>
                            </div>
                            <div className="text-right">
                              <p className="text-[9px] text-neutral-400 font-bold uppercase tracking-wider">Expires</p>
                              <p className="text-xs font-semibold text-white font-mono">{user.cardExp || '12/27'}</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div className="mt-6 space-y-4">
                        <div className="flex items-center justify-between">
                          <span className={`text-sm font-semibold ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Card Status</span>
                          <span className="bg-emerald-500/10 text-emerald-500 px-3 py-1 rounded-full text-xs font-bold border border-emerald-500/20">Active</span>
                        </div>
                        <div className="flex items-center justify-between">
                          <span className={`text-sm font-semibold ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>Monthly Limit</span>
                          <span className={`font-mono text-sm font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>$10,000</span>
                        </div>
                        <div className={`w-full rounded-full h-2 mt-2 overflow-hidden ${isDark ? 'bg-gray-800' : 'bg-neutral-200'}`}>
                          <div className="bg-vestexa-coral h-full rounded-full transition-all duration-300" style={{ width: `${spentPercent}%` }} />
                        </div>
                        <p className={`text-right text-xs font-medium ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>{formatCurrency(amountSpent)} spent</p>
                      </div>
                    </div>

                    {/* Quick Transfer Widget (User dynamic inputtable contacts) */}
                    <div className={`rounded-3xl border p-6 shadow-xl transition-all duration-300 ${
                      isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200/80 shadow-sm'
                    }`}>
                      <div className="flex justify-between items-center mb-4">
                        <h3 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>Quick Transfer</h3>
                        <button
                          onClick={() => setShowAddContactModal(true)}
                          className="text-xs font-bold text-vestexa-coral hover:underline flex items-center gap-1"
                        >
                          <span className="material-symbols-outlined text-sm">person_add</span> Add Recipient
                        </button>
                      </div>

                      {quickSuccessMsg && (
                        <div className="mb-3 text-xs bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 p-2.5 rounded-xl flex items-center gap-1.5">
                          <span className="material-symbols-outlined text-sm">check_circle</span>
                          {quickSuccessMsg}
                        </div>
                      )}

                      <div className="flex gap-4 mb-6 overflow-x-auto pb-2 no-scrollbar">
                        <button
                          onClick={() => setShowAddContactModal(true)}
                          className="flex flex-col items-center gap-2 min-w-[60px] group"
                        >
                          <div className={`w-12 h-12 rounded-full border border-dashed flex items-center justify-center transition-colors ${
                            isDark ? 'border-gray-700 text-gray-400 group-hover:text-vestexa-coral group-hover:border-vestexa-coral' : 'border-neutral-300 text-neutral-500 group-hover:text-vestexa-coral group-hover:border-vestexa-coral'
                          }`}>
                            <span className="material-symbols-outlined">add</span>
                          </div>
                          <span className={`text-xs font-semibold ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>+ New</span>
                        </button>

                        {quickContacts.length === 0 ? (
                          <div className="flex items-center text-xs text-neutral-400 italic pl-2">
                            No recipients added yet. Click "+ New" to add one.
                          </div>
                        ) : (
                          quickContacts.map((c) => (
                            <div key={c.id} className="relative group shrink-0">
                              <button
                                onClick={() => setSelectedRecipient(selectedRecipient === c.id ? null : c.id)}
                                className={`flex flex-col items-center gap-2 min-w-[60px] cursor-pointer`}
                              >
                                <div className={`w-12 h-12 rounded-full flex items-center justify-center text-sm font-bold border transition-all ${
                                  selectedRecipient === c.id ? 'ring-2 ring-vestexa-coral scale-105' : ''
                                } ${
                                  c.avatarBg || (isDark ? 'bg-gray-800 text-white' : 'bg-neutral-100 text-neutral-800')
                                }`}>
                                  {c.initials}
                                </div>
                                <span className={`text-xs font-semibold truncate max-w-[64px] ${isDark ? 'text-white' : 'text-neutral-800'}`}>
                                  {c.name}
                                </span>
                              </button>
                              <button
                                onClick={(e) => handleDeleteContact(e, c.id)}
                                title="Remove recipient"
                                className="absolute -top-1 -right-1 bg-red-600 text-white w-5 h-5 rounded-full text-[10px] font-bold opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center shadow-md hover:bg-red-700"
                              >
                                ✕
                              </button>
                            </div>
                          ))
                        )}
                      </div>

                      <div className={`relative rounded-2xl border transition-colors p-4 ${
                        isDark
                          ? 'bg-[#0D1117] border-white/10 focus-within:border-vestexa-coral'
                          : 'bg-neutral-50 border-neutral-200 focus-within:border-vestexa-coral focus-within:bg-white'
                      }`}>
                        <label className={`text-xs font-bold uppercase tracking-wider block mb-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                          {selectedRecipient
                            ? `Amount to send to ${quickContacts.find(c => c.id === selectedRecipient)?.name}`
                            : 'Quick Transfer Amount'}
                        </label>
                        <div className="flex items-center">
                          <span className={`font-mono text-base mr-1.5 ${isDark ? 'text-white' : 'text-neutral-900'}`}>$</span>
                          <input
                            className={`w-full bg-transparent border-none p-0 font-mono text-base focus:ring-0 focus:outline-none ${
                              isDark ? 'text-white' : 'text-neutral-900'
                            }`}
                            placeholder="0.00"
                            type="number"
                            value={quickAmount}
                            onChange={(e) => setQuickAmount(e.target.value)}
                          />
                          <button
                            onClick={() => {
                              if (!quickAmount || parseFloat(quickAmount) <= 0) return;
                              setQuickSuccessMsg(`Transfer of $${quickAmount} requested successfully!`);
                              setQuickAmount('');
                              setTimeout(() => setQuickSuccessMsg(''), 4000);
                            }}
                            className="px-5 py-2 rounded-full bg-vestexa-coral text-white text-xs font-bold hover:bg-vestexa-coral-hover transition-colors shadow-pill ml-2 active:scale-95"
                          >
                            Send
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </>
            )}
          </div>
        </main>
      </div>

      {/* Mobile Nav */}
      <div className={`md:hidden fixed bottom-0 left-0 right-0 backdrop-blur-xl border-t z-50 px-2 py-2 ${
        isDark ? 'bg-[#161B22]/95 border-gray-800' : 'bg-white/95 border-slate-200'
      }`}>
        <div className="flex justify-around items-center">
          {navItems.slice(0, 5).map((item) => (
            <button
              key={item.name}
              onClick={() => setActiveNav(item.name)}
              className={`flex flex-col items-center gap-1 py-1.5 px-3 rounded-xl transition-colors ${
                activeNav === item.name ? 'text-vestexa-coral font-bold' : isDark ? 'text-gray-400' : 'text-slate-500'
              }`}
            >
              <span className="material-symbols-outlined text-[20px]">
                {item.icon}
              </span>
              <span className="text-[10px] font-semibold">{item.name}</span>
            </button>
          ))}
        </div>
      </div>

      {/* ─── Add Quick Transfer Contact Modal ─── */}
      {showAddContactModal && (
        <div className="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
          <div className={`rounded-3xl border max-w-md w-full p-6 sm:p-8 shadow-2xl relative ${
            isDark ? 'bg-[#161B22] border-gray-800 text-white' : 'bg-white border-slate-200 text-slate-900'
          }`}>
            <div className="flex justify-between items-center mb-6">
              <h3 className="text-xl font-display font-bold flex items-center gap-2">
                <span className="material-symbols-outlined text-vestexa-coral">person_add</span>
                Add Quick Transfer Contact
              </h3>
              <button
                onClick={() => setShowAddContactModal(false)}
                className="text-gray-400 hover:text-white text-lg font-bold"
              >
                ✕
              </button>
            </div>

            <form onSubmit={handleAddContact} className="space-y-5">
              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Recipient Full Name / Organization
                </label>
                <input
                  type="text"
                  value={newContactName}
                  onChange={(e) => setNewContactName(e.target.value)}
                  placeholder="e.g. Sarah Jenkins or Ogden Corp"
                  required
                  className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none ${
                    isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                  }`}
                />
              </div>

              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Initials / Badge Text (Optional)
                </label>
                <input
                  type="text"
                  maxLength={3}
                  value={newContactInitials}
                  onChange={(e) => setNewContactInitials(e.target.value)}
                  placeholder="e.g. SJ"
                  className={`w-full text-sm rounded-2xl px-4 py-3 border focus:border-vestexa-coral focus:outline-none uppercase font-mono ${
                    isDark ? 'bg-[#0D1117] text-white border-gray-800' : 'bg-slate-50 text-slate-900 border-slate-200'
                  }`}
                />
              </div>

              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Avatar Color Style
                </label>
                <div className="grid grid-cols-4 gap-3">
                  {[
                    { bg: 'bg-rose-500/20 text-rose-400', label: 'Rose' },
                    { bg: 'bg-emerald-500/20 text-emerald-400', label: 'Emerald' },
                    { bg: 'bg-blue-500/20 text-blue-400', label: 'Blue' },
                    { bg: 'bg-purple-500/20 text-purple-400', label: 'Purple' },
                  ].map((color) => (
                    <button
                      key={color.label}
                      type="button"
                      onClick={() => setNewContactBg(color.bg)}
                      className={`p-3 rounded-2xl border font-bold text-xs flex items-center justify-center transition-all ${color.bg} ${
                        newContactBg === color.bg ? 'ring-2 ring-vestexa-coral border-transparent' : 'border-transparent opacity-70 hover:opacity-100'
                      }`}
                    >
                      {color.label}
                    </button>
                  ))}
                </div>
              </div>

              <div className="flex gap-3 pt-3">
                <button
                  type="submit"
                  className="flex-1 py-3.5 rounded-full bg-vestexa-coral hover:bg-vestexa-coral-hover text-white font-bold text-sm shadow-pill transition-all"
                >
                  Save Contact
                </button>
                <button
                  type="button"
                  onClick={() => setShowAddContactModal(false)}
                  className={`px-6 py-3.5 rounded-full font-semibold text-sm transition-colors ${
                    isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300'
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
  );
};
