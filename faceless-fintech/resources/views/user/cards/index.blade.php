@extends('layouts.dash2')
@section('title', 'Cards')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 lg:p-6">
    <div class="max-w-8xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Virtual Cards',
                'showBackButton' => true,
                'backUrl' => route('dashboard'),
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
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Virtual Cards</h1>
                        <p class="text-gray-600 dark:text-gray-400">Secure virtual cards for online payments and subscriptions</p>
                    </div>
                </div>
                <a href="{{ route('cards.apply') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white rounded-xl shadow-lg font-semibold transition-all duration-300 transform hover:scale-[1.02]">
                    <i class="fas fa-plus mr-2"></i> Apply for Card
                </a>
            </div>
        </div>
 <x-danger-alert />
    <x-success-alert />
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl p-3">
                            <i class="fas fa-credit-card text-white text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Active Cards</p>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $activeCards }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl p-3">
                            <i class="fas fa-hourglass-half text-white text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pending Applications</p>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $pendingCards }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-3">
                            <i class="fas fa-wallet text-white text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Balance</p>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format($totalBalance, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Banner -->
        <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 dark:from-primary-600 dark:via-primary-700 dark:to-primary-800 rounded-2xl overflow-hidden shadow-xl border border-white/20 dark:border-gray-700/50 mb-4">
            <div class="relative p-6">
                <div class="relative z-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex-1">
                            <h2 class="text-xl lg:text-2xl font-bold text-white mb-2">Virtual Cards Made Easy</h2>
                            <p class="text-white/90 text-sm mb-4">Create virtual cards for secure online payments, subscription management, and more. Enhanced security and spending control.</p>
                            
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <i class="fas fa-shield-alt text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-white text-xs font-semibold">Secure</h3>
                                        <p class="text-white/80 text-xs">Protected payments</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <i class="fas fa-globe text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-white text-xs font-semibold">Global</h3>
                                        <p class="text-white/80 text-xs">Worldwide acceptance</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <i class="fas fa-sliders-h text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-white text-xs font-semibold">Control</h3>
                                        <p class="text-white/80 text-xs">Spending limits</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <i class="fas fa-bolt text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-white text-xs font-semibold">Instant</h3>
                                        <p class="text-white/80 text-xs">Quick issuance</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="lg:hidden">
                                <a href="{{ route('cards.apply') }}" class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white rounded-xl font-semibold transition-all duration-300 border border-white/30">
                                    <i class="fas fa-plus mr-2"></i> Apply Now
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card Visual -->
                        <div class="hidden lg:flex lg:items-center lg:justify-center lg:w-1/3 lg:pl-6">
                            <div class="relative w-48 h-32">
                                <div class="absolute w-full h-full transform rotate-6 rounded-xl bg-gradient-to-br from-gray-900/50 to-gray-800/50 shadow-lg backdrop-blur-sm"></div>
                                <div class="absolute w-full h-full rounded-xl bg-gradient-to-r from-primary-800/90 to-primary-600/90 shadow-lg backdrop-blur-sm border border-white/20">
                                    <div class="p-4 h-full flex flex-col justify-between">
                                        <div class="flex justify-between items-start">
                                            <div class="text-xs font-mono text-white/75">Virtual Card</div>
                                            <i class="fas fa-wifi text-white/75 text-sm transform rotate-90"></i>
                                        </div>
                                        <div class="text-xs font-mono text-white mt-4">•••• •••• •••• 1234</div>
                                        <div class="flex justify-between items-end">
                                            <div>
                                                <div class="text-xs font-mono text-white/75">VALID THRU</div>
                                                <div class="text-xs font-mono text-white">12/25</div>
                                            </div>
                                            <div class="h-6 w-6">
                                                <i class="fas fa-credit-card text-white/75 text-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-32 h-32 rounded-full bg-white transform translate-x-16 -translate-y-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 rounded-full bg-white transform -translate-x-12 translate-y-12"></div>
                </div>
            </div>
        </div>

        <!-- Card Listings -->
        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="border-b border-gray-200/50 dark:border-gray-700/50 px-6 py-4 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Your Cards</h2>
                <a href="{{ route('cards.apply') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 flex items-center font-medium transition-colors">
                    <i class="fas fa-plus-circle mr-1"></i> New Card
                </a>
            </div>
            
            @if(count($cards) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-6">
                    @foreach($cards as $card)
                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 hover:shadow-lg transition-all duration-300 group overflow-hidden">
                            <!-- Card Header with Status -->
                            <div class="px-4 pt-4 pb-2 flex justify-between items-center">
                                <div>
                                    @if($card->status == 'active')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">
                                            <i class="fas fa-check-circle mr-1"></i> Active
                                        </span>
                                    @elseif($card->status == 'pending')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300">
                                            <i class="fas fa-clock mr-1"></i> Pending
                                        </span>
                                    @elseif($card->status == 'inactive')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700/50 text-gray-800 dark:text-gray-300">
                                            <i class="fas fa-pause mr-1"></i> Inactive
                                        </span>
                                    @elseif($card->status == 'blocked')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300">
                                            <i class="fas fa-lock mr-1"></i> Blocked
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                                    {{ ucfirst($card->card_level) }}
                                </div>
                            </div>
                            
                            <!-- Card Representation -->
                            <div class="px-4 py-3">
                                <div class="w-full h-40 relative overflow-hidden rounded-xl">
                                    <!-- Card Background -->
                                    @if($card->card_type == 'visa')
                                        <div class="absolute inset-0 bg-gradient-to-br from-blue-800 via-blue-600 to-blue-500"></div>
                                    @elseif($card->card_type == 'mastercard')
                                        <div class="absolute inset-0 bg-gradient-to-br from-red-700 via-orange-600 to-orange-500"></div>
                                    @elseif($card->card_type == 'american_express')
                                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-600"></div>
                                    @else
                                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-600"></div>
                                    @endif
                                    
                                    <!-- Card decorative elements -->
                                    <div class="absolute inset-0 overflow-hidden">
                                        <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -translate-y-12 translate-x-12"></div>
                                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full translate-y-16 -translate-x-16"></div>
                                    </div>
                                    
                                    <!-- Card Content -->
                                    <div class="relative p-4 h-full flex flex-col justify-between text-white">
                                        <!-- Top Row -->
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="text-xs font-semibold opacity-90">{{ $settings->site_name ?? 'Bank' }}</div>
                                                <div class="text-xs opacity-70">Virtual Card</div>
                                            </div>
                                            
                                            <!-- Card Type Logo -->
                                            <div class="text-right">
                                                @if($card->card_type == 'visa')
                                                    <div class="text-xs font-bold">VISA</div>
                                                @elseif($card->card_type == 'mastercard')
                                                    <div class="text-xs font-bold">MASTERCARD</div>
                                                @elseif($card->card_type == 'american_express')
                                                    <div class="text-xs font-bold">AMEX</div>
                                                @else
                                                    <i class="fas fa-credit-card text-lg opacity-75"></i>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Chip -->
                                        <div class="w-8 h-6 rounded bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center">
                                            <div class="w-full h-full grid grid-cols-2 grid-rows-2 gap-px p-1">
                                                <div class="bg-yellow-600/60 rounded-sm"></div>
                                                <div class="bg-yellow-600/60 rounded-sm"></div>
                                                <div class="bg-yellow-600/60 rounded-sm"></div>
                                                <div class="bg-yellow-600/60 rounded-sm"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Card Number -->
                                        <div class="font-mono text-sm tracking-wider">
                                            •••• •••• •••• {{ $card->last_four }}
                                        </div>
                                        
                                        <!-- Bottom Row -->
                                        <div class="flex justify-between items-end">
                                            <div>
                                                <div class="text-xs opacity-70 uppercase">Card Holder</div>
                                                <div class="text-xs font-medium truncate max-w-[120px]">{{ $card->card_holder_name }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xs opacity-70 uppercase">Valid Thru</div>
                                                <div class="text-xs font-medium">{{ $card->expiry_month }}/{{ substr($card->expiry_year, -2) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Info -->
                            <div class="px-4 pb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs font-medium text-gray-600 dark:text-gray-400">Balance</span>
                                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $card->currency }} {{ number_format($card->balance, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-xs font-medium text-gray-600 dark:text-gray-400">Daily Limit</span>
                                    <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $card->currency }} {{ number_format($card->daily_limit, 2) }}</span>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('cards.view', $card) }}" class="flex-1 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white text-xs font-semibold py-2 px-3 rounded-lg transition-all duration-300 text-center">
                                        View Details
                                    </a>
                                    <a href="{{ route('cards.transactions', $card) }}" class="flex-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs font-semibold py-2 px-3 rounded-lg transition-all duration-300 text-center">
                                        Transactions
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                        <i class="fas fa-credit-card text-white text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Cards Yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm mx-auto">Get started by applying for your first virtual card. It only takes a few minutes!</p>
                    <a href="{{ route('cards.apply') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white rounded-xl shadow-lg font-semibold transition-all duration-300 transform hover:scale-[1.02]">
                        <i class="fas fa-plus mr-2"></i> Apply for Your First Card
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 