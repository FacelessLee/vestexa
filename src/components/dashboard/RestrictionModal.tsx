import React, { useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import type { User } from '../../lib/storage';

interface RestrictionModalProps {
  user: User;
  onLogout: () => void;
}

/**
 * RestrictionModal — Styled exactly like the homepage Legal / Regulatory Notice Modal
 *
 * Blurs the user's dashboard behind it with backdrop-blur-md while keeping dashboard
 * elements visible in the background. The only permitted action is "Log out".
 */
export const RestrictionModal: React.FC<RestrictionModalProps> = ({ user, onLogout }) => {
  // Prevent scrolling and dismiss keys when modal is active
  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      // Prevent scrolling keys & escape while dialog is active
      if (['Space', 'ArrowUp', 'ArrowDown', 'PageUp', 'PageDown', 'Home', 'End', 'Escape'].includes(e.code) || e.key === 'Escape') {
        e.preventDefault();
        e.stopPropagation();
      }
    };

    window.addEventListener('keydown', handleKeyDown, { capture: true, passive: false });
    const originalOverflow = document.body.style.overflow;
    document.body.style.overflow = 'hidden';

    return () => {
      window.removeEventListener('keydown', handleKeyDown, { capture: true });
      document.body.style.overflow = originalOverflow;
    };
  }, []);

  const headerText = user.restrictionHeader || 'Account Access Restricted';
  const reasonText =
    user.restrictionReason ||
    'Your account access has been restricted by platform administration. Please review this directive and log out.';

  return (
    <AnimatePresence>
      <div
        role="dialog"
        aria-modal="true"
        aria-labelledby="restriction-header"
        aria-describedby="restriction-body"
        className="fixed inset-0 z-[99999] flex items-center justify-center p-4 sm:p-6 overflow-hidden select-none"
        onClick={(e) => {
          e.preventDefault();
          e.stopPropagation();
        }}
      >
        {/* Full-viewport frosted dark backdrop with reduced blur allowing blurred dashboard behind to be clearly seen */}
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          transition={{ duration: 0.3 }}
          className="fixed inset-0 bg-neutral-950/40 backdrop-blur-[2.5px]"
          aria-hidden="true"
        />

        {/* Centered Modal Card — Exact styling as homepage RegulatoryNoticeModal */}
        <motion.div
          initial={{ opacity: 0, scale: 0.94, y: 16 }}
          animate={{ opacity: 1, scale: 1, y: 0 }}
          exit={{ opacity: 0, scale: 0.94, y: -12 }}
          transition={{ duration: 0.35, ease: [0.16, 1, 0.3, 1] }}
          onClick={(e) => e.stopPropagation()}
          className="relative z-10 bg-white rounded-[28px] p-7 sm:p-10 max-w-[500px] w-full shadow-[0_32px_80px_rgba(0,0,0,0.32)] border border-black/5 text-center"
        >
          {/* Header / Subject (Very bold at top of popup message) */}
          <h2
            id="restriction-header"
            className="text-2xl sm:text-3xl font-bold text-neutral-900 tracking-tight mb-4 leading-tight break-words"
          >
            {headerText}
          </h2>

          {/* Body / Reason text */}
          <p
            id="restriction-body"
            className="text-[12.5px] sm:text-[13.5px] text-neutral-600 leading-relaxed mb-8 font-normal whitespace-pre-line max-h-[280px] overflow-y-auto no-scrollbar text-center"
          >
            {reasonText}
          </p>

          {/* The only thing to do: Log out — styled exactly like homepage Continue button */}
          <button
            type="button"
            onClick={onLogout}
            className="inline-flex items-center justify-center h-[46px] px-10 rounded-full bg-black hover:bg-neutral-800 active:scale-95 text-white font-semibold text-sm transition-all shadow-[0_4px_14px_rgba(0,0,0,0.25)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.35)] cursor-pointer"
          >
            Log out
          </button>
        </motion.div>
      </div>
    </AnimatePresence>
  );
};
