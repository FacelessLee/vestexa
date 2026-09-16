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
            'title' => 'Support Center',
            'showBackButton' => true,
            'backUrl' => route('dashboard'),
            'showNotifications' => true,
            'showDarkMode' => true,
            'financeUser' => Auth::user()
        ])
    </div>

    <!-- Desktop Header -->
    <div class="hidden lg:block">
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center">
                        <i class="fa-solid fa-life-ring text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">Support Center</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Get help with your account and services</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
        <!-- Content Header -->
        <div class="border-b border-gray-200 dark:border-gray-700 p-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                <i class="fa-solid fa-ticket text-primary-600 dark:text-primary-400 text-sm mr-2"></i>
                Submit a Support Ticket
            </h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                We're here to help. Tell us about your issue and we'll find a solution.
            </p>
        </div>
        
        <!-- Support Icon -->
        <div class="flex justify-center py-6">
            <div class="h-16 w-16 rounded-full bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center">
                <i class="fa-solid fa-circle-question text-2xl text-primary-600 dark:text-primary-400"></i>
            </div>
        </div>
        
        <!-- Form Content -->
        <div class="p-4">
            <form action="{{ route('enquiry') }}" method="post" class="space-y-4">
                @csrf
                
                <!-- Hidden Fields -->
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                <input type="hidden" name="name" value="{{ Auth::user()->name }}" />
                
                <!-- Ticket Title -->
                <div>
                    <label for="subject" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Ticket Title
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-bookmark text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            id="subject" 
                            name="subject"
                            class="block w-full pl-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Briefly describe your issue"
                            required
                        />
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Be specific to help us understand your issue</p>
                </div>
                
                <!-- Priority Selection -->
                <div>
                    <label for="selectPriority" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Priority Level
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-flag text-gray-400 text-sm"></i>
                        </div>
                        <select 
                            id="selectPriority" 
                            name="selectPriority"
                            class="block w-full pl-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none text-sm"
                            required
                        >
                            <option value="low">Low Priority</option>
                            <option value="medium">Medium Priority</option>
                            <option value="high">High Priority</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-gray-400 text-sm"></i>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Select based on urgency of your request</p>
                </div>
                
                <!-- Message Content -->
                <div>
                    <label for="message" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Describe Your Issue
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                            <i class="fa-solid fa-message text-gray-400 text-sm"></i>
                        </div>
                        <textarea 
                            id="message" 
                            name="message"
                            rows="5"
                            class="block w-full pl-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all preserveLines text-sm"
                            placeholder="Please provide all relevant details about your issue so we can help you better"
                            required
                        ></textarea>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Include any relevant details that might help us resolve your issue</p>
                </div>
                
                <!-- Support Info Card -->
                <div class="bg-blue-50 dark:bg-blue-900/30 rounded-lg p-3 border border-blue-100 dark:border-blue-800">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-info-circle text-blue-500 dark:text-blue-400 text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-xs font-medium text-blue-800 dark:text-blue-300">Support Information</h3>
                            <div class="mt-1 text-xs text-blue-700 dark:text-blue-400">
                                <p>
                                    Our support team typically responds within 24 hours. For urgent matters, 
                                    please select "High Priority" and we'll do our best to assist you sooner.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="pt-2">
                    <button 
                        type="submit"
                        class="w-full bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 text-white font-medium py-2.5 px-4 rounded-lg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 flex items-center justify-center text-sm"
                    >
                        <i class="fa-solid fa-paper-plane text-xs mr-2"></i>
                        Submit Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Quick Help Section -->
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
        <!-- Header -->
        <div class="px-4 py-3 bg-gradient-to-r from-primary-50/80 to-blue-50/50 dark:from-gray-900/80 dark:to-gray-800/50 border-b border-primary-100/50 dark:border-gray-700/50">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-primary-500 rounded-xl flex items-center justify-center mr-3">
                    <i class="fa-solid fa-question text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-primary-900 dark:text-primary-100">Quick Help</h3>
                    <p class="text-xs text-primary-700 dark:text-primary-300">Find answers to common questions</p>
                </div>
            </div>
        </div>
        
        <!-- FAQ Items -->
        <div class="divide-y divide-gray-100 dark:divide-gray-700" x-data="{ expandedItem: null }">
            @php
                $quickHelp = [
                    [
                        'question' => 'How to make a transfer?',
                        'answer' => 'Go to Transfer section and select Local or International transfer. Enter recipient details, amount, and confirm with your PIN.',
                        'icon' => 'fa-solid fa-paper-plane'
                    ],
                    [
                        'question' => 'How to apply for a card?',
                        'answer' => 'Visit Cards section and click Apply for Virtual Card. Fill out the application form and wait for approval.',
                        'icon' => 'fa-solid fa-credit-card'
                    ],
                    [
                        'question' => 'How to check my balance?',
                        'answer' => 'Your balance is displayed on the main dashboard. You can toggle visibility using the eye icon.',
                        'icon' => 'fa-solid fa-wallet'
                    ],
                    [
                        'question' => 'How to enable 2FA?',
                        'answer' => 'Go to Settings > Security > Two-Factor Authentication and follow the setup instructions.',
                        'icon' => 'fa-solid fa-shield'
                    ],
                    [
                        'question' => 'How to deposit funds?',
                        'answer' => 'Click on Deposit from the dashboard, select your preferred payment method, and follow the instructions.',
                        'icon' => 'fa-solid fa-plus'
                    ],
                    [
                        'question' => 'How to track transactions?',
                        'answer' => 'Visit the Transactions page to view your complete transaction history with filters and search options.',
                        'icon' => 'fa-solid fa-chart-line'
                    ]
                ];
            @endphp
            
            @foreach($quickHelp as $index => $help)
            <div class="p-4">
                <button @click="expandedItem = expandedItem === {{ $index }} ? null : {{ $index }}" class="w-full flex items-start justify-between text-left">
                    <div class="flex items-start space-x-3 flex-1">
                        <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="{{ $help['icon'] }} text-gray-600 dark:text-gray-400 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $help['question'] }}</p>
                            <div x-show="expandedItem === {{ $index }}" 
                                 x-transition:enter="transition ease-out duration-200" 
                                 x-transition:enter-start="opacity-0 -translate-y-1" 
                                 x-transition:enter-end="opacity-100 translate-y-0" 
                                 class="mt-2">
                                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">{{ $help['answer'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="ml-2 flex-shrink-0">
                        <i x-show="expandedItem !== {{ $index }}" class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                        <i x-show="expandedItem === {{ $index }}" class="fa-solid fa-chevron-up text-gray-400 text-xs"></i>
                    </div>
                </button>
            </div>
            @endforeach
        </div>
        
        <!-- Contact Footer -->
        <div class="px-4 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Still need help?</p>
                <div class="flex items-center justify-center space-x-6">
                    <div class="text-center">
                        <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fa-solid fa-clock text-primary-600 dark:text-primary-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300 font-medium">24/7 Support</p>
                    </div>
                    <div class="text-center">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fa-solid fa-headset text-green-600 dark:text-green-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300 font-medium">Live Chat</p>
                    </div>
                    <div class="text-center">
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fa-solid fa-bolt text-blue-600 dark:text-blue-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300 font-medium">Fast Response</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection