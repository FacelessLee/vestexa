import React, { useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';

interface RegulatoryNoticeModalProps {
  isOpen: boolean;
  onContinue: () => void;
}

/**
 * RegulatoryNoticeModal — Site-Wide Regulatory Disclaimer Gate
 *
 * Restricts user access to the contents of the website until the user explicitly
 * clicks "Continue". Contains no dismiss button or backdrop bypass.
 */
export const RegulatoryNoticeModal: React.FC<RegulatoryNoticeModalProps> = ({
  isOpen,
  onContinue,
}) => {
  // Prevent background scrolling via keyboard (arrows/space/page down) when open
  useEffect(() => {
    if (!isOpen) return;

    const handleKeyDown = (e: KeyboardEvent) => {
      // Prevent scrolling keys while dialog is active
      if (['Space', 'ArrowUp', 'ArrowDown', 'PageUp', 'PageDown', 'Home', 'End'].includes(e.code)) {
        e.preventDefault();
      }
    };

    window.addEventListener('keydown', handleKeyDown, { passive: false });
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [isOpen]);

  return (
    <AnimatePresence>
      {isOpen && (
        <div
          role="dialog"
          aria-modal="true"
          aria-labelledby="regulatory-notice-title"
          className="fixed inset-0 z-[99999] flex items-center justify-center p-4 sm:p-6 overflow-hidden"
        >
          {/* Full-viewport frosted dark backdrop that restricts access to the website */}
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            transition={{ duration: 0.3 }}
            className="fixed inset-0 bg-neutral-950/60 backdrop-blur-md"
            aria-hidden="true"
          />

          {/* Centered Modal Card */}
          <motion.div
            initial={{ opacity: 0, scale: 0.94, y: 16 }}
            animate={{ opacity: 1, scale: 1, y: 0 }}
            exit={{ opacity: 0, scale: 0.94, y: -12 }}
            transition={{ duration: 0.35, ease: [0.16, 1, 0.3, 1] }}
            className="relative z-10 bg-white rounded-[28px] p-7 sm:p-10 max-w-[500px] w-full shadow-[0_32px_80px_rgba(0,0,0,0.32)] border border-black/5 text-center"
          >
            {/* Regulatory Notice Title */}
            <h2
              id="regulatory-notice-title"
              className="text-2xl sm:text-3xl font-bold text-neutral-900 tracking-tight mb-4 leading-tight"
            >
              Local Regulatory<br />Notice
            </h2>

            {/* Legal Disclaimer Body */}
            <p className="text-[12.5px] sm:text-[13.5px] text-neutral-600 leading-relaxed mb-8 font-normal">
              Access to international banking services may be subject to legal and regulatory restrictions depending on your country of residence. The services described on this website are provided by Vestexa Bank Limited, an international bank licensed in the Commonwealth of Dominica. By proceeding, you acknowledge that you have chosen to visit this website independently, without any advertisement, solicitation or financial promotion directed at you, and that you understand certain products or services may not be available in your jurisdiction. You also accept responsibility for complying with all applicable local laws before accessing or using any services available through this website.
            </p>

            {/* Strict Continue Action Button */}
            <button
              type="button"
              onClick={onContinue}
              className="inline-flex items-center justify-center h-[46px] px-10 rounded-full bg-black hover:bg-neutral-800 active:scale-95 text-white font-semibold text-sm transition-all shadow-[0_4px_14px_rgba(0,0,0,0.25)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.35)] cursor-pointer"
            >
              Continue
            </button>
          </motion.div>
        </div>
      )}
    </AnimatePresence>
  );
};
