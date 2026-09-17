import React, { useState, useEffect } from 'react';
import {
  User,
  getUsers,
  getRestrictedUsers,
  restrictUsers,
  liftUserRestriction,
  liftMassRestrictions,
} from '../../lib/storage';
import { useAuth } from '../../context/AuthContext';

interface RestrictionCmsProps {
  isDark?: boolean;
  preselectedUserId?: string;
  onNavigateToUser?: (userId: string) => void;
}

interface PresetTemplate {
  label: string;
  header: string;
  body: string;
}

const PRESET_TEMPLATES: PresetTemplate[] = [
  {
    label: 'Compliance Audit',
    header: 'Account Access Suspended – Compliance Audit Required',
    body: `Your account has been temporarily restricted pursuant to Section 4.2 of our Institutional Compliance Standards.

Our audit division has flagged recent transaction routing that requires source-of-funds verification. All asset movements, transfers, and wallet features are frozen until compliance clearance is completed.

Please log out and contact our verification desk at compliance@vestexa.org with your account reference number.`,
  },
  {
    label: 'Suspicious Activity',
    header: 'Security Hold – Suspicious Activity Detected',
    body: `Vestexa Automated Risk Sentinel detected anomalous login patterns and unauthorized attempt telemetry on your account credentials.

As a protective measure under SIPC & FINRA regulatory safeguards, all access to your private liquidity pool and wallet transactions has been temporarily locked.

Please log out immediately. To initiate biometric or multi-factor account restoration, submit a ticket through our official security desk.`,
  },
  {
    label: 'KYC / AML Discrepancy',
    header: 'Identity Verification Discrepancy – Action Required',
    body: `A discrepancy was identified between your submitted government identification documents and international sanctions / AML registries.

Your dashboard operations are locked pending secondary document submission. You are required to log out of this session. An administrative review officer has been assigned to your case file.`,
  },
  {
    label: 'Administrative Freeze',
    header: 'Administrative Account Freeze – Terms of Service Review',
    body: `This account has been placed on administrative hold by platform executive management pending review of contractual obligations and platform usage policies.

No transactional or balance withdrawals can be executed during this restraint window. Please log out and consult your private relationship manager for next steps.`,
  },
];

