import React, { useState, useRef, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { SvgWordmark } from './SvgWordmark';
import { SplitText } from './SplitText';

/**
 * Floating Bottom Navigation — Mirrors Jeton's _menu system.
 *
 * Desktop (≥1024px): Pill bar with dropdown drawers
 *   Items: Home (icon) | Personal ▾ | Business ↗ | Company ▾
 *   Hovering expandable items reveals an animated drawer from below.
 *
 * Mobile (<1024px): Consolidated luxury floating glass dock
 *   Items: [Menu] | [Support (live)] | [Get Started]
 *   Tapping Menu opens an ultra-smooth animated overlay with categorized links.
 *   Tapping Support opens the 24/7 concierge drawer.
 */

interface NavItem {
  label: string;
  type: 'link' | 'expand' | 'external';
  href?: string;
  children?: { label: string; href: string }[];
}

const navItems: NavItem[] = [
  {
    label: 'Home',
    type: 'link',
    href: '/',
  },
  {
    label: 'Investing',
    type: 'expand',
    children: [
      { label: 'Stocks & ETFs', href: '/services' },
      { label: 'Automated Investing', href: '/services' },
      { label: 'Retirement', href: '/services' },
    ],
  },
  {
    label: 'About',
    type: 'link',
    href: '/about',
  },
  {
    label: 'Company',
    type: 'expand',
    children: [
      { label: 'Our Services', href: '/services' },
      { label: 'About Vestexa', href: '/about' },
      { label: 'Support', href: '#support' },
    ],
  },
];

// Chevron SVG
const ChevronDown = () => (
  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" className="shrink-0">
    <path
      fillRule="evenodd"
      clipRule="evenodd"
      d="M8 8.93934L4.53033 5.46967L3.46967 6.53033L6.58578 9.64645C7.36683 10.4275 8.63316 10.4275 9.41421 9.64645L12.5303 6.53033L11.4697 5.46967L8 8.93934Z"
      fill="currentColor"
    />
  </svg>
);

// External link arrow
const ExternalArrow = () => (
  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" className="shrink-0">
    <path
      fillRule="evenodd"
      clipRule="evenodd"
      d="M10.166 9.883V10.55H11.5V9.883V5.167C11.5 4.799 11.201 4.5 10.833 4.5H6.117H5.45V5.834H6.117H9.223L4.972 10.085L4.5 10.557L5.443 11.5L5.915 11.028L10.166 6.777V9.883Z"
      fill="currentColor"
    />
  </svg>
);

// Home icon
const HomeIcon = () => (
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" className="shrink-0">
    <path
      fillRule="evenodd"
      clipRule="evenodd"
      d="M5.25 8H6.75V19.5H17.25V8H18.75V18.75C18.75 19.993 17.743 21 16.5 21H7.5C6.257 21 5.25 19.993 5.25 18.75L5.25 8Z"
      fill="currentColor"
    />
    <path
      fillRule="evenodd"
      clipRule="evenodd"
      d="M10.717 3.728C11.488 3.192 12.512 3.192 13.283 3.728L22.044 9.812L21.188 11.044L12 4.663L2.812 11.044L1.956 9.812L10.717 3.728Z"
      fill="currentColor"
    />
  </svg>
);

// Hamburger icon (for mobile)
const HamburgerIcon = () => (
  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" className="shrink-0">
    <path d="M20 9L4 9" stroke="currentColor" strokeWidth="2" strokeLinecap="round" />
    <path d="M20 15L4 15" stroke="currentColor" strokeWidth="2" strokeLinecap="round" />
  </svg>
);

export const FloatingNavDrawer: React.FC = () => {
  const [expandedItem, setExpandedItem] = useState<number | null>(null);
  const [mobileOpen, setMobileOpen] = useState(false);

  // Close expanded drawer on click outside
  const navRef = useRef<HTMLDivElement>(null);
  useEffect(() => {
    const handler = (e: MouseEvent) => {
      if (navRef.current && !navRef.current.contains(e.target as Node)) {
        setExpandedItem(null);
      }
    };
    document.addEventListener('click', handler);
    return () => document.removeEventListener('click', handler);
  }, []);

  // Lock body scroll when mobile menu is open
  useEffect(() => {
    if (mobileOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
    return () => {
      document.body.style.overflow = '';
    };
  }, [mobileOpen]);

  return (
    <>
      {/* ═══════════════════════════════════════════
          DESKTOP NAV — Drawer variant (≥1024px)
          ═══════════════════════════════════════════ */}
      <div className="floating-nav hidden lg:flex" ref={navRef}>
        <ul className="menu-bar gap-[2px]">
          {navItems.map((item, idx) => {
            if (item.type === 'link') {
              return (
                <li key={idx}>
                  <a href={item.href} className="menu-btn" data-active="true">
                    <span className="bg" />
                    <HomeIcon />
                  </a>
                </li>
              );
            }

            if (item.type === 'external') {
              return (
                <li key={idx}>
                  <a href={item.href} target="_blank" rel="noopener noreferrer" className="menu-btn btn-animated">
                    <span className="bg" />
                    <SplitText text={item.label} isButtonLabel />
                    <ExternalArrow />
                  </a>
                </li>
              );
            }

            // Expandable items
            const isExpanded = expandedItem === idx;
            return (
              <li key={idx} className="relative">
                <button
                  className="menu-btn btn-animated"
                  aria-expanded={isExpanded}
                  onClick={() => setExpandedItem(isExpanded ? null : idx)}
                  onMouseEnter={() => setExpandedItem(idx)}
                >
                  <span className="bg" />
                  <SplitText text={item.label} isButtonLabel />
                  <span className={`transition-transform duration-300 ${isExpanded ? 'rotate-180' : ''}`}>
                    <ChevronDown />
                  </span>
                </button>

                {/* Dropdown Drawer */}
                <div className="menu-drawer" style={{ borderRadius: '24px' }}>
                  <div
                    className="slot"
                    style={{
                      transform: isExpanded ? 'translateY(0) rotate(0deg)' : 'translateY(110%) rotate(1deg)',
                      opacity: isExpanded ? 1 : 0,
                    }}
                  >
                    <ul className="flex-grow py-2 px-3 relative z-10" style={{ paddingBottom: '56px' }}>
                      {item.children?.map((child, cidx) => (
                        <li key={cidx}>
                          <a
                            href={child.href}
                            className="block text-white/80 hover:text-white py-2 text-body-small font-[450] transition-opacity relative"
                            onClick={() => setExpandedItem(null)}
                          >
                            <span className="relative z-10">{child.label}</span>
                          </a>
                        </li>
                      ))}
                    </ul>
                  </div>
                </div>
              </li>
            );
          })}
        </ul>

        {/* Shade overlay behind expanded drawer */}
        <div
          className="menu-shade"
          style={{ opacity: expandedItem !== null ? 0.166 : 0 }}
        />
      </div>

      {/* ═══════════════════════════════════════════
          MOBILE NAV — Consolidated Floating Dock (<1024px)
          ═══════════════════════════════════════════ */}
      <div
        className="fixed bottom-0 inset-x-0 z-50 lg:hidden flex justify-center pointer-events-none pb-4 px-4"
        style={{ paddingBottom: 'max(14px, var(--safe-bottom, 16px))' }}
      >
        <div
          className="pointer-events-auto flex items-center backdrop-blur-xl border border-white/20 rounded-full p-1.5 shadow-[0_16px_36px_-8px_rgba(0,0,0,0.65),0_0_0_1px_rgba(255,255,255,0.12)]"
          style={{ backgroundColor: 'rgba(18, 19, 22, 0.94)' }}
        >
          {/* Menu Trigger Pill */}
          <button
            type="button"
            className="flex items-center gap-1.5 px-3 py-1.5 rounded-full text-white hover:bg-white/10 active:scale-95 transition-all text-[13px] font-medium tracking-wide"
            onClick={() => setMobileOpen(true)}
            aria-expanded={mobileOpen}
            aria-label="Open Navigation Menu"
          >
            <HamburgerIcon />
            <span>Menu</span>
          </button>

          {/* Micro Divider */}
          <div className="w-[1px] h-3.5 bg-white/20 mx-0.5" />

          {/* 24/7 Support Desk with Live Online Ping */}
          <button
            type="button"
            className="flex items-center gap-1.5 px-3 py-1.5 rounded-full text-white hover:bg-white/10 active:scale-95 transition-all text-[13px] font-medium tracking-wide"
            onClick={() => {
              window.dispatchEvent(new CustomEvent('vestexa:open-support'));
            }}
            aria-label="Open 24/7 Client Support Desk"
          >
            <span className="relative flex h-2 w-2">
              <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75" />
              <span className="relative inline-flex rounded-full h-2 w-2 bg-emerald-400" />
            </span>
            <span>Support</span>
          </button>

          {/* Micro Divider */}
          <div className="w-[1px] h-3.5 bg-white/20 mx-0.5" />

          {/* Get Started Quick Action Button */}
          <a
            href="/signup"
            className="flex items-center gap-1 px-3.5 py-1.5 rounded-full bg-jeton-orange text-white text-[13px] font-medium shadow-sm hover:bg-[#e0341c] active:scale-95 transition-all whitespace-nowrap"
          >
            <span>Get Started</span>
            <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
              <path d="M6 3L11 8L6 13" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
            </svg>
          </a>
        </div>
      </div>

      {/* ═══════════════════════════════════════════
          MOBILE FULL-SCREEN OVERLAY (<1024px)
          ═══════════════════════════════════════════ */}
      <AnimatePresence>
        {mobileOpen && (
          <motion.div
            initial={{ opacity: 0, y: 15 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: 15 }}
            transition={{ duration: 0.22, ease: [0.16, 1, 0.3, 1] }}
            className="fixed inset-0 z-[100] bg-jeton-orange text-white flex flex-col overflow-hidden"
          >
            {/* Top Navigation Bar with Logo and Close Button */}
            <div
              className="flex items-center justify-between px-6 pt-6 pb-4 border-b border-white/15 shrink-0"
              style={{ paddingTop: 'max(1.5rem, var(--safe-top, 24px))' }}
            >
              <a href="/" onClick={() => setMobileOpen(false)} aria-label="Vestexa Home">
                <SvgWordmark tone="white" brand="vestexa" className="!h-7" />
              </a>
              <button
                type="button"
                onClick={() => setMobileOpen(false)}
                className="w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 active:scale-90 flex items-center justify-center text-white transition-all"
                aria-label="Close menu"
              >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round">
                  <path d="M18 6L6 18M6 6l12 12" />
                </svg>
              </button>
            </div>

            {/* Quick Auth Actions Header */}
            <div className="px-6 py-4 flex items-center gap-3 border-b border-white/10 shrink-0">
              <a
                href="/login"
                onClick={() => setMobileOpen(false)}
                className="flex-1 py-2.5 px-4 rounded-xl border border-white/40 text-center text-body-small font-medium text-white hover:bg-white/10 active:scale-[0.98] transition-all"
              >
                Log in
              </a>
              <a
                href="/signup"
                onClick={() => setMobileOpen(false)}
                className="flex-1 py-2.5 px-4 rounded-xl bg-white text-center text-body-small font-medium text-jeton-orange shadow-md hover:bg-white/90 active:scale-[0.98] transition-all"
              >
                Sign up
              </a>
            </div>

            {/* Scrollable Nav Links with Staggered Visual Rhythm */}
            <div
              className="flex-1 overflow-y-auto px-6 py-4 space-y-6"
              style={{ paddingBottom: 'calc(max(24px, var(--safe-bottom, 16px)) + 40px)' }}
            >
              {/* Primary Main Links */}
              <div className="space-y-1">
                <a
                  href="/"
                  onClick={() => setMobileOpen(false)}
                  className="flex items-center justify-between py-3 text-title-4 font-medium text-white border-b border-white/10 active:opacity-75 transition-opacity"
                >
                  <span>Home</span>
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" className="opacity-60">
                    <path d="M6 3L11 8L6 13" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                  </svg>
                </a>
                <a
                  href="/services"
                  onClick={() => setMobileOpen(false)}
                  className="flex items-center justify-between py-3 text-title-4 font-medium text-white border-b border-white/10 active:opacity-75 transition-opacity"
                >
                  <span>Services & Plans</span>
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" className="opacity-60">
                    <path d="M6 3L11 8L6 13" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                  </svg>
                </a>
                <a
                  href="/about"
                  onClick={() => setMobileOpen(false)}
                  className="flex items-center justify-between py-3 text-title-4 font-medium text-white border-b border-white/10 active:opacity-75 transition-opacity"
                >
                  <span>About Vestexa</span>
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" className="opacity-60">
                    <path d="M6 3L11 8L6 13" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                  </svg>
                </a>
              </div>

              {/* Grouped Category Breakdown */}
              <div className="pt-2">
                <div className="text-caption uppercase tracking-wider text-white/60 font-semibold mb-3">
                  Investment Solutions
                </div>
                <div className="grid grid-cols-1 gap-2.5">
                  <a
                    href="/services"
                    onClick={() => setMobileOpen(false)}
                    className="p-3.5 rounded-xl bg-white/10 hover:bg-white/15 flex items-center justify-between transition-colors"
                  >
                    <div>
                      <div className="text-body-small font-medium text-white">Automated Portfolios</div>
                      <div className="text-caption text-white/70">AI-driven diversification & rebalancing</div>
                    </div>
                    <span className="text-white/80">&rarr;</span>
                  </a>
                  <a
                    href="/services"
                    onClick={() => setMobileOpen(false)}
                    className="p-3.5 rounded-xl bg-white/10 hover:bg-white/15 flex items-center justify-between transition-colors"
                  >
                    <div>
                      <div className="text-body-small font-medium text-white">IRAs & Retirement</div>
                      <div className="text-caption text-white/70">Tax-optimized wealth preservation</div>
                    </div>
                    <span className="text-white/80">&rarr;</span>
                  </a>
                  <a
                    href="/services"
                    onClick={() => setMobileOpen(false)}
                    className="p-3.5 rounded-xl bg-white/10 hover:bg-white/15 flex items-center justify-between transition-colors"
                  >
                    <div>
                      <div className="text-body-small font-medium text-white">Global Currency & FX</div>
                      <div className="text-caption text-white/70">Spot conversions in 30+ major currencies</div>
                    </div>
                    <span className="text-white/80">&rarr;</span>
                  </a>
                </div>
              </div>

              {/* Live Concierge Banner */}
              <div className="p-4 rounded-2xl bg-white/15 border border-white/20 flex items-center justify-between">
                <div>
                  <div className="flex items-center gap-2">
                    <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" />
                    <span className="text-caption font-semibold uppercase tracking-wider text-white">Client Desk Online</span>
                  </div>
                  <div className="text-body-small font-medium text-white mt-1">Need help or advice?</div>
                  <div className="text-caption text-white/75">Talk to our 24/7 treasury specialist</div>
                </div>
                <button
                  type="button"
                  onClick={() => {
                    setMobileOpen(false);
                    window.dispatchEvent(new CustomEvent('vestexa:open-support'));
                  }}
                  className="px-3.5 py-2 rounded-full bg-white text-jeton-orange font-medium text-caption shadow-sm active:scale-95 transition-all"
                >
                  Live Chat
                </button>
              </div>

              {/* Trust & Regulatory Guarantee */}
              <div className="pt-2 text-center text-[12px] text-white/60">
                <span>Tier-1 Custodian Segregation • 256-Bit Financial Encryption</span>
              </div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
};


