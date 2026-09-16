@extends('layouts.dash2')
@section('title', 'Card Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="max-w-8xl mx-auto p-4 lg:p-6 space-y-6">
        
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Card Details',
                'showBackButton' => true,
                'backUrl' => route('cards'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:block mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                        <i class="fas fa-credit-card text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Card Details</h1>
                        <p class="text-gray-600 dark:text-gray-400">Manage your {{ ucfirst(str_replace('_', ' ', $card->card_type)) }} {{ ucfirst($card->card_level) }} virtual card</p>
                    </div>
                </div>
                <a href="{{ route('cards') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Cards
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('message'))
            <div class="rounded-xl {{ session('type') == 'success' ? 'bg-green-50/80 dark:bg-green-900/20 text-green-800 dark:text-green-300 border border-green-200/50 dark:border-green-700/50' : 'bg-red-50/80 dark:bg-red-900/20 text-red-800 dark:text-red-300 border border-red-200/50 dark:border-red-700/50' }} p-4 backdrop-blur-sm mb-2">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        @if(session('type') == 'success')
                            <i class="fas fa-check-circle text-green-500 dark:text-green-400"></i>
                        @else
                            <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400"></i>
                        @endif
                    </div>
                    <p class="text-sm font-medium">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        <!-- Card Status and Actions -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-4">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div class="flex items-center space-x-3">
                    @if($card->status == 'active')
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                            <i class="fas fa-check-circle mr-1.5"></i> Active
                        </span>
                    @elseif($card->status == 'pending')
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                            <i class="fas fa-clock mr-1.5"></i> Pending
                        </span>
                    @elseif($card->status == 'inactive')
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                            <i class="fas fa-pause mr-1.5"></i> Inactive
                        </span>
                    @elseif($card->status == 'blocked')
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                            <i class="fas fa-lock mr-1.5"></i> Blocked
                        </span>
                    @elseif($card->status == 'rejected')
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                            <i class="fas fa-times-circle mr-1.5"></i> Rejected
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                            {{ ucfirst($card->status) }}
                        </span>
                    @endif
                </div>
                
                <!-- Card action buttons -->
                <div class="flex flex-wrap gap-2">
                    @if($card->status == 'active')
                        <form action="{{ route('cards.deactivate', $card) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-yellow-300 dark:border-yellow-600 shadow-sm text-sm leading-4 font-semibold rounded-lg text-yellow-700 dark:text-yellow-300 bg-yellow-50 dark:bg-yellow-900/20 hover:bg-yellow-100 dark:hover:bg-yellow-900/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                <i class="fas fa-pause mr-1.5"></i> Deactivate
                            </button>
                        </form>
                    @elseif($card->status == 'inactive')
                        <form action="{{ route('cards.activate', $card) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-green-300 dark:border-green-600 shadow-sm text-sm leading-4 font-semibold rounded-lg text-green-700 dark:text-green-300 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <i class="fas fa-play mr-1.5"></i> Activate
                            </button>
                        </form>
                    @endif
                    
                    @if(in_array($card->status, ['active', 'inactive']))
                        <form action="{{ route('cards.block', $card) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to block this card? This action may be irreversible.')">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-red-300 dark:border-red-600 shadow-sm text-sm leading-4 font-semibold rounded-lg text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <i class="fas fa-lock mr-1.5"></i> Block Card
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('cards.transactions', $card) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-semibold rounded-lg text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        <i class="fas fa-list mr-1.5"></i> Transactions
                    </a>
                </div>
            </div>
        </div>

        <!-- 3D Card Display -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-6">
            <div class="flex items-center space-x-2 mb-4">
                <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                    <i class="fas fa-credit-card text-white text-xs"></i>
                </div>
                <h2 class="text-base font-semibold text-gray-900 dark:text-white">Virtual Card</h2>
            </div>
            
            <div class="w-full max-w-md mx-auto mb-6">
                <div class="credit-card-container perspective-1000">
                    <div class="credit-card transform-style-preserve-3d transition-transform duration-700" id="creditCard">
                        <!-- Front of the card -->
                        <div class="credit-card-front absolute inset-0 flex flex-col justify-between p-6 backface-hidden rounded-xl">
                            @if($card->card_type == 'visa')
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-800 via-blue-600 to-blue-500 rounded-xl"></div>
                            @elseif($card->card_type == 'mastercard')
                                <div class="absolute inset-0 bg-gradient-to-br from-red-700 via-orange-600 to-orange-500 rounded-xl"></div>
                            @elseif($card->card_type == 'american_express')
                                <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-600 rounded-xl"></div>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-600 rounded-xl"></div>
                            @endif
                            
                            <!-- Card decorative elements -->
                            <div class="absolute inset-0 overflow-hidden rounded-xl">
                                <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-20 translate-x-20"></div>
                                <div class="absolute bottom-0 left-0 w-60 h-60 bg-white/5 rounded-full translate-y-20 -translate-x-20"></div>
                                <div class="absolute inset-0 backdrop-blur-sm bg-gradient-to-b from-transparent to-black/20"></div>
                            </div>
                            
                            <!-- Bank Logo -->
                            <div class="relative flex justify-between items-start">
                                <div>
                                    <div class="text-white font-semibold text-lg tracking-wider">{{ $settings->site_name ?? 'Bank' }}</div>
                                    <div class="text-white/70 text-xs">Virtual Banking</div>
                                </div>
                                
                                <!-- Card Type Logo -->
                                <div>
                                    @if($card->card_type == 'visa')
                                        <div class="text-white font-bold text-xl">VISA</div>
                                    @elseif($card->card_type == 'mastercard')
                                        <div class="text-white font-bold text-xl">MasterCard</div>
                                    @elseif($card->card_type == 'american_express')
                                        <div class="text-white font-bold text-xl">AMEX</div>
                                    @else
                                        <i class="fas fa-credit-card text-white text-2xl"></i>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Smart Chip -->
                            <div class="relative mt-2">
                                <div class="w-12 h-10 rounded-md bg-gradient-to-br from-yellow-500 to-yellow-400 flex items-center justify-center overflow-hidden shadow-inner">
                                    <div class="w-full h-full grid grid-cols-2 grid-rows-3 gap-px p-1">
                                        <div class="bg-yellow-600/60 rounded-sm"></div>
                                        <div class="bg-yellow-600/60 rounded-sm"></div>
                                        <div class="bg-yellow-600/60 rounded-sm"></div>
                                        <div class="bg-yellow-600/60 rounded-sm"></div>
                                        <div class="bg-yellow-600/60 rounded-sm"></div>
                                        <div class="bg-yellow-600/60 rounded-sm"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Number -->
                            <div class="relative mt-2">
                                <div class="font-mono text-xl text-white tracking-widest drop-shadow-md">
                                    @if($card->status == 'active')
                                        <span id="maskedCardNumber">•••• •••• •••• {{ $card->last_four }}</span>
                                        @if(isset($card->card_number))
                                            <span id="fullCardNumber" class="hidden">{{ chunk_split($card->card_number, 4, ' ') }}</span>
                                        @endif
                                    @else
                                        <span>•••• •••• •••• ••••</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Cardholder Info & Expiry Date -->
                            <div class="relative mt-auto">
                                <div class="flex justify-between items-end">
                                    <div>
                                        <div class="text-xs uppercase text-white/70 mb-1">Card Holder</div>
                                        <div class="text-white font-medium text-sm truncate max-w-[150px]">
                                            {{ $card->card_holder_name }}
                                        </div>
                                    </div>
                                    
                                    <div class="text-right">
                                        <div class="text-xs uppercase text-white/70 mb-1">Valid Thru</div>
                                        <div class="text-white font-medium">
                                            @if($card->status == 'active' && isset($card->expiry_month) && isset($card->expiry_year))
                                                {{ sprintf('%02d', $card->expiry_month) }}/{{ substr($card->expiry_year, -2) }}
                                            @else
                                                ••/••
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Back of the card -->
                        <div class="credit-card-back absolute inset-0 flex flex-col justify-between p-6 backface-hidden rotate-y-180 rounded-xl">
                            @if($card->card_type == 'visa')
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-800 via-blue-600 to-blue-500 rounded-xl"></div>
                            @elseif($card->card_type == 'mastercard')
                                <div class="absolute inset-0 bg-gradient-to-br from-red-700 via-orange-600 to-orange-500 rounded-xl"></div>
                            @elseif($card->card_type == 'american_express')
                                <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-600 rounded-xl"></div>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-600 rounded-xl"></div>
                            @endif
                            
                            <!-- Magnetic Stripe -->
                            <div class="relative mt-4">
                                <div class="w-full h-12 bg-black rounded-sm"></div>
                            </div>
                            
                            <!-- CVV Section -->
                            <div class="relative mt-4">
                                <div class="bg-white/90 rounded p-2 text-right">
                                    <div class="text-xs text-gray-600 mb-1">CVV</div>
                                    <div class="font-mono text-sm text-gray-900">
                                        @if($card->status == 'active' && isset($card->cvv))
                                            {{ $card->cvv }}
                                        @else
                                            •••
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Bank Info -->
                            <div class="relative mt-auto">
                                <div class="text-white/70 text-xs">
                                    <p>{{ $settings->site_name ?? 'Bank' }} Virtual Card</p>
                                    <p>Customer Service: 1-800-XXX-XXXX</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card Actions -->
            @if($card->status == 'active')
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button id="toggleBtn" type="button" class="inline-flex items-center justify-center px-4 py-3 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors touch-manipulation">
                        <i class="fas fa-eye mr-2"></i> <span id="toggleText">Show Number</span>
                    </button>
                    <button id="copyBtn" type="button" class="inline-flex items-center justify-center px-4 py-3 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors touch-manipulation">
                        <i class="fas fa-copy mr-2"></i> Copy Number
                    </button>
                    <button id="flipBtn" type="button" class="inline-flex items-center justify-center px-4 py-3 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors touch-manipulation">
                        <i class="fas fa-sync-alt mr-2"></i> Flip Card
                    </button>
                </div>
            @endif
        </div>

        <!-- Card Information Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Card Details -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-4">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-info-circle text-white text-xs"></i>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Card Information</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50 dark:border-gray-700/50">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Card Type</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', $card->card_type)) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50 dark:border-gray-700/50">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Card Level</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($card->card_level) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50 dark:border-gray-700/50">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Currency</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $card->currency }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50 dark:border-gray-700/50">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Daily Limit</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $card->currency }} {{ number_format($card->daily_limit, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50 dark:border-gray-700/50">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Available Balance</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $card->currency }} {{ number_format($card->balance, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Created</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $card->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Billing Information -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-4">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-white text-xs"></i>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Billing Information</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50 dark:border-gray-700/50">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Cardholder Name</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $card->card_holder_name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50 dark:border-gray-700/50">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Address</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $card->billing_address ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50 dark:border-gray-700/50">
                        <span class="text-sm text-gray-500 dark:text-gray-400">City</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $card->billing_city ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm text-gray-500 dark:text-gray-400">ZIP Code</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $card->billing_zip ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        @if(isset($recentTransactions) && count($recentTransactions) > 0)
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b border-gray-200/50 dark:border-gray-700/50">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-history text-white text-xs"></i>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
                    </div>
                    <a href="{{ route('cards.transactions', $card) }}" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                        View All
                    </a>
                </div>
                
                <div class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                    @foreach($recentTransactions as $transaction)
                        <div class="p-4 hover:bg-gray-50/80 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                        @if($transaction->transaction_type == 'purchase')
                                            <i class="fas fa-shopping-cart text-red-500 text-xs"></i>
                                        @elseif($transaction->transaction_type == 'refund')
                                            <i class="fas fa-undo text-green-500 text-xs"></i>
                                        @else
                                            <i class="fas fa-exchange-alt text-blue-500 text-xs"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $transaction->description }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold @if($transaction->transaction_type == 'purchase') text-red-600 dark:text-red-400 @else text-green-600 dark:text-green-400 @endif">
                                        @if($transaction->transaction_type == 'purchase')
                                            -{{ $card->currency }} {{ number_format(abs($transaction->amount), 2) }}
                                        @else
                                            +{{ $card->currency }} {{ number_format(abs($transaction->amount), 2) }}
                                        @endif
                                    </p>
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-lg 
                                        @if($transaction->status == 'completed') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 
                                        @elseif($transaction->status == 'pending') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 
                                        @else bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

<style>
.perspective-1000 {
  perspective: 1000px;
  -webkit-perspective: 1000px;
}

.transform-style-preserve-3d {
  transform-style: preserve-3d;
  -webkit-transform-style: preserve-3d;
}

.backface-hidden {
  backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
}

.credit-card {
  width: 100%;
  height: 200px;
  position: relative;
  transform-style: preserve-3d;
  -webkit-transform-style: preserve-3d;
  transition: transform 0.7s;
  -webkit-transition: -webkit-transform 0.7s;
}

.credit-card-front,
.credit-card-back {
  width: 100%;
  height: 100%;
  position: absolute;
  backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
}

.credit-card-back {
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
}

.credit-card.flipped {
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
}
</style>

<script>
  let isCardFlipped = false;
  let isNumberVisible = false;

  const creditCard = document.getElementById('creditCard');
  const flipBtn     = document.getElementById('flipBtn');
  const toggleBtn   = document.getElementById('toggleBtn');
  const copyBtn     = document.getElementById('copyBtn');

  // Flip card
  if (flipBtn && creditCard) {
    flipBtn.addEventListener('click', () => {
      isCardFlipped = !isCardFlipped;
      creditCard.style.transform = isCardFlipped ? 'rotateY(180deg)' : 'rotateY(0deg)';
      creditCard.classList.toggle('flipped', isCardFlipped);
    });
  }

  // Show/hide number
  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      const masked = document.getElementById('maskedCardNumber');
      const full   = document.getElementById('fullCardNumber');
      const txt    = document.getElementById('toggleText');
      if (!masked || !full || !txt) return;

      isNumberVisible = !isNumberVisible;
      masked.classList.toggle('hidden', isNumberVisible);
      full.classList.toggle('hidden', !isNumberVisible);
      txt.textContent = isNumberVisible ? 'Hide Number' : 'Show Number';
    });
  }

  // Copy to clipboard
  if (copyBtn) {
    copyBtn.addEventListener('click', function() {
      const full = document.getElementById('fullCardNumber');
      if (!full) return;

      const cardNumber = full.textContent.replace(/\s/g, '');
      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(cardNumber).then(() => {
          this.innerHTML = '<i class="fas fa-check mr-2"></i> Copied!';
          this.classList.add('text-green-600');
          setTimeout(() => {
            this.innerHTML = '<i class="fas fa-copy mr-2"></i> Copy Number';
            this.classList.remove('text-green-600');
          }, 2000);
        });
      } else {
        // Fallback
        const ta = document.createElement('textarea');
        ta.value = cardNumber;
        document.body.appendChild(ta);
        ta.select();
        try {
          document.execCommand('copy');
          this.innerHTML = '<i class="fas fa-check mr-2"></i> Copied!';
          this.classList.add('text-green-600');
          setTimeout(() => {
            this.innerHTML = '<i class="fas fa-copy mr-2"></i> Copy Number';
            this.classList.remove('text-green-600');
          }, 2000);
        } catch (err) {
          console.error('Fallback copy failed:', err);
        }
        document.body.removeChild(ta);
      }
    });
  }
</script>
@endsection