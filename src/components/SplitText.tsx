import React from 'react';

interface SplitTextProps {
  text: string;
  className?: string;
  isButtonLabel?: boolean;
  style?: React.CSSProperties;
}

/**
 * SplitText — Mirrors Jeton's per-character split-text DOM structure.
 *
 * Each character is wrapped in a `<span className="char" style={{ '--i': index }}>`.
 * If `isButtonLabel` is true, renders the `.label` wrapper containing the original
 * and an absolute-positioned `.clone` element for Jeton's signature staggered hover slide.
 */
export const SplitText: React.FC<SplitTextProps> = ({
  text,
  className = '',
  isButtonLabel = false,
  style,
}) => {
  const renderChars = (clone = false) => {
    return text.split('').map((char, index) => {
      const isSpace = char === ' ';
      return (
        <span
          key={`${clone ? 'clone-' : ''}${index}-${char}`}
          className={`char ${isSpace ? 'char-space' : ''}`}
          style={{ '--i': index } as React.CSSProperties}
        >
          {isSpace ? '\u00A0' : char}
        </span>
      );
    });
  };

  if (isButtonLabel) {
    return (
      <span className={`label whitespace-nowrap select-none ${className}`} style={style}>
        <span className="split-text whitespace-nowrap">
          {renderChars(false)}
        </span>
        <span className="clone split-text" aria-hidden="true">
          {renderChars(true)}
        </span>
      </span>
    );
  }

  return (
    <span className={`split-text ${className}`} style={style}>
      {renderChars(false)}
    </span>
  );
};

export default SplitText;
