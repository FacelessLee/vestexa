import React, { useRef, useEffect, useState } from 'react';
import { motion, useScroll, useTransform, useSpring } from 'framer-motion';
import { FallingFlagsCanvas } from './FallingFlagsCanvas';

/**
 * HeroIntroduction — Exact architectural replication of Jeton.com's `_hero-introduction`.
 *
 * Structure:
 * 1. <header> (height: 200vh, margin-bottom: -40vh):
 *    - .sticky-slot (height: 100vh, sticky top: 0):
 *      - .title: "Unify your\nfinances" starts scaled up (2x desktop / 1.15x mobile),
 *        scales down to 0.3x as cards converge, and fades out at scroll ~0.8.
 *      - .snippets: 5 snippet cards positioned at CSS percentages, starting at outer
 *        perimeter offsets and smoothly gliding inward to form the center cluster.
 *      - Mobile Falling Flags: Hardware-accelerated canvas simulation with circular currency
 *        flag badges (USD, EUR, GBP, CAD, AUD, CHF, SGD, PLN, BRL, NOK) tumbling down on scroll.
 * 2. <main>:
 *    - ul.taglines (CSS sticky stacking):
 *      - 4 taglines: "Invest", "Grow", "Plan", "Build your wealth"
 *      - Sticky positioning with translateY(calc((var(--index) - var(--items)*0.5)*1.1em))
 *        locking into a vertically centered stack as each item scrolls into view.
 */

interface TaglineItemConfig {
  id: string;
  label: string;
  color: string;
  icon: React.ReactNode;
}

const taglinesList: TaglineItemConfig[] = [
  {
    id: 'invest',
    label: 'Invest',
    color: '#34C771',
    icon: (
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round">
        <line x1="12" y1="5" x2="12" y2="19" />
        <line x1="5" y1="12" x2="19" y2="12" />
      </svg>
    ),
  },
  {
    id: 'grow',
    label: 'Grow',
    color: '#477EE9',
    icon: (
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
        <line x1="7" y1="17" x2="17" y2="7" />
        <polyline points="7 7 17 7 17 17" />
      </svg>
    ),
  },
  {
    id: 'plan',
    label: 'Plan',
    color: '#FB2D54',
    icon: (
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
        <path d="M4 17h16" />
        <polyline points="14 11 20 17 14 23" />
        <path d="M20 7H4" />
        <polyline points="10 13 4 7 10 1" />
      </svg>
    ),
  },
  {
    id: 'wealth',
    label: 'Build your wealth',
    color: '#8B5CF6',
    icon: (
      <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 2l2.4 7.2h7.6l-6.1 4.5 2.3 7.3-6.2-4.6-6.2 4.6 2.3-7.3-6.1-4.5h7.6z" />
      </svg>
    ),
  },
];

