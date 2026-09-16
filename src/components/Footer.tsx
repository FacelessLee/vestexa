import React, { useState } from 'react';
import { SvgWordmark } from './SvgWordmark';
import { CoinDrop } from './CoinDrop';

/**
 * Footer — Mirrors Jeton's _footer.
 *
 * - White background (#FFFFFF), all text/links in #F73B20 orange
 * - SVG wordmark displayed prominently at top
 * - Link groups with accordion behavior on mobile (<1024px)
 * - Link hover: underline slides in from right (footer-link)
 * - Partnership badges (Premier League club partners, payment networks)
 * - Certification & regulatory badges with filtered styling
 * - Social media icon badges
 * - Generous bottom padding (140px)
 */

interface LinkItem {
  label: string;
  href: string;
}

interface LinkGroup {
  title: string;
  links: LinkItem[];
}

const linkGroups: LinkGroup[] = [
  {
    title: 'Investing',
    links: [
      { label: 'Stocks & ETFs', href: '/services' },
      { label: 'Automated Investing', href: '/services' },
      { label: 'Retirement Planning', href: '/services' },
      { label: 'Portfolio Diversification', href: '/services' },
      { label: 'AI Financial Guidance', href: '/services' },
    ],
  },
  {
    title: 'Resources',
    links: [
      { label: 'Financial Education', href: '#education' },
      { label: 'Investment Calculator', href: '#exchange' },
      { label: 'Market Insights', href: '#insights' },
      { label: 'Help Center', href: '#help' },
      { label: 'Security', href: '#security' },
    ],
  },
  {
    title: 'Company',
    links: [
      { label: 'About Vestexa', href: '/about' },
      { label: 'Our Services', href: '/services' },
      { label: 'Careers', href: '#careers' },
      { label: 'Press', href: '#press' },
      { label: 'Contact Us', href: '#contact' },
    ],
  },
  {
    title: 'Legal & Compliance',
    links: [
      { label: 'Privacy Policy', href: '#privacy' },
      { label: 'Terms of Service', href: '#terms' },
      { label: 'Disclosures', href: '#disclosures' },
      { label: 'Regulatory Information', href: '#regulatory' },
      { label: 'Cookie Preferences', href: '#cookies' },
    ],
  },
];

const socialLinks = [
  {
    label: 'X (Twitter)',
    href: 'https://twitter.com',
    icon: (
      <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24">
        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
      </svg>
    ),
  },
  {
    label: 'Instagram',
    href: 'https://instagram.com',
    icon: (
      <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24">
        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
      </svg>
    ),
  },
  {
    label: 'LinkedIn',
    href: 'https://linkedin.com',
    icon: (
      <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24">
        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
      </svg>
    ),
  },
  {
    label: 'YouTube',
    href: 'https://youtube.com',
    icon: (
      <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24">
        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
      </svg>
    ),
  },
];

