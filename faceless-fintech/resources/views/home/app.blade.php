@extends('layouts.base')

@section('title', 'Apps')

@section('content')
<!-- Mobile App Hero Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-slate-900 via-primary-900 to-gray-900 dark:from-gray-900 dark:via-primary-900 dark:to-black overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25% 25%, #ffffff 1px, transparent 1px), radial-gradient(circle at 75% 75%, #ffffff 1px, transparent 1px); background-size: 60px 60px; animation: float 20s ease-in-out infinite;"></div>
        </div>
        <div class="absolute top-20 left-20 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-purple-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm text-white/90 rounded-full text-sm font-semibold mb-6 border border-white/20">
                    <i class="fa-solid fa-mobile-alt mr-2"></i>
                    Mobile Banking
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6">
                    Banking Made Mobile
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    Take control of your finances with our award-winning mobile banking app. Available for iOS and Android.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" class="inline-flex items-center px-6 py-3 bg-black text-white rounded-xl hover:bg-gray-800 transition-colors">
                        <i class="fa-brands fa-apple text-2xl mr-3"></i>
                        <div class="text-left">
                            <div class="text-xs">Download on the</div>
                            <div class="font-semibold">App Store</div>
                        </div>
                    </a>
                    <a href="#" class="inline-flex items-center px-6 py-3 bg-black text-white rounded-xl hover:bg-gray-800 transition-colors">
                        <i class="fa-brands fa-google-play text-2xl mr-3"></i>
                        <div class="text-left">
                            <div class="text-xs">Get it on</div>
                            <div class="font-semibold">Google Play</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="relative z-10">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Mobile banking app interface" 
                         class="w-full max-w-md mx-auto rounded-3xl shadow-2xl">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-purple-500/20 rounded-3xl blur-2xl"></div>
            </div>
        </div>
    </div>
</section>

<!-- App Features Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Powerful Features at Your Fingertips
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Everything you need to manage your finances, all in one convenient mobile app
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Account Management -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-chart-pie text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Account Overview</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    View all your accounts, balances, and recent transactions in one place.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Real-time balance updates</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Transaction history</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Account statements</li>
                </ul>
            </div>

            <!-- Money Transfers -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-money-bill-transfer text-2xl text-green-600 dark:text-green-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Send Money</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Transfer money instantly to friends, family, or between your accounts.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Instant transfers</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Zelle integration</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>International wire transfers</li>
                </ul>
            </div>

            <!-- Bill Pay -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-file-invoice-dollar text-2xl text-purple-600 dark:text-purple-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Bill Pay</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Schedule and pay all your bills from one convenient location.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Automatic payments</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Payment reminders</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Payee management</li>
                </ul>
            </div>

            <!-- Mobile Deposit -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-camera text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Mobile Deposit</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Deposit checks instantly by taking a photo with your phone.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Photo check deposit</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Instant availability</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Deposit limits up to $10K</li>
                </ul>
            </div>

            <!-- Card Management -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-credit-card text-2xl text-teal-600 dark:text-teal-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Card Controls</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Manage your debit and credit cards with advanced security features.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Lock/unlock cards instantly</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Set spending limits</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Transaction alerts</li>
                </ul>
            </div>

            <!-- Budgeting Tools -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-chart-bar text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Budgeting</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Track spending, set budgets, and achieve your financial goals.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Spending categories</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Budget alerts</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Financial insights</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Security Features -->
<section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Bank-Level Security
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Your security is our priority with advanced protection features built into every aspect of our app
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-fingerprint text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Biometric Login</h3>
                <p class="text-gray-600 dark:text-gray-300">Secure access with fingerprint and face recognition</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-shield-halved text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">256-bit Encryption</h3>
                <p class="text-gray-600 dark:text-gray-300">Military-grade encryption protects all your data</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-bell text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Real-time Alerts</h3>
                <p class="text-gray-600 dark:text-gray-300">Instant notifications for all account activity</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-user-shield text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Fraud Protection</h3>
                <p class="text-gray-600 dark:text-gray-300">24/7 monitoring and zero liability guarantee</p>
            </div>
        </div>
    </div>
</section>

<!-- App Screenshots -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                See It in Action
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Take a look at our intuitive interface designed for modern banking
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-gray-200 dark:bg-gray-700 rounded-3xl h-96 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-mobile-alt text-6xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Dashboard</h3>
                <p class="text-gray-600 dark:text-gray-300">Complete overview of all your accounts and recent activity</p>
            </div>

            <div class="text-center">
                <div class="bg-gray-200 dark:bg-gray-700 rounded-3xl h-96 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-exchange-alt text-6xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Transfers</h3>
                <p class="text-gray-600 dark:text-gray-300">Quick and easy money transfers with just a few taps</p>
            </div>

            <div class="text-center">
                <div class="bg-gray-200 dark:bg-gray-700 rounded-3xl h-96 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-chart-pie text-6xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Insights</h3>
                <p class="text-gray-600 dark:text-gray-300">Detailed spending analysis and budgeting tools</p>
            </div>
        </div>
    </div>
</section>

<!-- Download CTA -->
<section class="py-16 bg-primary-600 dark:bg-primary-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
            Download Our App Today
        </h2>
        <p class="text-xl text-primary-100 mb-8">
            Join millions of satisfied customers who bank with confidence using our mobile app
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="inline-flex items-center px-8 py-4 bg-black text-white rounded-2xl hover:bg-gray-800 transition-colors shadow-lg">
                <i class="fa-brands fa-apple text-3xl mr-4"></i>
                <div class="text-left">
                    <div class="text-sm">Download on the</div>
                    <div class="text-lg font-semibold">App Store</div>
                </div>
            </a>
            <a href="#" class="inline-flex items-center px-8 py-4 bg-black text-white rounded-2xl hover:bg-gray-800 transition-colors shadow-lg">
                <i class="fa-brands fa-google-play text-3xl mr-4"></i>
                <div class="text-left">
                    <div class="text-sm">Get it on</div>
                    <div class="text-lg font-semibold">Google Play</div>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection 