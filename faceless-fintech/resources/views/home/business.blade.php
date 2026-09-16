@extends('layouts.base')

@section('title', 'Business Banking')

@section('content')
<!-- Business Hero Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-slate-900 via-primary-900 to-gray-900 dark:from-gray-900 dark:via-primary-900 dark:to-black overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25% 25%, #ffffff 1px, transparent 1px), radial-gradient(circle at 75% 75%, #ffffff 1px, transparent 1px); background-size: 60px 60px; animation: float 20s ease-in-out infinite;"></div>
        </div>
        <div class="absolute top-20 left-20 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-teal-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm text-white/90 rounded-full text-sm font-semibold mb-6 border border-white/20">
                <i class="fa-solid fa-briefcase mr-2"></i>
                For Businesses
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                Business Banking Solutions
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Comprehensive financial services designed to help your business grow and thrive
            </p>
        </div>
    </div>
</section>

<!-- Business Services Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Business Banking Services
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Everything your business needs to manage finances efficiently and scale successfully
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Business Checking -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-university text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Business Checking</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Flexible checking accounts with low fees and high transaction limits.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>No monthly maintenance fees</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Unlimited transactions</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Online banking included</li>
                </ul>
            </div>

            <!-- Business Savings -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-piggy-bank text-2xl text-green-600 dark:text-green-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Business Savings</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Competitive interest rates to help your business funds grow.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>High-yield interest rates</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>No minimum balance</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>FDIC insured</li>
                </ul>
            </div>

            <!-- Business Loans -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-handshake text-2xl text-purple-600 dark:text-purple-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Business Loans</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Flexible financing solutions for expansion, equipment, and working capital.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Competitive rates</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Quick approval process</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Flexible terms</li>
                </ul>
            </div>

            <!-- Merchant Services -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-credit-card text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Merchant Services</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Accept payments anywhere with our secure payment processing solutions.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Multiple payment methods</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Secure transactions</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Real-time reporting</li>
                </ul>
            </div>

            <!-- Cash Management -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-chart-line text-2xl text-teal-600 dark:text-teal-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Cash Management</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Optimize your cash flow with advanced treasury management tools.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Automated clearing</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Wire transfers</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Account reconciliation</li>
                </ul>
            </div>

            <!-- Business Credit Cards -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-credit-card text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Business Credit Cards</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Build business credit while earning rewards on everyday purchases.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Cashback rewards</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Expense tracking</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Employee cards</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Why Businesses Choose Us
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                We understand the unique challenges businesses face and provide tailored solutions
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-users text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Dedicated Support</h3>
                <p class="text-gray-600 dark:text-gray-300">Personal relationship managers for your business</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-mobile-alt text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Digital Banking</h3>
                <p class="text-gray-600 dark:text-gray-300">Advanced online and mobile banking platforms</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-chart-bar text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Financial Insights</h3>
                <p class="text-gray-600 dark:text-gray-300">Detailed reporting and analytics tools</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-shield-alt text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Security First</h3>
                <p class="text-gray-600 dark:text-gray-300">Enterprise-grade security for all transactions</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary-600 dark:bg-primary-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
            Ready to Bank with Us?
        </h2>
        <p class="text-xl text-primary-100 mb-8">
            Let's discuss how we can support your business growth and financial success
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                <i class="fa-solid fa-briefcase mr-3"></i>
                Open Business Account
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-primary-700 hover:bg-primary-800 text-white font-semibold rounded-2xl transition-all duration-300 border-2 border-white/30">
                <i class="fa-solid fa-phone mr-3"></i>
                Speak with Advisor
            </a>
        </div>
    </div>
</section>
@endsection 