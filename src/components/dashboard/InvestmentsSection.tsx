import React, { useState, useEffect } from 'react';
import {
  User,
  InvestmentPlan,
  UserInvestment,
  getInvestmentPlans,
  getUserInvestments,
  createUserInvestment,
  getUserById,
} from '../../lib/storage';
import { processRoiAccruals } from '../../lib/roiEngine';
import { processReferralCommission } from '../../lib/referralEngine';

interface InvestmentsSectionProps {
  user: User;
  isDark: boolean;
  onUserUpdate: () => void;
  formatCurrency: (amount: number) => string;
}

export const InvestmentsSection: React.FC<InvestmentsSectionProps> = ({
  user,
  isDark,
  onUserUpdate,
  formatCurrency,
}) => {
  const [plans, setPlans] = useState<InvestmentPlan[]>([]);
  const [investments, setInvestments] = useState<UserInvestment[]>([]);
  const [selectedPlan, setSelectedPlan] = useState<InvestmentPlan | null>(null);
  const [investAmount, setInvestAmount] = useState<string>('');
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [successMsg, setSuccessMsg] = useState('');
  const [isProcessingAccrual, setIsProcessingAccrual] = useState(false);

  useEffect(() => {
    loadData();
  }, [user.id]);

  const loadData = () => {
    setPlans(getInvestmentPlans().filter(p => p.isActive));
    setInvestments(getUserInvestments(user.id));
  };

  const handleOpenInvestModal = (plan: InvestmentPlan) => {
    setSelectedPlan(plan);
    setInvestAmount(plan.minAmount.toString());
    setErrorMsg('');
    setIsModalOpen(true);
  };

  const handleConfirmInvestment = (e: React.FormEvent) => {
    e.preventDefault();
    setErrorMsg('');

    if (!selectedPlan) return;
    const amount = parseFloat(investAmount);

    if (isNaN(amount) || amount <= 0) {
      setErrorMsg('Please enter a valid investment amount.');
      return;
    }

    if (amount < selectedPlan.minAmount) {
      setErrorMsg(`Minimum investment for this plan is ${formatCurrency(selectedPlan.minAmount)}.`);
      return;
    }

    if (amount > selectedPlan.maxAmount) {
      setErrorMsg(`Maximum investment for this plan is ${formatCurrency(selectedPlan.maxAmount)}.`);
      return;
    }

    // Refresh current fresh balance
    const freshUser = getUserById(user.id);
    if (!freshUser || freshUser.balance < amount) {
      setErrorMsg(`Insufficient account balance. Available: ${formatCurrency(freshUser?.balance || 0)}.`);
      return;
    }

    const durationDays = selectedPlan.durationDays || 30;
    const expiresAt = new Date(Date.now() + durationDays * 86400000).toISOString();

    // Create investment
    createUserInvestment({
      userId: user.id,
      planId: selectedPlan.id,
      planName: selectedPlan.name,
      amount,
      roiPercentage: selectedPlan.roiPercentage,
      roiInterval: selectedPlan.roiInterval,
      status: 'active',
      activatedAt: new Date().toISOString(),
      expiresAt,
      lastRoiAt: new Date().toISOString(),
    });

    // Multi-level referral commission distribution
    processReferralCommission(user.id, amount);

    setSuccessMsg(`Successfully subscribed to ${selectedPlan.name} for ${formatCurrency(amount)}!`);
    setIsModalOpen(false);
    loadData();
    onUserUpdate();

    setTimeout(() => setSuccessMsg(''), 5000);
  };

  const handleSimulateRoi = () => {
    setIsProcessingAccrual(true);
    try {
      const res = processRoiAccruals({ forceAccelerated: true });
      loadData();
      onUserUpdate();
      if (res.processedCount > 0) {
        setSuccessMsg(`Accelerated yield applied! Earned +${formatCurrency(res.totalEarnedAmount)} across ${res.processedCount} active position(s).`);
      } else {
        setSuccessMsg('Yield engine checked. All active returns are up-to-date.');
      }
      setTimeout(() => setSuccessMsg(''), 5000);
    } catch {
      setErrorMsg('Failed to run yield engine calculation.');
    } finally {
      setIsProcessingAccrual(false);
    }
  };

  const activeInvestments = investments.filter(i => i.status === 'active');
  const totalActiveInvested = activeInvestments.reduce((acc, curr) => acc + curr.amount, 0);
  const totalRoiEarned = investments.reduce((acc, curr) => acc + (curr.totalEarned || 0), 0) + (user.roi || 0);

  return (
    <div className="space-y-8">
      {/* Header */}
      <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <h1 className={`text-3xl sm:text-4xl font-display font-extrabold tracking-tight mb-2 ${
            isDark ? 'text-white' : 'text-slate-900'
          }`}>
            Investment Portfolio & Yield
          </h1>
          <p className={`text-sm ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
            Subscribe to automated algorithmic yield portfolios with guaranteed ROI intervals.
          </p>
        </div>

        {/* Accelerate Yield Demo CTA */}
        <button
          onClick={handleSimulateRoi}
          disabled={isProcessingAccrual || activeInvestments.length === 0}
          title="Run instantaneous demo ROI simulation cycle"
          className={`px-5 py-2.5 rounded-full font-display text-xs font-bold transition-all shadow-pill flex items-center gap-2 self-start md:self-auto ${
            activeInvestments.length === 0
              ? 'opacity-50 cursor-not-allowed bg-gray-700 text-gray-400'
              : 'bg-gradient-to-r from-amber-500 to-vestexa-coral text-white hover:opacity-95'
          }`}
        >
          <span className={`material-symbols-outlined text-base ${isProcessingAccrual ? 'animate-spin' : ''}`}>
            {isProcessingAccrual ? 'sync' : 'bolt'}
          </span>
          {isProcessingAccrual ? 'Simulating Returns...' : 'Accelerate Yield (Demo Ticker)'}
        </button>
      </div>

      {/* Success Notification Banner */}
      {successMsg && (
        <div className="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm flex items-center gap-3">
          <span className="material-symbols-outlined text-lg">check_circle</span>
          <span>{successMsg}</span>
        </div>
      )}

      {/* KPI Stats Cards */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div className={`p-6 rounded-3xl border transition-all ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-3">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Active Investment
            </span>
            <span className="p-2 rounded-xl bg-vestexa-coral/10 text-vestexa-coral material-symbols-outlined text-lg">
              account_balance_wallet
            </span>
          </div>
          <div className={`text-2xl sm:text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            {formatCurrency(totalActiveInvested || user.investedAmount || 0)}
          </div>
          <p className="text-xs text-emerald-500 font-semibold mt-1 flex items-center gap-1">
            <span className="material-symbols-outlined text-xs">trending_up</span>
            {activeInvestments.length} Active Positions
          </p>
        </div>

        <div className={`p-6 rounded-3xl border transition-all ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-3">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Total ROI Accrued
            </span>
            <span className="p-2 rounded-xl bg-emerald-500/10 text-emerald-400 material-symbols-outlined text-lg">
              savings
            </span>
          </div>
          <div className={`text-2xl sm:text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            {formatCurrency(totalRoiEarned)}
          </div>
          <p className="text-xs text-emerald-500 font-semibold mt-1">
            Automated Daily Accrual
          </p>
        </div>

        <div className={`p-6 rounded-3xl border transition-all ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-3">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Referral Commissions
            </span>
            <span className="p-2 rounded-xl bg-purple-500/10 text-purple-400 material-symbols-outlined text-lg">
              diversity_3
            </span>
          </div>
          <div className={`text-2xl sm:text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            {formatCurrency(user.refBonus || 0)}
          </div>
          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'} mt-1`}>
            Multi-Tier Network Payout
          </p>
        </div>

        <div className={`p-6 rounded-3xl border transition-all ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-3">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Available Liquidity
            </span>
            <span className="p-2 rounded-xl bg-blue-500/10 text-blue-400 material-symbols-outlined text-lg">
              payments
            </span>
          </div>
          <div className={`text-2xl sm:text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            {formatCurrency(user.balance)}
          </div>
          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'} mt-1`}>
            Ready to deploy
          </p>
        </div>
      </div>

      {/* Available Plans Catalog */}
      <div>
        <div className="flex items-center justify-between mb-5">
          <h2 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            Featured Investment Portfolios
          </h2>
          <span className={`text-xs font-semibold ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
            {plans.length} Available Plans
          </span>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {plans.map((plan) => (
            <div
              key={plan.id}
              className={`rounded-3xl p-6 border transition-all duration-300 relative flex flex-col justify-between group hover:-translate-y-1 ${
                isDark
                  ? 'bg-[#161B22] border-gray-800/80 hover:border-vestexa-coral/50'
                  : 'bg-white border-slate-200 hover:border-vestexa-coral/50 shadow-sm hover:shadow-md'
              }`}
            >
              {plan.type === 'promo' && (
                <div className="absolute top-4 right-4 bg-gradient-to-r from-amber-500 to-vestexa-coral text-white text-[10px] font-extrabold uppercase px-3 py-1 rounded-full tracking-wider shadow-sm">
                  Promo Sprint
                </div>
              )}

              <div>
                <h3 className={`text-xl font-display font-bold mb-1 ${isDark ? 'text-white' : 'text-slate-900'}`}>
                  {plan.name}
                </h3>
                <div className="flex items-baseline gap-2 mt-4 mb-5">
                  <span className="text-4xl font-display font-extrabold text-vestexa-coral">
                    {plan.roiPercentage}%
                  </span>
                  <span className={`text-xs font-semibold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                    ROI / {plan.roiInterval}
                  </span>
                </div>

                <div className={`space-y-3 py-4 border-y text-xs ${isDark ? 'border-gray-800/80 text-gray-300' : 'border-slate-100 text-slate-600'}`}>
                  <div className="flex justify-between items-center">
                    <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>Min Investment</span>
                    <span className="font-bold">{formatCurrency(plan.minAmount)}</span>
                  </div>
                  <div className="flex justify-between items-center">
                    <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>Max Investment</span>
                    <span className="font-bold">{formatCurrency(plan.maxAmount)}</span>
                  </div>
                  <div className="flex justify-between items-center">
                    <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>Duration Term</span>
                    <span className="font-bold">{plan.durationDays} Days</span>
                  </div>
                  <div className="flex justify-between items-center">
                    <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>Capital Return</span>
                    <span className="text-emerald-500 font-bold flex items-center gap-1">
                      <span className="material-symbols-outlined text-sm">verified</span>
                      {plan.returnCapital ? '100% Guaranteed' : 'Included in ROI'}
                    </span>
                  </div>
                </div>
              </div>

              <div className="mt-6">
                <button
                  onClick={() => handleOpenInvestModal(plan)}
                  className="w-full py-3 rounded-full text-white font-display text-xs font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all duration-200 flex items-center justify-center gap-2"
                >
                  <span className="material-symbols-outlined text-sm">rocket_launch</span>
                  Invest in Plan
                </button>
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Active User Investments Table */}
      <div className={`rounded-3xl border overflow-hidden ${
        isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
      }`}>
        <div className="p-6 border-b border-inherit flex items-center justify-between">
          <div>
            <h2 className={`text-xl font-display font-bold ${isDark ? 'text-white' : 'text-slate-900'}`}>
              My Active & Past Positions
            </h2>
            <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Track your running yields, maturity milestones, and accrued returns
            </p>
          </div>
          <span className={`text-xs px-3 py-1 rounded-full font-bold ${
            isDark ? 'bg-gray-800 text-gray-300' : 'bg-slate-100 text-slate-700'
          }`}>
            {investments.length} Records
          </span>
        </div>

        {investments.length === 0 ? (
          <div className="p-12 text-center">
            <span className="material-symbols-outlined text-5xl text-gray-500 mb-3">trending_up</span>
            <h3 className={`text-base font-display font-bold ${isDark ? 'text-white' : 'text-slate-900'}`}>
              No Investments Yet
            </h3>
            <p className={`text-xs mt-1 max-w-sm mx-auto ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Select a portfolio from above to begin accruing automated algorithmic returns.
            </p>
          </div>
        ) : (
          <div className="overflow-x-auto">
            <table className="w-full text-left text-sm">
              <thead className={`text-xs uppercase font-bold tracking-wider border-b ${
                isDark ? 'bg-gray-900/50 text-gray-400 border-gray-800' : 'bg-slate-50 text-slate-500 border-slate-200'
              }`}>
                <tr>
                  <th className="px-6 py-4">Portfolio Plan</th>
                  <th className="px-6 py-4">Capital Amount</th>
                  <th className="px-6 py-4">ROI Yield</th>
                  <th className="px-6 py-4">Accrued Earned</th>
                  <th className="px-6 py-4">Status</th>
                  <th className="px-6 py-4">Started On</th>
                </tr>
              </thead>
              <tbody className={`divide-y ${isDark ? 'divide-gray-800/80 text-gray-200' : 'divide-slate-100 text-slate-700'}`}>
                {investments.map((inv) => (
                  <tr key={inv.id} className={isDark ? 'hover:bg-gray-800/30' : 'hover:bg-slate-50'}>
                    <td className="px-6 py-4 font-bold flex items-center gap-2.5">
                      <span className="material-symbols-outlined text-vestexa-coral text-lg">auto_graph</span>
                      {inv.planName || 'Custom Portfolio'}
                    </td>
                    <td className="px-6 py-4 font-mono font-bold">
                      {formatCurrency(inv.amount)}
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-emerald-500 font-bold">
                        {inv.roiPercentage}% / {inv.roiInterval}
                      </span>
                    </td>
                    <td className="px-6 py-4 font-mono font-bold text-emerald-500">
                      +{formatCurrency(inv.totalEarned || 0)}
                    </td>
                    <td className="px-6 py-4">
                      <span className={`px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider ${
                        inv.status === 'active'
                          ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20'
                          : inv.status === 'expired'
                            ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20'
                            : 'bg-amber-500/10 text-amber-400 border border-amber-500/20'
                      }`}>
                        {inv.status}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-xs font-mono">
                      {inv.activatedAt ? new Date(inv.activatedAt).toLocaleDateString() : new Date(inv.createdAt).toLocaleDateString()}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>

      {/* Invest Modal Dialog */}
      {isModalOpen && selectedPlan && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
          <div className={`w-full max-w-lg rounded-3xl border p-6 sm:p-8 shadow-2xl relative ${
            isDark ? 'bg-[#161B22] border-gray-800 text-white' : 'bg-white border-slate-200 text-slate-900'
          }`}>
            <button
              onClick={() => setIsModalOpen(false)}
              className={`absolute top-6 right-6 p-1.5 rounded-full transition-colors ${
                isDark ? 'hover:bg-gray-800 text-gray-400' : 'hover:bg-slate-100 text-slate-500'
              }`}
            >
              <span className="material-symbols-outlined text-lg">close</span>
            </button>

            <div className="flex items-center gap-3 mb-6">
              <div className="w-12 h-12 rounded-2xl bg-vestexa-coral/10 text-vestexa-coral flex items-center justify-center font-bold">
                <span className="material-symbols-outlined text-2xl">trending_up</span>
              </div>
              <div>
                <h3 className="text-xl font-display font-bold">
                  Subscribe to {selectedPlan.name}
                </h3>
                <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  {selectedPlan.roiPercentage}% ROI / {selectedPlan.roiInterval} for {selectedPlan.durationDays} days
                </p>
              </div>
            </div>

            {errorMsg && (
              <div className="mb-4 p-3.5 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs flex items-center gap-2">
                <span className="material-symbols-outlined text-base">error</span>
                <span>{errorMsg}</span>
              </div>
            )}

            <form onSubmit={handleConfirmInvestment} className="space-y-5">
              <div>
                <div className="flex justify-between text-xs font-bold uppercase mb-2">
                  <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>Investment Amount</span>
                  <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>
                    Available: <span className="text-vestexa-coral">{formatCurrency(user.balance)}</span>
                  </span>
                </div>
                <div className="relative">
                  <span className="absolute left-4 top-3.5 text-gray-400 font-bold">$</span>
                  <input
                    type="number"
                    step="any"
                    value={investAmount}
                    onChange={(e) => setInvestAmount(e.target.value)}
                    placeholder="Enter amount"
                    className={`w-full rounded-2xl pl-8 pr-20 py-3 text-sm font-bold border transition-all focus:outline-none ${
                      isDark
                        ? 'bg-[#0D1117] border-gray-800 focus:border-vestexa-coral text-white'
                        : 'bg-slate-50 border-slate-200 focus:border-vestexa-coral text-slate-900'
                    }`}
                  />
                  <button
                    type="button"
                    onClick={() => setInvestAmount(Math.min(user.balance, selectedPlan.maxAmount).toString())}
                    className="absolute right-3 top-2.5 px-3 py-1 rounded-xl text-xs font-bold bg-vestexa-coral/20 text-vestexa-coral hover:bg-vestexa-coral/30 transition-colors"
                  >
                    MAX
                  </button>
                </div>
                <p className={`text-[11px] mt-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Limits: {formatCurrency(selectedPlan.minAmount)} – {formatCurrency(selectedPlan.maxAmount)}
                </p>
              </div>

              {/* Forecast preview */}
              <div className={`p-4 rounded-2xl border text-xs space-y-2 ${
                isDark ? 'bg-[#0D1117] border-gray-800 text-gray-300' : 'bg-slate-50 border-slate-200 text-slate-600'
              }`}>
                <div className="flex justify-between">
                  <span>Estimated Periodic ROI</span>
                  <span className="text-emerald-500 font-bold">
                    +{formatCurrency(((parseFloat(investAmount) || 0) * selectedPlan.roiPercentage) / 100)} / {selectedPlan.roiInterval}
                  </span>
                </div>
                <div className="flex justify-between">
                  <span>Total Capital Maturity</span>
                  <span className="font-bold text-white">
                    {formatCurrency((parseFloat(investAmount) || 0))} (Returned upon completion)
                  </span>
                </div>
              </div>

              <div className="flex gap-3 pt-2">
                <button
                  type="button"
                  onClick={() => setIsModalOpen(false)}
                  className={`flex-1 py-3 rounded-full text-xs font-bold transition-colors ${
                    isDark ? 'bg-gray-800 hover:bg-gray-700 text-gray-300' : 'bg-slate-100 hover:bg-slate-200 text-slate-700'
                  }`}
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  className="flex-1 py-3 rounded-full text-xs font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover text-white shadow-pill transition-all"
                >
                  Confirm & Lock Plan
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};
