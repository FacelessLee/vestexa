@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 lg:p-6">
    <div class="max-w-8xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Make Payment',
                'showBackButton' => true,
                'backUrl' => route('deposits'),
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
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Make Deposit</h1>
                        <p class="text-gray-600 dark:text-gray-400">Complete your payment securely</p>
                    </div>
                </div>
                <a href="{{ route('deposits') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Deposits
                </a>
            </div>
        </div>

        <!-- Alerts -->
        <div class="mb-2">
            <x-danger-alert />
            <x-success-alert />
            <x-error-alert />
        </div>

        <!-- Main Content -->
        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <!-- Content Header -->
            <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 dark:from-primary-600 dark:via-primary-700 dark:to-primary-800 p-6 text-white">
                <div class="relative">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            @if($title != "Complete Payment")
                                <h2 class="text-xl lg:text-2xl font-bold mb-2 flex items-center">
                                    <i class="fas fa-credit-card mr-3"></i>
                                    Payment Method: {{$payment_mode->name}}
                                </h2>
                            @else
                                <h2 class="text-xl lg:text-2xl font-bold mb-2 flex items-center">
                                    <i class="fas fa-qrcode mr-3"></i>
                                    Complete Crypto Payment
                                </h2>
                            @endif
                            <p class="text-white/90 text-sm">Secure payment processing for your deposit</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2">
                                <p class="text-sm text-white/80">Amount</p>
                                <p class="text-lg font-bold text-white">{{ Auth::user()->s_curr }}{{ number_format($amount) }} {{ Auth::user()->curr }}</p>
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

            <!-- Form Content -->
            <div class="p-6">
                @if($title !="Complete Payment")
                    @php
                        if($payment_mode->name == "Bitcoin"){
                            $coin = 'BTC';
                        }elseif ($payment_mode->name == "Litecoin") {
                            $coin = 'LTC';
                        }else {
                            $coin = 'ETH';
                        }
                    @endphp
                    
                    <div class="bg-blue-50/80 dark:bg-blue-900/20 border border-blue-200/50 dark:border-blue-700/50 rounded-xl p-4 mb-6 backdrop-blur-sm">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-200 mb-2">Payment Instructions</h3>
                                <p class="text-sm text-blue-700 dark:text-blue-300">
                                    You are to make payment of <strong>{{Auth::user()->s_curr}}{{number_format($amount)}}</strong> using your selected payment method. Screenshot and upload the proof of payment.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Barcode/QR Code (if available) -->
                    @if ($payment_mode->methodtype != 'currency')
                        <div class="flex justify-center mb-6">
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-6 flex flex-col items-center w-full max-w-sm">
                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center mb-4">
                                    <i class="fas fa-qrcode text-white text-lg"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Scan QR Code</h3>
                                <div class="bg-white dark:bg-gray-900 p-3 rounded-xl border border-gray-200 dark:border-gray-700 mb-4 w-full flex justify-center">
                                    @php
                                        // Generate appropriate QR code data based on payment method
                                        $qrContent = $payment_mode->wallet_address;
                                        
                                        // For cryptocurrencies, create a payment URI when possible
                                        if ($payment_mode->name == "Bitcoin") {
                                            $qrContent = "bitcoin:" . $payment_mode->wallet_address . "?amount=" . $amount;
                                        } elseif ($payment_mode->name == "Ethereum") {
                                            $qrContent = "ethereum:" . $payment_mode->wallet_address . "?value=" . $amount;
                                        } elseif ($payment_mode->name == "Litecoin") {
                                            $qrContent = "litecoin:" . $payment_mode->wallet_address . "?amount=" . $amount;
                                        }
                                    @endphp
                                    
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{urlencode($qrContent)}}" alt="Payment QR Code" class="w-44 h-44 rounded-lg">
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-3">Scan with your payment app</p>
                                <div class="w-full space-y-2">
                                    <div class="text-center">
                                        <p class="text-xs font-medium text-gray-700 dark:text-gray-300">{{$payment_mode->name}} Address:</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 break-all bg-gray-50 dark:bg-gray-800 p-2 rounded-lg">{{$payment_mode->wallet_address}}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs font-medium text-gray-700 dark:text-gray-300">Amount:</p>
                                        <p class="text-xs font-semibold text-gray-900 dark:text-white">{{Auth::user()->s_curr}}{{$amount}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                                
                    <!-- Payment Method Type Logic Begins -->
                    <div class="space-y-6">
                        @if($settings->deposit_option != "manual")
                            @if ($payment_mode->name == "Bitcoin" or $payment_mode->name == "Litecoin" or $payment_mode->name == "Ethereum")
                                <div class="flex justify-center mb-6">
                                    <a href="{{ url('dashboard/cpay') }}/{{$amount}}/{{$coin}}/{{ Auth::user()->id }}/new" 
                                       class="inline-flex items-center px-6 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                                        <i class="fas fa-bitcoin-sign mr-2"></i>
                                        Pay Via Coinpayment
                                    </a>
                                </div>
                            @endif
                        @endif

                        <!-- Method Type: Non-Currency (Crypto etc) -->
                        @if ($payment_mode->methodtype != 'currency')
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-5">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                    <i class="fas fa-wallet text-primary-600 dark:text-primary-400 mr-2"></i>
                                    {{$payment_mode->name}} Address
                                </h3>
                                
                                <div class="relative mb-4">
                                    <div class="flex">
                                        <input type="text" id="myInput" value="{{$payment_mode->wallet_address}}" 
                                               class="block w-full py-3 px-4 border border-gray-200 dark:border-gray-600 rounded-l-xl bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-900 dark:text-white" 
                                               readonly />
                                        <button onclick="myFunction()" type="button" 
                                                class="inline-flex items-center justify-center px-4 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-xl bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                        <i class="fas fa-info-circle text-blue-500 dark:text-blue-400 mr-1"></i>
                                        <strong>Network Type:</strong> {{$payment_mode->network}}
                                    </p>
                                </div>
                            </div>
                        @else
                            <!-- Method Type: Currency (Bank Transfer, etc) -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                    <i class="fas fa-university text-primary-600 dark:text-primary-400 mr-2"></i>
                                    {{$payment_mode->name}} Details
                                </h3>
                                
                                @if ($payment_mode->defaultpay == 'yes')
                                    <!-- Default Payment Methods Integration -->
                                    @if ($payment_mode->name == "Paystack")
                                        <div id="paystack" class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-6">
                                            <div class="flex flex-col items-center">
                                                <div class="mb-4">
                                                    <img src="{{ asset('img/paystack-logo.png') }}" alt="Paystack" class="h-10">
                                                </div>
                                                <form method="POST" action="{{ route('pay.paystack') }}" accept-charset="UTF-8" class="w-full max-w-md">
                                                    <input type="hidden" name="email" value="{{auth::user()->email}}">
                                                    <input type="hidden" name="amount" value="{{$payamount}}">
                                                    <input type="hidden" name="currency" value="{{Auth::user()->curr}}">
                                                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}"> 
                                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                                    <button type="submit" class="w-full py-3 px-4 flex items-center justify-center rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                                                        <i class="fas fa-credit-card mr-2"></i>
                                                        Pay with Paystack
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($payment_mode->name == "Stripe")
                                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-6">
                                            <div class="flex flex-col items-center mb-4">
                                                <img src="{{ asset('img/stripe-logo.png') }}" alt="Stripe" class="h-10 mb-4">
                                                <form id="payment-form" class="w-full max-w-md">
                                                    @csrf
                                                    <div class="sr-combo-inputs-row mb-4">
                                                        <div class="sr-input sr-card-element" id="card-element"></div>
                                                    </div>
                                                    <button id="stripesubmit" class="w-full py-3 px-4 flex items-center justify-center rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                                                        <div class="spinner d-none" id="spinner"></div>
                                                        <span id="buttontext" class="flex items-center">
                                                            <i class="fas fa-credit-card mr-2"></i>
                                                            Pay with Stripe
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                            
                                            <div class="hidden" id="stripesuccess">
                                                <div class="p-4 bg-green-50/80 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-xl text-green-800 dark:text-green-200 text-center">
                                                    <i class="fas fa-check-circle text-2xl text-green-600 dark:text-green-400 mb-2"></i>
                                                    <p>Payment Completed, redirecting...</p>
                                                </div>
                                            </div>
                                @endif

                                    @if ($payment_mode->name == "Paypal")
                                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-6 flex justify-center">
                                            @include('includes.paypal')
                                        </div>
                                    @endif

                                    @if ($payment_mode->name == "Bank Transfer")
                                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-5">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                @if (!empty($payment_mode->bankname))
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Bank Name</label>
                                                        <div class="flex">
                                                            <input type="text" value="{{$payment_mode->bankname}}" 
                                                                   class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-700 dark:text-gray-300" 
                                                                   readonly />
                                                            <button type="button" onclick="copyToClipboard(this)" data-value="{{$payment_mode->bankname}}"
                                                                    class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                                                <i class="fas fa-copy"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if (!empty($payment_mode->account_name))
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Name</label>
                                                        <div class="flex">
                                                            <input type="text" value="{{$payment_mode->account_name}}" 
                                                                   class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-700 dark:text-gray-300" 
                                                                   readonly />
                                                            <button type="button" onclick="copyToClipboard(this)" data-value="{{$payment_mode->account_name}}"
                                                                    class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                                                <i class="fas fa-copy"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if (!empty($payment_mode->account_number))
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Number</label>
                                                        <div class="flex">
                                                            <input type="text" value="{{$payment_mode->account_number}}" 
                                                                   class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-700 dark:text-gray-300" 
                                                                   readonly />
                                                            <button type="button" onclick="copyToClipboard(this)" data-value="{{$payment_mode->account_number}}"
                                                                    class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                                                <i class="fas fa-copy"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if (!empty($payment_mode->swift_code))
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Swift Code</label>
                                                        <div class="flex">
                                                            <input type="text" value="{{$payment_mode->swift_code}}" 
                                                                   class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-700 dark:text-gray-300" 
                                                                   readonly />
                                                            <button type="button" onclick="copyToClipboard(this)" data-value="{{$payment_mode->swift_code}}"
                                                                    class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                                                <i class="fas fa-copy"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <!-- Non-Default Bank Transfer Option -->
                                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-5">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @if (!empty($payment_mode->bankname))
                                                <div>
                                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Bank Name</label>
                                                    <div class="flex">
                                                        <input type="text" value="{{$payment_mode->bankname}}" 
                                                               class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-700 dark:text-gray-300" 
                                                                   readonly />
                                                        <button type="button" onclick="copyToClipboard(this)" data-value="{{$payment_mode->bankname}}"
                                                                class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if (!empty($payment_mode->account_name))
                                                <div>
                                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Name</label>
                                                    <div class="flex">
                                                        <input type="text" value="{{$payment_mode->account_name}}" 
                                                               class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-700 dark:text-gray-300" 
                                                                   readonly />
                                                        <button type="button" onclick="copyToClipboard(this)" data-value="{{$payment_mode->account_name}}"
                                                                class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if (!empty($payment_mode->account_number))
                                                <div>
                                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Account Number</label>
                                                    <div class="flex">
                                                        <input type="text" value="{{$payment_mode->account_number}}" 
                                                               class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-700 dark:text-gray-300" 
                                                                   readonly />
                                                        <button type="button" onclick="copyToClipboard(this)" data-value="{{$payment_mode->account_number}}"
                                                                class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if (!empty($payment_mode->swift_code))
                                                <div>
                                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Swift Code</label>
                                                    <div class="flex">
                                                        <input type="text" value="{{$payment_mode->swift_code}}" 
                                                               class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-gray-700 dark:text-gray-300" 
                                                                   readonly />
                                                        <button type="button" onclick="copyToClipboard(this)" data-value="{{$payment_mode->swift_code}}"
                                                                class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
                @if ($settings->deposit_option == "auto" and $payment_mode->defaultpay != 'yes')
                    <div class="mt-8 mb-8 px-4 sm:px-6 lg:px-8">
                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-6">
                            <form method="post" action="{{route('savedeposit')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Upload Payment Proof</label>
                                    <div id="auto-upload-area" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-primary-500 dark:hover:border-primary-400 transition-all relative cursor-pointer bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm">
                                        <div id="auto-upload-placeholder" class="flex flex-col items-center justify-center py-4">
                                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                                <span class="font-semibold text-primary-600 dark:text-primary-400">Click to upload</span> or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or PDF (max. 5MB)</p>
                                        </div>
                                        <div id="auto-preview-container" class="hidden flex flex-col items-center justify-center py-4">
                                            <img id="auto-image-preview" src="#" alt="Preview" class="max-h-48 max-w-full mb-4 rounded-lg shadow-sm">
                                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center">
                                                <span id="auto-file-name">filename.jpg</span>
                                                <button type="button" id="auto-remove-file" class="ml-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </p>
                                        </div>
                                        <input id="proof-upload-auto" class="hidden" name="proof" type="file" required accept="image/*,.pdf">
                                    </div>
                                </div>
                                
                                <input type="hidden" name="amount" value="{{$amount}}">
                                <input type="hidden" name="paymethd_method" value="{{$payment_mode->name}}">

                                <div class="flex justify-center pt-4">
                                    <button type="submit" class="inline-flex items-center px-8 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Submit Payment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                @if($settings->deposit_option == "manual" and $payment_mode->name != "Paystack" and $payment_mode->name != "Stripe" and $payment_mode->name != "Paypal" and $title !="Complete Payment")
                    <div class="mt-8 mb-8 px-4 sm:px-6 lg:px-8">
                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-200/50 dark:border-gray-700/50 p-6">
                            <form method="post" action="{{route('savedeposit')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Upload Payment Proof</label>
                                    <div id="manual-upload-area" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-primary-500 dark:hover:border-primary-400 transition-all relative cursor-pointer bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm">
                                        <div id="manual-upload-placeholder" class="flex flex-col items-center justify-center py-4">
                                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                                <span class="font-semibold text-primary-600 dark:text-primary-400">Click to upload</span> or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or PDF (max. 5MB)</p>
                                        </div>
                                        <div id="manual-preview-container" class="hidden flex flex-col items-center justify-center py-4">
                                            <img id="manual-image-preview" src="#" alt="Preview" class="max-h-48 max-w-full mb-4 rounded-lg shadow-sm">
                                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center">
                                                <span id="manual-file-name">filename.jpg</span>
                                                <button type="button" id="manual-remove-file" class="ml-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </p>
                                        </div>
                                        <input id="proof-upload-manual" class="hidden" name="proof" type="file" required accept="image/*,.pdf">
                                    </div>
                                </div>
                                <input type="hidden" name="amount" value="{{$amount}}">
                                <input type="hidden" name="paymethd_method" value="{{$payment_mode->name}}">

                                <div class="flex justify-center pt-4">
                                    <button type="submit" class="inline-flex items-center px-8 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Submit Payment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            @if($title=="Complete Payment")
                <div class="flex flex-col items-center justify-center p-6">
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-6 flex flex-col items-center max-w-md">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center mb-4">
                            <i class="fas fa-qrcode text-white text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 text-center">Scan QR Code to Complete Payment</h3>
                        
                        <div class="bg-white dark:bg-gray-900 p-3 rounded-xl border border-gray-200 dark:border-gray-700 mb-4">
                            <img src="{{$p_qrcode}}" alt="Payment QR code" class="w-48 h-48 rounded-lg">
                        </div>
                        
                        <div class="mb-4 w-full">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{$coin}} Address</label>
                            <div class="flex">
                                <input type="text" value="{{$p_address}}" 
                                       class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300" 
                                       readonly />
                                <button type="button" onclick="copyToClipboard(this)" data-value="{{$p_address}}"
                                        class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>	
                        
                        <div class="w-full">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Amount</label>
                            <div class="flex">
                                <input type="text" value="{{$amount}} {{$coin}}" 
                                       class="block w-full py-2 px-3 border border-gray-200 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300" 
                                       readonly />
                                <button type="button" onclick="copyToClipboard(this)" data-value="{{$amount}} {{$coin}}"
                                        class="inline-flex items-center justify-center px-3 py-2 border border-l-0 border-gray-200 dark:border-gray-600 rounded-r-lg bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-500 dark:text-gray-300">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mt-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                            <p>You can exit this page after scanning and completing payment.</p>
                            <p>The system will track your payment and update your account.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");
        
        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */
        
        /* Copy the text inside the text field */
        document.execCommand("copy");
        
        /* Alert the copied text */
        alert("Copied: " + copyText.value);
    }

    function copyToClipboard(button) {
        const value = button.getAttribute('data-value');
        const tempInput = document.createElement('input');
        tempInput.value = value;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        
        // Optional - show feedback
        const originalInnerHTML = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
            button.innerHTML = originalInnerHTML;
        }, 1500);
    }

    // Initialize file upload with drag and drop
    document.addEventListener('DOMContentLoaded', function () {
        // Setup file upload with preview and drag-drop for both upload areas
        const setupFileUpload = (dropAreaId, fileInputId, placeholderId, previewContainerId, imagePreviewId, fileNameId, removeButtonId) => {
            const dropArea = document.getElementById(dropAreaId);
            const fileInput = document.getElementById(fileInputId);
            const placeholder = document.getElementById(placeholderId);
            const previewContainer = document.getElementById(previewContainerId);
            const imagePreview = document.getElementById(imagePreviewId);
            const fileName = document.getElementById(fileNameId);
            const removeButton = document.getElementById(removeButtonId);
            
            if (!dropArea || !fileInput || !placeholder || !previewContainer || !imagePreview || !fileName || !removeButton) return;
            
            // Prevent default behavior for all drag events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            // Highlight drop area when dragging over it
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropArea.classList.add('border-primary-500');
                dropArea.classList.add('bg-primary-50');
                dropArea.classList.add('dark:bg-primary-900/20');
            }
            
            function unhighlight() {
                dropArea.classList.remove('border-primary-500');
                dropArea.classList.remove('bg-primary-50');
                dropArea.classList.remove('dark:bg-primary-900/20');
            }
            
            // Handle file selection via drag & drop
            dropArea.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length) {
                    fileInput.files = files;
                    updateFilePreview(files[0]);
                }
            }
            
            // Handle file selection via click
            dropArea.addEventListener('click', () => {
                fileInput.click();
            });
            
            // Handle file selection changes
            fileInput.addEventListener('change', function() {
                if (this.files.length) {
                    updateFilePreview(this.files[0]);
                }
            });
            
            // Handle removing the selected file
            removeButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering dropArea click
                resetFileInput();
            });
            
            // Update the preview with the selected file
            function updateFilePreview(file) {
                // Display file name
                fileName.textContent = file.name;
                
                // Handle image preview
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        showPreview();
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    // Show a PDF icon for PDF files
                    imagePreview.src = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0xNCAySDZhMiAyIDAgMCAwLTIgMnYxNmEyIDIgMCAwIDAgMiAyaDEyYTIgMiAwIDAgMCAyLTJWOHoiLz48cGF0aCBkPSJNMTQgMnY2aDYiLz48L3N2Zz4=';
                    imagePreview.classList.add('h-24', 'w-24', 'object-contain');
                    showPreview();
                } else {
                    // Show a generic file icon for other files
                    imagePreview.src = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0xNCAySDZhMiAyIDAgMCAwLTIgMnYxNmEyIDIgMCAwIDAgMiAyaDEyYTIgMiAwIDAgMCAyLTJWOHoiLz48cGF0aCBkPSJNMTQgMnY2aDYiLz48L3N2Zz4=';
                    imagePreview.classList.add('h-24', 'w-24', 'object-contain');
                    showPreview();
                }
            }
            
            // Show the preview and hide the placeholder
            function showPreview() {
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }
            
            // Reset the file input and show the placeholder again
            function resetFileInput() {
                fileInput.value = '';
                placeholder.classList.remove('hidden');
                previewContainer.classList.add('hidden');
                // Remove any added classes to the image preview
                imagePreview.classList.remove('h-24', 'w-24', 'object-contain');
            }
        };
        
        // Setup file upload for both upload areas
        setupFileUpload(
            'auto-upload-area', 
            'proof-upload-auto', 
            'auto-upload-placeholder', 
            'auto-preview-container', 
            'auto-image-preview', 
            'auto-file-name', 
            'auto-remove-file'
        );
        
        setupFileUpload(
            'manual-upload-area', 
            'proof-upload-manual', 
            'manual-upload-placeholder', 
            'manual-preview-container', 
            'manual-image-preview', 
            'manual-file-name', 
            'manual-remove-file'
        );
    });
</script>
@endsection