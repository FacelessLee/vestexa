@extends('layouts.dash2')

@section('title', 'Saved Beneficiaries')

@section('content')
<div x-data="beneficiariesManager()" x-init="loadBeneficiaries()" class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 lg:p-6">
    <div class="max-w-8xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Saved Beneficiaries',
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
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Saved Beneficiaries</h1>
                        <p class="text-gray-600 dark:text-gray-400">Manage your saved transfer recipients</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('localtransfer') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Add Local Beneficiary
                    </a>
                    <a href="{{ route('internationaltransfer') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300">
                        <i class="fas fa-globe mr-2"></i>
                        Add International
                    </a>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-6">
            <div class="flex flex-wrap gap-3">
                <button @click="activeFilter = 'all'; loadBeneficiaries()" 
                        :class="activeFilter === 'all' ? 'bg-primary-100 text-primary-700 border-primary-300 dark:bg-primary-900/30 dark:text-primary-300 dark:border-primary-600' : 'bg-white/70 text-gray-700 border-gray-300 dark:bg-gray-800/70 dark:text-gray-300 dark:border-gray-600'"
                        class="px-4 py-2 border rounded-xl text-sm font-medium transition-all duration-300 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700">
                    All Beneficiaries
                </button>
                <button @click="activeFilter = 'local'; loadBeneficiaries()" 
                        :class="activeFilter === 'local' ? 'bg-primary-100 text-primary-700 border-primary-300 dark:bg-primary-900/30 dark:text-primary-300 dark:border-primary-600' : 'bg-white/70 text-gray-700 border-gray-300 dark:bg-gray-800/70 dark:text-gray-300 dark:border-gray-600'"
                        class="px-4 py-2 border rounded-xl text-sm font-medium transition-all duration-300 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700">
                    Local Transfers
                </button>
                <button @click="activeFilter = 'international'; loadBeneficiaries()" 
                        :class="activeFilter === 'international' ? 'bg-primary-100 text-primary-700 border-primary-300 dark:bg-primary-900/30 dark:text-primary-300 dark:border-primary-600' : 'bg-white/70 text-gray-700 border-gray-300 dark:bg-gray-800/70 dark:text-gray-300 dark:border-gray-600'"
                        class="px-4 py-2 border rounded-xl text-sm font-medium transition-all duration-300 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700">
                    International
                </button>
                <button @click="activeFilter = 'favorites'; loadBeneficiaries()" 
                        :class="activeFilter === 'favorites' ? 'bg-primary-100 text-primary-700 border-primary-300 dark:bg-primary-900/30 dark:text-primary-300 dark:border-primary-600' : 'bg-white/70 text-gray-700 border-gray-300 dark:bg-gray-800/70 dark:text-gray-300 dark:border-gray-600'"
                        class="px-4 py-2 border rounded-xl text-sm font-medium transition-all duration-300 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700">
                    <i class="fas fa-star mr-1"></i>
                    Favorites
                </button>
            </div>
        </div>

        <!-- Loading State -->
        <div x-show="loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <template x-for="i in 6">
                <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 animate-pulse">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                        <div class="flex-1">
                            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded mb-2"></div>
                            <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-2/3"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded"></div>
                        <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Beneficiaries Grid -->
        <div x-show="!loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <template x-for="beneficiary in beneficiaries" :key="beneficiary.id">
                <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-2xl dark:hover:shadow-gray-900/50 transition-all duration-300 transform hover:scale-[1.02]">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center" :class="beneficiary.color">
                                    <span class="text-white font-semibold" x-text="beneficiary.initials"></span>
                                </div>
                                <div x-show="beneficiary.is_favorite" class="absolute -top-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center">
                                    <i class="fas fa-star text-white text-xs"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white" x-text="beneficiary.name"></h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 capitalize" x-text="beneficiary.type + ' Transfer'"></p>
                            </div>
                        </div>
                        <div class="flex space-x-1">
                            <button @click="toggleFavorite(beneficiary)" 
                                    :class="beneficiary.is_favorite ? 'text-yellow-500 hover:text-yellow-600' : 'text-gray-400 hover:text-yellow-500'"
                                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <i class="fas fa-star"></i>
                            </button>
                            <button @click="deleteBeneficiary(beneficiary)" 
                                    class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-2 mb-4">
                        <template x-if="beneficiary.type === 'local'">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <p><span class="font-medium">Bank:</span> <span x-text="beneficiary.bank_name"></span></p>
                                <p><span class="font-medium">Account:</span> <span x-text="beneficiary.account_number"></span></p>
                                <p><span class="font-medium">Name:</span> <span x-text="beneficiary.account_name"></span></p>
                            </div>
                        </template>
                        <template x-if="beneficiary.type === 'international'">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <p><span class="font-medium">Method:</span> <span x-text="beneficiary.method_type"></span></p>
                                <p><span class="font-medium">Details:</span> <span x-text="beneficiary.primary_identifier"></span></p>
                                <template x-if="beneficiary.secondary_info">
                                    <p><span class="font-medium">Info:</span> <span x-text="beneficiary.secondary_info"></span></p>
                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- Usage Stats -->
                    <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400 mb-4">
                        <span>Used <span x-text="beneficiary.usage_count"></span> times</span>
                        <span x-text="beneficiary.last_used_at ? 'Last used: ' + new Date(beneficiary.last_used_at).toLocaleDateString() : 'Never used'"></span>
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <button @click="transferToBeneficiary(beneficiary)" 
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fas fa-paper-plane mr-1"></i>
                            Transfer
                        </button>
                        <a :href="`/dashboard/beneficiaries/${beneficiary.id}/edit`" 
                           class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <div x-show="!loading && beneficiaries.length === 0" class="text-center py-12">
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-12 max-w-2xl mx-auto">
                <div class="w-24 h-24 mx-auto bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-users text-gray-400 dark:text-gray-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">No beneficiaries found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-8">
                    <template x-if="activeFilter === 'all'">
                        <span>You haven't saved any beneficiaries yet. Start by making a transfer and save the recipient for future use.</span>
                    </template>
                    <template x-if="activeFilter === 'favorites'">
                        <span>You haven't marked any beneficiaries as favorites yet. Star your frequently used recipients for quick access.</span>
                    </template>
                    <template x-if="activeFilter !== 'all' && activeFilter !== 'favorites'">
                        <span>No <span x-text="activeFilter"></span> beneficiaries found. Try a different filter or add a new beneficiary.</span>
                    </template>
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-3">
                    <a href="{{ route('localtransfer') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
                        <i class="fas fa-plus mr-2"></i>
                        Add Local Beneficiary
                    </a>
                    <a href="{{ route('internationaltransfer') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-base font-semibold text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300">
                        <i class="fas fa-globe mr-2"></i>
                        Add International
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function beneficiariesManager() {
    return {
        beneficiaries: [],
        loading: false,
        activeFilter: 'all',

        async loadBeneficiaries() {
            this.loading = true;
            try {
                const params = new URLSearchParams();
                if (this.activeFilter !== 'all') {
                    if (this.activeFilter === 'favorites') {
                        params.append('favorites', 'true');
                    } else {
                        params.append('type', this.activeFilter);
                    }
                }

                const response = await fetch(`/dashboard/beneficiaries/get?${params}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();
                if (data.success) {
                    this.beneficiaries = data.beneficiaries;
                }
            } catch (error) {
                console.error('Error loading beneficiaries:', error);
            } finally {
                this.loading = false;
            }
        },

        async toggleFavorite(beneficiary) {
            try {
                const response = await fetch(`/dashboard/beneficiaries/${beneficiary.id}/favorite`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                });

                const data = await response.json();
                if (data.success) {
                    beneficiary.is_favorite = data.is_favorite;
                    this.showNotification(data.message, 'success');
                }
            } catch (error) {
                console.error('Error toggling favorite:', error);
                this.showNotification('Error updating favorite status', 'error');
            }
        },

        async deleteBeneficiary(beneficiary) {
            if (!confirm(`Are you sure you want to delete "${beneficiary.name}"?`)) {
                return;
            }

            try {
                const response = await fetch(`/dashboard/beneficiaries/${beneficiary.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();
                if (data.success) {
                    this.beneficiaries = this.beneficiaries.filter(b => b.id !== beneficiary.id);
                    this.showNotification(data.message, 'success');
                }
            } catch (error) {
                console.error('Error deleting beneficiary:', error);
                this.showNotification('Error deleting beneficiary', 'error');
            }
        },

        transferToBeneficiary(beneficiary) {
            if (beneficiary.type === 'local') {
                window.location.href = `{{ route('localtransfer') }}?beneficiary=${beneficiary.id}`;
            } else if (beneficiary.type === 'international') {
                const method = beneficiary.method_type ? `&method=${encodeURIComponent(beneficiary.method_type)}` : '';
                window.location.href = `{{ route('internationaltransfer') }}?beneficiary=${beneficiary.id}${method}`;
            }
        },

        showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500 text-white' : 
                type === 'error' ? 'bg-red-500 text-white' : 
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    }
}
</script>
@endsection 