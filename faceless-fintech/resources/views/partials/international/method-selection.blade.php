{{-- resources/views/partials/international/method-selection.blade.php --}}

<script>
// Make quickTransfer function available globally for international transfers
function quickTransfer() {
    return {
        beneficiaries: [],
        loading: false,
        showBeneficiaryForm: false,
        beneficiaryName: '',
        beneficiaryIsFavorite: false,
        savingBeneficiary: false,
        transferType: 'international',
        methodType: '',
        currentFormData: null,

        init() {
            this.loadBeneficiaries();
            
            // Listen for show beneficiary form event on window
            window.addEventListener('show-beneficiary-form', (event) => {
                this.showBeneficiaryForm = true;
                
                // Store the form data passed from the parent component
                if (event.detail) {
                    this.currentFormData = event.detail;
                }
                
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
                    const errorMessage = data.errors ? Object.values(data.errors).flat().join(', ') : (data.message || 'Unknown error');
                    this.showNotification('Error saving beneficiary: ' + errorMessage, 'error');
                }
            } catch (error) {
                console.error('Error saving beneficiary:', error);
                this.showNotification('Error saving beneficiary', 'error');
            } finally {
                this.savingBeneficiary = false;
            }
        },

        getCurrentFormData() {
            // Use the form data passed from the parent component via the event
            if (this.currentFormData) {
                return this.currentFormData;
            }
            
            return {};
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

<div
    @beneficiary-selected="handleBeneficiarySelection($event.detail)"
    x-data="{ 
        withdrawMethod: '{{ request()->input("method") == "cryptocurrency" ? "Cryptocurrency" : "" }}',
        amount: '',
        accountName: '',
        accountNumber: '',
        bankName: '',
        bankAddress: '',
        accountType: 'Online Banking',
        country: '',
        swiftCode: '',
        iban: '',
        pin: '',
        description: '',
        cryptoCurrency: 'BTC',
        cryptoNetwork: 'Native',
        walletAddress: '',
        paypalEmail: '',
        wiseFullName: '',
        wiseEmail: '',
        wiseCountry: '',
        skrillEmail: '',
        skrillFullName: '',
        venmoUsername: '',
        venmoPhone: '',
        zelleEmail: '',
        zellePhone: '',
        zelleName: '',
        balanceType: 'fiat',
        
        // Get balance type based on selected method
        getBalanceTypeForMethod() {
            return this.withdrawMethod === 'Cryptocurrency' ? 'btc' : 'fiat';
        },
        
        // Check if method supports balance type selection
        shouldShowBalanceSelection() {
            return false; // We'll handle this with conditional rendering
        },
        cashAppTag: '',
        cashAppFullName: '',
        revolutFullName: '',
        revolutEmail: '',
        revolutPhone: '',
        alipayId: '',
        alipayFullName: '',
        wechatId: '',
        wechatName: '',
        formTitle: 'International Wire Transfer',
        formDescription: 'Funds will reflect in the Beneficiary Account within 72hours.',
        isSubmitting: false,
        showPreview: false,
        showMoreMethods: false,
        
        changeMethod() {
            // Hide all method-specific fields first by not setting a method
            this.resetRequiredFields();
            
            // Set balance type based on method
            this.balanceType = this.getBalanceTypeForMethod();
            
            // Set the appropriate title and description based on selected method
            switch(this.withdrawMethod) {
                case 'Wire Transfer':
                    this.formTitle = 'International Wire Transfer';
                    this.formDescription = '';
                    break;
                case 'Cryptocurrency':
                    this.formTitle = 'Cryptocurrency Withdrawal';
                    this.formDescription = 'Withdrawals are typically processed within 1-3 hours.';
                    break;
                case 'PayPal':
                    this.formTitle = 'PayPal Withdrawal';
                    this.formDescription = 'Funds will be sent to your PayPal account within 24 hours.';
                    break;
                case 'Wise Transfer':
                    this.formTitle = 'Wise Transfer Withdrawal';
                    this.formDescription = 'Your funds will be processed within 1-2 business days.';
                    break;
                case 'Skrill':
                    this.formTitle = 'Skrill Withdrawal';
                    this.formDescription = 'Withdrawals to Skrill are processed within 24 hours.';
                    break;
                case 'Venmo':
                    this.formTitle = 'Venmo Withdrawal';
                    this.formDescription = 'Funds will be transferred to your Venmo account within 24 hours.';
                    break;
                case 'Zelle':
                    this.formTitle = 'Zelle Withdrawal';
                    this.formDescription = 'Funds will be sent to your Zelle account typically within a few hours.';
                    break;
                case 'Cash App':
                    this.formTitle = 'Cash App Withdrawal';
                    this.formDescription = 'Withdrawals to Cash App are typically processed within 24 hours.';
                    break;
                case 'Revolut':
                    this.formTitle = 'Revolut Withdrawal';
                    this.formDescription = 'Funds will be transferred to your Revolut account within 1-2 business days.';
                    break;
                case 'Alipay':
                    this.formTitle = 'Alipay Withdrawal';
                    this.formDescription = 'Withdrawals to Alipay are typically processed within 24-48 hours.';
                    break;
                case 'WeChat Pay':
                    this.formTitle = 'WeChat Pay Withdrawal';
                    this.formDescription = 'Funds will be sent to your WeChat Pay account within 24-48 hours.';
                    break;
                default:
                    this.formTitle = 'Select a Withdrawal Method';
                    this.formDescription = 'Please select a withdrawal method to proceed.';
            }
        },
        
        resetRequiredFields() {
            // This method is used to handle the required attributes in the Alpine.js context
            // In practice, HTML5 validation will handle required fields based on visible elements
        },
        
        validateAmount() {
            const maxBalance = this.balanceType === 'fiat' ? {{ Auth::user()->account_bal }} : {{ Auth::user()->btc_balance ?? 0 }};
            if (this.amount > maxBalance) {
                this.amount = maxBalance;
            }
        },
        
        previewTransfer() {
            if (this.amount > 0 && this.withdrawMethod !== '') {
                this.showPreview = true;
            }
        },
        
        submitForm() {
            // Don't set isSubmitting, just show our custom modal
            if (typeof window.showProcessingModal === 'function') {
                window.showProcessingModal();
            }
        },

        // Handle beneficiary selection for international transfers
        handleBeneficiarySelection(beneficiary) {
            this.withdrawMethod = beneficiary.method_type || this.withdrawMethod;
            
            // Fill form based on method type
            switch (beneficiary.method_type) {
                case 'Wire Transfer':
                    this.accountName = beneficiary.account_name || '';
                    this.accountNumber = beneficiary.account_number || '';
                    this.bankName = beneficiary.bank_name || '';
                    this.bankAddress = beneficiary.bank_address || '';
                    this.accountType = beneficiary.account_type || 'Online Banking';
                    this.country = beneficiary.country || '';
                    this.swiftCode = beneficiary.swift_code || '';
                    this.iban = beneficiary.iban || '';
                    break;
                case 'Cryptocurrency':
                    this.cryptoCurrency = beneficiary.crypto_currency || 'BTC';
                    this.cryptoNetwork = beneficiary.crypto_network || 'Native';
                    this.walletAddress = beneficiary.wallet_address || '';
                    break;
                case 'PayPal':
                    this.paypalEmail = beneficiary.paypal_email || '';
                    break;
                case 'Wise Transfer':
                    this.wiseFullName = beneficiary.account_name || '';
                    this.wiseEmail = beneficiary.wise_email || '';
                    this.wiseCountry = beneficiary.country || '';
                    break;
                case 'Skrill':
                    this.skrillEmail = beneficiary.skrill_email || '';
                    this.skrillFullName = beneficiary.account_name || '';
                    break;
                case 'Venmo':
                    this.venmoUsername = beneficiary.venmo_username || '';
                    this.venmoPhone = beneficiary.venmo_phone || '';
                    break;
                case 'Zelle':
                    this.zelleEmail = beneficiary.zelle_email || '';
                    this.zellePhone = beneficiary.zelle_phone || '';
                    this.zelleName = beneficiary.account_name || '';
                    break;
                case 'Cash App':
                    this.cashAppTag = beneficiary.cashapp_tag || '';
                    this.cashAppFullName = beneficiary.account_name || '';
                    break;
                case 'Revolut':
                    this.revolutFullName = beneficiary.account_name || '';
                    this.revolutEmail = beneficiary.revolut_email || '';
                    this.revolutPhone = beneficiary.venmo_phone || '';
                    break;
                case 'Alipay':
                    this.alipayId = beneficiary.alipay_id || '';
                    this.alipayFullName = beneficiary.account_name || '';
                    break;
                case 'WeChat Pay':
                    this.wechatId = beneficiary.wechat_id || '';
                    this.wechatName = beneficiary.account_name || '';
                    break;
            }
            
            this.description = 'Transfer to ' + beneficiary.name;
            this.changeMethod();
        },

        // Get current form data for saving as beneficiary
        getCurrentFormData() {
            const baseData = {
                method_type: this.withdrawMethod
            };

            switch (this.withdrawMethod) {
                case 'Wire Transfer':
                    return {
                        ...baseData,
                        account_name: this.accountName,
                        account_number: this.accountNumber,
                        bank_name: this.bankName,
                        bank_address: this.bankAddress,
                        account_type: this.accountType,
                        country: this.country,
                        swift_code: this.swiftCode,
                        iban: this.iban
                    };
                case 'Cryptocurrency':
                    return {
                        ...baseData,
                        crypto_currency: this.cryptoCurrency,
                        crypto_network: this.cryptoNetwork,
                        wallet_address: this.walletAddress
                    };
                case 'PayPal':
                    return {
                        ...baseData,
                        paypal_email: this.paypalEmail
                    };
                case 'Wise Transfer':
                    return {
                        ...baseData,
                        account_name: this.wiseFullName,
                        wise_email: this.wiseEmail,
                        country: this.wiseCountry
                    };
                case 'Skrill':
                    return {
                        ...baseData,
                        skrill_email: this.skrillEmail,
                        account_name: this.skrillFullName
                    };
                case 'Venmo':
                    return {
                        ...baseData,
                        venmo_username: this.venmoUsername,
                        venmo_phone: this.venmoPhone
                    };
                case 'Zelle':
                    return {
                        ...baseData,
                        zelle_email: this.zelleEmail,
                        zelle_phone: this.zellePhone,
                        account_name: this.zelleName
                    };
                case 'Cash App':
                    return {
                        ...baseData,
                        cashapp_tag: this.cashAppTag,
                        account_name: this.cashAppFullName
                    };
                case 'Revolut':
                    return {
                        ...baseData,
                        account_name: this.revolutFullName,
                        revolut_email: this.revolutEmail,
                        venmo_phone: this.revolutPhone
                    };
                case 'Alipay':
                    return {
                        ...baseData,
                        alipay_id: this.alipayId,
                        account_name: this.alipayFullName
                    };
                case 'WeChat Pay':
                    return {
                        ...baseData,
                        wechat_id: this.wechatId,
                        account_name: this.wechatName
                    };
                default:
                    return baseData;
            }
        },

        // Check if required fields are filled for the current method
        hasRequiredFieldsForMethod() {
            switch (this.withdrawMethod) {
                case 'Wire Transfer':
                    return this.accountName && this.accountNumber && this.bankName && this.bankAddress;
                case 'Cryptocurrency':
                    return this.cryptoCurrency && this.cryptoNetwork && this.walletAddress;
                case 'PayPal':
                    return this.paypalEmail;
                case 'Wise Transfer':
                    return this.wiseFullName && this.wiseEmail && this.wiseCountry;
                case 'Skrill':
                    return this.skrillEmail && this.skrillFullName;
                case 'Venmo':
                    return this.venmoUsername && this.venmoPhone;
                case 'Zelle':
                    return this.zelleEmail && this.zellePhone && this.zelleName;
                case 'Cash App':
                    return this.cashAppTag && this.cashAppFullName;
                case 'Revolut':
                    return this.revolutFullName && this.revolutEmail && this.revolutPhone;
                case 'Alipay':
                    return this.alipayId && this.alipayFullName;
                case 'WeChat Pay':
                    return this.wechatId && this.wechatName;
                default:
                    return false;
            }
        }
    }"
    x-init="
        if (withdrawMethod === 'Cryptocurrency') {
            changeMethod();
            setTimeout(() => {
                localStorage.removeItem('select_crypto');
            }, 500);
        }
    "
    class="p-4 space-y-4"
>
    <!-- Alerts -->
    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />

    <!-- Mobile Header -->
    <div class="lg:hidden mb-2">
        @include('partials._mobile_header', [
            'title' => 'International Transfer',
            'showBackButton' => true,
            'backUrl' => route('dashboard'),
            'showNotifications' => true,
            'showDarkMode' => true,
            'financeUser' => Auth::user()
        ])
    </div>

    <!-- Desktop Header -->
    <div class="hidden lg:block mb-4">
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center">
                        <i class="fa-solid fa-globe text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">International Transfer</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Send money worldwide with multiple payment methods</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Card Container -->
    <div class="max-w-8xl mx-auto">
        <!-- Quick Transfer Component for International -->
        <div x-show="withdrawMethod && withdrawMethod !== ''" class="mb-6">
            <div x-data="quickTransfer()" x-init="loadBeneficiaries()">
                @include('partials.quick-transfer', ['transferType' => 'international'])
            </div>
        </div>
        
        <!-- Method Selection Cards -->
        <div class="mb-6" x-show="!withdrawMethod">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Select Transfer Method</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-3">
                <!-- Wire Transfer -->
                <div @click="withdrawMethod = 'Wire Transfer'; changeMethod()" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
                    <div class="flex items-center mb-2">
                        <div class="h-8 w-8 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="fa-solid fa-building-columns text-blue-600 dark:text-blue-400 text-sm"></i>
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Wire Transfer</h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Transfer funds directly to international bank accounts.</p>
                </div>
                
                <!-- Cryptocurrency -->
                <div id="crypto" @click="withdrawMethod = 'Cryptocurrency'; changeMethod()" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
                    <div class="flex items-center mb-2">
                        <div class="h-8 w-8 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="fa-brands fa-bitcoin text-amber-600 dark:text-amber-400 text-sm"></i>
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Cryptocurrency</h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Send funds to your cryptocurrency wallet.</p>
                </div>
                
                <!-- PayPal -->
                <div @click="withdrawMethod = 'PayPal'; changeMethod()" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
                    <div class="flex items-center mb-2">
                        <div class="h-8 w-8 rounded-xl bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                            <i class="fa-brands fa-paypal text-indigo-600 dark:text-indigo-400 text-sm"></i>
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">PayPal</h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Transfer funds to your PayPal account.</p>
                </div>
                
                <!-- Wise Transfer -->
                <div @click="withdrawMethod = 'Wise Transfer'; changeMethod()" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
                    <div class="flex items-center mb-2">
                        <div class="h-8 w-8 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <i class="fa-solid fa-money-bill-transfer text-green-600 dark:text-green-400 text-sm"></i>
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Wise Transfer</h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Transfer with lower fees using Wise.</p>
                </div> 
                
                <!-- Cash App -->
                <div @click="withdrawMethod = 'Cash App'; changeMethod()" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
                    <div class="flex items-center mb-2">
                        <div class="h-8 w-8 rounded-xl bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center">
                            <i class="fa-solid fa-dollar-sign text-pink-600 dark:text-pink-400 text-sm"></i>
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">Cash App</h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Quick transfers to your Cash App account.</p>
                </div> 
                
                <!-- More Options -->
                <div @click="showMoreMethods = true; withdrawMethod = ''" class="cursor-pointer bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-white/20 dark:border-gray-700/50 p-3 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all">
                    <div class="flex items-center mb-2">
                        <div class="h-8 w-8 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                           <i class="fa-solid fa-ellipsis text-amber-600 dark:text-amber-400 text-sm"></i>
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900 dark:text-white text-sm">More Options</h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Zelle, Venmo, Revolut, and more.</p>
                </div> 
            </div>
        </div>

        {{-- Include "More Methods" and "Transfer Form" partials --}}
        @include('partials.international.more-methods')
        @include('partials.international.transfer-form')
    </div>

    {{-- Include security notice, modals, styles, and scripts --}}
    @include('partials.international.modals-and-scripts')
</div>