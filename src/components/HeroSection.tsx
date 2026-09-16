import React, { useRef, useEffect, useState } from 'react';
import { motion } from 'framer-motion';
import { CoinDrop } from './CoinDrop';
import { Header } from './Header';

/**
 * Hero Section — Aligned directly with Jeton-inspired layout:
 *
 * - Atmospheric blush-peach pastel background seamlessly blending into the 3D rotating discs ribbon video
 * - Lower-left: "One app for all needs" display heading + "Scroll" pill button
 * - Lower-right: "Single account for all your payments." + App Store & Google Play download badges
 * - Clean edge masks and smooth animations
 */
export const HeroSection: React.FC = () => {
  const containerRef = useRef<HTMLElement>(null);
  const videoRef = useRef<HTMLVideoElement>(null);
  const [isVideoLoaded, setIsVideoLoaded] = useState(false);

  useEffect(() => {
    const video = videoRef.current;
    if (!video) return;

    video.play().catch(() => {});

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          video.play().catch(() => {});
        } else {
          video.pause();
        }
      },
      { threshold: 0.1 }
    );

    if (containerRef.current) {
      observer.observe(containerRef.current);
    }

    return () => observer.disconnect();
  }, []);

  const handleScrollDown = () => {
    const nextSection = document.getElementById('intro') || document.getElementById('features');
    if (nextSection) {
      nextSection.scrollIntoView({ behavior: 'smooth' });
    } else {
      window.scrollTo({ top: window.innerHeight, behavior: 'smooth' });
    }
  };

  return (
    <header
      ref={containerRef}
      className="relative overflow-hidden min-h-[100vh] min-h-[100dvh] flex flex-col justify-between"
      style={{
        background: 'linear-gradient(135deg, #F8CDCB 0%, #F5BFC5 45%, #FDE4DD 100%)',
      }}
    >
      {/* Top Navbar */}
      <Header />

      {/* 3D Ambient Discs Ribbon Video (Hero Ambient Graphic) */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none z-0 flex items-center justify-center">
        <video
          ref={videoRef}
          src="/hero-ambient.mp4"
          autoPlay
          loop
          muted
          playsInline
          preload="auto"
          aria-hidden="true"
          onLoadedData={() => setIsVideoLoaded(true)}
          className={`w-full h-full object-cover object-center transition-opacity duration-1000 ${
            isVideoLoaded ? 'opacity-90' : 'opacity-0'
          }`}
          style={{
            maskImage: 'radial-gradient(ellipse 90% 85% at 50% 50%, black 60%, rgba(0, 0, 0, 0.5) 85%, transparent 100%)',
            WebkitMaskImage: 'radial-gradient(ellipse 90% 85% at 50% 50%, black 60%, rgba(0, 0, 0, 0.5) 85%, transparent 100%)',
          }}
        />

        {/* Soft atmospheric gradient tint to blend video edges into background */}
        <div
          className="absolute inset-0 pointer-events-none"
          style={{
            background: 'radial-gradient(ellipse at 50% 50%, rgba(248, 205, 203, 0.05) 0%, rgba(245, 191, 197, 0.25) 60%, rgba(253, 228, 221, 0.6) 100%)',
          }}
        />
      </div>

      {/* ═════════════════════════════════════════════════════════
          BOTTOM HERO CONTENT: Left & Right Split Layout
          ═════════════════════════════════════════════════════════ */}
      <div className="relative z-10 mt-auto w-full px-[var(--grid-margin,24px)] pb-24 sm:pb-16 pt-20 sm:pt-24">
        <div className="w-full flex flex-col md:flex-row items-start md:items-end justify-between gap-6 sm:gap-8">
          
          {/* LOWER LEFT: Main Headline & Scroll Pill */}
          <div className="flex flex-col items-start max-w-xl">
            <motion.h1
              initial={{ opacity: 0, y: 25 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, ease: [0.22, 1, 0.36, 1], delay: 0.1 }}
              className="text-white font-bold leading-[1.08] sm:leading-[1.05] tracking-tight text-[clamp(2.1rem,7.8vw,4.5rem)] drop-shadow-[0_2px_20px_rgba(0,0,0,0.12)] whitespace-pre-line"
            >
              Professional{'\n'}investment advice{'\n'}without the{'\n'}sky-high fees
            </motion.h1>

            {/* Subheadline */}
            <motion.p
              initial={{ opacity: 0, y: 15 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, ease: [0.22, 1, 0.36, 1], delay: 0.3 }}
              className="text-white/90 text-sm sm:text-base lg:text-lg mt-3 sm:mt-4 drop-shadow-[0_1px_12px_rgba(0,0,0,0.1)] max-w-md leading-relaxed"
            >
              Traditional financial advisors can cost thousands of dollars a year. We built one into an app for everyone.
            </motion.p>

            {/* Scroll Hint Pill below headline */}
            <motion.div
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              transition={{ duration: 0.8, delay: 0.6 }}
              className="mt-4 sm:mt-6"
            >
              <button
                type="button"
                onClick={handleScrollDown}
                className="inline-flex items-center gap-2.5 px-3.5 sm:px-4 py-2 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/25 text-white text-xs font-semibold transition-all cursor-pointer shadow-sm group active:scale-95"
                aria-label="Scroll to next section"
              >
                <span className="opacity-95 font-medium tracking-wide">Scroll</span>
                <CoinDrop tone="white" />
              </button>
            </motion.div>
          </div>

          {/* LOWER RIGHT: Subtitle & Download Badges */}
          <motion.div
            initial={{ opacity: 0, y: 25 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, ease: [0.22, 1, 0.36, 1], delay: 0.3 }}
            className="flex flex-col items-start md:items-end text-left md:text-right mt-1 sm:mt-0 w-full sm:w-auto"
          >
            <p className="text-white/95 font-semibold text-xs sm:text-base lg:text-lg mb-3 sm:mb-4 drop-shadow-[0_1px_12px_rgba(0,0,0,0.15)] leading-snug">
              Expert guidance. Easy investing. A clear plan for what to do next.
            </p>

            {/* App Store & Google Play Badges */}
            <div className="flex flex-wrap items-center gap-2.5 sm:gap-3">
              {/* App Store Badge */}
              <a
                href="#download-ios"
                className="inline-flex items-center gap-2 sm:gap-2.5 h-[38px] sm:h-[42px] px-3 sm:px-3.5 rounded-xl bg-white/15 hover:bg-white/25 backdrop-blur-md border border-white/25 transition-all text-white shadow-sm group active:scale-95"
              >
                <svg className="w-4 h-4 sm:w-5 sm:h-5 fill-white shrink-0 group-hover:scale-105 transition-transform" viewBox="0 0 24 24">
                  <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.37c.62-.75 1.04-1.8 0.92-2.85-.9.04-1.99.6-2.61 1.34-.55.63-1.03 1.68-.9 2.7 1 .08 2.02-.49 2.59-1.19z" />
                </svg>
                <div className="text-left leading-none">
                  <div className="text-[7.5px] sm:text-[8px] uppercase tracking-wider font-medium opacity-75">Download on the</div>
                  <div className="text-[11px] sm:text-[12px] font-semibold mt-0.5">App Store</div>
                </div>
              </a>

              {/* Google Play Badge */}
              <a
                href="#download-android"
                className="inline-flex items-center gap-2 sm:gap-2.5 h-[38px] sm:h-[42px] px-3 sm:px-3.5 rounded-xl bg-white/15 hover:bg-white/25 backdrop-blur-md border border-white/25 transition-all text-white shadow-sm group active:scale-95"
              >
                <svg className="w-4 h-4 sm:w-5 sm:h-5 fill-white shrink-0 group-hover:scale-105 transition-transform" viewBox="0 0 24 24">
                  <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.61 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.5,12.92 20.16,13.19L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z" />
                </svg>
                <div className="text-left leading-none">
                  <div className="text-[7.5px] sm:text-[8px] uppercase tracking-wider font-medium opacity-75">GET IT ON</div>
                  <div className="text-[11px] sm:text-[12px] font-semibold mt-0.5">Google Play</div>
                </div>
              </a>
            </div>
          </motion.div>

        </div>
      </div>
    </header>
  );
};

