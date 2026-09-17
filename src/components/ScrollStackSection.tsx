import React, { useRef } from 'react';
import { motion, useScroll, useTransform, MotionValue } from 'framer-motion';

/**
 * ScrollStackSection — Mirrors Jeton's _scroll-stack component.
 *
 * Full-viewport views that stack on top of each other as the user scrolls.
 * Alternating orange gradients (#F96853 and #FA8270), numbered labels (01-04),
 * and rich interactive feature previews on each panel.
 */

interface StackView {
  num: string;
  title: string;
  subtitle: string;
  badge: string;
  description: string;
  features: string[];
  bgColor: string;
  visualType: 'deposit' | 'transfer' | 'exchange' | 'card';
}

const views: StackView[] = [
  {
    num: '01',
    title: 'A plan that works for you',
    subtitle: 'Personalized Investment Strategy',
    badge: 'Tailored To Your Goals',
    description: 'We build you an investment strategy tailored to your goals, timeline, and risk tolerance. Whether you\'re saving for retirement, a home, or simply building wealth — your portfolio is designed around your life, not a one-size-fits-all template.',
    features: ['Goal-based portfolio design', 'Risk-adjusted allocation', 'Expert-curated diversification', 'Regular rebalancing'],
    bgColor: '#F96853',
    visualType: 'deposit',
  },
  {
    num: '02',
    title: 'Actionable next steps',
    subtitle: 'Clear Recommendations',
    badge: 'No More Guessing',
    description: 'We give you clear, actionable recommendations so you never feel like you\'re guessing. Know exactly what to invest in, how much to contribute, and when to adjust your strategy — with guidance backed by data and expertise.',
    features: ['Step-by-step investing guidance', 'Contribution recommendations', 'Portfolio optimization alerts', 'Market insight notifications'],
    bgColor: '#FA8270',
    visualType: 'transfer',
  },
  {
    num: '03',
    title: 'Help staying on track',
    subtitle: 'Automated Investing',
    badge: 'Set It & Grow',
    description: 'We automate your investing and guide you to stay consistent over time. Set up recurring contributions that automatically invest according to your strategy. Consistency is the key to long-term wealth building, and we make it effortless.',
    features: ['Automated recurring investments', 'Smart portfolio rebalancing', 'Progress tracking dashboards', 'Milestone celebrations'],
    bgColor: '#F96853',
    visualType: 'exchange',
  },
  {
    num: '04',
    title: 'Answers to your questions',
    subtitle: 'AI-Powered Financial Guidance',
    badge: 'Real-Time Advice',
    description: 'Our intelligent financial advisor gives you real-time guidance whenever you need it. Ask questions about your investments, get explanations about market movements, and receive personalized recommendations — all powered by advanced AI technology.',
    features: ['24/7 AI financial advisor', 'Real-time market insights', 'Personalized recommendations', 'Financial education resources'],
    bgColor: '#FA8270',
    visualType: 'card',
  },
];

