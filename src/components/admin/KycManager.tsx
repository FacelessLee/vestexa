import React, { useState, useEffect } from 'react';
import {
  User,
  getUsers,
  updateUserProfile,
  createNotification,
} from '../../lib/storage';

interface KycManagerProps {
  users: User[];
  isDark?: boolean;
}

export const KycManager: React.FC<KycManagerProps> = ({ users: assignedUsers, isDark = true }) => {
  const [users, setUsers] = useState<User[]>(assignedUsers);
  const [previewDoc, setPreviewDoc] = useState<{ url: string; title: string } | null>(null);
  const [msg, setMsg] = useState('');

  useEffect(() => {
    loadUsers();
  }, [assignedUsers]);

  const loadUsers = () => {
    const assignedIds = new Set(assignedUsers.map(user => user.id));
    setUsers(getUsers().filter(user => assignedIds.has(user.id)));
  };

  const handleUpdateKyc = (userId: string, newStatus: User['kycStatus']) => {
    const user = users.find(u => u.id === userId);
    if (!user) return;

    updateUserProfile(userId, { kycStatus: newStatus });

    createNotification({
      userId,
      title: `Identity Verification ${newStatus === 'verified' ? 'Approved' : 'Status Update'}`,
      message: newStatus === 'verified'
        ? 'Congratulations! Your Tier-3 KYC documents have been reviewed and fully verified.'
        : `Your KYC verification is currently marked as ${newStatus}.`,
      type: newStatus === 'verified' ? 'success' : 'warning',
    });

    setMsg(`Updated ${user.fullName} KYC to ${newStatus}`);
    loadUsers();
    setTimeout(() => setMsg(''), 4000);
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h2 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-[#0B0F14]'}`}>
          KYC Compliance & Document Verification
        </h2>
        <p className={`text-xs mt-1 ${isDark ? 'text-gray-400' : 'text-gray-500'}`}>
          Review government issued passports, driver's licenses, and proof of address documents.
        </p>
      </div>

      {msg && (
        <div className={`p-3.5 rounded-card-lg text-xs flex items-center gap-2 ${
          isDark
            ? 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-400'
            : 'bg-emerald-50 border border-emerald-200 text-emerald-700'
        }`}>
          <span className="material-symbols-outlined text-base">check_circle</span>
          <span>{msg}</span>
        </div>
      )}

      {/* Users KYC List */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        {users.map((u) => (
          <div
            key={u.id}
            className={`p-6 rounded-card-xl border flex flex-col justify-between transition-all ${
              isDark
                ? 'border-gray-800/80 bg-[#141824]'
                : 'border-[#FEE9E6] bg-white shadow-md'
            }`}
          >
            <div>
              <div className="flex items-start justify-between mb-4">
                <div>
                  <h3 className={`font-display font-bold text-base ${isDark ? 'text-white' : 'text-gray-900'}`}>
                    {u.fullName}
                  </h3>
                  <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-gray-500'}`}>{u.email}</p>
                  <p className="text-[11px] font-mono text-vestexa-coral mt-0.5 font-bold">
                    Acc: {u.accountNumber || u.id}
                  </p>
                </div>

                <span className={`px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider ${
                  u.kycStatus === 'verified'
                    ? isDark ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-emerald-50 text-emerald-700 border border-emerald-200'
                    : u.kycStatus === 'pending'
                      ? isDark ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : 'bg-amber-50 text-amber-700 border border-amber-200'
                      : isDark ? 'bg-gray-800 text-gray-400' : 'bg-gray-100 text-gray-600'
                }`}>
                  {u.kycStatus || 'unverified'}
                </span>
              </div>

              <div className={`grid grid-cols-2 gap-3 py-3 border-y text-xs ${
                isDark ? 'border-gray-800 text-gray-300' : 'border-[#FEE9E6] text-gray-700'
              }`}>
                <div>
                  <span className={`block text-[11px] ${isDark ? 'text-gray-500' : 'text-gray-400'}`}>Document Type</span>
                  <span className="font-semibold uppercase">{u.idType?.replace('_', ' ') || 'Government ID'}</span>
                </div>
                <div>
                  <span className={`block text-[11px] ${isDark ? 'text-gray-500' : 'text-gray-400'}`}>SSN / Tax ID</span>
                  <span className="font-mono font-bold">{u.ssn || 'Not Provided'}</span>
                </div>
                <div className="col-span-2">
                  <span className={`block text-[11px] ${isDark ? 'text-gray-500' : 'text-gray-400'}`}>Address</span>
                  <span className="truncate block font-medium">{u.address || 'Not Provided'}</span>
                </div>
              </div>

              {/* Document Thumbnails */}
              <div className="mt-4">
                <span className={`text-xs font-bold uppercase tracking-wider block mb-2 ${
                  isDark ? 'text-gray-400' : 'text-gray-500'
                }`}>
                  Uploaded Verification Media
                </span>
                <div className="grid grid-cols-2 gap-3">
                  {u.idDocumentUrl ? (
                    <button
                      type="button"
                      onClick={() => setPreviewDoc({ url: u.idDocumentUrl!, title: `${u.fullName} — ID Front` })}
                      className={`group relative rounded-card-lg overflow-hidden border h-28 w-full block ${
                        isDark ? 'border-gray-700 bg-black/30' : 'border-gray-200 bg-gray-50 shadow-sm'
                      }`}
                    >
                      <img src={u.idDocumentUrl} alt="ID Front" className="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                      <span className="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity text-xs font-bold text-white">
                        Inspect Front
                      </span>
                    </button>
                  ) : (
                    <div className={`h-28 rounded-card-lg border border-dashed flex flex-col items-center justify-center text-xs ${
                      isDark ? 'border-gray-800 text-gray-600' : 'border-gray-200 text-gray-400 bg-gray-50'
                    }`}>
                      <span className="material-symbols-outlined text-lg mb-1">badge</span>
                      Front Missing
                    </div>
                  )}

                  {u.idDocumentBackUrl ? (
                    <button
                      type="button"
                      onClick={() => setPreviewDoc({ url: u.idDocumentBackUrl!, title: `${u.fullName} — ID Back` })}
                      className={`group relative rounded-card-lg overflow-hidden border h-28 w-full block ${
                        isDark ? 'border-gray-700 bg-black/30' : 'border-gray-200 bg-gray-50 shadow-sm'
                      }`}
                    >
                      <img src={u.idDocumentBackUrl} alt="ID Back" className="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                      <span className="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity text-xs font-bold text-white">
                        Inspect Back
                      </span>
                    </button>
                  ) : (
                    <div className={`h-28 rounded-card-lg border border-dashed flex flex-col items-center justify-center text-xs ${
                      isDark ? 'border-gray-800 text-gray-600' : 'border-gray-200 text-gray-400 bg-gray-50'
                    }`}>
                      <span className="material-symbols-outlined text-lg mb-1">flip</span>
                      Back Missing
                    </div>
                  )}
                </div>
              </div>
            </div>

            {/* Actions */}
            <div className={`flex gap-2 pt-5 border-t mt-4 ${isDark ? 'border-gray-800' : 'border-[#FEE9E6]'}`}>
              <button
                onClick={() => handleUpdateKyc(u.id, 'verified')}
                className={`flex-1 py-2 rounded-full text-xs font-bold transition-all flex items-center justify-center gap-1 ${
                  isDark
                    ? 'bg-emerald-500/20 text-emerald-400 hover:bg-emerald-500/30'
                    : 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200'
                }`}
              >
                <span className="material-symbols-outlined text-sm">verified</span>
                Mark Verified
              </button>
              <button
                onClick={() => handleUpdateKyc(u.id, 'pending')}
                className={`px-4 py-2 rounded-full text-xs font-bold transition-all ${
                  isDark
                    ? 'bg-amber-500/20 text-amber-400 hover:bg-amber-500/30'
                    : 'bg-amber-100 text-amber-700 hover:bg-amber-200'
                }`}
              >
                Pending
              </button>
              <button
                onClick={() => handleUpdateKyc(u.id, 'rejected')}
                className={`px-4 py-2 rounded-full text-xs font-bold transition-all ${
                  isDark
                    ? 'bg-red-500/20 text-red-400 hover:bg-red-500/30'
                    : 'bg-red-100 text-red-700 hover:bg-red-200'
                }`}
              >
                Reject
              </button>
            </div>
          </div>
        ))}
      </div>

      {/* Document Inspector Modal */}
      {previewDoc && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
          <div className={`relative max-w-3xl w-full rounded-card-xl border p-6 shadow-2xl ${
            isDark ? 'bg-[#141824] border-gray-800 text-white' : 'bg-white border-[#FEE9E6] text-gray-900'
          }`}>
            <div className="flex items-center justify-between mb-4">
              <h3 className="font-display font-bold text-base">{previewDoc.title}</h3>
              <button
                onClick={() => setPreviewDoc(null)}
                className={`p-1 rounded-full ${isDark ? 'hover:bg-gray-800 text-gray-400' : 'hover:bg-gray-100 text-gray-600'}`}
              >
                <span className="material-symbols-outlined text-xl">close</span>
              </button>
            </div>
            <div className={`rounded-card-lg overflow-hidden max-h-[75vh] flex items-center justify-center ${
              isDark ? 'bg-black/40' : 'bg-gray-50'
            }`}>
              <img src={previewDoc.url} alt="Document" className="max-w-full max-h-[70vh] object-contain" />
            </div>
          </div>
        </div>
      )}
    </div>
  );
};
