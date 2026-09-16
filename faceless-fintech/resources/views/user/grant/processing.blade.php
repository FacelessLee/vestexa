@extends('layouts.dash2')
@section('title', 'Processing Grant Application')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-8xl mx-auto">
        <!-- Alerts -->
        <x-danger-alert />
        <x-success-alert />
        <x-error-alert />

        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Processing',
                'showBackButton' => true,
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Processing Your Application</h1>
        </div>

        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="p-6 lg:p-8 text-center">
                <div class="max-w-3xl mx-auto">
                    <div class="mb-6">
                        <div class="h-12 w-12 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-calculator text-primary-500 dark:text-primary-400"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Application Processing</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            We're calculating your grant eligibility and pre-approved amount. 
                            Please wait while our system processes your information.
                        </p>
                    </div>
                    
                    <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-100/50 dark:border-gray-600/50 rounded-xl p-4 lg:p-5 shadow-sm max-w-xl mx-auto">
                        <!-- Progress Bar -->
                        <div class="h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full mb-6 overflow-hidden">
                            <div class="h-full bg-primary-500 dark:bg-primary-400 rounded-full w-0 transition-all duration-500" id="progressBar"></div>
                        </div>
                        
                        <!-- Processing Steps -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between items-center px-1 opacity-0 transform translate-y-4 transition-all duration-300" id="item1">
                                <div class="flex items-center">
                                    <i class="fas fa-user-check text-gray-500 dark:text-gray-400 mr-3 text-sm"></i>
                                    <span class="text-gray-700 dark:text-gray-300 text-sm">Verifying account information</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="h-5 w-5 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900/50">
                                        <i class="fas fa-check text-green-600 dark:text-green-400 text-xs"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center px-1 opacity-0 transform translate-y-4 transition-all duration-300" id="item2">
                                <div class="flex items-center">
                                    <i class="fas fa-clipboard-check text-gray-500 dark:text-gray-400 mr-3 text-sm"></i>
                                    <span class="text-gray-700 dark:text-gray-300 text-sm">Analyzing application details</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="h-5 w-5 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900/50">
                                        <i class="fas fa-check text-green-600 dark:text-green-400 text-xs"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center px-1 opacity-0 transform translate-y-4 transition-all duration-300" id="item3">
                                <div class="flex items-center">
                                    <i class="fas fa-check-square text-gray-500 dark:text-gray-400 mr-3 text-sm"></i>
                                    <span class="text-gray-700 dark:text-gray-300 text-sm">Reviewing eligibility criteria</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="h-5 w-5 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900/50">
                                        <i class="fas fa-check text-green-600 dark:text-green-400 text-xs"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center px-1 opacity-0 transform translate-y-4 transition-all duration-300" id="item4">
                                <div class="flex items-center">
                                    <i class="fas fa-calculator text-gray-500 dark:text-gray-400 mr-3 text-sm"></i>
                                    <span class="text-gray-700 dark:text-gray-300 text-sm">Calculating pre-approved amount</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="h-5 w-5 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900/50">
                                        <i class="fas fa-check text-green-600 dark:text-green-400 text-xs"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center px-1 opacity-0 transform translate-y-4 transition-all duration-300" id="item5">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-gray-500 dark:text-gray-400 mr-3 text-sm"></i>
                                    <span class="text-gray-700 dark:text-gray-300 text-sm">Finalizing results</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="h-5 w-5 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900/50">
                                        <i class="fas fa-check text-green-600 dark:text-green-400 text-xs"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Result Amount -->
                        <div class="opacity-0 transform scale-95 transition-all duration-500 mb-4" id="resultAmount">
                            <div class="text-center">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">You Requested</p>
                                <div class="text-base font-medium text-gray-600 dark:text-gray-400 mb-2">
                                    {{ Auth::user()->s_curr }}{{ number_format($latest_application->requested_amount, 2, '.', ',') }}
                                </div>
                                
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Pre-Approved Amount</p>
                                <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                                    {{ Auth::user()->s_curr }}{{ number_format($grant_limit, 2, '.', ',') }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Button -->
                        <div class="text-center opacity-0 transition-opacity duration-500" id="viewResultsBtn">
                            <a href="{{ route('grant.results') }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                                View Application Results
                                <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressBar = document.getElementById('progressBar');
        const resultAmount = document.getElementById('resultAmount');
        const viewResultsBtn = document.getElementById('viewResultsBtn');
        const items = [
            document.getElementById('item1'),
            document.getElementById('item2'),
            document.getElementById('item3'),
            document.getElementById('item4'),
            document.getElementById('item5')
        ];
        
        // Animation timeline
        setTimeout(() => {
            progressBar.style.width = '20%';
            items[0].classList.add('opacity-100');
            items[0].classList.remove('opacity-0', 'translate-y-4');
        }, 500);
        
        setTimeout(() => {
            progressBar.style.width = '40%';
            items[1].classList.add('opacity-100');
            items[1].classList.remove('opacity-0', 'translate-y-4');
        }, 2000);
        
        setTimeout(() => {
            progressBar.style.width = '60%';
            items[2].classList.add('opacity-100');
            items[2].classList.remove('opacity-0', 'translate-y-4');
        }, 3500);
        
        setTimeout(() => {
            progressBar.style.width = '80%';
            items[3].classList.add('opacity-100');
            items[3].classList.remove('opacity-0', 'translate-y-4');
        }, 5000);
        
        setTimeout(() => {
            progressBar.style.width = '100%';
            items[4].classList.add('opacity-100');
            items[4].classList.remove('opacity-0', 'translate-y-4');
        }, 6500);
        
        setTimeout(() => {
            resultAmount.classList.add('opacity-100');
            resultAmount.classList.remove('opacity-0', 'scale-95');
        }, 7500);
        
        setTimeout(() => {
            viewResultsBtn.classList.add('opacity-100');
            viewResultsBtn.classList.remove('opacity-0');
        }, 8500);
    });
</script>
@endsection