const StackViewVisual: React.FC<{ type: StackView['visualType'] }> = ({ type }) => {
  if (type === 'deposit') {
    return (
      <div className="w-full max-w-[320px] sm:max-w-sm rounded-2xl bg-white/15 backdrop-blur-md border border-white/30 p-4 sm:p-7 shadow-2xl flex flex-col justify-between">
        <div className="flex items-center justify-between pb-3 border-b border-white/20">
          <div className="flex items-center gap-2.5">
            <div className="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-emerald-400 text-jeton-orange-900 flex items-center justify-center font-bold text-sm sm:text-base">
              ↓
            </div>
            <div>
              <div className="text-white font-semibold text-xs sm:text-sm">Incoming Wire</div>
              <div className="text-white/70 text-[10px] sm:text-xs">Direct ACH / SEPA Instant</div>
            </div>
          </div>
          <span className="px-2 py-0.5 rounded-full bg-emerald-500/25 text-emerald-100 text-[10px] sm:text-xs font-bold">
            Success
          </span>
        </div>

        <div className="py-3 sm:py-5">
          <div className="text-[10px] sm:text-xs text-white/70 mb-0.5">Received Amount</div>
          <div className="text-xl sm:text-3xl font-extrabold text-white tracking-tight">+$15,000.00</div>
          <div className="text-[10px] sm:text-xs text-white/80 mt-0.5 truncate">From: Apex Holding Group (US ACH)</div>
        </div>

        <div className="pt-2.5 border-t border-white/15 flex items-center justify-between text-[10px] sm:text-xs text-white/80">
          <span>Fee: $0.00</span>
          <span>Settlement: Instant</span>
        </div>
      </div>
    );
  }

  if (type === 'transfer') {
    return (
      <div className="w-full max-w-[320px] sm:max-w-sm rounded-2xl bg-white/15 backdrop-blur-md border border-white/30 p-4 sm:p-7 shadow-2xl flex flex-col justify-between">
        <div className="flex items-center justify-between pb-3 border-b border-white/20">
          <div className="flex items-center gap-2.5">
            <div className="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-blue-400 text-jeton-orange-900 flex items-center justify-center font-bold text-sm sm:text-base">
              ↗
            </div>
            <div>
              <div className="text-white font-semibold text-xs sm:text-sm">Global Outbound</div>
              <div className="text-white/70 text-[10px] sm:text-xs">London &rarr; Tokyo</div>
            </div>
          </div>
          <span className="px-2 py-0.5 rounded-full bg-blue-400/25 text-blue-100 text-[10px] sm:text-xs font-bold">
            Live FX
          </span>
        </div>

        <div className="py-2.5 sm:py-4 space-y-2">
          <div className="flex items-center justify-between bg-white/15 px-3 py-2 rounded-xl">
            <span className="text-[10px] sm:text-xs text-white/70">You Sent:</span>
            <span className="text-xs sm:text-sm font-bold text-white">£4,200.00 GBP</span>
          </div>
          <div className="flex items-center justify-between bg-white/15 px-3 py-2 rounded-xl">
            <span className="text-[10px] sm:text-xs text-white/70">Delivered:</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-200">¥810,420 JPY</span>
          </div>
        </div>

        <div className="pt-2.5 border-t border-white/15 flex items-center justify-between text-[10px] sm:text-xs text-white/80">
          <span>Delivery: 12 seconds</span>
          <span>Status: Completed</span>
        </div>
      </div>
    );
  }

  if (type === 'exchange') {
    return (
      <div className="w-full max-w-[320px] sm:max-w-sm rounded-2xl bg-white/15 backdrop-blur-md border border-white/30 p-4 sm:p-7 shadow-2xl flex flex-col justify-between">
        <div className="flex items-center justify-between pb-3 border-b border-white/20">
          <div className="flex items-center gap-2.5">
            <div className="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-amber-400 text-jeton-orange-900 flex items-center justify-center font-bold text-sm sm:text-base">
              ⇄
            </div>
            <div>
              <div className="text-white font-semibold text-xs sm:text-sm">Spot Conversion</div>
              <div className="text-white/70 text-[10px] sm:text-xs">EUR / USD Interbank</div>
            </div>
          </div>
          <span className="px-2 py-0.5 rounded-full bg-amber-400/25 text-amber-100 text-[10px] sm:text-xs font-bold">
            0.3% Fee
          </span>
        </div>

        <div className="py-2.5 sm:py-4">
          <div className="flex items-baseline justify-between mb-1.5">
            <span className="text-[10px] sm:text-xs text-white/70">Interbank Rate</span>
            <span className="text-xs sm:text-sm font-bold text-white">1 EUR = 1.0864 USD</span>
          </div>
          {/* Sparkline */}
          <div className="h-8 sm:h-12 w-full flex items-end gap-1 pt-1">
            {[40, 55, 45, 60, 75, 70, 85, 95, 90, 100].map((h, i) => (
              <div
                key={i}
                className="flex-1 bg-white/50 rounded-t-sm transition-all hover:bg-white"
                style={{ height: `${h}%` }}
              />
            ))}
          </div>
        </div>

        <div className="pt-2.5 border-t border-white/15 flex items-center justify-between text-[10px] sm:text-xs text-white/80">
          <span>Spread: 0.00%</span>
          <span>Execution: Instant</span>
        </div>
      </div>
    );
  }

  // Metal Card Visual
  return (
    <div className="w-full max-w-[320px] sm:max-w-sm rounded-2xl bg-gradient-to-tr from-[#1E1E24] via-[#2B2D42] to-[#111115] border border-amber-400/30 p-4 sm:p-7 shadow-2xl text-white relative overflow-hidden group">
      <div className="flex justify-between items-start mb-4 sm:mb-8 relative z-10">
        <div>
          <span className="text-[9px] sm:text-caption font-bold tracking-widest uppercase text-amber-300">Vestexa Metal</span>
          <div className="text-xs sm:text-subhead-3 font-semibold text-white mt-0.5">World Elite</div>
        </div>
        <svg className="w-5 h-5 sm:w-7 sm:h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
        </svg>
      </div>

      <div className="w-9 h-6 sm:w-11 sm:h-8 rounded-md bg-gradient-to-br from-amber-200 via-amber-400 to-amber-600 border border-amber-500/50 mb-4 sm:mb-8 shadow-inner" />

      <div className="space-y-1 relative z-10">
        <div className="font-mono tracking-widest text-xs sm:text-body font-medium text-white/95">
          •••• •••• •••• 8842
        </div>
        <div className="flex justify-between items-end pt-1.5 sm:pt-2">
          <div>
            <div className="text-[8px] sm:text-[9px] uppercase tracking-wider text-white/60 font-semibold">Cardholder</div>
            <div className="text-xs sm:text-body-small font-medium tracking-wide">VESTEXA MEMBER</div>
          </div>
          <div className="flex items-center -space-x-1.5 sm:-space-x-2">
            <span className="w-5 h-5 sm:w-7 sm:h-7 rounded-full bg-[#EB001B] opacity-90 inline-block" />
            <span className="w-5 h-5 sm:w-7 sm:h-7 rounded-full bg-[#F79E1B] opacity-90 inline-block" />
          </div>
        </div>
      </div>
    </div>
  );
};

