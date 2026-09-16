@extends('layouts.dash2')
@section('title', 'Fund Transfer')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-4xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Verification Required',
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
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Verification Required</h1>
            </div>
        </div>

        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 dark:from-red-600 dark:to-red-700 px-4 lg:px-6 py-4 lg:py-5">
                <div class="flex items-center justify-center">
                    <div class="bg-white/20 dark:bg-white/10 backdrop-blur-sm p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-white text-2xl lg:text-3xl"></i>
                    </div>
                </div>
                <h1 class="text-white text-center font-bold text-xl lg:text-2xl mt-4">Before You Proceed!</h1>
                <p class="text-white/80 dark:text-white/70 text-center mt-2 text-sm lg:text-base">Additional verification is required</p>
            </div>
            
            <!-- Processing Modal (Hidden by default) -->
            <div id="processingModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 transition-opacity bg-gray-900 dark:bg-black bg-opacity-70 dark:bg-opacity-80"></div>
                    
                    <!-- Modal panel -->
                    <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl sm:align-middle sm:max-w-lg border border-white/20 dark:border-gray-700/50">
                        <!-- Processing animation and content -->
                        <div class="text-center py-6">
                            <!-- Animated verification icon with pulse effect -->
                            <div class="relative mx-auto w-24 h-24 mb-8">
                                <div class="absolute inset-0 bg-primary-100 dark:bg-primary-900/30 rounded-full animate-pulse"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-primary-600 dark:text-primary-400 text-3xl"></i>
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" id="processingMessage">Verifying code...</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">Please do not close this window</p>
                            
                            <!-- Progress bar with percentage -->
                            <div class="mb-6">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                                    <div id="progressBar" class="bg-primary-600 dark:bg-primary-500 h-2.5 rounded-full transition-all duration-300 ease-out" style="width: 0%"></div>
                                </div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-2"><span id="progressPercentage">0</span>% Complete</p>
                            </div>
                            
                            <!-- Security message -->
                            <div class="flex items-center justify-center text-sm text-gray-500 dark:text-gray-400">
                                <i class="fas fa-shield-alt text-primary-500 dark:text-primary-400 mr-2 text-sm"></i>
                                <span>Secured by bank-level encryption</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card Content -->
            <div class="p-4 lg:p-6">
                <!-- Alerts -->
                <x-danger-alert />
                <x-success-alert />
                
                <!-- Main Content -->
                <div class="text-center pt-4">
                    <div class="inline-flex items-center justify-center h-20 w-20 lg:h-24 lg:w-24 rounded-full bg-red-50/80 dark:bg-red-900/20 backdrop-blur-sm mb-6 border border-red-100 dark:border-red-800/50">
                        <i class="fas fa-shield-alt text-red-600 dark:text-red-400 text-2xl lg:text-3xl"></i>
                    </div>
                    
                    <div class="text-gray-700 dark:text-gray-300 mb-8 max-w-lg mx-auto">
                        <p class="text-base lg:text-lg">{{$settings->code1message}}</p>
                    </div>
                    
                    <form action="{{ route('codecomfirm') }}" method="POST" class="max-w-md mx-auto" id="codeForm">
                        @csrf
                        <div class="mb-6">
                            <label for="code1" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ $settings->code1 }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                    <i class="fas fa-key text-gray-400 dark:text-gray-500 text-sm"></i>
                                </div>
                                <input 
                                    type="text" 
                                    name="code1" 
                                    id="code1" 
                                    class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                    placeholder="Enter {{ $settings->code1 }}"
                                    required
                                >
                            </div>
                        </div>
                        
                        <div class="flex flex-col space-y-3">
                            <button 
                                type="button" 
                                id="confirmCodeBtn"
                                class="w-full inline-flex items-center justify-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-[1.02]"
                            >
                                <i class="fas fa-check-circle mr-2 text-sm"></i>
                                Confirm {{$settings->code1}}
                            </button>
                            
                            <a 
                                href="{{ route('dashboard') }}" 
                                class="w-full inline-flex items-center justify-center px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-base font-medium text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors"
                            >
                                <i class="fas fa-arrow-left mr-2 text-gray-400 dark:text-gray-500 text-sm"></i>
                                Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get DOM elements
        const confirmBtn = document.getElementById('confirmCodeBtn');
        const codeForm = document.getElementById('codeForm');
        const processingModal = document.getElementById('processingModal');
        const progressBar = document.getElementById('progressBar');
        const processingMessage = document.getElementById('processingMessage');
        
        // Processing messages for different stages
        const processingMessages = [
            'Verifying code...',
            'Authenticating...',
            'Validating security token...',
            'Checking authorization...',
            'Completing verification...'
        ];
        
        // Add click event listener to confirm button
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Form validation
                const codeInput = document.querySelector('#code1');
                if (!codeInput.value.trim()) {
                    alert('Please enter the verification code');
                    return;
                }
                
                // Show processing modal
                processingModal.classList.remove('hidden');
                
                // Reset progress
                let progress = 0;
                let currentStage = 0;
                progressBar.style.width = '0%';
                processingMessage.textContent = processingMessages[0];
                
                // Simulate processing with progress updates
                const totalDuration = 5000; // 5 seconds minimum
                const interval = 50; // Update every 50ms for smooth animation
                const steps = totalDuration / interval;
                const progressIncrement = 100 / steps;
                
                const progressInterval = setInterval(function() {
                    progress += progressIncrement;
                    progressBar.style.width = progress + '%';
                    document.getElementById('progressPercentage').textContent = Math.min(Math.round(progress), 100);
                    
                    // Update message at certain progress points
                    if (progress >= 20 && currentStage < 1) {
                        currentStage = 1;
                        processingMessage.textContent = processingMessages[1];
                    } else if (progress >= 40 && currentStage < 2) {
                        currentStage = 2;
                        processingMessage.textContent = processingMessages[2];
                    } else if (progress >= 60 && currentStage < 3) {
                        currentStage = 3;
                        processingMessage.textContent = processingMessages[3];
                    } else if (progress >= 80 && currentStage < 4) {
                        currentStage = 4;
                        processingMessage.textContent = processingMessages[4];
                    }
                    
                    // When progress is complete
                    if (progress >= 100) {
                        clearInterval(progressInterval);
                        // Submit the form after animation completes
                        setTimeout(function() {
                            // Ensure form is submitted as POST
                            codeForm.method = 'post';
                            codeForm.submit();
                        }, 200);
                    }
                }, interval);
            });
        }
    });
</script>

@endsection