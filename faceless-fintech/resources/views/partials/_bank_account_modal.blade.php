{{--
    Expects:
    - $settings: Site settings object
    - $user: Authenticated user object
--}}
<div 
    x-show="showBankAccount" 
    x-transition:enter="transition ease-out duration-300" enter-start="opacity-0" enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" leave-start="opacity-100" leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto" 
    aria-labelledby="bank-account-title" role="dialog" aria-modal="true" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop with enhanced blur -->
        <div x-show="showBankAccount" 
            x-transition:enter="transition ease-out duration-300" enter-start="opacity-0" enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" leave-start="opacity-100" leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/20 dark:bg-black/40 backdrop-blur-md transition-opacity" 
            @click="showBankAccount = false" aria-hidden="true">
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <!-- Modal Content -->
        <div x-show="showBankAccount" 
            x-transition:enter="transition ease-out duration-300" enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200" leave-start="opacity-100 translate-y-0 sm:scale-100" leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl px-4 pt-4 pb-4 text-left overflow-hidden shadow-2xl border border-white/20 dark:border-gray-700/50 transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
            
            <!-- Close Button -->
            <div class="absolute top-3 right-3">
                <button @click="showBankAccount = false" type="button" 
                        class="w-8 h-8 bg-gray-100/80 dark:bg-gray-700/80 hover:bg-gray-200/80 dark:hover:bg-gray-600/80 rounded-xl text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition-all duration-200 flex items-center justify-center">
                    <i class="fa-solid fa-times text-xs"></i>
                </button>
            </div>
            
            <!-- Header Section -->
            <div class="text-center mb-4">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 mb-3 shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50">
                    <i class="fa-solid fa-building-columns text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1" id="bank-account-title">Bank Account Details</h3>
                <p class="text-xs text-gray-600 dark:text-gray-400 font-medium">{{ $settings->site_name }} Banking</p>
            </div>
            
            <!-- Account Details Card -->
            <div class="bg-gradient-to-br from-gray-50/80 to-white/80 dark:from-gray-700/80 dark:to-gray-800/80 backdrop-blur-sm p-3 rounded-xl mb-4 border border-gray-100/50 dark:border-gray-600/50">
                <div class="flex items-center mb-3">
                    <div class="w-6 h-6 bg-primary-100 dark:bg-primary-900/50 rounded-lg flex items-center justify-center mr-2">
                        <i class="fa-solid fa-circle-info text-primary-600 dark:text-primary-400 text-xs"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-sm">Account Information</h4>
                </div>
                
                <div class="space-y-2">
                    <!-- Account Name -->
                    <div class="group p-2 hover:bg-white/60 dark:hover:bg-gray-600/60 rounded-lg transition-all duration-200 border border-transparent hover:border-primary-100 dark:hover:border-primary-800">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-2 w-2 bg-primary-500 rounded-full mr-3"></div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Account Name</p>
                                    <p class="text-xs font-bold text-gray-900 dark:text-white mt-0.5">{{ $user->name }} {{ $user->lastname }}</p>
                                </div>
                            </div>
                            <button class="w-7 h-7 bg-primary-50 dark:bg-primary-900/50 hover:bg-primary-100 dark:hover:bg-primary-800/50 rounded-lg text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 focus:outline-none transition-all duration-200 flex items-center justify-center group-hover:scale-105" 
                                    @click="navigator.clipboard.writeText('{{ $user->name }} {{ $user->lastname }}'); $el.querySelector('i').classList.add('text-green-500'); setTimeout(() => $el.querySelector('i').classList.remove('text-green-500'), 1500)">
                                <i class="fa-solid fa-copy text-xs transition-colors duration-300"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Account Number -->
                    <div class="group p-2 hover:bg-white/60 dark:hover:bg-gray-600/60 rounded-lg transition-all duration-200 border border-transparent hover:border-primary-100 dark:hover:border-primary-800">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-2 w-2 bg-primary-500 rounded-full mr-3"></div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Account Number</p>
                                    <p class="text-xs font-bold text-gray-900 dark:text-white mt-0.5 font-mono">{{ $user->usernumber }}</p>
                                </div>
                            </div>
                            <button class="w-7 h-7 bg-primary-50 dark:bg-primary-900/50 hover:bg-primary-100 dark:hover:bg-primary-800/50 rounded-lg text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 focus:outline-none transition-all duration-200 flex items-center justify-center group-hover:scale-105" 
                                    @click="navigator.clipboard.writeText('{{ $user->usernumber }}'); $el.querySelector('i').classList.add('text-green-500'); setTimeout(() => $el.querySelector('i').classList.remove('text-green-500'), 1500)">
                                <i class="fa-solid fa-copy text-xs transition-colors duration-300"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Bitcoin Address (if exists) -->
                    @if(!empty($user->btc_address))
                    <div class="group p-2 hover:bg-white/60 dark:hover:bg-gray-600/60 rounded-lg transition-all duration-200 border border-transparent hover:border-yellow-100 dark:hover:border-yellow-800">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-2 w-2 bg-yellow-400 rounded-full mr-3"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Bitcoin Wallet</p>
                                    <p class="text-xs font-bold text-gray-900 dark:text-white mt-0.5 font-mono truncate" title="{{ $user->btc_address }}">{{ $user->btc_address }}</p>
                                </div>
                            </div>
                            <button class="w-7 h-7 bg-yellow-50 dark:bg-yellow-900/50 hover:bg-yellow-100 dark:hover:bg-yellow-800/50 rounded-lg text-yellow-600 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300 focus:outline-none transition-all duration-200 flex items-center justify-center group-hover:scale-105 ml-2" 
                                    @click="navigator.clipboard.writeText('{{ $user->btc_address }}'); $el.querySelector('i').classList.add('text-green-500'); setTimeout(() => $el.querySelector('i').classList.remove('text-green-500'), 1500)">
                                <i class="fa-solid fa-copy text-xs transition-colors duration-300"></i>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Warning Notice -->
            <div class="flex items-start p-3 bg-gradient-to-r from-slate-50 to-slate-100/50 dark:from-slate-800/50 dark:to-slate-700/50 rounded-xl border border-slate-200/50 dark:border-slate-600/70 mb-4">
                <div class="w-6 h-6 bg-slate-500 dark:bg-slate-600 rounded-lg flex items-center justify-center mr-2 flex-shrink-0">
                    <i class="fa-solid fa-shield-halved text-white text-xs"></i>
                </div>
                <div>
                    <h5 class="font-bold text-slate-900 dark:text-slate-50 mb-0.5 text-xs">Security Notice</h5>
                    <p class="text-xs text-slate-800 dark:text-slate-100">Always contact {{ $settings->site_name }} Support before making payments to verify account details.</p>
                </div>
            </div>
            
            <!-- Action Button -->
            <div class="flex justify-end">
                <button @click="showBankAccount = false" 
                        class="px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-200 font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none shadow-sm text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>