import React, { useState, useEffect } from 'react';
import {
  WithdrawalRequest,
  User,
  getWithdrawals,
  updateWithdrawalStatus,
  getUserById,
  createNotification,
} from '../../lib/storage';

interface WithdrawalManagerProps {
  formatCurrency: (amount: number) => string;
  users: User[];
  isDark?: boolean;
}

export const WithdrawalManager: React.FC<WithdrawalManagerProps> = ({
  formatCurrency,
  users,
  isDark = true,
}) => {
  const [withdrawals, setWithdrawals] = useState<WithdrawalRequest[]>([]);
  const [filter, setFilter] = useState<'all' | 'pending' | 'approved' | 'rejected'>('all');
  const [msg, setMsg] = useState('');

  useEffect(() => {
    loadWithdrawals();
  }, [users]);

  const loadWithdrawals = () => {
    const assignedIds = new Set(users.map(user => user.id));
    setWithdrawals(getWithdrawals().filter(withdrawal => assignedIds.has(withdrawal.userId)));
  };

  const handleStatusChange = (id: string, newStatus: WithdrawalRequest['status']) => {
    const res = updateWithdrawalStatus(id, newStatus);
    if (res) {
      getUserById(res.userId);
      createNotification({
        userId: res.userId,
        title: `Withdrawal ${newStatus === 'approved' ? 'Approved' : newStatus === 'rejected' ? 'Rejected & Refunded' : 'Processed'}`,
        message: `Your withdrawal of ${formatCurrency(res.amount)} has been marked as ${newStatus}.`,
        type: newStatus === 'approved' || newStatus === 'processed' ? 'success' : 'danger',
      });

      setMsg(`Withdrawal ${id} marked as ${newStatus}`);
      loadWithdrawals();
      setTimeout(() => setMsg(''), 4000);
    }
  };

  const filtered = withdrawals.filter(w => filter === 'all' || w.status === filter);

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h2 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
            Withdrawal &amp; Settlement Queue
          </h2>
          <p className={`text-xs mt-1 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
            Authorize outbound crypto and wire payouts. Rejection triggers automatic balance restoration.
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

      {/* Withdrawals Table */}
      <div className={`rounded-card-xl border overflow-hidden shadow-xl ${
        isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-vestexa-peach-border shadow-card'
      }`}>
        <div className="overflow-x-auto">
          <table className="w-full text-left text-sm">
            <thead className={`text-xs uppercase font-bold tracking-wider border-b ${
              isDark ? 'bg-gray-900/50 text-gray-400 border-gray-800' : 'bg-vestexa-peach text-jeton-orange-900/60 border-vestexa-peach-border'
            }`}>
              <tr>
                <th className="px-6 py-4">Ref ID</th>
                <th className="px-6 py-4">Account Holder</th>
                <th className="px-6 py-4">Method &amp; Rails</th>
                <th className="px-6 py-4">Settlement Amount</th>
                <th className="px-6 py-4">Details</th>
                <th className="px-6 py-4">Status</th>
                <th className="px-6 py-4 text-right">Actions</th>
              </tr>
            </thead>
            <tbody className={`divide-y ${isDark ? 'divide-gray-800/60 text-gray-200' : 'divide-neutral-200 text-neutral-700'}`}>
              {filtered.map((w) => {
                const user = getUserById(w.userId);
                return (
                  <tr key={w.id} className={`transition-colors ${isDark ? 'hover:bg-gray-800/30' : 'hover:bg-neutral-50'}`}>
                    <td className="px-6 py-4 font-mono text-xs font-bold text-vestexa-coral">
                      {w.txnId || w.id.slice(0, 10)}
                    </td>
                    <td className={`px-6 py-4 font-semibold ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
                      {user?.fullName || w.userId}
                    </td>
                    <td className="px-6 py-4 font-semibold">
                      {w.method}
                    </td>
                    <td className={`px-6 py-4 font-mono font-bold ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
                      {formatCurrency(w.amount)}
                    </td>
                    <td className={`px-6 py-4 text-xs font-mono max-w-xs truncate ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/50'}`}>
                      {w.details || 'Standard Rail'}
                    </td>
                    <td className="px-6 py-4">
                      <span className={`px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider ${
                        w.status === 'approved' || w.status === 'processed'
                          ? 'bg-emerald-500/10 text-emerald-500 dark:text-emerald-400 border border-emerald-500/20'
                          : w.status === 'pending'
                            ? 'bg-amber-500/10 text-amber-500 dark:text-amber-400 border border-amber-500/20'
                            : 'bg-red-500/10 text-red-500 dark:text-red-400 border border-red-500/20'
                      }`}>
                        {w.status}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-right">
                      {w.status === 'pending' ? (
                        <div className="flex items-center justify-end gap-2">
                          <button
                            onClick={() => handleStatusChange(w.id, 'approved')}
                            className="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-500 dark:text-emerald-400 hover:bg-emerald-500/30 transition-colors"
                          >
                            Approve
                          </button>
                          <button
                            onClick={() => handleStatusChange(w.id, 'rejected')}
                            className="px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-500 dark:text-red-400 hover:bg-red-500/30 transition-colors"
                          >
                            Reject &amp; Refund
                          </button>
                        </div>
                      ) : (
                        <span className={`text-xs italic ${isDark ? 'text-gray-500' : 'text-jeton-orange-900/40'}`}>Settled</span>
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
            No withdrawal requests match current filter.
          </div>
        )}
      </div>
    </div>
  );
};
