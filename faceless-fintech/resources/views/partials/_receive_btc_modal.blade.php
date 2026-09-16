{{--
    Expects:
    - $btc_address: User's Bitcoin wallet address
--}}
<div 
    x-show="showReceiveModal" 
    x-transition:enter="transition ease-out duration-300" 
    x-transition:enter-start="opacity-0" 
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" 
    x-transition:leave-start="opacity-100" 
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto" 
    aria-labelledby="receive-modal-title" 
    role="dialog" 
    aria-modal="true" 
    style="display: none;">
    
    <!-- Backdrop with Enhanced Blur -->
    <div class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-md transition-opacity" 
         @click="showReceiveModal = false" 
         aria-hidden="true"></div>
    
    <!-- Modal Container -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl dark:shadow-gray-900/50 transform transition-all max-w-sm w-full overflow-hidden"
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 scale-95 translate-y-4" 
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100 scale-100 translate-y-0" 
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <!-- Compact Header -->
            <div class="bg-gradient-to-r from-primary-500 to-primary-600 text-white px-4 py-4 relative overflow-hidden">
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <i class="fa-brands fa-bitcoin text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold" id="receive-modal-title">Receive Bitcoin</h3>
                        </div>
                    </div>
                    <button @click="showReceiveModal = false" 
                            class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                        <i class="fa-solid fa-times text-white text-sm"></i>
                    </button>
                </div>
            </div>
            
            <!-- Compact Content -->
            <div class="p-4">
                @if(!empty($btc_address))
                    <!-- Compact QR Code Section -->
                    <div class="text-center mb-4">
                        <div class="w-32 h-32 mx-auto mb-3 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 p-2 rounded-2xl shadow border border-gray-200 dark:border-gray-600 relative">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $btc_address }}&bgcolor=ffffff&color=1f2937" 
                                 alt="BTC Address QR Code" 
                                 class="w-full h-full rounded-xl">
                            
                            <!-- Small Bitcoin Logo -->
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <div class="w-6 h-6 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow border border-primary-500">
                                    <i class="fa-brands fa-bitcoin text-primary-500 text-xs"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Scan with your Bitcoin wallet</p>
                    </div>
                    
                    <!-- Compact Address Section -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Bitcoin Address</label>
                        <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl p-3 group hover:border-primary-300 dark:hover:border-primary-600 transition-colors">
                            <div class="flex items-center space-x-2">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-mono text-gray-800 dark:text-gray-200 break-all">{{ $btc_address }}</p>
                                </div>
                                <button class="flex-shrink-0 w-8 h-8 bg-primary-500 hover:bg-primary-600 rounded-lg flex items-center justify-center transition-colors" 
                                        @click="navigator.clipboard.writeText('{{ $btc_address }}'); 
                                               $el.innerHTML = '<i class=\'fa-solid fa-check text-white text-xs\'></i>'; 
                                               setTimeout(() => $el.innerHTML = '<i class=\'fa-solid fa-copy text-white text-xs\'></i>', 2000)">
                                    <i class="fa-solid fa-copy text-white text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Compact Warning -->
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-action rounded-r-xl p-3 mb-4">
                        <div class="flex items-start space-x-2">
                            <i class="fa-solid fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 text-sm mt-0.5"></i>
                            <p class="text-xs text-yellow-700 dark:text-yellow-300">
                                Only send <strong>Bitcoin (BTC)</strong> to this address.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Compact Action Buttons -->
                    <div class="flex space-x-2">
                        <button @click="showReceiveModal = false" 
                                class="flex-1 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            Close
                        </button>
                        <button @click="navigator.clipboard.writeText('{{ $btc_address }}'); 
                                       $el.innerHTML = '<i class=\'fa-solid fa-check text-xs mr-1\'></i>Copied'; 
                                       setTimeout(() => $el.innerHTML = '<i class=\'fa-solid fa-share text-xs mr-1\'></i>Share', 2000)"
                                class="flex-1 px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 text-white text-sm font-medium rounded-xl hover:from-primary-600 hover:to-primary-700 transition-all">
                            <i class="fa-solid fa-share text-xs mr-1"></i>Share
                        </button>
                    </div>
                @else
                    <!-- Compact No Address -->
                    <div class="text-center py-6">
                        <div class="w-16 h-16 mx-auto mb-3 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-exclamation-triangle text-red-negative dark:text-red-400 text-xl"></i>
                        </div>
                        <h4 class="text-base font-semibold text-gray-900 dark:text-white mb-2">Address Not Available</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Contact support to configure your Bitcoin address.</p>
                        <button class="px-4 py-2 bg-primary-500 text-white text-sm font-medium rounded-xl hover:bg-primary-600 transition-colors">
                            Contact Support
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>