@extends('layouts.guest2')

@section('title', 'Create Account')
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
                Join {{ $settings->site_name }}
            </h1>
            <h2 class="text-lg font-semibold mb-6 text-center text-white/90">
                Create Your Banking Account
            </h2>
            
            <!-- Description -->
            <p class="text-sm mb-8 max-w-md text-center text-white/80 leading-relaxed">
                Start your financial journey with {{ $settings->site_name }}. Secure, fast, and reliable banking at your fingertips.
            </p>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-2 gap-4 w-full max-w-md">
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-shield-alt text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Secure Platform</h3>
                        <p class="text-xs text-white/70">Bank-grade security</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-bolt text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Fast Transfers</h3>
                        <p class="text-xs text-white/70">Instant payments</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-clock text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">24/7 Access</h3>
                        <p class="text-xs text-white/70">Always available</p>
                    </div>
                </div>
                <div class="group flex items-center space-x-3 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-globe text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold">Global Banking</h3>
                        <p class="text-xs text-white/70">Worldwide access</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Registration Form -->
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
                <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Create Account</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Join {{ $settings->site_name }} today</p>
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
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-triangle mr-2 text-red-500 text-sm"></i>
                        <p class="text-sm font-medium">Please fix the following errors:</p>
                    </div>
                    <ul class="text-sm space-y-1 ml-6">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center">
                                <i class="fas fa-dot-circle mr-2 text-red-400 text-xs"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Registration Card -->
            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
                <!-- Progress Header -->
                <div class="px-6 pt-6 pb-4 border-b border-gray-100/50 dark:border-gray-700/50">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Create Account</h2>
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Step <span id="current-step">1</span> of 4</span>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="h-1.5 w-full bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden mb-2">
                        <div id="progress-bar" class="h-full bg-gradient-to-r from-primary-600 to-primary-700 rounded-full transition-all duration-500 ease-in-out" style="width: 25%"></div>
                    </div>
                    
                    <!-- Step Indicators -->
                    <div class="flex justify-between text-xs">
                        <div class="flex flex-col items-center">
                            <div id="step-1-indicator" class="w-6 h-6 rounded-full bg-primary-600 text-white flex items-center justify-center mb-1">
                                <i class="fas fa-user text-xs"></i>
                            </div>
                            <span class="text-primary-600 dark:text-primary-400 font-medium">Personal</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div id="step-2-indicator" class="w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-600 text-gray-500 flex items-center justify-center mb-1">
                                <i class="fas fa-envelope text-xs"></i>
                            </div>
                            <span class="text-gray-500 dark:text-gray-400">Contact</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div id="step-3-indicator" class="w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-600 text-gray-500 flex items-center justify-center mb-1">
                                <i class="fas fa-university text-xs"></i>
                            </div>
                            <span class="text-gray-500 dark:text-gray-400">Account</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div id="step-4-indicator" class="w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-600 text-gray-500 flex items-center justify-center mb-1">
                                <i class="fas fa-lock text-xs"></i>
                            </div>
                            <span class="text-gray-500 dark:text-gray-400">Security</span>
                        </div>
                    </div>
                </div>
                
                <!-- Form Container -->
                <div class="px-6 pb-6 pt-4">
                    <form action="{{ route('register') }}" method="post" id="registration-form">
                        @csrf
                        
                        <!-- Step 1: Personal Information -->
                        <div id="step-1" class="step-content">
                            <div class="text-center mb-4">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary-100/50 dark:bg-primary-800/50 backdrop-blur-sm mb-3">
                                    <i class="fas fa-user text-lg text-primary-600 dark:text-primary-300"></i>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-1">Personal Information</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Tell us about yourself</p>
                            </div>
                            
                            <div class="space-y-3">
                                <!-- First Name -->
                                <div class="space-y-1">
                                    <label for="name" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">First Name *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-user text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="text" 
                                            id="name" 
                                            name="name" 
                                            value="{{ old('name') }}"
                                            class="w-full pl-10 pr-3 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="John" 
                                            required>
                                    </div>
                                </div>
                                
                                <!-- Last Name -->
                                <div class="space-y-1">
                                    <label for="lastname" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Last Name *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-user text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="text" 
                                            id="lastname" 
                                            name="lastname" 
                                            value="{{ old('lastname') }}"
                                            class="w-full pl-10 pr-3 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="Smith" 
                                            required>
                                    </div>
                                </div>
                                
                                <!-- Middle Name -->
                                <div class="space-y-1">
                                    <label for="middlename" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Middle Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-user text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="text" 
                                            id="middlename" 
                                            name="middlename" 
                                            value="{{ old('middlename') }}"
                                            class="w-full pl-10 pr-3 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="David">
                                    </div>
                                </div>
                                
                                <!-- Username -->
                                <div class="space-y-1">
                                    <label for="username" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Username *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-at text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="text" 
                                            id="username" 
                                            name="username" 
                                            value="{{ old('username') }}"
                                            class="w-full pl-10 pr-3 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="johnsmith123" 
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2: Contact Information -->
                        <div id="step-2" class="step-content" style="display: none;">
                            <div class="text-center mb-4">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary-100/50 dark:bg-primary-800/50 backdrop-blur-sm mb-3">
                                    <i class="fas fa-envelope text-lg text-primary-600 dark:text-primary-300"></i>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-1">Contact Information</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400">How can we reach you?</p>
                            </div>
                            
                            <div class="space-y-3">
                                <!-- Email -->
                                <div class="space-y-1">
                                    <label for="email" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Email Address *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="email" 
                                            id="email" 
                                            name="email" 
                                            value="{{ old('email') }}"
                                            class="w-full pl-10 pr-3 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="john@example.com" 
                                            required>
                                    </div>
                                </div>
                                
                                <!-- Phone -->
                                <div class="space-y-1">
                                    <label for="phone" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Phone Number *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-phone text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="tel" 
                                            id="phone" 
                                            name="phone" 
                                            value="{{ old('phone') }}"
                                            class="w-full pl-10 pr-3 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="+1 (234) 567-8901" 
                                            required>
                                    </div>
                                </div>
                                
                                <!-- Country -->
                                <div class="space-y-1">
                                    <label for="country" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Country *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-globe text-gray-400 text-sm"></i>
                                        </div>
                                        <select 
                                            id="country" 
                                            name="country" 
                                            class="w-full pl-10 pr-8 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm appearance-none" 
                                            required>
                                            <option value="" disabled selected>Select Country</option>
                                            @include('auth.countries')
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 3: Account Setup -->
                        <div id="step-3" class="step-content" style="display: none;">
                            <div class="text-center mb-4">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary-100/50 dark:bg-primary-800/50 backdrop-blur-sm mb-3">
                                    <i class="fas fa-university text-lg text-primary-600 dark:text-primary-300"></i>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-1">Account Setup</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Choose your account preferences</p>
                            </div>
                            
                            <div class="space-y-3">
                                <!-- Currency -->
                                <div class="space-y-1">
                                    <label for="curr" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Currency *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-dollar-sign text-gray-400 text-sm"></i>
                                        </div>
                                        <select 
                                            id="curr" 
                                            name="curr" 
                                            class="w-full pl-10 pr-8 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm appearance-none" 
                                            required>
                                            <option value="" disabled selected>Select Currency</option>
                                            @include('partials.currencies')
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Account Type -->
                                <div class="space-y-1">
                                    <label for="accounttype" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Account Type *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-university text-gray-400 text-sm"></i>
                                        </div>
                                        <select 
                                            id="accounttype" 
                                            name="accounttype" 
                                            class="w-full pl-10 pr-8 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm appearance-none" 
                                            required>
                                            <option value="" disabled selected>Select Account Type</option>
                                            <option value="Checking Account">Checking Account</option>
                                            <option value="Savings Account">Savings Account</option>
                                            <option value="Fixed Deposit Account">Fixed Deposit Account</option>
                                            <option value="Current Account">Current Account</option>
                                            <option value="Business Account">Business Account</option>
                                            <option value="Investment Account">Investment Account</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Transaction PIN -->
                                <div class="space-y-1">
                                    <label for="pin" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Transaction PIN *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-key text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="password" 
                                            id="pin" 
                                            name="pin" 
                                            class="w-full pl-10 pr-12 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="4-digit PIN" 
                                            maxlength="4" 
                                            required>
                                        <button 
                                            type="button" 
                                            onclick="togglePassword('pin')"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-primary-500 transition-colors">
                                            <i class="fas fa-eye text-sm" id="pin-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 4: Security -->
                        <div id="step-4" class="step-content" style="display: none;">
                            <div class="text-center mb-4">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary-100/50 dark:bg-primary-800/50 backdrop-blur-sm mb-3">
                                    <i class="fas fa-lock text-lg text-primary-600 dark:text-primary-300"></i>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-1">Security Setup</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Secure your account</p>
                            </div>
                            
                            <div class="space-y-3">
                                <!-- Password -->
                                <div class="space-y-1">
                                    <label for="password" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Password *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-lock text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="password" 
                                            id="password" 
                                            name="password" 
                                            class="w-full pl-10 pr-12 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="Create strong password" 
                                            required>
                                        <button 
                                            type="button" 
                                            onclick="togglePassword('password')"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-primary-500 transition-colors">
                                            <i class="fas fa-eye text-sm" id="password-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Confirm Password -->
                                <div class="space-y-1">
                                    <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Confirm Password *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                            <i class="fas fa-lock text-gray-400 text-sm"></i>
                                        </div>
                                        <input 
                                            type="password" 
                                            id="password_confirmation" 
                                            name="password_confirmation" 
                                            class="w-full pl-10 pr-12 py-3 border border-gray-300/50 dark:border-gray-600/50 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 backdrop-blur-sm transition-all duration-300 text-sm" 
                                            placeholder="Confirm your password" 
                                            required>
                                        <button 
                                            type="button" 
                                            onclick="togglePassword('password_confirmation')"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-primary-500 transition-colors">
                                            <i class="fas fa-eye text-sm" id="password_confirmation-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Terms and Conditions -->
                                <div class="flex items-start space-x-2 pt-1">
                                    <input 
                                        type="checkbox" 
                                        id="terms" 
                                        name="terms" 
                                        class="mt-1 w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2" 
                                        required>
                                    <label for="terms" class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                                        I agree to the <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium">Terms of Service</a> and <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hidden Currency Symbol Field -->
                        <input type="hidden" name="s_curr" id="s_curr">
                        
                        <!-- Navigation Buttons -->
                        <div class="flex justify-between pt-4">
                            <button 
                                type="button" 
                                id="prev-btn" 
                                class="px-4 py-3 bg-gray-100/90 dark:bg-gray-700/90 hover:bg-gray-200/90 dark:hover:bg-gray-600/90 text-gray-800 dark:text-gray-200 font-medium rounded-xl transition-all duration-300 flex items-center group text-sm backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50" 
                                style="display: none;">
                                <i class="fas fa-chevron-left mr-2 group-hover:-translate-x-1 transition-transform text-sm"></i>
                                Previous
                            </button>
                            
                            <button 
                                type="button" 
                                id="next-btn" 
                                class="ml-auto px-4 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 dark:from-primary-700 dark:to-primary-800 dark:hover:from-primary-600 dark:hover:to-primary-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center group text-sm">
                                Next
                                <i class="fas fa-chevron-right ml-2 group-hover:translate-x-1 transition-transform text-sm"></i>
                            </button>
                            
                            <button 
                                type="submit" 
                                id="submit-btn" 
                                class="ml-auto px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center group text-sm" 
                                style="display: none;">
                                <i class="fas fa-user-plus mr-2 group-hover:translate-x-1 transition-transform text-sm"></i>
                                Create Account
                            </button>
                        </div>
                    </form>
                    
                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-semibold transition-colors">
                                Sign In
                            </a>
                        </p>
                    </div>
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
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let currentStep = 1;
    const totalSteps = 4;

    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const eye = document.getElementById(fieldId + '-eye');
        
        if (field.type === 'password') {
            field.type = 'text';
            eye.classList.remove('fa-eye');
            eye.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            eye.classList.remove('fa-eye-slash');
            eye.classList.add('fa-eye');
        }
    }

    function updateProgress() {
        const progressPercentage = (currentStep / totalSteps) * 100;
        $('#progress-bar').css('width', progressPercentage + '%');
        $('#current-step').text(currentStep);
        
        // Update step indicators
        for (let i = 1; i <= totalSteps; i++) {
            const indicator = $(`#step-${i}-indicator`);
            const label = indicator.next('span');
            
            if (i <= currentStep) {
                indicator.removeClass('bg-gray-300 dark:bg-gray-600 text-gray-500')
                        .addClass('bg-primary-600 text-white');
                label.removeClass('text-gray-500 dark:text-gray-400')
                     .addClass('text-primary-600 dark:text-primary-400 font-medium');
            } else {
                indicator.removeClass('bg-primary-600 text-white')
                        .addClass('bg-gray-300 dark:bg-gray-600 text-gray-500');
                label.removeClass('text-primary-600 dark:text-primary-400 font-medium')
                     .addClass('text-gray-500 dark:text-gray-400');
            }
        }
    }

    function showStep(step) {
        $('.step-content').hide();
        $(`#step-${step}`).fadeIn(300);
        
        // Update navigation buttons
        if (step === 1) {
            $('#prev-btn').hide();
        } else {
            $('#prev-btn').show();
        }
        
        if (step === totalSteps) {
            $('#next-btn').hide();
            $('#submit-btn').show();
        } else {
            $('#next-btn').show();
            $('#submit-btn').hide();
        }
        
        updateProgress();
    }

    function validateStep(step) {
        let isValid = true;
        const requiredFields = $(`#step-${step} input[required], #step-${step} select[required]`);
        
        requiredFields.each(function() {
            const field = $(this);
            const value = field.val().trim();
            
            if (!value) {
                field.addClass('border-red-500 focus:border-red-500 focus:ring-red-500');
                isValid = false;
            } else {
                field.removeClass('border-red-500 focus:border-red-500 focus:ring-red-500');
            }
        });
        
        // Additional validation for step 4 (passwords)
        if (step === 4) {
            const password = $('#password').val();
            const confirmPassword = $('#password_confirmation').val();
            const terms = $('#terms').is(':checked');
            
            if (password !== confirmPassword) {
                $('#password_confirmation').addClass('border-red-500 focus:border-red-500 focus:ring-red-500');
                isValid = false;
            }
            
            if (!terms) {
                isValid = false;
            }
        }
        
        return isValid;
    }

    $(document).ready(function() {
        // Initialize first step
        showStep(1);
        
        // Next button click
        $('#next-btn').click(function() {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        });
        
        // Previous button click
        $('#prev-btn').click(function() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
        
        // PIN input validation (numbers only, max 4 digits)
        $('#pin').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);
        });
        
        // Currency symbol handling
        $('#curr').change(function() {
            const selectedOption = $(this).find('option:selected');
            const symbol = selectedOption.data('symbol');
            if (symbol) {
                $('#s_curr').val(symbol);
            }
        });
        
        // Real-time validation feedback
        $('input[required], select[required]').on('blur', function() {
            const field = $(this);
            const value = field.val().trim();
            
            if (!value) {
                field.addClass('border-red-500 focus:border-red-500 focus:ring-red-500');
            } else {
                field.removeClass('border-red-500 focus:border-red-500 focus:ring-red-500');
            }
        });
        
        // Password confirmation validation
        $('#password_confirmation').on('input', function() {
            const password = $('#password').val();
            const confirmPassword = $(this).val();
            
            if (password !== confirmPassword) {
                $(this).addClass('border-red-500 focus:border-red-500 focus:ring-red-500');
            } else {
                $(this).removeClass('border-red-500 focus:border-red-500 focus:ring-red-500');
            }
        });
        
        // Add ripple effect to buttons
        $('button, a').on('click', function(e) {
            const button = $(this);
            const ripple = $('<span class="ripple"></span>');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.css({
                width: size + 'px',
                height: size + 'px',
                left: x + 'px',
                top: y + 'px'
            });
            
            button.append(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
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
    
    .floating-slow {
        animation: float 8s ease-in-out infinite;
    }
    
    .floating {
        animation: float 6s ease-in-out infinite;
    }
    
    .floating-slower {
        animation: float 10s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .step-content {
        min-height: 320px;
    }
    
    /* Custom focus styles */
    input:focus, select:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    /* Smooth transitions for form elements */
    input, select, button {
        transition: all 0.3s ease;
    }
    
    /* Enhanced button hover effects */
    button:hover {
        transform: translateY(-1px);
    }
    
    button:active {
        transform: translateY(0);
    }
    
    /* Better mobile responsiveness */
    @media (max-width: 768px) {
        .step-content {
            min-height: 280px;
        }
    }
    
    /* Enhanced form field styling */
    input[type="text"], input[type="email"], input[type="tel"], input[type="password"], select {
        font-size: 16px; /* Prevents zoom on iOS */
    }
    
    /* Better checkbox styling */
    input[type="checkbox"] {
        accent-color: rgb(59 130 246);
    }
    
    /* Ensure icons are properly positioned */
    .relative .absolute {
        z-index: 10;
    }
</style>
@endsection 