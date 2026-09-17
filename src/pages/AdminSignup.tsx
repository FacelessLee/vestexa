import React from 'react';
import { Link } from 'react-router-dom';
import { SvgWordmark } from '../components/SvgWordmark';
import { CoinDrop } from '../components/CoinDrop';

/**
 * AdminSignup — Access Restricted Gate.
 * Enforces policy: Public admin registration is permanently disabled.
 * Only the designated Super Administrator can provision accounts from inside the Admin Portal.
 * Uses main site design system: glass cards, jeton buttons, coin-drop animations.
 */
export const AdminSignup: React.FC = () => {
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

      {/* Top Navigation */}
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

        <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/60 backdrop-blur-md border border-white/60 text-[11px] font-bold text-jeton-orange-900/80 shadow-sm">
          <CoinDrop tone="orange" />
          <span>Security Policy</span>
        </div>
      </header>

      {/* Centerpiece: Restricted Notice */}
      <main className="relative z-10 flex-1 flex items-center justify-center px-4 py-8">
        <div className="w-full max-w-lg">
          <div className="glass-card-orange bg-white/92 backdrop-blur-2xl border border-white/80 rounded-[32px] p-8 sm:p-10 shadow-[0_25px_60px_-15px_rgba(54,8,2,0.15)] text-center relative" style={{ background: 'rgba(255,255,255,0.92)' }}>
            
            {/* Lock icon — glass card treatment */}
            <div className="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500/20 to-amber-600/10 text-amber-600 flex items-center justify-center mx-auto mb-5 border border-amber-500/20 shadow-inner backdrop-blur-sm">
              <span className="material-symbols-outlined text-3xl">lock</span>
            </div>

            <div className="flex justify-center mb-4">
              <Link to="/" className="inline-flex items-center justify-center hover:opacity-90 transition-opacity">
                <SvgWordmark tone="orange" brand="vestexa" className="!h-[32px]" />
              </Link>
            </div>

            <h1 className="text-2xl sm:text-3xl font-display font-extrabold text-jeton-orange-900 tracking-tight mb-3">
              Public Registration Disabled
            </h1>

            <div className="p-4 rounded-card-lg bg-amber-500/10 border border-amber-500/25 text-left mb-6 space-y-2 text-xs font-medium text-amber-950/90">
              <div className="flex items-center gap-2 font-bold text-amber-950">
                <span className="material-symbols-outlined text-[18px] text-amber-600">verified_user</span>
                <span>Single Super Admin Governance Policy</span>
              </div>
              <p className="leading-relaxed">
                Administrative accounts cannot be created from the public web interface. In strict adherence to institutional security protocols:
              </p>
              <ul className="list-disc pl-5 space-y-1 text-amber-900/90 font-medium">
                <li>There is exactly <strong>one overall Super Administrator</strong>.</li>
                <li>Additional operations accounts must be provisioned <strong>internally</strong> from within the secure Admin Portal.</li>
              </ul>
            </div>

            <div className="space-y-3">
              <Link
                to="/admin/login"
                className="btn btn-primary-orange w-full !rounded-full !h-[48px] text-sm font-bold shadow-pill inline-flex items-center justify-center gap-2 active:scale-95"
              >
                <span>Proceed to Admin Sign In</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12" />
                  <polyline points="12 5 19 12 12 19" />
                </svg>
              </Link>

              <Link
                to="/login"
                className="btn btn-outline-orange w-full !rounded-full !h-[48px] text-xs font-bold inline-flex items-center justify-center gap-2"
              >
                <span>Switch to Client Portal Login</span>
              </Link>
            </div>

          </div>
        </div>
      </main>

      {/* Footer */}
      <footer className="relative z-10 w-full px-6 py-4 text-center text-[11px] text-jeton-orange-900/60 font-medium">
        <span>© {new Date().getFullYear()} Vestexa Financial Internal Systems • Unauthorized Access Attempts Are Monitored.</span>
      </footer>
    </div>
  );
};