export const HeroIntroduction: React.FC = () => {
  const headerRef = useRef<HTMLElement>(null);
  const [isMobile, setIsMobile] = useState(false);

  useEffect(() => {
    const checkMobile = () => setIsMobile(window.innerWidth < 1024);
    checkMobile();
    window.addEventListener('resize', checkMobile);
    return () => window.removeEventListener('resize', checkMobile);
  }, []);

  const { scrollYProgress: headerProgress } = useScroll({
    target: headerRef,
    offset: ['start start', 'end end'],
  });

  const smoothProgress = useSpring(headerProgress, {
    stiffness: 120,
    damping: 24,
    mass: 0.2,
  });

  // Title scale & opacity transforms
  const titleScale = useTransform(
    smoothProgress,
    [0, 0.75],
    [isMobile ? 1.15 : 2.0, isMobile ? 0.45 : 0.3]
  );
  const titleOpacity = useTransform(smoothProgress, [0, 0.65, 0.78], [1, 1, 0]);

  // Snippets inward convergence:
  // Initial perimeter offsets (derived directly from Jeton runtime coordinates)
  // Card 1: Deposit (Top Left)
  const card1X = useTransform(smoothProgress, [0, 0.8], [isMobile ? -90 : -244, 0]);
  const card1Y = useTransform(smoothProgress, [0, 0.8], [isMobile ? -140 : -213, 0]);

  // Card 2: Send (Top Right)
  const card2X = useTransform(smoothProgress, [0, 0.8], [isMobile ? 80 : 264, 0]);
  const card2Y = useTransform(smoothProgress, [0, 0.8], [isMobile ? -150 : -242, 0]);

  // Card 3: Pay / Enjoy the coffee (Bottom Right)
  const card3X = useTransform(smoothProgress, [0, 0.8], [isMobile ? 120 : 424, 0]);
  const card3Y = useTransform(smoothProgress, [0, 0.8], [isMobile ? 160 : 232, 0]);

  // Card 4: Jane Thomas (Bottom Left)
  const card4X = useTransform(smoothProgress, [0, 0.8], [isMobile ? -110 : -207, 0]);
  const card4Y = useTransform(smoothProgress, [0, 0.8], [isMobile ? 140 : 271, 0]);

  // Card 5: Exchange / Laptop (Middle Left)
  const card5X = useTransform(smoothProgress, [0, 0.8], [isMobile ? -140 : -232, 0]);
  const card5Y = useTransform(smoothProgress, [0, 0.8], [isMobile ? -20 : -2.5, 0]);

  // Snippets scale slightly into final tight cluster
  const snippetsScale = useTransform(smoothProgress, [0.65, 0.95], [1, 0.88]);

  return (
    <section id="intro" className="_hero-introduction relative bg-white overflow-clip">
      {/* 1. Pinned Header: Title shrinks while 5 snippets converge */}
      <header ref={headerRef} className="relative">
        <div className="sticky-slot relative flex flex-col justify-center items-center overflow-hidden">
          {/* Ambient subtle warm backlight */}
          <div className="absolute inset-0 bg-gradient-to-b from-jeton-orange-50/25 via-white to-transparent pointer-events-none" />

          {/* Centered Headline "Unify your finances" */}
          <div className="title h-full w-full flex items-center justify-center text-center overflow-hidden pointer-events-none z-10 px-4">
            <motion.h2
              style={{ scale: titleScale, opacity: titleOpacity }}
              className="-medium relative whitespace-pre-line text-jeton-orange font-medium tracking-tight will-change-transform select-none"
            >
              Unify your{'\n'}finances
            </motion.h2>
          </div>

          {/* 5 Converging Snippet Cards */}
          <motion.ul
            style={{ scale: snippetsScale }}
            className="snippets absolute inset-0 pointer-events-none z-20"
          >
            {/* Snippet 1: Green Deposit / Exchange Approved Card */}
            <li>
              <motion.div
                style={{ x: card1X, y: card1Y }}
                className="snippet will-change-transform"
              >
                <img
                  src="/snippets/deposit.png"
                  alt="Deposit snippet"
                  width={600}
                  height={500}
                  className="w-full h-auto drop-shadow-xl select-none"
                  loading="eager"
                />
              </motion.div>
            </li>

            {/* Snippet 2: Blue Send / EUR Balance Card */}
            <li>
              <motion.div
                style={{ x: card2X, y: card2Y }}
                className="snippet will-change-transform"
              >
                <img
                  src="/snippets/send.png"
                  alt="Send snippet"
                  width={660}
                  height={684}
                  className="w-full h-auto drop-shadow-xl select-none"
                  loading="eager"
                />
              </motion.div>
            </li>

            {/* Snippet 3: Pay / Enjoy the coffee Lifestyle Photo */}
            <li>
              <motion.div
                style={{ x: card3X, y: card3Y }}
                className="snippet will-change-transform"
              >
                <img
                  src="/snippets/pay.png"
                  alt="Pay snippet"
                  width={720}
                  height={720}
                  className="w-full h-auto drop-shadow-xl select-none rounded-2xl"
                  loading="eager"
                />
              </motion.div>
            </li>

            {/* Snippet 4: Pink Jane Thomas Secure Send Card */}
            <li>
              <motion.div
                style={{ x: card4X, y: card4Y }}
                className="snippet will-change-transform"
              >
                <img
                  src="/snippets/secure_send.png"
                  alt="Secure Send snippet"
                  width={660}
                  height={627}
                  className="w-full h-auto drop-shadow-xl select-none"
                  loading="eager"
                />
              </motion.div>
            </li>

            {/* Snippet 5: Exchange / Laptop Workspace Photo */}
            <li>
              <motion.div
                style={{ x: card5X, y: card5Y }}
                className="snippet will-change-transform"
              >
                <img
                  src="/snippets/exchange.png"
                  alt="Exchange snippet"
                  width={660}
                  height={660}
                  className="w-full h-auto drop-shadow-xl select-none rounded-2xl"
                  loading="eager"
                />
              </motion.div>
            </li>
          </motion.ul>

          {/* Mobile Falling Round Flags Physics Simulation */}
          <FallingFlagsCanvas />
        </div>
      </header>

      {/* 2. Main: Sticky Stacking Taglines */}
      <main className="relative z-30">
        <ul
          className="taglines flex flex-col items-center select-none"
          style={{ '--items': taglinesList.length } as React.CSSProperties}
        >
          {taglinesList.map((tagline, idx) => (
            <TaglineItem key={tagline.id} item={tagline} index={idx} />
          ))}
          {/* Spacer ending element matching Jeton DOM */}
          <li aria-hidden="true" />
        </ul>
      </main>
    </section>
  );
};

interface TaglineItemProps {
  item: TaglineItemConfig;
  index: number;
}

const TaglineItem: React.FC<TaglineItemProps> = ({ item, index }) => {
  const itemRef = useRef<HTMLLIElement>(null);

  const { scrollYProgress } = useScroll({
    target: itemRef,
    offset: ['start end', 'start center'],
  });

  const y = useTransform(scrollYProgress, [0, 1], ['60%', '0%']);
  const opacity = useTransform(scrollYProgress, [0, 1], [0.5, 1]);

  return (
    <li
      ref={itemRef}
      style={
        {
          '--color': item.color,
          '--index': index,
        } as React.CSSProperties
      }
    >
      <motion.div
        style={{ y, opacity }}
        className="flex gap-4 sm:gap-6 items-center will-change-transform"
      >
        <div
          className="icon-card grid place-center text-white shadow-lg shrink-0"
          style={{ backgroundColor: item.color }}
        >
          <span className="flex items-center justify-center w-full h-full text-white">
            {item.icon}
          </span>
        </div>
        <h3 className="-medium whitespace-nowrap">
          {item.label}
        </h3>
      </motion.div>
    </li>
  );
};
