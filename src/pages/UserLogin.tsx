import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { motion } from 'framer-motion';
import { SvgWordmark } from '../components/SvgWordmark';
import { CoinDrop } from '../components/CoinDrop';

export const UserLogin: React.FC = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [rememberMe, setRememberMe] = useState(true);
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();
  const { loginUser } = useAuth();

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    setTimeout(() => {
      const user = loginUser(email.trim(), password);
      if (user) {
        // faceless-fintech workflow: Proceed to 4-Digit Security PIN Verification
        navigate('/pin');
      } else {
        setError('Invalid email or password. Please verify your credentials.');
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
      <div className="absolute top-[-10%] left-[-5%] w-[45vw] h-[45vw] rounded-full bg-[#F73B20]/10 blur-[130px] pointer-events-none" />
      <div className="absolute bottom-[-15%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-[#FA8270]/15 blur-[150px] pointer-events-none" />
      <div className="absolute top-[40%] right-[20%] w-[30vw] h-[30vw] rounded-full bg-white/40 blur-[100px] pointer-events-none" />

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
          <div className="hidden sm:inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/60 backdrop-blur-md border border-white/60 text-[11px] font-bold text-jeton-orange-900/80 shadow-sm">
            <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" />
            <span>FINRA &amp; SIPC Member Custody</span>
          </div>

          <Link
            to="/signup"
            className="inline-flex items-center justify-center h-9 px-4 rounded-full bg-jeton-orange text-white hover:bg-jeton-orange-hover transition-all text-xs font-bold shadow-pill active:scale-95"
          >
            Create Account
          </Link>
        </div>
      </header>

      {/* Main Container: Responsive Split Showcase */}
      <main className="relative z-10 flex-1 max-w-7xl w-full mx-auto px-4 sm:px-8 py-4 sm:py-8 flex items-center">
        <div className="w-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
          
          {/* ═══ LEFT COLUMN: The Discerning Investor Experience ═══ */}
          <div className="lg:col-span-6 xl:col-span-7 flex flex-col items-start text-left space-y-6">
            <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/70 backdrop-blur-md border border-white/70 shadow-sm">
              <CoinDrop tone="orange" />
              <span className="text-[11px] uppercase tracking-wider font-extrabold text-jeton-orange">
                Private Wealth &amp; Treasury
              </span>
            </div>

            <div>
              <Link to="/" className="inline-block mb-3">
                <SvgWordmark tone="orange" brand="vestexa" />
              </Link>
              <h1 className="text-3xl sm:text-5xl lg:text-6xl font-display font-extrabold text-jeton-orange-900 leading-[1.05] tracking-tight">
                Institutional Grace.<br />
                <span className="text-jeton-orange">Boundless Yield.</span>
              </h1>
              <p className="mt-4 text-sm sm:text-base text-jeton-orange-900/75 max-w-xl font-medium leading-relaxed">
                Welcome back to your private wealth portal. Command multi-currency spot liquidity,
                automated 5.80% APY treasury yields, and direct bespoke portfolio settlements.
              </p>
            </div>

            {/* Interactive Luxury Metal Card Preview */}
            <div className="w-full max-w-md relative group select-none cursor-pointer" style={{ perspective: '1200px' }}>
              <div className="absolute -inset-1 bg-gradient-to-r from-jeton-orange/30 to-amber-500/30 rounded-3xl blur-lg opacity-60 group-hover:opacity-100 transition duration-500" />

              <motion.div
                className="relative rounded-3xl w-full"
                style={{ transformStyle: 'preserve-3d' }}
                whileHover={{ rotateY: 180 }}
                transition={{ duration: 0.9, ease: [0.25, 1, 0.5, 1] }}
              >
                {/* Front Face */}
                <div
                  className="relative rounded-3xl p-6 sm:p-7 text-white shadow-2xl overflow-hidden border border-white/20 transition-all duration-300"
                  style={{
                    background: 'linear-gradient(135deg, #1C1F26 0%, #111317 60%, #1F1513 100%)',
                    backfaceVisibility: 'hidden',
                    WebkitBackfaceVisibility: 'hidden',
                  }}
                >
                  {/* Metallic Card Watermark & Gloss */}
                  <div className="absolute -right-12 -top-12 w-48 h-48 bg-gradient-to-br from-jeton-orange/20 to-transparent rounded-full blur-2xl pointer-events-none" />
                  <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,255,255,0.12),transparent_70%)] pointer-events-none" />

                  <div className="flex justify-between items-start mb-6">
                    <div>
                      <span className="text-[10px] font-extrabold tracking-[0.2em] text-white/50 uppercase">Vestexa Private Black</span>
                      <div className="text-xs font-bold text-amber-300/90 flex items-center gap-1 mt-0.5">
                        <span>✦ Tier-1 Multi-Asset Custody</span>
                      </div>
                    </div>
                    {/* Contactless Waves */}
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" className="text-white/60">
                      <path d="M8.5 16.5a5 5 0 0 1 0-9" />
                      <path d="M12 19a8.5 8.5 0 0 0 0-14" />
                      <path d="M15.5 21.5a12 12 0 0 0 0-19" />
                    </svg>
                  </div>

                  {/* EMV Chip Visual */}
                  <div className="w-11 h-8 rounded-md bg-gradient-to-br from-amber-200 via-amber-400 to-amber-600 shadow-inner flex items-center justify-center p-1 border border-amber-200/50 mb-6">
                    <div className="w-full h-full border border-amber-800/40 rounded-sm grid grid-cols-2 grid-rows-2 opacity-60" />
                  </div>

                  <div className="space-y-1">
                    <div className="text-sm sm:text-base font-mono font-medium tracking-[0.25em] text-white/90">
                      •••• •••• •••• 0000
                    </div>
                    <div className="flex justify-between items-end pt-3 text-[11px] font-medium text-white/60">
                      <div>
                        <span className="block text-[9px] uppercase tracking-wider text-white/40">Cardholder</span>
                        <span className="font-bold text-white tracking-wider">VESTEXA MEMBER</span>
                      </div>
                      <div className="text-right">
                        <span className="block text-[9px] uppercase tracking-wider text-white/40">Portfolio Status</span>
                        <span className="font-bold text-emerald-400">VERIFIED • SECURE</span>
                      </div>
                    </div>
                  </div>
                </div>

                {/* Back Face */}
                <div
                  className="absolute inset-0 rounded-3xl p-6 sm:p-7 text-white shadow-2xl overflow-hidden border border-white/20 flex flex-col justify-between"
                  style={{
                    background: 'linear-gradient(135deg, #1C1F26 0%, #111317 60%, #1F1513 100%)',
                    backfaceVisibility: 'hidden',
                    WebkitBackfaceVisibility: 'hidden',
                    transform: 'rotateY(180deg)',
                  }}
                >
                  <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.08),transparent_70%)] pointer-events-none" />

                  {/* Magnetic Strip */}
                  <div className="absolute top-6 left-0 right-0 h-10 bg-[#0B0C0E] border-y border-white/10" />

                  {/* Signature strip & CVV */}
                  <div className="mt-12 flex items-center gap-3 relative z-10">
                    <div className="flex-1 h-7 bg-neutral-200/90 rounded px-3 flex items-center justify-between text-neutral-800 font-mono text-xs shadow-inner">
                      <span className="italic text-[10px] text-neutral-500 font-sans">Authorized Signature</span>
                      <span className="font-bold tracking-widest text-[11px]">842</span>
                    </div>
                  </div>

                  {/* Back Details & Hologram */}
                  <div className="space-y-2 mt-auto relative z-10">
                    <p className="text-[8px] text-white/40 leading-tight">
                      Property of Vestexa Custody Bank NA. Use constitutes acceptance of Private Wealth Member Terms.
                    </p>
                    <div className="flex justify-between items-end pt-1 text-[10px] text-white/60">
                      <div>
                        <span className="font-mono text-[9px] text-white/70 block">VESTEXA WORLD ELITE</span>
                        <span className="text-[8px] text-amber-300/80">24/7 Global Concierge</span>
                      </div>
                      <div className="flex items-center -space-x-1.5">
                        <span className="w-5 h-5 rounded-full bg-[#EB001B] opacity-90 inline-block" />
                        <span className="w-5 h-5 rounded-full bg-[#F79E1B] opacity-90 inline-block" />
                      </div>
                    </div>
                  </div>
                </div>
              </motion.div>
            </div>

            {/* Live Trust Metrics */}
            <div className="flex flex-wrap items-center gap-3 pt-2">
              <span className="px-3.5 py-1.5 rounded-full bg-white/70 backdrop-blur-md border border-white/60 text-xs font-bold text-jeton-orange-900 shadow-sm flex items-center gap-1.5">
                <span className="text-jeton-orange">✓</span> 5.80% APY Treasury Yield
              </span>
              <span className="px-3.5 py-1.5 rounded-full bg-white/70 backdrop-blur-md border border-white/60 text-xs font-bold text-jeton-orange-900 shadow-sm flex items-center gap-1.5">
                <span className="text-jeton-orange">✓</span> 0% FX Markup on 30+ Currencies
              </span>
              <span className="px-3.5 py-1.5 rounded-full bg-white/70 backdrop-blur-md border border-white/60 text-xs font-bold text-jeton-orange-900 shadow-sm flex items-center gap-1.5">
                <span className="text-jeton-orange">✓</span> 140,000+ Global Investors
              </span>
            </div>
          </div>

          {/* ═══ RIGHT COLUMN: The Sign-In Glass Suite ═══ */}
          <div className="lg:col-span-6 xl:col-span-5 w-full">
            <div className="bg-white/90 backdrop-blur-2xl border border-white/80 rounded-[32px] p-7 sm:p-9 shadow-[0_25px_60px_-15px_rgba(54,8,2,0.14)] relative">
              
              <div className="mb-6">
                <h2 className="text-2xl sm:text-3xl font-display font-extrabold text-jeton-orange-900 tracking-tight">
                  Welcome back
                </h2>
                <p className="text-sm font-medium text-jeton-orange-900/70 mt-1">
                  Authenticate your credentials to access your investments.
                </p>
              </div>


              {/* Error Message */}
              {error && (
                <div className="mb-5 bg-red-500/10 border border-red-500/20 text-red-700 text-xs sm:text-sm px-4 py-3 rounded-2xl flex items-start gap-2">
                  <span className="material-symbols-outlined text-base shrink-0 mt-0.5">error</span>
                  <span>{error}</span>
                </div>
              )}

              {/* Form */}
              <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                  <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider mb-1.5">
                    Account Email
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
                      placeholder="client@vestexa.org"
                      className="w-full bg-white/80 text-jeton-orange-900 text-sm font-medium rounded-2xl pl-11 pr-4 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:ring-4 focus:ring-jeton-orange/10 focus:outline-none transition-all placeholder:text-gray-400 shadow-sm"
                    />
                  </div>
                </div>

                <div>
                  <div className="flex items-center justify-between mb-1.5">
                    <label className="block text-xs font-bold text-jeton-orange-900 uppercase tracking-wider">
                      Security Password
                    </label>
                    <span className="text-[11px] text-jeton-orange font-bold hover:underline cursor-pointer">
                      Forgot?
                    </span>
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
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                      required
                      placeholder="••••••••"
                      className="w-full bg-white/80 text-jeton-orange-900 text-sm font-medium rounded-2xl pl-11 pr-12 py-3.5 border border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:ring-4 focus:ring-jeton-orange/10 focus:outline-none transition-all placeholder:text-gray-400 shadow-sm"
                    />
                    <button
                      type="button"
                      onClick={() => setShowPassword(!showPassword)}
                      className="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-jeton-orange transition-colors"
                      aria-label={showPassword ? 'Hide password' : 'Show password'}
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

                <div className="flex items-center justify-between py-1">
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input
                      type="checkbox"
                      checked={rememberMe}
                      onChange={(e) => setRememberMe(e.target.checked)}
                      className="w-4 h-4 rounded text-jeton-orange focus:ring-jeton-orange border-gray-300"
                    />
                    <span className="text-xs font-semibold text-jeton-orange-900/80">Remember this terminal</span>
                  </label>
                  <span className="text-[10px] text-gray-400 font-medium">256-bit TLS</span>
                </div>

                <button
                  type="submit"
                  disabled={loading}
                  className="w-full py-4 rounded-full text-white font-bold text-sm bg-jeton-orange hover:bg-jeton-orange-hover transition-all duration-200 shadow-pill disabled:opacity-50 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer"
                >
                  {loading ? (
                    <span className="flex items-center justify-center gap-2">
                      <svg className="animate-spin h-4 w-4" viewBox="0 0 24 24">
                        <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                      </svg>
                      Authenticating Secure Session...
                    </span>
                  ) : (
                    <span className="flex items-center justify-center gap-2">
                      <span>Sign In to Wealth Account</span>
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                      </svg>
                    </span>
                  )}
                </button>
              </form>

              {/* Bottom switcher */}
              <div className="mt-6 pt-5 border-t border-jeton-orange-50 text-center">
                <p className="text-sm font-medium text-jeton-orange-900/70">
                  New to Vestexa?{' '}
                  <Link to="/signup" className="text-jeton-orange hover:underline font-bold transition-colors">
                    Open a Wealth Account →
                  </Link>
                </p>
              </div>
            </div>
          </div>

        </div>
      </main>

      {/* Footer / Regulatory Notice Strip */}
      <footer className="relative z-10 w-full px-6 py-4 text-center text-[11px] text-jeton-orange-900/60 font-medium">
        <span>© {new Date().getFullYear()} Vestexa Financial Inc. • Regulated Multi-Asset Investment Services • All deposits held with Tier-1 Partner Banks.</span>
      </footer>
    </div>
  );
};
