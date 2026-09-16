@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 lg:p-6">
    <div class="max-w-8xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Local Transfer',
                'showBackButton' => true,
                'backUrl' => route('dashboard'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:block mb-4">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                    <i class="fas fa-paper-plane text-white text-lg"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Local Transfer</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 ml-13">Send money to any local bank account securely and instantly</p>
        </div>

                <div x-data="{
            amount: '',
            accountname: '',
            accountnumber: '',
            bankname: '',
            Accounttype: 'Online Banking',
            routing_number: '',
            swift_code: '',
            pin: '',
            Description: '',
            isSubmitting: false,
            showPreview: false,

            validateAmount() {
                const maxBalance = {{ Auth::user()->account_bal }};
                const minTransfer = {{ Auth::user()->min_transfer_amount ?? 1 }};
                const maxTransfer = {{ Auth::user()->max_transfer_amount ?? 500000 }};

                if (this.amount > maxBalance) {
                    this.amount = maxBalance;
                }

                // Check transfer limits
                if (this.amount > 0 && this.amount < minTransfer) {
                    return false;
                }

                if (this.amount > maxTransfer) {
                    return false;
                }

                return true;
            },

            getTransferLimits() {
                return {
                    min: {{ Auth::user()->min_transfer_amount ?? 1 }},
                    max: {{ Auth::user()->max_transfer_amount ?? 500000 }}
                };
            },

            getMaxBalance() {
                return {{ Auth::user()->account_bal }};
            },

            // Handle beneficiary selection
            handleBeneficiarySelection(beneficiary) {
                this.accountname = beneficiary.account_name || '';
                this.accountnumber = beneficiary.account_number || '';
                this.bankname = beneficiary.bank_name || '';
                this.Accounttype = beneficiary.account_type || 'Online Banking';
                this.routing_number = beneficiary.routing_number || '';
                this.swift_code = beneficiary.swift_code || '';
                this.Description = 'Transfer to ' + beneficiary.name;
            },

            // Get current form data for saving as beneficiary
            getCurrentFormData() {
                return {
                    account_name: this.accountname,
                    account_number: this.accountnumber,
                    bank_name: this.bankname,
                    account_type: this.Accounttype,
                    routing_number: this.routing_number,
                    swift_code: this.swift_code,
                    method_type: null // For local transfers
                };
            }
        }"
        @beneficiary-selected="handleBeneficiarySelection($event.detail)"
        class="pt-4">

        <script>
        // Make quickTransfer function available globally
        function quickTransfer() {
            return {
                beneficiaries: [],
                loading: false,
                showBeneficiaryForm: false,
                beneficiaryName: '',
                beneficiaryIsFavorite: false,
                savingBeneficiary: false,
                transferType: 'local',
                methodType: '',

                init() {
                    this.loadBeneficiaries();

                    // Listen for show beneficiary form event on window
                    window.addEventListener('show-beneficiary-form', () => {
                        this.showBeneficiaryForm = true;

                        // Scroll to the form after a short delay to ensure it's rendered
                        setTimeout(() => {
                            const formElement = this.$el.querySelector('[x-show="showBeneficiaryForm"]');
                            if (formElement) {
                                formElement.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            }
                        }, 100);
                    });
                },

                async loadBeneficiaries() {
                    this.loading = true;
                    try {
                        const params = new URLSearchParams({
                            type: this.transferType
                        });

                        // For international transfers, get current method from parent
                        let currentMethod = this.methodType;
                        if (this.transferType === 'international') {
                            const parentData = this.$root.__x_data_stack?.[0];
                            if (parentData && parentData.withdrawMethod) {
                                currentMethod = parentData.withdrawMethod;
                            }
                        }

                        if (currentMethod) {
                            params.append('method', currentMethod);
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

                async selectBeneficiary(beneficiary) {
                    try {
                        const response = await fetch(`/dashboard/beneficiaries/${beneficiary.id}/data`, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            }
                        });

                        const data = await response.json();
                        if (data.success) {
                            // Emit event to parent component to fill form
                            this.$dispatch('beneficiary-selected', data.beneficiary);

                            // Show success message
                            this.showNotification('Beneficiary details loaded successfully!', 'success');
                        }
                    } catch (error) {
                        console.error('Error loading beneficiary data:', error);
                        this.showNotification('Error loading beneficiary details', 'error');
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

                async saveBeneficiary() {
                    if (!this.beneficiaryName.trim()) return;

                    this.savingBeneficiary = true;
                    try {
                        // Get current form data from parent
                        const formData = this.getCurrentFormData();

                        const beneficiaryData = {
                            name: this.beneficiaryName,
                            type: this.transferType,
                            is_favorite: this.beneficiaryIsFavorite,
                            ...formData
                        };

                        const response = await fetch('/dashboard/beneficiaries', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(beneficiaryData)
                        });

                        const data = await response.json();
                        if (data.success) {
                            this.beneficiaries.unshift(data.beneficiary);
                            this.showBeneficiaryForm = false;
                            this.resetBeneficiaryForm();
                            this.showNotification(data.message, 'success');
                        } else {
                            this.showNotification('Error saving beneficiary: ' + (data.message || 'Unknown error'), 'error');
                        }
                    } catch (error) {
                        console.error('Error saving beneficiary:', error);
                        this.showNotification('Error saving beneficiary', 'error');
                    } finally {
                        this.savingBeneficiary = false;
                    }
                },

                getCurrentFormData() {
                    // Try to get form data from parent Alpine component
                    const parentData = this.$root.__x_data_stack?.[0];
                    if (parentData && parentData.getCurrentFormData) {
                        return parentData.getCurrentFormData();
                    }

                    // Fallback: try to get data directly from form inputs
                    const accountname = document.getElementById('accountname')?.value || '';
                    const accountnumber = document.getElementById('accountnumber')?.value || '';
                    const bankname = document.getElementById('bankname')?.value || '';
                    const accounttype = document.querySelector('select[name="Accounttype"]')?.value || 'Online Banking';
                    const routingNumber = document.getElementById('routing_number')?.value || '';
                    const swiftCode = document.getElementById('swift_code')?.value || '';

                    return {
                        account_name: accountname,
                        account_number: accountnumber,
                        bank_name: bankname,
                        account_type: accounttype,
                        routing_number: routingNumber,
                        swift_code: swiftCode,
                        method_type: null // For local transfers
                    };
                },

                resetBeneficiaryForm() {
                    this.beneficiaryName = '';
                    this.beneficiaryIsFavorite = false;
                },

                showNotification(message, type = 'info') {
                    // Simple notification system - can be enhanced
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
            <!-- Alerts -->
            <div class="mb-2">
                <x-danger-alert />
                <x-success-alert />
            </div>

            <!-- Main Transfer Card -->
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <!-- Modern Header -->
                <div class="relative bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 dark:from-primary-600 dark:via-primary-700 dark:to-primary-800 p-6 lg:p-8">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <i class="fas fa-paper-plane text-white text-lg"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl lg:text-2xl font-bold text-white">Local Transfer</h2>
                                    <p class="text-white/80 text-sm">Send money instantly</p>
                                </div>
                            </div>
                            <div class="hidden lg:flex items-center space-x-2 text-white/60">
                                <i class="fas fa-shield-alt"></i>
                                <span class="text-xs font-medium">Secure</span>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-3 gap-3">
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                                <div class="flex items-center space-x-1 mb-1">
                                    <i class="fas fa-clock text-white/80 text-xs"></i>
                                    <span class="text-white/80 text-xs font-medium">Time</span>
                                </div>
                                <p class="text-white font-bold text-sm">Instant</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                                <div class="flex items-center space-x-1 mb-1">
                                    <i class="fas fa-percentage text-white/80 text-xs"></i>
                                    <span class="text-white/80 text-xs font-medium">Fee</span>
                                </div>
                                <p class="text-white font-bold text-sm">Free</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                                <div class="flex items-center space-x-1 mb-1">
                                    <i class="fas fa-university text-white/80 text-xs"></i>
                                    <span class="text-white/80 text-xs font-medium">Banks</span>
                                </div>
                                <p class="text-white font-bold text-sm">All Local</p>
                            </div>
                        </div>
                    </div>

                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 right-0 w-32 h-32 rounded-full bg-white transform translate-x-16 -translate-y-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 rounded-full bg-white transform -translate-x-12 translate-y-12"></div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-4 lg:p-6 space-y-6">
                    <!-- Quick Transfer Component -->
                    <div x-data="quickTransfer()" x-init="loadBeneficiaries()">
                        @include('partials.quick-transfer', ['transferType' => 'local', 'methodType' => ''])
                    </div>

                <form @submit.prevent="showPreview = true" id="transferForm">
                    @csrf

                    <!-- Account Balance Display -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 mb-1">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                <i class="fas fa-wallet text-white text-xs"></i>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Available Balance</h3>
                        </div>

                        <!-- Fiat Balance Card -->
                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200 dark:border-gray-700 p-4 shadow-lg">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                                        <i class="fas fa-university text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Account Balance</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->curr }} Currency</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <div class="flex items-baseline space-x-1">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format(Auth::user()->account_bal, 2, '.', ',') }}</span>
                                </div>
                                <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-circle text-green-500 text-xs"></i>
                                    <span>Available for transfer</span>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden input for balance type (always fiat for local transfers) -->
                        <input type="hidden" name="balance_type" value="fiat">
                    </div>

                    <!-- Amount Input Section -->
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center space-x-2 mb-1">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-white text-xs"></i>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Transfer Amount</h3>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50/80 to-white/80 dark:from-gray-800/50 dark:to-gray-900/50 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-4">
                            <!-- Amount Input -->
                            <div class="relative mb-4">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                    <span class="text-gray-400 dark:text-gray-500 text-xl font-bold">{{ Auth::user()->s_curr }}</span>
                                </div>
                                <input
                                    type="number"
                                    name="amount"
                                    id="amount"
                                    x-model="amount"
                                    @input="validateAmount()"
                                    min="1"
                                    :max="getMaxBalance()"
                                    step="0.01"
                                    class="block w-full pl-12 pr-16 py-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-2xl font-bold text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="0.00"
                                    required
                                />
                            </div>

                            <!-- Quick Amount Buttons -->
                            <div class="space-y-2">
                                <p class="text-xs font-medium text-gray-700 dark:text-gray-300">Quick amounts:</p>

                                <div class="flex flex-wrap gap-2">
                                    <button type="button" @click="amount = '100'" class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-primary-100 dark:hover:bg-primary-900/50 rounded-lg text-xs font-medium text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-300 transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-primary-300 dark:hover:border-primary-600">{{ Auth::user()->s_curr }}100</button>
                                    <button type="button" @click="amount = '500'" class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-primary-100 dark:hover:bg-primary-900/50 rounded-lg text-xs font-medium text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-300 transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-primary-300 dark:hover:border-primary-600">{{ Auth::user()->s_curr }}500</button>
                                    <button type="button" @click="amount = '1000'" class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-primary-100 dark:hover:bg-primary-900/50 rounded-lg text-xs font-medium text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-300 transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-primary-300 dark:hover:border-primary-600">{{ Auth::user()->s_curr }}1000</button>
                                    <button type="button" @click="amount = Math.floor({{ Auth::user()->account_bal }})" class="px-3 py-1.5 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 rounded-lg text-xs font-medium text-white transition-all duration-200 shadow-sm hover:shadow-md">
                                        <i class="fas fa-wallet mr-1"></i>All
                                    </button>
                                </div>
                            </div>

                            <!-- Amount Info -->
                            <div class="mt-6 p-4 bg-primary-50/50 dark:bg-primary-900/20 rounded-xl border border-primary-200/50 dark:border-primary-700/50" x-show="amount && parseFloat(amount) > 0">
                                <div class="flex items-center space-x-2 mb-2">
                                    <i class="fas fa-info-circle text-primary-500 dark:text-primary-400"></i>
                                    <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Transfer Information</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Transfer amount: <span class="font-semibold text-gray-900 dark:text-white" x-text="'{{ Auth::user()->s_curr }}' + parseFloat(amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' {{ Auth::user()->curr }}'"></span></p>
                            </div>

                            <!-- Transfer Limits Info -->
                            <div class="mt-4 p-3 bg-gray-50/80 dark:bg-gray-800/80 rounded-lg border border-gray-200/50 dark:border-gray-700/50">
                                <div class="flex items-center space-x-2 mb-2">
                                    <i class="fas fa-shield-alt text-gray-500 dark:text-gray-400 text-xs"></i>
                                    <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Transfer Limits</span>
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400">
                                    <span>Minimum: <span class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format(Auth::user()->min_transfer_amount ?? 1, 2) }}</span></span>
                                    <span>Maximum: <span class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format(Auth::user()->max_transfer_amount ?? 500000, 2) }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Beneficiary Details Section -->
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center space-x-2 mb-1">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                <i class="fas fa-user text-white text-xs"></i>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Beneficiary Details</h3>
                        </div>

                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-4 space-y-4">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <!-- Beneficiary Account Name -->
                                <div class="space-y-2">
                                    <label for="accountname" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Account Holder Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-user text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="accountname"
                                            id="accountname"
                                            x-model="accountname"
                                            class="block w-full pl-10 pr-3 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-sm"
                                            placeholder="Enter full name as on bank account"
                                            required
                                        />
                                    </div>
                                </div>

                                <!-- Beneficiary Account Number -->
                                <div class="space-y-2">
                                    <label for="accountnumber" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Account Number</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-hashtag text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="accountnumber"
                                            id="accountnumber"
                                            x-model="accountnumber"
                                            class="block w-full pl-10 pr-3 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-sm"
                                            placeholder="Enter account number"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <!-- Bank Name -->
                                <div class="space-y-2">
                                    <label for="bankname" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Bank Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-university text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="bankname"
                                            id="bankname"
                                            x-model="bankname"
                                            class="block w-full pl-10 pr-3 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-sm"
                                            placeholder="Enter bank name"
                                            required
                                        />
                                    </div>
                                </div>

                                <!-- Account Type -->
                                <div class="space-y-2">
                                    <label for="Accounttype" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Account Type</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-credit-card text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <select
                                            name="Accounttype"
                                            id="Accounttype"
                                            x-model="Accounttype"
                                            class="block w-full pl-10 pr-10 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none text-gray-900 dark:text-white text-sm"
                                            required
                                        >
                                            <option value="Online Banking">Online Banking</option>
                                            <option value="Joint Account">Joint Account</option>
                                            <option value="Checking">Checking</option>
                                            <option value="Savings Account">Savings Account</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-chevron-down text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <!-- Routing Number -->
                                <div class="space-y-2">
                                    <label for="routing_number" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Routing Number</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-route text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="routing_number"
                                            id="routing_number"
                                            x-model="routing_number"
                                            class="block w-full pl-10 pr-3 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-sm"
                                            placeholder="Enter 9-digit routing number"
                                            maxlength="9"
                                        />
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">9-digit number found on your checks</p>
                                </div>

                                <!-- SWIFT Code -->
                                <div class="space-y-2">
                                    <label for="swift_code" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">SWIFT Code</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <i class="fas fa-globe text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="swift_code"
                                            id="swift_code"
                                            x-model="swift_code"
                                            class="block w-full pl-10 pr-3 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-sm"
                                            placeholder="Enter SWIFT/BIC code"
                                            maxlength="11"
                                        />
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">8-11 character bank identifier code</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center space-x-2 mb-1">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                <i class="fas fa-info-circle text-white text-xs"></i>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Additional Information</h3>
                        </div>

                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-4 space-y-4">
                            <!-- Description -->
                            <div class="space-y-2">
                                <label for="Description" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Description/Memo</label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 flex items-start pointer-events-none z-10">
                                        <i class="fas fa-comment-alt text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <textarea
                                        name="Description"
                                        id="Description"
                                        x-model="Description"
                                        class="block w-full pl-10 pr-3 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-sm"
                                        placeholder="Enter transaction description or purpose of payment (optional)"
                                        rows="2"
                                    ></textarea>
                                </div>
                            </div>

                            <!-- Transaction PIN -->
                            <div class="space-y-2">
                                <label for="pin" class="block text-xs font-semibold text-gray-700 dark:text-gray-300">Transaction PIN</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                        <i class="fas fa-lock text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <input
                                        type="password"
                                        name="pin"
                                        id="pin"
                                        x-model="pin"
                                        autocomplete="current-password"
                                        class="block w-full pl-10 pr-10 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-sm"
                                        placeholder="Enter your transaction PIN"
                                        required
                                    />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center z-10">
                                        <button
                                            type="button"
                                            class="text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none transition-colors"
                                            @click="document.getElementById('pin').type = document.getElementById('pin').type === 'password' ? 'text' : 'password'"
                                        >
                                            <i class="fas fa-eye" x-show="document.getElementById('pin').type === 'password'"></i>
                                            <i class="fas fa-eye-slash" x-show="document.getElementById('pin').type === 'text'" style="display: none;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-1 mt-2">
                                    <i class="fas fa-shield-alt text-primary-500 dark:text-primary-400 text-xs"></i>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">This is your transaction PIN, not your login password</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transfer Summary -->
                    <div x-show="amount > 0" class="bg-gradient-to-br from-primary-50/80 to-blue-50/80 dark:from-primary-900/30 dark:to-slate-800/60 backdrop-blur-sm rounded-xl border border-primary-200/50 dark:border-primary-700/50 p-4 shadow-lg mt-4">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                <i class="fas fa-receipt text-white text-xs"></i>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Transaction Summary</h3>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">Transfer Amount</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}<span x-text="parseFloat(amount || 0).toFixed(2)"></span></span>
                            </div>

                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">Payment Source</span>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-university text-blue-600 dark:text-blue-400 text-xs"></i>
                                    <span class="font-semibold text-gray-900 dark:text-white text-sm">Account Balance</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">Transfer Fee</span>
                                <div class="flex items-center space-x-1">
                                    <span class="bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 px-2 py-0.5 rounded-full text-xs font-medium">FREE</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-300 dark:border-gray-600 pt-3 mt-3">
                                <div class="flex justify-between items-center py-1">
                                    <span class="text-gray-900 dark:text-white font-bold">Total Amount</span>
                                    <span class="font-bold text-xl text-primary-700 dark:text-primary-300">{{ Auth::user()->s_curr }}<span x-text="parseFloat(amount || 0).toFixed(2)"></span></span>
                                </div>

                                <div class="flex justify-between items-center py-1 mt-1">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">Remaining Balance</span>
                                    <span class="font-semibold text-gray-900 dark:text-white text-sm">{{ Auth::user()->s_curr }}<span x-text="({{ Auth::user()->account_bal }} - parseFloat(amount || 0)).toFixed(2)"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col lg:flex-row lg:space-x-3 space-y-2 lg:space-y-0 pt-4">
                        <button
                            type="submit"
                            class="w-full lg:flex-1 inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]"
                            :disabled="!amount || !accountname || !accountnumber || !bankname || !pin"
                            :class="{ 'opacity-60 cursor-not-allowed hover:scale-100': !amount || !accountname || !accountnumber || !bankname || !pin }"
                        >
                            <i class="fas fa-eye mr-2"></i>
                            Preview Transfer
                        </button>
                        <button
                            type="button"
                            @click="window.dispatchEvent(new CustomEvent('show-beneficiary-form'))"
                            :disabled="!accountname || !accountnumber || !bankname"
                            class="w-full lg:w-auto inline-flex items-center justify-center px-6 py-3 border border-blue-300 dark:border-blue-600 rounded-xl shadow-sm text-base font-semibold text-blue-700 dark:text-blue-300 bg-blue-50/70 dark:bg-blue-900/20 backdrop-blur-sm hover:bg-blue-100 dark:hover:bg-blue-900/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            :class="{ 'opacity-50 cursor-not-allowed': !accountname || !accountnumber || !bankname }"
                        >
                            <i class="fas fa-bookmark mr-2"></i>
                            Save Beneficiary
                        </button>
                        <a
                            href="{{ route('dashboard') }}"
                            class="w-full lg:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-base font-semibold text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300"
                        >
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </form>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="mt-4 p-4 border border-gray-200/50 dark:border-gray-700/50 rounded-xl bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-lg">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-1">Bank-Level Security</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs leading-relaxed mb-3">
                            All transfers are protected with 256-bit SSL encryption and processed through secure banking channels.
                            Your financial information is never stored on our servers and all transactions are monitored for fraud protection.
                        </p>
                        <div class="flex flex-wrap items-center gap-4">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-lock text-green-500 text-xs"></i>
                                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">SSL Encrypted</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-eye-slash text-green-500 text-xs"></i>
                                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Zero Data Storage</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock text-green-500 text-xs"></i>
                                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">24/7 Monitoring</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Modal -->
    <div
        x-show="showPreview"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div
                class="fixed inset-0 transition-opacity bg-gray-900/75 backdrop-blur-sm"
                aria-hidden="true"
                @click="showPreview = false"
            ></div>

            <!-- Modal panel -->
            <div
                class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 sm:align-middle sm:max-w-lg"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <!-- Modal header -->
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                            <i class="fas fa-file-check text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Confirm Transfer</h3>
                    </div>
                    <button
                        type="button"
                        class="text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none transition-colors"
                        @click="showPreview = false"
                    >
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <!-- Modal content -->
                <div class="space-y-6">
                    <!-- Transfer summary -->
                    <div class="bg-gradient-to-br from-gray-50/80 to-white/80 dark:from-gray-700/50 dark:to-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-600/50">
                        <div class="flex items-center space-x-3 mb-4 pb-3 border-b border-gray-200 dark:border-gray-600">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                <i class="fas fa-receipt text-white text-sm"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Transfer Summary</h4>
                        </div>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Transfer Amount</span>
                                <span class="font-bold text-gray-900 dark:text-white text-lg">{{ Auth::user()->s_curr }}<span x-text="parseFloat(amount).toFixed(2)"></span></span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Recipient</span>
                                <span class="font-semibold text-gray-900 dark:text-white" x-text="accountname"></span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Account Number</span>
                                <span class="font-semibold text-gray-900 dark:text-white font-mono" x-text="accountnumber"></span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Bank</span>
                                <span class="font-semibold text-gray-900 dark:text-white" x-text="bankname"></span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Account Type</span>
                                <span class="font-semibold text-gray-900 dark:text-white" x-text="Accounttype"></span>
                            </div>

                            <div class="flex justify-between items-center" x-show="routing_number && routing_number.trim() !== ''">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Routing Number</span>
                                <span class="font-semibold text-gray-900 dark:text-white font-mono" x-text="routing_number"></span>
                            </div>

                            <div class="flex justify-between items-center" x-show="swift_code && swift_code.trim() !== ''">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">SWIFT Code</span>
                                <span class="font-semibold text-gray-900 dark:text-white font-mono" x-text="swift_code"></span>
                            </div>

                            <div class="flex justify-between items-center" x-show="Description && Description.trim() !== ''">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Description</span>
                                <span class="font-semibold text-gray-900 dark:text-white" x-text="Description"></span>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-600 pt-4 mt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-900 dark:text-white font-bold text-lg">Total Amount</span>
                                    <span class="font-bold text-2xl text-primary-600 dark:text-primary-400">{{ Auth::user()->s_curr }}<span x-text="parseFloat(amount).toFixed(2)"></span></span>
                                </div>

                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-gray-600 dark:text-gray-400 font-medium">Remaining Balance</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}<span x-text="({{ Auth::user()->account_bal }} - parseFloat(amount)).toFixed(2)"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security notice -->
                    <div class="flex items-start p-4 bg-amber-50/80 dark:bg-amber-900/20 border-l-4 border-amber-400 dark:border-amber-500 rounded-r-xl backdrop-blur-sm">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-amber-600 dark:text-amber-400"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h5 class="font-semibold text-amber-800 dark:text-amber-200 mb-1">Important Notice</h5>
                            <p class="text-amber-700 dark:text-amber-300 text-sm">
                                Please verify all transfer details carefully before proceeding. Once confirmed, transfers cannot be reversed.
                            </p>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-col-reverse sm:flex-row sm:space-x-4">
                        <button
                            type="button"
                            class="w-full mt-3 sm:mt-0 inline-flex justify-center items-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-base font-semibold text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200"
                            @click="showPreview = false"
                        >
                            <i class="fas fa-times mr-2 text-gray-400 dark:text-gray-500"></i>
                            Cancel
                        </button>

                        <form action="{{ route('localtransfer') }}" method="POST" class="w-full" id="confirmTransferForm">
                            @csrf
                            <input type="hidden" name="amount" :value="amount">
                            <input type="hidden" name="accountname" :value="accountname">
                            <input type="hidden" name="accountnumber" :value="accountnumber">
                            <input type="hidden" name="bankname" :value="bankname">
                            <input type="hidden" name="Accounttype" :value="Accounttype">
                            <input type="hidden" name="routing_number" :value="routing_number">
                            <input type="hidden" name="swift_code" :value="swift_code">
                            <input type="hidden" name="Description" :value="Description">
                            <input type="hidden" name="pin" :value="pin">
                            <input type="hidden" name="balance_type" value="fiat">

                            <button
                                type="button"
                                id="confirmTransferBtn"
                                class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]"
                            >
                                <i class="fas fa-check-circle mr-2"></i>
                                Confirm Transfer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

