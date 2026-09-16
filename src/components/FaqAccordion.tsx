import React, { useState, useRef, useCallback, useEffect } from 'react';

/**
 * FaqAccordion — Mirrors Jeton's _faq-accordion.
 *
 * - White text on solid #F73B20 orange background
 * - Custom + icon with animated rotation/scale
 * - Smooth dynamic height animation
 * - Numbered index badges (01-06)
 * - Border-top separators between items
 */

interface FaqItem {
  question: string;
  answer: string;
}

const faqItems: FaqItem[] = [
  {
    question: 'What is Vestexa and how does it work?',
    answer: 'Vestexa is an investment advisory platform that provides professional financial guidance, automated portfolio management, and easy investing tools for everyone. We build you a personalized investment plan based on your goals, timeline, and risk tolerance — then help you stay on track with automated investing and real-time guidance. Think of it as having a financial advisor in your pocket.',
  },
  {
    question: 'How does automated investing work with Vestexa?',
    answer: 'Vestexa\'s automated investing feature lets you set up recurring contributions that are automatically invested according to your personalized portfolio strategy. We handle the diversification, rebalancing, and optimization — so you can invest consistently without the guesswork. You choose the amount and frequency, and we take care of the rest.',
  },
  {
    question: 'What types of investments does Vestexa offer?',
    answer: 'Vestexa offers access to a diversified range of investments including individual stocks, exchange-traded funds (ETFs), bonds, and expertly curated portfolio mixes. We also offer tax-advantaged retirement accounts (IRAs) with optimized asset allocation strategies designed for long-term growth.',
  },
  {
    question: 'Is my money safe with Vestexa?',
    answer: 'Yes. Client assets are held in segregated accounts at regulated custodian institutions. All accounts are protected by bank-grade 256-bit encryption, multi-factor authentication, and industry-standard security protocols. As a registered investment advisor, Vestexa has a fiduciary duty — a legal obligation to act in your best interest at all times.',
  },
  {
    question: 'How much does Vestexa cost compared to traditional financial advisors?',
    answer: 'Vestexa charges a simple, transparent fee for professional investment advisory services — a fraction of what traditional financial advisors charge. Traditional advisors typically cost $2,500 or more per year, not including commissions and additional fees. With Vestexa, you get expert guidance, automated investing, and a personalized financial plan at a fraction of that cost.',
  },
  {
    question: 'Can I withdraw my money anytime?',
    answer: 'Yes. Your money is always yours. You can withdraw from your Vestexa investment account at any time with no penalties or lock-up periods on standard brokerage accounts. Retirement accounts (IRAs) may have standard tax implications for early withdrawals as required by regulation.',
  },
];

// Custom Plus icon SVG with animated bars matching Jeton CSS
const PlusIcon: React.FC = () => (
  <svg className="plus-icon shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <line className="horizontal-l" x1="4" y1="12" x2="12" y2="12" stroke="currentColor" strokeWidth="1.75" />
    <line className="horizontal-r" x1="12" y1="12" x2="20" y2="12" stroke="currentColor" strokeWidth="1.75" />
    <line className="vertical" x1="12" y1="4" x2="12" y2="20" stroke="currentColor" strokeWidth="1.75" />
  </svg>
);

const AccordionItem: React.FC<{
  item: FaqItem;
  idx: number;
  isExpanded: boolean;
  toggle: () => void;
}> = ({ item, idx, isExpanded, toggle }) => {
  const contentRef = useRef<HTMLDivElement>(null);
  const [height, setHeight] = useState(0);

  useEffect(() => {
    if (contentRef.current) {
      setHeight(isExpanded ? contentRef.current.scrollHeight : 0);
    }
  }, [isExpanded]);

  return (
    <div className="faq-accordion" data-expanded={isExpanded}>
      <button
        type="button"
        onClick={toggle}
        aria-expanded={isExpanded}
        className="w-full text-left flex items-center justify-between py-6 px-4 hover:bg-white/5 transition-colors rounded-xl"
      >
        <div className="flex items-center gap-4 flex-1 pr-4">
          <span className="w-8 h-8 rounded-full border border-white/40 flex items-center justify-center text-caption font-medium text-white shrink-0 bg-white/10">
            {String(idx + 1).padStart(2, '0')}
          </span>
          <span className="text-subhead-3 sm:text-subhead-2 text-white font-medium text-left leading-snug">
            {item.question}
          </span>
        </div>
        <span className="text-white/80 shrink-0 ml-2">
          <PlusIcon />
        </span>
      </button>

      <div
        className="accordion-content"
        style={{ height: `${height}px` }}
      >
        <div
          ref={contentRef}
          className="px-3 sm:px-4 pb-6 pt-1 text-white/85 font-normal leading-relaxed text-body-small sm:text-body pl-3 sm:pl-[64px]"
        >
          <p>{item.answer}</p>
        </div>
      </div>
    </div>
  );
};

export const FaqAccordion: React.FC = () => {
  const [expandedIdx, setExpandedIdx] = useState<number | null>(0); // First item open by default

  const toggle = useCallback((idx: number) => {
    setExpandedIdx(prev => (prev === idx ? null : idx));
  }, []);

  return (
    <section id="faq" className="bg-jeton-orange relative overflow-hidden pt-24 pb-20 sm:pt-40 sm:pb-32 border-t border-white/10">
      <div className="g-row-full max-w-4xl mx-auto px-4 sm:px-6">
        {/* Section heading */}
        <div className="text-center mb-10 sm:mb-16">
          <span className="inline-block px-3.5 py-1 rounded-full bg-white/10 text-white text-caption font-medium mb-3 backdrop-blur-sm">
            Everything You Need To Know
          </span>
          <h2 className="text-title-4 sm:text-title-3 font-medium text-white tracking-tight">
            Frequently asked questions
          </h2>
          <p className="text-white/80 text-body-small sm:text-body mt-2 max-w-xl mx-auto">
            Got questions about transfers, cards, security, or enterprise accounts? Find answers below or talk to our 24/7 desk.
          </p>
        </div>

        {/* Accordion List */}
        <div className="divide-y divide-white/20 border-y border-white/20">
          {faqItems.map((item, idx) => (
            <AccordionItem
              key={idx}
              item={item}
              idx={idx}
              isExpanded={expandedIdx === idx}
              toggle={() => toggle(idx)}
            />
          ))}
        </div>

        {/* Bottom Help Note */}
        <div className="mt-10 sm:mt-12 text-center">
          <div className="inline-flex flex-col sm:flex-row items-center gap-2 text-white/85 text-body-small">
            <span>Still have questions about our services?</span>
            <button
              type="button"
              onClick={() => window.dispatchEvent(new CustomEvent('vestexa:open-support'))}
              className="text-white font-medium underline underline-offset-4 hover:text-white/90 transition-colors cursor-pointer"
            >
              Contact our 24/7 global support desk &rarr;
            </button>
          </div>
        </div>
      </div>
    </section>
  );
};
