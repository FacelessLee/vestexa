import React, { useEffect, useRef, useState } from 'react';
import { Link } from 'react-router-dom';
import { motion, useScroll, useTransform } from 'framer-motion';
import { SvgWordmark } from '../components/SvgWordmark';
import { Footer } from '../components/Footer';
import { FloatingNavDrawer } from '../components/FloatingNavDrawer';
import { SupportLauncher } from '../components/SupportLauncher';
import { ScrollProgressBar } from '../components/ScrollProgressBar';
import Lenis from 'lenis';

/**
 * About Page — Mirrors Stash's about page structure.
 * Mission-focused. No founder/team mentions.
 * Covers: mission, stats, story, core values, commitment.
 */

const stats = [
  { value: '2024', label: 'Vestexa launched' },
  { value: '50K+', label: 'Active investors' },
  { value: '$2B+', label: 'In assets managed' },
  { value: '98%', label: 'Client satisfaction' },
];

const coreValues = [
  {
    num: 1,
    title: 'Prioritize People.',
    description: 'We believe a diverse, authentic, and inclusive culture empowers us to create better financial outcomes for everyone we serve.',
    icon: 'group',
  },
  {
    num: 2,
    title: 'Obsess Over The Client.',
    description: 'We have a mission mindset and always strive to build the best investing experience for everyday people — regardless of background or budget.',
    icon: 'favorite',
  },
  {
    num: 3,
    title: 'Take Ownership.',
    description: 'As the risk-takers, drivers, and doers behind each initiative, we take responsibility for our contributions individually and as a team.',
    icon: 'shield',
  },
  {
    num: 4,
    title: 'Create Solutions.',
    description: 'We challenge the status quo of traditional finance and solve complex problems in fresh, innovative ways that benefit our clients.',
    icon: 'lightbulb',
  },
];

