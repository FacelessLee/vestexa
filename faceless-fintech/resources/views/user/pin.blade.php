@extends('layouts.auth')
@section('title', 'PIN Verification')
@section('content')

<div x-data="{
    pin: '',
    maxLength: 4,
    isProcessing: false,
    errorMessage: '',
    successMessage: '',
    isMobile: window.innerWidth < 768,
    
    init() {
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 768;
        });
        
        // Auto-submit when complete (for mobile)
        this.$watch('pin', value => {
            if (value.length === this.maxLength && this.isMobile) {
                setTimeout(() => this.submitPin(), 300);
            }
        });
    },
    
    addDigit(digit) {
        if (this.pin.length < this.maxLength) {
            this.pin += digit;
            // Add haptic feedback for mobile
            if (this.isMobile && window.navigator.vibrate) {
                window.navigator.vibrate(50);
            }
        }
    },
    
    removeDigit() {
        this.pin = this.pin.slice(0, -1);
    },
    
    clearPin() {
        this.pin = '';
    },
    
    async submitPin() {
        if (this.pin.length < this.maxLength) {
            this.errorMessage = 'Please enter all 4 digits';
            setTimeout(() => this.errorMessage = '', 3000);
            return;
        }
        
        this.isProcessing = true;
        
        try {
            const response = await fetch('{{ route('pinstatus') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ pin: this.pin })
            });
            
            const result = await response.json();
            
            if (result.success) {
                this.successMessage = result.message || 'PIN verified successfully!';
                setTimeout(() => window.location.href = result.redirect || '{{ route('dashboard') }}', 1500);
            } else {
                this.errorMessage = result.message || 'Invalid PIN. Please try again.';
                
                // Error animation
                const pinContainer = document.querySelector('.pin-dots');
                if (pinContainer) {
                    pinContainer.classList.add('animate-shake');
                    setTimeout(() => pinContainer.classList.remove('animate-shake'), 500);
                }
                
                this.pin = '';
                setTimeout(() => this.errorMessage = '', 3000);
            }
        } catch (error) {
            this.errorMessage = 'An error occurred. Please try again.';
            setTimeout(() => this.errorMessage = '', 3000);
        } finally {
            this.isProcessing = false;
        }
    }
}" class="min-h-screen">

    <!-- Mobile Design (matching the image) -->
    <div class="md:hidden h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-black text-gray-900 dark:text-white flex flex-col overflow-hidden">
        
        <!-- Header Section - More Compact -->
        <div class="flex flex-col items-center justify-center mt-10 px-6 py-4">
            <!-- User Avatar -->
            <div class="relative mb-4">
                <div class="w-20 h-20 rounded-full overflow-hidden border-3 border-gray-300 dark:border-white/20 shadow-2xl">
                   <img
                        src="{{ asset('storage/app/public/photos/'.Auth::user()->profile_photo_path)}}"
                        alt="{{ Auth::user()->name }}"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF';"
                        class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
                </div>
                <!-- Status indicator -->
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-900 flex items-center justify-center">
                    <i class="fas fa-check text-xs text-white"></i>
                </div>
            </div>
            
            <!-- Welcome Text -->
            <div class="text-center mb-4">
                <h1 class="text-xl font-bold mb-1">Welcome Back</h1>
                <p class="text-gray-600 dark:text-gray-300 text-sm">{{ Auth::user()->name }}</p>
            </div>
            
            <!-- Security Icon -->
            <div class="mb-3">
                <div class="w-10 h-10 bg-green-100 dark:bg-green-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-lock text-green-600 dark:text-green-400 text-sm"></i>
                </div>
            </div>
            
            <!-- Passcode Label -->
            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 flex items-center">
                <i class="fas fa-shield-alt mr-2"></i>
                Passcode
            </p>
            
            <!-- PIN Dots -->
            <div class="pin-dots mb-6">
                <template x-for="(digit, index) in Array.from({length: maxLength})">
                    <div 
                        class="w-3 h-3 rounded-full transition-all duration-300"
                        :class="index < pin.length ? 'bg-primary-600 dark:bg-white scale-110' : 'bg-gray-300 dark:bg-white/30'">
                    </div>
                </template>
            </div>
            
            <!-- Error Message -->
            <div 
                x-show="errorMessage" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="text-red-600 dark:text-red-400 text-sm text-center mb-2">
                <span x-text="errorMessage"></span>
            </div>
            
            <!-- Success Message -->
            <div 
                x-show="successMessage" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="text-green-600 dark:text-green-400 text-sm text-center mb-2">
                <span x-text="successMessage"></span>
            </div>
        </div>
        
        <!-- Keypad Section - More Compact -->
        <div class="px-6 ml-10 mt-10 pb-6">
            <div class="grid grid-cols-3 gap-4 max-w-xs mx-auto">
                <!-- Numbers 1-9 -->
                <template x-for="n in 9">
                    <button 
                        type="button"
                        @click="addDigit(n)"
                        :disabled="isProcessing || pin.length >= maxLength"
                        class="w-16 h-16 rounded-full bg-white border border-gray-200 shadow-sm dark:bg-white/10 dark:border-white/20 dark:backdrop-blur-md text-gray-900 dark:text-white text-xl font-semibold flex items-center justify-center transition-all duration-200 hover:bg-gray-50 dark:hover:bg-white/20 hover:scale-105 active:scale-95 ripple"
                        :class="{'opacity-50 cursor-not-allowed': isProcessing || pin.length >= maxLength}">
                        <span x-text="n"></span>
                    </button>
                </template>
                
                <!-- Sign Out -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button 
                        type="submit"
                        class="w-16 h-16 rounded-full bg-white border border-gray-200 shadow-sm dark:bg-white/10 dark:border-white/20 dark:backdrop-blur-md text-red-600 dark:text-red-400 flex items-center justify-center transition-all duration-200 hover:bg-gray-50 dark:hover:bg-white/20 hover:scale-105 active:scale-95">
                        <i class="fas fa-sign-out-alt text-lg"></i>
                    </button>
                </form>
                
                <!-- Number 0 -->
                <button 
                    type="button"
                    @click="addDigit(0)"
                    :disabled="isProcessing || pin.length >= maxLength"
                    class="w-16 h-16 rounded-full bg-white border border-gray-200 shadow-sm dark:bg-white/10 dark:border-white/20 dark:backdrop-blur-md text-gray-900 dark:text-white text-xl font-semibold flex items-center justify-center transition-all duration-200 hover:bg-gray-50 dark:hover:bg-white/20 hover:scale-105 active:scale-95 ripple"
                    :class="{'opacity-50 cursor-not-allowed': isProcessing || pin.length >= maxLength}">
                    0
                </button>
                
                <!-- Backspace -->
                <button 
                    type="button"
                    @click="removeDigit()"
                    :disabled="isProcessing || pin.length === 0"
                    class="w-16 h-16 rounded-full bg-primary-600 hover:bg-primary-700 text-white flex items-center justify-center transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg"
                    :class="{'opacity-50 cursor-not-allowed': isProcessing || pin.length === 0}">
                    <i class="fas fa-backspace text-lg"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Desktop Design -->
    <div class="hidden md:flex min-h-screen bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800">
        
        <!-- Left Panel - Branding -->
        <div class="flex-1 flex items-center justify-center p-12 relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-20 w-32 h-32 bg-white rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-20 w-24 h-24 bg-white rounded-full animate-pulse delay-300"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white rounded-full animate-pulse delay-700"></div>
            </div>
            
            <div class="relative z-10 text-center text-white">
                <div class="mb-8">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-3xl"></i>
                    </div>
                    <h1 class="text-4xl font-bold mb-4">Secure Access</h1>
                    <p class="text-xl text-white/90 mb-8">Your security is our priority</p>
                </div>
                
                <div class="grid grid-cols-2 gap-6 max-w-md">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-lock text-lg"></i>
                        </div>
                        <p class="text-sm">Encrypted</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-fingerprint text-lg"></i>
                        </div>
                        <p class="text-sm">Biometric</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-user-shield text-lg"></i>
                        </div>
                        <p class="text-sm">Protected</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-clock text-lg"></i>
                        </div>
                        <p class="text-sm">24/7 Secure</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Panel - PIN Entry -->
        <div class="flex-1 flex items-center justify-center p-12">
            <div class="w-full max-w-md desktop-pin-container rounded-3xl p-8 shadow-2xl">
                
                <!-- User Info -->
                <div class="text-center mb-8">
                    <div class="relative inline-block mb-4">
                        <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-primary-200 dark:border-primary-700">
                            <img 
                                src="{{$settings->site_address}}/storage/app/public/photos/{{Auth::user()->profile_photo_path}}" 
                                alt="{{ Auth::user()->name }}" 
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF';"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-primary-600 rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-xs text-white"></i>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome Back</h2>
                    <p class="text-gray-600 dark:text-gray-300">{{ Auth::user()->name }}</p>
                </div>
                
                <!-- PIN Input -->
                <div class="mb-6">
                    <label for="desktop-pin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3 text-center">
                        <i class="fas fa-lock mr-2"></i>
                        Enter your 4-digit PIN
                    </label>
                    <input 
                        id="desktop-pin"
                        type="password" 
                        inputmode="numeric"
                        maxlength="4"
                        pattern="[0-9]*"
                        x-model="pin"
                        :disabled="isProcessing"
                        class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-center text-2xl tracking-widest transition-all duration-300 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        placeholder="••••">
                </div>
                
                <!-- Error/Success Messages -->
                <div 
                    x-show="errorMessage" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-center text-red-600 dark:text-red-400 text-sm">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span x-text="errorMessage"></span>
                </div>
                
                <div 
                    x-show="successMessage" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="mb-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-center text-green-600 dark:text-green-400 text-sm">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span x-text="successMessage"></span>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="button"
                    @click="submitPin()"
                    :disabled="isProcessing || pin.length !== maxLength"
                    class="w-full py-4 bg-primary-600 hover:bg-primary-700 disabled:bg-gray-300 dark:disabled:bg-gray-600 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 disabled:transform-none disabled:cursor-not-allowed shadow-lg hover:shadow-xl"
                    :class="{'opacity-50 cursor-not-allowed': isProcessing || pin.length !== maxLength}">
                    <template x-if="!isProcessing">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-shield-check mr-2"></i>
                            Verify PIN
                        </div>
                    </template>
                    <template x-if="isProcessing">
                        <div class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Verifying...
                        </div>
                    </template>
                </button>
                
                <!-- Security Notice -->
                <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <i class="fas fa-info-circle mr-2 text-primary-500"></i>
                        <span>Your PIN is encrypted and secure. We never store your PIN in plain text.</span>
                    </div>
                </div>
                
                <!-- Account Status Warning -->
                @if(Auth::user()->status == 'blocked')
                <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                    <div class="flex items-center text-sm text-red-600 dark:text-red-400">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <div>
                            <p class="font-medium">Account Blocked</p>
                            <p class="mt-1">Your account has been blocked for security reasons. Please contact support.</p>
                            <a href="mailto:{{$settings->contact_email}}" class="inline-flex items-center mt-2 text-red-700 dark:text-red-300 hover:text-red-800 dark:hover:text-red-200">
                                <i class="fas fa-envelope mr-1"></i>
                                Contact Support
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Disable scroll on mobile for PIN page
        if (window.innerWidth < 768) {
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
        }
        
        // Focus the desktop PIN input field if visible
        const pinInput = document.getElementById('desktop-pin');
        if (pinInput && window.innerWidth >= 768) {
            pinInput.focus();
            
            // Only allow numbers in the PIN input
            pinInput.addEventListener('keypress', function(e) {
                const charCode = (e.which) ? e.which : e.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    e.preventDefault();
                    return false;
                }
                return true;
            });
        }
        
        // Re-enable scroll when leaving the page
        window.addEventListener('beforeunload', function() {
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        });
    });
</script>
@endsection