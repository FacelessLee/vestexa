@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 lg:p-6">
    <div class="max-w-8xl mx-auto" x-data="transactionApp()">
        <!-- Mobile Header -->
        @include('partials._mobile_header', [
            'title' => 'Transactions',
            'showBackButton' => true,
            'backUrl' => route('dashboard'),
            'financeUser' => $financeUser
        ])

        <!-- Alerts -->
        <x-danger-alert />
        <x-success-alert />

    <!-- Desktop Header -->
    <div class="hidden lg:flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Transactions</h1>
        <div class="flex space-x-3">
            <button 
                @click="showFilterModal = true" 
                class="inline-flex items-center px-4 py-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border border-gray-200/50 dark:border-gray-700/50 shadow-sm text-sm font-medium rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 focus:outline-none transition-all duration-200">
                <i class="fa-solid fa-filter text-sm mr-2"></i> Filter
            </button>
            <button 
                @click="showExportModal = true" 
                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50 text-sm font-medium rounded-xl text-white focus:outline-none transition-all duration-200 transform hover:scale-105">
                <i class="fa-solid fa-download text-sm mr-2"></i> Export
            </button>
        </div>
    </div>

    <!-- Mobile Action Buttons -->
    <div class="lg:hidden flex space-x-3 mb-6">
        <button 
            @click="showFilterModal = true" 
            class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border border-gray-200/50 dark:border-gray-700/50 shadow-sm text-sm font-medium rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 focus:outline-none transition-all duration-200">
            <i class="fa-solid fa-filter text-sm mr-2"></i> Filter
        </button>
        <button 
            @click="showExportModal = true" 
            class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50 text-sm font-medium rounded-xl text-white focus:outline-none transition-all duration-200">
            <i class="fa-solid fa-download text-sm mr-2"></i> Export
        </button>
    </div>

    <!-- Desktop Transactions Table -->
    <div class="hidden lg:block bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200/50 dark:divide-gray-700/50">
                <thead class="bg-gradient-to-r from-primary-50/80 to-primary-100/50 dark:from-primary-900/30 dark:to-primary-800/30">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-primary-900 dark:text-primary-100 uppercase tracking-wider"></th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-primary-900 dark:text-primary-100 uppercase tracking-wider">Amount</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-primary-900 dark:text-primary-100 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-primary-900 dark:text-primary-100 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-primary-900 dark:text-primary-100 uppercase tracking-wider">Reference</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-primary-900 dark:text-primary-100 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-primary-900 dark:text-primary-100 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-primary-900 dark:text-primary-100 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white/50 dark:bg-gray-800/50 divide-y divide-gray-200/30 dark:divide-gray-700/30">
                    @forelse ($transactions as $transaction)
                    <tr class="hover:bg-primary-50/50 dark:hover:bg-primary-900/20 transition-all duration-200" id="trx_{{ $transaction->id }}">
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($transaction->type != 'Credit')
                            <div class="h-8 w-8 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-minus text-red-600 dark:text-red-400 text-xs"></i>
                            </div>
                            @else
                            <div class="h-8 w-8 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-plus text-green-600 dark:text-green-400 text-xs"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format($transaction->amount, 2, '.', ',') }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->curr }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($transaction->type == 'Credit')
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                                Credit
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                                <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></div>
                                Debit
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($transaction->status == 'Pending')
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400">
                                <div class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></div>
                                Pending
                            </span>
                            @elseif($transaction->status == 'On-hold')
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400">
                                <div class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-1.5"></div>
                                On-hold
                            </span>
                            @elseif($transaction->status == 'Rejected')
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                                <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></div>
                                Rejected
                            </span>
                            @elseif($transaction->status == 'Processed' || $transaction->status == 'Completed')
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                                {{ $transaction->status }}
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400">
                                <div class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></div>
                                {{ $transaction->status }}
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-mono text-gray-900 dark:text-gray-100">{{ $transaction->txn_id }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate">{{ $transaction->Description }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-500">{{ \Carbon\Carbon::parse($transaction->created_at)->format('h:i A') }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-right">
                            <a href="{{ route('previewtransfer', ['id' => $transaction->id]) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-primary-100 dark:bg-primary-900/50 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-800/50 transition-all duration-200">
                                <i class="fa-solid fa-receipt text-xs mr-1.5"></i>
                                Receipt
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/50 rounded-2xl flex items-center justify-center mb-4">
                                    <i class="fa-solid fa-receipt text-primary-500 dark:text-primary-400 text-2xl"></i>
                                </div>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No transactions found</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filter parameters</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Desktop Pagination -->
        <div class="border-t border-gray-200/50 dark:border-gray-700/50 px-4 py-4 bg-gradient-to-r from-primary-50/30 to-primary-100/20 dark:from-primary-900/20 dark:to-primary-800/20">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm text-gray-600 dark:text-gray-400 mb-4 sm:mb-0">
                    Showing 
                    <span class="font-semibold text-primary-900 dark:text-primary-100">{{ $transactions->firstItem() ?? 0 }}</span> 
                    to 
                    <span class="font-semibold text-primary-900 dark:text-primary-100">{{ $transactions->lastItem() ?? 0 }}</span> 
                    of 
                    <span class="font-semibold text-primary-900 dark:text-primary-100">{{ $transactions->total() }}</span> 
                    results
                </div>
                <div class="flex-1 flex justify-center sm:justify-end">
                    {{ $transactions->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Transactions List -->
    <div class="lg:hidden space-y-3">
        @forelse ($transactions as $transaction)
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        @if($transaction->type != 'Credit')
                        <div class="h-10 w-10 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-minus text-red-600 dark:text-red-400 text-sm"></i>
                        </div>
                        @else
                        <div class="h-10 w-10 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-plus text-green-600 dark:text-green-400 text-sm"></i>
                        </div>
                        @endif
                        <div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format($transaction->amount, 2, '.', ',') }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->curr }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        @if($transaction->type == 'Credit')
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                            <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                            Credit
                        </span>
                        @else
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                            <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></div>
                            Debit
                        </span>
                        @endif
                    </div>
                </div>
                
                <div class="space-y-2 mb-3">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500 dark:text-gray-400">Status</span>
                        @if($transaction->status == 'Pending')
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400">
                            <div class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></div>
                            Pending
                        </span>
                        @elseif($transaction->status == 'On-hold')
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400">
                            <div class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-1.5"></div>
                            On-hold
                        </span>
                        @elseif($transaction->status == 'Rejected')
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                            <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></div>
                            Rejected
                        </span>
                        @elseif($transaction->status == 'Processed' || $transaction->status == 'Completed')
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                            <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                            {{ $transaction->status }}
                        </span>
                        @else
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400">
                            <div class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></div>
                            {{ $transaction->status }}
                        </span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500 dark:text-gray-400">Reference</span>
                        <span class="text-xs font-mono text-gray-900 dark:text-gray-100">{{ $transaction->txn_id }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500 dark:text-gray-400">Description</span>
                        <span class="text-xs text-gray-700 dark:text-gray-300 max-w-32 truncate text-right">{{ $transaction->Description }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500 dark:text-gray-400">Date</span>
                        <div class="text-right">
                            <div class="text-xs text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-500">{{ \Carbon\Carbon::parse($transaction->created_at)->format('h:i A') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="pt-3 border-t border-gray-200/50 dark:border-gray-700/50">
                    <a href="{{ route('previewtransfer', ['id' => $transaction->id]) }}" class="block w-full text-center px-3 py-2 bg-primary-100 dark:bg-primary-900/50 hover:bg-primary-200 dark:hover:bg-primary-800/50 rounded-xl text-xs font-medium text-primary-700 dark:text-primary-300 transition-all duration-200">
                        <i class="fa-solid fa-receipt text-xs mr-1.5"></i>
                        View Receipt
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 py-12">
            <div class="flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/50 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-receipt text-primary-500 dark:text-primary-400 text-2xl"></i>
                </div>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No transactions found</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 max-w-xs">Try adjusting your search or filter parameters</p>
            </div>
        </div>
        @endforelse
        
        <!-- Mobile Pagination -->
        @if($transactions->hasPages())
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 p-4">
            <div class="text-center mb-3">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Showing 
                    <span class="font-semibold text-primary-900 dark:text-primary-100">{{ $transactions->firstItem() ?? 0 }}</span> 
                    to 
                    <span class="font-semibold text-primary-900 dark:text-primary-100">{{ $transactions->lastItem() ?? 0 }}</span> 
                    of 
                    <span class="font-semibold text-primary-900 dark:text-primary-100">{{ $transactions->total() }}</span> 
                    results
                </div>
            </div>
            {{ $transactions->appends(request()->query())->links('pagination::tailwind') }}
        </div>
        @endif
    </div>

    <!-- Filter Modal -->
    <div 
        x-show="showFilterModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="filter-title" 
        role="dialog" 
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div 
                x-show="showFilterModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/20 backdrop-blur-sm transition-opacity" 
                @click="showFilterModal = false" 
                aria-hidden="true">
            </div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div 
                x-show="showFilterModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 transform transition-all sm:my-8 sm:align-middle w-full max-w-md mx-auto sm:p-6">
                
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button
                        @click="showFilterModal = false"
                        type="button"
                        class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none p-2 transition-colors">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-times text-sm"></i>
                    </button>
                </div>
                
                <div class="text-center mb-5">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-2xl bg-primary-100 dark:bg-primary-900/50 mb-4">
                        <i class="fa-solid fa-filter text-2xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="filter-title">Filter Transactions</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Customize your transaction view</p>
                </div>
                
                <form action="{{ url()->current() }}" method="GET" id="filterForm">
                    <div class="mt-5 space-y-4">
                        <div>
                            <label for="date-range" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Date Range</label>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="date-from" class="block text-xs text-gray-600 dark:text-gray-400 mb-1">From</label>
                                    <input 
                                        type="date" 
                                        id="date-from" 
                                        name="date_from"
                                        value="{{ request('date_from') }}"
                                        x-model="dateFrom"
                                        class="block w-full bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 dark:focus:border-primary-400 transition-all duration-200"
                                    />
                                </div>
                                <div>
                                    <label for="date-to" class="block text-xs text-gray-600 dark:text-gray-400 mb-1">To</label>
                                    <input 
                                        type="date" 
                                        id="date-to" 
                                        name="date_to"
                                        value="{{ request('date_to') }}"
                                        x-model="dateTo"
                                        class="block w-full bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 dark:focus:border-primary-400 transition-all duration-200"
                                    />
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Status</label>
                            <select 
                                id="status"
                                name="status"
                                x-model="status"
                                class="block w-full bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 dark:focus:border-primary-400 transition-all duration-200">
                                <option value="">Select status</option>
                                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processed" {{ request('status') == 'Processed' ? 'selected' : '' }}>Processed</option>
                                <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="order" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Sort by</label>
                            <select 
                                id="order"
                                name="order"
                                x-model="orderBy"
                                class="block w-full bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 dark:focus:border-primary-400 transition-all duration-200">
                                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Oldest first (ASC)</option>
                                <option value="desc" {{ request('order') == 'desc' || !request('order') ? 'selected' : '' }}>Newest first (DESC)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="per_page" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Per page</label>
                            <select 
                                id="per_page"
                                name="per_page"
                                x-model="perPage"
                                class="block w-full bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 dark:focus:border-primary-400 transition-all duration-200">
                                <option value="15" {{ request('per_page') == 15 || !request('per_page') ? 'selected' : '' }}>15</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                        
                        <!-- Preserve search term if it exists -->
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                    </div>
                    
                    <div class="mt-6 flex justify-end space-x-3">
                        <button 
                            type="button"
                            @click="showFilterModal = false"
                            class="inline-flex items-center px-4 py-2 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 shadow-sm text-sm font-medium rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600/50 focus:outline-none transition-all duration-200">
                            Cancel
                        </button>
                        <button 
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50 text-sm font-medium rounded-xl text-white focus:outline-none transition-all duration-200 transform hover:scale-105">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Export Modal -->
    <div 
        x-show="showExportModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="export-title" 
        role="dialog" 
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div 
                x-show="showExportModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/20 backdrop-blur-sm transition-opacity" 
                @click="showExportModal = false" 
                aria-hidden="true">
            </div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div 
                x-show="showExportModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 transform transition-all sm:my-8 sm:align-middle w-full max-w-md mx-auto sm:p-6">
                
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button
                        @click="showExportModal = false"
                        type="button"
                        class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none p-2 transition-colors">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-times text-sm"></i>
                    </button>
                </div>
                
                <div class="text-center mb-5">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-2xl bg-primary-100 dark:bg-primary-900/50 mb-4">
                        <i class="fa-solid fa-download text-2xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="export-title">Export Transactions</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Download or receive your transaction data</p>
                </div>
                
                <div class="mt-5 space-y-4">
                    <div>
                        <label for="export-type" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">File Format</label>
                        <select 
                            id="export-type"
                            x-model="exportType"
                            class="block w-full bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 dark:focus:border-primary-400 transition-all duration-200">
                            <option value="">Select file type</option>
                            <option value="pdf">PDF</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="export-as" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Export as</label>
                        <select 
                            id="export-as"
                            x-model="exportAs"
                            class="block w-full bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 dark:focus:border-primary-400 transition-all duration-200">
                            <option value="">How do you want to receive this file?</option>
                            <option value="view">Preview statement</option>
                            <option value="download">Download file</option>
                            <option value="email">Send file to email</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="statement-type" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Statement Style</label>
                        <div class="grid grid-cols-2 gap-3 mt-2">
                            <div 
                                @click="statementStyle = 'modern'" 
                                :class="{'ring-2 ring-primary-500 bg-primary-50 dark:bg-primary-900/30': statementStyle === 'modern'}"
                                class="border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200">
                                <div class="text-xs font-semibold text-gray-900 dark:text-white mb-2">Modern</div>
                                <div class="h-12 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                    <i class="fa-solid fa-table-columns text-gray-500 dark:text-gray-400"></i>
                                </div>
                            </div>
                            <div 
                                @click="statementStyle = 'classic'" 
                                :class="{'ring-2 ring-primary-500 bg-primary-50 dark:bg-primary-900/30': statementStyle === 'classic'}"
                                class="border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200">
                                <div class="text-xs font-semibold text-gray-900 dark:text-white mb-2">Classic</div>
                                <div class="h-12 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                    <i class="fa-solid fa-file-lines text-gray-500 dark:text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button 
                        @click="exportData()"
                        type="button"
                        id="export-button"
                        class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 shadow-lg shadow-primary-500/25 dark:shadow-primary-900/50 text-sm font-medium rounded-xl text-white focus:outline-none transition-all duration-200 transform hover:scale-105">
                        <i class="fa-solid fa-download text-sm mr-2"></i>
                        <span>Export Transactions</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
   document.addEventListener('alpine:init', function() {
    Alpine.data('transactionApp', function() {
        return {
            showFilterModal: false,
            showExportModal: false,
            showDebug: false,
            dateFrom: '{{ request('date_from') }}',
            dateTo: '{{ request('date_to') }}',
            status: '{{ request('status') }}',
            orderBy: '{{ request('order', 'desc') }}',
            perPage: '{{ request('per_page', 15) }}',
            exportType: '',
            exportAs: '',
            search: '{{ request('search') }}',
            statementStyle: 'modern',
            
            // This method is now handled by the form submission
            applyFilters() {
                document.getElementById('filterForm').submit();
            },
            
            exportData() {
                // Check if both exportType and exportAs are selected
                if(!this.exportType || !this.exportAs) {
                    this.errorMessage = 'Please select both export type and delivery method';
                    this.showExportError('Please select both export type and delivery method');
                    return;
                }
                
                console.log('Export options:', this.exportType, this.exportAs, this.statementStyle);
                
                // Handle view option - open in new tab
                if (this.exportAs === 'view') {
                    const url = new URL("{{ route('user.transactions.export', [], false) }}", window.location.origin);
                    
                    // Add parameters
                    url.searchParams.append('exportType', this.exportType);
                    url.searchParams.append('exportAs', this.exportAs);
                    url.searchParams.append('statementStyle', this.statementStyle);
                    
                    // Add filters if they exist
                    if (this.dateFrom) url.searchParams.append('startDate', this.dateFrom);
                    if (this.dateTo) url.searchParams.append('endDate', this.dateTo);
                    if (this.status) url.searchParams.append('status', this.status);
                    if (this.orderBy) url.searchParams.append('orderBy', this.orderBy);
                    
                    // Open in new tab with specific dimensions
                    const windowFeatures = 'width=800,height=1000,resizable=yes,scrollbars=yes,status=yes';
                    window.open(url.toString(), '_blank', windowFeatures);
                    
                    // Close modal
                    this.showExportModal = false;
                    return;
                }
                
                // Disable the export button while processing
                const exportButton = document.querySelector('#export-button');
                exportButton.disabled = true;
                exportButton.innerHTML = '<i data-lucide="loader" class="h-4 w-4 mr-2 animate-spin"></i><span>Processing...</span>';
                lucide.createIcons();
                
                try {
                    // Get the CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // Prepare form data
                    const formData = new FormData();
                    formData.append('statementStyle', this.statementStyle);
                    
                    // Handle based on export method
                    if (this.exportAs === 'download') {
                        // For direct downloads, create a form and submit it directly
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route("export.transactions") }}';
                        form.style.display = 'none';
                        
                        // Add CSRF token
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        form.appendChild(csrfInput);
                        
                        // Add form fields
                        for (const pair of formData.entries()) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = pair[0];
                            input.value = pair[1];
                            form.appendChild(input);
                        }
                        
                        // Add form to body and submit
                        document.body.appendChild(form);
                        
                        // Submit the form and handle potential errors
                        try {
                            form.submit();
                            console.log('Form submitted successfully');
                        } catch (err) {
                            console.error('Form submission error:', err);
                            this.showExportError();
                        }
                        
                        // Clean up
                        setTimeout(() => {
                            document.body.removeChild(form);
                            this.showExportModal = false;
                            exportButton.disabled = false;
                            exportButton.innerHTML = '<i data-lucide="download" class="h-4 w-4 mr-2"></i><span>Export Transactions</span>';
                            lucide.createIcons(); // Reinitialize icons
                        }, 1000);
                    } else {
                        // For email exports, use fetch API
                        console.log('Sending email export request to:', '{{ route("export.transactions") }}');
                        
                        fetch('{{ route("export.transactions") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: formData
                        })
                        .then(response => {
                            console.log('Response status:', response.status);
                            if (!response.ok) {
                                throw new Error('Network response was not ok: ' + response.status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Export response:', data);
                            if (data.success) {
                                // Show success message
                                const successAlert = document.querySelector('.success-alert');
                                if (successAlert) {
                                    const alertMessage = successAlert.querySelector('.alert-message');
                                    if (alertMessage) {
                                        alertMessage.textContent = 'Your transaction export has been sent to your email.';
                                        successAlert.classList.remove('hidden');
                                        setTimeout(() => {
                                            successAlert.classList.add('hidden');
                                        }, 5000);
                                    }
                                } else {
                                    alert('Your transaction export has been sent to your email.');
                                }
                                this.showExportModal = false;
                            } else {
                                this.showExportError(data.message || 'An error occurred while exporting your transactions.');
                            }
                        })
                        .catch(error => {
                            console.error('Export error:', error);
                            this.showExportError();
                        })
                        .finally(() => {
                            // Re-enable the export button
                            exportButton.disabled = false;
                            exportButton.innerHTML = '<i data-lucide="download" class="h-4 w-4 mr-2"></i><span>Export Transactions</span>';
                            lucide.createIcons(); // Reinitialize icons
                        });
                    }
                } catch (error) {
                    console.error('Export functionality error:', error);
                    this.showExportError();
                    
                    // Re-enable the export button
                    exportButton.disabled = false;
                    exportButton.innerHTML = '<i data-lucide="download" class="h-4 w-4 mr-2"></i><span>Export Transactions</span>';
                    lucide.createIcons(); // Reinitialize icons
                }
            },
            
            showExportError(message = 'An error occurred while processing your export request.') {
                // Implement your error display logic here
                console.error(message);
                alert(message);
            }
        };
    });
});
                    </script>
                    @endsection