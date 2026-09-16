@extends('layouts.base')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen min-h-[500px] lg:min-h-[600px] flex items-center justify-center overflow-hidden bg-primary-900">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="/images/home/metro.jpg" 
             alt="Modern banking experience" 
             class="w-full h-full object-cover object-[75%_25%] md:object-center"
             loading="eager"
             onload="this.style.opacity=1"
             style="opacity: 0; transition: opacity 0.3s ease;">
        <!-- Mobile Fallback Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 lg:hidden"></div>
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/30 lg:from-black/70 lg:via-black/50 lg:to-transparent"></div>
    </div>
    
    <!-- Content Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex items-center min-h-[400px] lg:min-h-[500px]">
            <!-- Hero Content -->
            <div class="text-white w-full lg:w-1/2 text-center lg:text-left">
                <!-- Mobile Logo Icon -->
                <div class="lg:hidden flex justify-center mb-6">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20">
                        <i class="fa-solid fa-university text-2xl text-white"></i>
                    </div>
                </div>
                
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4 lg:mb-6">
                    {{ $settings->site_name }}
                </h1>
                
                <!-- Mobile Tagline -->
                <p class="lg:hidden text-primary-100 text-lg font-medium mb-6">Your Digital Banking Partner</p>
                <P class="lg:hidden">We do banking differently. We believe that people come first, and that everyone deserves a great experience every step of the way.</P>
                <br>
                
                <!-- Desktop Description -->
                <p class="hidden lg:block text-xl text-gray-200 mb-8 max-w-2xl leading-relaxed">
                    We do banking differently. We believe that people come first, and that everyone deserves a great experience every step of the way.
                </p>
                
                <!-- Mobile Features 
                <div class="lg:hidden space-y-3 mb-8">
                    <div class="flex items-center justify-center text-white bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <i class="fa-solid fa-shield-halved text-primary-400 mr-3"></i>
                        <span class="text-sm font-medium">Secure & Protected Banking</span>
                    </div>
                    <div class="flex items-center justify-center text-white bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <i class="fa-solid fa-mobile-alt text-teal-400 mr-3"></i>
                        <span class="text-sm font-medium">Mobile Banking 24/7</span>
                    </div>
                    <div class="flex items-center justify-center text-white bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                        <i class="fa-solid fa-headset text-purple-400 mr-3"></i>
                        <span class="text-sm font-medium">Expert Support Always</span>
                    </div>
                </div> -->
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 lg:gap-4 mb-8 lg:mb-12">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 lg:px-8 py-3 lg:py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl lg:rounded-2xl transition-all duration-300 shadow-2xl shadow-primary-600/30 hover:shadow-primary-600/50 hover:-translate-y-1 hover:scale-105">
                        <i class="fa-solid fa-user-plus mr-2 lg:mr-3"></i>
                        Open Account Today
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 lg:px-8 py-3 lg:py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white font-semibold rounded-xl lg:rounded-2xl transition-all duration-300 border border-white/30 hover:border-white/50 hover:-translate-y-1">
                        <i class="fa-solid fa-sign-in-alt mr-2 lg:mr-3"></i>
                        Login to Banking
                    </a>
                </div>
                
                <!-- Mobile Stats -->
                <div class="lg:hidden grid grid-cols-2 gap-4 pt-6 border-t border-white/20">
                    <div class="text-center">
                        <p class="text-xl font-bold text-white">50K+</p>
                        <p class="text-xs text-primary-100">Happy Customers</p>
                    </div>
                    <div class="text-center">
                        <p class="text-xl font-bold text-white">$2.5B+</p>
                        <p class="text-xs text-primary-100">Assets Managed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Info Cards - Hidden on Mobile -->
    <div class="hidden lg:block absolute bottom-0 left-0 right-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-4 pb-8">
                <!-- Routing Number Card -->
                <div class="bg-primary-600 hover:bg-primary-700 transition-all duration-300 rounded-2xl p-6 text-white shadow-2xl hover:shadow-primary-600/30 hover:-translate-y-2 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-primary-100 text-sm font-medium mb-1">ROUTING #</p>
                            <p class="text-2xl font-bold">251480576</p>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-university text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Branch Hours Card -->
                <div class="bg-teal-500 hover:bg-teal-600 transition-all duration-300 rounded-2xl p-6 text-white shadow-2xl hover:shadow-teal-500/30 hover:-translate-y-2 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-teal-100 text-sm font-medium mb-1">BRANCH HOURS</p>
                            <p class="text-lg font-bold">Mon-Fri: 9AM-5PM</p>
                            <p class="text-sm text-teal-100">Sat: 9AM-1PM</p>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-clock text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Card -->
                <div class="bg-purple-600 hover:bg-purple-700 transition-all duration-300 rounded-2xl p-6 text-white shadow-2xl hover:shadow-purple-600/30 hover:-translate-y-2 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium mb-1">24/7 SUPPORT</p>
                            <p class="text-lg font-bold">1-800-BANKING</p>
                            <p class="text-sm text-purple-100">Always here to help</p>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-phone text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-30">
        <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-bounce"></div>
        </div>
    </div>
</section>

<!-- Rates Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-slate-50 via-white to-primary-50 dark:from-gray-900 dark:via-gray-800 dark:to-primary-900/20 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary-200 dark:bg-primary-800 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-200 dark:bg-teal-800 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12 lg:mb-16">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-100 to-primary-200 dark:from-primary-900/50 dark:to-primary-800/50 text-primary-700 dark:text-primary-300 rounded-full text-sm font-semibold mb-4 shadow-lg backdrop-blur-sm border border-primary-200/50 dark:border-primary-700/50">
                <i class="fa-solid fa-chart-line mr-2 animate-pulse"></i>
                {{ $settings->site_name }} Rates
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 via-primary-800 to-gray-900 dark:from-white dark:via-primary-300 dark:to-white bg-clip-text text-transparent mb-4">
                {{ $settings->site_name }} Member Care
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Discover competitive rates designed to help your money grow faster
            </p>
        </div>

        <!-- Rates Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <!-- High Yield Savings -->
            <div class="group relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-200/50 dark:border-gray-700/50 hover:border-primary-300/50 dark:hover:border-primary-600/50 overflow-hidden">
                <!-- Card Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 via-transparent to-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/50 dark:to-primary-800/50 rounded-2xl mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                        <i class="fa-solid fa-piggy-bank text-xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-primary-600 to-blue-600 dark:from-primary-400 dark:to-blue-400 bg-clip-text text-transparent mb-2">3.75%</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-3 font-medium">APY*</div>
                        <div class="font-bold text-gray-900 dark:text-white mb-2 text-sm">HIGH YIELD SAVINGS</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">High Yield Savings Rate</div>
                    </div>
                    <div class="mt-4 text-center">
                        <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 text-blue-700 dark:text-blue-400 rounded-full text-xs font-bold shadow-sm">
                            <i class="fa-solid fa-star mr-1 animate-pulse"></i>
                            FEATURED
                        </span>
                    </div>
                </div>
            </div>

            <!-- Certificate -->
            <div class="group relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-200/50 dark:border-gray-700/50 hover:border-teal-300/50 dark:hover:border-teal-600/50 overflow-hidden">
                <!-- Card Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-teal-500/10 via-transparent to-green-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-teal-100 to-teal-200 dark:from-teal-900/50 dark:to-teal-800/50 rounded-2xl mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                        <i class="fa-solid fa-certificate text-xl text-teal-600 dark:text-teal-400"></i>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-teal-600 to-green-600 dark:from-teal-400 dark:to-green-400 bg-clip-text text-transparent mb-2">3.65%</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-3 font-medium">APY*</div>
                        <div class="font-bold text-gray-900 dark:text-white mb-2 text-sm">18 MONTH CERTIFICATE</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">{{ $settings->site_name }} Certificate Rates</div>
                    </div>
                    <div class="mt-4 text-center">
                        <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-teal-100 to-teal-200 dark:from-teal-900/30 dark:to-teal-800/30 text-teal-700 dark:text-teal-400 rounded-full text-xs font-bold shadow-sm">
                            <i class="fa-solid fa-coins mr-1"></i>
                            SAVINGS
                        </span>
                    </div>
                </div>
            </div>

            <!-- Credit Card -->
            <div class="group relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-200/50 dark:border-gray-700/50 hover:border-purple-300/50 dark:hover:border-purple-600/50 overflow-hidden">
                <!-- Card Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 via-transparent to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900/50 dark:to-purple-800/50 rounded-2xl mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                        <i class="fa-solid fa-credit-card text-xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400 bg-clip-text text-transparent mb-2">4.00%</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-3 font-medium">APR*</div>
                        <div class="font-bold text-gray-900 dark:text-white mb-2 text-sm">CREDIT CARDS</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">{{ $settings->site_name }} Credit Card Rates</div>
                    </div>
                    <div class="mt-4 text-center">
                        <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-purple-100 to-purple-200 dark:from-purple-900/30 dark:to-purple-800/30 text-purple-700 dark:text-purple-400 rounded-full text-xs font-bold shadow-sm">
                            <i class="fa-solid fa-credit-card mr-1"></i>
                            CREDIT
                        </span>
                    </div>
                </div>
            </div>

            <!-- Loans -->
            <div class="group relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-200/50 dark:border-gray-700/50 hover:border-orange-300/50 dark:hover:border-orange-600/50 overflow-hidden">
                <!-- Card Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 via-transparent to-red-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-orange-100 to-orange-200 dark:from-orange-900/50 dark:to-orange-800/50 rounded-2xl mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                        <i class="fa-solid fa-hand-holding-dollar text-xl text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 dark:from-orange-400 dark:to-red-400 bg-clip-text text-transparent mb-2">15.49%</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-3 font-medium">APR*</div>
                        <div class="font-bold text-gray-900 dark:text-white mb-2 text-sm">LOANS</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">{{ $settings->site_name }} Standard Loan Rates</div>
                    </div>
                    <div class="mt-4 text-center">
                        <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-orange-100 to-orange-200 dark:from-orange-900/30 dark:to-orange-800/30 text-orange-700 dark:text-orange-400 rounded-full text-xs font-bold shadow-sm">
                            <i class="fa-solid fa-percentage mr-1"></i>
                            MORTGAGE
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="text-center mt-8 lg:mt-12">
            <div class="inline-flex items-center px-4 py-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-full shadow-lg border border-gray-200/50 dark:border-gray-700/50">
                <i class="fa-solid fa-info-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                <p class="text-sm text-gray-600 dark:text-gray-300 font-medium">
                    *Annual Percentage Yield. Rates subject to change. Terms and conditions apply.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 dark:from-primary-800 dark:via-primary-900 dark:to-gray-900 overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.1),transparent_50%)]"></div>
        <div class="absolute bottom-0 right-0 w-full h-full bg-[radial-gradient(circle_at_70%_80%,rgba(255,255,255,0.05),transparent_50%)]"></div>
        <!-- Floating Elements -->
        <div class="absolute top-20 left-20 w-32 h-32 bg-white/10 rounded-full blur-xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-48 h-48 bg-white/5 rounded-full blur-2xl animate-float-delayed"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 lg:mb-16">
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm text-white/90 rounded-full text-sm font-semibold mb-4 border border-white/20">
                <i class="fa-solid fa-concierge-bell mr-2 animate-pulse"></i>
                Our Services
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                How Can We Help You Today?
            </h2>
            <p class="text-xl text-primary-100 max-w-2xl mx-auto">
                Comprehensive banking solutions tailored to your needs
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Deposit Accounts -->
            <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center transition-all duration-500 hover:bg-white/10 hover:-translate-y-2 border border-white/10 hover:border-white/20 hover:shadow-2xl hover:shadow-white/10">
                <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 rounded-2xl mb-6 mx-auto group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg backdrop-blur-sm border border-white/20 group-hover:border-white/30">
                    <i class="fa-solid fa-university text-2xl text-white group-hover:text-primary-100"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary-100 transition-colors">Deposit Accounts</h3>
                <p class="text-primary-100 leading-relaxed group-hover:text-white/90 transition-colors">Secure your money with our high-yield savings and checking accounts designed for growth.</p>
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-white/50 to-transparent mx-auto"></div>
                </div>
            </div>

            <!-- Credit Cards -->
            <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center transition-all duration-500 hover:bg-white/10 hover:-translate-y-2 border border-white/10 hover:border-white/20 hover:shadow-2xl hover:shadow-white/10">
                <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 rounded-2xl mb-6 mx-auto group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg backdrop-blur-sm border border-white/20 group-hover:border-white/30">
                    <i class="fa-solid fa-credit-card text-2xl text-white group-hover:text-primary-100"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary-100 transition-colors">Credit Cards</h3>
                <p class="text-primary-100 leading-relaxed group-hover:text-white/90 transition-colors">Find the perfect credit card for your lifestyle and spending habits with competitive rates.</p>
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-white/50 to-transparent mx-auto"></div>
                </div>
            </div>

            <!-- Loans -->
            <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center transition-all duration-500 hover:bg-white/10 hover:-translate-y-2 border border-white/10 hover:border-white/20 hover:shadow-2xl hover:shadow-white/10">
                <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 rounded-2xl mb-6 mx-auto group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg backdrop-blur-sm border border-white/20 group-hover:border-white/30">
                    <i class="fa-solid fa-home text-2xl text-white group-hover:text-primary-100"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary-100 transition-colors">Loans</h3>
                <p class="text-primary-100 leading-relaxed group-hover:text-white/90 transition-colors">Get competitive rates on personal, auto, and home loans tailored to your financial goals.</p>
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-white/50 to-transparent mx-auto"></div>
                </div>
            </div>

            <!-- Business Banking -->
            <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center transition-all duration-500 hover:bg-white/10 hover:-translate-y-2 border border-white/10 hover:border-white/20 hover:shadow-2xl hover:shadow-white/10">
                <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 rounded-2xl mb-6 mx-auto group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg backdrop-blur-sm border border-white/20 group-hover:border-white/30">
                    <i class="fa-solid fa-briefcase text-2xl text-white group-hover:text-primary-100"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary-100 transition-colors">Business Banking</h3>
                <p class="text-primary-100 leading-relaxed group-hover:text-white/90 transition-colors">Comprehensive banking solutions designed to help your business thrive and grow.</p>
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-white/50 to-transparent mx-auto"></div>
                </div>
            </div>

            <!-- Wealth & Retire -->
            <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center transition-all duration-500 hover:bg-white/10 hover:-translate-y-2 border border-white/10 hover:border-white/20 hover:shadow-2xl hover:shadow-white/10">
                <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 rounded-2xl mb-6 mx-auto group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg backdrop-blur-sm border border-white/20 group-hover:border-white/30">
                    <i class="fa-solid fa-chart-pie text-2xl text-white group-hover:text-primary-100"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary-100 transition-colors">Wealth & Retire</h3>
                <p class="text-primary-100 leading-relaxed group-hover:text-white/90 transition-colors">Plan for your future with our expert investment and retirement planning services.</p>
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-white/50 to-transparent mx-auto"></div>
                </div>
            </div>

            <!-- About {{ $settings->site_name }} -->
            <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl p-6 text-center transition-all duration-500 hover:bg-white/10 hover:-translate-y-2 border border-white/10 hover:border-white/20 hover:shadow-2xl hover:shadow-white/10">
                <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 rounded-2xl mb-6 mx-auto group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg backdrop-blur-sm border border-white/20 group-hover:border-white/30">
                    <i class="fa-solid fa-info-circle text-2xl text-white group-hover:text-primary-100"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary-100 transition-colors">About {{ $settings->site_name }}</h3>
                <p class="text-primary-100 leading-relaxed group-hover:text-white/90 transition-colors">Learn more about our commitment to exceptional banking services and community support.</p>
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-white/50 to-transparent mx-auto"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Section 1 -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-white via-gray-50 to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-green-900/20 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-10 right-10 w-64 h-64 bg-green-200 dark:bg-green-800 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-primary-200 dark:bg-primary-800 rounded-full blur-3xl animate-pulse delay-500"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Image -->
            <div class="order-2 lg:order-1">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-green-500/20 to-primary-500/20 rounded-3xl blur-lg opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative rounded-3xl aspect-[4/3] overflow-hidden shadow-2xl group-hover:shadow-3xl transition-all duration-500 border border-white/20 dark:border-gray-700/50">
                        <img src="/images/home/feature.jpg" 
                             alt="Happy family with financial security" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="order-1 lg:order-2 space-y-6">
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-100 to-green-200 dark:from-green-900/50 dark:to-green-800/50 text-green-700 dark:text-green-300 rounded-full text-sm font-bold mb-6 shadow-lg backdrop-blur-sm border border-green-200/50 dark:border-green-700/50">
                    <i class="fa-solid fa-dollar-sign mr-2 animate-pulse"></i>
                    Get $200* With a Checking Account Built for You
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 via-green-700 to-gray-900 dark:from-white dark:via-green-300 dark:to-white bg-clip-text text-transparent leading-tight">
                    Start Building Your Financial Strength
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                    For a limited time, get a $200 when you open any new account, and what helps you reach your financial goals. You can open a new account online or in person at any of our locations.
                </p>
                
                <!-- Benefits List -->
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-check text-green-600 dark:text-green-400 text-sm"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">No minimum balance required</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-check text-green-600 dark:text-green-400 text-sm"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Free online and mobile banking</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-check text-green-600 dark:text-green-400 text-sm"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">24/7 customer support</span>
                    </div>
                </div>
                
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold rounded-2xl transition-all duration-300 shadow-2xl hover:shadow-primary-500/25 hover:-translate-y-1 hover:scale-105 group">
                    <i class="fa-solid fa-arrow-right mr-3 group-hover:translate-x-1 transition-transform"></i>
                    Open Account Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Feature Section 2 -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-slate-50 via-primary-50 to-teal-50 dark:from-gray-800 dark:via-primary-900/20 dark:to-teal-900/20 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-20 w-72 h-72 bg-teal-200 dark:bg-teal-800 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-primary-200 dark:bg-primary-800 rounded-full blur-3xl animate-float-delayed"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Content -->
            <div class="space-y-6">
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-100 to-teal-100 dark:from-primary-900/50 dark:to-teal-900/50 text-primary-700 dark:text-primary-300 rounded-full text-sm font-bold mb-4 shadow-lg backdrop-blur-sm border border-primary-200/50 dark:border-primary-700/50">
                    <i class="fa-solid fa-handshake mr-2 animate-pulse"></i>
                    Member-Focused Banking
                </div>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 via-primary-700 to-teal-700 dark:from-white dark:via-primary-300 dark:to-teal-300 bg-clip-text text-transparent leading-tight">
                    Building Strength Together
                </h2>
                
                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                    {{ $settings->site_name }} is a full-service credit union built on the foundation of providing our members with every step of their financial journey. We're committed to helping our members achieve their financial goals through personalized service and competitive rates.
                </p>
                
                <div class="space-y-4">
                    <div class="group flex items-start space-x-4 p-4 rounded-2xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 hover:bg-white/80 dark:hover:bg-gray-800/80 transition-all duration-300 hover:shadow-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/50 dark:to-primary-800/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-chart-line text-primary-600 dark:text-primary-400"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">Competitive Rates</h4>
                            <p class="text-gray-600 dark:text-gray-300">Better rates on savings, loans, and credit cards designed to maximize your financial growth.</p>
                        </div>
                    </div>
                    
                    <div class="group flex items-start space-x-4 p-4 rounded-2xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 hover:bg-white/80 dark:hover:bg-gray-800/80 transition-all duration-300 hover:shadow-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-teal-100 to-teal-200 dark:from-teal-900/50 dark:to-teal-800/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-users text-teal-600 dark:text-teal-400"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">Member-Focused</h4>
                            <p class="text-gray-600 dark:text-gray-300">We're owned by our members, not shareholders. Your success is our priority.</p>
                        </div>
                    </div>
                    
                    <div class="group flex items-start space-x-4 p-4 rounded-2xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 hover:bg-white/80 dark:hover:bg-gray-800/80 transition-all duration-300 hover:shadow-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900/50 dark:to-purple-800/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-heart text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">Community Committed</h4>
                            <p class="text-gray-600 dark:text-gray-300">Supporting local communities and causes that matter to our members.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Image Grid -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div class="group relative rounded-2xl aspect-square overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary-500/20 to-teal-500/20 rounded-2xl blur opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Team collaboration in banking" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                    </div>
                    <div class="group relative rounded-2xl aspect-[4/3] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500">
                        <div class="absolute -inset-1 bg-gradient-to-r from-teal-500/20 to-purple-500/20 rounded-2xl blur opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Professional banking consultant" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                    </div>
                </div>
                <div class="space-y-4 pt-8">
                    <div class="group relative rounded-2xl aspect-[4/3] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500">
                        <div class="absolute -inset-1 bg-gradient-to-r from-purple-500/20 to-primary-500/20 rounded-2xl blur opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1551836022-deb4988cc6c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Modern banking technology" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                    </div>
                    <div class="group relative rounded-2xl aspect-square overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary-500/20 to-teal-500/20 rounded-2xl blur opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="Community banking support" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PWA Download Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 dark:from-primary-800 dark:via-primary-900 dark:to-gray-900 overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.1),transparent_50%)]"></div>
        <div class="absolute bottom-0 right-0 w-full h-full bg-[radial-gradient(circle_at_70%_80%,rgba(255,255,255,0.05),transparent_50%)]"></div>
        <!-- Floating Elements -->
        <div class="absolute top-20 left-20 w-32 h-32 bg-white/10 rounded-full blur-xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-48 h-48 bg-white/5 rounded-full blur-2xl animate-float-delayed"></div>
        <!-- Floating App Icons -->
        <div class="absolute top-10 right-1/4 w-8 h-8 bg-white/20 rounded-xl rotate-12 animate-bounce" style="animation-delay: 0.5s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-6 h-6 bg-white/15 rounded-lg rotate-45 animate-bounce" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-1/3 right-1/3 w-4 h-4 bg-white/10 rounded-full animate-bounce" style="animation-delay: 2.5s;"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Content -->
            <div class="text-center lg:text-left text-white">
                <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm text-white/90 rounded-full text-sm font-semibold mb-6 border border-white/20">
                    <i class="fa-solid fa-mobile-alt mr-2 animate-pulse"></i>
                    Get Our Mobile App
                </div>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                    Banking Made Simple with Our {{ $settings->site_name }} App
                </h2>
                
                <p class="text-xl text-primary-100 mb-8 leading-relaxed">
                    Experience the future of mobile banking with our Progressive Web App. Get native app performance with the convenience of web technology - no app store required!
                </p>
                
                <!-- Features List -->
                <div class="grid sm:grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
                        <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fa-solid fa-wifi text-green-400"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-semibold text-white text-sm">Works Offline</h4>
                            <p class="text-primary-100 text-xs">Access your account anywhere</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fa-solid fa-rocket text-blue-400"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-semibold text-white text-sm">Lightning Fast</h4>
                            <p class="text-primary-100 text-xs">Instant loading & responses</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fa-solid fa-bell text-purple-400"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-semibold text-white text-sm">Push Notifications</h4>
                            <p class="text-primary-100 text-xs">Stay updated on transactions</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
                        <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fa-solid fa-shield-alt text-orange-400"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-semibold text-white text-sm">Bank-Level Security</h4>
                            <p class="text-primary-100 text-xs">Your data is always protected</p>
                        </div>
                    </div>
                </div>
                
                <!-- PWA Install Button -->
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <button id="installPWA" class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-primary-700 font-bold rounded-2xl transition-all duration-300 shadow-2xl hover:shadow-white/20 hover:-translate-y-1 hover:scale-105 transform">
                        <i class="fa-solid fa-download mr-3 text-lg"></i>
                        Install {{ $settings->site_name }} App
                    </button>
                    
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white font-semibold rounded-2xl transition-all duration-300 border border-white/30 hover:border-white/50 hover:-translate-y-1">
                        <i class="fa-solid fa-sign-in-alt mr-3"></i>
                        Open Web Banking
                    </a>
                </div>
                
                <!-- Browser Compatibility -->
                <div class="text-center lg:text-left">
                    <p class="text-primary-100 text-sm mb-3">Compatible with all modern browsers:</p>
                    <div class="flex justify-center lg:justify-start space-x-6">
                        <div class="flex items-center">
                            <i class="fab fa-chrome text-2xl text-white/80 mr-2"></i>
                            <span class="text-white/80 text-sm">Chrome</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fab fa-firefox text-2xl text-white/80 mr-2"></i>
                            <span class="text-white/80 text-sm">Firefox</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fab fa-safari text-2xl text-white/80 mr-2"></i>
                            <span class="text-white/80 text-sm">Safari</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fab fa-edge text-2xl text-white/80 mr-2"></i>
                            <span class="text-white/80 text-sm">Edge</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mock Phone Display -->
            <div class="relative flex justify-center lg:justify-end">
                <!-- Phone Frame -->
                <div class="relative w-80 h-[600px] bg-gradient-to-br from-gray-900 to-gray-800 rounded-[3rem] p-4 shadow-2xl">
                    <!-- Phone Screen -->
                    <div class="w-full h-full bg-white rounded-[2.5rem] overflow-hidden shadow-inner relative">
                        <!-- Status Bar -->
                        <div class="bg-primary-600 h-12 flex items-center justify-between px-6 text-white text-sm">
                            <div class="flex items-center space-x-1">
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                                <span class="ml-2 font-medium">{{ $settings->site_name }}</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fa-solid fa-wifi text-xs"></i>
                                <i class="fa-solid fa-battery-full text-xs"></i>
                                <span class="text-xs">100%</span>
                            </div>
                        </div>
                        
                        <!-- App Content -->
                        <div class="p-6 bg-gradient-to-br from-primary-50 to-white h-full">
                            <!-- Welcome Message -->
                            <div class="text-center mb-6">
                                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-university text-2xl text-primary-600"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Welcome Back!</h3>
                                <p class="text-gray-600 text-sm">Your banking at your fingertips</p>
                            </div>
                            
                            <!-- Quick Actions -->
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                                        <i class="fa-solid fa-paper-plane text-green-600 text-sm"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 text-xs">Transfer</h4>
                                    <p class="text-gray-500 text-xs">Send money</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                                        <i class="fa-solid fa-credit-card text-blue-600 text-sm"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 text-xs">Pay Bills</h4>
                                    <p class="text-gray-500 text-xs">Quick payments</p>
                                </div>
                            </div>
                            
                            <!-- Balance Card -->
                            <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-4 text-white">
                                <p class="text-primary-100 text-xs mb-1">Available Balance</p>
                                <h3 class="text-2xl font-bold mb-2">$12,847.50</h3>
                                <div class="flex justify-between items-center">
                                    <span class="text-primary-100 text-xs">****1234</span>
                                    <i class="fa-solid fa-eye text-primary-200"></i>
                                </div>
                            </div>
                            
                            <!-- PWA Install Prompt -->
                            <div class="mt-6 bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl p-4 text-white text-center animate-pulse">
                                <i class="fa-solid fa-download text-xl mb-2"></i>
                                <p class="text-sm font-semibold">Install for offline access</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Phone Button -->
                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-gray-600 rounded-full"></div>
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute -top-6 -right-6 w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center animate-float">
                    <i class="fa-solid fa-shield-alt text-white text-lg"></i>
                </div>
                <div class="absolute -bottom-6 -left-6 w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center animate-float" style="animation-delay: 1s;">
                    <i class="fa-solid fa-bolt text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-12 lg:py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-3">Hear From Our Customers</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center">
                <div class="flex justify-center mb-3">
                    <div class="flex space-x-1">
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-4 italic text-sm">
                    "I am impressed with the customer service and speed of payout."
                </p>
                <div class="flex items-center justify-center">
                    <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mr-3">
                        <i class="fa-solid fa-user text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div class="text-left">
                        <div class="font-semibold text-gray-900 dark:text-white text-sm">Sarah Morris</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Verified Customer</div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center">
                <div class="flex justify-center mb-3">
                    <div class="flex space-x-1">
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-4 italic text-sm">
                    "Excellent service and competitive rates. Highly recommended!"
                </p>
                <div class="flex items-center justify-center">
                    <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mr-3">
                        <i class="fa-solid fa-user text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div class="text-left">
                        <div class="font-semibold text-gray-900 dark:text-white text-sm">John Davis</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Business Owner</div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center">
                <div class="flex justify-center mb-3">
                    <div class="flex space-x-1">
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <i class="fa-solid fa-star text-yellow-400"></i>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-4 italic text-sm">
                    "The mobile app is fantastic and customer support is top-notch."
                </p>
                <div class="flex items-center justify-center">
                    <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mr-3">
                        <i class="fa-solid fa-user text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div class="text-left">
                        <div class="font-semibold text-gray-900 dark:text-white text-sm">Emily Johnson</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Personal Banking</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-12 lg:py-16 bg-primary-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-4 gap-6">
            <!-- Contact Info -->
            <div class="text-center lg:text-left">
                <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mx-auto lg:mx-0 mb-3">
                    <i class="fa-solid fa-clock text-lg text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2 text-sm">Banking Hours</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs">
                    Mon-Fri: 9AM-5PM<br>
                    Sat: 9AM-1PM<br>
                    Sun: Closed
                </p>
            </div>

            <div class="text-center lg:text-left">
                <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mx-auto lg:mx-0 mb-3">
                    <i class="fa-solid fa-phone text-lg text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2 text-sm">Phone Banking</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs">
                    Available 24/7<br>
                    Call: 1-800-BANKING<br>
                    International: +1-555-0123
                </p>
            </div>

            <div class="text-center lg:text-left">
                <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mx-auto lg:mx-0 mb-3">
                    <i class="fa-solid fa-envelope text-lg text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2 text-sm">Email Support</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs">
                    Response within 24hrs<br>
                    {{ $settings->contact_email }}
                </p>
            </div>

            <div class="text-center lg:text-left">
                <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mx-auto lg:mx-0 mb-3">
                    <i class="fa-solid fa-map-marker-alt text-lg text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2 text-sm">Visit Us</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs">
                    123 Banking Street<br>
                    Financial District<br>
                    New York, NY 10001
                </p>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // PWA Installation
    let deferredPrompt;
    const installButton = document.getElementById('installPWA');

    // Check if PWA is already installed
    function checkPWAInstalled() {
        if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone) {
            // PWA is already installed
            installButton.innerHTML = '<i class="fa-solid fa-check mr-3 text-lg"></i>App Installed';
            installButton.disabled = true;
            installButton.classList.add('opacity-75', 'cursor-not-allowed');
        }
    }

    // Listen for the beforeinstallprompt event
    window.addEventListener('beforeinstallprompt', (e) => {
        console.log('beforeinstallprompt event fired');
        // Prevent the mini-infobar from appearing on mobile
        e.preventDefault();
        // Stash the event so it can be triggered later
        deferredPrompt = e;
        // Show the install button
        installButton.style.display = 'inline-flex';
    });

    // Handle install button click
    installButton.addEventListener('click', async () => {
        console.log('Install button clicked');
        
        if (!deferredPrompt) {
            // PWA install prompt not available
            showPWAInstructions();
            return;
        }

        // Hide the install button
        installButton.style.display = 'none';
        
        // Show the install prompt
        deferredPrompt.prompt();
        
        // Wait for the user to respond to the prompt
        const { outcome } = await deferredPrompt.userChoice;
        console.log(`User response to the install prompt: ${outcome}`);
        
        if (outcome === 'accepted') {
            console.log('User accepted the install prompt');
            // Update button state
            installButton.innerHTML = '<i class="fa-solid fa-check mr-3 text-lg"></i>Installing...';
            installButton.disabled = true;
        } else {
            console.log('User dismissed the install prompt');
            // Show the button again
            installButton.style.display = 'inline-flex';
        }
        
        // Clear the deferredPrompt
        deferredPrompt = null;
    });

    // Listen for the app to be installed
    window.addEventListener('appinstalled', (e) => {
        console.log('PWA was installed');
        // Update button state
        installButton.innerHTML = '<i class="fa-solid fa-check mr-3 text-lg"></i>App Installed';
        installButton.disabled = true;
        installButton.classList.add('opacity-75', 'cursor-not-allowed');
        
        // Show success message
        showInstallSuccess();
    });

    // Show manual installation instructions
    function showPWAInstructions() {
        const userAgent = navigator.userAgent.toLowerCase();
        let instructions = '';
        
        if (userAgent.includes('chrome')) {
            instructions = `
                <div class="text-left space-y-2">
                    <h4 class="font-semibold text-gray-900 dark:text-white">Chrome Installation:</h4>
                    <ol class="list-decimal list-inside space-y-1 text-sm text-gray-600 dark:text-gray-300">
                        <li>Click the menu (⋮) in the top right corner</li>
                        <li>Select "Install {{ $settings->site_name }} App"</li>
                        <li>Click "Install" in the popup</li>
                    </ol>
                </div>
            `;
        } else if (userAgent.includes('firefox')) {
            instructions = `
                <div class="text-left space-y-2">
                    <h4 class="font-semibold text-gray-900 dark:text-white">Firefox Installation:</h4>
                    <ol class="list-decimal list-inside space-y-1 text-sm text-gray-600 dark:text-gray-300">
                        <li>Click the menu (☰) in the top right corner</li>
                        <li>Select "Install this site as an app"</li>
                        <li>Choose your installation preferences</li>
                    </ol>
                </div>
            `;
        } else if (userAgent.includes('safari')) {
            instructions = `
                <div class="text-left space-y-2">
                    <h4 class="font-semibold text-gray-900 dark:text-white">Safari Installation:</h4>
                    <ol class="list-decimal list-inside space-y-1 text-sm text-gray-600 dark:text-gray-300">
                        <li>Tap the Share button (□↗)</li>
                        <li>Scroll down and tap "Add to Home Screen"</li>
                        <li>Tap "Add" in the top right corner</li>
                    </ol>
                </div>
            `;
        } else {
            instructions = `
                <div class="text-left space-y-2">
                    <h4 class="font-semibold text-gray-900 dark:text-white">Manual Installation:</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Look for an "Install" or "Add to Home Screen" option in your browser's menu.
                        This will allow you to use our banking app like a native mobile application.
                    </p>
                </div>
            `;
        }
        
        // Show modal with instructions
        showModal('Install {{ $settings->site_name }} App', instructions);
    }

    // Show success message
    function showInstallSuccess() {
        showModal('App Installed Successfully!', `
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                    <i class="fa-solid fa-check text-2xl text-green-600"></i>
                </div>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ $settings->site_name }} App has been installed successfully! You can now access your banking app directly from your home screen.
                </p>
            </div>
        `);
    }

    // Simple modal function
    function showModal(title, content) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4';
        modal.innerHTML = `
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 max-w-md w-full shadow-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">${title}</h3>
                    <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i class="fa-solid fa-times text-xl"></i>
                    </button>
                </div>
                <div class="mb-6">${content}</div>
                <div class="text-center">
                    <button onclick="this.closest('.fixed').remove()" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">
                        Got it
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    // Check PWA status on page load
    document.addEventListener('DOMContentLoaded', function() {
        checkPWAInstalled();
        
        // Hide install button initially if PWA prompt is not available
        if (!window.BeforeInstallPromptEvent) {
            // installButton.style.display = 'none';
        }
    });

    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, observerOptions);

    // Observe all fade-in sections
    document.querySelectorAll('.fade-in-section').forEach(el => {
        observer.observe(el);
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endsection