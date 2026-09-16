{{-- resources/views/partials/international/transfer-form.blade.php --}}
<div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden" x-show="withdrawMethod && !showMoreMethods">
    <!-- Card Header with Method Icon -->
    <div class="relative bg-gradient-to-r from-primary-600 to-primary-700 dark:from-primary-500 dark:to-primary-600 p-6">
        <!-- Back Button -->
        <button 
            @click="withdrawMethod = ''" 
            class="absolute top-4 left-4 bg-white/20 dark:bg-white/10 rounded-full p-2 text-white hover:bg-white/30 dark:hover:bg-white/20 transition-colors"
        >
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </button>
        
        <div class="flex flex-col items-center">
            <div class="bg-white/20 dark:bg-white/10 backdrop-blur-sm p-3 rounded-2xl mb-3">
                <template x-if="withdrawMethod === 'Wire Transfer'">
                    <i class="fa-solid fa-building-columns text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'Cryptocurrency'">
                    <i class="fa-brands fa-bitcoin text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'PayPal'">
                    <i class="fa-brands fa-paypal text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'Wise Transfer'">
                    <i class="fa-solid fa-money-bill-transfer text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'Skrill'">
                    <i class="fa-solid fa-wallet text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'Venmo'">
                    <i class="fa-solid fa-mobile-screen text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'Zelle'">
                    <i class="fa-solid fa-bolt text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'Cash App'">
                    <i class="fa-solid fa-dollar-sign text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'Revolut'">
                    <i class="fa-solid fa-credit-card text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'Alipay'">
                    <i class="fa-solid fa-mobile-screen-button text-white text-2xl"></i>
                </template>
                <template x-if="withdrawMethod === 'WeChat Pay'">
                    <i class="fa-brands fa-weixin text-white text-2xl"></i>
                </template>
            </div>
            <h2 class="text-xl font-bold text-white" x-text="formTitle">International Wire Transfer</h2>
            <p class="text-white/80 mt-1 text-center text-sm" x-text="formDescription">Funds will reflect in the Beneficiary Account within 72hours.</p>
        </div>
    </div>

    <!-- Form Content -->
    <div class="p-4 space-y-4">
        <form action="{{ route('internationaltransfer') }}" method="post" id="internationalTransferForm" @submit.prevent="previewTransfer()">
            @csrf
            <input type="hidden" name="withdrawMethod" :value="withdrawMethod">

            <!-- Balance Display (Method-specific) -->
            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Available Balance</label>
                
                <!-- Fiat Balance Display (for non-crypto methods) -->
                <div x-show="withdrawMethod !== 'Cryptocurrency'" class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-primary-500 ring-2 ring-primary-200 dark:ring-primary-800 p-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center bg-blue-100 dark:bg-blue-900/30 mr-3">
                            <i class="fa-solid fa-building-columns text-blue-600 dark:text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Account Balance</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format(Auth::user()->account_bal, 2, '.', ',') }}</p>
                        </div>
                        <div class="ml-auto">
                            <div class="w-5 h-5 rounded-full border-2 bg-primary-500 border-primary-500 flex items-center justify-center">
                                <i class="fa-solid fa-check text-white text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bitcoin Balance Display (for crypto method only) -->
                <div x-show="withdrawMethod === 'Cryptocurrency'" class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-primary-500 ring-2 ring-primary-200 dark:ring-primary-800 p-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center bg-amber-100 dark:bg-amber-900/30 mr-3">
                            <i class="fa-brands fa-bitcoin text-amber-600 dark:text-amber-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Bitcoin Balance</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format(Auth::user()->btc_balance ?? 0, 8, '.', ',') }} BTC</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">≈ {{ Auth::user()->s_curr }}{{ number_format((Auth::user()->btc_balance ?? 0) * $btc_rate, 2, '.', ',') }}</p>
                        </div>
                        <div class="ml-auto">
                            <div class="w-5 h-5 rounded-full border-2 bg-primary-500 border-primary-500 flex items-center justify-center">
                                <i class="fa-solid fa-check text-white text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hidden input to pass the balance type to the controller -->
                <input type="hidden" name="balance_type" x-model="balanceType">
            </div>

            <!-- Amount Input with Currency (Enhanced) -->
            <div class="mb-4 bg-gradient-to-br from-gray-50 to-white dark:from-gray-800/50 dark:to-gray-700/50 p-4 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                <label for="amount" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Amount to Transfer</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="text-gray-500 text-lg font-bold" x-text="withdrawMethod === 'Cryptocurrency' ? '' : '{{ Auth::user()->s_curr }}'"></span>
                    </div>
                    <input 
                        type="number" 
                        name="amount" 
                        id="amount" 
                        x-model="amount"
                        @input="validateAmount()"
                        :min="withdrawMethod === 'Cryptocurrency' ? '0.00000001' : '1'" 
                        :max="withdrawMethod === 'Cryptocurrency' ? {{ Auth::user()->btc_balance ?? 0 }} : {{ Auth::user()->account_bal }}"
                        :step="withdrawMethod === 'Cryptocurrency' ? '0.00000001' : '0.01'"
                        class="block w-full pl-12 pr-20 py-3 border-2 border-primary-100 dark:border-primary-800 rounded-lg bg-white dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-xl font-bold"
                        :placeholder="withdrawMethod === 'Cryptocurrency' ? '0.00000000' : '0.00'"
                        required
                    />
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-lg font-bold text-gray-400 pointer-events-none" x-text="withdrawMethod === 'Cryptocurrency' ? 'BTC' : ''"></div>
                </div>
                <div class="mt-2 flex items-center justify-between">
                    <!-- Quick Amount Buttons -->
                    <div class="flex space-x-2">
                        <template x-if="withdrawMethod !== 'Cryptocurrency'">
                            <div class="flex space-x-2">
                                <button type="button" @click="amount = '100'" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 transition-colors">{{ Auth::user()->s_curr }}100</button>
                                <button type="button" @click="amount = '500'" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 transition-colors">{{ Auth::user()->s_curr }}500</button>
                                <button type="button" @click="amount = '1000'" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 transition-colors">{{ Auth::user()->s_curr }}1000</button>
                                <button type="button" @click="amount = {{ Auth::user()->account_bal }}" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 transition-colors">Max</button>
                            </div>
                        </template>
                        <template x-if="withdrawMethod === 'Cryptocurrency'">
                            <div class="flex space-x-2">
                                <button type="button" @click="amount = '0.001'" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 transition-colors">0.001 BTC</button>
                                <button type="button" @click="amount = '0.01'" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 transition-colors">0.01 BTC</button>
                                <button type="button" @click="amount = '0.1'" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 transition-colors">0.1 BTC</button>
                                <button type="button" @click="amount = {{ Auth::user()->btc_balance ?? 0 }}" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 transition-colors">Max</button>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Conversion Preview -->
                <div class="mt-3 text-xs text-gray-600 dark:text-gray-400" x-show="amount && parseFloat(amount) > 0">

                <!-- Transfer Limits Info for Fiat -->
                <template x-if="withdrawMethod !== 'Cryptocurrency'">
                    <div class="mt-3 p-3 bg-gray-50/80 dark:bg-gray-800/80 rounded-lg border border-gray-200/50 dark:border-gray-700/50">
                        <div class="flex items-center space-x-2 mb-2">
                            <i class="fas fa-shield-alt text-gray-500 dark:text-gray-400 text-xs"></i>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Transfer Limits</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400">
                            <span>Minimum: <span class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format(Auth::user()->min_transfer_amount ?? 1, 2) }}</span></span>
                            <span>Maximum: <span class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format(Auth::user()->max_transfer_amount ?? 500000, 2) }}</span></span>
                        </div>
                    </div>
                </template>
                    <template x-if="withdrawMethod !== 'Cryptocurrency'">
                        <p>Equivalent: <span class="font-medium" x-text="'≈ ' + (parseFloat(amount) / {{ $btc_rate }}).toLocaleString('en-US', {minimumFractionDigits: 8, maximumFractionDigits: 8}) + ' BTC'"></span></p>
                    </template>
                    <template x-if="withdrawMethod === 'Cryptocurrency'">
                        <p>Equivalent: <span class="font-medium" x-text="'≈ {{ Auth::user()->s_curr }}' + (parseFloat(amount) * {{ $btc_rate }}).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' {{ Auth::user()->curr }}'"></span></p>
                    </template>
                </div>
            </div>
        
            <!-- WIRE TRANSFER FIELDS -->
            <div x-show="withdrawMethod === 'Wire Transfer'" x-transition class="space-y-4 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="accountname" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Beneficiary Account Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                name="accountname" 
                                id="accountname" 
                                x-model="accountName"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                placeholder="Enter beneficiary's full name"
                                x-bind:required="withdrawMethod === 'Wire Transfer'"
                            />
                        </div>
                    </div>
                    
                    <div>
                        <label for="accountnumber" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Beneficiary Account Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-hashtag text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                name="accountnumber" 
                                id="accountnumber" 
                                x-model="accountNumber"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                placeholder="Enter account number"
                                x-bind:required="withdrawMethod === 'Wire Transfer'"
                            />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="bankname" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Bank Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-building text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                name="bankname" 
                                id="bankname" 
                                x-model="bankName"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                placeholder="Enter bank name"
                                x-bind:required="withdrawMethod === 'Wire Transfer'"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="bankaddress" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Bank Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-location-dot text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                name="bankaddress" 
                                id="bankaddress" 
                                x-model="bankAddress"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                placeholder="Enter bank address"
                                x-bind:required="withdrawMethod === 'Wire Transfer'"
                            />
                        </div>
                    </div>
                </div>
     
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="Accounttype" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Account Type</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-list text-gray-400 text-sm"></i>
                            </div>
                            <select 
                                name="Accounttype" 
                                id="Accounttype" 
                                x-model="accountType"
                                class="block w-full pl-10 pr-8 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none text-sm"
                                x-bind:required="withdrawMethod === 'Wire Transfer'"
                            >
                                <option value="Online Banking">Online Banking</option>
                                <option value="Joint Account">Joint Account</option>
                                <option value="Checking">Checking</option>
                                <option value="Savings Account">Savings Account</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-chevron-down text-gray-400 text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="country" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-globe text-gray-400 text-sm"></i>
                            </div>
                            <div class="pl-10">
                                @include('partials.country-select', ['fieldName' => 'country', 'required' => false])
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="iban" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">IBAN Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-credit-card text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                name="iban" 
                                id="iban" 
                                x-model="iban"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                placeholder="Enter IBAN number"
                                maxlength="34"
                                x-bind:required="withdrawMethod === 'Wire Transfer'"
                            />
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">International Bank Account Number</p>
                    </div>
                    
                    <div>
                        <label for="swiftcode" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">SWIFT Code</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-globe text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                name="swiftcode" 
                                id="swiftcode" 
                                x-model="swiftCode"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                placeholder="Enter SWIFT/BIC code"
                                maxlength="11"
                                x-bind:required="withdrawMethod === 'Wire Transfer'"
                            />
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">8-11 character bank identifier code</p>
                    </div>
                </div>
            </div>
            
            <!-- CRYPTOCURRENCY FIELDS -->
            <div x-show="withdrawMethod === 'Cryptocurrency'" x-transition class="space-y-4 mt-4">
                <!-- Crypto Icon and Info -->
                <div class="flex items-center justify-center mb-4">
                    <div class="flex items-center h-16 px-4 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700 rounded-2xl">
                        <template x-if="cryptoCurrency === 'BTC'">
                            <div class="w-10 h-10 mr-4 rounded-full bg-amber-100 flex items-center justify-center">
                                <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/btc.svg" alt="Bitcoin" class="h-6 w-6">
                            </div>
                        </template>
                        <!-- If more currencies enabled, include templates here -->
                        <div>
                            <div class="flex items-center">
                                <span class="text-lg font-bold mr-2" x-text="cryptoCurrency"></span>
                                <span class="text-sm text-gray-500" x-text="cryptoNetwork"></span>
                            </div>
                            <p class="text-sm text-gray-500">Select your preferred cryptocurrency and network</p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="cryptoCurrency" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Cryptocurrency</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-brands fa-bitcoin text-gray-400 text-sm"></i>
                            </div>
                            <select 
                                name="cryptoCurrency" 
                                id="cryptoCurrency" 
                                x-model="cryptoCurrency"
                                class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none text-sm"
                                x-bind:required="withdrawMethod === 'Cryptocurrency'"
                            >
                                <option value="BTC">Bitcoin (BTC)</option>
                                <!-- Add more <option> as needed -->
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-chevron-down text-gray-400 text-sm"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="cryptoNetwork" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Network</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-network-wired text-gray-400 text-sm"></i>
                            </div>
                            <select 
                                name="cryptoNetwork" 
                                id="cryptoNetwork" 
                                x-model="cryptoNetwork"
                                class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none text-sm"
                                x-bind:required="withdrawMethod === 'Cryptocurrency'"
                            >
                                <option value="Native">Native</option>
                                <!-- Add more network options if needed -->
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-chevron-down text-gray-400 text-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Crypto Cards Display -->
                <div class="grid grid-cols-4 gap-2 mb-4">
                    <div @click="cryptoCurrency = 'BTC'" class="cursor-pointer p-2 rounded-lg border" :class="{'border-primary-500 bg-primary-50 dark:bg-primary-900/30 dark:border-primary-400': cryptoCurrency === 'BTC', 'border-gray-200 dark:border-gray-600': cryptoCurrency !== 'BTC'}">
                        <div class="flex flex-col items-center">
                            <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/btc.svg" alt="Bitcoin" class="h-8 w-8 mb-1">
                            <span class="text-xs font-medium text-gray-900 dark:text-white">BTC</span>
                        </div>
                    </div>
                    <!-- Add more currency cards as needed -->
                </div>
                
                <div>
                    <label for="walletAddress" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Wallet Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-wallet text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="walletAddress" 
                            id="walletAddress" 
                            x-model="walletAddress"
                            class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all font-mono text-sm"
                            placeholder="Enter wallet address"
                            x-bind:required="withdrawMethod === 'Cryptocurrency'"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button 
                                type="button" 
                                class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none"
                                @click="navigator.clipboard.readText().then(text => walletAddress = text)"
                            >
                                <i class="fa-solid fa-clipboard text-sm"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Wallet Address Warning -->
                    <div class="mt-2 p-3 bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 dark:border-yellow-500 rounded-r-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-triangle-exclamation text-yellow-500 dark:text-yellow-400 text-sm"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-xs text-yellow-700 dark:text-yellow-300">
                                    Double-check your wallet address. Transactions to incorrect addresses cannot be reversed.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- PAYPAL FIELDS -->
            <div x-show="withdrawMethod === 'PayPal'" x-transition class="space-y-4 mt-4">
                <div class="flex items-center justify-center mb-4">
                    <div class="flex items-center h-16 px-4 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700 rounded-2xl">
                        <div class="w-8 h-8 mr-3 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="fa-brands fa-paypal text-blue-600 dark:text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-gray-900 dark:text-white">PayPal</div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Transfer funds to your PayPal account</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="paypalEmail" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">PayPal Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="email" 
                            name="paypalEmail" 
                            id="paypalEmail" 
                            x-model="paypalEmail"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter PayPal email address"
                            x-bind:required="withdrawMethod === 'PayPal'"
                        />
                    </div>
                    
                    <!-- PayPal Email Note -->
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Please ensure this is the email address associated with your PayPal account</p>
                </div>
            </div>
        
            <!-- WISE TRANSFER FIELDS -->
            <div x-show="withdrawMethod === 'Wise Transfer'" x-transition class="space-y-6 mt-6">
                <div class="flex items-center justify-center mb-6">
                    <div class="flex items-center h-20 px-6 bg-gray-50 border border-gray-100 rounded-lg">
                        <div class="w-10 h-10 mr-4 rounded-full bg-green-100 flex items-center justify-center">
                            <i data-lucide="wallet" class="h-6 w-6 text-green-600"></i>
                        </div>
                        <div>
                            <div class="text-lg font-bold">Wise Transfer</div>
                            <p class="text-sm text-gray-500">Formerly TransferWise - Low fee international transfers</p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="wiseFullName" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                name="wiseFullName" 
                                id="wiseFullName" 
                                x-model="wiseFullName"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                placeholder="Enter your full name"
                                x-bind:required="withdrawMethod === 'Wise Transfer'"
                            />
                        </div>
                    </div>
                    
                    <div>
                        <label for="wiseEmail" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="email" 
                                name="wiseEmail" 
                                id="wiseEmail" 
                                x-model="wiseEmail"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                placeholder="Enter your email address"
                                x-bind:required="withdrawMethod === 'Wise Transfer'"
                            />
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="wiseCountry" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                    <div class="relative rounded-lg shadow-sm">
                        @include('partials.country-select', ['fieldName' => 'wiseCountry', 'required' => false])
                    </div>
                </div>
            </div>
            
            <!-- SKRILL FIELDS -->
            <div x-show="withdrawMethod === 'Skrill'" x-transition class="space-y-4 mt-4">
                <div>
                    <label for="skrillEmail" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Skrill Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="email" 
                            name="skrillEmail" 
                            id="skrillEmail" 
                            x-model="skrillEmail"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter Skrill email address"
                            x-bind:required="withdrawMethod === 'Skrill'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="skrillFullName" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="skrillFullName" 
                            id="skrillFullName" 
                            x-model="skrillFullName"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your full name"
                            x-bind:required="withdrawMethod === 'Skrill'"
                        />
                    </div>
                </div>
            </div>
            
            <!-- VENMO FIELDS -->
            <div x-show="withdrawMethod === 'Venmo'" x-transition class="space-y-4 mt-4">
                <div>
                    <label for="venmoUsername" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Venmo Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-at text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="venmoUsername" 
                            id="venmoUsername" 
                            x-model="venmoUsername"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter Venmo username"
                            x-bind:required="withdrawMethod === 'Venmo'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="venmoPhone" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-phone text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="tel" 
                            name="venmoPhone" 
                            id="venmoPhone" 
                            x-model="venmoPhone"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter phone number associated with Venmo"
                            x-bind:required="withdrawMethod === 'Venmo'"
                        />
                    </div>
                </div>
            </div>
            
            <!-- ZELLE FIELDS -->
            <div x-show="withdrawMethod === 'Zelle'" x-transition class="space-y-4 mt-4">
                <div>
                    <label for="zelleEmail" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Zelle Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="email" 
                            name="zelleEmail" 
                            id="zelleEmail" 
                            x-model="zelleEmail"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter Zelle email address"
                            x-bind:required="withdrawMethod === 'Zelle'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="zellePhone" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-phone text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="tel" 
                            name="zellePhone" 
                            id="zellePhone" 
                            x-model="zellePhone"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter phone number associated with Zelle"
                            x-bind:required="withdrawMethod === 'Zelle'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="zelleName" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="zelleName" 
                            id="zelleName" 
                            x-model="zelleName"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your full name"
                            x-bind:required="withdrawMethod === 'Zelle'"
                        />
                    </div>
                </div>
            </div>
            
            <!-- CASH APP FIELDS -->
            <div x-show="withdrawMethod === 'Cash App'" x-transition class="space-y-4 mt-4">
                <div>
                    <label for="cashAppTag" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">$Cashtag</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-dollar-sign text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="cashAppTag" 
                            id="cashAppTag" 
                            x-model="cashAppTag"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your $Cashtag"
                            x-bind:required="withdrawMethod === 'Cash App'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="cashAppFullName" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="cashAppFullName" 
                            id="cashAppFullName" 
                            x-model="cashAppFullName"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your full name"
                            x-bind:required="withdrawMethod === 'Cash App'"
                        />
                    </div>
                </div>
            </div>
            
            <!-- REVOLUT FIELDS -->
            <div x-show="withdrawMethod === 'Revolut'" x-transition class="space-y-4 mt-4">
                <div>
                    <label for="revolutFullName" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="revolutFullName" 
                            id="revolutFullName" 
                            x-model="revolutFullName"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your full name"
                            x-bind:required="withdrawMethod === 'Revolut'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="revolutEmail" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="email" 
                            name="revolutEmail" 
                            id="revolutEmail" 
                            x-model="revolutEmail"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your email address"
                            x-bind:required="withdrawMethod === 'Revolut'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="revolutPhone" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-phone text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="tel" 
                            name="revolutPhone" 
                            id="revolutPhone" 
                            x-model="revolutPhone"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter phone number associated with Revolut"
                            x-bind:required="withdrawMethod === 'Revolut'"
                        />
                    </div>
                </div>
            </div>
            
            <!-- ALIPAY FIELDS -->
            <div x-show="withdrawMethod === 'Alipay'" x-transition class="space-y-4 mt-4">
                <div>
                    <label for="alipayId" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Alipay ID</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-id-card text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="alipayId" 
                            id="alipayId" 
                            x-model="alipayId"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your Alipay ID"
                            x-bind:required="withdrawMethod === 'Alipay'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="alipayFullName" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="alipayFullName" 
                            id="alipayFullName" 
                            x-model="alipayFullName"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your full name"
                            x-bind:required="withdrawMethod === 'Alipay'"
                        />
                    </div>
                </div>
            </div>
            
            <!-- WECHAT PAY FIELDS -->
            <div x-show="withdrawMethod === 'WeChat Pay'" x-transition class="space-y-4 mt-4">
                <div>
                    <label for="wechatId" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">WeChat ID</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-id-card text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="wechatId" 
                            id="wechatId" 
                            x-model="wechatId"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your WeChat ID"
                            x-bind:required="withdrawMethod === 'WeChat Pay'"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="wechatName" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input 
                            type="text" 
                            name="wechatName" 
                            id="wechatName" 
                            x-model="wechatName"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                            placeholder="Enter your full name"
                            x-bind:required="withdrawMethod === 'WeChat Pay'"
                        />
                    </div>
                </div>
            </div>
            
            <!-- PIN INPUT - required for all methods -->
            <div class="mb-4 mt-6">
                <label for="pin_input" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Transaction PIN</label>
                <div class="relative rounded-lg">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-key text-gray-400 text-sm"></i>
                    </div>
                    <input 
                        type="password" 
                        name="pin" 
                        id="pin_input" 
                        x-model="pin"
                        pattern="[0-9]+"
                        minlength="4"
                        maxlength="10"
                        autocomplete="current-password"
                        class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                        placeholder="Enter your 4-10 digit PIN"
                        required
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button 
                            type="button" 
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none"
                            @click="document.getElementById('pin_input').type = document.getElementById('pin_input').type === 'password' ? 'text' : 'password'"
                        >
                            <i class="fa-solid fa-eye text-sm" x-show="document.getElementById('pin_input').type === 'password'"></i>
                            <i class="fa-solid fa-eye-slash text-sm" x-show="document.getElementById('pin_input').type === 'text'"></i>
                        </button>
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">This is your transaction PIN, not your login password</p>
            </div>
            
            <!-- Description/Note (Optional) -->
            <div class="mb-6">
                <label for="Description" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Note (Optional)</label>
                <div class="relative rounded-lg">
                    <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                        <i class="fa-solid fa-message text-gray-400 text-sm"></i>
                    </div>
                    <textarea 
                        name="Description" 
                        id="Description" 
                        x-model="description"
                        rows="3"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none text-sm"
                        placeholder="Optional payment description or note"
                    ></textarea>
                </div>
            </div>
            
            <!-- Transaction Details Summary -->
            <div x-show="amount > 0 && withdrawMethod !== ''" class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-800/50 dark:to-gray-700/50 rounded-2xl p-4 mb-4 border border-gray-100 dark:border-gray-700 shadow-sm">
                <div class="flex items-center mb-3">
                    <i class="fa-solid fa-clipboard-list text-primary-500 dark:text-primary-400 text-sm mr-2"></i>
                    <h3 class="text-xs font-medium text-gray-700 dark:text-gray-300">Transaction Summary</h3>
                </div>
                <div class="space-y-2">
                    <!-- Amount Row -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 dark:text-gray-400 text-xs">Amount</span>
                        <template x-if="withdrawMethod !== 'Cryptocurrency'">
                            <span class="font-medium text-gray-700 dark:text-gray-300 text-xs" x-text="amount ? '{{ Auth::user()->s_curr }}' + parseFloat(amount).toFixed(2) : '{{ Auth::user()->s_curr }}0.00'"></span>
                        </template>
                        <template x-if="withdrawMethod === 'Cryptocurrency'">
                            <span class="font-medium text-gray-700 dark:text-gray-300 text-xs" x-text="amount ? parseFloat(amount).toFixed(8) + ' BTC' : '0.00000000 BTC'"></span>
                        </template>
                    </div>
                    
                    <!-- Source Balance Row -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 dark:text-gray-400 text-xs">Source</span>
                        <template x-if="withdrawMethod !== 'Cryptocurrency'">
                            <span class="font-medium text-gray-700 dark:text-gray-300 text-xs">Account Balance</span>
                        </template>
                        <template x-if="withdrawMethod === 'Cryptocurrency'">
                            <span class="font-medium text-gray-700 dark:text-gray-300 text-xs">Bitcoin Balance</span>
                        </template>
                    </div>
                    
                    <!-- Fee Row -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 dark:text-gray-400 text-xs">Fee</span>
                        <template x-if="withdrawMethod !== 'Cryptocurrency'">
                            <span class="font-medium text-gray-700 dark:text-gray-300 text-xs">{{ Auth::user()->s_curr }}0.00</span>
                        </template>
                        <template x-if="withdrawMethod === 'Cryptocurrency'">
                            <span class="font-medium text-gray-700 dark:text-gray-300 text-xs">0.00000000 BTC</span>
                        </template>
                    </div>
                    
                    <!-- Total Row -->
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-2 mt-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 dark:text-gray-300 font-medium text-xs">Total</span>
                            <template x-if="withdrawMethod !== 'Cryptocurrency'">
                                <span class="font-bold text-sm text-gray-900 dark:text-white" x-text="amount ? '{{ Auth::user()->s_curr }}' + parseFloat(amount).toFixed(2) : '{{ Auth::user()->s_curr }}0.00'"></span>
                            </template>
                            <template x-if="withdrawMethod === 'Cryptocurrency'">
                                <span class="font-bold text-sm text-gray-900 dark:text-white" x-text="amount ? parseFloat(amount).toFixed(8) + ' BTC' : '0.00000000 BTC'"></span>
                            </template>
                        </div>
                    </div>
                    
                    <!-- New Balance Row -->
                    <div class="flex justify-between items-center pt-1">
                        <span class="font-medium text-gray-500 dark:text-gray-400 text-xs">New Balance After Transfer</span>
                        <template x-if="withdrawMethod !== 'Cryptocurrency'">
                            <span class="text-gray-900 dark:text-white text-xs" x-text="'{{ Auth::user()->s_curr }}' + ({{ Auth::user()->account_bal }} - (parseFloat(amount) || 0)).toFixed(2)"></span>
                        </template>
                        <template x-if="withdrawMethod === 'Cryptocurrency'">
                            <span class="text-gray-900 dark:text-white text-xs" x-text="({{ Auth::user()->btc_balance ?? 0 }} - (parseFloat(amount) || 0)).toFixed(8) + ' BTC'"></span>
                        </template>
                    </div>
                    
                    <!-- Equivalent Value Row (shown only when amount is entered) -->
                    <div class="flex justify-between items-center pt-1" x-show="amount && parseFloat(amount) > 0">
                        <span class="font-medium text-gray-500 dark:text-gray-400 text-xs">Equivalent Value</span>
                        <template x-if="withdrawMethod !== 'Cryptocurrency'">
                            <span class="text-gray-700 dark:text-gray-300 text-xs" x-text="'≈ ' + (parseFloat(amount) / {{ $btc_rate }}).toLocaleString('en-US', {minimumFractionDigits: 8, maximumFractionDigits: 8}) + ' BTC'"></span>
                        </template>
                        <template x-if="withdrawMethod === 'Cryptocurrency'">
                            <span class="text-gray-700 dark:text-gray-300 text-xs" x-text="'≈ {{ Auth::user()->s_curr }}' + (parseFloat(amount) * {{ $btc_rate }}).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})"></span>
                        </template>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-2 sm:space-y-0">
                <button 
                    type="button" 
                    class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition-colors"
                    @click="previewTransfer()"
                    :disabled="!withdrawMethod || !amount"
                >
                    <i class="fa-solid fa-paper-plane text-xs mr-2"></i>
                    <span>Continue to Transfer</span>
                </button>
                <button 
                    type="button"
                    @click="window.dispatchEvent(new CustomEvent('show-beneficiary-form', { 
                        detail: (function() {
                            const baseData = { method_type: withdrawMethod };
                            switch (withdrawMethod) {
                                case 'Wire Transfer':
                                    return {
                                        ...baseData,
                                        account_name: accountName,
                                        account_number: accountNumber,
                                        bank_name: bankName,
                                        bank_address: bankAddress,
                                        account_type: accountType,
                                        swift_code: swiftCode,
                                        iban: iban
                                    };
                                case 'Cryptocurrency':
                                    return {
                                        ...baseData,
                                        crypto_currency: cryptoCurrency,
                                        crypto_network: cryptoNetwork,
                                        wallet_address: walletAddress
                                    };
                                case 'PayPal':
                                    return {
                                        ...baseData,
                                        paypal_email: paypalEmail
                                    };
                                case 'Wise Transfer':
                                    return {
                                        ...baseData,
                                        account_name: wiseFullName,
                                        wise_email: wiseEmail
                                    };
                                case 'Skrill':
                                    return {
                                        ...baseData,
                                        skrill_email: skrillEmail,
                                        account_name: skrillFullName
                                    };
                                case 'Venmo':
                                    return {
                                        ...baseData,
                                        venmo_username: venmoUsername,
                                        venmo_phone: venmoPhone
                                    };
                                case 'Zelle':
                                    return {
                                        ...baseData,
                                        zelle_email: zelleEmail,
                                        zelle_phone: zellePhone,
                                        account_name: zelleName
                                    };
                                case 'Cash App':
                                    return {
                                        ...baseData,
                                        cashapp_tag: cashAppTag,
                                        account_name: cashAppFullName
                                    };
                                case 'Revolut':
                                    return {
                                        ...baseData,
                                        account_name: revolutFullName,
                                        revolut_email: revolutEmail,
                                    };
                                case 'Alipay':
                                    return {
                                        ...baseData,
                                        alipay_id: alipayId,
                                        account_name: alipayFullName
                                    };
                                case 'WeChat Pay':
                                    return {
                                        ...baseData,
                                        wechat_id: wechatId,
                                        account_name: wechatName
                                    };
                                default:
                                    return baseData;
                            }
                        })()
                    }))"
                    :disabled="!withdrawMethod || !hasRequiredFieldsForMethod()"
                    class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-blue-300 dark:border-blue-600 rounded-lg shadow-sm text-sm font-medium text-blue-700 dark:text-blue-300 bg-blue-50/70 dark:bg-blue-900/20 backdrop-blur-sm hover:bg-blue-100 dark:hover:bg-blue-900/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <i class="fa-solid fa-bookmark text-xs mr-2"></i>
                    Save Beneficiary
                </button>
                <a 
                    href="{{ route('dashboard') }}" 
                    class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition-colors"
                >
                    <i class="fa-solid fa-arrow-left text-xs mr-2"></i>
                    Back to Dashboard
                </a>
            </div>
        </form>
    </div>
</div>