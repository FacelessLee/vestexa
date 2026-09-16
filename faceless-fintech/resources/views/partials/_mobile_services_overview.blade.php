{{--
    Mobile Services Overview Partial
    Shows available services with status and quick actions
    Expects: $user (Auth::user())
--}}

@php
    // Get user's latest applications/requests
    $latestLoan = Auth::user()->user_plans()->latest()->first();
    $latestGrant = Auth::user()->grantApplications()->latest()->first();
    $latestTaxRefund = Auth::user()->irsRefunds()->latest()->first();
    $userCards = Auth::user()->cards()->where('status', 'active')->latest()->first();
    
    $services = [
        [
            'name' => 'Loans',
            'icon' => 'fa-solid fa-landmark',
            'color' => 'from-blue-500 to-blue-600',
            'bg_color' => 'bg-blue-100 dark:bg-blue-900/30',
            'text_color' => 'text-blue-600 dark:text-blue-400',
            'route' => route('loan'),
            'status' => $latestLoan ? ucfirst($latestLoan->active) : 'Available',
            'status_color' => $latestLoan ? ($latestLoan->active == 'Pending' ? 'text-yellow-600' : ($latestLoan->active == 'Active' ? 'text-green-600' : 'text-gray-600')) : 'text-gray-500',
            'description' => $latestLoan ? 'Amount: ' . Auth::user()->s_curr . number_format($latestLoan->amount ?? 0, 2) : 'Quick approval process',
            'action' => $latestLoan ? 'View Details' : 'Apply Now'
        ],
        [
            'name' => 'Grants',
            'icon' => 'fa-solid fa-hand-holding-dollar',
            'color' => 'from-green-500 to-emerald-600',
            'bg_color' => 'bg-green-100 dark:bg-green-900/30',
            'text_color' => 'text-green-600 dark:text-green-400',
            'route' => route('grant.index'),
            'status' => $latestGrant ? ucfirst($latestGrant->status) : 'Available',
            'status_color' => $latestGrant ? ($latestGrant->status == 'processing' ? 'text-yellow-600' : ($latestGrant->status == 'approved' ? 'text-green-600' : ($latestGrant->status == 'disbursed' ? 'text-blue-600' : 'text-red-600'))) : 'text-gray-500',
            'description' => $latestGrant ? 'Amount: ' . Auth::user()->s_curr . number_format($latestGrant->requested_amount ?? 0, 2) : 'No repayment required',
            'action' => $latestGrant ? 'View Status' : 'Apply Now'
        ],
        [
            'name' => 'Tax Refunds',
            'icon' => 'fa-solid fa-receipt',
            'color' => 'from-purple-500 to-purple-600',
            'bg_color' => 'bg-purple-100 dark:bg-purple-900/30',
            'text_color' => 'text-purple-600 dark:text-purple-400',
            'route' => route('irs-refund'),
            'status' => $latestTaxRefund ? ucfirst($latestTaxRefund->status) : 'Available',
            'status_color' => $latestTaxRefund ? ($latestTaxRefund->status == 'pending' ? 'text-yellow-600' : ($latestTaxRefund->status == 'approved' ? 'text-green-600' : 'text-red-600')) : 'text-gray-500',
            'description' => $latestTaxRefund ? 'Filing ID: ' . ($latestTaxRefund->filing_id ? 'Submitted' : 'Required') : 'Fast processing',
            'action' => $latestTaxRefund ? 'Track Status' : 'Apply Now'
        ],
        [
            'name' => 'Virtual Cards',
            'icon' => 'fa-solid fa-credit-card',
            'color' => 'from-orange-500 to-red-600',
            'bg_color' => 'bg-orange-100 dark:bg-orange-900/30',
            'text_color' => 'text-orange-600 dark:text-orange-400',
            'route' => route('cards'),
            'status' => $userCards ? ucfirst($userCards->status) : 'Available',
            'status_color' => $userCards ? ($userCards->status == 'active' ? 'text-green-600' : ($userCards->status == 'pending' ? 'text-yellow-600' : 'text-gray-600')) : 'text-gray-500',
            'description' => $userCards ? 'Card ending in •••• ' . ($userCards->last_four ?? ($userCards->card_number ? substr($userCards->card_number, -4) : '****')) : 'Instant virtual cards',
            'action' => $userCards ? 'Manage Cards' : 'Apply Now'
        ]
    ];
@endphp

<div class="px-4 mb-4">
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Financial Services</h3>
        <button class="text-xs text-primary-600 dark:text-primary-400 font-medium flex items-center hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            View All
            <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
        </button>
    </div>
    
    <div class="grid grid-cols-2 gap-3">
        @foreach($services as $service)
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="p-4">
                <!-- Service Header -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl {{ $service['bg_color'] }} flex items-center justify-center">
                            <i class="{{ $service['icon'] }} {{ $service['text_color'] }} text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $service['name'] }}</h4>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $service['status_color'] }} bg-gray-100 dark:bg-gray-700">
                                <div class="w-1.5 h-1.5 rounded-full {{ str_replace('text-', 'bg-', $service['status_color']) }} mr-1"></div>
                                {{ $service['status'] }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Service Description -->
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">{{ $service['description'] }}</p>
                
                <!-- Action Button -->
                <a href="{{ $service['route'] }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r {{ $service['color'] }} text-white text-xs font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105">
                    <i class="{{ $service['icon'] }} text-xs mr-2"></i>
                    {{ $service['action'] }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div> 