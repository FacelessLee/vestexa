import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { SvgWordmark } from '../components/SvgWordmark';
import { CoinDrop } from '../components/CoinDrop';

export const AdminLogin: React.FC = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();
  const { loginAdmin } = useAuth();


  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    setTimeout(() => {
      const admin = loginAdmin(email.trim(), password);
      if (admin) {
        navigate('/admin');
      } else {
        setError('Invalid administrative credentials. Access restricted to authorized personnel.');
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
      <div className="absolute top-[-10%] right-[-5%] w-[45vw] h-[45vw] rounded-full bg-[#F73B20]/12 blur-[130px] pointer-events-none" />
      <div className="absolute bottom-[-15%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-[#FA8270]/15 blur-[150px] pointer-events-none" />

      {/* Top Navigation */}
      <header className="relative z-20 w-full px-6 sm:px-12 pt-6 pb-4 flex items-center justify-between">
        <Link
          to="/"
          className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/70 hover:bg-white text-jeton-orange-900 hover:text-jeton-orange text-xs font-bold transition-all shadow-sm backdrop-blur-md border border-white/60 active:scale-95"
        >
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
            <line x1="19" y1="12" x2="5" y2="12" />
            <polyline points="12 19 5 12 12 5" />
          </svg>
          <span>Return to Homepage</span>
        </Link>

        <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/60 backdrop-blur-md border border-white/60 text-[11px] font-bold text-jeton-orange-900/80 shadow-sm">
          <CoinDrop tone="orange" />
          <span>Internal Governance Terminal</span>
        </div>
      </header>

      {/* Main Form Centerpiece */}
      <main className="relative z-10 flex-1 flex items-center justify-center px-4 py-8">
        <div className="w-full max-w-md">
          <div className="glass-card-orange bg-white/92 backdrop-blur-2xl border border-white/80 rounded-[32px] p-7 sm:p-9 shadow-[0_25px_60px_-15px_rgba(54,8,2,0.15)] relative" style={{ background: 'rgba(255,255,255,0.92)' }}>
            
            {/* Header / Logo */}
            <div className="flex flex-col items-center text-center mb-7">
              <Link to="/" className="inline-flex items-center justify-center mb-3 hover:opacity-90 transition-opacity">
                <SvgWordmark tone="orange" brand="vestexa" className="!h-[32px]" />
              </Link>
              <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-jeton-orange/10 text-jeton-orange text-[10px] font-extrabold uppercase tracking-wider mb-3">
                <span className="material-symbols-outlined text-[14px]">shield_person</span>
                <span>Operations &amp; Treasury</span>
              </div>
              <h1 className="text-2xl sm:text-3xl font-display font-extrabold text-jeton-orange-900 tracking-tight">
                Admin Portal
              </h1>
              <p className="text-xs text-jeton-orange-900/70 mt-1.5 font-medium max-w-xs leading-relaxed">
                Restricted access for designated officers and system administrators.
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
              {/* Email field — jeton-input style */}
              <div className="jeton-input">
                <input
                  type="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  required
                  placeholder=" "
                  id="admin-email"
                />
                <label htmlFor="admin-email">Administrative Email</label>
              </div>

              {/* Password field — jeton-input style */}
              <div className="jeton-input relative">
                <input
                  type={showPassword ? 'text' : 'password'}
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                  placeholder=" "
                  id="admin-password"
                  style={{ paddingRight: '3rem' }}
                />
                <label htmlFor="admin-password">Master Password</label>
                <button
                  type="button"
                  onClick={() => setShowPassword(!showPassword)}
                  className="absolute right-4 top-1/2 -translate-y-1/2 text-jeton-orange-900/40 hover:text-jeton-orange transition-colors z-10"
                >
                  <span className="material-symbols-outlined text-xl">
                    {showPassword ? 'visibility_off' : 'visibility'}
                  </span>
                </button>
              </div>

              <button
                type="submit"
                disabled={loading}
                className="btn btn-primary-orange w-full !rounded-full !h-[52px] text-sm font-bold shadow-pill disabled:opacity-50 transform hover:-translate-y-0.5 active:translate-y-0 mt-2"
              >
                {loading ? (
                  <span className="flex items-center justify-center gap-2">
                    <svg className="animate-spin h-4 w-4" viewBox="0 0 24 24">
                      <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                      <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                    </svg>
                    Verifying Credentials...
                  </span>
                ) : (
                  <span className="flex items-center justify-center gap-2">
                    <span>Access Admin Portal</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                      <line x1="5" y1="12" x2="19" y2="12" />
                      <polyline points="12 5 19 12 12 19" />
                    </svg>
                  </span>
                )}
              </button>
            </form>

            {/* Client Portal Link */}
            <div className="mt-6 text-center">
              <Link
                to="/login"
                className="text-xs text-jeton-orange-900/70 hover:text-jeton-orange font-semibold transition-colors"
              >
                ← Return to Client Wealth Login
              </Link>
            </div>
          </div>
        </div>
      </main>

      {/* Footer */}
      <footer className="relative z-10 w-full px-6 py-4 text-center text-[11px] text-jeton-orange-900/60 font-medium">
        <span>© {new Date().getFullYear()} Vestexa Financial Internal Systems • All Administrative Actions Are Logged and Audited.</span>
      </footer>
    </div>
  );
};
