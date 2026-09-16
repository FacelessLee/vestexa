import React, { useState } from 'react';
import { SvgWordmark } from './SvgWordmark';
import { SplitText } from './SplitText';

/**
 * Top Navbar — Matches Image 1 from Jeton.com:
 * - "Jeton" logo left
 * - Language selector (🌐 EN ⌵), "Log in", and "Sign up" button right
 */
export const Header: React.FC = () => {
  const [langOpen, setLangOpen] = useState(false);
  const [currentLang, setCurrentLang] = useState('EN');

  const languages = [
    { code: 'EN', name: 'English' },
    { code: 'DE', name: 'Deutsch' },
    { code: 'ES', name: 'Español' },
    { code: 'FR', name: 'Français' },
    { code: 'PL', name: 'Polski' },
    { code: 'TR', name: 'Türkçe' },
  ];

  return (
    <nav
      className="absolute left-0 top-0 w-full z-30 transition-all duration-300"
      style={{ padding: 'clamp(14px, 12px + 1vw, 28px) var(--grid-margin, 24px)' }}
    >
      <div className="w-full flex items-center justify-between gap-2">
        {/* Logo — Vestexa SVG Wordmark */}
        <a href="/" className="relative flex items-center gap-1 group shrink-0" aria-label="Vestexa Homepage">
          <SvgWordmark tone="white" brand="vestexa" className="!h-[22px] sm:!h-[30px]" />
        </a>

        {/* Right Navigation Elements */}
        <div className="flex items-center gap-1.5 sm:gap-4 shrink-0">
          {/* Language Selector (Image 1: 🌐 EN ⌵) */}
          <div className="relative">
            <button
              type="button"
              onClick={() => setLangOpen(!langOpen)}
              className="flex items-center gap-1 text-white/90 hover:text-white text-xs sm:text-sm font-medium transition-colors px-2 sm:px-2.5 py-1.5 rounded-full hover:bg-white/10"
              aria-expanded={langOpen}
              aria-label="Select Language"
            >
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.75" strokeLinecap="round" strokeLinejoin="round" className="opacity-90">
                <circle cx="12" cy="12" r="10" />
                <line x1="2" y1="12" x2="22" y2="12" />
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
              </svg>
              <span className="font-semibold text-[11px] sm:text-xs">{currentLang}</span>
              <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" className={`transition-transform duration-200 ${langOpen ? 'rotate-180' : ''}`}>
                <polyline points="6 9 12 15 18 9" />
              </svg>
            </button>

            {langOpen && (
              <div className="absolute right-0 mt-2 w-36 bg-white rounded-2xl shadow-xl border border-black/5 py-2 z-50 text-gray-800 text-sm animate-fadeIn">
                {languages.map((l) => (
                  <button
                    key={l.code}
                    type="button"
                    onClick={() => {
                      setCurrentLang(l.code);
                      setLangOpen(false);
                    }}
                    className={`w-full text-left px-4 py-2 hover:bg-neutral-100 flex items-center justify-between ${
                      currentLang === l.code ? 'font-semibold text-jeton-orange' : ''
                    }`}
                  >
                    <span>{l.name}</span>
                    <span className="text-xs text-gray-400">{l.code}</span>
                  </button>
                ))}
              </div>
            )}
          </div>

          {/* Log in — Clean white text */}
          <a
            href="/login"
            className="whitespace-nowrap text-white/95 hover:text-white text-xs sm:text-sm font-medium transition-colors px-2 py-1.5 active:opacity-75"
          >
            Log in
          </a>

          {/* Sign up — White rounded button with coral text */}
          <a
            href="/signup"
            className="whitespace-nowrap inline-flex items-center justify-center h-[34px] sm:h-[42px] px-3.5 sm:px-6 rounded-full bg-white text-jeton-orange hover:bg-white/95 transition-all font-semibold text-xs sm:text-sm shadow-md active:scale-95 shrink-0"
          >
            Sign up
          </a>
        </div>
      </div>
    </nav>
  );
};

