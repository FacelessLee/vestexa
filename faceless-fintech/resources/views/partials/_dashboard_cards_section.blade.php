{{--
    Expects:
    - $cards: Collection of card objects
    - $settings: Site settings object (for site_name)
--}}
@php
    $activeCards = $cards->where('status', 'active');
@endphp

<div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 overflow-hidden border border-white/20 dark:border-gray-700/50">
    <!-- Header -->
    <div class="px-4 py-2 bg-gradient-to-r from-primary-50/80 to-primary-100/50 dark:from-gray-900/80 dark:to-gray-800/50 border-b border-primary-100/50 dark:border-gray-700/50">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-6 h-6 bg-primary-500 rounded-lg flex items-center justify-center mr-2">
                    <i class="fa-solid fa-credit-card text-white text-xs"></i>
                </div>
                <h3 class="text-sm font-bold text-primary-900 dark:text-primary-100">Your Active Cards</h3>
            </div>
            @if(count($activeCards) > 0)
            <a href="{{ route('cards') }}" class="text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 flex items-center transition-colors">
                Manage Cards <i class="fa-solid fa-chevron-right text-xs ml-1"></i>
            </a>
            @endif
        </div>
    </div>
    
    <!-- Content -->
    <div class="p-3">
        @if(count($activeCards) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                @foreach($activeCards->take(2) as $card)
                    <div class="group bg-gradient-to-br from-primary-50/50 to-primary-100/30 dark:from-gray-900/50 dark:to-gray-800/30 rounded-xl border border-primary-100/50 dark:border-gray-700/50 hover:border-primary-200 dark:hover:border-gray-600 transition-all duration-300 hover:shadow-lg hover:shadow-primary-500/20 dark:hover:shadow-gray-900/30 overflow-hidden">
                        <!-- Card Visual -->
                        <div class="p-3">
                            <div class="w-full h-32 rounded-xl relative overflow-hidden shadow-sm group-hover:shadow-md transition-all duration-300 transform group-hover:scale-[1.02]">
                                @if($card->card_type == 'visa')
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-400"></div>
                                @elseif($card->card_type == 'mastercard')
                                    <div class="absolute inset-0 bg-gradient-to-br from-red-600 via-orange-500 to-yellow-400"></div>
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-500 to-primary-700"></div>
                                @endif
                                
                                <!-- Card Content -->
                                <div class="absolute inset-0 p-3 flex flex-col justify-between text-white">
                                    <!-- Top Section -->
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="font-semibold text-xs tracking-wide">{{ $settings->site_name }}</div>
                                            <div class="text-xs opacity-70">Virtual Banking</div>
                                        </div>
                                        <div>
                                            @if($card->card_type == 'visa')
                                                <i class="fa-brands fa-cc-visa text-lg"></i>
                                            @elseif($card->card_type == 'mastercard')
                                                <i class="fa-brands fa-cc-mastercard text-lg"></i>
                                            @else
                                                <i class="fa-solid fa-credit-card text-sm opacity-80"></i>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Card Number -->
                                    <div class="font-mono text-sm tracking-widest">
                                        •••• •••• •••• {{ $card->last_four ?? '****' }}
                                    </div>
                                    
                                    <!-- Bottom Section -->
                                    <div class="flex justify-between items-end">
                                        <div class="flex-1 min-w-0">
                                            <div class="text-xs opacity-70 mb-0.5">Card Holder</div>
                                            <div class="font-medium text-xs truncate">{{ $card->card_holder_name }}</div>
                                        </div>
                                        <div class="text-right ml-2">
                                            <div class="text-xs opacity-70 mb-0.5">Valid</div>
                                            <div class="font-medium text-xs">{{ $card->expiry_month }}/{{ substr($card->expiry_year, -2) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Info -->
                        <div class="px-3 pb-3">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center space-x-2">
                                    <div class="text-xs text-primary-700 dark:text-primary-300 font-medium">{{ ucfirst(str_replace('_', ' ', $card->card_type)) }} Card</div>
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                        <div class="w-1 h-1 bg-green-500 rounded-full mr-1"></div>
                                        Active
                                    </span>
                                </div>
                                <div class="text-xs font-semibold text-primary-900 dark:text-primary-100">{{ $card->currency }} {{ number_format($card->balance, 2) }}</div>
                            </div>
                            <a href="{{ route('cards.view', $card) }}" class="block w-full text-center px-3 py-1.5 bg-primary-100 dark:bg-gray-700/50 hover:bg-primary-200 dark:hover:bg-gray-600/50 rounded-lg text-xs font-medium text-primary-700 dark:text-primary-300 transition-colors duration-200">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if(count($activeCards) > 2)
                <div class="mt-3 text-center">
                    <a href="{{ route('cards') }}" class="inline-flex items-center justify-center px-3 py-1.5 bg-primary-100 dark:bg-gray-700/50 hover:bg-primary-200 dark:hover:bg-gray-600/50 rounded-lg text-xs font-medium text-primary-700 dark:text-primary-300 transition-colors duration-200">
                        View all {{ count($activeCards) }} active cards
                    </a>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="py-6 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 bg-primary-100 dark:bg-gray-700/50 rounded-full flex items-center justify-center mb-3">
                    <i class="fa-solid fa-credit-card text-primary-500 dark:text-primary-400 text-lg"></i>
                </div>
                <h3 class="text-sm font-semibold text-primary-900 dark:text-primary-100 mb-1">No active cards</h3>
                <p class="text-xs text-primary-700 dark:text-primary-300 mb-3 max-w-xs">
                    Apply for a virtual card to get started with secure online payments.
                </p>
                <a href="{{ route('cards.apply') }}" class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white text-xs font-medium rounded-lg shadow-sm transition-all duration-200 transform hover:scale-105">
                    <i class="fa-solid fa-plus text-xs mr-1.5"></i>
                    Apply for Card
                </a>
            </div>
        @endif
    </div>
</div>