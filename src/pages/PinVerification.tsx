import React, { useState, useEffect, useRef } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { SvgWordmark } from '../components/SvgWordmark';

export const PinVerification: React.FC = () => {
  const { user, verifyPin, logoutUser } = useAuth();
  const navigate = useNavigate();

  const [pin, setPin] = useState('');
  const [isProcessing, setIsProcessing] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');
  const [successMessage, setSuccessMessage] = useState('');
  const [isShaking, setIsShaking] = useState(false);
  const desktopInputRef = useRef<HTMLInputElement>(null);

  const maxLength = 4;

  // Route guard: if no user is signed in, redirect to login
  // If user is already verified (pinstatus === 0), redirect to dashboard
  useEffect(() => {
    if (!user) {
      navigate('/login');
      return;
    }
    // If user is already verified from before, redirect to dashboard
    if (user.pinstatus === 0 && !successMessage) {
      navigate('/dashboard');
      return;
    }
    // Auto-focus desktop input if available
    desktopInputRef.current?.focus();
  }, [user, navigate, successMessage]);

  // Handle PIN submission
  const handleSubmitPin = async (pinToSubmit = pin) => {
    if (pinToSubmit.length < maxLength) {
      setErrorMessage('Please enter all 4 digits');
      setTimeout(() => setErrorMessage(''), 3000);
      return;
    }

    setIsProcessing(true);
    setErrorMessage('');

    // Artificial tiny timeout for tactile feedback
    setTimeout(() => {
      const result = verifyPin(pinToSubmit);

      if (result.success) {
        setSuccessMessage(result.message || 'PIN verified successfully!');
        // Seamless redirect to dashboard after 1s
        setTimeout(() => {
          navigate('/dashboard');
        }, 1000);
      } else {
        setErrorMessage(result.message || 'Invalid PIN. Please try again.');
        setIsShaking(true);
        setPin('');
        setTimeout(() => {
          setIsShaking(false);
          desktopInputRef.current?.focus();
        }, 500);
        setTimeout(() => setErrorMessage(''), 3500);
      }
      setIsProcessing(false);
    }, 400);
  };

  const addDigit = (digit: number | string) => {
    if (pin.length < maxLength && !isProcessing) {
      const nextPin = pin + digit.toString();
      setPin(nextPin);

      // Haptic feedback for mobile devices
      if (typeof window !== 'undefined' && window.navigator && window.navigator.vibrate) {
        try {
          window.navigator.vibrate(50);
        } catch {
          // Ignore vibrate restrictions
        }
      }

      // Auto-submit when complete (faceless-fintech workflow)
      if (nextPin.length === maxLength) {
        setTimeout(() => {
          handleSubmitPin(nextPin);
        }, 220);
      }
    }
  };

  const removeDigit = () => {
    if (pin.length > 0 && !isProcessing) {
      setPin(pin.slice(0, -1));
    }
  };

  const handleDesktopInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const cleanDigits = e.target.value.replace(/\D/g, '').slice(0, maxLength);
    setPin(cleanDigits);
    if (cleanDigits.length === maxLength) {
      setTimeout(() => {
        handleSubmitPin(cleanDigits);
      }, 200);
    }
  };

  const handleDesktopKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Enter' && pin.length === maxLength) {
      e.preventDefault();
      handleSubmitPin();
    }
  };

  const handleSignOut = () => {
    logoutUser();
    navigate('/login');
  };

  if (!user) return null;

  const displayName = user.fullName || user.username || 'Valued Investor';
  const avatarInitials = displayName
    .split(' ')
    .map((n) => n[0])
    .join('')
    .substring(0, 2)
    .toUpperCase();

  return (
    <div className="min-h-screen bg-neutral-900 text-white selection:bg-[#F73B20] selection:text-white">
      {/* ══════════════════════════════════════════════════════════
          MOBILE VIEW (< md) — Faceless Fintech Mobile Keypad UX
          ══════════════════════════════════════════════════════════ */}
      <div className="md:hidden min-h-screen bg-gradient-to-b from-gray-900 via-neutral-950 to-black text-white flex flex-col justify-between p-6 select-none">
        
        {/* Top Header Section */}
        <div className="flex flex-col items-center pt-8">
          {/* Logo / Brand mark */}
          <div className="mb-6 opacity-90">
            <SvgWordmark tone="white" brand="vestexa" />
          </div>

          {/* User Avatar with Verification Badge */}
          <div className="relative mb-4">
            <div className="w-20 h-20 rounded-full overflow-hidden border-2 border-white/20 shadow-2xl bg-neutral-800 flex items-center justify-center ring-4 ring-white/5">
              {user.avatarUrl ? (
                <img
                  src={user.avatarUrl}
                  alt={displayName}
                  className="w-full h-full object-cover"
                />
              ) : (
                <div className="w-full h-full bg-gradient-to-br from-jeton-orange to-[#A21906] text-white flex items-center justify-center font-bold text-xl">
                  {avatarInitials}
                </div>
              )}
            </div>
            {/* Status indicator */}
            <div className="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500 rounded-full border-2 border-neutral-900 flex items-center justify-center shadow-md">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="3" strokeLinecap="round" strokeLinejoin="round">
                <polyline points="20 6 9 17 4 12" />
              </svg>
            </div>
          </div>

          {/* Welcome Text */}
          <div className="text-center mb-4">
            <h1 className="text-2xl font-extrabold tracking-tight">Welcome Back</h1>
            <p className="text-gray-400 text-sm font-medium mt-0.5">{displayName}</p>
          </div>

          {/* Security Icon Badge */}
          <div className="mb-2">
            <div className="w-10 h-10 bg-emerald-500/15 border border-emerald-500/30 rounded-full flex items-center justify-center text-emerald-400">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              </svg>
            </div>
          </div>

          {/* Passcode Label */}
          <p className="text-gray-400 text-xs font-semibold tracking-wider uppercase mb-5 flex items-center gap-1.5">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            </svg>
            <span>Security Passcode</span>
          </p>

          {/* PIN Dots Container with Shake Animation */}
          <div className={`pin-dots flex items-center gap-4 mb-4 ${isShaking ? 'animate-shake' : ''}`}>
            {Array.from({ length: maxLength }).map((_, index) => {
              const isFilled = index < pin.length;
              return (
                <div
                  key={index}
                  className={`w-3.5 h-3.5 rounded-full transition-all duration-200 ${
                    isFilled
                      ? 'bg-jeton-orange scale-125 shadow-[0_0_12px_rgba(247,59,32,0.8)]'
                      : 'bg-white/20'
                  }`}
                />
              );
            })}
          </div>

          {/* Error Message */}
          {errorMessage && (
            <div className="text-red-400 text-xs font-semibold text-center mb-2 px-4 py-1.5 rounded-full bg-red-500/10 border border-red-500/20 animate-fade-in">
              {errorMessage}
            </div>
          )}

          {/* Success Message */}
          {successMessage && (
            <div className="text-emerald-400 text-xs font-semibold text-center mb-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 animate-fade-in flex items-center gap-1.5">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                <polyline points="20 6 9 17 4 12" />
              </svg>
              <span>{successMessage}</span>
            </div>
          )}
        </div>

        {/* Numeric Keypad Section */}
        <div className="pb-6">
          <div className="grid grid-cols-3 gap-3.5 max-w-xs mx-auto">
            {/* Numbers 1-9 */}
            {[1, 2, 3, 4, 5, 6, 7, 8, 9].map((n) => (
              <button
                key={n}
                type="button"
                onClick={() => addDigit(n)}
                disabled={isProcessing || pin.length >= maxLength}
                className="w-18 h-18 rounded-full bg-white/10 hover:bg-white/20 active:bg-white/30 border border-white/10 backdrop-blur-md text-white text-2xl font-bold flex items-center justify-center transition-all duration-150 hover:scale-105 active:scale-95 disabled:opacity-40 disabled:hover:scale-100 shadow-sm cursor-pointer"
              >
                {n}
              </button>
            ))}

            {/* Sign Out / Cancel Button */}
            <button
              type="button"
              onClick={handleSignOut}
              disabled={isProcessing}
              title="Sign Out"
              className="w-18 h-18 rounded-full bg-red-500/15 hover:bg-red-500/25 active:bg-red-500/35 border border-red-500/20 text-red-400 flex items-center justify-center transition-all duration-150 hover:scale-105 active:scale-95 disabled:opacity-40 cursor-pointer"
            >
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2" strokeLinecap="round" strokeLinejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
              </svg>
            </button>

            {/* Number 0 */}
            <button
              type="button"
              onClick={() => addDigit(0)}
              disabled={isProcessing || pin.length >= maxLength}
              className="w-18 h-18 rounded-full bg-white/10 hover:bg-white/20 active:bg-white/30 border border-white/10 backdrop-blur-md text-white text-2xl font-bold flex items-center justify-center transition-all duration-150 hover:scale-105 active:scale-95 disabled:opacity-40 shadow-sm cursor-pointer"
            >
              0
            </button>

            {/* Backspace Button */}
            <button
              type="button"
              onClick={removeDigit}
              disabled={isProcessing || pin.length === 0}
              title="Delete"
              className="w-18 h-18 rounded-full bg-jeton-orange hover:bg-jeton-orange-hover text-white flex items-center justify-center transition-all duration-150 hover:scale-105 active:scale-95 shadow-lg disabled:opacity-30 disabled:hover:scale-100 cursor-pointer"
            >
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2" strokeLinecap="round" strokeLinejoin="round">
                <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
                <line x1="18" y1="9" x2="12" y2="15" />
                <line x1="12" y1="9" x2="18" y2="15" />
              </svg>
            </button>
          </div>

          <div className="text-center mt-6">
            <button
              type="button"
              onClick={handleSignOut}
              className="text-xs text-gray-500 hover:text-gray-300 transition-colors font-medium cursor-pointer"
            >
              Switch account or return to login
            </button>
          </div>
        </div>
      </div>

      {/* ══════════════════════════════════════════════════════════
          DESKTOP VIEW (>= md) — Split Screen Luxury Security Suite
          ══════════════════════════════════════════════════════════ */}
      <div className="hidden md:flex min-h-screen">
        
        {/* Left Panel - Branding & Security Trust */}
        <div
          className="flex-1 flex flex-col justify-between p-12 lg:p-16 relative overflow-hidden"
          style={{
            background: 'linear-gradient(135deg, #1C1F26 0%, #111317 60%, #1F1513 100%)',
          }}
        >
          {/* Ambient Glow Elements */}
          <div className="absolute top-[-10%] left-[-10%] w-[35vw] h-[35vw] bg-jeton-orange/15 rounded-full blur-[140px] pointer-events-none" />
          <div className="absolute bottom-[-10%] right-[-10%] w-[30vw] h-[30vw] bg-amber-500/10 rounded-full blur-[120px] pointer-events-none" />

          {/* Top Wordmark */}
          <div className="relative z-10">
            <SvgWordmark tone="white" brand="vestexa" />
          </div>

          {/* Central Security Branding */}
          <div className="relative z-10 max-w-lg mx-auto text-center my-auto py-12">
            <div className="w-20 h-20 bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-glow">
              <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#F73B20" strokeWidth="2.2" strokeLinecap="round" strokeLinejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg>
            </div>

            <h1 className="text-4xl lg:text-5xl font-display font-extrabold text-white tracking-tight mb-3">
              Secure Access
            </h1>
            <p className="text-gray-300 text-base leading-relaxed mb-10">
              Your security is our highest priority. Enter your secondary 4-digit authorization PIN to unlock your portfolio vault.
            </p>

            {/* 4 Security Badges Grid */}
            <div className="grid grid-cols-2 gap-4 text-left">
              <div className="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div className="w-9 h-9 rounded-xl bg-jeton-orange/20 text-jeton-orange flex items-center justify-center mb-2.5">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                  </svg>
                </div>
                <h2 className="text-sm font-bold text-white">256-Bit Encrypted</h2>
                <p className="text-xs text-gray-400 mt-0.5">TLS 1.3 Bank-grade encryption</p>
              </div>

              <div className="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div className="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mb-2.5">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <path d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 004 11m0 0a8 8 0 00.17 1.637" />
                  </svg>
                </div>
                <h2 className="text-sm font-bold text-white">PIN Protected</h2>
                <p className="text-xs text-gray-400 mt-0.5">Two-step identity validation</p>
              </div>

              <div className="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div className="w-9 h-9 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center mb-2.5">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                  </svg>
                </div>
                <h2 className="text-sm font-bold text-white">Custody Protected</h2>
                <p className="text-xs text-gray-400 mt-0.5">SIPC &amp; FINRA segregated funds</p>
              </div>

              <div className="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div className="w-9 h-9 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center mb-2.5">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                  </svg>
                </div>
                <h2 className="text-sm font-bold text-white">24/7 Monitored</h2>
                <p className="text-xs text-gray-400 mt-0.5">Continuous fraud mitigation</p>
              </div>
            </div>
          </div>

          {/* Bottom Security Footer */}
          <div className="relative z-10 flex items-center justify-between text-xs text-gray-500">
            <span>© {new Date().getFullYear()} Vestexa Financial Inc.</span>
            <span>Regulated Institutional Infrastructure</span>
          </div>
        </div>

        {/* Right Panel - PIN Input Card */}
        <div
          className="flex-1 flex items-center justify-center p-8 lg:p-14 relative"
          style={{
            background: 'linear-gradient(135deg, #FDF0EE 0%, #F8CDCB 45%, #FDE4DD 100%)',
          }}
        >
          {/* Ambient Glows */}
          <div className="absolute top-[-10%] right-[-5%] w-[35vw] h-[35vw] rounded-full bg-[#F73B20]/10 blur-[130px] pointer-events-none" />

          <div className="w-full max-w-md bg-white/95 backdrop-blur-2xl rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/80 relative z-10 text-jeton-orange-900">
            
            {/* User Profile Info */}
            <div className="text-center mb-8">
              <div className="relative inline-block mb-4">
                <div className="w-20 h-20 rounded-full overflow-hidden border-4 border-jeton-orange-50 bg-neutral-100 shadow-md flex items-center justify-center">
                  {user.avatarUrl ? (
                    <img
                      src={user.avatarUrl}
                      alt={displayName}
                      className="w-full h-full object-cover"
                    />
                  ) : (
                    <div className="w-full h-full bg-gradient-to-br from-jeton-orange to-[#A21906] text-white flex items-center justify-center font-bold text-2xl">
                      {avatarInitials}
                    </div>
                  )}
                </div>
                <div className="absolute -bottom-1 -right-1 w-6 h-6 bg-jeton-orange rounded-full border-2 border-white flex items-center justify-center shadow">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="3">
                    <polyline points="20 6 9 17 4 12" />
                  </svg>
                </div>
              </div>

              <h2 className="text-2xl font-display font-extrabold text-jeton-orange-900 mb-1">
                Welcome Back
              </h2>
              <p className="text-sm font-semibold text-jeton-orange-900/70">
                {displayName}
              </p>
            </div>

            {/* PIN Entry Area */}
            <div className="mb-6">
              <label
                htmlFor="desktop-pin"
                className="block text-xs font-bold uppercase tracking-wider text-jeton-orange-900 text-center mb-3"
              >
                Enter your 4-digit PIN
              </label>

              <div className="relative">
                <input
                  id="desktop-pin"
                  ref={desktopInputRef}
                  type="password"
                  inputMode="numeric"
                  maxLength={maxLength}
                  pattern="[0-9]*"
                  value={pin}
                  onChange={handleDesktopInputChange}
                  onKeyDown={handleDesktopKeyDown}
                  disabled={isProcessing}
                  placeholder="••••"
                  className="w-full px-4 py-4 border-2 border-jeton-orange-50 focus:border-jeton-orange focus:bg-white focus:ring-4 focus:ring-jeton-orange/10 rounded-2xl text-center text-3xl tracking-[0.4em] font-mono font-bold transition-all text-jeton-orange-900 placeholder:text-gray-300 shadow-sm"
                  autoComplete="off"
                />
              </div>

              {/* Real-time PIN Dots Representation */}
              <div className={`flex justify-center gap-3 mt-3 ${isShaking ? 'animate-shake' : ''}`}>
                {Array.from({ length: maxLength }).map((_, i) => (
                  <span
                    key={i}
                    className={`w-2.5 h-2.5 rounded-full transition-all duration-200 ${
                      i < pin.length ? 'bg-jeton-orange scale-110' : 'bg-gray-200'
                    }`}
                  />
                ))}
              </div>
            </div>

            {/* Feedback Alerts */}
            {errorMessage && (
              <div className="mb-5 p-3.5 bg-red-500/10 border border-red-500/20 rounded-2xl text-center text-red-700 text-xs font-semibold flex items-center justify-center gap-2 animate-fade-in">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                  <circle cx="12" cy="12" r="10" />
                  <line x1="12" y1="8" x2="12" y2="12" />
                  <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                <span>{errorMessage}</span>
              </div>
            )}

            {successMessage && (
              <div className="mb-5 p-3.5 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-center text-emerald-700 text-xs font-semibold flex items-center justify-center gap-2 animate-fade-in">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span>{successMessage}</span>
              </div>
            )}

            {/* Submit Button */}
            <button
              type="button"
              onClick={() => handleSubmitPin()}
              disabled={isProcessing || pin.length !== maxLength}
              className="w-full py-4 bg-jeton-orange hover:bg-jeton-orange-hover disabled:bg-gray-300 disabled:opacity-60 text-white rounded-full font-bold text-sm transition-all duration-200 shadow-pill hover:shadow-glow disabled:cursor-not-allowed transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer flex items-center justify-center gap-2"
            >
              {isProcessing ? (
                <>
                  <svg className="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24">
                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                  </svg>
                  <span>Verifying PIN...</span>
                </>
              ) : (
                <>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                  </svg>
                  <span>Verify PIN &amp; Unlock Portal</span>
                </>
              )}
            </button>

            {/* Security Notice */}
            <div className="mt-6 p-3.5 bg-jeton-orange-50/60 rounded-2xl border border-jeton-orange-50 text-center">
              <p className="text-[11px] text-jeton-orange-900/70 font-medium">
                🔒 Your PIN is securely verified. We enforce strict rate-limiting and encryption on all authentication sessions.
              </p>
            </div>

            {/* Account Blocked Alert (if applicable) */}
            {user.status === 'blocked' && (
              <div className="mt-4 p-3.5 bg-red-50 border border-red-200 rounded-2xl text-left">
                <p className="text-xs font-bold text-red-700">Account Restricted</p>
                <p className="text-[11px] text-red-600 mt-0.5">
                  Your account has security restrictions applied. Please verify your PIN to request administrator review.
                </p>
              </div>
            )}

            {/* Sign Out / Return to Login Link */}
            <div className="mt-6 pt-4 border-t border-jeton-orange-50 text-center">
              <button
                type="button"
                onClick={handleSignOut}
                className="text-xs font-bold text-jeton-orange hover:underline cursor-pointer transition-colors"
              >
                ← Sign out or switch account
              </button>
            </div>

          </div>
        </div>
      </div>
    </div>
  );
};
