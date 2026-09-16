import React, { useEffect } from 'react';
import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { SvgWordmark } from '../components/SvgWordmark';
import { Footer } from '../components/Footer';
import { FloatingNavDrawer } from '../components/FloatingNavDrawer';
import { SupportLauncher } from '../components/SupportLauncher';
import { ScrollProgressBar } from '../components/ScrollProgressBar';
import Lenis from 'lenis';

/**
 * Services Page — Mirrors Stash's "What we offer" section.
 * Covers all investment services Vestexa provides.
 * No founder/team mentions.
 */

interface ServiceItem {
  icon: string;
  title: string;
  description: string;
  features: string[];
  gradient: string;
}

const services: ServiceItem[] = [
  {
    icon: 'trending_up',
    title: 'Stock & ETF Investing',
    description: 'Build wealth through a carefully diversified portfolio of individual stocks and exchange-traded funds. Access thousands of investment options with fractional share purchasing — start investing with any amount.',
    features: ['Fractional shares', 'Expert-curated selections', 'Real-time market data', 'Dividend reinvestment'],
    gradient: 'from-[#22C55E] to-[#16A34A]',
  },
  {
    icon: 'auto_awesome',
    title: 'Automated Investing',
    description: 'Set it and let it grow. Our Smart Portfolio automatically invests your contributions across a diversified mix of assets based on your risk profile. Automated rebalancing keeps your portfolio optimized without any effort.',
    features: ['Smart Portfolio allocation', 'Automated rebalancing', 'Recurring contributions', 'Tax-loss harvesting'],
    gradient: 'from-[#4985EF] to-[#3B7AE8]',
  },
  {
    icon: 'savings',
    title: 'Retirement Planning',
    description: 'Secure your future with tax-advantaged IRA accounts designed for long-term growth. Our retirement portfolios use optimized asset allocation strategies that automatically adjust as you approach your target retirement date.',
    features: ['Traditional & Roth IRA', 'Target-date allocation', 'Tax-advantaged growth', 'Retirement projections'],
    gradient: 'from-[#F73B20] to-[#E53518]',
  },
  {
    icon: 'psychology',
    title: 'AI Financial Guidance',
    description: 'Get real-time, personalized financial guidance whenever you need it. Our AI-powered financial advisor answers your questions, explains market movements, and provides actionable recommendations tailored to your specific situation.',
    features: ['24/7 availability', 'Personalized advice', 'Market explanations', 'Goal tracking'],
    gradient: 'from-[#8B5CF6] to-[#7C3AED]',
  },
  {
    icon: 'account_balance',
    title: 'Cash Management',
    description: 'Earn more on your uninvested cash with our high-yield cash management account. Your money is always accessible while earning competitive interest rates — a smarter alternative to traditional savings accounts.',
    features: ['Competitive APY', 'FDIC-eligible coverage', 'No minimum balance', 'Instant access'],
    gradient: 'from-[#F59E0B] to-[#D97706]',
  },
  {
    icon: 'school',
    title: 'Financial Education',
    description: 'Build financial literacy alongside your portfolio. Access a comprehensive library of investing guides, market analysis, and educational content designed to help you make informed decisions with confidence.',
    features: ['Investing guides', 'Market analysis', 'Video tutorials', 'Glossary & tools'],
    gradient: 'from-[#EC4899] to-[#DB2777]',
  },
];

