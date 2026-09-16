import React, { useRef, useState, useCallback, useEffect } from 'react';
import { motion, useScroll, useMotionValueEvent, AnimatePresence } from 'framer-motion';

/**
 * TestimonialStackSection — Mirrors Jeton's _client-testimonials.
 *
 * - Solid #F73B20 orange background
 * - Glassmorphic cards with blur(40px) & subtle borders
 * - True card-deck stacking: active card is 100% visible and centered
 * - Upcoming cards peek beneath with physical depth (scale & y-offset)
 * - Synchronized with scroll progress and interactive pill/arrow controls
 * - Zero overlapping text, clean spacing before FAQ section
 */

interface TestimonialItem {
  id: number;
  heading: string;
  body: string;
  initials: string;
  name: string;
  role: string;
  bgColor: string;
}

const testimonials: TestimonialItem[] = [
  {
    id: 1,
    heading: 'Recommended by our board',
    body: 'Vestexa has completely replaced our fragmented banking setup. Simple multi-currency transactions, instant treasury sweep yields, and dedicated 24/7 private client support have made global liquidity management seamless.',
    initials: 'VK',
    name: 'Vamsi K.',
    role: 'Managing Director, Apex Capital',
    bgColor: '#22C55E',
  },
  {
    id: 2,
    heading: 'Awesome app & very user friendly',
    body: 'Would highly recommend Vestexa to all international founders. The metal card combined with real interbank FX rates makes traveling across Singapore, London, and New York feel like having a local bank everywhere.',
    initials: 'LA',
    name: 'Leonie A.',
    role: 'Founder, Aurelia Global',
    bgColor: '#60A5FA',
  },
  {
    id: 3,
    heading: 'The best wealth & treasury solution',
    body: 'I have been a Vestexa client for over three years. The support is prompt, treasury execution is lightning-fast, and zero foreign transaction fees saved us thousands during European market expansions.',
    initials: 'KR',
    name: 'Karl R.',
    role: 'Chief Investment Officer, Kestrel Group',
    bgColor: '#FBBF24',
  },
  {
    id: 4,
    heading: 'Executive Corporate Accounts done right',
    body: 'Managing multi-asset liquidity across USD, EUR, and GBP is effortless. Automated batch payroll disbursements and high-yield sweep accounts give our finance team complete peace of mind.',
    initials: 'DP',
    name: 'Dennis P.',
    role: 'VP Finance, Quantico Technologies',
    bgColor: '#F59E0B',
  },
];

