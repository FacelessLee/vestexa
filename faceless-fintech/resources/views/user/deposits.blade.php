@extends('layouts.dash2')
@section('title', $title)
@section('content')
    
<div x-data="{ 
    amount: '',
    paymentMethod: '',
    isSubmitting: false,
    
    validateAmount() {
        if (this.amount < 0) {
            this.amount = 0;
        }
    },
    
    submitForm() {
        this.isSubmitting = true;
        document.getElementById('depositForm').submit();
    }
}" class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 lg:p-6">
    <div class="max-w-8xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Deposit Funds',
                'showBackButton' => true,
                'backUrl' => route('dashboard'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:block mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                        <i class="fas fa-piggy-bank text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Deposit Funds</h1>
                        <p class="text-gray-600 dark:text-gray-400">Add money to your account securely</p>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Alerts -->
        <div class="mb-2">
            <x-danger-alert />
            <x-success-alert />
        </div>

        <!-- Interactive Card Container -->
        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 dark:from-primary-600 dark:via-primary-700 dark:to-primary-800 p-6 text-white">
                <div class="relative">
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mb-4">
                            <i class="fas fa-piggy-bank text-3xl text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Fund Your Account</h2>
                        <p class="text-white/90 text-sm">Choose your preferred deposit method and amount</p>
                    </div>
                    
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 right-0 w-32 h-32 rounded-full bg-white transform translate-x-16 -translate-y-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 rounded-full bg-white transform -translate-x-12 translate-y-12"></div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <form action="{{ route('newdeposit') }}" method="post" id="depositForm" @submit.prevent="submitForm()">
                    @csrf

                    <!-- Payment Method Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Select Deposit Method</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @forelse ($dmethods as $method)
                                <div 
                                    @click="paymentMethod = '{{ $method->name }}'"
                                    class="cursor-pointer border rounded-xl p-4 transition-all duration-200 hover:shadow-md"
                                    :class="paymentMethod === '{{ $method->name }}' ? 'bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900/30 dark:to-blue-900/30 border-primary-500 dark:border-primary-400 ring-2 ring-primary-500/50 dark:ring-primary-400/50' : 'bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-600'"
                                >
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            @if(Str::contains(strtolower($method->name), 'bank'))
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                                    <i class="fas fa-university text-white text-sm"></i>
                                                </div>
                                            @elseif(Str::contains(strtolower($method->name), 'crypto') || Str::contains(strtolower($method->name), 'bitcoin'))
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                                                    <i class="fab fa-bitcoin text-white text-sm"></i>
                                                </div>
                                            @elseif(Str::contains(strtolower($method->name), 'card') || Str::contains(strtolower($method->name), 'credit'))
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-400 to-purple-600 flex items-center justify-center">
                                                    <i class="fas fa-credit-card text-white text-sm"></i>
                                                </div>
                                            @elseif(Str::contains(strtolower($method->name), 'paypal'))
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                                    <i class="fab fa-paypal text-white text-sm"></i>
                                                </div>
                                            @else
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center">
                                                    <i class="fas fa-wallet text-white text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <h3 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $method->name }}</h3>
                                        </div>
                                        <div class="flex-shrink-0 ml-2">
                                            <div class="w-5 h-5 border-2 rounded-full flex items-center justify-center transition-all duration-200"
                                                 :class="paymentMethod === '{{ $method->name }}' ? 'bg-primary-500 border-primary-500 dark:bg-primary-400 dark:border-primary-400' : 'bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600'"
                                            >
                                                <i class="fas fa-check text-xs text-white" x-show="paymentMethod === '{{ $method->name }}'"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full bg-yellow-50/80 dark:bg-yellow-900/20 border-l-4 border-yellow-400 dark:border-yellow-500 p-4 rounded-xl backdrop-blur-sm">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-triangle text-yellow-400 dark:text-yellow-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                                No payment methods are enabled at the moment. Please check back later.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Hidden input to store the selected payment method -->
                        <input type="hidden" name="payment_method" :value="paymentMethod">
                    </div>

                    <!-- Amount Input with Currency -->
                    <div class="mb-6 bg-gradient-to-br from-gray-50/80 to-white/80 dark:from-gray-800/80 dark:to-gray-700/80 backdrop-blur-sm p-5 rounded-xl border border-gray-200/50 dark:border-gray-700/50 shadow-sm">
                        <label for="amount" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Deposit Amount</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                <span class="text-gray-500 dark:text-gray-400 text-lg font-bold">{{ Auth::user()->s_curr }}</span>
                            </div>
                            <input 
                                type="number" 
                                name="amount" 
                                id="amount" 
                                x-model="amount"
                                @input="validateAmount()"
                                min="1" 
                                step="any"
                                class="block w-full pl-12 pr-20 py-4 border-2 border-primary-200/50 dark:border-primary-700/50 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-2xl font-bold text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 relative z-0"
                                placeholder="0.00"
                                required
                            />
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-lg font-bold text-gray-400 dark:text-gray-500 pointer-events-none z-10">
                                .00
                            </div>
                        </div>
                        
                        <!-- Quick Amount Buttons -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            <button type="button" @click="amount = '100'" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">{{ Auth::user()->s_curr }}100</button>
                            <button type="button" @click="amount = '500'" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">{{ Auth::user()->s_curr }}500</button>
                            <button type="button" @click="amount = '1000'" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">{{ Auth::user()->s_curr }}1000</button>
                            <button type="button" @click="amount = '5000'" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">{{ Auth::user()->s_curr }}5000</button>
                            <button type="button" @click="amount = '10000'" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">{{ Auth::user()->s_curr }}10000</button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button 
                            type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] relative overflow-hidden disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none"
                            :disabled="isSubmitting || !paymentMethod || !amount"
                        >
                            <span class="relative z-10 flex items-center">
                                <i class="fas fa-credit-card mr-2" :class="{ 'animate-pulse': isSubmitting }"></i>
                                <span x-text="isSubmitting ? 'Processing...' : 'Continue to Deposit'"></span>
                            </span>
                        </button>
                        <a 
                            href="{{ route('dashboard') }}" 
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300"
                        >
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Security Notice -->
        <div class="mt-6 p-4 border border-gray-200/50 dark:border-gray-700/50 rounded-xl bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-sm">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 mt-0.5">
                    <i class="fas fa-shield-alt text-primary-500 dark:text-primary-400"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Secure Deposit</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">All deposits are processed through secure payment channels. Your financial information is never stored on our servers.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

@endsection