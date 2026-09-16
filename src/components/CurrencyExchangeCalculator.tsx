import React, { useState } from 'react';
import { SplitText } from './SplitText';

/**
 * CurrencyExchangeCalculator — Mirrors Jeton's _currency-exchange-calculator / _fee-calculator.
 *
 * - Two currency inputs with flag-icon dropdown selectors
 * - Animated swap button (rotates 180° on click)
 * - Fee breakdown output with colored timeline markers (blue, orange, dark-orange)
 * - Floating label input pattern
 * - Rate guarantee indicator & quick preset amounts
 * - CTA button to initiate transfer
 */

interface Currency {
  code: string;
  name: string;
  symbol: string;
  flag: string;
  rate: number;
}

const currencies: Currency[] = [
  { code: 'USD', name: 'US Dollar', symbol: '$', flag: 'us', rate: 1.0 },
  { code: 'EUR', name: 'Euro', symbol: '€', flag: 'eu', rate: 0.92 },
  { code: 'GBP', name: 'British Pound', symbol: '£', flag: 'gb', rate: 0.79 },
  { code: 'CHF', name: 'Swiss Franc', symbol: 'Fr', flag: 'ch', rate: 0.88 },
  { code: 'JPY', name: 'Japanese Yen', symbol: '¥', flag: 'jp', rate: 149.5 },
  { code: 'CAD', name: 'Canadian Dollar', symbol: 'C$', flag: 'ca', rate: 1.36 },
  { code: 'AUD', name: 'Australian Dollar', symbol: 'A$', flag: 'au', rate: 1.54 },
  { code: 'SGD', name: 'Singapore Dollar', symbol: 'S$', flag: 'sg', rate: 1.34 },
];

const PRESETS = [500, 1000, 5000, 10000];