export const TestimonialStackSection: React.FC = () => {
  const targetRef = useRef<HTMLDivElement>(null);
  const [activeIndex, setActiveIndex] = useState(0);
  const isProgrammaticScroll = useRef(false);

  const { scrollYProgress } = useScroll({
    target: targetRef,
    offset: ['start start', 'end end'],
  });

  // Sync activeIndex with scroll position
  useMotionValueEvent(scrollYProgress, 'change', (latest) => {
    if (isProgrammaticScroll.current) return;

    if (latest < 0.2) {
      setActiveIndex(0);
    } else if (latest < 0.48) {
      setActiveIndex(1);
    } else if (latest < 0.76) {
      setActiveIndex(2);
    } else {
      setActiveIndex(3);
    }
  });

  // Navigate to a specific testimonial on click
  const goToCard = useCallback((targetIndex: number) => {
    const clamped = Math.max(0, Math.min(testimonials.length - 1, targetIndex));
    setActiveIndex(clamped);

    if (targetRef.current) {
      isProgrammaticScroll.current = true;
      const targetTop = targetRef.current.offsetTop;
      const scrollableDistance = targetRef.current.offsetHeight - window.innerHeight;
      const progressTargets = [0.08, 0.34, 0.62, 0.9];

      window.scrollTo({
        top: targetTop + progressTargets[clamped] * scrollableDistance,
        behavior: 'smooth',
      });

      setTimeout(() => {
        isProgrammaticScroll.current = false;
      }, 700);
    }
  }, []);

  // Keyboard navigation when section is in view
  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if (!targetRef.current) return;
      const rect = targetRef.current.getBoundingClientRect();
      const inView = rect.top <= 100 && rect.bottom >= window.innerHeight - 100;
      if (!inView) return;

      if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
        goToCard(activeIndex + 1);
      } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
        goToCard(activeIndex - 1);
      }
    };

    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [activeIndex, goToCard]);

  return (
    <section ref={targetRef} className="relative h-[260vh] bg-jeton-orange">
      {/* Sticky viewport */}
      <div className="sticky top-0 h-[100vh] h-[100dvh] flex flex-col justify-center items-center overflow-hidden px-4 sm:px-6 pb-28 sm:pb-8">
        {/* Solid orange background */}
        <div className="absolute inset-0 bg-jeton-orange pointer-events-none" />

        {/* Section Heading & Social Proof */}
        <div className="text-center z-10 mb-4 sm:mb-8 max-w-2xl">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-[11px] sm:text-caption font-medium mb-2.5 backdrop-blur-sm border border-white/10">
            <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" />
            Rated 4.9/5 from 14,000+ verified client reviews
          </div>
          <h2 className="text-2xl sm:text-title-3 font-bold text-white tracking-tight">
            Hear it from our clients
          </h2>
          <p className="text-white/80 text-xs sm:text-body mt-1.5 max-w-lg mx-auto">
            Trusted by founders, executives, and investors across 180+ countries.
          </p>
        </div>

        {/* Card Deck Stage with Mobile Touch Swipe */}
        <div className="relative w-full max-w-xl z-10 min-h-[290px] sm:min-h-[320px] flex items-center justify-center">
          {testimonials.map((card, idx) => {
            const offset = idx - activeIndex;
            const isActive = offset === 0;
            const isUpcoming = offset > 0;
            const isPast = offset < 0;

            let translateY = 0;
            let scale = 1;
            let opacity = 1;
            let zIndex = 20;

            if (isActive) {
              translateY = 0;
              scale = 1;
              opacity = 1;
              zIndex = 25;
            } else if (isUpcoming) {
              translateY = offset * 12;
              scale = Math.max(0.88, 1 - offset * 0.04);
              opacity = Math.max(0, 0.65 - (offset - 1) * 0.3);
              zIndex = 20 - offset;
            } else if (isPast) {
              translateY = -60 - Math.abs(offset) * 20;
              scale = 0.92;
              opacity = 0;
              zIndex = 5;
            }

            return (
              <motion.div
                key={card.id}
                drag={isActive ? 'x' : false}
                dragConstraints={{ left: 0, right: 0 }}
                dragElastic={0.25}
                onDragEnd={(_, info) => {
                  if (info.offset.x < -45 && activeIndex < testimonials.length - 1) {
                    goToCard(activeIndex + 1);
                  } else if (info.offset.x > 45 && activeIndex > 0) {
                    goToCard(activeIndex - 1);
                  }
                }}
                animate={{
                  y: translateY,
                  scale,
                  opacity,
                  zIndex,
                }}
                transition={{
                  type: 'spring',
                  stiffness: 280,
                  damping: 28,
                  mass: 0.8,
                }}
                className="absolute top-0 w-[94%] sm:w-[88%] max-w-xl glass-card-orange p-4 sm:p-8 transition-shadow duration-300 border border-white/25 select-none shadow-2xl touch-pan-y cursor-grab active:cursor-grabbing"
                style={{
                  pointerEvents: isActive ? 'auto' : 'none',
                }}
              >
                {/* 5-Star Rating */}
                <div className="flex items-center gap-1.5 mb-2.5 text-amber-300">
                  {[...Array(5)].map((_, i) => (
                    <svg key={i} className="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current drop-shadow-sm" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                  ))}
                  <span className="text-white/80 text-[11px] sm:text-caption font-semibold ml-1.5">5.0 Verified</span>
                </div>

                {/* Review Heading */}
                <h3 className="text-white font-bold text-sm sm:text-subhead-1 mb-2 leading-snug">
                  "{card.heading}"
                </h3>

                {/* Review Body */}
                <p className="text-white/95 text-xs sm:text-body font-normal leading-relaxed mb-4 sm:mb-6">
                  {card.body}
                </p>

                {/* Client Author Details */}
                <div className="flex items-center justify-between pt-3 sm:pt-4 border-t border-white/15">
                  <div className="flex items-center gap-2.5 sm:gap-3.5">
                    <div
                      className="w-8 h-8 sm:w-10 sm:h-10 rounded-full font-bold text-xs sm:text-caption flex items-center justify-center text-jeton-orange-900 shadow-md shrink-0 ring-2 ring-white/30"
                      style={{ backgroundColor: card.bgColor }}
                    >
                      {card.initials}
                    </div>
                    <div>
                      <div className="text-white font-semibold text-xs sm:text-body-small flex items-center gap-1.5">
                        {card.name}
                        <span className="inline-flex items-center gap-1 text-[10px] font-medium text-emerald-300 bg-emerald-500/25 px-1.5 py-0.5 rounded-full border border-emerald-400/20">
                          Verified
                        </span>
                      </div>
                      <div className="text-white/70 text-[10px] sm:text-caption font-normal">
                        {card.role}
                      </div>
                    </div>
                  </div>

                  <span className="text-white/50 text-[11px] sm:text-caption font-mono">
                    0{idx + 1} / 0{testimonials.length}
                  </span>
                </div>
              </motion.div>
            );
          })}
        </div>

        {/* Interactive Deck Controls & Stepper */}
        <div className="relative z-20 mt-6 sm:mt-10 flex flex-col items-center gap-2.5">
          <div className="flex items-center gap-3.5">
            {/* Previous Arrow */}
            <button
              type="button"
              onClick={() => goToCard(activeIndex - 1)}
              disabled={activeIndex === 0}
              className={`w-11 h-11 rounded-full flex items-center justify-center transition-all ${
                activeIndex === 0
                  ? 'opacity-25 cursor-not-allowed text-white/50 border border-white/10'
                  : 'bg-white/15 hover:bg-white/25 active:scale-95 text-white border border-white/25 shadow-md cursor-pointer'
              }`}
              aria-label="Previous testimonial"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                <path d="M15 18l-6-6 6-6" />
              </svg>
            </button>

            {/* Stepper Pills */}
            <div className="flex items-center gap-2 bg-black/20 backdrop-blur-md px-3.5 py-2 rounded-full border border-white/15">
              {testimonials.map((_, i) => (
                <button
                  key={i}
                  type="button"
                  onClick={() => goToCard(i)}
                  className={`transition-all duration-300 rounded-full ${
                    activeIndex === i
                      ? 'w-6 h-2 bg-white shadow-sm'
                      : 'w-2 h-2 bg-white/40 hover:bg-white/70 cursor-pointer'
                  }`}
                  aria-label={`Go to testimonial ${i + 1}`}
                />
              ))}
            </div>

            {/* Next Arrow */}
            <button
              type="button"
              onClick={() => goToCard(activeIndex + 1)}
              disabled={activeIndex === testimonials.length - 1}
              className={`w-11 h-11 rounded-full flex items-center justify-center transition-all ${
                activeIndex === testimonials.length - 1
                  ? 'opacity-25 cursor-not-allowed text-white/50 border border-white/10'
                  : 'bg-white/15 hover:bg-white/25 active:scale-95 text-white border border-white/25 shadow-md cursor-pointer'
              }`}
              aria-label="Next testimonial"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                <path d="M9 18l6-6-6-6" />
              </svg>
            </button>
          </div>

          {/* Mobile swipe hint */}
          <span className="text-white/60 text-[10px] tracking-wide sm:hidden">
            Swipe card left or right &larr; &rarr;
          </span>
        </div>
      </div>
    </section>
  );
};
