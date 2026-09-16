import React, { useEffect, useState, useRef } from 'react';
import Lenis from 'lenis';
import { RegulatoryNoticeModal } from '../components/RegulatoryNoticeModal';
import { ScrollProgressBar } from '../components/ScrollProgressBar';
import { HeroSection } from '../components/HeroSection';
import { HeroIntroduction } from '../components/HeroIntroduction';
import { ScrollStackSection } from '../components/ScrollStackSection';
import { CurrencyExchangeCalculator } from '../components/CurrencyExchangeCalculator';
import { TestimonialStackSection } from '../components/TestimonialStackSection';
import { FaqAccordion } from '../components/FaqAccordion';
import { Footer } from '../components/Footer';
import { FloatingNavDrawer } from '../components/FloatingNavDrawer';
import { SupportLauncher } from '../components/SupportLauncher';

export const LandingPage: React.FC = () => {
  const [isNoticeAccepted, setIsNoticeAccepted] = useState<boolean>(() => {
    return sessionStorage.getItem('vestexa_regulatory_accepted') === 'true';
  });
  const lenisRef = useRef<Lenis | null>(null);

  useEffect(() => {
    // Lenis smooth scroll engine matching smooth-scrolling experience
    const lenis = new Lenis({
      duration: 1.1,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      smoothWheel: true,
      wheelMultiplier: 1,
      touchMultiplier: 1.2,
      syncTouch: true,
    });
    lenisRef.current = lenis;

    // If notice has not yet been accepted, immediately stop scrolling
    if (!isNoticeAccepted) {
      lenis.stop();
      document.body.style.overflow = 'hidden';
    }

    function raf(time: number) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);

    return () => {
      lenis.destroy();
      lenisRef.current = null;
      document.body.style.overflow = '';
    };
  }, []);

  useEffect(() => {
    if (!isNoticeAccepted) {
      document.body.style.overflow = 'hidden';
      lenisRef.current?.stop();
    } else {
      document.body.style.overflow = '';
      lenisRef.current?.start();
    }
  }, [isNoticeAccepted]);

  const handleContinue = () => {
    sessionStorage.setItem('vestexa_regulatory_accepted', 'true');
    setIsNoticeAccepted(true);
    document.body.style.overflow = '';
    lenisRef.current?.start();
  };

  return (
    <div className="min-h-screen bg-white text-jeton-orange-900 font-sans relative selection:bg-[#A21906] selection:text-white">
      {/* Top Precision Reading Progress Bar */}
      <ScrollProgressBar />

      {/* Site-Wide Regulatory Notice Gating Modal */}
      <RegulatoryNoticeModal
        isOpen={!isNoticeAccepted}
        onContinue={handleContinue}
      />

      {/* Main Website Contents — restricted and inert until user clicks Continue */}
      <div
        className={`transition-all duration-500 ${
          !isNoticeAccepted
            ? 'filter blur-[3px] pointer-events-none select-none'
            : 'filter-none pointer-events-auto'
        }`}
        {...(!isNoticeAccepted ? { 'aria-hidden': true } : {})}
      >
        {/* 1. Full-bleed Peach/Blush Hero Section with integrated Header */}
        <HeroSection />

        {/* 2. Scroll-Driven Hero Introduction (Taglines & Snippet Cards) */}
        <HeroIntroduction />

        {/* 3. Scroll-Stack Section (01-04 Stacking Full-Viewport Panels) */}
        <ScrollStackSection />

        {/* 4. Multi-Currency Spot FX Exchange & Fee Calculator */}
        <CurrencyExchangeCalculator />

        {/* 5. Client Testimonials on Solid Orange with Glass Cards */}
        <TestimonialStackSection />

        {/* 6. Frequently Asked Questions Accordion */}
        <FaqAccordion />

        {/* 7. Full Footer with Mobile Accordion, Partnerships & Certifications */}
        <Footer />

        {/* 8. Bottom Floating Pill Navigation Bar & Drawers */}
        <FloatingNavDrawer />

        {/* 9. Fixed Bottom-Right 24/7 Client Support Launcher */}
        <SupportLauncher />
      </div>
    </div>
  );
};

