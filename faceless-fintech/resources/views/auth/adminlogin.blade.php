@extends('layouts.guest2')

@section('title', 'Manager Login')
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
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900/20 via-transparent to-primary-600/20"></div>
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
            
            <!-- Title with Enhanced Typography -->
            <h1 class="text-3xl font-black mb-3 text-center bg-gradient-to-r from-white via-white to-white/80 bg-clip-text text-transparent">
                Admin Portal
            </h1>
            <h2 class="text-lg font-semibold mb-6 text-center text-white/90">
                {{ $settings->site_name }} Management
            </h2>
            
            <!-- Description -->
            <p class="text-sm mb-8 max-w-md text-center text-white/80 leading-relaxed">
                Secure administrative access to manage banking operations and user accounts.
            </p>
            
            <!-- Enhanced Features Grid -->
            <div class="grid grid-cols-2 gap-4 w-full max-w-md">
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-shield-alt text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Admin Security</h3>
                        <p class="text-xs text-white/70">Enhanced protection</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-users-cog text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">User Management</h3>
                        <p class="text-xs text-white/70">Full control</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-line text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Analytics</h3>
                        <p class="text-xs text-white/70">Real-time insights</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-cog text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">System Config</h3>
                        <p class="text-xs text-white/70">Platform settings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
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
                <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Admin Portal</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Manager Access</p>
            </div>
            
            <!-- Enhanced Alerts -->
            @if (Session::has('status'))
                <div class="bg-red-50/90 dark:bg-red-900/30 backdrop-blur-sm border border-red-200/50 dark:border-red-800/50 text-red-700 dark:text-red-300 p-3 mb-4 rounded-xl" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2 text-red-500 text-sm"></i>
                        <p class="text-sm font-medium">{{ session('status') }}</p>
                    </div>
                </div>
            @endif
            
            @if ($errors->any())
                <div class="bg-red-50/90 dark:bg-red-900/30 backdrop-blur-sm border border-red-200/50 dark:border-red-800/50 text-red-700 dark:text-red-300 p-3 mb-4 rounded-xl" role="alert">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle mr-2 text-red-500 mt-0.5 text-sm"></i>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm font-medium">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            <!-- Enhanced Login Card -->
            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 pt-6 pb-4 border-b border-gray-100/50 dark:border-gray-700/50">
                    <div class="hidden lg:block">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Manager Login</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Secure access to administration</p>
                    </div>
                    <div class="lg:hidden">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white text-center">Enter Admin Credentials</h2>
                    </div>
                </div>
                
                <!-- Login Form -->
                <div class="px-6 pb-6 pt-4">
                    <form method="POST" action="{{ route('adminlogin') }}" class="space-y-4">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="space-y-1">
                            <label for="email" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Email Address</label>
                            <div class="input-wrapper group">
                                <div class="relative">
                                    <div class="input-icon group-focus-within:text-primary-500 transition-colors z-10">
                                        <i class="fas fa-envelope text-sm"></i>
                                    </div>
                                    <input 
                                        id="email"
                                        type="email" 
                                        name="email" 
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                        placeholder="admin@example.com"
                                        required 
                                        autocomplete="email"
                                        value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Password Field -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Password</label>
                               <!-- <a href="{{ route('admin.forgetpassword') }}" class="text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 transition-colors">
                                    Forgot Password?
                                </a> -->
                            </div>
                            <div class="input-wrapper group">
                                <div class="relative">
                                    <div class="input-icon group-focus-within:text-primary-500 transition-colors z-10">
                                        <i class="fas fa-lock text-sm"></i>
                                    </div>
                                    <input 
                                        id="password"
                                        type="password" 
                                        name="password"
                                        class="w-full pl-10 pr-12 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                        placeholder="Enter admin password"
                                        required
                                        autocomplete="current-password">
                                    <button 
                                        type="button"
                                        onclick="togglePasswordVisibility()"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 dark:text-gray-500 hover:text-primary-500 transition-colors">
                                        <i class="fas fa-eye text-sm" id="show-password"></i>
                                        <i class="fas fa-eye-slash hidden text-sm" id="hide-password"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button 
                                type="submit"
                                class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 dark:from-primary-700 dark:to-primary-800 dark:hover:from-primary-600 dark:hover:to-primary-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center group text-sm">
                                <i class="fas fa-sign-in-alt mr-2 group-hover:translate-x-1 transition-transform text-sm"></i>
                                <span>Access Admin Panel</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Enhanced Footer Links -->
            <div class="mt-6 text-center space-y-3">
                <div class="flex items-center justify-center space-x-4 text-xs">
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium flex items-center">
                        <i class="fas fa-shield-alt mr-1 text-xs"></i>
                        Security
                    </a>
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium flex items-center">
                        <i class="fas fa-headset mr-1 text-xs"></i>
                        Support
                    </a>
                    <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium flex items-center">
                        <i class="fas fa-user mr-1 text-xs"></i>
                        User Login
                    </a>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-500 max-w-xs mx-auto leading-relaxed">
                    &copy; {{ date('Y') }} {{ $settings->site_name }}. All Rights Reserved.
                    Secure Banking Administration Portal.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const showPasswordIcon = document.getElementById('show-password');
        const hidePasswordIcon = document.getElementById('hide-password');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordIcon.classList.add('hidden');
            hidePasswordIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            showPasswordIcon.classList.remove('hidden');
            hidePasswordIcon.classList.add('hidden');
        }
    }

    // Enhanced form interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add floating label effect
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.parentElement.classList.remove('focused');
                }
            });
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
    
    .input-wrapper.focused {
        transform: translateY(-1px);
    }
    
    .input-wrapper.focused .input-icon {
        color: theme('colors.primary.500');
    }
</style>
@endsection