<!-- Processing Modal (Hidden by default) -->
<div id="processingModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900/75 backdrop-blur-sm"></div>

        <!-- Modal panel -->
        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 sm:align-middle sm:max-w-lg">
            <!-- Processing animation and content -->
            <div class="text-center py-6">
                <!-- Animated bank card with pulse effect -->
                <div class="relative mx-auto w-64 h-40 mb-8 perspective-500">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500 to-primary-700 rounded-xl shadow-lg transform rotate-y-10 rotate-x-5 animate-card-float">
                        <!-- Card chip -->
                        <div class="absolute top-6 left-6 w-10 h-8 bg-yellow-300 bg-opacity-80 rounded-md grid grid-cols-3 grid-rows-3 gap-px p-1">
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                        </div>

                        <!-- Animated pulse circles -->
                        <div class="absolute bottom-6 right-8 w-8 h-8 rounded-full bg-blue-400 bg-opacity-70 flex items-center justify-center">
                            <div class="absolute w-full h-full rounded-full bg-blue-400 animate-ping opacity-75"></div>
                            <div class="absolute w-8 h-8 rounded-full border-2 border-white border-opacity-50"></div>
                            <div class="absolute w-6 h-6 rounded-full border-2 border-white border-opacity-50"></div>
                        </div>

                        <!-- Card number dots -->
                        <div class="absolute bottom-14 left-6 right-6 flex justify-between">
                            <div class="w-10 h-2 bg-white bg-opacity-50 rounded-full"></div>
                            <div class="w-10 h-2 bg-white bg-opacity-50 rounded-full"></div>
                            <div class="w-10 h-2 bg-white bg-opacity-50 rounded-full"></div>
                            <div class="w-10 h-2 bg-white bg-opacity-50 rounded-full"></div>
                        </div>

                        <!-- Card holder info -->
                        <div class="absolute bottom-6 left-6 text-white text-opacity-80 text-xs font-medium tracking-wider">
                            <span id="cardHolderName"></span>
                        </div>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" id="processingMessage">Initiating transfer...</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Please do not close this window</p>

                <!-- Progress bar with percentage -->
                <div class="mb-6">
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                        <div id="progressBar" class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-300 ease-out" style="width: 0%"></div>
                    </div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-2"><span id="progressPercentage">0</span>% Complete</p>
                </div>

                <!-- Transaction details -->
                <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm rounded-xl p-4 text-left border border-gray-200/50 dark:border-gray-600/50 mb-4">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Amount</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}<span id="modalAmount"></span></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">To</p>
                            <p class="font-medium text-gray-900 dark:text-white" id="modalRecipient"></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Bank</p>
                            <p class="font-medium text-gray-900 dark:text-white" id="modalBank"></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Account</p>
                            <p class="font-medium text-gray-900 dark:text-white" id="modalAccount"></p>
                        </div>
                    </div>
                </div>

                <!-- Security message -->
                <div class="flex items-center justify-center text-sm text-gray-500 dark:text-gray-400">
                    <i class="fas fa-shield-alt mr-2 text-primary-500 dark:text-primary-400"></i>
                    <span>Secured by bank-level encryption</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Account Status Modal (Hidden by default) -->
