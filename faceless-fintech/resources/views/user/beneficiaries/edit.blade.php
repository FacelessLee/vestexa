@extends('layouts.dash2')

@section('title', 'Edit Beneficiary')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 lg:p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Edit Beneficiary',
                'showBackButton' => true,
                'backUrl' => route('beneficiaries.index'),
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
                        <i class="fas fa-edit text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Beneficiary</h1>
                        <p class="text-gray-600 dark:text-gray-400">Update beneficiary information</p>
                    </div>
                </div>
                <a href="{{ route('beneficiaries.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Beneficiaries
                </a>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('message'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                {{ session('message') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Form -->
        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
            <form action="{{ route('beneficiaries.update', $beneficiary) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Beneficiary Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Beneficiary Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $beneficiary->name) }}" required
                           class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                </div>

                @if($beneficiary->type === 'local')
                    <!-- Local Transfer Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="account_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Holder Name</label>
                            <input type="text" name="account_name" id="account_name" value="{{ old('account_name', $beneficiary->account_name) }}" required
                                   class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="account_number" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Number</label>
                            <input type="text" name="account_number" id="account_number" value="{{ old('account_number', $beneficiary->account_number) }}" required
                                   class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="bank_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $beneficiary->bank_name) }}" required
                                   class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                        </div>
                        <div>
                            <label for="account_type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Type</label>
                            <select name="account_type" id="account_type" required
                                    class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white">
                                <option value="Online Banking" {{ old('account_type', $beneficiary->account_type) == 'Online Banking' ? 'selected' : '' }}>Online Banking</option>
                                <option value="Savings Account" {{ old('account_type', $beneficiary->account_type) == 'Savings Account' ? 'selected' : '' }}>Savings Account</option>
                                <option value="Checking Account" {{ old('account_type', $beneficiary->account_type) == 'Checking Account' ? 'selected' : '' }}>Checking Account</option>
                                <option value="Business Account" {{ old('account_type', $beneficiary->account_type) == 'Business Account' ? 'selected' : '' }}>Business Account</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="routing_number" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Routing Number (Optional)</label>
                            <input type="text" name="routing_number" id="routing_number" value="{{ old('routing_number', $beneficiary->routing_number) }}" maxlength="9"
                                   class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                   placeholder="Enter 9-digit routing number">
                        </div>
                        <div>
                            <label for="swift_code" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">SWIFT Code (Optional)</label>
                            <input type="text" name="swift_code" id="swift_code" value="{{ old('swift_code', $beneficiary->swift_code) }}" maxlength="11"
                                   class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                   placeholder="Enter SWIFT/BIC code">
                        </div>
                    </div>

                @elseif($beneficiary->type === 'international')
                    <!-- International Transfer Fields -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Transfer Method</label>
                        <div class="px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white">
                            {{ $beneficiary->method_type }}
                        </div>
                    </div>

                    @if($beneficiary->method_type === 'Wire Transfer')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="account_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Holder Name</label>
                                <input type="text" name="account_name" id="account_name" value="{{ old('account_name', $beneficiary->account_name) }}" required
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                            <div>
                                <label for="account_number" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Number</label>
                                <input type="text" name="account_number" id="account_number" value="{{ old('account_number', $beneficiary->account_number) }}" required
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                            <div>
                                <label for="bank_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Bank Name</label>
                                <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $beneficiary->bank_name) }}" required
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                            <div>
                                <label for="country" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country</label>
                                <input type="text" name="country" id="country" value="{{ old('country', $beneficiary->country) }}" required
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="bank_address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Bank Address</label>
                                <textarea name="bank_address" id="bank_address" rows="3" required
                                          class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">{{ old('bank_address', $beneficiary->bank_address) }}</textarea>
                            </div>
                            <div>
                                <label for="swift_code" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">SWIFT Code (Optional)</label>
                                <input type="text" name="swift_code" id="swift_code" value="{{ old('swift_code', $beneficiary->swift_code) }}"
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                            <div>
                                <label for="iban" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">IBAN (Optional)</label>
                                <input type="text" name="iban" id="iban" value="{{ old('iban', $beneficiary->iban) }}"
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                        </div>

                    @elseif($beneficiary->method_type === 'Cryptocurrency')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="crypto_currency" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Cryptocurrency</label>
                                <select name="crypto_currency" id="crypto_currency" required
                                        class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white">
                                    <option value="BTC" {{ old('crypto_currency', $beneficiary->crypto_currency) == 'BTC' ? 'selected' : '' }}>Bitcoin (BTC)</option>
                                    <option value="ETH" {{ old('crypto_currency', $beneficiary->crypto_currency) == 'ETH' ? 'selected' : '' }}>Ethereum (ETH)</option>
                                    <option value="USDT" {{ old('crypto_currency', $beneficiary->crypto_currency) == 'USDT' ? 'selected' : '' }}>Tether (USDT)</option>
                                    <option value="LTC" {{ old('crypto_currency', $beneficiary->crypto_currency) == 'LTC' ? 'selected' : '' }}>Litecoin (LTC)</option>
                                </select>
                            </div>
                            <div>
                                <label for="crypto_network" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Network</label>
                                <select name="crypto_network" id="crypto_network" required
                                        class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white">
                                    <option value="Native" {{ old('crypto_network', $beneficiary->crypto_network) == 'Native' ? 'selected' : '' }}>Native</option>
                                    <option value="ERC20" {{ old('crypto_network', $beneficiary->crypto_network) == 'ERC20' ? 'selected' : '' }}>ERC20</option>
                                    <option value="TRC20" {{ old('crypto_network', $beneficiary->crypto_network) == 'TRC20' ? 'selected' : '' }}>TRC20</option>
                                    <option value="BEP20" {{ old('crypto_network', $beneficiary->crypto_network) == 'BEP20' ? 'selected' : '' }}>BEP20</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label for="wallet_address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Wallet Address</label>
                                <input type="text" name="wallet_address" id="wallet_address" value="{{ old('wallet_address', $beneficiary->wallet_address) }}" required
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 font-mono">
                            </div>
                        </div>

                    @elseif($beneficiary->method_type === 'PayPal')
                        <div class="mb-6">
                            <label for="paypal_email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">PayPal Email</label>
                            <input type="email" name="paypal_email" id="paypal_email" value="{{ old('paypal_email', $beneficiary->paypal_email) }}" required
                                   class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                        </div>

                    @elseif($beneficiary->method_type === 'Wise Transfer')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="account_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                                <input type="text" name="account_name" id="account_name" value="{{ old('account_name', $beneficiary->account_name) }}" required
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                            <div>
                                <label for="wise_email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Wise Email</label>
                                <input type="email" name="wise_email" id="wise_email" value="{{ old('wise_email', $beneficiary->wise_email) }}" required
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="country" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country</label>
                                <input type="text" name="country" id="country" value="{{ old('country', $beneficiary->country) }}" required
                                       class="block w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                            </div>
                        </div>

                    @else
                        <!-- Other payment methods can be added here -->
                        <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-xl">
                            <p class="text-yellow-800 dark:text-yellow-200">
                                <i class="fas fa-info-circle mr-2"></i>
                                This payment method ({{ $beneficiary->method_type }}) editing is not yet implemented.
                            </p>
                        </div>
                    @endif
                @endif

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                    <a href="{{ route('beneficiaries.index') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-base font-semibold text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
                        <i class="fas fa-save mr-2"></i>
                        Update Beneficiary
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 