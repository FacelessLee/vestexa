@extends('layouts.base')

@section('title', 'Banking Cards')

@section('content')
<!-- Cards Hero Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-slate-900 via-primary-900 to-gray-900 dark:from-gray-900 dark:via-primary-900 dark:to-black overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25% 25%, #ffffff 1px, transparent 1px), radial-gradient(circle at 75% 75%, #ffffff 1px, transparent 1px); background-size: 60px 60px; animation: float 20s ease-in-out infinite;"></div>
        </div>
        <div class="absolute top-20 left-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm text-white/90 rounded-full text-sm font-semibold mb-6 border border-white/20">
                <i class="fa-solid fa-credit-card mr-2"></i>
                Credit & Debit Cards
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                Banking Cards
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Secure, convenient, and rewarding cards for all your financial needs
            </p>
        </div>
    </div>
</section>

<!-- Card Types Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Choose Your Card
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Find the perfect card to match your lifestyle and financial goals
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Cashback Credit Card -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Cashback Rewards</h3>
                            <p class="text-blue-100">Credit Card</p>
                        </div>
                        <i class="fa-solid fa-credit-card text-2xl text-blue-200"></i>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">3% cashback on groceries</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">2% on gas and dining</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">1% on all other purchases</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">No annual fee</span>
                        </div>
                    </div>
                    <div class="text-2xl font-bold mb-4">0% APR</div>
                    <p class="text-sm text-blue-100 mb-6">For 15 months on purchases</p>
                    <button class="w-full bg-white text-blue-600 font-bold py-3 px-6 rounded-xl hover:bg-blue-50 transition-colors">
                        Apply Now
                    </button>
                </div>
            </div>

            <!-- Travel Rewards Card -->
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Travel Rewards</h3>
                            <p class="text-purple-100">Premium Credit Card</p>
                        </div>
                        <i class="fa-solid fa-plane text-2xl text-purple-200"></i>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">3x points on travel & dining</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">50,000 bonus points</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Airport lounge access</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Travel insurance included</span>
                        </div>
                    </div>
                    <div class="text-2xl font-bold mb-4">$95</div>
                    <p class="text-sm text-purple-100 mb-6">Annual fee (waived first year)</p>
                    <button class="w-full bg-white text-purple-600 font-bold py-3 px-6 rounded-xl hover:bg-purple-50 transition-colors">
                        Apply Now
                    </button>
                </div>
            </div>

            <!-- Business Credit Card -->
            <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Business Card</h3>
                            <p class="text-green-100">For Small Business</p>
                        </div>
                        <i class="fa-solid fa-briefcase text-2xl text-green-200"></i>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">2% on business purchases</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Expense management tools</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Employee cards included</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Higher credit limits</span>
                        </div>
                    </div>
                    <div class="text-2xl font-bold mb-4">No Fee</div>
                    <p class="text-sm text-green-100 mb-6">For the first year</p>
                    <button class="w-full bg-white text-green-600 font-bold py-3 px-6 rounded-xl hover:bg-green-50 transition-colors">
                        Apply Now
                    </button>
                </div>
            </div>

            <!-- Student Credit Card -->
            <div class="bg-gradient-to-br from-orange-600 to-orange-800 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Student Card</h3>
                            <p class="text-orange-100">Build Your Credit</p>
                        </div>
                        <i class="fa-solid fa-graduation-cap text-2xl text-orange-200"></i>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">1% cashback on all purchases</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">No annual fee</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Credit education resources</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Easy approval process</span>
                        </div>
                    </div>
                    <div class="text-2xl font-bold mb-4">$100</div>
                    <p class="text-sm text-orange-100 mb-6">Sign-up bonus</p>
                    <button class="w-full bg-white text-orange-600 font-bold py-3 px-6 rounded-xl hover:bg-orange-50 transition-colors">
                        Apply Now
                    </button>
                </div>
            </div>

            <!-- Secured Credit Card -->
            <div class="bg-gradient-to-br from-teal-600 to-teal-800 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Secured Card</h3>
                            <p class="text-teal-100">Rebuild Your Credit</p>
                        </div>
                        <i class="fa-solid fa-shield-halved text-2xl text-teal-200"></i>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Build credit history</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Refundable security deposit</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Credit monitoring tools</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Upgrade eligibility</span>
                        </div>
                    </div>
                    <div class="text-2xl font-bold mb-4">$200</div>
                    <p class="text-sm text-teal-100 mb-6">Minimum deposit</p>
                    <button class="w-full bg-white text-teal-600 font-bold py-3 px-6 rounded-xl hover:bg-teal-50 transition-colors">
                        Apply Now
                    </button>
                </div>
            </div>

            <!-- Debit Card -->
            <div class="bg-gradient-to-br from-gray-600 to-gray-800 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Debit Card</h3>
                            <p class="text-gray-100">Everyday Banking</p>
                        </div>
                        <i class="fa-solid fa-university text-2xl text-gray-200"></i>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">No overdraft fees</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Worldwide ATM access</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Contactless payments</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-3 text-green-300"></i>
                            <span class="text-sm">Mobile wallet support</span>
                        </div>
                    </div>
                    <div class="text-2xl font-bold mb-4">Free</div>
                    <p class="text-sm text-gray-100 mb-6">With qualifying account</p>
                    <button class="w-full bg-white text-gray-600 font-bold py-3 px-6 rounded-xl hover:bg-gray-50 transition-colors">
                        Get Card
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Card Features Section -->
<section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Card Features & Benefits
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Enjoy premium features and security with all our banking cards
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-shield-halved text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Fraud Protection</h3>
                <p class="text-gray-600 dark:text-gray-300">24/7 monitoring and zero liability for unauthorized transactions</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-mobile-alt text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Mobile Banking</h3>
                <p class="text-gray-600 dark:text-gray-300">Manage your cards, view transactions, and pay bills on the go</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-wifi text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Contactless Pay</h3>
                <p class="text-gray-600 dark:text-gray-300">Tap to pay with your card or mobile wallet for quick transactions</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-globe text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Global Acceptance</h3>
                <p class="text-gray-600 dark:text-gray-300">Use your card anywhere Visa or Mastercard is accepted worldwide</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary-600 dark:bg-primary-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
            Ready to Get Your Card?
        </h2>
        <p class="text-xl text-primary-100 mb-8">
            Apply online in minutes and start enjoying the benefits of our banking cards
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                <i class="fa-solid fa-credit-card mr-3"></i>
                Apply for Card
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-primary-700 hover:bg-primary-800 text-white font-semibold rounded-2xl transition-all duration-300 border-2 border-white/30">
                <i class="fa-solid fa-phone mr-3"></i>
                Compare Cards
            </a>
        </div>
    </div>
</section>
@endsection 