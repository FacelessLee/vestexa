import React from 'react';
import { motion, useScroll, useSpring } from 'framer-motion';

/**
 * ScrollProgressBar — Sleek top micro-glow progress indicator.
 *
 * Sits at top-0 with a linear brand gradient and high-performance spring damping.
 * Visual feedback for mobile and desktop reading rhythm.
 */
export const ScrollProgressBar: React.FC = () => {
  const { scrollYProgress } = useScroll();
  const scaleX = useSpring(scrollYProgress, {
    stiffness: 400,
    damping: 40,
    restDelta: 0.001,
  });

  return (
    <motion.div
      className="fixed top-0 left-0 right-0 h-[2.5px] bg-gradient-to-r from-[#F73B20] via-[#FF6B4A] to-[#FFA387] origin-left z-[999] pointer-events-none shadow-[0_1px_8px_rgba(247,59,32,0.4)]"
      style={{ scaleX }}
    />
  );
};

