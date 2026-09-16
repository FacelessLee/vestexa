import React, { useState } from 'react';
import { User, getAppSettings } from '../../lib/storage';
import { getReferralCode, getReferralLink, getReferralNetwork } from '../../lib/referralEngine';

interface ReferralsSectionProps {
  user: User;
  isDark: boolean;
  formatCurrency: (amount: number) => string;
}

export const ReferralsSection: React.FC<ReferralsSectionProps> = ({
  user,
  isDark,
  formatCurrency,
}) => {
  const [copied, setCopied] = useState(false);
  const settings = getAppSettings();
  const referralCode = getReferralCode(user);
  const referralLink = getReferralLink(user);
  const network = getReferralNetwork(user.id);
  const commissionTiers = settings.referralCommissionLevels || [5, 3, 2, 1, 0.5];

  const handleCopy = () => {
    navigator.clipboard.writeText(referralLink);
    setCopied(true);
    setTimeout(() => setCopied(false), 3000);
  };

  return (
    <div className="space-y-8">
      {/* Header */}
      <div>
        <h1 className={`text-3xl sm:text-4xl font-display font-extrabold tracking-tight mb-2 ${
          isDark ? 'text-white' : 'text-slate-900'
        }`}>
          Affiliate Network & Multi-Tier Rewards
        </h1>
        <p className={`text-sm ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
          Earn recurring multi-tier commissions up to 5 tiers deep on every investment made by your invited network.
        </p>
      </div>

      {/* Hero Invite Card */}
      <div className={`p-6 sm:p-8 rounded-3xl border relative overflow-hidden ${
        isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
      }`}>
        <div className="max-w-2xl relative z-10">
          <span className="px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-vestexa-coral/20 text-vestexa-coral mb-3 inline-block">
            5-Tier Commission Program
          </span>
          <h2 className={`text-2xl sm:text-3xl font-display font-extrabold mb-3 ${isDark ? 'text-white' : 'text-slate-900'}`}>
            Share Vestexa, Grow Wealth Together
          </h2>
          <p className={`text-xs sm:text-sm ${isDark ? 'text-gray-300' : 'text-slate-600'} leading-relaxed mb-6`}>
            Every time your invited partners subscribe to an algorithmic yield portfolio, commission payouts are instantly credited to your liquid account balance with zero holding delay.
          </p>

          {/* Referral Link Copy Bar */}
          <div className="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <div className={`flex-1 flex items-center gap-3 px-4 py-3 rounded-2xl border ${
              isDark ? 'bg-[#0D1117] border-gray-800' : 'bg-slate-50 border-slate-200'
            }`}>
              <span className="material-symbols-outlined text-gray-400 text-lg">link</span>
              <input
                type="text"
                readOnly
                value={referralLink}
                className={`w-full bg-transparent text-xs font-mono font-bold focus:outline-none ${
                  isDark ? 'text-white' : 'text-slate-900'
                }`}
              />
            </div>

            <button
              onClick={handleCopy}
              className="px-6 py-3.5 rounded-2xl font-display text-xs font-bold text-white bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all flex items-center justify-center gap-2"
            >
              <span className="material-symbols-outlined text-sm">
                {copied ? 'check' : 'content_copy'}
              </span>
              {copied ? 'Copied to Clipboard!' : 'Copy Invite Link'}
            </button>
          </div>
        </div>
      </div>

      {/* KPI Stats */}
      <div className="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div className={`p-6 rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-2">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Total Affiliate Payout
            </span>
            <span className="p-2 rounded-xl bg-vestexa-coral/10 text-vestexa-coral material-symbols-outlined text-lg">
              payments
            </span>
          </div>
          <div className={`text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            {formatCurrency(user.refBonus || 0)}
          </div>
          <p className="text-xs text-emerald-500 font-semibold mt-1">
            Settled Directly to Balance
          </p>
        </div>

        <div className={`p-6 rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-2">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Direct Downline Partners
            </span>
            <span className="p-2 rounded-xl bg-purple-500/10 text-purple-400 material-symbols-outlined text-lg">
              group
            </span>
          </div>
          <div className={`text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            {network.totalDirect}
          </div>
          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'} mt-1`}>
            Tier 1 Registered Accounts
          </p>
        </div>

        <div className={`p-6 rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-2">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Unique Referral Code
            </span>
            <span className="p-2 rounded-xl bg-blue-500/10 text-blue-400 material-symbols-outlined text-lg">
              badge
            </span>
          </div>
          <div className={`text-3xl font-mono font-extrabold text-vestexa-coral`}>
            {referralCode}
          </div>
          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'} mt-1`}>
            Valid for all new signups
          </p>
        </div>
      </div>

      {/* Multi-Tier Commission Ladder */}
      <div className={`p-6 sm:p-8 rounded-3xl border ${
        isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
      }`}>
        <h3 className={`text-xl font-display font-bold mb-2 ${isDark ? 'text-white' : 'text-slate-900'}`}>
          Network Commission Structure
        </h3>
        <p className={`text-xs mb-6 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
          Earn overrides on downstream investments across all 5 organizational tiers
        </p>

        <div className="grid grid-cols-2 sm:grid-cols-5 gap-4">
          {commissionTiers.map((rate, idx) => (
            <div
              key={idx}
              className={`p-4 rounded-2xl border text-center ${
                isDark ? 'bg-[#0D1117] border-gray-800' : 'bg-slate-50 border-slate-200'
              }`}
            >
              <span className={`text-[10px] font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                Tier {idx + 1}
              </span>
              <div className="text-2xl font-display font-extrabold text-vestexa-coral my-1">
                {rate}%
              </div>
              <p className={`text-[10px] ${isDark ? 'text-gray-500' : 'text-slate-400'}`}>
                {idx === 0 ? 'Direct Invite' : `Sub-Level ${idx + 1}`}
              </p>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};
