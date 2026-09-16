{{-- resources/views/partials/international/more-methods.blade.php --}}
<div x-show="showMoreMethods" class="mb-6" x-transition>
    <div class="flex items-center mb-4">
        <button 
            @click="showMoreMethods = false" 
            class="mr-3 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-full p-2 text-gray-500 dark:text-gray-400 border border-white/20 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors"
        >
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </button>
        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Additional Transfer Methods</h2>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        <!-- Skrill -->
        <div @click="withdrawMethod = 'Skrill'; changeMethod(); showMoreMethods = false" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
            <div class="flex items-center mb-2">
                <div class="h-8 w-8 rounded-xl bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-wallet text-indigo-600 dark:text-indigo-400 text-sm"></i>
                </div>
                <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Skrill</h3>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Transfer funds to your Skrill account.</p>
        </div>
        
        <!-- Venmo -->
        <div @click="withdrawMethod = 'Venmo'; changeMethod(); showMoreMethods = false" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
            <div class="flex items-center mb-2">
                <div class="h-8 w-8 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-mobile-screen text-blue-600 dark:text-blue-400 text-sm"></i>
                </div>
                <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Venmo</h3>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Send funds to your Venmo account.</p>
        </div>
        
        <!-- Zelle -->
        <div @click="withdrawMethod = 'Zelle'; changeMethod(); showMoreMethods = false" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
            <div class="flex items-center mb-2">
                <div class="h-8 w-8 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-bolt text-purple-600 dark:text-purple-400 text-sm"></i>
                </div>
                <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Zelle</h3>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Quick transfers to your Zelle account.</p>
        </div>
        
        <!-- Revolut -->
        <div @click="withdrawMethod = 'Revolut'; changeMethod(); showMoreMethods = false" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
            <div class="flex items-center mb-2">
                <div class="h-8 w-8 rounded-xl bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-credit-card text-cyan-600 dark:text-cyan-400 text-sm"></i>
                </div>
                <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Revolut</h3>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Transfer to your Revolut account with low fees.</p>
        </div>
        
        <!-- Alipay -->
        <div @click="withdrawMethod = 'Alipay'; changeMethod(); showMoreMethods = false" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
            <div class="flex items-center mb-2">
                <div class="h-8 w-8 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-mobile-screen-button text-blue-600 dark:text-blue-400 text-sm"></i>
                </div>
                <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Alipay</h3>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Send funds to your Alipay account.</p>
        </div>
        
        <!-- WeChat Pay -->
        <div @click="withdrawMethod = 'WeChat Pay'; changeMethod(); showMoreMethods = false" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
            <div class="flex items-center mb-2">
                <div class="h-8 w-8 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <i class="fa-brands fa-weixin text-green-600 dark:text-green-400 text-sm"></i>
                </div>
                <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">WeChat Pay</h3>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Transfer to your WeChat Pay wallet.</p>
        </div>
    </div>
</div>
