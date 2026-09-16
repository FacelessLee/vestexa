@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-8xl mx-auto">
        <div x-data="{ 
            showApplicationForm: false,
            amount: '',
            facility: '', 
            duration: '12',
            purpose: '',
            income: '',
            isSubmitting: false,
            hasActiveLoan: {{ \App\Models\User_plans::where('user', Auth::user()->id)->whereIn('active', ['Active', 'Processed', 'Pending'])->count() > 0 ? 'true' : 'false' }}
        }">
            <!-- Alerts -->
            <x-danger-alert />
            <x-success-alert />
            <x-error-alert />

            <!-- Mobile Header -->
            <div class="lg:hidden mb-2">
                @include('partials._mobile_header', [
                    'title' => 'Loan Services',
                    'showBackButton' => true,
                    'backUrl' => route('dashboard'),
                    'showNotifications' => true,
                    'showDarkMode' => true,
                    'financeUser' => Auth::user()
                ])
            </div>

            <!-- Desktop Header -->
            <div class="hidden lg:flex items-center justify-between mb-4">
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Loan Services</h1>
                <div x-show="!showApplicationForm">
                    <button 
                        @click="showApplicationForm = true"
                        x-bind:disabled="hasActiveLoan"
                        x-bind:class="{ 'opacity-50 cursor-not-allowed': hasActiveLoan }"
                        class="inline-flex items-center px-3 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors text-sm"
                    >
                        <i class="fas fa-plus mr-2 text-xs"></i>
                        <span>Apply for Loan</span>
                    </button>
                </div>
            </div>

            <!-- Active Loan Alert -->
            <div x-show="hasActiveLoan" class="mb-3">
                <div class="bg-yellow-50/90 dark:bg-yellow-900/50 backdrop-blur-sm border-l-4 border-yellow-400 p-3 rounded-lg shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">Loan Application Restricted</h3>
                            <div class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                                <p>You currently have an active or pending loan application. You cannot apply for a new loan until your current loan is completed or your application is processed.</p>
                                <p class="mt-1">Please check your <a href="{{ route('veiwloan') }}" class="font-medium underline text-yellow-800 dark:text-yellow-300 hover:text-yellow-900 dark:hover:text-yellow-200">existing loans</a> for more information.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Section (Displayed Initially) -->
            <div x-show="!showApplicationForm">
                <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
                    <!-- Loan Information Content -->
                    <div class="p-4 lg:p-5">
                        <!-- Loan Benefits -->
                        <div class="mb-5">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                                <div class="h-7 w-7 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mr-3">
                                    <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 text-sm"></i>
                                </div>
                                Why Choose Our Loan Services
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3 flex items-start">
                                    <div class="mr-3 mt-1">
                                        <i class="fas fa-clock text-primary-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white mb-1 text-sm">Quick Approval</h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Get a decision within hours and funds within days</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3 flex items-start">
                                    <div class="mr-3 mt-1">
                                        <i class="fas fa-percentage text-primary-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white mb-1 text-sm">Competitive Rates</h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Low interest rates tailored to your credit profile</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3 flex items-start">
                                    <div class="mr-3 mt-1">
                                        <i class="fas fa-file-alt text-primary-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white mb-1 text-sm">Simple Process</h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Straightforward application with minimal paperwork</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3 flex items-start">
                                    <div class="mr-3 mt-1">
                                        <i class="fas fa-shield-alt text-primary-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white mb-1 text-sm">Secure & Confidential</h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Your information is protected with bank-level security</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Loan Types -->
                        <div class="mb-5">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                                <div class="h-7 w-7 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mr-3">
                                    <i class="fas fa-layer-group text-primary-600 dark:text-primary-400 text-sm"></i>
                                </div>
                                Available Loan Types
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <!-- First row of loan types -->
                                <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-home text-primary-500 mr-2 text-sm"></i>
                                        <h4 class="font-medium text-gray-900 dark:text-white text-sm">Personal Home Loans</h4>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Finance your dream home with competitive rates</p>
                                </div>
                                
                                <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-car text-primary-500 mr-2 text-sm"></i>
                                        <h4 class="font-medium text-gray-900 dark:text-white text-sm">Automobile Loans</h4>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Get on the road with flexible auto financing</p>
                                </div>
                                
                                <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-briefcase text-primary-500 mr-2 text-sm"></i>
                                        <h4 class="font-medium text-gray-900 dark:text-white text-sm">Business Loans</h4>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Grow your business with tailored financing solutions</p>
                                </div>
                                
                                <!-- Second row of loan types -->
                                <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-users text-primary-500 mr-2 text-sm"></i>
                                        <h4 class="font-medium text-gray-900 dark:text-white text-sm">Joint Mortgage</h4>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Share responsibility with a co-borrower</p>
                                </div>
                                
                                <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-credit-card text-primary-500 mr-2 text-sm"></i>
                                        <h4 class="font-medium text-gray-900 dark:text-white text-sm">Secured Overdraft</h4>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Access funds when needed with asset backing</p>
                                </div>
                                
                                <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-heartbeat text-primary-500 mr-2 text-sm"></i>
                                        <h4 class="font-medium text-gray-900 dark:text-white text-sm">Health Finance</h4>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Cover medical expenses with flexible payment options</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- How It Works -->
                        <div class="mb-5">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                                <div class="h-7 w-7 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle text-primary-600 dark:text-primary-400 text-sm"></i>
                                </div>
                                How It Works
                            </h3>
                            
                            <div class="relative">
                                <!-- Line connector -->
                                <div class="absolute left-[0.9rem] top-8 bottom-8 w-0.5 bg-gray-200 dark:bg-gray-600 z-0"></div>
                                
                                <div class="space-y-4 relative z-10">
                                    <!-- Step 1 -->
                                    <div class="flex">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mr-3 z-10">
                                            <span class="text-primary-600 dark:text-primary-400 font-bold text-sm">1</span>
                                        </div>
                                        <div class="pt-1">
                                            <h4 class="font-medium text-gray-900 dark:text-white mb-1 text-sm">Apply Online</h4>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">Complete our simple online application form with your details and loan requirements</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 2 -->
                                    <div class="flex">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mr-3 z-10">
                                            <span class="text-primary-600 dark:text-primary-400 font-bold text-sm">2</span>
                                        </div>
                                        <div class="pt-1">
                                            <h4 class="font-medium text-gray-900 dark:text-white mb-1 text-sm">Quick Review</h4>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">Our team reviews your application and may contact you for additional information</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 3 -->
                                    <div class="flex">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mr-3 z-10">
                                            <span class="text-primary-600 dark:text-primary-400 font-bold text-sm">3</span>
                                        </div>
                                        <div class="pt-1">
                                            <h4 class="font-medium text-gray-900 dark:text-white mb-1 text-sm">Approval & Disbursement</h4>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">Once approved, the loan amount will be transferred to your account</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Apply Now CTA -->
                        <div class="bg-gradient-to-r from-primary-50/80 to-blue-50/80 dark:from-gray-800/90 dark:to-gray-700/90 backdrop-blur-sm rounded-xl p-4 text-center border border-primary-100/50 dark:border-gray-600/50">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Ready to get started?</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">Apply now and get a decision on your loan application quickly</p>
                            <button 
                                @click="showApplicationForm = true"
                                x-bind:disabled="hasActiveLoan"
                                x-bind:class="{ 'opacity-50 cursor-not-allowed': hasActiveLoan, 'hover:bg-primary-700': !hasActiveLoan }"
                                class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors"
                            >
                                <template x-if="!hasActiveLoan">
                                    <div class="flex items-center">
                                        <i class="fas fa-edit mr-2 text-xs"></i>
                                        Apply for a Loan
                                    </div>
                                </template>
                                <template x-if="hasActiveLoan">
                                    <div class="flex items-center">
                                        <i class="fas fa-lock mr-2 text-xs"></i>
                                        Application Restricted
                                    </div>
                                </template>
                            </button>
                            <p x-show="hasActiveLoan" class="mt-2 text-xs text-gray-500 dark:text-gray-400">You already have an active or pending loan application</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Form -->
            <div x-show="showApplicationForm && !hasActiveLoan">
                <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
                    <!-- Form Content -->
                    <div class="p-4 lg:p-5">
                        <div class="flex justify-between items-center mb-4">
                            <button 
                                @click="showApplicationForm = false" 
                                class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors text-sm"
                            >
                                <i class="fas fa-arrow-left mr-2 text-xs"></i>
                                Back to Information
                            </button>
                            
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <span class="text-red-500">*</span> Required fields
                            </div>
                        </div>
                        
                        <form action="{{ route('loan') }}" method="post" x-ref="loanForm" @submit="isSubmitting = true">
                            @csrf
                            
                            <!-- Loan Details Section -->
                            <div class="mb-5">
                                <div class="flex items-center mb-3">
                                    <div class="h-7 w-7 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mr-3">
                                        <i class="fas fa-money-bill-wave text-primary-600 dark:text-primary-400 text-sm"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Loan Details</h3>
                                </div>
                            
                                <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-600/50 p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Loan Amount -->
                                        <div>
                                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Loan Amount ({{ Auth::user()->curr }}) <span class="text-red-500">*</span>
                                            </label>
                                                                                    <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                                <span class="text-gray-500 dark:text-gray-400 text-sm">{{ Auth::user()->s_curr }}</span>
                                            </div>
                                            <input 
                                                type="text" 
                                                name="amount" 
                                                id="amount" 
                                                x-model="amount"
                                                class="block w-full pl-12 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-600/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm relative z-0"
                                                placeholder="Enter loan amount"
                                                required
                                            />
                                        </div>
                                        </div>
                                        
                                        <!-- Loan Duration -->
                                        <div>
                                            <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Duration (Months) <span class="text-red-500">*</span>
                                            </label>
                                                                                    <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                                <i class="fas fa-calendar text-gray-400 text-sm"></i>
                                            </div>
                                            <select 
                                                name="duration" 
                                                id="duration" 
                                                x-model="duration"
                                                class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-600/90 backdrop-blur-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none text-sm relative z-0"
                                                required
                                            >
                                                <option value="6">6 Months</option>
                                                <option value="12">12 Months</option>
                                                <option value="24">2 Years</option>
                                                <option value="36">3 Years</option>
                                                <option value="48">4 Years</option>
                                                <option value="60">5 Years</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none z-10">
                                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Credit Facility -->
                                    <div class="mt-4">
                                        <label for="facility" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Credit Facility <span class="text-red-500">*</span>
                                        </label>
                                                                            <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-building text-gray-400 text-sm"></i>
                                        </div>
                                        <select 
                                            name="facility" 
                                            id="facility" 
                                            x-model="facility"
                                            class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-600/90 backdrop-blur-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none text-sm relative z-0"
                                            required
                                        >
                                            <option selected value="">Select Loan/Credit Facility</option>
                                            <option value="Personal Home Loans">Personal Home Loans</option>
                                            <option value="Joint Mortgage">Joint Mortgage</option>
                                            <option value="Automobile Loans">Automobile Loans</option>
                                            <option value="Salary loans">Salary loans</option>
                                            <option value="Secured Overdraft">Secured Overdraft</option>
                                            <option value="Contract Finance">Contract Finance</option>
                                            <option value="Secured Term Loans">Secured Term Loans</option>
                                            <option value="StartUp/Products Financing">StartUp/Products Financing</option>
                                            <option value="Local Purchase Orders Finance">Local Purchase Orders Finance</option>
                                            <option value="Operational Vehicles">Operational Vehicles</option>
                                            <option value="Revenue Loans and Overdraft">Revenue Loans and Overdraft</option>
                                            <option value="Retail TOD">Retail TOD</option>
                                            <option value="Commercial Mortgage">Commercial Mortgage</option>
                                            <option value="Office Equipment">Office Equipment</option>
                                            <option value="Health Finance Product Guideline">Health Finance Product Guideline</option>
                                            <option value="Health Finance">Health Finance</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                        </div>
                                    </div>
                                    </div>

                                    <!-- Purpose of Loan -->
                                    <div class="mt-4">
                                        <label for="purpose" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Purpose of Loan <span class="text-red-500">*</span>
                                        </label>
                                                                            <div class="relative">
                                        <div class="absolute top-3 left-3 flex items-start pointer-events-none z-10">
                                            <i class="fas fa-comment text-gray-400 text-sm"></i>
                                        </div>
                                        <textarea 
                                            name="purpose" 
                                            id="purpose" 
                                            x-model="purpose"
                                            class="block w-full pl-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-600/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all preserveLines text-sm relative z-0"
                                            placeholder="Please describe the purpose of this loan..."
                                            rows="3"
                                            required
                                        ></textarea>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Financial Information Section -->
                            <div class="mb-5">
                                <div class="flex items-center mb-3">
                                    <div class="h-7 w-7 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mr-3">
                                        <i class="fas fa-wallet text-primary-600 dark:text-primary-400 text-sm"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Financial Information</h3>
                                </div>

                                <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-600/50 p-4">
                                    <!-- Monthly Net Income -->
                                    <div>
                                        <label for="income" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Monthly Net Income <span class="text-red-500">*</span>
                                        </label>
                                                                            <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-dollar-sign text-gray-400 text-sm"></i>
                                        </div>
                                        <select 
                                            name="income" 
                                            id="income" 
                                            x-model="income"
                                            class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-600/90 backdrop-blur-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none text-sm relative z-0"
                                            required
                                        >
                                            <option value="2,000-5,000">{{ Auth::user()->s_curr }}2,000 - {{ Auth::user()->s_curr }}5,000</option>
                                            <option value="6,000-10,000">{{ Auth::user()->s_curr }}6,000 - {{ Auth::user()->s_curr }}10,000</option>
                                            <option value="11,000-20,000">{{ Auth::user()->s_curr }}11,000 - {{ Auth::user()->s_curr }}20,000</option>
                                            <option value="21,000-50,000">{{ Auth::user()->s_curr }}21,000 - {{ Auth::user()->s_curr }}50,000</option>
                                            <option value="100,000 and above">{{ Auth::user()->s_curr }}100,000 and above</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Terms & Submit -->
                            <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 dark:border-gray-600/50 mb-5">
                                <div class="flex items-start mb-3">
                                    <div class="flex items-center h-5 pt-1">
                                        <input 
                                            id="terms" 
                                            name="terms" 
                                            type="checkbox" 
                                            required
                                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 dark:border-gray-600 dark:bg-gray-600 rounded"
                                        />
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="terms" class="font-medium text-gray-700 dark:text-gray-300">I agree to the terms and conditions</label>
                                        <p class="text-gray-500 dark:text-gray-400 mt-1 text-xs">
                                            By submitting this application, I confirm that all information provided is accurate and complete. I authorize {{ $settings->site_name }} to verify my information and credit history.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-2 sm:space-y-0">
                                <button 
                                    type="submit" 
                                    class="w-full mb-2 sm:mb-0 inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200"
                                    :disabled="isSubmitting"
                                    :class="{ 'opacity-60 cursor-not-allowed': isSubmitting }"
                                >
                                    <template x-if="!isSubmitting">
                                        <div class="flex items-center">
                                            <i class="fas fa-paper-plane mr-2 text-xs"></i>
                                            Submit Loan Application
                                        </div>
                                    </template>
                                    <template x-if="isSubmitting">
                                        <div class="flex items-center">
                                            <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Processing...
                                        </div>
                                    </template>
                                </button>
                                <button 
                                    type="button" 
                                    @click="showApplicationForm = false"
                                    class="w-full inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors"
                                >
                                    <i class="fas fa-times mr-2 text-xs"></i>
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
  
@endsection