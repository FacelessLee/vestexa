@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Frequently Asked Questions')

@section('content')
<!-- Hero Section with Breadcrumbs -->
<section class="relative py-24 lg:py-32 bg-gradient-to-br from-primary-600 to-primary-700 dark:from-primary-900 dark:to-primary-950 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -right-20 top-20 w-64 h-64 bg-primary-500 rounded-full opacity-20 blur-3xl animate-float"></div>
        <div class="absolute left-1/4 top-1/3 w-80 h-80 bg-primary-400 rounded-full opacity-10 blur-3xl animate-float-slow"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Frequently Asked Questions</h1>
            <nav class="flex justify-center" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-primary-100 dark:text-primary-200">
                    <li>
                        <a href="/" class="hover:text-white transition-colors">Home</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-chevron-right h-4 w-4 mx-1"></i>
                    </li>
                    <li class="text-white font-medium">FAQ</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 md:py-20 bg-background dark:bg-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center mb-12">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-semibold mb-4">
                HELP CENTER
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-foreground dark:text-white mb-6">
                Find Answers to Your Questions
            </h2>
            <p class="text-lg text-muted-foreground dark:text-gray-300">
                Browse through our comprehensive FAQ to find answers to the most common questions about our banking services.
            </p>
        </div>

        <!-- FAQ Categories -->
        <div class="space-y-8" x-data="{ activeCategory: 'about' }">
            <!-- Category Navigation -->
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <button 
                    @click="activeCategory = 'about'" 
                    :class="activeCategory === 'about' ? 'bg-primary-600 text-white dark:bg-primary-700 dark:text-white' : 'bg-muted dark:bg-gray-700 text-muted-foreground dark:text-gray-300 hover:bg-muted/70 dark:hover:bg-gray-600'"
                    class="px-4 py-2 rounded-full font-medium transition-colors"
                >
                    About Us
                </button>
                <button 
                    @click="activeCategory = 'account'" 
                    :class="activeCategory === 'account' ? 'bg-primary-600 text-white dark:bg-primary-700 dark:text-white' : 'bg-muted dark:bg-gray-700 text-muted-foreground dark:text-gray-300 hover:bg-muted/70 dark:hover:bg-gray-600'"
                    class="px-4 py-2 rounded-full font-medium transition-colors"
                >
                    My Account
                </button>
                <button 
                    @click="activeCategory = 'deposit'" 
                    :class="activeCategory === 'deposit' ? 'bg-primary-600 text-white dark:bg-primary-700 dark:text-white' : 'bg-muted dark:bg-gray-700 text-muted-foreground dark:text-gray-300 hover:bg-muted/70 dark:hover:bg-gray-600'"
                    class="px-4 py-2 rounded-full font-medium transition-colors"
                >
                    Deposit
                </button>
                <button 
                    @click="activeCategory = 'withdrawal'" 
                    :class="activeCategory === 'withdrawal' ? 'bg-primary-600 text-white dark:bg-primary-700 dark:text-white' : 'bg-muted dark:bg-gray-700 text-muted-foreground dark:text-gray-300 hover:bg-muted/70 dark:hover:bg-gray-600'"
                    class="px-4 py-2 rounded-full font-medium transition-colors"
                >
                    Withdrawal of Funds
                </button>
                <button 
                    @click="activeCategory = 'referral'" 
                    :class="activeCategory === 'referral' ? 'bg-primary-600 text-white dark:bg-primary-700 dark:text-white' : 'bg-muted dark:bg-gray-700 text-muted-foreground dark:text-gray-300 hover:bg-muted/70 dark:hover:bg-gray-600'"
                    class="px-4 py-2 rounded-full font-medium transition-colors"
                >
                    Referral Program
                </button>
                <button 
                    @click="activeCategory = 'additional'" 
                    :class="activeCategory === 'additional' ? 'bg-primary-600 text-white dark:bg-primary-700 dark:text-white' : 'bg-muted dark:bg-gray-700 text-muted-foreground dark:text-gray-300 hover:bg-muted/70 dark:hover:bg-gray-600'"
                    class="px-4 py-2 rounded-full font-medium transition-colors"
                >
                    Additional Questions
                </button>
            </div>

            <!-- About Us Category -->
            <div x-show="activeCategory === 'about'" x-transition>
                <div class="bg-card dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mb-8 border border-border dark:border-gray-700">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 mr-4">
                                <i class="fa-solid fa-building text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-foreground dark:text-white">About Us</h3>
                        </div>
                        
                        <div class="space-y-6" x-data="{ openQuestion: null }">
                            <!-- Question 1 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 1 ? openQuestion = null : openQuestion = 1" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">WHAT IS {{ $settings->site_name }}?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 1}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 1" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>{{ $settings->site_name }} - Professional team of cryptocurrency industry developers. The main advantage of the company is a unique trading bot that makes a profit at the stage of growth and market decline.</p>
                                </div>
                            </div>
                            
                            <!-- Question 2 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 2 ? openQuestion = null : openQuestion = 2" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">IS {{ $settings->site_name }} the OFFICIALLY REGISTERED COMPANY?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 2}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 2" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>Yes, we are legally binding and officially registered in the UK under the company registration number #08683932</p>
                                </div>
                            </div>
                            
                            <!-- Question 3 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 3 ? openQuestion = null : openQuestion = 3" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">DO YOU HAVE ANY COUNTRY RESTRICTIONS?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 3}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 3" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>Our company doesn't work and doesn't accept deposits from US residents. During the registration process you need to check the box that you are not a US citizen.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Account Category -->
            <div x-show="activeCategory === 'account'" x-transition>
                <div class="bg-card dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mb-8 border border-border dark:border-gray-700">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-secondary-100 dark:bg-secondary-900/30 flex items-center justify-center text-secondary-600 dark:text-secondary-400 mr-4">
                                <i class="fa-solid fa-user text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-foreground dark:text-white">My Account</h3>
                        </div>
                        
                        <div class="space-y-6" x-data="{ openQuestion: null }">
                            <!-- Question 1 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 1 ? openQuestion = null : openQuestion = 1" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">HOW MANY ACCOUNTS CAN I OPEN?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 1}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 1" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>Each user can only open and manage one account. Please follow this rule. In case of violation the company has the right to block all your accounts without a refund.</p>
                                </div>
                            </div>
                            
                            <!-- Question 2 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 2 ? openQuestion = null : openQuestion = 2" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">HOW TO UPLOAD PERSONAL DATA?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 2}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 2" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>Please note that we do not require your personal information. To work with our platform, you need to specify your login, your email, come up with a password, and also specify the wallet number to which funds will be withdrawn from the platform.</p>
                                </div>
                            </div>
                            
                            <!-- Question 3 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 3 ? openQuestion = null : openQuestion = 3" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">HOW MUCH DOES IT COST TO OPEN AN ACCOUNT?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 3}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 3" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>Opening an account is absolutely free. We do not charge you any hidden fees or service charges. The commission on operations and additional costs is included in the company's profits from the profits from the development of cryptocurrency robots.</p>
                                </div>
                            </div>
                            
                            <!-- More questions can be added here following the same pattern -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deposit Category -->
            <div x-show="activeCategory === 'deposit'" x-transition>
                <div class="bg-card dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mb-8 border border-border dark:border-gray-700">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-accent-100 dark:bg-accent-900/30 flex items-center justify-center text-accent-600 dark:text-accent-400 mr-4">
                                <i class="fa-solid fa-wallet text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-foreground dark:text-white">Deposit</h3>
                        </div>
                        
                        <div class="space-y-6" x-data="{ openQuestion: null }">
                            <!-- Question 1 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 1 ? openQuestion = null : openQuestion = 1" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">WHAT WAYS TO OBTAIN INCOME IN {{ $settings->site_name }} ARE?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 1}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 1" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>Users have the opportunity to earn in two ways: by opening a deposit for the chosen investment plan, as well as by receiving partner rewards for attracting new members.</p>
                                </div>
                            </div>
                            
                            <!-- More questions can be added here following the same pattern -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Withdrawal Category -->
            <div x-show="activeCategory === 'withdrawal'" x-transition>
                <div class="bg-card dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mb-8 border border-border dark:border-gray-700">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400 mr-4">
                                <i class="fa-solid fa-credit-card text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-foreground dark:text-white">Withdrawal of Funds</h3>
                        </div>
                        
                        <div class="space-y-6" x-data="{ openQuestion: null }">
                            <!-- Question 1 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 1 ? openQuestion = null : openQuestion = 1" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">HOW OFTEN WILL I RECEIVE ACCRUALS ON MY DEPOSITS?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 1}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 1" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>Interest on deposits is accrued in accordance with the terms of the investment plan. The countdown starts from the moment you open a deposit in the system.</p>
                                </div>
                            </div>
                            
                            <!-- More questions can be added here following the same pattern -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Referral Program Category -->
            <div x-show="activeCategory === 'referral'" x-transition>
                <div class="bg-card dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mb-8 border border-border dark:border-gray-700">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400 mr-4">
                                <i class="fa-solid fa-users text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-foreground dark:text-white">Referral Program</h3>
                        </div>
                        
                        <div class="space-y-6" x-data="{ openQuestion: null }">
                            <!-- Question 1 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 1 ? openQuestion = null : openQuestion = 1" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">DO YOU OFFER A REFERRAL PROGRAM?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 1}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 1" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>We offer an affiliate program for additional income for our investors. Anyone can take part in the development of the company by inviting new members and receiving a generous reward for this.</p>
                                </div>
                            </div>
                            
                            <!-- More questions can be added here following the same pattern -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Questions Category -->
            <div x-show="activeCategory === 'additional'" x-transition>
                <div class="bg-card dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mb-8 border border-border dark:border-gray-700">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 mr-4">
                                <i class="fa-solid fa-circle-question text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-foreground dark:text-white">Additional Questions</h3>
                        </div>
                        
                        <div class="space-y-6" x-data="{ openQuestion: null }">
                            <!-- Question 1 -->
                            <div class="border border-border dark:border-gray-700 rounded-lg overflow-hidden">
                                <button 
                                    @click="openQuestion === 1 ? openQuestion = null : openQuestion = 1" 
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-card dark:bg-gray-800 hover:bg-muted/30 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800"
                                >
                                    <span class="font-medium text-foreground dark:text-white">WHERE CAN I EXCHANGE ONE CURRENCY FOR ANOTHER?</span>
                                    <i 
                                        class="fa-solid fa-chevron-down h-5 w-5 text-muted-foreground dark:text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': openQuestion === 1}"
                                    ></i>
                                </button>
                                <div 
                                    x-show="openQuestion === 1" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform -translate-y-2" 
                                    x-transition:enter-end="opacity-100 transform translate-y-0" 
                                    x-transition:leave="transition ease-in duration-200" 
                                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 pb-4 text-muted-foreground dark:text-gray-300"
                                >
                                    <p>You can use monitoring with trusted exchange offices - bestchange. Choose the exchanger with the best rate and follow the instructions.</p>
                                </div>
                            </div>
                            
                            <!-- More questions can be added here following the same pattern -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Support Section -->
<section class="py-16 bg-muted/30 dark:bg-gray-800/30">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center mb-12">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-semibold mb-4">
                NEED MORE HELP?
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-foreground dark:text-white mb-6">
                Can't Find What You're Looking For?
            </h2>
            <p class="text-lg text-muted-foreground dark:text-gray-300 mb-8">
                If you couldn't find the answer to your question in our FAQ, please don't hesitate to contact our support team.
            </p>
            <a href="contact" class="inline-flex items-center px-6 py-3 rounded-2xl bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-200">
                Contact Support
                <i class="fa-solid fa-arrow-right-long ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Back to Top Button -->
<button 
    id="back-to-top" 
    class="fixed right-6 bottom-6 p-3 rounded-full bg-primary-600 text-white shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-900"
    x-data="{ show: false }"
    @scroll.window="show = window.pageYOffset > 300"
    :class="{ 'opacity-100 visible': show, 'opacity-0 invisible': !show }"
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
>
    <i class="fa-solid fa-chevron-up h-6 w-6"></i>
</button>

@endsection