// Accordion for mobile devices
const FooterAccordion: React.FC<{ group: LinkGroup }> = ({ group }) => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <div className="lg:border-none border-b border-jeton-orange/10">
      {/* Desktop Column Header */}
      <div className="hidden lg:block mb-5">
        <span className="text-body-small font-medium text-jeton-orange/60 uppercase tracking-widest text-[13px]">
          {group.title}
        </span>
      </div>

      {/* Mobile Accordion Trigger Button */}
      <button
        type="button"
        className="lg:hidden w-full flex items-center justify-between py-4 text-jeton-orange font-medium"
        onClick={() => setIsOpen(!isOpen)}
        aria-expanded={isOpen}
      >
        <span className="text-body font-medium">{group.title}</span>
        <svg
          width="20"
          height="20"
          viewBox="0 0 24 24"
          fill="none"
          className="shrink-0 transition-transform duration-300"
        >
          <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor" strokeWidth="1.75" />
          <line
            x1="12"
            y1="5"
            x2="12"
            y2="19"
            stroke="currentColor"
            strokeWidth="1.75"
            className="transition-opacity duration-300"
            style={{ opacity: isOpen ? 0 : 1 }}
          />
        </svg>
      </button>

      {/* Link List */}
      <ul
        className={`lg:block space-y-2.5 transition-all duration-300 overflow-hidden ${
          isOpen
            ? 'max-h-[500px] opacity-100 pb-5 mb-2'
            : 'max-h-0 opacity-0 lg:max-h-none lg:opacity-100 lg:pb-0 lg:mb-0'
        }`}
      >
        {group.links.map((link, idx) => (
          <li key={idx}>
            {link.href === '#support' || link.href === '#contact' ? (
              <button
                type="button"
                onClick={() => window.dispatchEvent(new CustomEvent('vestexa:open-support'))}
                className="footer-link text-left cursor-pointer"
              >
                {link.label}
              </button>
            ) : (
              <a href={link.href} className="footer-link">
                {link.label}
              </a>
            )}
          </li>
        ))}
      </ul>
    </div>
  );
};

