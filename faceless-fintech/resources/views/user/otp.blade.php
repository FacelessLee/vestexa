@extends('layouts.dash2')

@section('title', 'OTP Verification')
@section('content')

<div x-data="{ 
    otp: '',
    isSubmitting: false,
    countdown: 30,
    canResend: false,
    
    startCountdown() {
        this.countdown = 30;
        this.canResend = false;
        
        const timer = setInterval(() => {
            this.countdown--;
            
            if (this.countdown <= 0) {
                clearInterval(timer);
                this.canResend = true;
            }
        }, 1000);
    }
}" x-init="startCountdown()">
    <!-- Mobile Header -->
    <div class="lg:hidden mb-2">
        @include('partials._mobile_header', [
            'title' => 'OTP Verification',
            'showBackButton' => true,
            'backUrl' => route('dashboard'),
            'showNotifications' => true,
            'showDarkMode' => true,
            'financeUser' => Auth::user()
        ])
    </div>

    <!-- Alerts -->
    <x-danger-alert />
    <x-success-alert />

    <!-- Container -->
    <div class="max-w-sm mx-auto my-8">
        <!-- Enhanced OTP Card -->
        <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 pt-6 pb-4 border-b border-gray-100/50 dark:border-gray-700/50">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary-100/50 dark:bg-primary-800/50 backdrop-blur-sm mb-4">
                        <i class="fas fa-lock text-2xl text-primary-600 dark:text-primary-300"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Enter OTP</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Input the OTP we sent to</p>
                    <p class="text-sm font-medium text-primary-600 dark:text-primary-400">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- OTP Form -->
            <div class="px-6 pb-6 pt-4">
                <form action="{{ route('codecomfirm') }}" method="post" @submit="isSubmitting = true">
                    @csrf
                    
                    <!-- OTP Input Field -->
                    <div class="mb-6">
                        <label for="otp_input" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">OTP Code</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                <i class="fas fa-key text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                name="otp" 
                                id="otp_input" 
                                x-model="otp"
                                class="w-full pl-10 pr-3 py-3 text-center border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-lg font-bold tracking-widest"
                                placeholder="Enter OTP code"
                                required
                                autocomplete="one-time-code"
                                maxlength="10"
                            />
                        </div>
                    </div>
                    
                    <!-- Resend OTP Link -->
                    <div class="text-center mb-6">
                        <template x-if="!canResend">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Resend code in <span class="font-medium text-primary-600 dark:text-primary-400" x-text="countdown"></span> seconds
                            </p>
                        </template>
                        
                        <template x-if="canResend">
                            <a href="{{ route('getotp') }}" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors flex items-center justify-center">
                                <i class="fas fa-redo mr-2 text-xs"></i>
                                Resend verification code
                            </a>
                        </template>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <button 
                            type="submit" 
                            class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 dark:from-primary-700 dark:to-primary-800 dark:hover:from-primary-600 dark:hover:to-primary-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center group text-sm"
                            :disabled="isSubmitting"
                        >
                            <i class="fas fa-check-circle mr-2 group-hover:scale-110 transition-transform text-sm" :class="{ 'animate-pulse': isSubmitting }"></i>
                            <span x-text="isSubmitting ? 'Verifying...' : 'Confirm OTP'"></span>
                        </button>
                        
                        <a 
                            href="{{ route('dashboard') }}" 
                            class="w-full py-3 px-4 bg-gray-100/80 dark:bg-gray-700/80 hover:bg-gray-200/80 dark:hover:bg-gray-600/80 text-gray-800 dark:text-gray-200 font-semibold rounded-xl border border-gray-200/50 dark:border-gray-600/50 backdrop-blur-sm transition-all duration-300 flex items-center justify-center group hover:scale-[1.02] text-sm"
                        >
                            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform text-sm"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Enhanced Security Notice -->
        <div class="mt-6 bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0 mt-0.5">
                    <div class="w-8 h-8 rounded-xl bg-primary-100/50 dark:bg-primary-800/50 flex items-center justify-center">
                        <i class="fas fa-shield-alt text-primary-500 dark:text-primary-400 text-sm"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Security Notice</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">Never share your OTP with anyone, including bank staff. This code is only used to verify your transaction.</p>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Footer Links -->
        <div class="mt-6 text-center space-y-3">
            <div class="flex items-center justify-center space-x-4 text-xs">
                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium flex items-center">
                    <i class="fas fa-headset mr-1 text-xs"></i>
                    Support
                </a>
                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium flex items-center">
                    <i class="fas fa-question-circle mr-1 text-xs"></i>
                    Help
                </a>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-500 max-w-xs mx-auto leading-relaxed">
                Having trouble? Contact our support team for immediate assistance.
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced form interactions
        const otpInput = document.getElementById('otp_input');
        
        // Auto-format OTP input
        otpInput.addEventListener('input', function(e) {
            // Remove any non-numeric characters
            let value = e.target.value.replace(/\D/g, '');
            
            // Limit to 10 characters
            if (value.length > 10) {
                value = value.slice(0, 10);
            }
            
            e.target.value = value;
        });
        
        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('button, a');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });
</script>

<style>
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    /* Enhanced focus styles */
    input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    /* Smooth transitions for form elements */
    input, button, a {
        transition: all 0.3s ease;
    }
    
    /* Enhanced button hover effects */
    button:hover, a:hover {
        transform: translateY(-1px);
    }
    
    button:active, a:active {
        transform: translateY(0);
    }
    
    /* Better mobile responsiveness */
    @media (max-width: 768px) {
        .max-w-sm {
            margin-left: 1rem;
            margin-right: 1rem;
        }
    }
    
    /* Enhanced form field styling */
    input[type="text"] {
        font-size: 16px; /* Prevents zoom on iOS */
    }
    
    /* Ensure icons are properly positioned */
    .relative .absolute {
        z-index: 10;
    }
</style>


@endsection