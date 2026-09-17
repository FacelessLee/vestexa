import React, { useState, useEffect } from 'react';
import { useNavigate, Link, useSearchParams } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { createUser, getUserByEmail } from '../lib/storage';
import { processSignupBonus } from '../lib/referralEngine';
import { SvgWordmark } from '../components/SvgWordmark';
import { CoinDrop } from '../components/CoinDrop';

export const UserSignup: React.FC = () => {
  const [searchParams] = useSearchParams();
  const [fullName, setFullName] = useState('');
  const [username, setUsername] = useState('');
  const [email, setEmail] = useState('');
  const [country, setCountry] = useState('United States');
  const [accountType, setAccountType] = useState('Private Wealth Tier 1');
  const [pin, setPin] = useState('');
  const [showPin, setShowPin] = useState(false);
  const [referralCode, setReferralCode] = useState(searchParams.get('ref') || '');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [agreeTerms, setAgreeTerms] = useState(true);
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();
  const { loginUser } = useAuth();

  useEffect(() => {
    const refParam = searchParams.get('ref');
    if (refParam) {
      setReferralCode(refParam);
    }
  }, [searchParams]);

  const isPasswordValid = password.length >= 6;
  const isMatch = password.length > 0 && password === confirmPassword;

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError('');

    if (!agreeTerms) {
      setError('Please agree to the Terms of Service and Disclosures.');
      return;
    }

    if (!pin.trim()) {
      setError('Please choose a mandatory 4-digit Security PIN for authentication.');
      return;
    }

    if (!/^\d{4}$/.test(pin.trim())) {
      setError('Security PIN must be exactly 4 numeric digits (0-9).');
      return;
    }

    if (password !== confirmPassword) {
      setError('Passwords do not match. Please verify your entries.');
      return;
    }

    if (password.length < 6) {
      setError('Password must be at least 6 characters long.');
      return;
    }

    if (getUserByEmail(email.trim())) {
      setError('An account with this email address already exists. Please sign in instead.');
      return;
    }

    setLoading(true);

    setTimeout(() => {
      const generatedAcc = `VX-${Math.floor(10000000 + Math.random() * 90000000)}`;
      const newUser = createUser({
        email: email.trim(),
        password,
        fullName: fullName.trim(),
        username: username.trim() || email.split('@')[0],
        country,
        accountType,
        currency: 'USD',
        pin: pin.trim(),
        accountNumber: generatedAcc,
        status: 'active',
        kycStatus: 'unverified',
        referredBy: referralCode.trim() || undefined,
        balance: 0,
        investedAmount: 0,
        amountSpent: 0,
        cardLast4: Math.floor(1000 + Math.random() * 9000).toString(),
        cardExp: '12/28',
      });

      // Grant instant welcome bonus if applicable
      processSignupBonus(newUser.id);

      const user = loginUser(email.trim(), password);
      if (user) {
        // faceless-fintech workflow: navigate to PIN verification screen
        navigate('/pin');
      }
      setLoading(false);
    }, 600);
  };

  return (
    <div
      className="min-h-screen relative flex flex-col justify-between text-jeton-orange-900 font-sans selection:bg-[#A21906] selection:text-white overflow-x-hidden"
      style={{
        background: 'linear-gradient(135deg, #FDF0EE 0%, #F8CDCB 45%, #FDE4DD 100%)',
      }}
    >
      {/* Ambient background glows */}
      <div className="absolute top-[-10%] right-[-5%] w-[45vw] h-[45vw] rounded-full bg-[#F73B20]/10 blur-[130px] pointer-events-none" />
      <div className="absolute bottom-[-15%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-[#FA8270]/15 blur-[150px] pointer-events-none" />
      <div className="absolute top-[35%] left-[20%] w-[30vw] h-[30vw] rounded-full bg-white/40 blur-[100px] pointer-events-none" />

      {/* Top Navigation Bar */}
      <header className="relative z-20 w-full px-6 sm:px-12 pt-6 pb-4 flex items-center justify-between">
        <Link
          to="/"
          aria-label="Return to homepage"
          title="Return to homepage"
          className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/70 hover:bg-white text-jeton-orange-900 hover:text-jeton-orange transition-all shadow-sm backdrop-blur-md border border-white/60 active:scale-95"
        >
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
            <line x1="19" y1="12" x2="5" y2="12" />
            <polyline points="12 19 5 12 12 5" />
          </svg>
        </Link>

        <div className="flex items-center gap-3">
          <span className="text-xs font-medium text-jeton-orange-900/70 hidden sm:inline">
            Already registered?
          </span>
          <Link
            to="/login"
            className="inline-flex items-center justify-center h-9 px-4 rounded-full bg-white text-jeton-orange hover:bg-white/90 transition-all text-xs font-bold shadow-sm active:scale-95 border border-jeton-orange/20"
          >
            Sign In
          </Link>
        </div>
      </header>

      {/* Main Container: Responsive Split Showcase */}
      <main className="relative z-10 flex-1 max-w-7xl w-full mx-auto px-4 sm:px-8 py-4 sm:py-8 flex items-center">
        <div className="w-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
          
          {/* ═══ LEFT COLUMN: Onboarding Value Proposition ═══ */}
          <div className="lg:col-span-6 xl:col-span-7 flex flex-col items-start text-left space-y-6">
            <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/70 backdrop-blur-md border border-white/70 shadow-sm">
              <CoinDrop tone="orange" />
              <span className="text-[11px] uppercase tracking-wider font-extrabold text-jeton-orange">
                Instant Account Provisioning
              </span>
            </div>

            <div>
              <Link to="/" className="inline-block mb-3">
                <SvgWordmark tone="orange" brand="vestexa" />
              </Link>
              <h1 className="text-3xl sm:text-5xl lg:text-6xl font-display font-extrabold text-jeton-orange-900 leading-[1.05] tracking-tight">
                Step Into<br />
                <span className="text-jeton-orange">Sovereign Wealth.</span>
              </h1>
              <p className="mt-4 text-sm sm:text-base text-jeton-orange-900/75 max-w-xl font-medium leading-relaxed">
                Join an elite tier of private and institutional investors. Create your multi-currency
                account in less than 2 minutes and unlock institutional yields and liquidity.
              </p>
            </div>

            {/* 3 VIP Highlights */}
            <div className="space-y-3 w-full max-w-lg">
              <div className="p-4 rounded-2xl bg-white/75 backdrop-blur-md border border-white/70 shadow-sm flex items-start gap-4 transition-transform hover:-translate-y-0.5">
                <div className="w-10 h-10 rounded-xl bg-jeton-orange/10 text-jeton-orange flex items-center justify-center shrink-0 font-bold">
                  <span className="material-symbols-outlined text-[20px]">account_balance_wallet</span>
                </div>
                <div>
                  <h2 className="text-sm font-bold text-jeton-orange-900">Multi-Currency Global Vault</h2>
                  <p className="text-xs text-jeton-orange-900/70 mt-0.5 font-medium">
                    Instant IBANs in USD, EUR, GBP with 0% foreign transaction fees and real-time wire capability.
                  </p>
                </div>
              </div>

              <div className="p-4 rounded-2xl bg-white/75 backdrop-blur-md border border-white/70 shadow-sm flex items-start gap-4 transition-transform hover:-translate-y-0.5">
                <div className="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center shrink-0 font-bold">
                  <span className="material-symbols-outlined text-[20px]">trending_up</span>
                </div>
                <div>
                  <h2 className="text-sm font-bold text-jeton-orange-900">Automated 5.80% APY Yield Sweep</h2>
                  <p className="text-xs text-jeton-orange-900/70 mt-0.5 font-medium">
                    Idle balances generate weekly compounded yield backed by short-term US Treasury obligations.
                  </p>
                </div>
              </div>

              <div className="p-4 rounded-2xl bg-white/75 backdrop-blur-md border border-white/70 shadow-sm flex items-start gap-4 transition-transform hover:-translate-y-0.5">
                <div className="w-10 h-10 rounded-xl bg-jeton-blue/10 text-jeton-blue flex items-center justify-center shrink-0 font-bold">
                  <span className="material-symbols-outlined text-[20px]">credit_card</span>
                </div>
                <div>
                  <h2 className="text-sm font-bold text-jeton-orange-900">Physical Obsidian Titanium Card</h2>
                  <p className="text-xs text-jeton-orange-900/70 mt-0.5 font-medium">
                    Complimentary custom metal card dispatched upon account activation with worldwide concierge access.
                  </p>
                </div>
              </div>
            </div>

            {/* Regulatory Trust Badge */}
            <div className="pt-2 flex items-center gap-2 text-xs font-semibold text-jeton-orange-900/80">
              <span className="w-2 h-2 rounded-full bg-emerald-500" />
              <span>Custody segregated at Tier-1 Partner Banks • 256-bit Swiss Banking Encryption</span>
            </div>
          </div>

          {/* ═══ RIGHT COLUMN: The Account Creation Glass Suite ═══ */}
          <div className="lg:col-span-6 xl:col-span-5 w-full">
            <div className="bg-white/90 backdrop-blur-2xl border border-white/80 rounded-[32px] p-7 sm:p-9 shadow-[0_25px_60px_-15px_rgba(54,8,2,0.14)] relative">
              
              <div className="mb-6">
                <h2 className="text-2xl sm:text-3xl font-display font-extrabold text-jeton-orange-900 tracking-tight">
                  Open Private Account
                </h2>
                <p className="text-sm font-medium text-jeton-orange-900/70 mt-1">
                  Start your institutional wealth management journey.
                </p>
              </div>

              {/* Error Message */}
              {error && (
                <div className="mb-5 bg-red-500/10 border border-red-500/20 text-red-700 text-xs sm:text-sm px-4 py-3 rounded-2xl flex items-start gap-2">
                  <span className="material-symbols-outlined text-base shrink-0 mt-0.5">error</span>
                  <span>{error}</span>
                </div>
              )}

              {/* Signup Form */}
              <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                  <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider mb-1.5">
                    Legal Full Name
                  </label>
                  <div className="relative">
                    <span className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                      </svg>
                    </span>
                    <input
                      type="text"
                      value={fullName}
                      onChange={(e) => setFullName(e.target.value)}
                      required
                      placeholder="e.g. Victoria Thorne"
                      className="w-full bg-white/80 text-jeton-orange-900 text-sm font-medium rounded-2xl pl-11 pr-4 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:ring-4 focus:ring-jeton-orange/10 focus:outline-none transition-all placeholder:text-gray-400 shadow-sm"
                    />
                  </div>
                </div>

                <div>
                  <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider mb-1.5">
                    Email Address
                  </label>
                  <div className="relative">
                    <span className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                      </svg>
                    </span>
                    <input
                      type="email"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      required
                      placeholder="v.thorne@domain.com"
                      className="w-full bg-white/80 text-jeton-orange-900 text-sm font-medium rounded-2xl pl-11 pr-4 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:ring-4 focus:ring-jeton-orange/10 focus:outline-none transition-all placeholder:text-gray-400 shadow-sm"
                    />
                  </div>
                </div>

                {/* Country & Account Tier Selection */}
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div>
                    <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider mb-1.5">
                      Country of Residence
                    </label>
                    <select
                      value={country}
                      onChange={(e) => setCountry(e.target.value)}
                      className="w-full bg-white/80 text-jeton-orange-900 text-xs font-bold rounded-2xl px-4 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:outline-none"
                    >
                      <option value="United States">United States</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Singapore">Singapore</option>
                      <option value="United Arab Emirates">United Arab Emirates</option>
                      <option value="Canada">Canada</option>
                      <option value="Australia">Australia</option>
                      <option value="Germany">Germany</option>
                    </select>
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider mb-1.5">
                      Account Tier
                    </label>
                    <select
                      value={accountType}
                      onChange={(e) => setAccountType(e.target.value)}
                      className="w-full bg-white/80 text-jeton-orange-900 text-xs font-bold rounded-2xl px-4 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:outline-none"
                    >
                      <option value="Private Wealth Tier 1">Private Wealth Tier 1</option>
                      <option value="Corporate Treasury Desk">Corporate Treasury Desk</option>
                      <option value="Algorithmic Yield Tier">Algorithmic Yield Tier</option>
                      <option value="Institutional Sovereign">Institutional Sovereign</option>
                    </select>
                  </div>
                </div>

                {/* 4-Digit Security PIN & Referral Code */}
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div>
                    <div className="flex items-center justify-between mb-1.5">
                      <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider">
                        4-Digit PIN <span className="text-jeton-orange font-black">*</span>
                      </label>
                      <button
                        type="button"
                        onClick={() => setShowPin(!showPin)}
                        className="text-[11px] font-bold text-jeton-orange hover:underline flex items-center gap-1 cursor-pointer"
                      >
                        {showPin ? 'Hide' : 'Show'}
                      </button>
                    </div>
                    <div className="relative">
                      <input
                        type={showPin ? 'text' : 'password'}
                        inputMode="numeric"
                        pattern="[0-9]*"
                        maxLength={4}
                        required
                        value={pin}
                        onChange={(e) => setPin(e.target.value.replace(/\D/g, '').slice(0, 4))}
                        placeholder="••••"
                        className="w-full bg-white/80 text-jeton-orange-900 text-base font-mono font-bold tracking-widest text-center rounded-2xl px-4 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:ring-4 focus:ring-jeton-orange/10 focus:outline-none transition-all placeholder:text-gray-400 shadow-sm"
                      />
                    </div>
                    <p className="text-[10px] text-jeton-orange-900/60 font-medium mt-1">
                      Mandatory 4 digits for sign-in &amp; transfer authorizations
                    </p>
                  </div>

                  <div>
                    <div className="flex items-center justify-between mb-1.5">
                      <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider">
                        Referral Code
                      </label>
                      {referralCode && (
                        <span className="text-[10px] text-emerald-600 font-bold">✓ Applied</span>
                      )}
                    </div>
                    <input
                      type="text"
                      value={referralCode}
                      onChange={(e) => setReferralCode(e.target.value)}
                      placeholder="Optional sponsor code"
                      className="w-full bg-white/80 text-jeton-orange-900 text-sm font-mono uppercase font-bold rounded-2xl px-4 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:outline-none"
                    />
                  </div>
                </div>

                <div>
                  <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider mb-1.5">
                    Create Password
                  </label>
                  <div className="relative">
                    <span className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                      </svg>
                    </span>
                    <input
                      type={showPassword ? 'text' : 'password'}
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                      required
                      placeholder="Minimum 6 characters"
                      className="w-full bg-white/80 text-jeton-orange-900 text-sm font-medium rounded-2xl pl-11 pr-12 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:ring-4 focus:ring-jeton-orange/10 focus:outline-none transition-all placeholder:text-gray-400 shadow-sm"
                    />
                    <button
                      type="button"
                      onClick={() => setShowPassword(!showPassword)}
                      className="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-jeton-orange transition-colors"
                    >
                      {showPassword ? (
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                          <line x1="1" y1="1" x2="23" y2="23" />
                        </svg>
                      ) : (
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                          <circle cx="12" cy="12" r="3" />
                        </svg>
                      )}
                    </button>
                  </div>
                </div>

                <div>
                  <div className="flex items-center justify-between mb-1.5">
                    <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider">
                      Confirm Password
                    </label>
                    {confirmPassword && (
                      <span className={`text-[11px] font-bold ${isMatch ? 'text-emerald-600' : 'text-red-500'}`}>
                        {isMatch ? '✓ Passwords match' : '✗ Do not match'}
                      </span>
                    )}
                  </div>
                  <div className="relative">
                    <span className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                      </svg>
                    </span>
                    <input
                      type={showPassword ? 'text' : 'password'}
                      value={confirmPassword}
                      onChange={(e) => setConfirmPassword(e.target.value)}
                      required
                      placeholder="Repeat your password"
                      className="w-full bg-white/80 text-jeton-orange-900 text-sm font-medium rounded-2xl pl-11 pr-4 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:ring-4 focus:ring-jeton-orange/10 focus:outline-none transition-all placeholder:text-gray-400 shadow-sm"
                    />
                  </div>
                </div>

                {/* Password Strength Indicator */}
                {password && (
                  <div className="space-y-1 pt-1">
                    <div className="flex items-center gap-1.5">
                      <div className={`h-1.5 flex-1 rounded-full ${password.length >= 6 ? 'bg-emerald-500' : 'bg-amber-400'}`} />
                      <div className={`h-1.5 flex-1 rounded-full ${password.length >= 8 ? 'bg-emerald-500' : 'bg-gray-200'}`} />
                      <div className={`h-1.5 flex-1 rounded-full ${password.length >= 10 && /[0-9]/.test(password) ? 'bg-emerald-500' : 'bg-gray-200'}`} />
                    </div>
                    <span className="text-[10px] text-gray-500 font-medium">
                      {password.length < 6 ? 'Requirement: At least 6 characters' : 'Good security rating'}
                    </span>
                  </div>
                )}

                <div className="pt-2">
                  <label className="flex items-start gap-2 cursor-pointer">
                    <input
                      type="checkbox"
                      checked={agreeTerms}
                      onChange={(e) => setAgreeTerms(e.target.checked)}
                      className="mt-0.5 w-4 h-4 rounded text-jeton-orange focus:ring-jeton-orange border-gray-300"
                    />
                    <span className="text-xs text-jeton-orange-900/75 leading-snug">
                      I acknowledge and agree to the <span className="font-bold text-jeton-orange">Private Client Custody Agreement</span> and FinCEN verification policies.
                    </span>
                  </label>
                </div>

                <button
                  type="submit"
                  disabled={loading}
                  className="w-full py-4 rounded-full text-white font-bold text-sm bg-jeton-orange hover:bg-jeton-orange-hover transition-all duration-200 shadow-pill disabled:opacity-50 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer mt-2"
                >
                  {loading ? (
                    <span className="flex items-center justify-center gap-2">
                      <svg className="animate-spin h-4 w-4" viewBox="0 0 24 24">
                        <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                      </svg>
                      Provisioning Private Account...
                    </span>
                  ) : (
                    <span className="flex items-center justify-center gap-2">
                      <span>Open Private Wealth Account</span>
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                      </svg>
                    </span>
                  )}
                </button>
              </form>

              {/* Bottom Switcher */}
              <div className="mt-6 pt-5 border-t border-jeton-orange-50 text-center">
                <p className="text-sm font-medium text-jeton-orange-900/70">
                  Already have an account?{' '}
                  <Link to="/login" className="text-jeton-orange hover:underline font-bold transition-colors">
                    Sign in to Portfolio →
                  </Link>
                </p>
              </div>
            </div>
          </div>

        </div>
      </main>

      {/* Footer */}
      <footer className="relative z-10 w-full px-6 py-4 text-center text-[11px] text-jeton-orange-900/60 font-medium">
        <span>© {new Date().getFullYear()} Vestexa Financial Inc. • Private Client Services • Institutional Asset Custody</span>
      </footer>
    </div>
  );
};
