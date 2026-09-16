{{--
    Mobile Financial Insights Partial
    Shows spending patterns, account health, and financial tips
    Expects: $user, $recentTransactions, $monthly_deposits, $monthly_expenses
--}}

@php
    $user = Auth::user();
    $accountHealth = 'excellent'; // Default
    $healthColor = 'text-green-600';
    $healthBg = 'bg-green-100 dark:bg-green-900/30';
    $healthIcon = 'fa-solid fa-heart';
    
    // Calculate account health based on balance and activity
    $balanceRatio = $user->account_bal / max($user->limit, 1);
    if ($balanceRatio < 0.1) {
        $accountHealth = 'needs attention';
        $healthColor = 'text-red-600';
        $healthBg = 'bg-red-100 dark:bg-red-900/30';
        $healthIcon = 'fa-solid fa-exclamation-triangle';
    } elseif ($balanceRatio < 0.3) {
        $accountHealth = 'fair';
        $healthColor = 'text-yellow-600';
        $healthBg = 'bg-yellow-100 dark:bg-yellow-900/30';
        $healthIcon = 'fa-solid fa-heart-pulse';
    }
    
    // Financial tips based on user activity
    $tips = [
        [
            'icon' => 'fa-solid fa-piggy-bank',
            'title' => 'Save Regularly',
            'description' => 'Set up automatic transfers to build your emergency fund',
            'color' => 'text-blue-600'
        ],
        [
            'icon' => 'fa-solid fa-chart-line',
            'title' => 'Track Spending',
            'description' => 'Monitor your expenses to identify saving opportunities',
            'color' => 'text-green-600'
        ],
        [
            'icon' => 'fa-solid fa-shield-alt',
            'title' => 'Stay Secure',
            'description' => 'Enable two-factor authentication for better security',
            'color' => 'text-purple-600'
        ]
    ];
    
    $randomTip = $tips[array_rand($tips)];
@endphp

<div class="px-4 mb-4">
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Financial Insights</h3>
        <button class="text-xs text-primary-600 dark:text-primary-400 font-medium flex items-center hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            View Report
            <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
        </button>
    </div>
    
    <div class="space-y-3">
        <!-- Account Health Card -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl {{ $healthBg }} flex items-center justify-center">
                            <i class="{{ $healthIcon }} {{ $healthColor }} text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Account Health</h4>
                            <p class="text-xs {{ $healthColor }} font-medium capitalize">{{ $accountHealth }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Balance Ratio</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($balanceRatio * 100, 1) }}%</p>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                    <div class="h-2 rounded-full transition-all duration-300 {{ str_replace('text-', 'bg-', $healthColor) }}" style="width: {{ min($balanceRatio * 100, 100) }}%"></div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->s_curr }}{{ number_format($user->account_bal, 2) }} of {{ $user->s_curr }}{{ number_format($user->limit, 2) }} limit</p>
            </div>
        </div>
        
        <!-- Monthly Summary -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="p-4">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">This Month</h4>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Income -->
                    <div class="text-center">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <i class="fa-solid fa-arrow-down text-green-600 dark:text-green-400 text-xs"></i>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Income</p>
                        <p class="text-sm font-semibold text-green-600 dark:text-green-400">{{ $user->s_curr }}{{ number_format($monthly_deposits ?? 0, 2) }}</p>
                    </div>
                    
                    <!-- Expenses -->
                    <div class="text-center">
                        <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <i class="fa-solid fa-arrow-up text-red-600 dark:text-red-400 text-xs"></i>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Expenses</p>
                        <p class="text-sm font-semibold text-red-600 dark:text-red-400">{{ $user->s_curr }}{{ number_format($monthly_expenses ?? 0, 2) }}</p>
                    </div>
                </div>
                
                @php
                    $netAmount = ($monthly_deposits ?? 0) - ($monthly_expenses ?? 0);
                    $netColor = $netAmount >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400';
                    $netIcon = $netAmount >= 0 ? 'fa-solid fa-trending-up' : 'fa-solid fa-trending-down';
                @endphp
                
                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-center space-x-2">
                        <i class="{{ $netIcon }} {{ $netColor }} text-xs"></i>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Net:</span>
                        <span class="text-sm font-semibold {{ $netColor }}">{{ $netAmount >= 0 ? '+' : '' }}{{ $user->s_curr }}{{ number_format($netAmount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Financial Tip -->
        <div class="bg-gradient-to-r from-primary-50 to-blue-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-primary-100 dark:border-gray-600 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-white dark:bg-gray-800 rounded-xl flex items-center justify-center shadow-sm">
                        <i class="{{ $randomTip['icon'] }} {{ $randomTip['color'] }} text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $randomTip['title'] }}</h4>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-primary-100 dark:bg-primary-900/50 text-primary-700 dark:text-primary-300">
                                <i class="fa-solid fa-lightbulb text-xs mr-1"></i>
                                Tip
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300">{{ $randomTip['description'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 