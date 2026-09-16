import React, { useState, useEffect } from 'react';
import {
  User,
  Beneficiary,
  getBeneficiaries,
  createBeneficiary,
  deleteBeneficiary,
  toggleBeneficiaryFavorite,
} from '../../lib/storage';

interface BeneficiariesSectionProps {
  user: User;
  isDark: boolean;
  onNavigateToTransfers: () => void;
}

export const BeneficiariesSection: React.FC<BeneficiariesSectionProps> = ({
  user,
  isDark,
  onNavigateToTransfers,
}) => {
  const [beneficiaries, setBeneficiaries] = useState<Beneficiary[]>([]);
  const [searchQuery, setSearchQuery] = useState('');
  const [isAddModalOpen, setIsAddModalOpen] = useState(false);
  
  // New Beneficiary Form State
  const [name, setName] = useState('');
  const [bankName, setBankName] = useState('');
  const [accountNumber, setAccountNumber] = useState('');
  const [routingNumber, setRoutingNumber] = useState('');
  const [swiftCode, setSwiftCode] = useState('');
  const [isFavorite, setIsFavorite] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [successMsg, setSuccessMsg] = useState('');

  useEffect(() => {
    loadBeneficiaries();
  }, [user.id]);

  const loadBeneficiaries = () => {
    setBeneficiaries(getBeneficiaries(user.id));
  };

  const handleToggleFavorite = (id: string) => {
    toggleBeneficiaryFavorite(id);
    loadBeneficiaries();
  };

  const handleDelete = (id: string, recipientName: string) => {
    if (window.confirm(`Are you sure you want to remove ${recipientName} from your saved beneficiaries?`)) {
      deleteBeneficiary(id);
      loadBeneficiaries();
      setSuccessMsg(`Beneficiary ${recipientName} removed.`);
      setTimeout(() => setSuccessMsg(''), 4000);
    }
  };

  const handleAddBeneficiary = (e: React.FormEvent) => {
    e.preventDefault();
    setErrorMsg('');

    if (!name.trim() || !bankName.trim() || !accountNumber.trim()) {
      setErrorMsg('Please fill in legal recipient name, bank name, and account number.');
      return;
    }

    createBeneficiary({
      userId: user.id,
      name: name.trim(),
      bankName: bankName.trim(),
      accountNumber: accountNumber.trim(),
      routingNumber: routingNumber.trim() || undefined,
      swiftCode: swiftCode.trim() || undefined,
      isFavorite,
    });

    setSuccessMsg(`Beneficiary ${name} added to your address book.`);
    setIsAddModalOpen(false);
    setName('');
    setBankName('');
    setAccountNumber('');
    setRoutingNumber('');
    setSwiftCode('');
    setIsFavorite(false);
    loadBeneficiaries();

    setTimeout(() => setSuccessMsg(''), 4000);
  };

  const filtered = beneficiaries.filter(b =>
    b.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
    b.bankName.toLowerCase().includes(searchQuery.toLowerCase()) ||
    b.accountNumber.includes(searchQuery)
  );

  return (
    <div className="space-y-8">
      {/* Header */}
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h1 className={`text-3xl sm:text-4xl font-display font-extrabold tracking-tight mb-2 ${
            isDark ? 'text-white' : 'text-slate-900'
          }`}>
            Saved Beneficiaries & Payees
          </h1>
          <p className={`text-sm ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
            Manage verified destination accounts for fast recurring wire transfers and settlements.
          </p>
        </div>

        <button
          onClick={() => setIsAddModalOpen(true)}
          className="px-6 py-3 rounded-full font-display text-xs font-bold text-white bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all duration-200 flex items-center gap-2 self-start sm:self-auto"
        >
          <span className="material-symbols-outlined text-base">person_add</span>
          Add New Beneficiary
        </button>
      </div>

      {successMsg && (
        <div className="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm flex items-center gap-3">
          <span className="material-symbols-outlined text-lg">check_circle</span>
          <span>{successMsg}</span>
        </div>
      )}

      {/* Search Input */}
      <div className="relative max-w-md">
        <span className="material-symbols-outlined absolute left-4 top-3.5 text-gray-400">search</span>
        <input
          type="text"
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
          placeholder="Search by payee name, bank, or account..."
          className={`w-full rounded-2xl pl-11 pr-4 py-3 text-sm border transition-all focus:outline-none ${
            isDark
              ? 'bg-[#161B22] border-gray-800 text-white focus:border-vestexa-coral'
              : 'bg-white border-slate-200 text-slate-900 focus:border-vestexa-coral'
          }`}
        />
      </div>

      {/* Grid of Beneficiaries */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {filtered.map((b) => (
          <div
            key={b.id}
            className={`p-6 rounded-3xl border transition-all relative flex flex-col justify-between ${
              isDark ? 'bg-[#161B22] border-gray-800/80 hover:border-gray-700' : 'bg-white border-slate-200 shadow-sm'
            }`}
          >
            <div>
              <div className="flex items-start justify-between mb-4">
                <div className="flex items-center gap-3">
                  <div className="w-12 h-12 rounded-2xl bg-vestexa-coral text-white font-display text-base font-bold flex items-center justify-center shadow-pill">
                    {b.name.split(' ').map(n => n[0]).join('').slice(0, 2)}
                  </div>
                  <div>
                    <h3 className={`font-display font-bold text-base ${isDark ? 'text-white' : 'text-slate-900'}`}>
                      {b.name}
                    </h3>
                    <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                      {b.bankName}
                    </p>
                  </div>
                </div>

                <button
                  onClick={() => handleToggleFavorite(b.id)}
                  title={b.isFavorite ? 'Starred Favorite' : 'Mark as Favorite'}
                  className={`p-1.5 rounded-full transition-colors ${
                    b.isFavorite ? 'text-amber-400' : 'text-gray-500 hover:text-amber-400'
                  }`}
                >
                  <span className="material-symbols-outlined text-xl" style={b.isFavorite ? { fontVariationSettings: "'FILL' 1" } : undefined}>
                    star
                  </span>
                </button>
              </div>

              <div className={`space-y-2 py-3 border-t text-xs ${isDark ? 'border-gray-800 text-gray-300' : 'border-slate-100 text-slate-600'}`}>
                <div className="flex justify-between">
                  <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>Account / IBAN</span>
                  <span className="font-mono font-bold">{b.accountNumber}</span>
                </div>
                {b.routingNumber && (
                  <div className="flex justify-between">
                    <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>Routing #</span>
                    <span className="font-mono">{b.routingNumber}</span>
                  </div>
                )}
                {b.swiftCode && (
                  <div className="flex justify-between">
                    <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>SWIFT / BIC</span>
                    <span className="font-mono">{b.swiftCode}</span>
                  </div>
                )}
              </div>
            </div>

            <div className="flex gap-2 pt-4 border-t border-inherit mt-4">
              <button
                onClick={onNavigateToTransfers}
                className="flex-1 py-2 rounded-full text-xs font-bold text-white bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all flex items-center justify-center gap-1.5"
              >
                <span className="material-symbols-outlined text-sm">send</span>
                Send Money
              </button>
              <button
                onClick={() => handleDelete(b.id, b.name)}
                className={`p-2 rounded-full transition-colors ${
                  isDark ? 'hover:bg-red-500/10 text-gray-500 hover:text-red-400' : 'hover:bg-red-50 text-slate-400 hover:text-red-600'
                }`}
              >
                <span className="material-symbols-outlined text-base">delete</span>
              </button>
            </div>
          </div>
        ))}
      </div>

      {filtered.length === 0 && (
        <div className={`p-12 text-center rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200'
        }`}>
          <span className="material-symbols-outlined text-5xl text-gray-500 mb-3">group_off</span>
          <h3 className={`text-base font-display font-bold ${isDark ? 'text-white' : 'text-slate-900'}`}>
            No Beneficiaries Found
          </h3>
          <p className={`text-xs mt-1 max-w-sm mx-auto ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
            Save your frequent transfer recipients to authorize rapid settlements anytime.
          </p>
        </div>
      )}

      {/* Add Beneficiary Modal */}
      {isAddModalOpen && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
          <div className={`w-full max-w-lg rounded-3xl border p-6 sm:p-8 shadow-2xl relative ${
            isDark ? 'bg-[#161B22] border-gray-800 text-white' : 'bg-white border-slate-200 text-slate-900'
          }`}>
            <button
              onClick={() => setIsAddModalOpen(false)}
              className={`absolute top-6 right-6 p-1.5 rounded-full ${
                isDark ? 'hover:bg-gray-800 text-gray-400' : 'hover:bg-slate-100 text-slate-500'
              }`}
            >
              <span className="material-symbols-outlined text-lg">close</span>
            </button>

            <div className="flex items-center gap-3 mb-6">
              <div className="w-12 h-12 rounded-2xl bg-vestexa-coral/10 text-vestexa-coral flex items-center justify-center font-bold">
                <span className="material-symbols-outlined text-2xl">person_add</span>
              </div>
              <div>
                <h3 className="text-xl font-display font-bold">
                  Save New Beneficiary
                </h3>
                <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Store recipient routing info for 1-click settlements
                </p>
              </div>
            </div>

            {errorMsg && (
              <div className="mb-4 p-3.5 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs flex items-center gap-2">
                <span className="material-symbols-outlined text-base">error</span>
                <span>{errorMsg}</span>
              </div>
            )}

            <form onSubmit={handleAddBeneficiary} className="space-y-4">
              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Payee Full Legal Name
                </label>
                <input
                  type="text"
                  value={name}
                  onChange={(e) => setName(e.target.value)}
                  placeholder="Account holder name"
                  className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                    isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                  }`}
                />
              </div>

              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                  Bank Name
                </label>
                <input
                  type="text"
                  value={bankName}
                  onChange={(e) => setBankName(e.target.value)}
                  placeholder="e.g. JPMorgan Chase Bank"
                  className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                    isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                  }`}
                />
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                    Account / IBAN Number
                  </label>
                  <input
                    type="text"
                    value={accountNumber}
                    onChange={(e) => setAccountNumber(e.target.value)}
                    placeholder="Account digits"
                    className={`w-full rounded-2xl px-4 py-3 text-sm font-mono border transition-all focus:outline-none ${
                      isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                    }`}
                  />
                </div>

                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                    Routing / SWIFT Code
                  </label>
                  <input
                    type="text"
                    value={routingNumber}
                    onChange={(e) => setRoutingNumber(e.target.value)}
                    placeholder="Routing or SWIFT"
                    className={`w-full rounded-2xl px-4 py-3 text-sm font-mono border transition-all focus:outline-none ${
                      isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                    }`}
                  />
                </div>
              </div>

              <div className="flex items-center gap-2 pt-2">
                <input
                  type="checkbox"
                  id="favCheck"
                  checked={isFavorite}
                  onChange={(e) => setIsFavorite(e.target.checked)}
                  className="rounded text-vestexa-coral focus:ring-vestexa-coral"
                />
                <label htmlFor="favCheck" className={`text-xs font-semibold cursor-pointer ${isDark ? 'text-gray-300' : 'text-slate-700'}`}>
                  Pin to Quick Pay Favorites
                </label>
              </div>

              <div className="flex gap-3 pt-4">
                <button
                  type="button"
                  onClick={() => setIsAddModalOpen(false)}
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
                  Save Payee
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};
