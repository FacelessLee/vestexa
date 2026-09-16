import React, { useState, useEffect } from 'react';

/**
 * NotificationBanner — Mirrors Jeton's _notification-banner.
 *
 * - Sits at the very top of page (above navbar)
 * - Solid orange background (#F73B20)
 * - Rounded bottom corners, flush top
 * - Responsive: stacks neatly on mobile
 * - Dismissible with session persistence
 */
export const NotificationBanner: React.FC = () => {
  const [isVisible, setIsVisible] = useState(true);

  useEffect(() => {
    const dismissed = sessionStorage.getItem('vestexa_notice_dismissed');
    if (dismissed === 'true') {
      setIsVisible(false);
    }
  }, []);

  const handleDismiss = () => {
    setIsVisible(false);
    sessionStorage.setItem('vestexa_notice_dismissed', 'true');
  };

  if (!isVisible) return null;

  return (
    <aside
      aria-label="Regulatory Notice Banner"
      className="notification-banner border-b border-white/15"
    >
      <div className="g-row-full max-w-7xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
        <div className="flex items-center gap-2.5 text-body-small text-white/95">
          <span className="w-2 h-2 rounded-full bg-white shrink-0 animate-pulse hidden sm:inline-block" />
          <p>
            <span className="font-semibold text-white">Regulatory Notice: </span>
            Cross-border financial transactions and multi-currency accounts are provided in compliance with applicable EMI safeguarding regulations.
          </p>
        </div>

        <div className="flex items-center gap-3 shrink-0">
          <button
            type="button"
            onClick={handleDismiss}
            className="h-8 px-4 text-caption font-medium bg-white/20 hover:bg-white/30 text-white rounded-btn transition-colors active:scale-95 cursor-pointer"
          >
            I Understand
          </button>
          <button
            type="button"
            onClick={handleDismiss}
            className="w-7 h-7 rounded-full flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition-colors cursor-pointer"
            aria-label="Dismiss banner"
          >
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
              <path d="M18 6L6 18M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </aside>
  );
};