<div id="accountStatusModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900/75 backdrop-blur-sm"></div>

        <!-- Modal panel -->
        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 sm:align-middle sm:max-w-lg">
            <div class="text-center py-6">
                <div class="mx-auto w-16 h-16 mb-6 flex items-center justify-center rounded-2xl bg-amber-100 dark:bg-amber-900/50">
                    <i class="fas fa-exclamation-circle text-2xl text-amber-600 dark:text-amber-400"></i>
                </div>

                <h3 id="accountStatusTitle" class="text-xl font-bold text-gray-900 dark:text-white mb-2">Account Status</h3>
                <p id="accountStatusMessage" class="text-gray-500 dark:text-gray-400 mb-6">Your account status requires attention.</p>

                <div class="mt-6">
                    <button type="button" onclick="window.location.href='{{ route('dashboard') }}'" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-semibold rounded-xl shadow-lg text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                        <i class="fas fa-home mr-2"></i>
                        Return to Dashboard
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }

    .perspective-500 {
        perspective: 500px;
    }

    .rotate-y-10 {
        transform: rotateY(10deg);
    }

    .rotate-x-5 {
        transform: rotateX(5deg);
    }

    @keyframes card-float {
        0%, 100% { transform: translateY(0) rotateY(10deg) rotateX(5deg); }
        50% { transform: translateY(-10px) rotateY(15deg) rotateX(5deg); }
    }

    .animate-card-float {
        animation: card-float 3s ease-in-out infinite;
    }
</style>

<script>
    // Function to show account status modal
    function showAccountStatusModal(status, message) {
        // Get modal element
        const statusModal = document.getElementById('accountStatusModal');

        // Set modal content based on status
        const statusColor = status === 'on-hold' ? 'amber' : 'red';
        const statusIcon = status === 'on-hold' ? 'alert-circle' : 'shield-off';
        const statusTitle = status === 'on-hold' ? 'Account On Hold' : 'Account Suspended';

        // Update icon container color
        const iconContainer = statusModal.querySelector('.rounded-full');
        if (status === 'on-hold') {
            iconContainer.className = 'mx-auto w-16 h-16 mb-6 flex items-center justify-center rounded-full bg-amber-100';
        } else {
            iconContainer.className = 'mx-auto w-16 h-16 mb-6 flex items-center justify-center rounded-full bg-red-100';
        }

        // Update icon
        const icon = statusModal.querySelector('.fas');
        if (status === 'on-hold') {
            icon.className = 'fas fa-exclamation-circle text-2xl text-amber-600 dark:text-amber-400';
        } else {
            icon.className = 'fas fa-ban text-2xl text-red-600 dark:text-red-400';
        }

        // Update text content
        statusModal.querySelector('#accountStatusTitle').textContent = statusTitle;
        statusModal.querySelector('#accountStatusMessage').textContent = message;

        // Show modal
        statusModal.classList.remove('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {

        // Get DOM elements
        const confirmBtn = document.getElementById('confirmTransferBtn');
        const transferForm = document.getElementById('transferForm');
        const processingModal = document.getElementById('processingModal');
        const progressBar = document.getElementById('progressBar');
        const processingMessage = document.getElementById('processingMessage');

        // Processing messages for different stages
        const processingMessages = [
            'Initiating transfer...',
            'Verifying account details...',
            'Processing transaction...',
            'Confirming with bank...',
            'Finalizing transfer...'
        ];

        // Add click event listener to confirm button
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Get form data for display in modal
                const amountInput = document.querySelector('[name="amount"]');
                const accountnameInput = document.querySelector('[name="accountname"]');
                const accountnumberInput = document.querySelector('[name="accountnumber"]');
                const banknameInput = document.querySelector('[name="bankname"]');

                // Update modal with form data
                document.getElementById('modalAmount').textContent = parseFloat(amountInput.value).toFixed(2);
                document.getElementById('modalRecipient').textContent = accountnameInput.value;
                document.getElementById('modalBank').textContent = banknameInput.value;
                document.getElementById('modalAccount').textContent = accountnumberInput.value;
                document.getElementById('cardHolderName').textContent = accountnameInput.value.substring(0, 20);

                // Show processing modal
                processingModal.classList.remove('hidden');

                // Reset progress
                let progress = 0;
                let currentStage = 0;
                progressBar.style.width = '0%';
                processingMessage.textContent = processingMessages[0];

                // Simulate processing with progress updates
                const totalDuration = 5000; // 5 seconds minimum
                const interval = 50; // Update every 50ms for smooth animation
                const steps = totalDuration / interval;
                const progressIncrement = 100 / steps;

                const progressInterval = setInterval(function() {
                    progress += progressIncrement;
                    progressBar.style.width = progress + '%';
                    document.getElementById('progressPercentage').textContent = Math.min(Math.round(progress), 100);

                    // Update message at certain progress points
                    if (progress >= 20 && currentStage < 1) {
                        currentStage = 1;
                        processingMessage.textContent = processingMessages[1];
                    } else if (progress >= 40 && currentStage < 2) {
                        currentStage = 2;
                        processingMessage.textContent = processingMessages[2];
                    } else if (progress >= 60 && currentStage < 3) {
                        currentStage = 3;
                        processingMessage.textContent = processingMessages[3];
                    } else if (progress >= 80 && currentStage < 4) {
                        currentStage = 4;
                        processingMessage.textContent = processingMessages[4];
                    }

                    // When progress is complete
                    if (progress >= 100) {
                        clearInterval(progressInterval);

                        // Check account status before submitting the form
                        fetch('{{ route("check.account.status") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ check_status: true }),
                            credentials: 'same-origin'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'on-hold' || data.status === 'suspended') {
                                // Hide processing modal
                                processingModal.classList.add('hidden');

                                // Show account status modal
                                showAccountStatusModal(data.status, data.message);
                            } else {
                                // Account is active, proceed with form submission
                                setTimeout(function() {
                                    // Ensure form is submitted as POST
                                    const form = document.getElementById('confirmTransferForm');
                                    form.method = 'post';
                                    form.submit();
                                }, 200);
                            }
                        })
                        .catch(error => {
                            console.error('Error checking account status:', error);
                            // Proceed with form submission anyway if there's an error checking status
                            setTimeout(function() {
                                const form = document.getElementById('confirmTransferForm');
                                form.method = 'post';
                                form.submit();
                            }, 200);
                        });
                    }
                }, interval);
            });
        }
    });
</script>

@endsection
