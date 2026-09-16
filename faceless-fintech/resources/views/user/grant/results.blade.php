@extends('layouts.dash2')
@section('title', 'Grant Application Results')

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
                'title' => 'Grant Results',
                'showBackButton' => true,
                'backUrl' => route('dashboard'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Grant Application Results</h1>
        </div>

        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden mb-4">
            <div class="p-6 lg:p-8 text-center">
                @if($grant_limit <= 0)
                    <div class="mb-4">
                        <div class="h-16 w-16 rounded-full bg-yellow-100 dark:bg-yellow-900/50 flex items-center justify-center mx-auto">
                            <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">We're Sorry</h2>
                    <h3 class="text-lg text-gray-600 dark:text-gray-300 mb-4">Your grant application could not be approved at this time</h3>
                    
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-6 text-sm">
                        Based on your current account status and the information provided, we are unable to approve your
                        grant application at this time. You may contact our support team for more information.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                            <i class="fas fa-tachometer-alt mr-2 text-xs"></i>
                            Return to Dashboard
                        </a>
                        <a href="{{ route('support') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                            <i class="fas fa-life-ring mr-2 text-xs"></i>
                            Contact Support
                        </a>
                    </div>
                @else
                    <div class="mb-4">
                        <div class="h-16 w-16 rounded-full bg-green-100 dark:bg-green-900/50 flex items-center justify-center mx-auto">
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                        </div>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Congratulations!</h2>
                    <h3 class="text-lg text-gray-600 dark:text-gray-300 mb-4">Your grant application has been pre-approved</h3>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">You Requested</p>
                        <div class="text-base font-medium text-gray-600 dark:text-gray-400 mb-3">
                            {{ Auth::user()->s_curr }}{{ number_format($latest_application->requested_amount, 2, '.', ',') }}
                        </div>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Pre-Approved Amount</p>
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                            {{ Auth::user()->s_curr }}{{ number_format($grant_limit, 2, '.', ',') }}
                        </div>
                    </div>
                    
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-6 text-sm">
                        Based on your application and account information, you have been pre-approved for the grant amount shown above.
                        Our team will review your application in detail and may contact you for additional information if needed.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                            <i class="fas fa-tachometer-alt mr-2 text-xs"></i>
                            Return to Dashboard
                        </a>
                        <a href="{{ route('grant.myApplications') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                            <i class="fas fa-list mr-2 text-xs"></i>
                            View My Applications
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        @if($grant_limit > 0)
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <div class="bg-gradient-to-r from-primary-50/80 to-white/80 dark:from-primary-900/20 dark:to-gray-800/80 backdrop-blur-sm border-b border-gray-100/50 dark:border-gray-700/50 px-4 py-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Next Steps</h2>
                </div>
                <div class="p-4 lg:p-5">
                    <div class="space-y-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 text-sm font-medium">
                                    1
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">Application Review</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Our team will review your application in detail within the next 3-5 business days.
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 text-sm font-medium">
                                    2
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">Documentation</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    You may be asked to provide additional documentation to support your application.
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 text-sm font-medium">
                                    3
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">Final Approval</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Once approved, funds will be disbursed according to our grant payment schedule.
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 text-sm font-medium">
                                    4
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">Reporting</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    All grant recipients are required to submit progress reports on how funds are being utilized.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection