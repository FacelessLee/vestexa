@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-7xl mx-auto">
        <div x-data="{ 
            showFilterModal: false,
            showExportModal: false,
            status: '',
            orderBy: 'desc',
            perPage: '10',
            dateRange: ''
        }">
            <!-- Alerts -->
            <x-danger-alert />
            <x-success-alert />
            <x-error-alert />

            <!-- Mobile Header -->
            <div class="lg:hidden mb-2">
                @include('partials._mobile_header', [
                    'title' => 'Loan History',
                    'showBackButton' => true,
                    'backUrl' => route('dashboard'),
                    'showNotifications' => true,
                    'showDarkMode' => true,
                    'financeUser' => Auth::user()
                ])
            </div>

            <!-- Desktop Header -->
            <div class="hidden lg:flex items-center justify-between mb-4">
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Loan History</h1>
                <div class="flex space-x-2">
                    <button 
                        @click="showFilterModal = true" 
                        class="inline-flex items-center px-3 py-2 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-sm"
                    >
                        <i class="fas fa-filter mr-2 text-gray-600 dark:text-gray-400 text-xs"></i>
                        <span class="text-gray-700 dark:text-gray-300">Filter</span>
                    </button>
                    <button 
                        @click="showExportModal = true" 
                        class="inline-flex items-center px-3 py-2 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-sm"
                    >
                        <i class="fas fa-download mr-2 text-gray-600 dark:text-gray-400 text-xs"></i>
                        <span class="text-gray-700 dark:text-gray-300">Export</span>
                    </button>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <!-- Search Bar -->
                <div class="p-3 border-b border-gray-200/50 dark:border-gray-700/50">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            <i class="fas fa-search text-gray-400 text-xs"></i>
                        </div>
                        <input 
                            type="search" 
                            class="block w-full pl-9 pr-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm relative z-0"
                            placeholder="Search by loan purpose or amount..." 
                            wire:model="search"
                        />
                    </div>
                </div>
                
                <!-- Loan Applications Table -->
                <div class="overflow-x-auto" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date, loadMore">
                    <table class="min-w-full">
                        <thead class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">
                                    Purpose
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell">
                                    Duration
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">
                                    Date Applied
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200/50 dark:divide-gray-600/50">
                            @forelse($loans as $loan)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="h-7 w-7 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center">
                                            <i class="fas fa-university text-primary-600 dark:text-primary-400 text-xs"></i>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ Auth::user()->s_curr }}{{ number_format($loan->amount, 2) }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->curr }}</div>
                                    </td>
                                    <td class="px-3 py-2 hidden md:table-cell">
                                        <div class="text-sm text-gray-900 dark:text-white truncate max-w-[120px]" title="{{ $loan->purpose }}">
                                            {{ $loan->purpose }}
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap hidden sm:table-cell">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            @if($loan->duration == 1)
                                                {{ $loan->duration }} Month
                                            @elseif($loan->duration <= 12)
                                                {{ $loan->duration }} Months
                                            @else
                                                {{ floor($loan->duration / 12) }} {{ floor($loan->duration / 12) > 1 ? 'Years' : 'Year' }} 
                                                @if($loan->duration % 12 > 0)
                                                    {{ $loan->duration % 12 }} {{ ($loan->duration % 12) > 1 ? 'Months' : 'Month' }}
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        @if($loan->active == 'Processed')
                                            <span class="px-2 py-1 inline-flex text-xs leading-4 font-medium rounded-full bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">
                                                {{ $loan->active }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 inline-flex text-xs leading-4 font-medium rounded-full bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300">
                                                {{ $loan->active }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 hidden lg:table-cell">
                                        {{ \Carbon\Carbon::parse($loan->created_at)->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-6 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="h-10 w-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-2">
                                                <i class="fas fa-file-alt text-gray-400"></i>
                                            </div>
                                            <p class="text-gray-500 dark:text-gray-400 font-medium text-sm">No loan applications found</p>
                                            <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">Try adjusting your search criteria</p>
                                            <a href="{{ route('loan') }}" class="mt-2 inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                <i class="fas fa-plus mr-2 text-xs"></i>
                                                Apply for a Loan
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Filter Modal -->
            <div 
                x-show="showFilterModal" 
                x-cloak
                class="fixed inset-0 overflow-y-auto z-50 flex items-center justify-center p-4"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div 
                    class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" 
                    @click="showFilterModal = false"
                ></div>
                
                <div 
                    class="relative bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl w-full max-w-sm shadow-2xl transform transition-all border border-gray-200 dark:border-gray-600"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                >
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Filter Loans</h3>
                            <button @click="showFilterModal = false" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <div class="space-y-3">
                            <div>
                                <label for="dateRange" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date Range</label>
                                <input 
                                    type="text" 
                                    id="dateRange" 
                                    class="block w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm"
                                    placeholder="Select date range"
                                    x-model="dateRange"
                                    wire:model="date"
                                />
                            </div>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <div class="relative">
                                    <select 
                                        id="status" 
                                        x-model="status"
                                        wire:model="status"
                                        class="block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm"
                                    >
                                        <option value="">All statuses</option>
                                        <option value="PROCESSED">Processed</option>
                                        <option value="PENDING">Pending</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label for="orderBy" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort by</label>
                                <div class="relative">
                                    <select 
                                        id="orderBy" 
                                        x-model="orderBy"
                                        wire:model="orderBy"
                                        class="block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm"
                                    >
                                        <option value="asc">Oldest first</option>
                                        <option value="desc">Newest first</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label for="perPage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Items per page</label>
                                <div class="relative">
                                    <select 
                                        id="perPage" 
                                        x-model="perPage"
                                        wire:model="perPage"
                                        class="block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm"
                                    >
                                        <option value="10">10 items</option>
                                        <option value="25">25 items</option>
                                        <option value="50">50 items</option>
                                        <option value="100">100 items</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex justify-end space-x-2">
                            <button 
                                @click="showFilterModal = false" 
                                class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                            >
                                Cancel
                            </button>
                            <button 
                                wire:click="$refresh"
                                @click="showFilterModal = false" 
                                class="px-3 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200"
                            >
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Export Modal -->
            <div 
                x-show="showExportModal" 
                x-cloak
                class="fixed inset-0 overflow-y-auto z-50 flex items-center justify-center p-4"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div 
                    class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" 
                    @click="showExportModal = false"
                ></div>
                
                <div 
                    class="relative bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl w-full max-w-sm shadow-2xl transform transition-all border border-gray-200 dark:border-gray-600"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                >
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Export Loans</h3>
                            <button @click="showExportModal = false" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <form wire:submit.prevent="save(Object.fromEntries(new FormData($event.target)))">
                            @csrf
                            
                            <div class="space-y-3">
                                <div>
                                    <label for="exportType" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">File Format</label>
                                    <div class="relative">
                                        <select 
                                            id="exportType" 
                                            name="exportType"
                                            required
                                            class="block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm"
                                        >
                                            <option value="">Select file type</option>
                                            <option value="csv">CSV</option>
                                            <option value="excel">Excel</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="exportAs" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Export as</label>
                                    <div class="relative">
                                        <select 
                                            id="exportAs" 
                                            name="exportAs"
                                            required
                                            class="block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm"
                                        >
                                            <option value="">How do you want to receive this file?</option>
                                            <option value="download">Download file</option>
                                            <option value="email">Send file to email</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <button 
                                    type="submit"
                                    class="w-full px-3 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 flex items-center justify-center transition-all duration-200"
                                >
                                    <i class="fas fa-download mr-2 text-xs"></i>
                                    <span wire:loading.remove wire:target="save">Export</span>
                                    <span wire:loading wire:target="save">Exporting file...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

@endsection
