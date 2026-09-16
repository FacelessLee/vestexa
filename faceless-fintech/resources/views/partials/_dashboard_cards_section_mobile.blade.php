{{--
    Expects:
    - $cards: Collection of card objects
    - $settings: Site settings object
--}}
@php
    $activeCards = $cards->where('status', 'active');
@endphp

<section class="lg:hidden">
    <!-- Header -->
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-semibold text-base text-gray-900 dark:text-white">Your Active Cards</h3>
        @if(count($activeCards) > 0)
        <a href="{{ route('cards') }}" class="text-xs text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 flex items-center transition-colors">
            Manage <i class="fa-solid fa-chevron-right text-xs ml-1"></i>
        </a>
        @endif
    </div>

    @if(count($activeCards) > 0)
        @if(count($activeCards) > 1)
            <!-- Swipeable Cards Container -->
            <div x-data="{ 
                currentCard: 0, 
                totalCards: {{ count($activeCards) }},
                startX: 0,
                currentX: 0,
                isDragging: false,
                handleTouchStart(e) {
                    this.startX = e.touches[0].clientX;
                    this.isDragging = true;
                },
                handleTouchMove(e) {
                    if (!this.isDragging) return;
                    this.currentX = e.touches[0].clientX;
                },
                handleTouchEnd() {
                    if (!this.isDragging) return;
                    const diffX = this.startX - this.currentX;
                    const threshold = 50;
                    
                    if (Math.abs(diffX) > threshold) {
                        if (diffX > 0 && this.currentCard < this.totalCards - 1) {
                            this.currentCard++;
                        } else if (diffX < 0 && this.currentCard > 0) {
                            this.currentCard--;
                        }
                    }
                    
                    this.isDragging = false;
                    this.startX = 0;
                    this.currentX = 0;
                }
            }">
                <!-- Cards Container -->
                <div class="relative overflow-hidden rounded-2xl">
                    <div class="flex transition-transform duration-300 ease-in-out" 
                         :style="`transform: translateX(-${currentCard * 100}%)`"
                         @touchstart="handleTouchStart($event)"
                         @touchmove="handleTouchMove($event)"
                         @touchend="handleTouchEnd()"
                         @mousedown="handleTouchStart({touches: [{clientX: $event.clientX}]})"
                         @mousemove="isDragging && handleTouchMove({touches: [{clientX: $event.clientX}]})"
                         @mouseup="handleTouchEnd()"
                         @mouseleave="handleTouchEnd()"
                         class="cursor-grab active:cursor-grabbing">
                        
                        @foreach($activeCards as $card)
                        <div class="w-full flex-shrink-0">
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden mx-1">
                                <!-- Card Visual -->
                                <div class="p-3">
                                    <div class="w-full h-36 rounded-xl relative overflow-hidden shadow-md">
                                        @if($card->card_type == 'visa')
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-400"></div>
                                        @elseif($card->card_type == 'mastercard')
                                            <div class="absolute inset-0 bg-gradient-to-br from-red-600 via-orange-500 to-yellow-400"></div>
                                        @else
                                            <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-500 to-primary-700"></div>
                                        @endif
                                        
                                        <!-- Card Content -->
                                        <div class="absolute inset-0 text-white flex flex-col justify-between p-3">
                                            <!-- Top Section -->
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <div class="font-semibold text-sm tracking-wide">{{ $settings->site_name }}</div>
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
                                            <div class="font-mono text-sm tracking-wider">
                                                •••• •••• •••• {{ $card->last_four ?? '****' }}
                                            </div>
                                            
                                            <!-- Bottom Section -->
                                            <div class="flex justify-between items-end text-xs">
                                                <div class="flex-1 min-w-0">
                                                    <div class="opacity-70 mb-0.5">Card Holder</div>
                                                    <div class="font-medium truncate">{{ $card->card_holder_name }}</div>
                                                </div>
                                                <div class="text-right ml-2">
                                                    <div class="opacity-70 mb-0.5">Valid</div>
                                                    <div class="font-medium">{{ $card->expiry_month }}/{{ substr($card->expiry_year, -2) }}</div>
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
                                    <a href="{{ route('cards.view', $card) }}" class="block w-full text-center px-3 py-2 bg-primary-100 dark:bg-primary-900/50 hover:bg-primary-200 dark:hover:bg-primary-800/50 rounded-xl text-xs font-medium text-primary-700 dark:text-primary-300 transition-colors duration-200">
                                        Manage Card
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Swipe Indicators -->
                <div class="flex justify-center mt-3 space-x-2">
                    @foreach($activeCards as $index => $card)
                    <button @click="currentCard = {{ $loop->index }}" 
                            class="w-2 h-2 rounded-full transition-all duration-200"
                            :class="currentCard === {{ $loop->index }} ? 'bg-primary-500 w-6' : 'bg-gray-300 dark:bg-gray-600'">
                    </button>
                    @endforeach
                </div>
                
                <!-- Card Counter -->
                <div class="text-center mt-2">
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        <span x-text="currentCard + 1"></span> of {{ count($activeCards) }} cards
                    </span>
                </div>
            </div>
        @else
            <!-- Single Card Display -->
            <div class="space-y-3">
                @foreach($activeCards->take(1) as $card)
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
                    <!-- Card Visual -->
                    <div class="p-3">
                        <div class="w-full h-36 rounded-xl relative overflow-hidden shadow-md">
                            @if($card->card_type == 'visa')
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-400"></div>
                            @elseif($card->card_type == 'mastercard')
                                <div class="absolute inset-0 bg-gradient-to-br from-red-600 via-orange-500 to-yellow-400"></div>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-500 to-primary-700"></div>
                            @endif
                            
                            <!-- Card Content -->
                            <div class="absolute inset-0 text-white flex flex-col justify-between p-3">
                                <!-- Top Section -->
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-semibold text-sm tracking-wide">{{ $settings->site_name }}</div>
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
                                <div class="font-mono text-sm tracking-wider">
                                    •••• •••• •••• {{ $card->last_four ?? '****' }}
                                </div>
                                
                                <!-- Bottom Section -->
                                <div class="flex justify-between items-end text-xs">
                                    <div class="flex-1 min-w-0">
                                        <div class="opacity-70 mb-0.5">Card Holder</div>
                                        <div class="font-medium truncate">{{ $card->card_holder_name }}</div>
                                    </div>
                                    <div class="text-right ml-2">
                                        <div class="opacity-70 mb-0.5">Valid</div>
                                        <div class="font-medium">{{ $card->expiry_month }}/{{ substr($card->expiry_year, -2) }}</div>
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
                        <a href="{{ route('cards.view', $card) }}" class="block w-full text-center px-3 py-2 bg-primary-100 dark:bg-primary-900/50 hover:bg-primary-200 dark:hover:bg-primary-800/50 rounded-xl text-xs font-medium text-primary-700 dark:text-primary-300 transition-colors duration-200">
                            Manage Card
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="py-8 text-center bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50">
            <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/50 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-credit-card text-primary-500 dark:text-primary-400 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-primary-900 dark:text-primary-100 mb-1">No active cards</h3>
            <p class="text-xs text-primary-700 dark:text-primary-300 mb-4 max-w-xs mx-auto">Apply for a virtual card to get started with secure online payments.</p>
            <a href="{{ route('cards.apply') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white text-xs font-medium rounded-xl shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50 transition-all duration-200 transform hover:scale-105">
                <i class="fa-solid fa-plus text-xs mr-2"></i>
                Apply for Card
            </a>
        </div>
    @endif
</section>