@extends('layouts.dash2')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8" x-data="transferSuccess()">
    <div class="max-w-4xl mx-auto">
        
        <!-- Mobile Header -->
        @include('partials._mobile_header', [
            'title' => 'Transfer Successful',
            'showBackButton' => true,
            'backUrl' => route('dashboard'),
            'financeUser' => $user
        ])
        <!-- PC Layout -->
        <div class="hidden lg:block">
            <!-- Success Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl dark:shadow-gray-900/25 overflow-hidden">
                <!-- Header with gradient background -->
                <div class="relative bg-gradient-to-br from-green-500 via-green-600 to-green-700 dark:from-green-600 dark:via-green-700 dark:to-green-800 px-8 py-12 text-white">
                    <!-- Animated Success Icon -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <!-- Outer Ring -->
                            <div class="w-24 h-24 rounded-full border-4 border-white/30 flex items-center justify-center">
                                <!-- Inner Circle with Icon -->
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center animate-pulse">
                                    <i class="fa-solid fa-check text-green-600 text-2xl"></i>
                                </div>
                            </div>
                            <!-- Decorative Elements -->
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="absolute -bottom-1 -left-1 w-4 h-4 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            <div class="absolute top-1 -left-3 w-3 h-3 bg-pink-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                            <div class="absolute -top-1 left-6 w-2 h-2 bg-orange-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                            <div class="absolute bottom-2 right-1 w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 0.5s"></div>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <div class="text-center">
                        <h1 class="text-3xl font-bold mb-2">Transfer Successful!</h1>
                        <p class="text-white/90 text-lg mb-6">
                            {{ $currency }}{{ number_format($dp->amount, 2) }} has been transferred successfully
                        </p>
                        <div class="inline-flex items-center space-x-2 bg-white/20 dark:bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full">
                            <i class="fa-solid fa-user text-white text-sm"></i>
                            <span class="text-white/90 text-sm">to {{ $recipientName }}</span>
                        </div>
                    </div>

                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-8 right-8 w-32 h-32 bg-white rounded-full -translate-y-8 translate-x-8"></div>
                        <div class="absolute bottom-8 left-8 w-24 h-24 bg-white rounded-full translate-y-4 -translate-x-4"></div>
                        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white rounded-full"></div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-8">
                    <!-- Transaction Summary -->
                    <div class="grid grid-cols-3 gap-6 mb-8">
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-money-bill-transfer text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Amount</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $currency }}{{ number_format($dp->amount, 2) }}</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-credit-card text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Method</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $dp->payment_mode }}</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-clock text-green-600 dark:text-green-400"></i>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Status</p>
                            <p class="text-lg font-bold text-green-600 dark:text-green-400">{{ $dp->status }}</p>
                        </div>
                    </div>

                    <!-- Transaction Details -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Transaction Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Transaction ID</p>
                                <p class="text-sm font-mono text-gray-900 dark:text-white">{{ $dp->txn_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Date & Time</p>
                                <p class="text-sm text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($dp->date)->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                            @if($dp->Description)
                            <div class="col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Description</p>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $dp->Description }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button @click="viewReceipt()" class="flex-1 bg-primary-600 dark:bg-primary-500 hover:bg-primary-700 dark:hover:bg-primary-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-receipt"></i>
                            <span>View Receipt</span>
                        </button>
                        <button @click="shareReceipt()" class="flex-1 bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-900 dark:text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-share-alt"></i>
                            <span>Share Receipt</span>
                        </button>
                        <a href="{{ route('dashboard') }}" class="flex-1 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-900 dark:text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-home"></i>
                            <span>Done</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Layout -->
        <div class="lg:hidden">
            <!-- Mobile Success Screen -->
            <div class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white p-6 mb-6">
                <!-- Need Help Button -->
                <div class="flex justify-end mb-8">
                    <button class="text-primary-600 dark:text-primary-400 text-sm font-medium hover:text-primary-700 dark:hover:text-primary-300 transition-colors">Need Help?</button>
                </div>

                <!-- Success Animation -->
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <!-- Main Success Circle -->
                        <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center relative overflow-hidden">
                            <i class="fa-solid fa-check text-white text-2xl z-10"></i>
                            <!-- Animated rings -->
                            <div class="absolute inset-0 border-4 border-green-400/30 dark:border-white/30 rounded-full animate-ping"></div>
                        </div>
                        
                        <!-- Floating Confetti -->
                        <div class="absolute -top-2 -right-2 w-3 h-3 bg-pink-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="absolute -top-1 left-2 w-2 h-2 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="absolute top-2 -right-3 w-2 h-2 bg-orange-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                        <div class="absolute -bottom-1 -left-2 w-3 h-3 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                        <div class="absolute bottom-1 right-1 w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 0.5s"></div>
                        <div class="absolute top-6 -left-4 w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.6s"></div>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold mb-4">Transfer Successful</h1>
                    <div class="text-4xl font-bold mb-2">{{ $currency }}{{ number_format($dp->amount, 2) }}</div>
                    <div class="flex items-center justify-center space-x-2 text-gray-600 dark:text-white/80">
                        <span>to</span>
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-white text-xs"></i>
                        </div>
                        <span>{{ $recipientName }}</span>
                    </div>
                </div>
            </div>

            <!-- Mobile Action Buttons -->
            <div class="space-y-4">
                <button @click="shareReceipt()" class="w-full bg-primary-500 hover:bg-primary-600 text-white font-semibold py-4 rounded-2xl transition-all duration-200 flex items-center justify-center space-x-2 shadow-lg shadow-primary-500/25">
                    <i class="fa-solid fa-share-alt"></i>
                    <span>Share Receipt</span>
                </button>
                
                <button @click="viewReceipt()" class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-900 dark:text-white font-semibold py-4 rounded-2xl transition-all duration-200 flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-receipt"></i>
                    <span>View Receipt</span>
                </button>

                <a href="{{ route('dashboard') }}" class="block w-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-4 rounded-2xl transition-all duration-200 text-center">
                    Done
                </a>
            </div>

            <!-- Mobile Transaction Summary -->
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Transaction Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Transaction ID</span>
                        <span class="text-gray-900 dark:text-white font-mono text-sm">{{ $dp->txn_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Method</span>
                        <span class="text-gray-900 dark:text-white">{{ $dp->payment_mode }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Status</span>
                        <span class="text-green-600 dark:text-green-400 font-medium">{{ $dp->status }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Date</span>
                        <span class="text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($dp->date)->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function transferSuccess() {
    return {
        viewReceipt() {
            // Open receipt in new window/tab
            window.open('{{ route("previewtransfer", ["id" => $dp->id]) }}', '_blank');
        },
        
        shareReceipt() {
            if (navigator.share) {
                navigator.share({
                    title: 'Transfer Receipt',
                    text: 'Transfer of {{ $currency }}{{ number_format($dp->amount, 2) }} completed successfully',
                    url: '{{ route("previewtransfer", ["id" => $dp->id]) }}'
                });
            } else {
                // Fallback: copy link to clipboard
                const receiptUrl = '{{ route("previewtransfer", ["id" => $dp->id]) }}';
                navigator.clipboard.writeText(receiptUrl).then(() => {
                    alert('Receipt link copied to clipboard!');
                });
            }
        }
    }
}
</script>

<style>
@keyframes confetti-fall {
    0% { transform: translateY(-100vh) rotate(0deg); }
    100% { transform: translateY(100vh) rotate(720deg); }
}

.animate-confetti {
    animation: confetti-fall 3s linear infinite;
}
</style>
@endsection 