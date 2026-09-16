@extends('layouts.guest2')

@section('title', 'Two-Factor Authentication')
@section('content')

<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Left Side - Branding & Illustration (Desktop Only) -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 dark:from-primary-700 dark:via-primary-800 dark:to-primary-900 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Floating Shapes -->
            <div class="absolute top-1/4 left-1/4 w-48 h-48 bg-white/10 rounded-full backdrop-blur-sm floating-slow"></div>
            <div class="absolute bottom-1/3 right-1/4 w-72 h-72 bg-white/5 rounded-full backdrop-blur-sm floating"></div>
            <div class="absolute top-2/3 left-1/3 w-32 h-32 bg-white/15 rounded-full backdrop-blur-sm floating-slower"></div>
            
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(rgba(255,255,255,0.15) 1px, transparent 1px); background-size: 25px 25px;"></div>
        </div>
        
        <!-- Content -->
        <div class="relative flex flex-col justify-center items-center w-full h-full text-white p-8 z-10">
            <!-- Logo with Glow Effect -->
            <div class="mb-6 relative">
                <div class="absolute inset-0 bg-white/20 rounded-2xl blur-lg"></div>
                <div class="relative bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                    <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="Logo" class="h-12">
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="text-3xl font-black mb-3 text-center bg-gradient-to-r from-white via-white to-white/80 bg-clip-text text-transparent">
                Account Security
            </h1>
            <h2 class="text-lg font-semibold mb-6 text-center text-white/90">
                Two-Factor Authentication
            </h2>
            
            <!-- Description -->
            <p class="text-sm mb-8 max-w-md text-center text-white/80 leading-relaxed">
                Two-Factor Authentication adds an extra layer of security to your {{ $settings->site_name }} account.
            </p>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-2 gap-4 w-full max-w-md">
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-shield-alt text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Extra Security</h3>
                        <p class="text-xs text-white/70">Enhanced protection</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-envelope text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Email Verification</h3>
                        <p class="text-xs text-white/70">Code delivery</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-key text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Secure Access</h3>
                        <p class="text-xs text-white/70">Safe login</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-lock text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Account Protection</h3>
                        <p class="text-xs text-white/70">Data security</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Verification Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-3 lg:p-8 bg-gray-50/50 dark:bg-gray-900/50 backdrop-blur-sm">
        <div class="w-full max-w-sm">
            <!-- Mobile Header -->
            <div class="lg:hidden text-center mb-6">
                <div class="relative inline-block mb-3 mt-10">
                    <div class="absolute inset-0 bg-primary-500/20 rounded-2xl blur-lg"></div>
                    <div class="relative bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl p-3 border border-gray-200/50 dark:border-gray-700/50">
                        <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="Logo" class="h-10 mx-auto">
                    </div>
                </div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Two-Factor Auth</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Enter verification code</p>
            </div>
            
            <!-- Enhanced Alerts -->
            @if (Session::has('message'))
                <div class="bg-red-50/90 dark:bg-red-900/30 backdrop-blur-sm border border-red-200/50 dark:border-red-800/50 text-red-700 dark:text-red-300 p-3 mb-4 rounded-xl" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2 text-red-500 text-sm"></i>
                        <p class="text-sm font-medium">{{ session('message') }}</p>
                    </div>
                </div>
            @endif
            
            @if (Session::has('success'))
                <div class="bg-green-50/90 dark:bg-green-900/30 backdrop-blur-sm border border-green-200/50 dark:border-green-800/50 text-green-700 dark:text-green-300 p-3 mb-4 rounded-xl" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-500 text-sm"></i>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            
            <!-- Enhanced Verification Card -->
            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 pt-6 pb-4 border-b border-gray-100/50 dark:border-gray-700/50 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary-100/50 dark:bg-primary-800/50 backdrop-blur-sm mb-4">
                        <i class="fas fa-shield-alt text-2xl text-primary-600 dark:text-primary-300"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Two-Factor Authentication</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Enter the 6-digit code sent to your email</p>
                </div>
                
                <!-- Verification Form -->
                <div class="px-6 pb-6 pt-4">
                    <form method="POST" action="{{ route('two-factor.verify') }}" class="space-y-4">
                        @csrf
                        
                        <!-- Verification Code Field -->
                        <div class="space-y-1">
                            <label for="two_factor_code" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 text-center">Verification Code</label>
                            <div class="input-wrapper group">
                                <div class="relative">
                                    <div class="input-icon group-focus-within:text-primary-500 transition-colors z-10">
                                        <i class="fas fa-key text-sm"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="two_factor_code" 
                                        name="two_factor_code" 
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-center tracking-widest text-lg font-semibold" 
                                        placeholder="XXXXXX" 
                                        maxlength="6" 
                                        autocomplete="off" 
                                        required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button 
                                type="submit"
                                class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 dark:from-primary-700 dark:to-primary-800 dark:hover:from-primary-600 dark:hover:to-primary-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center group text-sm">
                                <i class="fas fa-sign-in-alt mr-2 group-hover:translate-x-1 transition-transform text-sm"></i>
                                <span>Verify and Login</span>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Action Buttons -->
                    <div class="mt-4 space-y-3">
                        <a href="{{ route('two-factor.resend') }}"
                           onclick="event.preventDefault(); document.getElementById('resend-form').submit();"
                           class="w-full py-3 px-4 bg-gray-100/90 dark:bg-gray-700/90 hover:bg-gray-200/90 dark:hover:bg-gray-600/90 text-gray-800 dark:text-gray-200 font-medium rounded-xl transition-all duration-300 flex items-center justify-center group text-sm backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50">
                            <i class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform text-sm"></i>
                            Resend Verification Code
                        </a>
                        <form id="resend-form" action="{{ route('two-factor.resend') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                        
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="w-full py-3 px-4 bg-red-50/90 dark:bg-red-900/30 hover:bg-red-100/90 dark:hover:bg-red-800/30 text-red-700 dark:text-red-300 font-medium rounded-xl transition-all duration-300 flex items-center justify-center group text-sm backdrop-blur-sm border border-red-200/50 dark:border-red-800/50">
                            <i class="fas fa-sign-out-alt mr-2 group-hover:translate-x-1 transition-transform text-sm"></i>
                            Sign Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Help Information -->
            <div class="mt-6 bg-gray-50/50 dark:bg-gray-700/30 backdrop-blur-sm rounded-xl p-4 border border-gray-200/30 dark:border-gray-600/30">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2 flex items-center">
                    <i class="fas fa-question-circle mr-2 text-primary-500 text-xs"></i>
                    Didn't get the code?
                </h3>
                <ul class="text-xs text-gray-600 dark:text-gray-400 space-y-1">
                    <li class="flex items-center">
                        <i class="fas fa-dot-circle mr-2 text-gray-400 text-xs"></i>
                        Check your spam folder
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-dot-circle mr-2 text-gray-400 text-xs"></i>
                        Code expires after 10 minutes
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-dot-circle mr-2 text-gray-400 text-xs"></i>
                        Verify your email address
                    </li>
                </ul>
            </div>
            
            <!-- Footer -->
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500 dark:text-gray-500 max-w-xs mx-auto leading-relaxed">
                    &copy; {{ date('Y') }} {{ $settings->site_name }}. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Focus on verification code input
        document.getElementById('two_factor_code').focus();
        
        // Auto-submit when 6 digits are entered
        document.getElementById('two_factor_code').addEventListener('input', function(e) {
            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');
            
            if (this.value.length === 6) {
                // Add a small delay to allow the user to see the completed code
                setTimeout(() => {
                    this.form.submit();
                }, 300);
            }
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
</style>
@endsection
