import React, { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';

/**
 * SupportLauncher — Mirrors Jeton's _zendesk-launcher.
 *
 * - Fixed bottom-right pill button with backdrop-blur (desktop)
 * - Listens for global 'vestexa:open-support' events dispatched by mobile dock or FAQ links
 * - Mobile bottom sheet with spring physics and safe area insets
 */
export const SupportLauncher: React.FC = () => {
  const [isOpen, setIsOpen] = useState(false);

  useEffect(() => {
    const handleOpenSupport = () => setIsOpen(true);
    window.addEventListener('vestexa:open-support', handleOpenSupport);

    const checkHash = () => {
      if (window.location.hash === '#support' || window.location.hash === '#contact') {
        setIsOpen(true);
      }
    };
    checkHash();
    window.addEventListener('hashchange', checkHash);

    return () => {
      window.removeEventListener('vestexa:open-support', handleOpenSupport);
      window.removeEventListener('hashchange', checkHash);
    };
  }, []);

  return (
    <>
      {/* Desktop Support Pill Launcher (hidden on mobile, replaced by floating dock) */}
      <button
        type="button"
        onClick={() => setIsOpen(true)}
        className="support-launcher group"
        aria-label="Open 24/7 Client Support"
      >
        <span className="bg" />
        {/* Chat icon */}
        <svg
          width="18"
          height="18"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          strokeWidth="2"
          strokeLinecap="round"
          strokeLinejoin="round"
          className="shrink-0 group-hover:rotate-12 transition-transform duration-200"
        >
          <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
        </svg>
        <span className="font-medium text-body-small tracking-wide">Support</span>
      </button>

      {/* Support Concierge Bottom Sheet / Modal */}
      <AnimatePresence>
        {isOpen && (
          <div
            className="fixed inset-0 z-[120] flex items-end sm:items-center justify-center sm:justify-end sm:p-8 bg-black/50 backdrop-blur-sm"
            onClick={(e) => {
              if (e.target === e.currentTarget) setIsOpen(false);
            }}
          >
            <motion.div
              initial={{ y: '100%', opacity: 0.8 }}
              animate={{ y: 0, opacity: 1 }}
              exit={{ y: '100%', opacity: 0 }}
              transition={{ type: 'spring', damping: 28, stiffness: 320 }}
              className="w-full sm:w-[400px] bg-white rounded-t-[28px] sm:rounded-3xl shadow-[0_-12px_40px_rgba(0,0,0,0.25)] sm:shadow-2xl border border-jeton-orange/15 overflow-hidden flex flex-col max-h-[88vh]"
            >
              {/* Header */}
              <div className="bg-jeton-orange p-5 sm:p-6 text-white flex items-center justify-between shrink-0 relative">
                {/* Mobile Drag Indicator */}
                <div className="absolute top-2 left-1/2 -translate-x-1/2 w-10 h-1 bg-white/40 rounded-full sm:hidden" />

                <div>
                  <div className="flex items-center gap-2 mt-1 sm:mt-0">
                    <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" />
                    <span className="text-[11px] font-semibold uppercase tracking-wider text-emerald-100">Live Online</span>
                  </div>
                  <h3 className="text-subhead-2 font-medium text-white mt-1">Vestexa Client Desk</h3>
                  <p className="text-caption text-white/80">Average response time: &lt; 2 minutes</p>
                </div>
                <button
                  type="button"
                  onClick={() => setIsOpen(false)}
                  className="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 active:scale-95 flex items-center justify-center text-white transition-colors"
                  aria-label="Close Support"
                >
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                    <path d="M18 6L6 18M6 6l12 12" />
                  </svg>
                </button>
              </div>

              {/* Content */}
              <div className="p-5 sm:p-6 space-y-4 overflow-y-auto flex-1">
                <div className="p-4 rounded-2xl bg-jeton-orange-5 border border-jeton-orange/10">
                  <div className="text-subhead-3 font-medium text-jeton-orange-900 mb-1">
                    How can our treasury desk assist you?
                  </div>
                  <p className="text-body-small text-jeton-orange-900/70">
                    Choose an inquiry area below to connect instantly with a dedicated wealth officer.
                  </p>
                </div>

                <div className="space-y-2.5">
                  <a
                    href="/login"
                    className="w-full flex items-center justify-between p-3.5 rounded-xl border border-gray-100 hover:border-jeton-orange/30 hover:bg-jeton-orange-5/50 transition-all text-left group"
                  >
                    <div>
                      <div className="text-body-small font-medium text-jeton-orange-900 group-hover:text-jeton-orange transition-colors">
                        Card & Liquidity Accounts
                      </div>
                      <div className="text-caption text-gray-500">Limits, physical card delivery, Apple Pay</div>
                    </div>
                    <span className="text-jeton-orange text-body font-bold">&rarr;</span>
                  </a>

                  <a
                    href="/login"
                    className="w-full flex items-center justify-between p-3.5 rounded-xl border border-gray-100 hover:border-jeton-orange/30 hover:bg-jeton-orange-5/50 transition-all text-left group"
                  >
                    <div>
                      <div className="text-body-small font-medium text-jeton-orange-900 group-hover:text-jeton-orange transition-colors">
                        Private Wealth & Portfolios
                      </div>
                      <div className="text-caption text-gray-500">Asset allocation, rebalancing, tax lots</div>
                    </div>
                    <span className="text-jeton-orange text-body font-bold">&rarr;</span>
                  </a>

                  <a
                    href="/login"
                    className="w-full flex items-center justify-between p-3.5 rounded-xl border border-gray-100 hover:border-jeton-orange/30 hover:bg-jeton-orange-5/50 transition-all text-left group"
                  >
                    <div>
                      <div className="text-body-small font-medium text-jeton-orange-900 group-hover:text-jeton-orange transition-colors">
                        Security & Authentication
                      </div>
                      <div className="text-caption text-gray-500">2FA reset, transaction verification</div>
                    </div>
                    <span className="text-jeton-orange text-body font-bold">&rarr;</span>
                  </a>
                </div>
              </div>

              {/* Footer */}
              <div
                className="p-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between shrink-0"
                style={{ paddingBottom: 'max(16px, var(--safe-bottom, 16px))' }}
              >
                <span className="text-[11px] text-gray-400">Encrypted 256-bit channel</span>
                <a
                  href="mailto:support@vestexa.org"
                  className="text-caption font-medium text-jeton-orange hover:underline"
                >
                  support@vestexa.org
                </a>
              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>
    </>
  );
};

