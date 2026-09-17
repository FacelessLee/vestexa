import React, { useState, useEffect } from 'react';
import {
  User,
  Beneficiary,
  getBeneficiaries,
  createTransaction,
  createNotification,
  createWithdrawal,
  updateUserBalance,
  getAppSettings,
  getUserById,
  getUsers,
} from '../../lib/storage';

interface TransfersSectionProps {
  user: User;
  isDark: boolean;
  onUserUpdate: () => void;
  formatCurrency: (amount: number) => string;
}

type TransferType = 'local' | 'international' | 'p2p' | 'crypto';

export const TransfersSection: React.FC<TransfersSectionProps> = ({
  user,
  isDark,
  onUserUpdate,
  formatCurrency,
}) => {
  const [transferType, setTransferType] = useState<TransferType>('local');
  const [beneficiaries, setBeneficiaries] = useState<Beneficiary[]>([]);
  
  // Form State
  const [recipientName, setRecipientName] = useState('');
  const [bankName, setBankName] = useState('');
  const [accountNumber, setAccountNumber] = useState('');
  const [routingOrSwift, setRoutingOrSwift] = useState('');
  const [cryptoAddress, setCryptoAddress] = useState('');
  const [cryptoCoin, setCryptoCoin] = useState('BTC');
  const [amount, setAmount] = useState('');
  const [narration, setNarration] = useState('');
  const [pin, setPin] = useState('');
  
  // Status State
  const [showPinModal, setShowPinModal] = useState(false);
  const [showReceiptModal, setShowReceiptModal] = useState(false);
  const [completedTxn, setCompletedTxn] = useState<any>(null);
  const [errorMsg, setErrorMsg] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  useEffect(() => {
    setBeneficiaries(getBeneficiaries(user.id));
  }, [user.id]);

  const selectBeneficiary = (b: Beneficiary) => {
    setRecipientName(b.name);
    setBankName(b.bankName);
    setAccountNumber(b.accountNumber);
    setRoutingOrSwift(b.routingNumber || b.swiftCode || '');
    if (b.swiftCode) {
      setTransferType('international');
    } else {
      setTransferType('local');
    }
  };

  const handleInitialSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setErrorMsg('');

    const numAmount = parseFloat(amount);
    if (isNaN(numAmount) || numAmount <= 0) {
      setErrorMsg('Please enter a valid transfer amount.');
      return;
    }

    const settings = getAppSettings();
    const feeRate = (settings.commissionFee || 0) / 100;
    const fee = numAmount * feeRate;
    const totalDeduction = numAmount + fee;

    const freshUser = getUserById(user.id) || user;
    if (freshUser.balance < totalDeduction) {
      setErrorMsg(`Insufficient balance. Required: ${formatCurrency(totalDeduction)} (incl. ${settings.commissionFee}% processing fee).`);
      return;
    }

    if (transferType === 'crypto' && !cryptoAddress.trim()) {
      setErrorMsg('Please enter a valid destination cryptocurrency wallet address.');
      return;
    }

    if (transferType !== 'crypto' && (!recipientName.trim() || !accountNumber.trim())) {
      setErrorMsg('Please fill in all mandatory recipient banking details.');
      return;
    }

    // If user has a security PIN configured, request PIN
    if (freshUser.pin) {
      setShowPinModal(true);
    } else {
      executeTransfer();
    }
  };

  const executeTransfer = () => {
    setIsSubmitting(true);
    setErrorMsg('');

    const freshUser = getUserById(user.id) || user;
    if (freshUser.pin && pin !== freshUser.pin) {
      setErrorMsg('Incorrect 4-digit Security PIN. Please try again.');
      setIsSubmitting(false);
      return;
    }

    const numAmount = parseFloat(amount);
    const settings = getAppSettings();
    const feeRate = (settings.commissionFee || 0) / 100;
    const fee = numAmount * feeRate;
    const totalDeduction = numAmount + fee;

    const now = new Date();
    const today = now.toISOString().split('T')[0];
    const time = now.toTimeString().slice(0, 5);

    // 1. Process P2P transfer if applicable
    if (transferType === 'p2p') {
      const recipientUser = getUsers().find(
        u => u.email.toLowerCase() === accountNumber.trim().toLowerCase() ||
             (u.username && u.username.toLowerCase() === accountNumber.trim().toLowerCase()) ||
             (u.accountNumber && u.accountNumber.toLowerCase() === accountNumber.trim().toLowerCase())
      );

      if (recipientUser) {
        updateUserBalance(recipientUser.id, recipientUser.balance + numAmount);
        createTransaction({
          userId: recipientUser.id,
          type: 'credit',
          amount: numAmount,
          narration: `P2P Credit from ${user.fullName}: ${narration || 'Funds Transfer'}`,
          senderInfo: user.fullName,
          date: today,
          time,
          category: 'Deposit',
          status: 'completed',
        });
        createNotification({
          userId: recipientUser.id,
          title: 'Direct Transfer Received',
          message: `You received ${formatCurrency(numAmount)} from ${user.fullName}.`,
          type: 'success',
        });
      }
    }

    // 2. Process Crypto withdrawal
    if (transferType === 'crypto') {
      createWithdrawal({
        userId: user.id,
        amount: numAmount,
        method: `Crypto (${cryptoCoin})`,
        status: 'approved',
        details: `Destination: ${cryptoAddress.trim()}`,
        txnId: `TXN-${Date.now().toString().slice(-8)}`,
      });
    }

    // 3. Deduct from sender balance
    updateUserBalance(user.id, freshUser.balance - totalDeduction);

    // 4. Create Sender Transaction
    const txn = createTransaction({
      userId: user.id,
      type: 'debit',
      amount: numAmount,
      narration: transferType === 'crypto'
        ? `Crypto Withdrawal (${cryptoCoin}) to ${cryptoAddress.slice(0, 8)}...`
        : `${transferType.toUpperCase()} Transfer to ${recipientName} (${bankName || 'Vestexa P2P'})`,
      senderInfo: user.fullName,
      date: today,
      time,
      category: transferType === 'crypto' ? 'Withdrawal' : 'Wire Transfer',
      status: 'completed',
    });

    // 5. Create Notification
    createNotification({
      userId: user.id,
      title: 'Transfer Dispatched',
      message: `${formatCurrency(numAmount)} was successfully transferred to ${recipientName || cryptoCoin}.`,
      type: 'info',
    });

    setCompletedTxn({
      ...txn,
      totalDeduction,
      fee,
      recipientName: recipientName || `${cryptoCoin} Wallet`,
      accountNumber: accountNumber || cryptoAddress,
      bankName: bankName || (transferType === 'crypto' ? 'Blockchain Network' : 'Direct P2P'),
    });

    setShowPinModal(false);
    setShowReceiptModal(true);
    setIsSubmitting(false);

    // Reset Form
    setAmount('');
    setNarration('');
    setPin('');
    onUserUpdate();
  };

  return (
    <div className="space-y-8">
      {/* Header */}
      <div>
        <h1 className={`text-3xl sm:text-4xl font-display font-extrabold tracking-tight mb-2 ${
          isDark ? 'text-white' : 'text-slate-900'
        }`}>
          Domestic & Global Money Movement
        </h1>
        <p className={`text-sm ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
          Transfer funds securely across domestic RTGS, international SWIFT, direct peer-to-peer, or cold crypto rails.
        </p>
      </div>

      {/* Saved Quick Contacts / Beneficiaries */}
      {beneficiaries.length > 0 && (
        <div className={`p-6 rounded-3xl border ${
          isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
        }`}>
          <div className="flex items-center justify-between mb-4">
            <span className={`text-xs font-bold uppercase tracking-wider ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Quick Pay Saved Beneficiaries
            </span>
            <span className={`text-xs ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Click to autofill recipient
            </span>
          </div>

          <div className="flex gap-4 overflow-x-auto pb-2 scrollbar-none">
            {beneficiaries.map((b) => (
              <button
                key={b.id}
                type="button"
                onClick={() => selectBeneficiary(b)}
                className={`flex items-center gap-3 px-4 py-2.5 rounded-2xl border transition-all shrink-0 ${
                  accountNumber === b.accountNumber
                    ? 'border-vestexa-coral bg-vestexa-coral/10 text-vestexa-coral'
                    : isDark
                      ? 'border-gray-800 bg-[#0D1117] hover:border-gray-700 text-gray-200'
                      : 'border-slate-200 bg-slate-50 hover:border-slate-300 text-slate-700'
                }`}
              >
                <div className="w-8 h-8 rounded-full bg-vestexa-coral text-white font-bold text-xs flex items-center justify-center">
                  {b.name.split(' ').map(n => n[0]).join('').slice(0, 2)}
                </div>
                <div className="text-left">
                  <p className="text-xs font-bold leading-none mb-1">{b.name}</p>
                  <p className="text-[10px] text-gray-400 leading-none">{b.bankName}</p>
                </div>
              </button>
            ))}
          </div>
        </div>
      )}

      {/* Main Transfer Layout */}
      <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {/* Form (Span 8) */}
        <div className="lg:col-span-8">
          <div className={`p-6 sm:p-8 rounded-3xl border ${
            isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
          }`}>
            {/* Transfer Type Tabs */}
            <div className={`grid grid-cols-2 sm:grid-cols-4 gap-2 mb-8 p-1.5 rounded-2xl border ${
              isDark ? 'bg-gray-900/40 border-white/10' : 'bg-neutral-100 border-neutral-200'
            }`}>
              <button
                type="button"
                onClick={() => setTransferType('local')}
                className={`py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 ${
                  transferType === 'local'
                    ? 'bg-vestexa-coral text-white shadow-pill'
                    : isDark ? 'text-gray-400 hover:text-white' : 'text-neutral-600 hover:text-neutral-900'
                }`}
              >
                <span className="material-symbols-outlined text-sm">account_balance</span>
                Domestic Wire
              </button>

              <button
                type="button"
                onClick={() => setTransferType('international')}
                className={`py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 ${
                  transferType === 'international'
                    ? 'bg-vestexa-coral text-white shadow-pill'
                    : isDark ? 'text-gray-400 hover:text-white' : 'text-slate-600 hover:text-slate-900'
                }`}
              >
                <span className="material-symbols-outlined text-sm">public</span>
                SWIFT Global
              </button>

              <button
                type="button"
                onClick={() => setTransferType('p2p')}
                className={`py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 ${
                  transferType === 'p2p'
                    ? 'bg-vestexa-coral text-white shadow-pill'
                    : isDark ? 'text-gray-400 hover:text-white' : 'text-slate-600 hover:text-slate-900'
                }`}
              >
                <span className="material-symbols-outlined text-sm">swap_horiz</span>
                Vestexa P2P
              </button>

              <button
                type="button"
                onClick={() => setTransferType('crypto')}
                className={`py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 ${
                  transferType === 'crypto'
                    ? 'bg-vestexa-coral text-white shadow-pill'
                    : isDark ? 'text-gray-400 hover:text-white' : 'text-slate-600 hover:text-slate-900'
                }`}
              >
                <span className="material-symbols-outlined text-sm">currency_bitcoin</span>
                Crypto Rail
              </button>
            </div>

            {errorMsg && (
              <div className="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs flex items-center gap-2">
                <span className="material-symbols-outlined text-base">error</span>
                <span>{errorMsg}</span>
              </div>
            )}

            <form onSubmit={handleInitialSubmit} className="space-y-6">
              {/* Crypto Form Fields */}
              {transferType === 'crypto' ? (
                <>
                  <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                        Select Asset
                      </label>
                      <select
                        value={cryptoCoin}
                        onChange={(e) => setCryptoCoin(e.target.value)}
                        className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                          isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                        }`}
                      >
                        <option value="BTC">Bitcoin (BTC)</option>
                        <option value="ETH">Ethereum (ETH / ERC20)</option>
                        <option value="USDT">Tether USD (USDT / TRC20)</option>
                      </select>
                    </div>

                    <div className="sm:col-span-2">
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                        Destination Wallet Address
                      </label>
                      <input
                        type="text"
                        value={cryptoAddress}
                        onChange={(e) => setCryptoAddress(e.target.value)}
                        placeholder="Enter recipient wallet address"
                        className={`w-full rounded-2xl px-4 py-3 text-sm font-mono border transition-all focus:outline-none ${
                          isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                        }`}
                      />
                    </div>
                  </div>
                </>
              ) : transferType === 'p2p' ? (
                /* P2P Fields */
                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                    Recipient Vestexa ID / Email / Username
                  </label>
                  <input
                    type="text"
                    value={accountNumber}
                    onChange={(e) => {
                      setAccountNumber(e.target.value);
                      setRecipientName(e.target.value);
                    }}
                    placeholder="e.g. billogden or stonebridge@vestexa.org"
                    className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                      isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                    }`}
                  />
                  <p className={`text-[11px] mt-1.5 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                    Instant internal settlement with zero network delay.
                  </p>
                </div>
              ) : (
                /* Domestic & International Banking Fields */
                <div className="space-y-4">
                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                        Beneficiary Full Name
                      </label>
                      <input
                        type="text"
                        value={recipientName}
                        onChange={(e) => setRecipientName(e.target.value)}
                        placeholder="Legal account holder name"
                        className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                          isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                        }`}
                      />
                    </div>

                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                        Receiving Bank Name
                      </label>
                      <input
                        type="text"
                        value={bankName}
                        onChange={(e) => setBankName(e.target.value)}
                        placeholder="e.g. JPMorgan Chase, Barclays"
                        className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                          isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                        }`}
                      />
                    </div>
                  </div>

                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                        {transferType === 'international' ? 'IBAN / Account Number' : 'Account Number'}
                      </label>
                      <input
                        type="text"
                        value={accountNumber}
                        onChange={(e) => setAccountNumber(e.target.value)}
                        placeholder="Account or IBAN digits"
                        className={`w-full rounded-2xl px-4 py-3 text-sm font-mono border transition-all focus:outline-none ${
                          isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                        }`}
                      />
                    </div>

                    <div>
                      <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                        {transferType === 'international' ? 'SWIFT / BIC Code' : 'Routing Number (ABA)'}
                      </label>
                      <input
                        type="text"
                        value={routingOrSwift}
                        onChange={(e) => setRoutingOrSwift(e.target.value)}
                        placeholder={transferType === 'international' ? 'e.g. CHASUS33' : '9-digit routing code'}
                        className={`w-full rounded-2xl px-4 py-3 text-sm font-mono border transition-all focus:outline-none ${
                          isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                        }`}
                      />
                    </div>
                  </div>
                </div>
              )}

              {/* Amount & Memo */}
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                  <div className="flex justify-between text-xs font-bold uppercase mb-2">
                    <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>Amount</span>
                    <span className={isDark ? 'text-gray-400' : 'text-slate-500'}>
                      Balance: <span className="text-vestexa-coral">{formatCurrency(user.balance)}</span>
                    </span>
                  </div>
                  <div className="relative">
                    <span className="absolute left-4 top-3.5 text-gray-400 font-bold">$</span>
                    <input
                      type="number"
                      step="any"
                      value={amount}
                      onChange={(e) => setAmount(e.target.value)}
                      placeholder="0.00"
                      className={`w-full rounded-2xl pl-8 pr-16 py-3 text-sm font-bold border transition-all focus:outline-none ${
                        isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                      }`}
                    />
                    <button
                      type="button"
                      onClick={() => setAmount(user.balance.toString())}
                      className="absolute right-3 top-2.5 px-2.5 py-1 rounded-xl text-xs font-bold bg-vestexa-coral/20 text-vestexa-coral hover:bg-vestexa-coral/30"
                    >
                      MAX
                    </button>
                  </div>
                </div>

                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
                    Payment Narration / Reference
                  </label>
                  <input
                    type="text"
                    value={narration}
                    onChange={(e) => setNarration(e.target.value)}
                    placeholder="e.g. Invoice settlement, Consulting"
                    className={`w-full rounded-2xl px-4 py-3 text-sm font-bold border transition-all focus:outline-none ${
                      isDark ? 'bg-[#0D1117] border-gray-800 text-white' : 'bg-slate-50 border-slate-200 text-slate-900'
                    }`}
                  />
                </div>
              </div>

              {/* Submit CTA */}
              <div className="pt-4">
                <button
                  type="submit"
                  className="w-full py-4 rounded-full text-white font-display text-sm font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all duration-200 flex items-center justify-center gap-2 transform hover:-translate-y-0.5"
                >
                  <span className="material-symbols-outlined text-lg">send</span>
                  Authorize & Dispatch Transfer
                </button>
              </div>
            </form>
          </div>
        </div>

        {/* Right Summary Info (Span 4) */}
        <div className="lg:col-span-4 space-y-6">
          <div className={`p-6 rounded-3xl border ${
            isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200 shadow-sm'
          }`}>
            <h3 className={`text-base font-display font-bold mb-4 ${isDark ? 'text-white' : 'text-slate-900'}`}>
              Security & Rail Guarantees
            </h3>
            <div className={`space-y-4 text-xs ${isDark ? 'text-gray-300' : 'text-slate-600'}`}>
              <div className="flex gap-3">
                <span className="material-symbols-outlined text-vestexa-coral text-lg shrink-0">verified_user</span>
                <div>
                  <p className="font-bold">Encrypted End-to-End</p>
                  <p className="text-gray-400 mt-0.5">TLS 1.3 banking tunnel with mandatory 4-digit PIN verification.</p>
                </div>
              </div>
              <div className="flex gap-3">
                <span className="material-symbols-outlined text-emerald-400 text-lg shrink-0">speed</span>
                <div>
                  <p className="font-bold">Instant P2P Rail</p>
                  <p className="text-gray-400 mt-0.5">Zero fees and zero settlement delay between registered Vestexa accounts.</p>
                </div>
              </div>
              <div className="flex gap-3">
                <span className="material-symbols-outlined text-blue-400 text-lg shrink-0">account_balance</span>
                <div>
                  <p className="font-bold">FDIC Equivalent Protection</p>
                  <p className="text-gray-400 mt-0.5">All wire transfers pass through tier-1 custodian clearing institutions.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Security PIN Modal */}
      {showPinModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
          <div className={`w-full max-w-md rounded-3xl border p-6 sm:p-8 text-center relative ${
            isDark ? 'bg-[#161B22] border-gray-800 text-white' : 'bg-white border-slate-200 text-slate-900'
          }`}>
            <div className="w-14 h-14 rounded-full bg-vestexa-coral/10 text-vestexa-coral mx-auto flex items-center justify-center mb-4">
              <span className="material-symbols-outlined text-3xl">lock</span>
            </div>

            <h3 className="text-xl font-display font-bold mb-1">
              Enter Security PIN
            </h3>
            <p className={`text-xs mb-6 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              Confirm authorization for {formatCurrency(parseFloat(amount) || 0)}
            </p>

            {errorMsg && (
              <div className="mb-4 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs">
                {errorMsg}
              </div>
            )}

            <input
              type="password"
              maxLength={6}
              autoFocus
              value={pin}
              onChange={(e) => setPin(e.target.value)}
              placeholder="••••"
              className={`w-36 text-center text-2xl tracking-[0.5em] py-3 rounded-2xl border font-mono mx-auto mb-6 focus:outline-none ${
                isDark ? 'bg-[#0D1117] border-gray-800 text-white focus:border-vestexa-coral' : 'bg-slate-50 border-slate-200 text-slate-900 focus:border-vestexa-coral'
              }`}
            />

            <div className="flex gap-3">
              <button
                type="button"
                onClick={() => { setShowPinModal(false); setPin(''); }}
                className={`flex-1 py-3 rounded-full text-xs font-bold ${
                  isDark ? 'bg-gray-800 text-gray-300' : 'bg-slate-100 text-slate-700'
                }`}
              >
                Cancel
              </button>
              <button
                type="button"
                disabled={isSubmitting || !pin}
                onClick={executeTransfer}
                className="flex-1 py-3 rounded-full text-xs font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover text-white shadow-pill"
              >
                {isSubmitting ? 'Verifying...' : 'Confirm Dispatch'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Transaction Receipt Modal */}
      {showReceiptModal && completedTxn && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
          <div className={`w-full max-w-lg rounded-3xl border p-6 sm:p-8 shadow-2xl relative ${
            isDark ? 'bg-[#161B22] border-gray-800 text-white' : 'bg-white border-slate-200 text-slate-900'
          }`}>
            <div className="text-center mb-6">
              <div className="w-16 h-16 rounded-full bg-emerald-500/10 text-emerald-400 mx-auto flex items-center justify-center mb-3">
                <span className="material-symbols-outlined text-4xl">check</span>
              </div>
              <h3 className="text-2xl font-display font-extrabold">
                Transfer Authorized & Dispatched
              </h3>
              <p className="text-xs text-gray-400 mt-1">
                Ref ID: <span className="font-mono text-vestexa-coral">{completedTxn.id}</span>
              </p>
            </div>

            <div className={`p-5 rounded-2xl border text-xs space-y-3.5 mb-6 ${
              isDark ? 'bg-[#0D1117] border-gray-800 text-gray-300' : 'bg-slate-50 border-slate-200 text-slate-700'
            }`}>
              <div className="flex justify-between">
                <span className="text-gray-400">Transfer Amount</span>
                <span className="font-mono font-bold text-sm">{formatCurrency(completedTxn.amount)}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-400">Processing Fee</span>
                <span className="font-mono font-bold text-emerald-500">{formatCurrency(completedTxn.fee)}</span>
              </div>
              <div className="flex justify-between border-t border-inherit pt-3">
                <span className="font-bold">Total Debited</span>
                <span className="font-mono font-extrabold text-sm text-vestexa-coral">{formatCurrency(completedTxn.totalDeduction)}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-400">Recipient</span>
                <span className="font-bold">{completedTxn.recipientName}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-400">Destination</span>
                <span className="font-mono">{completedTxn.accountNumber}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-400">Timestamp</span>
                <span>{completedTxn.date} at {completedTxn.time}</span>
              </div>
            </div>

            <button
              onClick={() => setShowReceiptModal(false)}
              className="w-full py-3.5 rounded-full text-white font-display text-xs font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all"
            >
              Done & Return
            </button>
          </div>
        </div>
      )}
    </div>
  );
};
