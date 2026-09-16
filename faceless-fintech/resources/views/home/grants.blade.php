@extends('layouts.base')

@section('title', 'Grants & Financial Aid')

@section('content')
<!-- Grants Hero Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-slate-900 via-primary-900 to-gray-900 dark:from-gray-900 dark:via-primary-900 dark:to-black overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25% 25%, #ffffff 1px, transparent 1px), radial-gradient(circle at 75% 75%, #ffffff 1px, transparent 1px); background-size: 60px 60px; animation: float 20s ease-in-out infinite;"></div>
        </div>
        <div class="absolute top-20 left-20 w-96 h-96 bg-green-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-teal-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm text-white/90 rounded-full text-sm font-semibold mb-6 border border-white/20">
                <i class="fa-solid fa-hand-holding-dollar mr-2"></i>
                Financial Assistance
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                Grants & Financial Aid
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Supporting your dreams with accessible funding opportunities and financial assistance programs
            </p>
        </div>
    </div>
</section>

<!-- Available Grants Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Available Grant Programs
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Explore our comprehensive grant programs designed to support various financial needs
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Small Business Grant -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-store text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Small Business Grant</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Up to $50,000 in funding for small business startups and expansion projects.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>No collateral required</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Flexible repayment terms</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Business mentorship included</li>
                </ul>
                <a href="#apply" class="inline-flex items-center text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                    Learn More <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Education Grant -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-graduation-cap text-2xl text-purple-600 dark:text-purple-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Education Grant</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Financial assistance for higher education, vocational training, and skill development.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Up to $25,000 per year</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Merit-based selection</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Career guidance support</li>
                </ul>
                <a href="#apply" class="inline-flex items-center text-purple-600 dark:text-purple-400 font-semibold hover:text-purple-700 dark:hover:text-purple-300 transition-colors">
                    Learn More <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Home Ownership Grant -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-home text-2xl text-green-600 dark:text-green-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Home Ownership Grant</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Down payment assistance and closing cost support for first-time homebuyers.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Up to $15,000 assistance</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>First-time buyer priority</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Homebuyer education</li>
                </ul>
                <a href="#apply" class="inline-flex items-center text-green-600 dark:text-green-400 font-semibold hover:text-green-700 dark:hover:text-green-300 transition-colors">
                    Learn More <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Emergency Relief Grant -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-heart text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Emergency Relief Grant</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Immediate financial assistance for unexpected emergencies and hardships.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Quick approval process</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Up to $10,000 immediate</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>24/7 application support</li>
                </ul>
                <a href="#apply" class="inline-flex items-center text-red-600 dark:text-red-400 font-semibold hover:text-red-700 dark:hover:text-red-300 transition-colors">
                    Learn More <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Community Development Grant -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-users text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Community Development</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Support for community projects, non-profits, and local development initiatives.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Up to $100,000 funding</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Community impact focus</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Ongoing project support</li>
                </ul>
                <a href="#apply" class="inline-flex items-center text-orange-600 dark:text-orange-400 font-semibold hover:text-orange-700 dark:hover:text-orange-300 transition-colors">
                    Learn More <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Healthcare Grant -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-stethoscope text-2xl text-teal-600 dark:text-teal-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Healthcare Grant</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Medical expense assistance and healthcare accessibility support programs.
                </p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Medical bill assistance</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Prescription drug support</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i>Health insurance help</li>
                </ul>
                <a href="#apply" class="inline-flex items-center text-teal-600 dark:text-teal-400 font-semibold hover:text-teal-700 dark:hover:text-teal-300 transition-colors">
                    Learn More <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Application Process Section -->
<section id="apply" class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                How to Apply
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Simple steps to get the financial assistance you need
            </p>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">1</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Choose Program</h3>
                <p class="text-gray-600 dark:text-gray-300">Select the grant program that best fits your needs</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">2</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Submit Application</h3>
                <p class="text-gray-600 dark:text-gray-300">Complete our online application with required documents</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">3</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Review Process</h3>
                <p class="text-gray-600 dark:text-gray-300">Our team reviews your application within 5-7 business days</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">4</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Receive Funding</h3>
                <p class="text-gray-600 dark:text-gray-300">Approved grants are disbursed directly to your account</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary-600 dark:bg-primary-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
            Ready to Apply for a Grant?
        </h2>
        <p class="text-xl text-primary-100 mb-8">
            Take the first step towards achieving your financial goals with our grant programs
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                <i class="fa-solid fa-file-alt mr-3"></i>
                Start Application
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-primary-700 hover:bg-primary-800 text-white font-semibold rounded-2xl transition-all duration-300 border-2 border-white/30">
                <i class="fa-solid fa-phone mr-3"></i>
                Speak with Advisor
            </a>
        </div>
    </div>
</section>
@endsection