export const CurrencyExchangeCalculator: React.FC = () => {
  const [fromCurrency, setFromCurrency] = useState('USD');
  const [toCurrency, setToCurrency] = useState('EUR');
  const [amount, setAmount] = useState<number>(1000);
  const [swapRotation, setSwapRotation] = useState(0);
  const [isFocused, setIsFocused] = useState(false);

  const fromCurr = currencies.find(c => c.code === fromCurrency) || currencies[0];
  const toCurr = currencies.find(c => c.code === toCurrency) || currencies[1];

  const exchangeRate = toCurr.rate / fromCurr.rate;
  const feeRate = 0.003; // 0.3% transparent fee
  const feeAmount = amount * feeRate;
  const netAmount = Math.max(0, amount - feeAmount);
  const convertedAmount = netAmount * exchangeRate;
  const totalToPay = amount;

  const handleSwap = () => {
    setSwapRotation(prev => prev + 180);
    setFromCurrency(toCurrency);
    setToCurrency(fromCurrency);
  };

  return (
    <section id="exchange" className="relative py-24 sm:py-32 bg-white overflow-hidden">
      {/* Subtle background ambient glow */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[500px] bg-jeton-orange-5 rounded-full blur-3xl pointer-events-none -z-10" />

      <div className="g-row-full max-w-4xl mx-auto px-4 sm:px-6">
        {/* Section Header */}
        <div className="text-center mb-12 sm:mb-16">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-jeton-orange-5 text-jeton-orange text-caption font-medium mb-3">
            <span className="w-2 h-2 rounded-full bg-jeton-orange animate-ping" />
            Live Interbank Spot FX Engine
          </div>
          <h2 className="text-title-4 sm:text-title-3 font-medium text-jeton-orange-900 mb-4 tracking-tight">
            Currency exchange calculator
          </h2>
          <p className="text-body text-jeton-orange-900/70 max-w-xl mx-auto">
            Exchange 30+ currencies with transparent flat 0.3% pricing and zero hidden markups. What you see is exactly what your recipient receives.
          </p>
        </div>

        {/* Main Calculator Card */}
        {/* Main Calculator Card */}
        <div className="bg-white rounded-card-xl p-4 sm:p-10 shadow-glass border border-jeton-orange/10 relative">
          {/* Quick Presets */}
          <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2.5 mb-5 sm:mb-6 pb-4 border-b border-jeton-orange/10">
            <span className="text-caption text-jeton-orange-900/60 font-medium shrink-0">Quick amounts:</span>
            <div className="flex items-center gap-2 overflow-x-auto no-scrollbar w-full sm:w-auto py-1">
              {PRESETS.map(preset => (
                <button
                  key={preset}
                  type="button"
                  onClick={() => setAmount(preset)}
                  className={`px-3 py-1.5 text-caption font-semibold rounded-lg transition-all shrink-0 active:scale-95 ${
                    amount === preset
                      ? 'bg-jeton-orange text-white shadow-sm'
                      : 'bg-jeton-orange-5 text-jeton-orange-900 hover:bg-jeton-orange-10'
                  }`}
                >
                  {fromCurr.symbol}{preset.toLocaleString()}
                </button>
              ))}
            </div>
          </div>

          <div className="space-y-3 sm:space-y-4">
            {/* "You Send" Input Box */}
            <div
              className={`relative rounded-2xl bg-jeton-orange-5/70 p-3.5 sm:p-5 border transition-all duration-200 ${
                isFocused ? 'border-jeton-orange ring-2 ring-jeton-orange/20 bg-white' : 'border-jeton-orange/10 hover:border-jeton-orange/25'
              }`}
            >
              <div className="flex items-center justify-between gap-2 sm:gap-4">
                {/* Floating label & number input */}
                <div className="flex-1 min-w-0">
                  <span className="block text-[11px] sm:text-caption font-medium text-jeton-orange-900/60 mb-0.5 sm:mb-1">
                    You send
                  </span>
                  <div className="flex items-center">
                    <span className="text-xl sm:text-title-4 font-bold text-jeton-orange-900/40 mr-1 select-none">
                      {fromCurr.symbol}
                    </span>
                    <input
                      type="number"
                      min="1"
                      step="any"
                      value={amount || ''}
                      onFocus={() => setIsFocused(true)}
                      onBlur={() => setIsFocused(false)}
                      onChange={(e) => setAmount(Math.max(0, parseFloat(e.target.value) || 0))}
                      className="w-full bg-transparent text-xl sm:text-title-4 font-bold text-jeton-orange-900 focus:outline-none placeholder-jeton-orange-900/30"
                      placeholder="0.00"
                    />
                  </div>
                </div>

                {/* Currency Selector Pill (Fintech Pattern) */}
                <div className="relative flex items-center gap-1.5 sm:gap-2 bg-white py-1.5 sm:py-2 px-2.5 sm:px-3.5 rounded-full shadow-sm border border-jeton-orange/15 shrink-0 cursor-pointer hover:border-jeton-orange/40 transition-colors">
                  <img
                    src={`https://flagcdn.com/w40/${fromCurr.flag}.png`}
                    alt={fromCurr.code}
                    className="w-5 h-5 sm:w-6 sm:h-6 rounded-full object-cover shadow-sm border border-white shrink-0"
                  />
                  <span className="font-bold text-xs sm:text-sm text-jeton-orange-900">{fromCurr.code}</span>
                  <svg className="w-3.5 h-3.5 text-jeton-orange-900/60" viewBox="0 0 20 20" fill="currentColor">
                    <path fillRule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clipRule="evenodd" />
                  </svg>
                  <select
                    value={fromCurrency}
                    onChange={(e) => setFromCurrency(e.target.value)}
                    className="absolute inset-0 opacity-0 w-full h-full cursor-pointer"
                    aria-label="Select currency to send"
                  >
                    {currencies.map(c => (
                      <option key={c.code} value={c.code}>
                        {c.code} — {c.name}
                      </option>
                    ))}
                  </select>
                </div>
              </div>
            </div>

            {/* Swap Button (Floating divider) */}
            <div className="flex justify-center -my-3 sm:-my-3.5 relative z-10">
              <button
                type="button"
                onClick={handleSwap}
                className="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-jeton-orange text-white flex items-center justify-center shadow-pill hover:scale-105 active:scale-95 transition-all duration-300 group"
                aria-label="Swap Currencies"
              >
                <svg
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2.4"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  style={{
                    transform: `rotate(${swapRotation}deg)`,
                    transition: 'transform 0.4s cubic-bezier(0.23, 1, 0.32, 1)',
                  }}
                >
                  <path d="M7 16V4m0 0L3 8m4-4l4 4" />
                  <path d="M17 8v12m0 0l4-4m-4 4l-4-4" />
                </svg>
              </button>
            </div>

            {/* "Recipient Gets" Output Box */}
            <div className="relative rounded-2xl bg-jeton-orange-5/70 p-3.5 sm:p-5 border border-jeton-orange/10 hover:border-jeton-orange/25 transition-all">
              <div className="flex items-center justify-between gap-2 sm:gap-4">
                <div className="flex-1 min-w-0">
                  <span className="block text-[11px] sm:text-caption font-medium text-jeton-orange-900/60 mb-0.5 sm:mb-1">
                    Recipient receives (guaranteed)
                  </span>
                  <div className="flex items-center">
                    <span className="text-xl sm:text-title-4 font-bold text-jeton-orange-900/40 mr-1 select-none">
                      {toCurr.symbol}
                    </span>
                    <div className="text-xl sm:text-title-4 font-bold text-jeton-orange-900 select-all truncate">
                      {convertedAmount.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                      })}
                    </div>
                  </div>
                </div>

                {/* Currency Selector Pill (Fintech Pattern) */}
                <div className="relative flex items-center gap-1.5 sm:gap-2 bg-white py-1.5 sm:py-2 px-2.5 sm:px-3.5 rounded-full shadow-sm border border-jeton-orange/15 shrink-0 cursor-pointer hover:border-jeton-orange/40 transition-colors">
                  <img
                    src={`https://flagcdn.com/w40/${toCurr.flag}.png`}
                    alt={toCurr.code}
                    className="w-5 h-5 sm:w-6 sm:h-6 rounded-full object-cover shadow-sm border border-white shrink-0"
                  />
                  <span className="font-bold text-xs sm:text-sm text-jeton-orange-900">{toCurr.code}</span>
                  <svg className="w-3.5 h-3.5 text-jeton-orange-900/60" viewBox="0 0 20 20" fill="currentColor">
                    <path fillRule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clipRule="evenodd" />
                  </svg>
                  <select
                    value={toCurrency}
                    onChange={(e) => setToCurrency(e.target.value)}
                    className="absolute inset-0 opacity-0 w-full h-full cursor-pointer"
                    aria-label="Select currency to receive"
                  >
                    {currencies.map(c => (
                      <option key={c.code} value={c.code}>
                        {c.code} — {c.name}
                      </option>
                    ))}
                  </select>
                </div>
              </div>
            </div>
          </div>

          {/* Fee Breakdown Timeline — Jeton Pattern */}
          <div className="mt-8 pt-6 border-t border-jeton-orange/10">
            <div className="space-y-3.5">
              {/* Row 1: Exchange Rate */}
              <div className="flex items-center gap-3">
                <span className="w-3 h-3 rounded-full bg-jeton-blue shrink-0 ring-4 ring-blue-50" />
                <div className="flex-1 text-body-small text-jeton-orange-900/70">
                  Real Interbank Exchange Rate
                </div>
                <div className="text-body-small font-medium text-jeton-orange-900">
                  1 {fromCurr.code} = {exchangeRate.toFixed(4)} {toCurr.code}
                </div>
              </div>

              {/* Vertical connector */}
              <div className="ml-[5px] w-[2px] h-3 border-l-2 border-dashed border-jeton-orange/20" />

              {/* Row 2: Flat Transparent Fee */}
              <div className="flex items-center gap-3">
                <span className="w-3 h-3 rounded-full bg-jeton-orange shrink-0 ring-4 ring-orange-50" />
                <div className="flex-1 text-body-small text-jeton-orange-900/70">
                  Vestexa Fee (0.3% Flat)
                </div>
                <div className="text-body-small font-medium text-jeton-orange-900">
                  {fromCurr.symbol}{feeAmount.toFixed(2)} {fromCurr.code}
                </div>
              </div>

              {/* Vertical connector */}
              <div className="ml-[5px] w-[2px] h-3 border-l-2 border-dashed border-jeton-orange/20" />

              {/* Row 3: Total to Pay */}
              <div className="flex items-center gap-3">
                <span className="w-3 h-3 rounded-full bg-jeton-orange-900 shrink-0 ring-4 ring-orange-100" />
                <div className="flex-1 text-body-small font-medium text-jeton-orange-900">
                  Total amount debited
                </div>
                <div className="text-subhead-3 sm:text-subhead-2 font-medium text-jeton-orange-900">
                  {fromCurr.symbol}{totalToPay.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })} {fromCurr.code}
                </div>
              </div>
            </div>
          </div>

          {/* Action CTA & Assurance */}
          <div className="mt-8 pt-6 border-t border-jeton-orange/10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div className="flex items-center gap-2 text-caption text-jeton-orange-900/60 text-center sm:text-left">
              <svg className="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
              <span>Rate locked for 24 hours. No hidden correspondent banking fees.</span>
            </div>

            <a
              href="/signup"
              className="btn btn-primary-orange btn-animated w-full sm:w-auto shadow-pill hover:shadow-lg transition-shadow"
            >
              <SplitText text="Get this rate" isButtonLabel />
            </a>

          </div>
        </div>
      </div>
    </section>
  );
};
