import React, { useState, useEffect } from 'react';
import {
  User,
  LoanApplication,
  getLoans,
  createLoan,
  createNotification,
} from '../../lib/storage';

interface LoansSectionProps {
  user: User;
  isDark: boolean;
  onUserUpdate: () => void;
  formatCurrency: (amount: number) => string;
}

export const LoansSection: React.FC<LoansSectionProps> = ({
  user,
  isDark,
  onUserUpdate,
  formatCurrency,
}) => {
  const [loans, setLoans] = useState<LoanApplication[]>([]);
  const [isApplyModalOpen, setIsApplyModalOpen] = useState(false);
  const [amount, setAmount] = useState('');
  const [purpose, setPurpose] = useState('');
  const [duration, setDuration] = useState('12 Months');
  const [errorMsg, setErrorMsg] = useState('');
  const [successMsg, setSuccessMsg] = useState('');

  useEffect(() => {
    loadLoans();
  }, [user.id]);

  const loadLoans = () => {
    setLoans(getLoans(user.id));
  };

  const handleApplyLoan = (e: React.FormEvent) => {
    e.preventDefault();
    setErrorMsg('');

    const numAmount = parseFloat(amount);
    if (isNaN(numAmount) || numAmount < 1000) {
      setErrorMsg('Minimum credit facility application amount is $1,000.');
      return;
    }

    if (!purpose.trim()) {
      setErrorMsg('Please specify the corporate or investment purpose for this loan.');
      return;
    }

    createLoan({
      userId: user.id,
      amount: numAmount,
      purpose: purpose.trim(),
      duration,
      status: 'pending',
      interestRate: 4.5,
    });

    createNotification({
      userId: user.id,
      title: 'Loan Application Submitted',
      message: `Your credit application for ${formatCurrency(numAmount)} has been submitted for underwriting review.`,
      type: 'info',
    });

    setSuccessMsg(`Application for ${formatCurrency(numAmount)} submitted successfully! Our credit desk will review within 24 hours.`);
    setIsApplyModalOpen(false);
    setAmount('');
    setPurpose('');
    loadLoans();
    onUserUpdate();

    setTimeout(() => setSuccessMsg(''), 5000);
  };

  const activeLoans = loans.filter(l => l.status === 'approved' || l.status === 'active');
  const totalBorrowed = activeLoans.reduce((sum, l) => sum + l.amount, 0);

  return (
    <div className="space-y-8">
      {/* Header */}
      <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <h1 className={`text-3xl sm:text-4xl font-display font-extrabold tracking-tight mb-2 ${
            isDark ? 'text-white' : 'text-slate-900'
          }`}>
            Institutional Credit & Liquidity Facilities
          </h1>
          <p className={`text-sm ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
            Secure collateralized and bespoke liquidity lines with competitive fixed APR rates.
          </p>
        </div>

        <button
          onClick={() => setIsApplyModalOpen(true)}
          className="px-6 py-3 rounded-full font-display text-xs font-bold text-white bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all duration-200 flex items-center gap-2 self-start md:self-auto"
        >
          <span className="material-symbols-outlined text-base">add_card</span>
          Apply for Credit Facility
        </button>
      </div>

      {successMsg && (
        <div className="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm flex items-center gap-3">
          <span className="material-symbols-outlined text-lg">check_circle</span>
          <span>{successMsg}</span>
        </div>
      )}

      {/* Stats Cards */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div className={`p-6 rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-3">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Active Facilities
            </span>
            <span className="p-2 rounded-xl bg-vestexa-coral/10 text-vestexa-coral material-symbols-outlined text-lg">
              receipt_long
            </span>
          </div>
          <div className={`text-2xl sm:text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            {formatCurrency(totalBorrowed)}
          </div>
          <p className="text-xs text-emerald-500 font-semibold mt-1">
            {activeLoans.length} Active Credit Lines
          </p>
        </div>

        <div className={`p-6 rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-3">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Fixed Benchmark APR
            </span>
            <span className="p-2 rounded-xl bg-emerald-500/10 text-emerald-400 material-symbols-outlined text-lg">
              percent
            </span>
          </div>
          <div className={`text-2xl sm:text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            4.8% Fixed
          </div>
          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'} mt-1`}>
            Subsidized Institutional Rate
          </p>
        </div>

        <div className={`p-6 rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-3">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Pre-Approved Ceiling
            </span>
            <span className="p-2 rounded-xl bg-blue-500/10 text-blue-400 material-symbols-outlined text-lg">
              speed
            </span>
          </div>
          <div className={`text-2xl sm:text-3xl font-display font-extrabold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            {formatCurrency(250000)}
          </div>
          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'} mt-1`}>
            Tier 1 Client Liquidity Limit
          </p>
        </div>

        <div className={`p-6 rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-3">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Repayment Health
            </span>
            <span className="p-2 rounded-xl bg-purple-500/10 text-purple-400 material-symbols-outlined text-lg">
              verified
            </span>
          </div>
          <div className={`text-2xl sm:text-3xl font-display font-extrabold text-emerald-400`}>
            AAA
          </div>
          <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'} mt-1`}>
            Prime Sovereign Rating
          </p>
        </div>
      </div>

      {/* Loans Applications Table */}
      <div className={`rounded-3xl border overflow-hidden ${
        isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
      }`}>
        <div className="p-6 border-b border-inherit flex items-center justify-between">
          <div>
            <h2 className={`text-xl font-display font-bold ${isDark ? 'text-white' : 'text-slate-900'}`}>
              Credit Facilities History
            </h2>
            <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              All pending underwritings and active loan facilities
            </p>
          </div>
          <span className={`text-xs px-3 py-1 rounded-full font-bold ${
            isDark ? 'bg-gray-800 text-gray-300' : 'bg-slate-100 text-slate-700'
          }`}>
            {loans.length} Total
          </span>
        </div>

        {loans.length === 0 ? (
          <div className="p-12 text-center">
            <span className="material-symbols-outlined text-5xl text-gray-500 mb-3">account_balance</span>
            <h3 className={`text-base font-display font-bold ${isDark ? 'text-white' : 'text-slate-900'}`}>
              No Credit Applications
            </h3>
            <p className={`text-xs mt-1 max-w-sm mx-auto ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Need liquidity for investments or capital requirements? Apply for a facility above.
            </p>
          </div>
        ) : (
          <div className="overflow-x-auto">
            <table className="w-full text-left text-sm">
              <thead className={`text-xs uppercase font-bold tracking-wider border-b ${
                isDark ? 'bg-gray-900/50 text-gray-400 border-gray-800' : 'bg-slate-50 text-slate-500 border-slate-200'
              }`}>
                <tr>
                  <th className="px-6 py-4">Purpose / Reference</th>
                  <th className="px-6 py-4">Facility Amount</th>
                  <th className="px-6 py-4">Tenor</th>
                  <th className="px-6 py-4">Fixed APR</th>
                  <th className="px-6 py-4">Underwriting Status</th>
                  <th className="px-6 py-4">Applied Date</th>
                </tr>
              </thead>
              <tbody className={`divide-y ${isDark ? 'divide-gray-800/80 text-gray-200' : 'divide-slate-100 text-slate-700'}`}>
                {loans.map((loan) => (
                  <tr key={loan.id} className={isDark ? 'hover:bg-gray-800/30' : 'hover:bg-slate-50'}>
                    <td className="px-6 py-4 font-bold flex items-center gap-2.5">
                      <span className="material-symbols-outlined text-vestexa-coral text-lg">contract</span>
                      {loan.purpose}
                    </td>
                    <td className="px-6 py-4 font-mono font-bold">
                      {formatCurrency(loan.amount)}
                    </td>
                    <td className="px-6 py-4 font-semibold">{loan.duration}</td>
                    <td className="px-6 py-4 font-mono text-emerald-400 font-bold">
                      {loan.interestRate || 4.8}%
                    </td>
                    <td className="px-6 py-4">
                      <span className={`px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider ${
                        loan.status === 'approved' || loan.status === 'active'
                          ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20'
                          : loan.status === 'pending'
                            ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20'
                            : 'bg-red-500/10 text-red-400 border border-red-500/20'
                      }`}>
                        {loan.status}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-xs font-mono">
                      {new Date(loan.createdAt).toLocaleDateString()}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>

      {/* Loan Application Modal */}
      {isApplyModalOpen && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
          <div className={`w-full max-w-lg rounded-3xl border p-6 sm:p-8 shadow-2xl relative ${
            isDark ? 'bg-[#161B22] border-gray-800 text-white' : 'bg-white border-slate-200 text-slate-900'
          }`}>
            <button
              onClick={() => setIsApplyModalOpen(false)}
              className={`absolute top-6 right-6 p-1.5 rounded-full ${
                isDark ? 'hover:bg-gray-800 text-gray-400' : 'hover:bg-slate-100 text-slate-500'
              }`}
            >
              <span className="material-symbols-outlined text-lg">close</span>
            </button>

            <div className="flex items-center gap-3 mb-6">
              <div className="w-12 h-12 rounded-2xl bg-vestexa-coral/10 text-vestexa-coral flex items-center justify-center font-bold">
                <span className="material-symbols-outlined text-2xl">account_balance</span>
              </div>
              <div>
                <h3 className="text-xl font-display font-bold">
                  Apply for Institutional Credit
                </h3>
                <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Disbursed directly into your liquid balance upon approval
                </p>
              </div>
            </div>

            {errorMsg && (
              <div className="mb-4 p-3.5 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs flex items-center gap-2">
                <span className="material-symbols-outlined text-base">error</span>
                <span>{errorMsg}</span>
              </div>
            )}

            <form onSubmit={handleApplyLoan} className="space-y-4">
              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Requested Loan Amount ($)
                </label>
                <input
                  type="number"
                  step="any"
                  value={amount}
                  onChange={(e) => setAmount(e.target.value)}
                  placeholder="e.g. 50000"
                  className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                    isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                  }`}
                />
              </div>

              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Facility Tenor / Term
                </label>
                <select
                  value={duration}
                  onChange={(e) => setDuration(e.target.value)}
                  className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                    isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                  }`}
                >
                  <option value="6 Months">6 Months (4.2% APR)</option>
                  <option value="12 Months">12 Months (4.8% APR)</option>
                  <option value="24 Months">24 Months (5.4% APR)</option>
                  <option value="36 Months">36 Months (5.9% APR)</option>
                </select>
              </div>

              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Purpose of Financing
                </label>
                <textarea
                  rows={3}
                  value={purpose}
                  onChange={(e) => setPurpose(e.target.value)}
                  placeholder="e.g. Strategic real estate acquisition, portfolio hedging, private equity injection"
                  className={`w-full rounded-2xl px-4 py-3 text-sm border transition-all focus:outline-none ${
                    isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                  }`}
                />
              </div>

              <div className="flex gap-3 pt-4">
                <button
                  type="button"
                  onClick={() => setIsApplyModalOpen(false)}
                  className={`flex-1 py-3 rounded-full text-xs font-bold ${
                    isDark ? 'bg-gray-800 text-gray-300' : 'bg-slate-100 text-slate-700'
                  }`}
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  className="flex-1 py-3 rounded-full text-xs font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover text-white shadow-pill"
                >
                  Submit Underwriting Request
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};