export const RestrictionCms: React.FC<RestrictionCmsProps> = ({
  isDark = false,
  preselectedUserId,
}) => {
  const { admin } = useAuth();
  const [users, setUsers] = useState<User[]>([]);
  const [selectedUserIds, setSelectedUserIds] = useState<string[]>([]);
  const [searchQuery, setSearchQuery] = useState('');
  const [filterTab, setFilterTab] = useState<'all' | 'unrestricted' | 'restricted'>('all');

  // CMS Form State
  const [subjectHeader, setSubjectHeader] = useState('');
  const [reasonBody, setReasonBody] = useState('');
  const [statusMessage, setStatusMessage] = useState<{ text: string; type: 'success' | 'error' } | null>(null);

  // Active Ledger multi-selection
  const [ledgerSelectedIds, setLedgerSelectedIds] = useState<string[]>([]);

  useEffect(() => {
    loadUsers();
  }, []);

  useEffect(() => {
    if (preselectedUserId) {
      setSelectedUserIds([preselectedUserId]);
      const targetUser = users.find(u => u.id === preselectedUserId);
      if (targetUser && targetUser.isRestricted) {
        setSubjectHeader(targetUser.restrictionHeader || '');
        setReasonBody(targetUser.restrictionReason || '');
      }
    }
  }, [preselectedUserId, users]);

  const loadUsers = () => {
    const all = getUsers();
    setUsers(all);
  };

  const showNotice = (text: string, type: 'success' | 'error') => {
    setStatusMessage({ text, type });
    setTimeout(() => setStatusMessage(null), 4500);
  };

  // Filtered users for target selection list
  const filteredUsers = users.filter((u) => {
    const matchesSearch =
      u.fullName.toLowerCase().includes(searchQuery.toLowerCase()) ||
      u.email.toLowerCase().includes(searchQuery.toLowerCase()) ||
      (u.accountNumber && u.accountNumber.toLowerCase().includes(searchQuery.toLowerCase()));

    if (!matchesSearch) return false;

    if (filterTab === 'unrestricted') return !u.isRestricted;
    if (filterTab === 'restricted') return Boolean(u.isRestricted);
    return true;
  });

  const restrictedUsers = users.filter((u) => Boolean(u.isRestricted));

  // Selection handlers
  const toggleUserSelection = (userId: string) => {
    setSelectedUserIds((prev) =>
      prev.includes(userId) ? prev.filter((id) => id !== userId) : [...prev, userId]
    );
  };

  const handleSelectAllFiltered = () => {
    const ids = filteredUsers.map((u) => u.id);
    setSelectedUserIds(Array.from(new Set([...selectedUserIds, ...ids])));
  };

  const handleDeselectAll = () => {
    setSelectedUserIds([]);
  };

  const handleApplyPreset = (preset: PresetTemplate) => {
    setSubjectHeader(preset.header);
    setReasonBody(preset.body);
  };

  // Submit Restriction CMS
  const handleApplyRestriction = (e: React.FormEvent) => {
    e.preventDefault();
    if (selectedUserIds.length === 0) {
      showNotice('Please select at least one customer account to restrict.', 'error');
      return;
    }
    if (!subjectHeader.trim()) {
      showNotice('Please enter a Subject / Header for the restriction popup.', 'error');
      return;
    }
    if (!reasonBody.trim()) {
      showNotice('Please enter the reason(s) and directives for the restriction.', 'error');
      return;
    }

    const adminName = admin ? `${admin.fullName} (${admin.email})` : 'Platform Admin';
    const result = restrictUsers(selectedUserIds, subjectHeader, reasonBody, adminName);

    if (result.success) {
      showNotice(
        `Successfully restricted access for ${result.count} customer account(s). Target users will immediately receive the blurred popup lockout.`,
        'success'
      );
      loadUsers();
      // Keep selection or clear based on preference
      setSelectedUserIds([]);
    } else {
      showNotice('Failed to apply restrictions. Please try again.', 'error');
    }
  };

  // Single lift
  const handleLiftSingle = (userId: string, userName: string) => {
    if (window.confirm(`Lift access restriction for ${userName}? Their dashboard access will be immediately restored.`)) {
      liftUserRestriction(userId);
      loadUsers();
      showNotice(`Access restriction lifted for ${userName}.`, 'success');
    }
  };

  // Mass lift
  const handleLiftMass = () => {
    if (ledgerSelectedIds.length === 0) return;
    if (
      window.confirm(
        `Lift access restrictions for ${ledgerSelectedIds.length} selected customer accounts? All will immediately regain access.`
      )
    ) {
      const res = liftMassRestrictions(ledgerSelectedIds);
      loadUsers();
      setLedgerSelectedIds([]);
      showNotice(`Successfully lifted restrictions for ${res.count} customer accounts.`, 'success');
    }
  };

  const handleEditExistingNotice = (targetUser: User) => {
    setSelectedUserIds([targetUser.id]);
    setSubjectHeader(targetUser.restrictionHeader || '');
    setReasonBody(targetUser.restrictionReason || '');
    // Scroll up smoothly to CMS editor
    window.scrollTo({ top: 0, behavior: 'smooth' });
    showNotice(`Loaded restriction parameters for ${targetUser.fullName} into editor.`, 'success');
  };

  const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 2,
    }).format(amount);
  };

  return (
    <div className="space-y-8 animate-in fade-in duration-200">
      {/* ─── Top Header & Summary ─── */}
      <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <div className="flex items-center gap-2.5 mb-1.5">
            <span className="p-2 rounded-xl bg-red-500/15 text-red-500 font-bold border border-red-500/25">
              <span className="material-symbols-outlined text-2xl" style={{ fontVariationSettings: "'FILL' 1" }}>
                gavel
              </span>
            </span>
            <h1 className={`text-3xl font-display font-black tracking-tight ${isDark ? 'text-white' : 'text-neutral-900'}`}>
              Customer Access Restriction CMS
            </h1>
          </div>
          <p className={`text-sm ${isDark ? 'text-gray-400' : 'text-neutral-600'}`}>
            Manage account freezes and configure high-priority non-dismissible lockout notices with mass customer assignment.
          </p>
        </div>

        {/* Status Counters */}
        <div className="flex items-center gap-3">
          <div className={`px-4 py-2 rounded-2xl border text-center ${
            isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200 shadow-sm'
          }`}>
            <span className="text-[10px] uppercase font-bold tracking-wider text-gray-400 block">Total Users</span>
            <span className={`text-lg font-black font-display ${isDark ? 'text-white' : 'text-neutral-900'}`}>
              {users.length}
            </span>
          </div>

          <div className={`px-4 py-2 rounded-2xl border text-center ${
            isDark ? 'bg-emerald-500/10 border-emerald-500/20' : 'bg-emerald-50 border-emerald-200'
          }`}>
            <span className="text-[10px] uppercase font-bold tracking-wider text-emerald-500 block">Active</span>
            <span className="text-lg font-black font-display text-emerald-500">
              {users.length - restrictedUsers.length}
            </span>
          </div>

          <div className={`px-4 py-2 rounded-2xl border text-center ${
            isDark ? 'bg-red-500/15 border-red-500/30' : 'bg-red-50 border-red-200'
          }`}>
            <span className="text-[10px] uppercase font-bold tracking-wider text-red-500 block">Restricted</span>
            <span className="text-lg font-black font-display text-red-500">
              {restrictedUsers.length}
            </span>
          </div>
        </div>
      </div>

      {/* Status Alert Banner */}
      {statusMessage && (
        <div
          className={`p-4 rounded-2xl border text-sm font-semibold flex items-center gap-3 transition-all ${
            statusMessage.type === 'success'
              ? isDark
                ? 'bg-emerald-500/15 border-emerald-500/30 text-emerald-300'
                : 'bg-emerald-50 border-emerald-200 text-emerald-800'
              : isDark
                ? 'bg-red-500/15 border-red-500/30 text-red-300'
                : 'bg-red-50 border-red-200 text-red-800'
          }`}
        >
          <span className="material-symbols-outlined text-xl shrink-0">
            {statusMessage.type === 'success' ? 'check_circle' : 'error'}
          </span>
          <span className="flex-1">{statusMessage.text}</span>
        </div>
      )}

      {/* ─── Main Two-Column Layout: Customer Selector + Mini CMS Form ─── */}
      <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {/* ═══ Left Column: Mass Target Assignment Selector (Span 5) ═══ */}
        <div className={`lg:col-span-5 rounded-3xl border p-6 flex flex-col justify-between ${
          isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200 shadow-glass'
        }`}>
          <div>
            <div className="flex items-center justify-between gap-3 mb-4">
              <div>
                <h3 className={`text-lg font-display font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                  Target Customers
                </h3>
                <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                  Select individual accounts or use mass assignment
                </p>
              </div>

              <span className="px-3 py-1 rounded-full text-xs font-bold bg-vestexa-coral text-white shadow-pill">
                {selectedUserIds.length} Selected
              </span>
            </div>

            {/* Filter Tabs */}
            <div className="flex rounded-xl p-1 mb-3 bg-black/20 border border-white/5 text-xs font-bold">
              <button
                type="button"
                onClick={() => setFilterTab('all')}
                className={`flex-1 py-1.5 rounded-lg transition-all ${
                  filterTab === 'all'
                    ? 'bg-vestexa-coral text-white shadow-sm'
                    : isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-600 hover:text-neutral-900'
                }`}
              >
                All ({users.length})
              </button>
              <button
                type="button"
                onClick={() => setFilterTab('unrestricted')}
                className={`flex-1 py-1.5 rounded-lg transition-all ${
                  filterTab === 'unrestricted'
                    ? 'bg-vestexa-coral text-white shadow-sm'
                    : isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-600 hover:text-neutral-900'
                }`}
              >
                Active ({users.length - restrictedUsers.length})
              </button>
              <button
                type="button"
                onClick={() => setFilterTab('restricted')}
                className={`flex-1 py-1.5 rounded-lg transition-all ${
                  filterTab === 'restricted'
                    ? 'bg-red-500 text-white shadow-sm'
                    : isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-600 hover:text-neutral-900'
                }`}
              >
                Restricted ({restrictedUsers.length})
              </button>
            </div>

            {/* Search Input */}
            <div className="relative mb-3">
              <span className="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-lg">
                search
              </span>
              <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search by name, email, account #..."
                className={`w-full pl-9 pr-4 py-2 rounded-xl text-xs font-semibold border transition-all focus:outline-none focus:border-vestexa-coral ${
                  isDark
                    ? 'bg-[#0B0F14] border-white/10 text-white placeholder-gray-500'
                    : 'bg-neutral-50 border-neutral-200 text-neutral-900 placeholder-neutral-400'
                }`}
              />
            </div>

            {/* Mass Selection Quick Controls */}
            <div className="flex items-center justify-between text-[11px] font-bold mb-3 px-1">
              <div className="flex items-center gap-2">
                <button
                  type="button"
                  onClick={handleSelectAllFiltered}
                  className="text-vestexa-coral hover:underline"
                >
                  Select All Filtered ({filteredUsers.length})
                </button>
                <span className="text-gray-500">·</span>
                <button
                  type="button"
                  onClick={handleDeselectAll}
                  className="text-gray-400 hover:text-gray-200 hover:underline"
                >
                  Clear Selection
                </button>
              </div>
            </div>

            {/* Scrollable Customer List */}
            <div className="space-y-2 max-h-[420px] overflow-y-auto pr-1 no-scrollbar">
              {filteredUsers.map((u) => {
                const isSelected = selectedUserIds.includes(u.id);
                return (
                  <div
                    key={u.id}
                    onClick={() => toggleUserSelection(u.id)}
                    className={`p-3 rounded-2xl border transition-all cursor-pointer flex items-center gap-3 ${
                      isSelected
                        ? isDark
                          ? 'bg-vestexa-coral/15 border-vestexa-coral/60'
                          : 'bg-orange-50 border-vestexa-coral/60 shadow-sm'
                        : isDark
                          ? 'bg-[#0D1117] border-white/5 hover:border-white/15'
                          : 'bg-neutral-50 border-neutral-200/80 hover:border-neutral-300'
                    }`}
                  >
                    {/* Checkbox */}
                    <input
                      type="checkbox"
                      checked={isSelected}
                      onChange={() => {}} // Handled by parent container click
                      className="w-4 h-4 rounded text-vestexa-coral focus:ring-vestexa-coral cursor-pointer"
                    />

                    {/* Avatar */}
                    {u.avatarUrl ? (
                      <img
                        src={u.avatarUrl}
                        alt={u.fullName}
                        className="w-9 h-9 rounded-full object-cover shrink-0 ring-1 ring-white/10"
                      />
                    ) : (
                      <div className="w-9 h-9 rounded-full bg-vestexa-coral text-white font-bold text-xs flex items-center justify-center shrink-0 shadow-sm">
                        {u.fullName.split(' ').map((n) => n[0]).join('').substring(0, 2)}
                      </div>
                    )}

                    {/* Customer Info */}
                    <div className="flex-1 min-w-0">
                      <div className="flex items-center justify-between gap-1">
                        <span className={`text-xs font-bold truncate ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                          {u.fullName}
                        </span>
                        {u.isRestricted ? (
                          <span className="px-2 py-0.5 rounded text-[9px] font-extrabold bg-red-500/20 text-red-400 border border-red-500/30 uppercase shrink-0">
                            Restricted
                          </span>
                        ) : (
                          <span className="px-2 py-0.5 rounded text-[9px] font-extrabold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 uppercase shrink-0">
                            Active
                          </span>
                        )}
                      </div>
                      <div className="flex items-center justify-between text-[11px] text-gray-400">
                        <span className="truncate">{u.email}</span>
                        <span className="font-mono text-xs font-semibold ml-2 shrink-0">
                          {formatCurrency(u.balance)}
                        </span>
                      </div>
                    </div>
                  </div>
                );
              })}

              {filteredUsers.length === 0 && (
                <div className={`p-8 text-center text-xs ${isDark ? 'text-gray-500' : 'text-neutral-400'}`}>
                  No matching customer accounts found.
                </div>
              )}
            </div>
          </div>

          <div className="mt-4 pt-3 border-t border-white/5 text-[11px] text-gray-400 flex items-center justify-between">
            <span>Mass assignment ready</span>
            <span className="font-bold text-vestexa-coral">{selectedUserIds.length} targeted</span>
          </div>
        </div>

        {/* ═══ Right Column: Mini CMS Reason & Subject Editor (Span 7) ═══ */}
        <div className={`lg:col-span-7 rounded-3xl border p-6 flex flex-col justify-between ${
          isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200 shadow-glass'
        }`}>
          <form onSubmit={handleApplyRestriction} className="space-y-5">
            <div>
              <h3 className={`text-lg font-display font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                Compose Restriction Directive
              </h3>
              <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
                Configure the bold popup header and reason body presented to the locked-out customers.
              </p>
            </div>

            {/* Rapid Preset Chips */}
            <div>
              <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${
                isDark ? 'text-gray-400' : 'text-neutral-600'
              }`}>
                Rapid Compliance Presets
              </label>
              <div className="flex flex-wrap gap-2">
                {PRESET_TEMPLATES.map((tpl) => (
                  <button
                    key={tpl.label}
                    type="button"
                    onClick={() => handleApplyPreset(tpl)}
                    className={`px-3 py-1.5 rounded-xl text-xs font-bold transition-all border ${
                      subjectHeader === tpl.header
                        ? 'border-red-500 bg-red-500/20 text-red-400'
                        : isDark
                          ? 'border-white/10 bg-[#0B0F14] text-gray-300 hover:text-white hover:border-white/25'
                          : 'border-neutral-200 bg-neutral-100 text-neutral-700 hover:bg-neutral-200'
                    }`}
                  >
                    {tpl.label}
                  </button>
                ))}
              </div>
            </div>

            {/* Header / Subject (Bold at top of popup) */}
            <div>
              <div className="flex items-center justify-between mb-1.5">
                <label className={`block text-xs font-bold uppercase tracking-wider ${
                  isDark ? 'text-gray-400' : 'text-neutral-600'
                }`}>
                  Subject / Header <span className="text-red-500">*</span>
                  <span className="ml-2 font-normal lowercase text-[11px] text-gray-500">
                    (displayed very bold at the top of the popup message)
                  </span>
                </label>
                <span className="text-[10px] font-mono text-gray-500">{subjectHeader.length} chars</span>
              </div>
              <input
                type="text"
                required
                value={subjectHeader}
                onChange={(e) => setSubjectHeader(e.target.value)}
                placeholder="e.g. Account Access Suspended – Compliance Audit Required"
                className={`w-full rounded-2xl px-4 py-3 border text-sm font-extrabold tracking-tight transition-colors focus:border-red-500 focus:outline-none ${
                  isDark
                    ? 'bg-[#0B0F14] border-white/10 text-white placeholder-gray-600'
                    : 'bg-neutral-50 border-neutral-200 text-neutral-900 placeholder-neutral-400'
                }`}
              />
            </div>

            {/* Body / Reason(s) Textarea */}
            <div>
              <div className="flex items-center justify-between mb-1.5">
                <label className={`block text-xs font-bold uppercase tracking-wider ${
                  isDark ? 'text-gray-400' : 'text-neutral-600'
                }`}>
                  Reason(s) & Directives Body <span className="text-red-500">*</span>
                  <span className="ml-2 font-normal lowercase text-[11px] text-gray-500">
                    (detailed explanation & instructions)
                  </span>
                </label>
                <span className="text-[10px] font-mono text-gray-500">{reasonBody.length} chars</span>
              </div>
              <textarea
                rows={6}
                required
                value={reasonBody}
                onChange={(e) => setReasonBody(e.target.value)}
                placeholder="Provide explicit reasons for the restriction, compliance mandates, and contact instructions..."
                className={`w-full rounded-2xl px-4 py-3 border text-sm leading-relaxed transition-colors focus:border-red-500 focus:outline-none font-sans ${
                  isDark
                    ? 'bg-[#0B0F14] border-white/10 text-white placeholder-gray-600'
                    : 'bg-neutral-50 border-neutral-200 text-neutral-900 placeholder-neutral-400'
                }`}
              />
            </div>

            {/* Live Interactive Preview */}
            <div className="rounded-2xl border border-white/10 p-4 bg-black/30">
              <div className="flex items-center justify-between mb-2">
                <span className="text-[10px] uppercase font-bold tracking-widest text-gray-400 flex items-center gap-1.5">
                  <span className="material-symbols-outlined text-sm text-vestexa-coral">visibility</span>
                  Live Modal Preview (What targeted customers will see)
                </span>
                <span className="text-[10px] font-mono text-red-400 font-bold">Blurred Background Lock</span>
              </div>

              {/* Mini Modal Preview Card — Styled like Homepage Legal Notice */}
              <div className="rounded-[24px] bg-white border border-black/10 p-6 text-center shadow-2xl">
                <h4 className="text-xl sm:text-2xl font-bold text-neutral-900 tracking-tight leading-tight mb-3">
                  {subjectHeader || 'Local Regulatory Notice'}
                </h4>
                <p className="text-xs sm:text-[13px] text-neutral-600 leading-relaxed mb-5 font-normal max-h-28 overflow-y-auto whitespace-pre-line text-center">
                  {reasonBody || 'Reason(s) and directives for this account restriction will appear here in the same format as the homepage regulatory notice...'}
                </p>
                <div className="inline-flex items-center justify-center h-[40px] px-8 rounded-full bg-black text-white font-semibold text-xs transition-all shadow-[0_4px_14px_rgba(0,0,0,0.25)]">
                  Log out
                </div>
              </div>
            </div>

            {/* Submit Button */}
            <div className="pt-2">
              <button
                type="submit"
                disabled={selectedUserIds.length === 0}
                className={`w-full py-4 rounded-full font-display font-extrabold text-sm uppercase tracking-wider flex items-center justify-center gap-2.5 transition-all shadow-pill ${
                  selectedUserIds.length > 0
                    ? 'bg-red-600 hover:bg-red-500 text-white cursor-pointer hover:shadow-[0_8px_25px_rgba(239,68,68,0.4)] active:scale-[0.99]'
                    : 'bg-gray-700 text-gray-400 cursor-not-allowed'
                }`}
              >
                <span className="material-symbols-outlined text-lg">lock</span>
                <span>
                  Apply Restriction to {selectedUserIds.length}{' '}
                  {selectedUserIds.length === 1 ? 'Customer' : 'Customers'}
                </span>
              </button>
              <p className="text-center text-[11px] text-gray-500 mt-2">
                Targeted users will instantly have their dashboard blurred and locked upon next navigation or poll.
              </p>
            </div>
          </form>
        </div>
      </div>

      {/* ─── Bottom Section: Currently Restricted Customers Ledger ─── */}
      <div className={`rounded-3xl border p-6 ${
        isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-neutral-200 shadow-glass'
      }`}>
        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
          <div>
            <div className="flex items-center gap-2">
              <span className="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse" />
              <h3 className={`text-xl font-display font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                Currently Restricted Customers ({restrictedUsers.length})
              </h3>
            </div>
            <p className={`text-xs mt-1 ${isDark ? 'text-gray-400' : 'text-neutral-500'}`}>
              Review accounts with active restrictions, edit their notice content, or lift access locks.
            </p>
          </div>

          {/* Mass Lift Action */}
          {ledgerSelectedIds.length > 0 && (
            <button
              type="button"
              onClick={handleLiftMass}
              className="px-4 py-2 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-extrabold tracking-wide uppercase shadow-pill transition-all flex items-center gap-2"
            >
              <span className="material-symbols-outlined text-sm">lock_open</span>
              <span>Lift Restrictions ({ledgerSelectedIds.length})</span>
            </button>
          )}
        </div>

        {/* Ledger Table */}
        <div className="overflow-x-auto">
          <table className="w-full text-left text-xs">
            <thead>
              <tr className={`border-b text-[10px] font-bold uppercase tracking-wider ${
                isDark ? 'border-white/10 text-gray-400' : 'border-neutral-200 text-neutral-500'
              }`}>
                <th className="py-3 px-3 w-10">
                  <input
                    type="checkbox"
                    checked={restrictedUsers.length > 0 && ledgerSelectedIds.length === restrictedUsers.length}
                    onChange={(e) => {
                      if (e.target.checked) {
                        setLedgerSelectedIds(restrictedUsers.map((u) => u.id));
                      } else {
                        setLedgerSelectedIds([]);
                      }
                    }}
                    className="w-4 h-4 rounded text-vestexa-coral focus:ring-vestexa-coral cursor-pointer"
                  />
                </th>
                <th className="py-3 px-4">Customer</th>
                <th className="py-3 px-4">Restriction Subject (Header)</th>
                <th className="py-3 px-4">Date Imposed</th>
                <th className="py-3 px-4">Admin Authority</th>
                <th className="py-3 px-4 text-right">Actions</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-white/5">
              {restrictedUsers.map((u) => {
                const isSelectedInLedger = ledgerSelectedIds.includes(u.id);
                return (
                  <tr
                    key={u.id}
                    className={`transition-colors ${
                      isSelectedInLedger
                        ? isDark ? 'bg-red-500/10' : 'bg-red-50/70'
                        : isDark ? 'hover:bg-white/[0.02]' : 'hover:bg-neutral-50'
                    }`}
                  >
                    <td className="py-3.5 px-3">
                      <input
                        type="checkbox"
                        checked={isSelectedInLedger}
                        onChange={() => {
                          setLedgerSelectedIds((prev) =>
                            prev.includes(u.id) ? prev.filter((id) => id !== u.id) : [...prev, u.id]
                          );
                        }}
                        className="w-4 h-4 rounded text-vestexa-coral focus:ring-vestexa-coral cursor-pointer"
                      />
                    </td>
                    <td className="py-3.5 px-4">
                      <div className="flex items-center gap-3">
                        {u.avatarUrl ? (
                          <img
                            src={u.avatarUrl}
                            alt={u.fullName}
                            className="w-8 h-8 rounded-full object-cover shrink-0 ring-1 ring-red-500/30"
                          />
                        ) : (
                          <div className="w-8 h-8 rounded-full bg-red-500/20 text-red-400 font-bold text-xs flex items-center justify-center shrink-0">
                            {u.fullName.split(' ').map((n) => n[0]).join('').substring(0, 2)}
                          </div>
                        )}
                        <div>
                          <div className={`font-bold ${isDark ? 'text-white' : 'text-neutral-900'}`}>
                            {u.fullName}
                          </div>
                          <div className="text-[11px] text-gray-400 font-mono">
                            {u.email}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td className="py-3.5 px-4">
                      <div className={`font-bold text-xs ${isDark ? 'text-red-400' : 'text-red-600'}`}>
                        {u.restrictionHeader || 'No subject header recorded'}
                      </div>
                      <div className="text-[11px] text-gray-400 truncate max-w-xs mt-0.5">
                        {u.restrictionReason}
                      </div>
                    </td>
                    <td className="py-3.5 px-4 font-mono text-[11px] text-gray-400">
                      {u.restrictedAt ? new Date(u.restrictedAt).toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                      }) : 'Recent'}
                    </td>
                    <td className="py-3.5 px-4 text-gray-400 text-xs">
                      {u.restrictedBy || 'System Admin'}
                    </td>
                    <td className="py-3.5 px-4 text-right">
                      <div className="flex items-center justify-end gap-2">
                        <button
                          type="button"
                          onClick={() => handleEditExistingNotice(u)}
                          className="px-3 py-1.5 rounded-xl border border-white/10 hover:border-vestexa-coral/40 text-gray-300 hover:text-white transition-all text-xs font-semibold flex items-center gap-1"
                          title="Edit restriction in CMS editor"
                        >
                          <span className="material-symbols-outlined text-sm">edit</span>
                          <span>Edit</span>
                        </button>
                        <button
                          type="button"
                          onClick={() => handleLiftSingle(u.id, u.fullName)}
                          className="px-3 py-1.5 rounded-xl bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 border border-emerald-500/30 transition-all text-xs font-bold flex items-center gap-1"
                          title="Lift restriction immediately"
                        >
                          <span className="material-symbols-outlined text-sm">lock_open</span>
                          <span>Lift</span>
                        </button>
                      </div>
                    </td>
                  </tr>
                );
              })}

              {restrictedUsers.length === 0 && (
                <tr>
                  <td colSpan={6} className={`py-10 text-center text-xs ${isDark ? 'text-gray-500' : 'text-neutral-400'}`}>
                    <span className="material-symbols-outlined text-3xl mb-1 text-emerald-500 block">
                      verified_user
                    </span>
                    No active restrictions. All customer accounts currently have full portal access.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

