import React from 'react';

interface CoinDropProps {
  tone?: 'white' | 'orange';
  className?: string;
}

/**
 * CoinDrop — Mirrors Jeton's CSS coin-drop micro-animation.
 *
 * Cascading circular drop animation used in scroll hints, loading indicators,
 * and button indicators. Supports both white (on orange) and orange (on white) tones.
 */
export const CoinDrop: React.FC<CoinDropProps> = ({
  tone = 'white',
  className = '',
}) => {
  return (
    <span
      className={`coin-drop ${tone === 'orange' ? 'tone-orange' : ''} ${className}`}
      aria-hidden="true"
    >
      <span />
      <span />
      <span />
    </span>
  );
};

export default CoinDrop;