export const AboutPage: React.FC = () => {
  const heroRef = useRef<HTMLDivElement>(null);
  const { scrollYProgress } = useScroll({
    target: heroRef,
    offset: ['start start', 'end start'],
  });
  const heroScale = useTransform(scrollYProgress, [0, 1], [1, 1.05]);

  useEffect(() => {
    const lenis = new Lenis({
      duration: 1.1,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      smoothWheel: true,
      touchMultiplier: 1.2,
      syncTouch: true,
    });

    function raf(time: number) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);
    return () => lenis.destroy();
  }, []);

  return (
    <div className="min-h-screen bg-white text-jeton-orange-900 font-sans selection:bg-[#A21906] selection:text-white">
      <ScrollProgressBar />
      {/* ═══════════════════════════════════════
          HERO SECTION
          ═══════════════════════════════════════ */}
      <section ref={heroRef} className="relative overflow-hidden">
        <div className="grid grid-cols-1 lg:grid-cols-2 min-h-[70vh]">
          {/* Left: Text */}
          <div className="flex items-center px-6 md:px-12 lg:px-16 xl:px-20 py-16 md:py-20">
            <div className="w-full max-w-xl flex flex-col items-start gap-5">
              {/* Logo */}
              <Link to="/" className="inline-flex mb-2 hover:opacity-90 transition-opacity">
                <SvgWordmark tone="orange" brand="vestexa" className="!h-[28px]" />
              </Link>

              <motion.h1
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.85, ease: [0.22, 1, 0.36, 1] }}
                className="text-4xl md:text-5xl xl:text-6xl font-bold leading-[1.05] tracking-tight text-jeton-orange-900"
              >
                Our mission is to make investing accessible for everyone.
              </motion.h1>

              <motion.p
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.85, ease: [0.22, 1, 0.36, 1], delay: 0.12 }}
                className="text-lg md:text-xl text-jeton-orange-900/70 leading-relaxed max-w-md"
              >
                We're shaping the future of personal finance — one investor at a time.
              </motion.p>

              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.85, ease: [0.22, 1, 0.36, 1], delay: 0.24 }}
              >
                <Link
                  to="/signup"
                  className="btn btn-primary-orange btn-animated mt-2 !rounded-full !px-8 !h-12 text-sm font-bold shadow-pill"
                >
                  Get Started
                </Link>
              </motion.div>
            </div>
          </div>

          {/* Right: Gradient block */}
          <motion.div
            style={{ scale: heroScale }}
            className="relative w-full min-h-[50vh] lg:min-h-full overflow-hidden"
          >
            <div
              className="absolute inset-0"
              style={{
                background: 'linear-gradient(135deg, #F73B20 0%, #F96853 40%, #FA8270 70%, #FDD6CE 100%)',
              }}
            />
            {/* Abstract pattern overlay */}
            <div className="absolute inset-0 opacity-20" style={{
              backgroundImage: 'radial-gradient(circle at 30% 40%, rgba(255,255,255,0.3) 0%, transparent 50%), radial-gradient(circle at 70% 60%, rgba(255,255,255,0.2) 0%, transparent 40%)',
            }} />
            {/* Large text watermark */}
            <div className="absolute inset-0 flex items-center justify-center">
              <span className="text-white/10 text-[200px] md:text-[280px] font-bold tracking-tighter select-none pointer-events-none">V</span>
            </div>
          </motion.div>
        </div>
      </section>

      {/* ═══════════════════════════════════════
          STATS SECTION
          ═══════════════════════════════════════ */}
      <section className="relative overflow-hidden bg-jeton-orange-900 px-6 md:px-12 py-16 md:py-20">
        {/* Ambient gradient */}
        <div className="pointer-events-none absolute inset-0" style={{
          backgroundImage: 'radial-gradient(ellipse at 50% 20%, rgba(247,59,32,0.22) 0%, transparent 55%), radial-gradient(ellipse at 50% 110%, rgba(247,59,32,0.28) 0%, transparent 55%)',
        }} aria-hidden="true" />

        <div className="relative max-w-5xl mx-auto flex flex-col items-center gap-12">
          <div className="flex flex-col items-center gap-4 text-center max-w-2xl">
            <h2 className="text-3xl md:text-4xl xl:text-5xl font-bold text-white leading-tight tracking-tight">
              We create financial opportunity.
            </h2>
            <p className="text-base md:text-lg text-white/70 leading-relaxed max-w-md">
              We're here to help everyday people invest and build wealth — one step at a time.
            </p>
          </div>

          <div className="w-full grid grid-cols-2 sm:grid-cols-4 gap-x-4 gap-y-8 max-w-4xl">
            {stats.map((stat, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.6, delay: i * 0.1 }}
                className="flex flex-col items-center gap-1 text-center"
              >
                <p className="text-3xl md:text-4xl font-bold text-white tracking-tight">{stat.value}</p>
                <p className="text-xs md:text-sm font-medium text-white/60">{stat.label}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* ═══════════════════════════════════════
          STORY SECTION
          ═══════════════════════════════════════ */}
      <section className="relative px-6 md:px-12 py-16 md:py-20 overflow-hidden">
        <div className="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
          <div className="lg:col-span-5">
            <h2 className="text-3xl md:text-4xl font-bold text-jeton-orange-900 leading-tight tracking-tight">
              We're changing the status quo.
            </h2>
          </div>
          <div className="lg:col-span-7 flex flex-col gap-5">
            <p className="text-base md:text-lg text-jeton-orange-900/70 leading-relaxed">
              Wealth creation systems — particularly investing — have historically been stacked against everyday people. The tools, advice, and opportunities available to the wealthy were simply out of reach for most.
            </p>
            <p className="text-base md:text-lg text-jeton-orange-900/70 leading-relaxed">
              Vestexa was built with a simple mission: make investing easy, affordable, and accessible for everyone. Today, we're helping thousands of people create a more secure financial future for themselves — with expert guidance, automated strategies, and transparent pricing.
            </p>
            <p className="text-xs text-jeton-orange-900/40 leading-relaxed border-t border-jeton-orange-50 mt-2 pt-4">
              As a registered investment advisor, Vestexa has a fiduciary duty — a legal obligation to act in your best interest. When we recommend a course of action, you can trust it's for your benefit, not ours.
            </p>
          </div>
        </div>
      </section>

      {/* ═══════════════════════════════════════
          CORE VALUES
          ═══════════════════════════════════════ */}
      <section className="bg-vestexa-peach px-6 md:px-12 py-16 md:py-20">
        <div className="max-w-5xl mx-auto">
          <h2 className="text-3xl md:text-4xl font-bold text-jeton-orange-900 leading-tight tracking-tight mb-8 md:mb-12">
            Our core values
          </h2>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            {coreValues.map((value, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.6, delay: i * 0.1 }}
                className="flex flex-col md:flex-row md:items-stretch overflow-hidden rounded-[20px] bg-white border border-vestexa-peach-border shadow-[2px_10px_14px_0px_rgba(247,59,32,0.06)]"
              >
                {/* Icon area */}
                <div className="relative flex items-center justify-center w-full h-32 md:w-48 md:h-auto shrink-0 bg-gradient-to-br from-[#F73B20] to-[#FA8270]">
                  <span className="material-symbols-outlined text-4xl text-white/90">{value.icon}</span>
                  <span className="absolute left-3 top-3 inline-flex items-center justify-center w-7 h-7 rounded-full bg-jeton-orange-900/80 text-white text-xs font-bold">
                    {value.num}
                  </span>
                </div>
                {/* Text */}
                <div className="flex flex-col justify-center gap-2 p-5 md:p-6">
                  <p className="text-lg md:text-xl font-bold text-jeton-orange-900 tracking-tight">{value.title}</p>
                  <p className="text-sm text-jeton-orange-900/65 leading-relaxed">{value.description}</p>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* ═══════════════════════════════════════
          COMMITMENT / FIDUCIARY CTA
          ═══════════════════════════════════════ */}
      <section className="relative px-6 md:px-12 py-16 md:py-20 overflow-hidden" style={{
        background: 'linear-gradient(135deg, #F73B20 0%, #360802 55%, #F96853 140%)',
      }}>
        {/* Ambient rings */}
        <div className="pointer-events-none absolute -right-16 -top-20 w-72 h-72 rounded-full border border-white/10" aria-hidden="true" />
        <div className="pointer-events-none absolute -right-6 -top-10 w-44 h-44 rounded-full border border-white/10" aria-hidden="true" />

        <div className="relative max-w-5xl mx-auto">
          <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div className="flex flex-col gap-3 max-w-lg">
              <p className="text-xs font-bold text-white/60 uppercase tracking-widest">Our commitment</p>
              <h2 className="text-3xl md:text-4xl font-bold text-white leading-tight tracking-tight">
                Putting your best interest first
              </h2>
              <p className="text-base text-white/75 leading-relaxed">
                As a registered investment advisor, we have a fiduciary duty: a legal obligation to act in your best interest. When we recommend a course of action, you can always trust that it's for your benefit, not ours.
              </p>
            </div>
            <Link
              to="/signup"
              className="btn btn-primary-white btn-animated !rounded-full !px-10 !h-14 text-base font-bold shadow-lg shrink-0"
            >
              Get Started Today
            </Link>
          </div>
        </div>
      </section>

      {/* Footer */}
      <Footer />
      <FloatingNavDrawer />
      <SupportLauncher />
    </div>
  );
};
