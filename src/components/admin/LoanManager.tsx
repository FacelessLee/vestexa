import React, { useState, useEffect } from 'react';
import {
  LoanApplication,
  User,
  getLoans,
  updateLoanStatus,
  getUserById,
  createTransaction,
  createNotification,
} from '../../lib/storage';

interface LoanManagerProps {
  formatCurrency: (amount: number) => string;
  users: User[];
  isDark?: boolean;
}

export const LoanManager: React.FC<LoanManagerProps> = ({ formatCurrency, users, isDark = true }) => {
  const [loans, setLoans] = useState<LoanApplication[]>([]);
  const [filter, setFilter] = useState<'all' | 'pending' | 'approved' | 'rejected'>('all');
  const [msg, setMsg] = useState('');

  useEffect(() => {
    loadLoans();
  }, [users]);

  const loadLoans = () => {
    const assignedIds = new Set(users.map(user => user.id));
    setLoans(getLoans().filter(loan => assignedIds.has(loan.userId)));
  };

  const handleStatusChange = (id: string, newStatus: LoanApplication['status']) => {
    const updated = updateLoanStatus(id, newStatus);
    if (updated) {
      const user = getUserById(updated.userId);
      const now = new Date();

      if (newStatus === 'approved' && user) {
        // Create deposit transaction for loan disbursement
        createTransaction({
          userId: user.id,
          type: 'credit',
          amount: updated.amount,
          narration: `Institutional Credit Disbursement — ${updated.purpose}`,
          senderInfo: 'Vestexa Underwriting Treasury',
          date: now.toISOString().split('T')[0],
          time: now.toTimeString().slice(0, 5),
          category: 'Deposit',
          status: 'completed',
        }, { skipBalanceUpdate: true });
      }

      createNotification({
        userId: updated.userId,
        title: `Credit Facility ${newStatus === 'approved' ? 'Approved & Disbursed' : 'Underwriting Decision'}`,
        message: `Your credit application for ${formatCurrency(updated.amount)} has been ${newStatus}.`,
        type: newStatus === 'approved' ? 'success' : 'warning',
      });

      setMsg(`Loan ${id} marked as ${newStatus}`);
      loadLoans();
      setTimeout(() => setMsg(''), 4000);
    }
  };

  const filtered = loans.filter(l => filter === 'all' || l.status === filter);

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h2 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
            Credit Facilities &amp; Underwriting Desk
          </h2>
          <p className={`text-xs mt-1 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
            Review corporate and private credit requests. Approving automatically disburses liquidity into user balance.
          </p>
        </div>

        <div className="flex gap-2">
          {(['all', 'pending', 'approved', 'rejected'] as const).map((tab) => (
            <button
              key={tab}
              onClick={() => setFilter(tab)}
              className={`px-4 py-1.5 rounded-full text-xs font-bold capitalize transition-all ${
                filter === tab
                  ? 'bg-vestexa-coral text-white shadow-pill'
                  : isDark
                    ? 'bg-gray-800 text-gray-400 hover:text-white'
                    : 'bg-vestexa-peach text-jeton-orange-900/60 hover:text-jeton-orange-900 border border-vestexa-peach-border'
              }`}
            >
              {tab}
            </button>
          ))}
        </div>
      </div>

      {msg && (
        <div className={`p-3.5 rounded-card-lg border text-xs flex items-center gap-2 ${
          isDark ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : 'bg-emerald-50 border-emerald-200 text-emerald-800'
        }`}>
          <span className="material-symbols-outlined text-base">check_circle</span>
          <span>{msg}</span>
        </div>
      )}

      {/* Loans Table */}
      <div className={`rounded-card-xl border overflow-hidden shadow-xl ${
        isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-vestexa-peach-border shadow-card'
      }`}>
        <div className="overflow-x-auto">
          <table className="w-full text-left text-sm">
            <thead className={`text-xs uppercase font-bold tracking-wider border-b ${
              isDark ? 'bg-gray-900/50 text-gray-400 border-gray-800' : 'bg-vestexa-peach text-jeton-orange-900/60 border-vestexa-peach-border'
            }`}>
              <tr>
                <th className="px-6 py-4">Borrower Name</th>
                <th className="px-6 py-4">Purpose</th>
                <th className="px-6 py-4">Requested Principal</th>
                <th className="px-6 py-4">Tenor</th>
                <th className="px-6 py-4">APR</th>
                <th className="px-6 py-4">Status</th>
                <th className="px-6 py-4 text-right">Actions</th>
              </tr>
            </thead>
            <tbody className={`divide-y ${isDark ? 'divide-gray-800/60 text-gray-200' : 'divide-neutral-200 text-neutral-700'}`}>
              {filtered.map((loan) => {
                const user = getUserById(loan.userId);
                return (
                  <tr key={loan.id} className={`transition-colors ${isDark ? 'hover:bg-gray-800/30' : 'hover:bg-neutral-50'}`}>
                    <td className={`px-6 py-4 font-semibold ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
                      {user?.fullName || loan.userId}
                    </td>
                    <td className={`px-6 py-4 text-xs font-medium max-w-xs truncate ${isDark ? 'text-gray-300' : 'text-neutral-700'}`}>
                      {loan.purpose}
                    </td>
                    <td className={`px-6 py-4 font-mono font-bold ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
                      {formatCurrency(loan.amount)}
                    </td>
                    <td className="px-6 py-4 text-xs font-semibold">
                      {loan.duration}
                    </td>
                    <td className="px-6 py-4 font-mono text-xs text-emerald-500 dark:text-emerald-400 font-bold">
                      {loan.interestRate || 4.8}%
                    </td>
                    <td className="px-6 py-4">
                      <span className={`px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider ${
                        loan.status === 'approved' || loan.status === 'active'
                          ? 'bg-emerald-500/10 text-emerald-500 dark:text-emerald-400 border border-emerald-500/20'
                          : loan.status === 'pending'
                            ? 'bg-amber-500/10 text-amber-500 dark:text-amber-400 border border-amber-500/20'
                            : 'bg-red-500/10 text-red-500 dark:text-red-400 border border-red-500/20'
                      }`}>
                        {loan.status}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-right">
                      {loan.status === 'pending' ? (
                        <div className="flex items-center justify-end gap-2">
                          <button
                            onClick={() => handleStatusChange(loan.id, 'approved')}
                            className="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-500 dark:text-emerald-400 hover:bg-emerald-500/30 transition-colors"
                          >
                            Approve &amp; Disburse
                          </button>
                          <button
                            onClick={() => handleStatusChange(loan.id, 'rejected')}
                            className="px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-500 dark:text-red-400 hover:bg-red-500/30 transition-colors"
                          >
                            Decline
                          </button>
                        </div>
                      ) : (
                        <span className={`text-xs italic ${isDark ? 'text-gray-500' : 'text-jeton-orange-900/40'}`}>Underwritten</span>
                      )}
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>

        {filtered.length === 0 && (
          <div className={`p-12 text-center text-xs ${isDark ? 'text-gray-500' : 'text-jeton-orange-900/40'}`}>
            No credit applications found for current filter.
          </div>
        )}
      </div>
    </div>
  );
};
