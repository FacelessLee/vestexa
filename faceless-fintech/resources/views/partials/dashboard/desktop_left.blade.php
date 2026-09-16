{{-- resources/views/partials/dashboard/desktop_left.blade.php --}}
{{-- Expects:
     - $monthly_deposits
     - $monthly_expenses
     - $total_volume
     - $cards
     - $settings
     - $walletBalance
     - $btc_rate
--}}

<div class="hidden lg:block py-6 mb-6">
    <!-- Desktop Stats Cards -->
    <div class="px-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $statCards = [
                    [
                        'label' => 'Account Limit', 
                        'value' => Auth::user()->s_curr . number_format(Auth::user()->limit, 2, '.', ','), 
                        'icon' => 'fa-solid fa-credit-card', 
                        'color' => 'bg-blue-500', 
                        'change' => 'Available'
                    ],
                    [
                        'label' => 'Monthly Deposits', 
                        'value' => Auth::user()->s_curr . number_format($monthly_deposits, 2, '.', ','), 
                        'icon' => 'fa-solid fa-arrow-down', 
                        'color' => 'bg-green-500', 
                        'change' => 'This Month'
                    ],
                    [
                        'label' => 'Monthly Expenses', 
                        'value' => Auth::user()->s_curr . number_format($monthly_expenses, 2, '.', ','), 
                        'icon' => 'fa-solid fa-arrow-up', 
                        'color' => 'bg-red-500', 
                        'change' => 'This Month'
                    ],
                    [
                        'label' => 'Total Volume', 
                        'value' => Auth::user()->s_curr . number_format($total_volume, 2, '.', ','), 
                        'icon' => 'fa-solid fa-chart-line', 
                        'color' => 'bg-accent-500', 
                        'change' => 'All Time'
                    ],
                ];
            @endphp
            @foreach($statCards as $card)
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm dark:shadow-gray-900/25 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 {{ $card['color'] }} rounded-lg flex items-center justify-center">
                        <i class="{{ $card['icon'] }} text-white text-sm"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ $card['change'] }}</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $card['value'] }}</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs">{{ $card['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Desktop Main Content -->
    <div class="px-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Enhanced Desktop Balance Card -->
            <div class="bg-gradient-to-br from-primary-600 via-primary-500 to-primary-700 dark:from-primary-700 dark:via-primary-600 dark:to-primary-800 rounded-2xl p-6 text-white shadow-xl dark:shadow-2xl dark:shadow-primary-900/50 relative overflow-hidden z-10">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-6 right-6 w-32 h-32 bg-white rounded-full -translate-y-8 translate-x-8"></div>
                    <div class="absolute bottom-6 left-6 w-24 h-24 bg-white rounded-full translate-y-6 -translate-x-6"></div>
                    <div class="absolute top-1/2 left-1/2 w-20 h-20 bg-white rounded-full -translate-x-10 -translate-y-10"></div>
                </div>
                
                <div class="relative z-10">
                    <!-- Top Row: Bank Info and Account Number -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <div class="flex items-center space-x-2 mb-1">
                                <div class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fa-solid fa-university text-white text-xs"></i>
                                </div>
                                <p class="text-white/90 text-base font-semibold">{{ $settings->site_name }} Bank</p>
                            </div>
                            <p class="text-white/70 text-xs">Primary Account</p>
                        </div>
                        <div class="text-right bg-white/10 dark:bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2">
                            <p class="text-white/70 dark:text-white/80 text-xs uppercase tracking-wide mb-1">Account Number</p>
                            <p class="text-white font-mono text-sm">•••••• {{ $walletBalance->cardLastFour }}</p>
                        </div>
                    </div>

                    <!-- Middle Row: Account Holder and Balances -->
                    <div class="grid grid-cols-3 gap-6 mb-6">
                        <!-- Account Holder Info -->
                        <div>
                            <p class="text-white/70 text-xs mb-1">Account Holder</p>
                            <p class="text-white text-base font-semibold mb-3">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</p>
                            
                            <!-- Account Status -->
                            <div class="space-y-1">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                    <span class="text-white/80 text-xs">Account Active</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    @if(Auth::user()->account_verify == 'Verified')
                                        <i class="fa-solid fa-shield-check text-green-400 text-xs"></i>
                                        <span class="text-white/80 text-xs">Verified & Secured</span>
                                    @elseif(Auth::user()->account_verify == 'Under review')
                                        <i class="fa-solid fa-clock text-yellow-400 text-xs"></i>
                                        <span class="text-white/80 text-xs">Verification Pending</span>
                                    @elseif(Auth::user()->account_verify == 'Rejected')
                                        <i class="fa-solid fa-shield-xmark text-red-400 text-xs"></i>
                                        <span class="text-white/80 text-xs">Verification Rejected</span>
                                    @else
                                        <i class="fa-solid fa-shield-exclamation text-orange-400 text-xs"></i>
                                        <span class="text-white/80 text-xs">Verification Required</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Fiat Balance Display -->
                        <div class="text-center">
                            <p class="text-white/70 text-xs mb-1">Fiat Balance</p>
                            <div class="flex items-center justify-center space-x-2 mb-1">
                                <div class="text-center">
                                    <p class="text-2xl font-bold leading-none" x-show="balanceVisible" x-transition>
                                        {{ $walletBalance->currency }}{{ number_format($walletBalance->amount_raw, 2) }}
                                    </p>
                                    <p class="text-2xl font-bold leading-none" x-show="!balanceVisible" x-transition>
                                        {{ $walletBalance->currency }} ••••••
                                    </p>
                                </div>
                                <button @click="toggleBalance()" class="text-white/60 hover:text-white transition-colors p-1">
                                    <i x-show="balanceVisible" class="fa-solid fa-eye-slash text-sm"></i>
                                    <i x-show="!balanceVisible" class="fa-solid fa-eye text-sm"></i>
                                </button>
                            </div>
                            <p class="text-white/60 text-xs">{{ Auth::user()->curr }} Balance</p>
                        </div>

                        <!-- Crypto Balance Display -->
                        <div class="text-center">
                            <p class="text-white/70 text-xs mb-1">Bitcoin Balance</p>
                            <div class="mb-1">
                                <p class="text-lg font-bold leading-none" x-show="balanceVisible" x-transition>
                                    {{ number_format(Auth::user()->btc_balance ?? 0, 6) }} BTC
                                </p>
                                <p class="text-lg font-bold leading-none" x-show="!balanceVisible" x-transition>
                                    ••••••• BTC
                                </p>
                                <p class="text-white/60 text-xs mt-1" x-show="balanceVisible" x-transition>
                                    ≈ {{ $walletBalance->currency }}{{ number_format((Auth::user()->btc_balance ?? 0) * $btc_rate, 2) }}
                                </p>
                            </div>
                            <div class="flex items-center justify-center space-x-1">
                                <div class="w-1.5 h-1.5 bg-orange-400 rounded-full"></div>
                                <span class="text-white/60 text-xs">1 BTC = {{ $walletBalance->currency }}{{ number_format($btc_rate, 0) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Row: Action Buttons -->
                    <div class="flex justify-between items-center">
                        <!-- Left: Total Portfolio Value -->
                        <div class="bg-white/10 dark:bg-white/20 backdrop-blur-sm rounded-lg p-3">
                            <p class="text-white/60 dark:text-white/70 text-xs mb-1">Total Portfolio</p>
                            <p class="text-white text-lg font-bold" x-show="balanceVisible" x-transition>
                                {{ $walletBalance->currency }}{{ number_format($walletBalance->amount_raw + ((Auth::user()->btc_balance ?? 0) * $btc_rate), 2) }}
                            </p>
                            <p class="text-white text-lg font-bold" x-show="!balanceVisible" x-transition>
                                {{ $walletBalance->currency }} ••••••
                            </p>
                        </div>

                        <!-- Right: Action Buttons -->
                        <div class="flex space-x-3">
                            <button @click="showSendMoney = true" class="bg-white/20 dark:bg-white/30 backdrop-blur-sm px-6 py-3 rounded-lg text-white font-semibold hover:bg-white/30 dark:hover:bg-white/40 transition-all duration-200 flex items-center space-x-2">
                                <i class="fa-solid fa-paper-plane text-sm"></i>
                                <span class="text-sm">Send Money</span>
                            </button>
                            <button onclick="window.location.href='{{ route('deposits') }}'" class="bg-white dark:bg-gray-100 text-primary-600 dark:text-primary-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 dark:hover:bg-gray-200 transition-all duration-200 flex items-center space-x-2 shadow-lg dark:shadow-gray-900/25">
                                <i class="fa-solid fa-plus text-sm"></i>
                                <span class="text-sm">Add Money</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm dark:shadow-gray-900/25 border border-gray-100 dark:border-gray-700">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @php
                        $quickActions = [
                            ['label' => 'Transfer', 'icon' => 'fa-solid fa-exchange-alt', 'route' => route('localtransfer'), 'color' => 'bg-blue-500'],
                            ['label' => 'Pay Bills', 'icon' => 'fa-solid fa-file-invoice', 'route' => route('internationaltransfer'), 'color' => 'bg-green-500'],
                            ['label' => 'Request', 'icon' => 'fa-solid fa-hand-holding-dollar', 'action' => 'showReceiveModal = true', 'color' => 'bg-accent-500'],
                            ['label' => 'Bank Details', 'icon' => 'fa-solid fa-building-columns', 'action' => 'showBankAccount = true', 'color' => 'bg-primary-500'],
                        ];
                    @endphp
                    @foreach($quickActions as $action)
                        @if(isset($action['route']))
                        <a href="{{ $action['route'] }}" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-10 h-10 {{ $action['color'] }} rounded-lg flex items-center justify-center mb-2">
                                <i class="{{ $action['icon'] }} text-white text-sm"></i>
                            </div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ $action['label'] }}</span>
                        </a>
                        @else
                        <button @click="{{ $action['action'] }}" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-10 h-10 {{ $action['color'] }} rounded-lg flex items-center justify-center mb-2">
                                <i class="{{ $action['icon'] }} text-white text-sm"></i>
                            </div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ $action['label'] }}</span>
                        </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Quick Transfer Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm dark:shadow-gray-900/25 border border-gray-100 dark:border-gray-700" x-data="dashboardQuickTransfer()" x-init="loadBeneficiaries()">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Quick Transfer</h3>
                    <a href="{{ route('beneficiaries.index') }}" class="text-xs text-primary-600 dark:text-primary-400 font-medium flex items-center hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                        View All
                        <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
                
                <div class="flex space-x-3 overflow-x-auto pb-2" x-show="!loading">
                    <!-- Add New Beneficiary -->
                    <a href="{{ route('localtransfer') }}" class="flex-shrink-0 flex flex-col items-center justify-center group">
                        <div class="w-16 h-16 rounded-full border-2 border-dashed border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 flex items-center justify-center mb-2 group-hover:bg-gray-100 dark:group-hover:bg-gray-700 group-hover:border-primary-400 dark:group-hover:border-primary-500 transition-all duration-200">
                            <i class="fa-solid fa-plus text-gray-400 dark:text-gray-500 text-lg group-hover:text-primary-500 dark:group-hover:text-primary-400 transition-colors"></i>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 text-center group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Add New</span>
                    </a>

                    <!-- Beneficiaries List -->
                    <template x-for="beneficiary in beneficiaries.slice(0, 8)" :key="beneficiary.id">
                        <div class="flex-shrink-0 flex flex-col items-center justify-center group relative">
                            <button 
                                @click="selectBeneficiary(beneficiary)"
                                class="relative w-16 h-16 rounded-full flex items-center justify-center mb-2 border-2 border-white dark:border-gray-800 shadow-sm dark:shadow-gray-900/25 hover:scale-105 transition-all duration-200"
                                :class="beneficiary.color"
                            >
                                <span class="text-white font-semibold text-base" x-text="beneficiary.initials"></span>
                                
                                <!-- Favorite Star -->
                                <div 
                                    x-show="beneficiary.is_favorite" 
                                    class="absolute -top-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center"
                                >
                                    <i class="fa-solid fa-star text-white text-xs"></i>
                                </div>
                            </button>
                            
                            <span class="text-xs text-gray-700 dark:text-gray-300 text-center max-w-16 truncate" x-text="beneficiary.name"></span>
                        </div>
                    </template>

                    <!-- Loading State -->
                    <template x-if="loading">
                        <div class="flex space-x-3">
                            <template x-for="i in 6">
                                <div class="flex-shrink-0 flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-gray-200 dark:bg-gray-700 animate-pulse mb-2"></div>
                                    <div class="w-12 h-2 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Empty State -->
                    <template x-if="!loading && beneficiaries.length === 0">
                        <div class="flex-shrink-0 flex flex-col items-center justify-center py-6 px-8">
                            <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-3">
                                <i class="fa-solid fa-users text-gray-400 dark:text-gray-500 text-xl"></i>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 text-center">No saved beneficiaries</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 text-center mt-1">Add one to get started</p>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Desktop Cards Section -->
            @include('partials._dashboard_cards_section', ['cards' => $cards, 'settings' => $settings])
        </div>

        <!-- Right Column is in separate partial -->
