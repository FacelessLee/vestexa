{{--
    Expects:
    - $limit: User's transaction limit
    - $pending_deposits: Total pending deposits
    - $pending_withdrawals: Total pending withdrawals
    - $total_volume: Total transaction volume
    - $currency_symbol: User's currency symbol
--}}
<div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 overflow-hidden border border-white/20 dark:border-gray-700/50">
    <!-- Header -->
    <div class="px-4 py-2 bg-gradient-to-r from-slate-50/80 to-slate-100/50 dark:from-slate-800/50 dark:to-slate-700/50 border-b border-slate-100/50 dark:border-slate-600/70">
        <div class="flex items-center">
            <div class="w-6 h-6 bg-slate-500 dark:bg-slate-600 rounded-lg flex items-center justify-center mr-2">
                <i class="fa-solid fa-chart-line text-white text-xs"></i>
            </div>
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-50">Account Statistics</h3>
        </div>
    </div>
    
    <!-- Stats Content -->
    <div class="p-3 space-y-2">
        @php
            $accountStats = [
                [
                    'label' => 'Transaction Limit', 
                    'value' => $currency_symbol . number_format($limit, 2, '.', ','), 
                    'icon' => 'fa-solid fa-gauge-high', 
                    'color' => 'primary',
                    'bg' => 'from-primary-500 to-primary-600',
                    'description' => 'Daily limit available'
                ],
                [
                    'label' => 'Pending Transactions', 
                    'value' => $currency_symbol . number_format($pending_deposits + $pending_withdrawals, 2, '.', ','), 
                    'icon' => 'fa-solid fa-hourglass-half', 
                    'color' => 'yellow',
                    'bg' => 'from-yellow-400 to-yellow-500',
                    'description' => 'Awaiting processing'
                ],
                [
                    'label' => 'Total Volume', 
                    'value' => $currency_symbol . number_format($total_volume, 2, '.', ','), 
                    'icon' => 'fa-solid fa-chart-pie', 
                    'color' => 'green',
                    'bg' => 'from-green-500 to-green-600',
                    'description' => 'All-time transactions'
                ],
            ];
        @endphp
        
        @foreach($accountStats as $stat)
        <div class="group p-2 bg-gradient-to-br from-gray-50/50 to-white/50 dark:from-gray-700/50 dark:to-gray-800/50 hover:from-{{ $stat['color'] }}-50/50 hover:to-{{ $stat['color'] }}-100/30 dark:hover:from-{{ $stat['color'] }}-900/30 dark:hover:to-{{ $stat['color'] }}-800/30 rounded-xl border border-gray-100/50 dark:border-gray-600/50 hover:border-{{ $stat['color'] }}-200/50 dark:hover:border-{{ $stat['color'] }}-700/50 transition-all duration-300 hover:shadow-md hover:shadow-{{ $stat['color'] }}-500/10 dark:hover:shadow-{{ $stat['color'] }}-900/20">
            <div class="flex items-center">
                <!-- Icon -->
                <div class="relative">
                    <div class="w-8 h-8 bg-gradient-to-br {{ $stat['bg'] }} rounded-lg flex items-center justify-center shadow-md shadow-{{ $stat['color'] }}-500/25 dark:shadow-{{ $stat['color'] }}-900/50 group-hover:scale-110 transition-transform duration-300">
                        <i class="{{ $stat['icon'] }} text-white text-xs"></i>
                    </div>
                    <div class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-white dark:bg-gray-800 rounded-full border border-{{ $stat['color'] }}-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                
                <!-- Content -->
                <div class="flex-1 min-w-0 ml-3">
                    <div class="flex items-center justify-between mb-0.5">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $stat['label'] }}</p>
                        <div class="w-1.5 h-1.5 bg-{{ $stat['color'] }}-500 rounded-full opacity-60 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <p class="text-sm font-bold text-gray-900 dark:text-white truncate group-hover:text-{{ $stat['color'] }}-700 dark:group-hover:text-{{ $stat['color'] }}-300 transition-colors duration-300">{{ $stat['value'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-{{ $stat['color'] }}-600 dark:group-hover:text-{{ $stat['color'] }}-400 transition-colors duration-300">{{ $stat['description'] }}</p>
                </div>
            </div>
            
            <!-- Progress indicator -->
            <div class="mt-2 h-0.5 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r {{ $stat['bg'] }} rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Footer -->
    <div class="px-3 py-2 bg-gradient-to-r from-gray-50/50 to-white/50 dark:from-gray-700/50 dark:to-gray-800/50 border-t border-gray-100/50 dark:border-gray-600/50">
        <div class="flex items-center justify-center text-xs text-gray-500 dark:text-gray-400">
            <i class="fa-solid fa-clock mr-1 text-primary-500 text-xs"></i>
            <span>Updated in real-time</span>
        </div>
    </div>
</div>
 