export const Footer: React.FC = () => {
  return (
    <footer className="bg-white relative border-t border-jeton-orange/10" style={{ paddingTop: 'var(--sp-80-48, 64px)', paddingBottom: '140px' }}>
      <div className="g-row-full max-w-7xl mx-auto px-4 sm:px-6">
        {/* Top Brand Area — Wordmark */}
        <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 mb-12 sm:mb-16">
          <a href="/" aria-label="Vestexa Home">
            <SvgWordmark tone="orange" brand="vestexa" className="!h-[clamp(36px, 30.811px + 1.2vw, 48px)]" />
          </a>
          <div className="flex items-center gap-3">
            <span className="text-caption text-jeton-orange/70 font-medium">Follow our journey:</span>
            <div className="flex items-center gap-2">
              {socialLinks.map((social, idx) => (
                <a
                  key={idx}
                  href={social.href}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="w-9 h-9 rounded-full border border-jeton-orange/20 flex items-center justify-center text-jeton-orange hover:bg-jeton-orange hover:text-white transition-all shadow-sm"
                  aria-label={social.label}
                >
                  {social.icon}
                </a>
              ))}
            </div>
          </div>
        </div>

        {/* Divider */}
        <div className="h-[1px] bg-jeton-orange/15 mb-12" />

        {/* Link Groups Grid */}
        <div className="grid grid-cols-1 lg:grid-cols-4 gap-x-[var(--grid-gap, 24px)] gap-y-0 lg:gap-y-10 mb-14 sm:mb-16">
          {linkGroups.map((group, idx) => (
            <FooterAccordion key={idx} group={group} />
          ))}
        </div>

        {/* Official Partnerships Section — Jeton Pattern */}
        <div className="mb-12 sm:mb-14 p-4 sm:p-8 rounded-2xl sm:rounded-card bg-jeton-orange-5/60 border border-jeton-orange/10">
          <div className="text-caption font-semibold text-jeton-orange uppercase tracking-wider mb-3 sm:mb-4">
            Official Global Sporting & Payment Network Partnerships
          </div>
          <div className="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4 items-stretch">
            {/* Partner 1 */}
            <div className="p-2.5 sm:p-3.5 rounded-xl bg-white border border-jeton-orange/10 flex items-center gap-2.5 sm:gap-3 shadow-sm">
              <span className="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-jeton-orange/10 text-jeton-orange flex items-center justify-center font-bold text-[11px] sm:text-caption shrink-0">
                AV
              </span>
              <div>
                <div className="text-[12px] sm:text-[13px] font-medium text-jeton-orange-900 leading-tight">Aston Villa FC</div>
                <div className="text-[10px] sm:text-[11px] text-jeton-orange-900/50">Official Partner</div>
              </div>
            </div>

            {/* Partner 2 */}
            <div className="p-2.5 sm:p-3.5 rounded-xl bg-white border border-jeton-orange/10 flex items-center gap-2.5 sm:gap-3 shadow-sm">
              <span className="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-jeton-orange/10 text-jeton-orange flex items-center justify-center font-bold text-[11px] sm:text-caption shrink-0">
                WH
              </span>
              <div>
                <div className="text-[12px] sm:text-[13px] font-medium text-jeton-orange-900 leading-tight">West Ham United</div>
                <div className="text-[10px] sm:text-[11px] text-jeton-orange-900/50">Principal Sponsor</div>
              </div>
            </div>

            {/* Partner 3 */}
            <div className="p-2.5 sm:p-3.5 rounded-xl bg-white border border-jeton-orange/10 flex items-center gap-2.5 sm:gap-3 shadow-sm">
              <span className="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-jeton-orange/10 text-jeton-orange flex items-center justify-center font-bold text-[11px] sm:text-caption shrink-0">
                MC
              </span>
              <div>
                <div className="text-[12px] sm:text-[13px] font-medium text-jeton-orange-900 leading-tight">Mastercard</div>
                <div className="text-[10px] sm:text-[11px] text-jeton-orange-900/50">Principal Member</div>
              </div>
            </div>

            {/* Partner 4 */}
            <div className="p-2.5 sm:p-3.5 rounded-xl bg-white border border-jeton-orange/10 flex items-center gap-2.5 sm:gap-3 shadow-sm">
              <span className="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-jeton-orange/10 text-jeton-orange flex items-center justify-center font-bold text-[11px] sm:text-caption shrink-0">
                SW
              </span>
              <div>
                <div className="text-[12px] sm:text-[13px] font-medium text-jeton-orange-900 leading-tight">SWIFT & SEPA</div>
                <div className="text-[10px] sm:text-[11px] text-jeton-orange-900/50">Direct Clearing</div>
              </div>
            </div>
          </div>
        </div>

        {/* Certifications & Regulatory Badges */}
        <div className="flex flex-wrap items-center justify-between gap-4 sm:gap-6 pb-8 border-b border-jeton-orange/10">
          <div className="flex flex-wrap items-center gap-3 sm:gap-6 text-caption text-jeton-orange-900/70">
            <span className="inline-flex items-center gap-1.5 font-medium">
              <svg className="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
              PCI-DSS Level 1 Compliant
            </span>
            <span className="inline-flex items-center gap-1.5 font-medium">
              <svg className="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
              ISO/IEC 27001 Certified Security
            </span>
            <span className="inline-flex items-center gap-1.5 font-medium">
              <svg className="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
              </svg>
              Tier-1 Segregated Custody
            </span>
            <span className="inline-flex items-center gap-1.5 font-medium">
              <svg className="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
              256-Bit Financial Encryption
            </span>
          </div>

          <div className="text-caption text-jeton-orange/50">
            Version 2.4.0 • Updated 2026
          </div>
        </div>

        {/* Bottom Legal Notice & Copyright */}
        <div className="pt-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 text-caption text-jeton-orange/60">
          <div className="max-w-2xl leading-relaxed">
            <p>
              © {new Date().getFullYear()} Vestexa Financial Inc. All rights reserved. Vestexa operates as an authorized Electronic Money Institution and financial technology provider. Payment card services are issued pursuant to license by Mastercard International.
            </p>
            <p className="mt-1 text-jeton-orange/40">
              Customer funds are safeguarded in segregated statutory bank accounts with regulated tier-1 institutions in accordance with European and UK Electronic Money Regulations.
            </p>
          </div>

          <a
            href="#"
            className="scroll-hint shrink-0"
            onClick={(e) => {
              e.preventDefault();
              window.scrollTo({ top: 0, behavior: 'smooth' });
            }}
          >
            <span>Back to top</span>
            <CoinDrop tone="orange" />
          </a>

        </div>
      </div>
    </footer>
  );
};
