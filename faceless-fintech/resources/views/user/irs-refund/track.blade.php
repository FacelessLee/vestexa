@extends('layouts.dash2')
@section('title', 'Track IRS Tax Refund')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-4xl mx-auto">
        <!-- Alerts -->
        <x-danger-alert />
        <x-success-alert />

        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Track Refund',
                'showBackButton' => true,
                'backUrl' => route('irs-refund'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('irs-refund') }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400 border border-gray-200 dark:border-gray-600 transition-colors">
                    <i class="fas fa-arrow-left text-xs"></i>
                </a>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Track Your IRS Tax Refund</h1>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('irs-refund') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-plus mr-1.5 text-xs"></i>
                    New Request
                </a>
            </div>
        </div>

        @if($refund)
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <!-- Header -->
                <div class="text-center p-4 lg:p-5 border-b border-gray-200/50 dark:border-gray-700/50">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100/80 dark:bg-primary-900/30 backdrop-blur-sm mb-3">
                        <i class="fas fa-chart-line text-primary-600 dark:text-primary-400 text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Track Your IRS Tax Refund</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Monitor the status of your refund request in real-time</p>
                </div>

                <!-- Status Timeline -->
                <div class="p-4 lg:p-5">
                    <div class="relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-4 top-0 h-full w-0.5 bg-gray-200 dark:bg-gray-600"></div>

                        <!-- Status Steps -->
                        <div class="space-y-6">
                            <!-- Submitted Step -->
                            <div class="relative">
                                <div class="absolute left-0 w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center">
                                    <i class="fas fa-check text-primary-600 dark:text-primary-400 text-sm"></i>
                                </div>
                                <div class="ml-12">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Request Submitted</h3>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $refund->created_at->format('M d, Y H:i') }}</span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Your refund request has been successfully submitted</p>
                                </div>
                            </div>

                            <!-- Under Review Step -->
                            <div class="relative">
                                <div class="absolute left-0 w-8 h-8 rounded-full {{ in_array($refund->status, ['pending', 'approved', 'rejected']) ? 'bg-primary-100 dark:bg-primary-900/50' : 'bg-gray-100 dark:bg-gray-700' }} flex items-center justify-center">
                                    <i class="fas fa-search {{ in_array($refund->status, ['pending', 'approved', 'rejected']) ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500' }} text-sm"></i>
                                </div>
                                <div class="ml-12">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Under Review</h3>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $refund->status === 'pending' ? 'In Progress' : ($refund->status === 'approved' ? 'Completed' : 'Completed') }}</span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Our team is reviewing your request and verifying your information</p>
                                </div>
                            </div>

                            <!-- Decision Step -->
                            <div class="relative">
                                <div class="absolute left-0 w-8 h-8 rounded-full {{ in_array($refund->status, ['approved', 'rejected']) ? 'bg-primary-100 dark:bg-primary-900/50' : 'bg-gray-100 dark:bg-gray-700' }} flex items-center justify-center">
                                    <i class="fas {{ $refund->status === 'approved' ? 'fa-check-circle' : ($refund->status === 'rejected' ? 'fa-times-circle' : 'fa-clock') }} {{ in_array($refund->status, ['approved', 'rejected']) ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500' }} text-sm"></i>
                                </div>
                                <div class="ml-12">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Decision</h3>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $refund->status === 'pending' ? 'Pending' : ($refund->status === 'approved' ? 'Approved' : 'Rejected') }}</span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        @if($refund->status === 'pending')
                                            Waiting for review completion
                                        @elseif($refund->status === 'approved')
                                            Your refund request has been approved
                                        @else
                                            Your refund request has been rejected
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Processing Step -->
                            @if($refund->status === 'approved')
                            <div class="relative">
                                <div class="absolute left-0 w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center">
                                    <i class="fas fa-spinner text-primary-600 dark:text-primary-400 text-sm animate-spin"></i>
                                </div>
                                <div class="ml-12">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Processing Refund</h3>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">In Progress</span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Your refund is being processed and will be credited to your account soon</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Refund Details -->
                <div class="border-t border-gray-200/50 dark:border-gray-700/50 p-4 lg:p-5">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Refund Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-3 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Request ID</h4>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $refund->id }}</p>
                        </div>
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-3 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Filing ID</h4>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $refund->filing_id }}</p>
                        </div>
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-3 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Submission Date</h4>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $refund->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-3 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</h4>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-medium
                                {{ $refund->status === 'approved' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' : 
                                   ($refund->status === 'rejected' ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' : 
                                    'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300') }}">
                                {{ ucfirst($refund->status) }}
                            </span>
                        </div>
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-3 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Last Updated</h4>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $refund->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-gray-200/50 dark:border-gray-700/50 p-4 lg:p-5">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                        <div class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <i class="fas fa-info-circle mr-1.5 text-xs"></i>
                            Need help? Contact our support team
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('support') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                                <i class="fas fa-comments mr-2 text-xs"></i> Contact Support
                            </a>
                            <a href="{{ route('irs-refund') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                                <i class="fas fa-sync-alt mr-2 text-xs"></i> Refresh Status
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden p-4 lg:p-5">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gray-100/80 dark:bg-gray-700/50 backdrop-blur-sm mb-4">
                        <i class="fas fa-search text-gray-400 dark:text-gray-500 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Refund Request Found</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">You haven't submitted any refund requests yet.</p>
                    <a href="{{ route('irs-refund') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                        <i class="fas fa-plus mr-2 text-xs"></i> Submit New Request
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection 