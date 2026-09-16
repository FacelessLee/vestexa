{{--
    Expects:
    - $support_route: Route name for support page
--}}
<div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 overflow-hidden border border-white/20 dark:border-gray-700/50 relative">
    <!-- Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary-50/80 via-primary-100/50 to-primary-200/30 dark:from-gray-900/80 dark:via-gray-800/50 dark:to-gray-700/30"></div>
    
    <!-- Content -->
    <div class="relative p-4">
        <!-- Icon Section -->
        <div class="flex items-center justify-center mb-3">
            <div class="relative">
                <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50">
                    <i class="fa-solid fa-headset text-sm text-white"></i>
                </div>
                <!-- Floating indicator -->
                <div class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-green-500 rounded-full border border-white dark:border-gray-800 flex items-center justify-center">
                    <div class="w-1 h-1 bg-white rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>
        
        <!-- Text Content -->
        <div class="text-center mb-3">
            <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-1">Need Assistance?</h3>
            <p class="text-xs text-gray-700 dark:text-gray-300 font-medium mb-1">Our expert support team is available</p>
            <div class="flex items-center justify-center text-xs text-primary-700 dark:text-primary-300 font-semibold">
                <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1 animate-pulse"></div>
                <span>24/7 Live Support</span>
            </div>
        </div>
        
        <!-- Features -->
        <div class="grid grid-cols-2 gap-2 mb-3">
            <div class="flex items-center p-2 bg-white/60 dark:bg-gray-700/60 rounded-xl border border-slate-100/50 dark:border-gray-600/70">
                <div class="w-6 h-6 bg-slate-100 dark:bg-gray-600/50 rounded-lg flex items-center justify-center mr-2">
                    <i class="fa-solid fa-clock text-slate-600 dark:text-slate-300 text-xs"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-900 dark:text-slate-50">Quick Response</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">< 5 minutes</p>
                </div>
            </div>
            <div class="flex items-center p-2 bg-white/60 dark:bg-gray-700/60 rounded-xl border border-slate-100/50 dark:border-gray-600/70">
                <div class="w-6 h-6 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center mr-2">
                    <i class="fa-solid fa-shield-check text-green-600 dark:text-green-400 text-xs"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-900 dark:text-slate-50">Secure Chat</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Encrypted</p>
                </div>
            </div>
        </div>
        
        <!-- Action Button -->
        <div class="flex justify-center">
            <a href="{{ $support_route }}" 
               class="group inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50 hover:shadow-primary-500/40 dark:hover:shadow-primary-800/50 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-sm">
                <i class="fa-solid fa-comments text-xs mr-2 group-hover:animate-bounce"></i>
                <span>Start Live Chat</span>
                <div class="ml-2 w-1.5 h-1.5 bg-white/80 rounded-full group-hover:bg-white transition-colors duration-300"></div>
            </a>
        </div>
        
        <!-- Additional Info -->
        <div class="mt-2 text-center">
            <p class="text-xs text-gray-600 dark:text-gray-400">
                <i class="fa-solid fa-phone mr-1 text-primary-500 text-xs"></i>
                Or call us directly for urgent matters
            </p>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-2 right-2 w-8 h-8 bg-primary-200/30 dark:bg-gray-700/30 rounded-full blur-xl"></div>
    <div class="absolute bottom-2 left-2 w-6 h-6 bg-primary-300/20 dark:bg-gray-600/20 rounded-full blur-lg"></div>
</div>