@extends('layouts.dash2')
@section('title', 'Grant Applications')

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
                'title' => 'Grant Applications',
                'showBackButton' => true,
                'backUrl' => route('dashboard'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Grant Applications</h1>
        </div>

        @if(session('error'))
            <div class="bg-red-50/90 dark:bg-red-900/20 backdrop-blur-sm border-l-4 border-red-500 dark:border-red-400 p-3 mb-4 rounded-r-xl">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($hasApplication)
            @php
                $statusConfig = [
                    'processing' => [
                        'gradient' => 'from-blue-50/80 to-indigo-50/80 dark:from-blue-900/20 dark:to-indigo-900/20',
                        'border' => 'border-blue-200/50 dark:border-blue-700/50',
                        'icon' => 'clock',
                        'iconBg' => 'bg-blue-100 dark:bg-blue-900/50',
                        'iconColor' => 'text-blue-600 dark:text-blue-400',
                        'title' => 'Application Processing',
                        'message' => 'Your grant application is currently being processed.',
                        'buttonBg' => 'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800'
                    ],
                    'approved' => [
                        'gradient' => 'from-green-50/80 to-emerald-50/80 dark:from-green-900/20 dark:to-emerald-900/20',
                        'border' => 'border-green-200/50 dark:border-green-700/50',
                        'icon' => 'check-circle',
                        'iconBg' => 'bg-green-100 dark:bg-green-900/50',
                        'iconColor' => 'text-green-600 dark:text-green-400',
                        'title' => 'Application Approved',
                        'message' => 'Your grant application has been approved.',
                        'buttonBg' => 'bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800'
                    ],
                    'rejected' => [
                        'gradient' => 'from-red-50/80 to-rose-50/80 dark:from-red-900/20 dark:to-rose-900/20',
                        'border' => 'border-red-200/50 dark:border-red-700/50',
                        'icon' => 'times-circle',
                        'iconBg' => 'bg-red-100 dark:bg-red-900/50',
                        'iconColor' => 'text-red-600 dark:text-red-400',
                        'title' => 'Application Not Approved',
                        'message' => 'Unfortunately, your grant application was not approved.',
                        'buttonBg' => 'bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800'
                    ],
                    'disbursed' => [
                        'gradient' => 'from-purple-50/80 to-fuchsia-50/80 dark:from-purple-900/20 dark:to-fuchsia-900/20',
                        'border' => 'border-purple-200/50 dark:border-purple-700/50',
                        'icon' => 'check-double',
                        'iconBg' => 'bg-purple-100 dark:bg-purple-900/50',
                        'iconColor' => 'text-purple-600 dark:text-purple-400',
                        'title' => 'Grant Disbursed',
                        'message' => 'Your grant has been successfully disbursed.',
                        'buttonBg' => 'bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800'
                    ]
                ];
                $config = $statusConfig[$latestStatus] ?? $statusConfig['processing'];
            @endphp
            <div class="bg-gradient-to-r {{ $config['gradient'] }} backdrop-blur-xl border {{ $config['border'] }} rounded-xl shadow-sm mb-6 overflow-hidden">
                <div class="p-4 lg:p-5 flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="h-10 w-10 rounded-full {{ $config['iconBg'] }} flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-{{ $config['icon'] }} {{ $config['iconColor'] }} text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">{{ $config['title'] }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $config['message'] }}
                            </p>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('grant.myApplications') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white {{ $config['buttonBg'] }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                            <i class="fas fa-eye mr-2 text-xs"></i>
                            View My Applications
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden mb-4">
                <div class="p-4 lg:p-5 text-center">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Select Application Type</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-3xl mx-auto text-sm">
                        Please select the type of application you would like to submit.
                        Different documentation is required for individual and company applications.
                    </p>
                    
                    <div class="grid md:grid-cols-2 gap-4 max-w-4xl mx-auto">
                        <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-4 shadow-sm transition-all hover:shadow-md">
                            <div class="h-10 w-10 bg-primary-100 dark:bg-primary-900/50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user text-primary-600 dark:text-primary-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Apply as Individual</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm">
                                For individual applicants seeking funding for programs, equipment, research or community outreach.
                            </p>
                            <a href="{{ route('grant.individual') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                                Continue
                            </a>
                        </div>
                        
                        <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-4 shadow-sm transition-all hover:shadow-md">
                            <div class="h-10 w-10 bg-secondary-100 dark:bg-secondary-900/50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-building text-secondary-600 dark:text-secondary-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Apply as Company</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm">
                                For registered organizations with an EIN, established history and defined mission.
                            </p>
                            <a href="{{ route('grant.company') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-secondary-600 to-secondary-700 hover:from-secondary-700 hover:to-secondary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition-all duration-200">
                                Continue
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