export const ServicesPage: React.FC = () => {
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
          HERO
          ═══════════════════════════════════════ */}
      <section className="relative overflow-hidden" style={{
        background: 'linear-gradient(135deg, #FFF6F5 0%, #FEE9E6 50%, #FFF6F5 100%)',
      }}>
        {/* Ambient glows */}
        <div className="absolute top-[-10%] right-[-5%] w-[40vw] h-[40vw] rounded-full bg-[#F73B20]/8 blur-[120px] pointer-events-none" />
        <div className="absolute bottom-[-15%] left-[-10%] w-[45vw] h-[45vw] rounded-full bg-[#FA8270]/10 blur-[140px] pointer-events-none" />

        <div className="relative max-w-5xl mx-auto px-6 md:px-12 py-20 md:py-28 flex flex-col items-center text-center gap-6">
          {/* Logo */}
          <Link to="/" className="inline-flex mb-2 hover:opacity-90 transition-opacity">
            <SvgWordmark tone="orange" brand="vestexa" className="!h-[28px]" />
          </Link>

          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.85, ease: [0.22, 1, 0.36, 1] }}
            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#F73B20]/10 text-[#F73B20] text-xs font-bold uppercase tracking-wider"
          >
            <span className="material-symbols-outlined text-sm">star</span>
            <span>What We Offer</span>
          </motion.div>

          <motion.h1
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.85, ease: [0.22, 1, 0.36, 1], delay: 0.1 }}
            className="text-4xl md:text-5xl xl:text-6xl font-bold leading-[1.05] tracking-tight text-jeton-orange-900 max-w-3xl"
          >
            All the perks of a financial advisor, at a fraction of the cost
          </motion.h1>

          <motion.p
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.85, ease: [0.22, 1, 0.36, 1], delay: 0.2 }}
            className="text-base md:text-lg text-jeton-orange-900/65 leading-relaxed max-w-xl"
          >
            Vestexa offers professional investment advisory services for a simple, transparent fee. Other financial advisors typically cost $2,500+ per year — we give you the same quality guidance for a fraction of that.
          </motion.p>

          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.85, ease: [0.22, 1, 0.36, 1], delay: 0.3 }}
          >
            <Link
              to="/signup"
              className="btn btn-primary-orange btn-animated !rounded-full !px-10 !h-14 text-base font-bold shadow-pill"
            >
              Get Started in Minutes
            </Link>
          </motion.div>
        </div>
      </section>

      {/* ═══════════════════════════════════════
          SERVICES GRID
          ═══════════════════════════════════════ */}
      <section className="px-6 md:px-12 py-16 md:py-24">
        <div className="max-w-6xl mx-auto">
          <div className="text-center mb-12 md:mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-jeton-orange-900 tracking-tight">
              Everything you need to invest with confidence
            </h2>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
            {services.map((service, i) => (
              <motion.article
                key={i}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true, margin: '-50px' }}
                transition={{ duration: 0.6, delay: i * 0.08 }}
                className="group relative bg-white border border-vestexa-peach-border rounded-[24px] p-6 md:p-8 shadow-glass hover:shadow-glow transition-all duration-300 hover:-translate-y-1 flex flex-col"
              >
                {/* Icon */}
                <div className={`w-14 h-14 rounded-2xl bg-gradient-to-br ${service.gradient} flex items-center justify-center mb-5 shadow-lg group-hover:scale-105 transition-transform`}>
                  <span className="material-symbols-outlined text-2xl text-white">{service.icon}</span>
                </div>

                <h3 className="text-xl font-bold text-jeton-orange-900 tracking-tight mb-3">{service.title}</h3>
                <p className="text-sm text-jeton-orange-900/60 leading-relaxed mb-5 flex-1">{service.description}</p>

                {/* Feature tags */}
                <div className="flex flex-wrap gap-2">
                  {service.features.map((feature, fi) => (
                    <span
                      key={fi}
                      className="inline-flex items-center px-3 py-1 rounded-full bg-vestexa-peach text-jeton-orange-900/70 text-[11px] font-semibold border border-vestexa-peach-border"
                    >
                      {feature}
                    </span>
                  ))}
                </div>
              </motion.article>
            ))}
          </div>
        </div>
      </section>

      {/* ═══════════════════════════════════════
          SOCIAL PROOF / JOIN CTA
          ═══════════════════════════════════════ */}
      <section className="bg-jeton-orange px-6 md:px-12 py-16 md:py-20">
        <div className="max-w-3xl mx-auto flex flex-col items-center text-center gap-6">
          <h2 className="text-3xl md:text-4xl font-bold text-white tracking-tight">
            Join thousands of investors making confident moves
          </h2>
          <p className="text-base text-white/80 leading-relaxed max-w-lg">
            Start investing today with expert guidance, automated strategies, and a clear plan for your financial future. No experience required.
          </p>
          <Link
            to="/signup"
            className="btn btn-primary-white btn-animated !rounded-full !px-10 !h-14 text-base font-bold shadow-lg"
          >
            Get Started
          </Link>
        </div>
      </section>

      {/* ═══════════════════════════════════════
          FIDUCIARY COMMITMENT
          ═══════════════════════════════════════ */}
      <section className="px-6 md:px-12 py-16 md:py-20">
        <div className="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
          <div className="flex flex-col gap-4">
            <p className="text-xs font-bold text-jeton-orange/80 uppercase tracking-widest">Our commitment</p>
            <h2 className="text-3xl md:text-4xl font-bold text-jeton-orange-900 leading-tight tracking-tight">
              Putting your best interest first
            </h2>
            <p className="text-base text-jeton-orange-900/65 leading-relaxed">
              As a registered investment advisor, we have a fiduciary duty: a legal obligation to act in your best interest. When we recommend a course of action, you can always trust that it's for your benefit, not ours.
            </p>
            <Link
              to="/signup"
              className="btn btn-primary-orange btn-animated !rounded-full !px-8 !h-12 text-sm font-bold shadow-pill mt-2 w-fit"
            >
              Get Started
            </Link>
          </div>

          {/* Visual card */}
          <div className="relative rounded-[28px] overflow-hidden" style={{
            background: 'linear-gradient(135deg, #F73B20 0%, #F96853 50%, #FA8270 100%)',
          }}>
            <div className="p-8 md:p-12 flex flex-col gap-6">
              <div className="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur-md flex items-center justify-center border border-white/20">
                <span className="material-symbols-outlined text-3xl text-white">verified_user</span>
              </div>
              <div className="flex flex-col gap-3">
                <h3 className="text-2xl font-bold text-white">Fiduciary Standard</h3>
                <p className="text-sm text-white/80 leading-relaxed">
                  Unlike brokers who only need to recommend "suitable" investments, Vestexa is held to the fiduciary standard — the highest legal standard of care in the financial industry.
                </p>
              </div>
              <div className="flex flex-wrap gap-2 mt-2">
                {['Transparency', 'No Conflicts', 'Your Best Interest', 'Full Disclosure'].map((tag, i) => (
                  <span key={i} className="inline-flex items-center px-3 py-1.5 rounded-full bg-white/12 backdrop-blur-sm border border-white/10 text-white text-xs font-medium">
                    {tag}
                  </span>
                ))}
              </div>
            </div>
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
