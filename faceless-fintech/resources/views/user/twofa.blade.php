@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div class="p-4 space-y-4">
    <!-- Mobile Header -->
    <div class="lg:hidden mb-2">
        @include('partials._mobile_header', [
            'title' => 'Two-Factor Authentication',
            'showBackButton' => true,
            'backUrl' => route('profile'),
            'showNotifications' => true,
            'showDarkMode' => true,
            'financeUser' => Auth::user()
        ])
    </div>

    <!-- Desktop Header -->
    <div class="hidden lg:block">
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg font-bold text-gray-900 dark:text-white">Two-Factor Authentication</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Add an extra layer of security to your account</p>
                </div>
                <div class="w-8 h-8 bg-primary-500 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield text-white text-sm"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Main Content Area -->
        <div class="lg:col-span-2">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <!-- Content Header -->
                <div class="border-b border-gray-200/50 dark:border-gray-700/50 px-4 py-3">
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-primary-500 rounded-lg flex items-center justify-center mr-2">
                            <i class="fa-solid fa-shield text-white text-xs"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-gray-900 dark:text-white">Email-Based Two-Factor Authentication</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Add an extra layer of security to your account</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-4">
                    <!-- Alerts -->
                    <x-danger-alert />
                    <x-success-alert />
                    <x-error-alert />

                    <!-- Status Badge -->
                    <div class="flex items-center mb-3">
                        @if(auth()->user()->two_factor_enabled)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                <i class="fa-solid fa-shield-check text-xs mr-1"></i> Enabled
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-shield-exclamation text-xs mr-1"></i> Disabled
                            </span>
                        @endif
                        <span class="ml-2 text-gray-500 dark:text-gray-400 text-xs">Current Status</span>
                    </div>
                    
                    <p class="text-gray-600 dark:text-gray-300 mb-3 text-xs">
                        When enabled, a 6-digit verification code will be sent to your email address <strong class="text-primary-600 dark:text-primary-400">{{ auth()->user()->email }}</strong> each time you log in to your account.
                    </p>

                    <!-- How it Works Card -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-3 border border-blue-100 dark:border-blue-800/50 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-info-circle text-blue-500 text-sm"></i>
                            </div>
                            <div class="ml-2">
                                <h3 class="text-xs font-medium text-blue-800 dark:text-blue-300">How Two-Factor Authentication Works</h3>
                                <div class="mt-1 text-xs text-blue-700 dark:text-blue-400">
                                    <ul class="list-disc pl-3 space-y-0.5">
                                        <li>When you log in with your password, a 6-digit code will be sent to your email</li>
                                        <li>You must enter this code to complete your login</li>
                                        <li>This adds an extra layer of security to your account</li>
                                        <li>The code expires after 10 minutes for security</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Toggle Button -->
                    <form action="{{ route('two-factor.toggle') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-2 border rounded-xl text-xs font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors {{ auth()->user()->two_factor_enabled ? 'border-red-300 text-red-700 bg-white hover:bg-red-50 focus:ring-red-500 dark:border-red-600 dark:text-red-400 dark:bg-gray-800 dark:hover:bg-red-900/20' : 'border-transparent text-white bg-primary-600 hover:bg-primary-700 focus:ring-primary-500' }}">
                            @if(auth()->user()->two_factor_enabled)
                                <i class="fa-solid fa-shield-exclamation text-xs mr-1"></i> Disable Two-Factor Authentication
                            @else
                                <i class="fa-solid fa-shield text-xs mr-1"></i> Enable Two-Factor Authentication
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Tips Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <!-- Header -->
                <div class="border-b border-gray-200/50 dark:border-gray-700/50 px-4 py-3">
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-primary-500 rounded-lg flex items-center justify-center mr-2">
                            <i class="fa-solid fa-lightbulb text-white text-xs"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">Security Tips</h3>
                    </div>
                </div>
                
                <!-- Tips List -->
                <div class="p-4">
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fa-solid fa-check-circle text-green-500 text-xs mr-2 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700 dark:text-gray-300 text-xs">Use a strong, unique password</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check-circle text-green-500 text-xs mr-2 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700 dark:text-gray-300 text-xs">Enable two-factor authentication</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check-circle text-green-500 text-xs mr-2 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700 dark:text-gray-300 text-xs">Keep your email secure</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check-circle text-green-500 text-xs mr-2 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700 dark:text-gray-300 text-xs">Log out when using shared devices</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check-circle text-green-500 text-xs mr-2 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700 dark:text-gray-300 text-xs">Regularly check your account activity</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
