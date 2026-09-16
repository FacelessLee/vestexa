@if(Session::has('success'))
<div class="fixed top-4 right-4 z-50 w-full max-w-sm" 
     x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 5000)"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-x-full"
     x-transition:enter-end="opacity-100 translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-x-0"
     x-transition:leave-end="opacity-0 translate-x-full">
    
    <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-2xl dark:shadow-gray-900/50 border border-primary-200/50 dark:border-primary-800/50 overflow-hidden">
        <!-- Alert Content -->
        <div class="p-4">
            <div class="flex items-start space-x-3">
                <!-- Success Icon -->
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                        <i class="fa-solid fa-check text-primary-600 dark:text-primary-400 text-sm"></i>
                    </div>
                </div>
                
                <!-- Message Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-primary-800 dark:text-primary-200 mb-1">Success</p>
                            <p class="text-sm text-primary-700 dark:text-primary-300 leading-relaxed">
                                {{ Session::get('success') }}
                            </p>
                        </div>
                        
                        <!-- Close Button -->
                        <button @click="show = false" 
                                class="ml-3 flex-shrink-0 w-6 h-6 rounded-lg bg-primary-100 dark:bg-primary-900/30 hover:bg-primary-200 dark:hover:bg-primary-800/50 flex items-center justify-center transition-all duration-200 group">
                            <i class="fa-solid fa-times text-primary-600 dark:text-primary-400 text-xs group-hover:scale-110 transition-transform"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="h-1 bg-primary-100 dark:bg-primary-900/30">
            <div class="h-full bg-gradient-to-r from-primary-500 to-primary-600 animate-progress"></div>
        </div>
    </div>
</div>

<style>
    @keyframes progress {
        0% { width: 100%; }
        100% { width: 0%; }
    }
    
    .animate-progress {
        animation: progress 5s linear;
    }
</style>
@endif