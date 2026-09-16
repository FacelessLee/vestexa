<div 
    x-show="showSendMoney" 
    x-transition:enter="transition ease-out duration-300" enter-start="opacity-0" enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" leave-start="opacity-100" leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto" 
    aria-labelledby="send-money-title" role="dialog" aria-modal="true" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="showSendMoney" 
            x-transition:enter="transition ease-out duration-300" enter-start="opacity-0" enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" leave-start="opacity-100" leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/20 dark:bg-black/40 backdrop-blur-md transition-opacity" 
            @click="showSendMoney = false" aria-hidden="true">
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-show="showSendMoney" 
            x-transition:enter="transition ease-out duration-300" enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200" leave-start="opacity-100 translate-y-0 sm:scale-100" leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl px-4 pt-4 pb-4 text-left overflow-hidden shadow-2xl border border-white/20 dark:border-gray-700/50 transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
            <div class="absolute top-3 right-3">
                <button @click="showSendMoney = false" type="button" 
                        class="w-8 h-8 bg-gray-100/80 dark:bg-gray-700/80 hover:bg-gray-200/80 dark:hover:bg-gray-600/80 rounded-xl text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition-all duration-200 flex items-center justify-center">
                    <i class="fa-solid fa-times text-xs"></i>
                </button>
            </div>
            <div class="text-center mb-4">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 mb-3 shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50 relative">
                    <i class="fa-solid fa-paper-plane text-white text-sm"></i>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    <div class="absolute -bottom-0.5 -left-0.5 w-2 h-2 bg-yellow-400 rounded-full animate-bounce"></div>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1" id="send-money-title">Send Money</h3>
                <p class="text-xs text-gray-600 dark:text-gray-400 font-medium">Swift & Secure Money Transfer</p>
            </div>
            <div class="space-y-3 mb-4">
                <a href="{{ route('localtransfer') }}" class="block group">
                    <div class="relative p-3 bg-gradient-to-br from-gray-50/80 to-white/80 dark:from-gray-700/80 dark:to-gray-800/80 hover:from-primary-50/80 hover:to-primary-100/50 dark:hover:from-primary-900/30 dark:hover:to-primary-800/30 rounded-xl border border-gray-100/50 dark:border-gray-600/50 hover:border-primary-200/50 dark:hover:border-primary-700/50 transition-all duration-300 hover:shadow-md hover:shadow-primary-500/10 dark:hover:shadow-primary-900/20 transform hover:scale-[1.02]">
                        <div class="absolute top-2 right-2 w-6 h-6 bg-primary-200/20 dark:bg-primary-800/30 rounded-full blur-lg group-hover:bg-primary-300/30 dark:group-hover:bg-primary-700/40 transition-colors duration-300"></div>
                        <div class="flex items-center justify-between relative">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-8 w-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md shadow-primary-500/25 dark:shadow-primary-900/50">
                                        <i class="fa-solid fa-users text-white text-xs"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-0.5 group-hover:text-primary-700 dark:group-hover:text-primary-300 transition-colors duration-300 text-sm">Local Transfer</h4>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Send money to local accounts instantly</p>
                                    <div class="flex items-center">
                                        <div class="px-1.5 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-md text-xs font-semibold mr-1">
                                            <i class="fa-solid fa-bolt mr-1"></i>Instant
                                        </div>
                                        <div class="px-1.5 py-0.5 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 rounded-md text-xs font-semibold">
                                            <i class="fa-solid fa-gift mr-1"></i>0% Fee
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-7 h-7 bg-white/80 dark:bg-gray-700/80 group-hover:bg-primary-100 dark:group-hover:bg-primary-900/50 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-sm">
                                <i class="fa-solid fa-arrow-right text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-300 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('internationaltransfer') }}" class="block group">
                    <div class="relative p-3 bg-gradient-to-br from-gray-50/80 to-white/80 dark:from-gray-700/80 dark:to-gray-800/80 hover:from-blue-50/80 hover:to-blue-100/50 dark:hover:from-blue-900/30 dark:hover:to-blue-800/30 rounded-xl border border-gray-100/50 dark:border-gray-600/50 hover:border-blue-200/50 dark:hover:border-blue-700/50 transition-all duration-300 hover:shadow-md hover:shadow-blue-500/10 dark:hover:shadow-blue-900/20 transform hover:scale-[1.02]">
                        <div class="absolute top-2 right-2 w-6 h-6 bg-blue-200/20 dark:bg-blue-800/30 rounded-full blur-lg group-hover:bg-blue-300/30 dark:group-hover:bg-blue-700/40 transition-colors duration-300"></div>
                        <div class="flex items-center justify-between relative">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-8 w-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md shadow-blue-500/25 dark:shadow-blue-900/50">
                                        <i class="fa-solid fa-globe-americas text-white text-xs"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-0.5 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors duration-300 text-sm">International Wire</h4>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Global transfers within 72 hours</p>
                                    <div class="flex items-center">
                                        <div class="px-1.5 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-md text-xs font-semibold mr-1">
                                            <i class="fa-solid fa-shield-check mr-1"></i>Secure
                                        </div>
                                        <div class="px-1.5 py-0.5 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 rounded-md text-xs font-semibold">
                                            <i class="fa-solid fa-clock mr-1"></i>72hrs
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-7 h-7 bg-white/80 dark:bg-gray-700/80 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/50 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-sm">
                                <i class="fa-solid fa-arrow-right text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex items-start p-3 bg-gradient-to-r from-gray-50/80 to-white/80 dark:from-gray-700/80 dark:to-gray-800/80 rounded-xl border border-gray-100/50 dark:border-gray-600/50 mb-4">
                <div class="w-6 h-6 bg-gray-500 dark:bg-gray-600 rounded-lg flex items-center justify-center mr-2 flex-shrink-0">
                    <i class="fa-solid fa-info text-white text-xs"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-700 dark:text-gray-300 font-medium">All transfers are protected by bank-grade encryption and require verification for your security.</p>
                </div>
            </div>
            <div class="flex justify-end">
                <button @click="showSendMoney = false" 
                        class="px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-200 font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none shadow-sm text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>