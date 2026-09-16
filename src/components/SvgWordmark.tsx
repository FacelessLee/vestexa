import React from 'react';

interface SvgWordmarkProps {
  tone?: 'orange' | 'white';
  brand?: 'jeton' | 'vestexa';
  className?: string;
}

/**
 * SVG Wordmark for "Vestexa" (or "Jeton")
 */
export const SvgWordmark: React.FC<SvgWordmarkProps> = ({
  tone = 'white',
  brand = 'vestexa',
  className = '',
}) => {
  const fill = tone === 'white' ? '#FFFFFF' : '#F73B20';

  if (brand === 'vestexa') {
    return (
      <span className={`inline-block relative ${className}`} style={{ height: 'clamp(24px, 21.621px + 0.61vw, 32px)' }}>
        <svg
          viewBox="0 0 706 124"
          fill={fill}
          xmlns="http://www.w3.org/2000/svg"
          className="h-full w-auto"
          aria-label="Vestexa"
        >
          <path d="M0 10h18.5L56 95.5 93.5 10H112L62.5 115h-13L0 10Z" />
          <path d="M130 68.5c0-27 20.5-47 47-47 25.5 0 44.5 18 44.5 45v7h-72.5c2.5 18 16 29 33.5 29 12.5 0 22-5 28.5-13.5l12 10c-9 12-23 19.5-41 19.5-28.5 0-52-19.5-52-50Zm72.5-8c-1.5-16-13.5-25-27-25-15 0-26.5 9.5-28.5 25h55.5Z" />
          <path d="M240 95l10-13c8.5 8.5 20.5 13.5 33 13.5 15 0 23-7 23-16 0-10-12-14-26-18-17-4.5-36-10-36-32 0-19 16-32 38-32 16 0 29 6 38 15l-10 12.5c-7.5-7.5-17.5-12-28.5-12-12 0-20 6-20 14.5 0 9.5 12 13 26 17 17 4.5 36 10.5 36 33 0 20-16.5 33.5-41 33.5-17.5 0-33-7-42.5-16.5Z" />
          <path d="M350 35h-22V19h22V0h17v19h30v16h-30v50c0 8 4 12 11 12 7 0 13-3 17-7l7 13c-6 7-16 12-28 12-18 0-24-11-24-30V35Z" />
          <path d="M400 68.5c0-27 20.5-47 47-47 25.5 0 44.5 18 44.5 45v7h-72.5c2.5 18 16 29 33.5 29 12.5 0 22-5 28.5-13.5l12 10c-9 12-23 19.5-41 19.5-28.5 0-52-19.5-52-50Zm72.5-8c-1.5-16-13.5-25-27-25-15 0-26.5 9.5-28.5 25h55.5Z" />
          <path d="M505 24h19l27 35 27-35h19l-37 47 39 49h-19l-29-37-29 37h-19l39-49-37-47Z" />
          <path d="M606 68.5c0-27 21-47 47-47 13 0 24 5 31 14V24h17v96h-17v-13c-7 9-18 14-31 14-26 0-47-20-47-52.5Zm79 0c0-18-14-32-32-32s-30 14-30 32 12 32 30 32 32-14 32-32Z" />
        </svg>
      </span>
    );
  }

  // Official Jeton Wordmark — Bold modern rounded typography
  return (
    <span className={`inline-flex items-center select-none ${className}`} style={{ height: 'clamp(28px, 24px + 0.75vw, 36px)' }}>
      <svg
        viewBox="0 0 450 126"
        fill={fill}
        xmlns="http://www.w3.org/2000/svg"
        className="h-full w-auto"
        aria-label="Jeton"
      >
        {/* J */}
        <path d="M58 10h22v76c0 22-15 38-40 38-16 0-29-7-37-18l15-15c5 7 12 11 22 11 12 0 18-7 18-18V10Z" />
        {/* e */}
        <path d="M145 40c24 0 41 17 41 41v7h-61c2 15 14 24 29 24 11 0 19-4 24-11l14 11c-9 13-22 19-39 19-27 0-48-19-48-45s20-46 40-46Zm21 32c-1-13-10-21-22-21-12 0-21 8-22 21h44Z" />
        {/* t */}
        <path d="M212 14h22v28h24v19h-24v40c0 8 4 12 11 12 5 0 9-1 13-4l4 18c-7 4-15 5-23 5-18 0-27-10-27-29V61h-17V42h17V14Z" />
        {/* o */}
        <path d="M312 40c26 0 45 20 45 45s-19 46-45 46-45-20-45-46 19-45 45-45Zm0 70c14 0 24-11 24-25s-10-25-24-25-24 11-24 25 10 25 24 25Z" />
        {/* n */}
        <path d="M380 42h22v12c6-9 16-14 28-14 20 0 33 12 33 34v51h-22V77c0-13-7-19-18-19-10 0-19 7-22 17v50h-21V42Z" />
      </svg>
    </span>
  );
};