interface StackCardProps {
  view: StackView;
  idx: number;
  total: number;
  scrollYProgress: MotionValue<number>;
}

const StackCard: React.FC<StackCardProps> = ({ view, idx, total, scrollYProgress }) => {
  const step = 1 / total;
  const start = idx * step;
  const nextStart = (idx + 1) * step;

  // Translation from bottom
  const y = useTransform(
    scrollYProgress,
    idx === 0
      ? [0, nextStart]
      : [Math.max(0, start - 0.15), start, nextStart],
    idx === 0
      ? ['0%', '-3%']
      : ['100%', '0%', '-3%']
  );

  const scale = useTransform(
    scrollYProgress,
    [start, nextStart],
    [1, idx < total - 1 ? 0.96 : 1]
  );

  return (
    <motion.div
      className="absolute inset-0 will-change-transform shadow-2xl overflow-hidden"
      style={{
        y,
        scale,
        opacity: 1, // Solid 100% opacity prevents underlying card text bleed-through!
        zIndex: idx + 1,
        backgroundColor: view.bgColor,
        borderRadius: '20px',
      }}
    >
      <div className="h-full flex flex-col justify-between p-4 sm:p-8 lg:p-12 relative select-none">
        {/* Top bar with index badge */}
        <div className="flex items-center justify-between pb-3 sm:pb-5 border-b border-white/15">
          <div className="flex items-center gap-2.5 sm:gap-3">
            <span className="inline-flex items-center justify-center w-7 h-7 sm:w-9 sm:h-9 rounded-full border border-white text-white text-xs sm:text-caption font-bold bg-white/15">
              {view.num}
            </span>
            <span className="text-white text-xs sm:text-body font-semibold truncate max-w-[170px] sm:max-w-none">{view.title}</span>
          </div>
          <span className="px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full bg-white/20 text-white text-[10px] sm:text-caption font-semibold backdrop-blur-sm shrink-0">
            {view.badge}
          </span>
        </div>

        {/* Center content grid */}
        <div className="flex-1 flex items-center my-2 sm:my-6 overflow-hidden">
          <div className="grid lg:grid-cols-12 gap-4 sm:gap-8 lg:gap-12 w-full max-w-6xl mx-auto items-center">
            {/* Left text column */}
            <div className="lg:col-span-7 flex flex-col justify-center text-left">
              <span className="text-white/80 text-[10px] sm:text-caption uppercase tracking-wider font-semibold mb-1">
                {view.subtitle}
              </span>
              <h3 className="text-xl sm:text-3xl lg:text-4xl text-white font-bold mb-2 sm:mb-3 leading-tight tracking-tight">
                {view.title}
              </h3>
              <p className="text-xs sm:text-body text-white/90 mb-3 sm:mb-6 max-w-xl font-normal leading-relaxed line-clamp-3 sm:line-clamp-none">
                {view.description}
              </p>
              
              {/* Feature Perks: Compact 2-column list on mobile, all on desktop */}
              <div className="grid grid-cols-2 gap-2 sm:gap-3">
                {view.features.map((feat, fidx) => (
                  <div
                    key={fidx}
                    className={`items-center gap-1.5 sm:gap-2.5 text-[11px] sm:text-body-small text-white font-medium ${
                      fidx >= 2 ? 'hidden sm:flex' : 'flex'
                    }`}
                  >
                    <span className="w-1.5 h-1.5 rounded-full bg-white shrink-0" />
                    <span className="truncate">{feat}</span>
                  </div>
                ))}
              </div>
            </div>

            {/* Right column: Interactive Visual Card */}
            <div className="lg:col-span-5 flex items-center justify-center pt-2 lg:pt-0">
              <StackViewVisual type={view.visualType} />
            </div>
          </div>
        </div>

        {/* Bottom indicator */}
        <div className="pt-3 sm:pt-4 border-t border-white/15 flex items-center justify-between text-[10px] sm:text-caption text-white/80">
          <span className="truncate">Vestexa Global Treasury</span>
          <span className="font-semibold shrink-0">Card {view.num} of 0{total} • Scroll ▾</span>
        </div>
      </div>
    </motion.div>
  );
};

export const ScrollStackSection: React.FC = () => {
  const containerRef = useRef<HTMLDivElement>(null);
  const viewCount = views.length;

  const { scrollYProgress } = useScroll({
    target: containerRef,
    offset: ['start start', 'end end'],
  });

  return (
    <section
      ref={containerRef}
      id="features"
      className="scroll-stack relative bg-white"
      style={{ height: `${viewCount * 120}vh` }}
    >
      {/* Sticky viewport container with dynamic viewport height */}
      <div
        className="views-slot"
        style={{
          borderRadius: '20px',
          height: 'calc(100vh - var(--viewport-margin, 10px) * 2)',
          left: 'var(--viewport-margin, 10px)',
          overflow: 'hidden',
          position: 'sticky',
          top: 'var(--viewport-margin, 10px)',
          width: 'calc(100vw - var(--viewport-margin, 10px) * 2)',
        }}
      >
        {views.map((view, idx) => (
          <StackCard
            key={view.num}
            view={view}
            idx={idx}
            total={viewCount}
            scrollYProgress={scrollYProgress}
          />
        ))}
      </div>
    </section>
  );
};
