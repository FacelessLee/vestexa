@extends('layouts.dash2')
@section('title', 'Enter Filing ID')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-4xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Enter Filing ID',
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
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Enter Filing ID</h1>
            </div>
        </div>

        <!-- Session Messages -->
        @if(session('error'))
            <div class="mb-4 bg-red-50/90 dark:bg-red-900/20 backdrop-blur-sm border-l-4 border-red-400 dark:border-red-500 p-3 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400 dark:text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 bg-green-50/90 dark:bg-green-900/20 backdrop-blur-sm border-l-4 border-green-400 dark:border-green-500 p-3 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400 dark:text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="p-4 lg:p-5">
                <!-- Header -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100/80 dark:bg-primary-900/30 backdrop-blur-sm mb-3">
                        <i class="fas fa-file-alt text-primary-600 dark:text-primary-400 text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Enter Your Filing ID</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Please enter the filing ID provided by our support team</p>
                </div>

                <!-- Support Notice -->
                <div class="bg-gradient-to-r from-primary-50/80 to-blue-50/80 dark:from-gray-800/90 dark:to-gray-700/90 backdrop-blur-sm p-4 rounded-lg border border-primary-200/50 dark:border-gray-600/50 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-primary-600 dark:text-primary-400 text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-800 dark:text-gray-200">Need a Filing ID?</h3>
                            <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                <p>Please contact our support team to receive your filing ID. This ID is required to process your refund request.</p>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('support') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                                    <i class="fas fa-comments mr-2 text-xs"></i> Contact Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filing ID Form -->
                <form action="{{ route('irs-refund.update-filing-id') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-key text-primary-500 dark:text-primary-400 mr-2 text-sm"></i>
                            Filing ID Information
                        </h3>
                        
                        <div class="mb-4">
                            <label for="filing_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filing ID</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                    <i class="fas fa-hashtag text-gray-400 dark:text-gray-500 text-xs"></i>
                                </div>
                                <input type="text" name="filing_id" id="filing_id" required
                                    class="block w-full pl-10 pr-3 py-2.5 border @error('filing_id') border-red-300 dark:border-red-600 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm relative z-0"
                                    placeholder="Enter your filing ID"
                                    value="{{ old('filing_id') }}">
                            </div>
                            @error('filing_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                            <i class="fas fa-paper-plane mr-2 text-xs"></i> Submit Filing ID
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection 