@if(Session::has('message'))
<div class="fixed top-4 right-4 z-50 w-full max-w-sm" 
     x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 6000)"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-x-full"
     x-transition:enter-end="opacity-100 translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-x-0"
     x-transition:leave-end="opacity-0 translate-x-full">
    
    <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-2xl dark:shadow-gray-900/50 border border-red-200/50 dark:border-red-800/50 overflow-hidden">
        <!-- Alert Content -->
        <div class="p-4">
            <div class="flex items-start space-x-3">
                <!-- Error Icon -->
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                        <i class="fa-solid fa-exclamation-circle text-red-600 dark:text-red-400 text-sm"></i>
                    </div>
                </div>
                
                <!-- Message Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-red-800 dark:text-red-200 mb-1">Error</p>
                            <p class="text-sm text-red-700 dark:text-red-300 leading-relaxed">
                                {{ Session::get('message') }}
                            </p>
                        </div>
                        
                        <!-- Close Button -->
                        <button @click="show = false" 
                                class="ml-3 flex-shrink-0 w-6 h-6 rounded-lg bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-800/50 flex items-center justify-center transition-all duration-200 group">
                            <i class="fa-solid fa-times text-red-600 dark:text-red-400 text-xs group-hover:scale-110 transition-transform"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="h-1 bg-red-100 dark:bg-red-900/30">
            <div class="h-full bg-gradient-to-r from-red-500 to-red-600 animate-progress"></div>
        </div>
    </div>
</div>

<style>
    @keyframes progress {
        0% { width: 100%; }
        100% { width: 0%; }
    }
    
    .animate-progress {
        animation: progress 6s linear;
    }
</style>
@endif