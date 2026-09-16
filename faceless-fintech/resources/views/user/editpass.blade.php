@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div class="p-4 space-y-4">
    <!-- Alerts -->
    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />

    <!-- Mobile Header -->
    <div class="lg:hidden mb-2">
        @include('partials._mobile_header', [
            'title' => 'Security Settings',
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
                    <h1 class="text-lg font-bold text-gray-900 dark:text-white">Security Settings</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Update your account password to maintain security</p>
                </div>
                <div class="w-8 h-8 bg-primary-500 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-shield text-white text-sm"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
        <!-- Content Header -->
        <div class="border-b border-gray-200/50 dark:border-gray-700/50 px-4 py-3">
            <div class="flex items-center">
                <div class="w-6 h-6 bg-primary-500 rounded-lg flex items-center justify-center mr-2">
                    <i class="fa-solid fa-key text-white text-xs"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-gray-900 dark:text-white">Change Password</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Update your account password to maintain security</p>
                </div>
            </div>
        </div>
                
        <!-- Form Content -->
        <div class="p-4">
            <form action="{{route('updateuserpass')}}" method="post" class="space-y-4">
                @csrf
                @method('PUT')
                
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Current Password</label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400 text-xs"></i>
                        </div>
                        <input 
                            :type="showPassword ? 'text' : 'password'" 
                            id="current_password" 
                            name="current_password"
                            class="block w-full pl-8 pr-8 py-2 text-xs border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            placeholder="Enter your current password"
                            required
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button 
                                type="button"
                                @click="showPassword = !showPassword"
                                class="text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 focus:outline-none"
                            >
                                <i x-show="!showPassword" class="fa-solid fa-eye text-xs"></i>
                                <i x-show="showPassword" class="fa-solid fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- New Password -->
                <div>
                    <label for="password" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">New Password</label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-key text-gray-400 text-xs"></i>
                        </div>
                        <input 
                            :type="showPassword ? 'text' : 'password'" 
                            id="password" 
                            name="password"
                            class="block w-full pl-8 pr-8 py-2 text-xs border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            placeholder="Enter your new password"
                            required
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button 
                                type="button"
                                @click="showPassword = !showPassword"
                                class="text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 focus:outline-none"
                            >
                                <i x-show="!showPassword" class="fa-solid fa-eye text-xs"></i>
                                <i x-show="showPassword" class="fa-solid fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm Password</label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-check-circle text-gray-400 text-xs"></i>
                        </div>
                        <input 
                            :type="showPassword ? 'text' : 'password'" 
                            id="password_confirmation" 
                            name="password_confirmation"
                            class="block w-full pl-8 pr-8 py-2 text-xs border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            placeholder="Confirm your new password"
                            required
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button 
                                type="button"
                                @click="showPassword = !showPassword"
                                class="text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 focus:outline-none"
                            >
                                <i x-show="!showPassword" class="fa-solid fa-eye text-xs"></i>
                                <i x-show="showPassword" class="fa-solid fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Password Requirements Card -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-3 border border-blue-100 dark:border-blue-800/50">
                    <h4 class="text-blue-800 dark:text-blue-300 font-medium mb-2 flex items-center text-xs">
                        <i class="fa-solid fa-shield text-blue-600 dark:text-blue-400 text-xs mr-1"></i>
                        Password Requirements
                    </h4>
                    <p class="text-xs text-blue-600 dark:text-blue-400 mb-2">Ensure that these requirements are met:</p>
                    <ul class="space-y-1">
                        <li class="flex items-center text-xs text-blue-700 dark:text-blue-300">
                            <div class="h-4 w-4 mr-2 flex items-center justify-center">
                                <div class="h-1.5 w-1.5 bg-blue-500 rounded-full"></div>
                            </div>
                            Minimum 8 characters long - the more, the better
                        </li>
                        <li class="flex items-center text-xs text-blue-700 dark:text-blue-300">
                            <div class="h-4 w-4 mr-2 flex items-center justify-center">
                                <div class="h-1.5 w-1.5 bg-blue-500 rounded-full"></div>
                            </div>
                            At least one lowercase character
                        </li>
                        <li class="flex items-center text-xs text-blue-700 dark:text-blue-300">
                            <div class="h-4 w-4 mr-2 flex items-center justify-center">
                                <div class="h-1.5 w-1.5 bg-blue-500 rounded-full"></div>
                            </div>
                            At least one uppercase character
                        </li>
                        <li class="flex items-center text-xs text-blue-700 dark:text-blue-300">
                            <div class="h-4 w-4 mr-2 flex items-center justify-center">
                                <div class="h-1.5 w-1.5 bg-blue-500 rounded-full"></div>
                            </div>
                            At least one number
                        </li>
                    </ul>
                </div>
                
                <!-- Security Notice -->
                <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-xl p-3 border border-yellow-100 dark:border-yellow-800/50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-exclamation-triangle text-yellow-500 text-sm"></i>
                        </div>
                        <div class="ml-2">
                            <h3 class="text-xs font-medium text-yellow-800 dark:text-yellow-300">Security Reminder</h3>
                            <p class="mt-1 text-xs text-yellow-700 dark:text-yellow-400">
                                After changing your password, you'll be required to log in again with your new credentials.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="pt-2">
                    <button 
                        type="submit"
                        class="w-full px-4 py-2 border border-transparent rounded-xl text-xs font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors flex items-center justify-center"
                    >
                        <i class="fa-solid fa-save text-xs mr-1"></i>
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

@endsection