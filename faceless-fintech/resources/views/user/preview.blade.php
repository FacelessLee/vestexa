<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $settings->site_name }} - Transaction Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                max-width: 100% !important;
                box-shadow: none !important;
                border: none !important;
            }
            .print-break-inside-avoid {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-gray-100" x-data="{ showReceipt: true }">
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <!-- Receipt Container -->
        <div class="max-w-3xl mx-auto print-container">
            <!-- Action Buttons (No Print) -->
            <div class="flex justify-end mb-4 gap-3 no-print">
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                    Print Receipt
                </button>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                    Dashboard
                </a>
            </div>

            <!-- Receipt Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 print-break-inside-avoid">
                <!-- Receipt Header -->
                <div class="relative bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="h-12 w-auto" src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name }}">
                            <div class="ml-4">
                                <h1 class="text-xl font-bold">{{ $settings->site_name }}</h1>
                                <p class="text-sm text-white/80">Transaction Receipt</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-400 text-green-100">
                                <i data-lucide="check-circle" class="h-4 w-4 mr-1 text-white "></i>
                                <span class="text-sm text-white font-medium">Successful</span>
                            </div>
                            <p class="text-sm mt-1 text-white/80">Ref: {{ $dp->txn_id }}</p>
                        </div>
                    </div>

                    <!-- Wave decoration at the bottom -->
                    <div class="absolute left-0 right-0 bottom-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="h-12 w-full text-white fill-current">
                            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Receipt Body -->
                <div class="p-6 md:p-8">
                    <!-- Transaction Info -->
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Transaction Details</h2>
                        <p class="text-gray-600 text-sm mb-4">
    @if($dp->type == 'Debit')
        Your account has been debited with {{ Auth::user()->s_curr }}{{ $dp->amount }}.
    @elseif($dp->type == 'Credit')
        Your account has been credited with {{ Auth::user()->s_curr }}{{ $dp->amount }}.
    @else
        You have successfully transferred {{ Auth::user()->s_curr }}{{ $dp->amount }}.
    @endif
</p>

                        <!-- Transaction Summary Card -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Transaction Date</p>
                                    <div class="flex items-center">
                                        <i data-lucide="calendar" class="h-4 w-4 text-gray-400 mr-1"></i>
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($dp->date)->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Transaction Time</p>
                                    <div class="flex items-center">
                                        <i data-lucide="clock" class="h-4 w-4 text-gray-400 mr-1"></i>
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($dp->date)->format('h:i A') }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Payment Method</p>
                                    <div class="flex items-center">
                                        <i data-lucide="credit-card" class="h-4 w-4 text-gray-400 mr-1"></i>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->payment_mode }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Reference ID</p>
                                    <div class="flex items-center">
                                        <i data-lucide="hash" class="h-4 w-4 text-gray-400 mr-1"></i>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->txn_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipient Details -->
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <i data-lucide="user" class="h-5 w-5 text-primary-600 mr-2"></i>
                            <h2 class="text-lg font-bold text-gray-900">Recipient Details</h2>
                        </div>
                        
                        <div class="bg-white rounded-lg border border-gray-200 p-4">
                            @if($dp->payment_mode == 'International Wire Transfer')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->accountname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Number</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->accountnumber ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Routing/IBAN</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->iban ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Bank Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->bankname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Type</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->Accounttype ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Swift Code</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->swiftcode ?? 'N/A' }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-sm text-gray-500 mb-1">Bank Address</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->bankaddress ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Country</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->country ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Domestic Transfer')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->accountname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Number</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->accountnumber ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Bank Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->bankname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Type</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->Accounttype ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Cryptocurrency')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Currency</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->crypto_currency ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Network</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->crypto_network ?? 'N/A' }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-sm text-gray-500 mb-1">Wallet Address</p>
                                        <p class="text-sm font-medium text-gray-900 break-all">{{ $dp->wallet_address ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'PayPal')
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">PayPal Email</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $dp->paypal_email ?? 'N/A' }}</p>
                                </div>
                            @elseif($dp->payment_mode == 'Wise Transfer')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->wise_fullname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Email</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->wise_email ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Country</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->wise_country ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Skrill')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->skrill_fullname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Email</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->skrill_email ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Venmo')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Username</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->venmo_username ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Phone Number</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->venmo_phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Zelle')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->zelle_name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Email</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->zelle_email ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Phone Number</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->zelle_phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Cash App')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Cashtag</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->cash_app_tag ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->cash_app_fullname ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Revolut')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->revolut_fullname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Email</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->revolut_email ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Phone Number</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->revolut_phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Alipay')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Alipay ID</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->alipay_id ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->alipay_fullname ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'WeChat Pay')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">WeChat ID</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->wechat_id ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->wechat_name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($dp->Description)
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <p class="text-sm text-gray-500 mb-1">Description</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $dp->Description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Financial Details -->
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <i data-lucide="dollar-sign" class="h-5 w-5 text-primary-600 mr-2"></i>
                            <h2 class="text-lg font-bold text-gray-900">Financial Details</h2>
                        </div>
                        
                        <div class="overflow-hidden bg-white rounded-lg border border-gray-200">
                            <div class="divide-y divide-gray-200">
                                <div class="grid grid-cols-2 gap-4 p-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Amount Sent</p>
                                        <p class="text-base font-medium text-gray-900">{{ Auth::user()->s_curr }}{{ $dp->amount }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Handling & Charges</p>
                                        <p class="text-base font-medium text-gray-900">{{ Auth::user()->s_curr }}0</p>
                                    </div>
                                </div>
                               <!-- <div class="p-4 bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm font-semibold text-gray-700">Available Balance</p>
                                        <p class="text-lg font-bold text-primary-700">{{ Auth::user()->s_curr }}{{ $dp->bal }}</p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Legal Notice -->
                    <div class="mt-8 text-center border-t border-gray-100 pt-6">
                        <div class="flex justify-center mb-2">
                            <i data-lucide="shield-check" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 mb-1">This receipt serves as confirmation of this transaction.</p>
                        <p class="text-xs text-gray-500">For any issues or inquiries regarding this transaction, please contact support.</p>
                        <p class="text-xs text-gray-400 mt-1">© {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
        
        // Print functionality is handled by the print button onclick event
    </script>
</body>
</html>