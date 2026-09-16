@extends('layouts.guest2')

@section('title', 'Account Suspended')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <!-- Icon -->
            <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20 mb-6">
                <i class="fas fa-ban text-4xl text-red-600 dark:text-red-400"></i>
            </div>
            
            <!-- Title -->
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                Account Suspended
            </h2>
            
            <!-- Subtitle -->
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                Your account has been temporarily suspended
            </p>
        </div>

        <!-- Ban Message Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border-l-4 border-red-500">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                </div>
                <div class="ml-3 w-full">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        Suspension Notice
                    </h3>
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ $banMessage }}
                    </div>
                    
                    @if($bannedAt)
                    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-clock mr-1"></i>
                        Suspended on: {{ \Carbon\Carbon::parse($bannedAt)->format('M j, Y \a\t g:i A') }}
                    </div>
                    @endif
                    
                    @if($banExpiresAt)
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Expires on: {{ \Carbon\Carbon::parse($banExpiresAt)->format('M j, Y \a\t g:i A') }}
                    </div>
                    @else
                    <div class="mt-2 text-sm text-red-600 dark:text-red-400 font-medium">
                        <i class="fas fa-infinity mr-1"></i>
                        This is a permanent suspension
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contact Support Card -->
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-6">
            <div class="flex items-center mb-3">
                <i class="fas fa-life-ring text-blue-500 text-xl mr-3"></i>
                <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">
                    Need Help?
                </h3>
            </div>
            <p class="text-blue-800 dark:text-blue-200 mb-4">
                If you believe this suspension was made in error or if you have questions about your account status, please contact our support team.
            </p>
            <div class="space-y-2 text-sm text-blue-700 dark:text-blue-300">
                <div class="flex items-center">
                    <i class="fas fa-envelope w-4 h-4 mr-2"></i>
                    <span>Email: support@{{ $settings->site_name ?? 'yourbank.com' }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-phone w-4 h-4 mr-2"></i>
                    <span>Phone: {{ $settings->contact_phone ?? '+1-800-BANKING' }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3">
            <!-- Back to Login -->
            <a href="{{ route('login') }}" 
               class="w-full flex justify-center py-3 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Login
            </a>
            
            <!-- Contact Support Button -->
            <a href="mailto:support@{{ $settings->site_name ?? 'yourbank.com' }}" 
               class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm bg-blue-600 text-sm font-medium text-white hover:bg-blue-700 transition duration-150 ease-in-out">
                <i class="fas fa-envelope mr-2"></i>
                Contact Support
            </a>
        </div>

        <!-- Footer Text -->
        <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-8">
            <p>© {{ date('Y') }} {{ $settings->site_name ?? 'Your Bank' }}. All rights reserved.</p>
        </div>
    </div>
</div>

<!-- Additional Styling for Animation -->
<style>
.fade-in {
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.bounce-in {
    animation: bounceIn 0.8s ease-out;
}

@keyframes bounceIn {
    0% { transform: scale(0.3); opacity: 0; }
    50% { transform: scale(1.05); }
    70% { transform: scale(0.9); }
    100% { transform: scale(1); opacity: 1; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to main content
    document.querySelector('.max-w-md').classList.add('fade-in');
    
    // Add bounce-in animation to icon
    document.querySelector('.fa-ban').parentElement.classList.add('bounce-in');
});
</script>
@endsection
