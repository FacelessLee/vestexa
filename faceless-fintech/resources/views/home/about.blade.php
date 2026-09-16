@extends('layouts.base')

@section('title', 'About Us')

@section('content')
<!-- About Hero Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-slate-900 via-primary-900 to-gray-900 dark:from-gray-900 dark:via-primary-900 dark:to-black overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25% 25%, #ffffff 1px, transparent 1px), radial-gradient(circle at 75% 75%, #ffffff 1px, transparent 1px); background-size: 60px 60px; animation: float 20s ease-in-out infinite;"></div>
        </div>
        <div class="absolute top-20 left-20 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-teal-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm text-white/90 rounded-full text-sm font-semibold mb-6 border border-white/20">
                <i class="fa-solid fa-building-columns mr-2"></i>
                Our Story
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                About {{ $settings->site_name }}
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Trusted banking partner committed to your financial success since our founding
            </p>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                    Our Mission
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                    At {{ $settings->site_name }}, we're dedicated to empowering individuals, families, and businesses to achieve their financial goals through innovative banking solutions, personalized service, and unwavering commitment to excellence.
                </p>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    We believe that banking should be simple, secure, and accessible to everyone, which is why we continuously invest in technology and training to deliver the best possible experience for our customers.
                </p>
            </div>
            <div class="relative">
                <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Modern banking office" 
                         class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-6 -right-6 bg-primary-600 text-white p-6 rounded-2xl shadow-xl">
                    <div class="text-2xl font-bold">50K+</div>
                    <div class="text-sm">Happy Customers</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Our Core Values
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                These values guide everything we do and shape our commitment to our customers and community
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-shield-halved text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Trust & Security</h3>
                <p class="text-gray-600 dark:text-gray-300">Your financial security is our top priority with industry-leading protection measures.</p>
            </div>

            <div class="text-center group">
                <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-lightbulb text-2xl text-teal-600 dark:text-teal-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Innovation</h3>
                <p class="text-gray-600 dark:text-gray-300">We embrace cutting-edge technology to deliver modern banking solutions.</p>
            </div>

            <div class="text-center group">
                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-heart text-2xl text-purple-600 dark:text-purple-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Customer Care</h3>
                <p class="text-gray-600 dark:text-gray-300">Personalized service and support whenever you need it, however you prefer.</p>
            </div>

            <div class="text-center group">
                <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-users text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Community</h3>
                <p class="text-gray-600 dark:text-gray-300">Supporting local communities and contributing to economic growth.</p>
            </div>
        </div>
    </div>
</section>

<!-- History Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Our Journey
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                From humble beginnings to becoming a trusted financial institution
            </p>
        </div>

        <div class="space-y-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/3">
                    <div class="bg-primary-100 dark:bg-primary-900/30 rounded-2xl p-6 text-center">
                        <div class="text-3xl font-bold text-primary-600 dark:text-primary-400 mb-2">1985</div>
                        <div class="text-gray-900 dark:text-white font-semibold">Founded</div>
                    </div>
                </div>
                <div class="md:w-2/3">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">The Beginning</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $settings->site_name }} was founded with a simple mission: to provide honest, reliable banking services to our local community.</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row-reverse items-center gap-8">
                <div class="md:w-1/3">
                    <div class="bg-teal-100 dark:bg-teal-900/30 rounded-2xl p-6 text-center">
                        <div class="text-3xl font-bold text-teal-600 dark:text-teal-400 mb-2">2005</div>
                        <div class="text-gray-900 dark:text-white font-semibold">Digital Era</div>
                    </div>
                </div>
                <div class="md:w-2/3 text-right">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Online Banking Launch</h3>
                    <p class="text-gray-600 dark:text-gray-300">We embraced the digital revolution, launching our first online banking platform to serve customers 24/7.</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/3">
                    <div class="bg-purple-100 dark:bg-purple-900/30 rounded-2xl p-6 text-center">
                        <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2">2015</div>
                        <div class="text-gray-900 dark:text-white font-semibold">Mobile First</div>
                    </div>
                </div>
                <div class="md:w-2/3">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Mobile Banking Revolution</h3>
                    <p class="text-gray-600 dark:text-gray-300">Launched our award-winning mobile app, making banking accessible anywhere, anytime.</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row-reverse items-center gap-8">
                <div class="md:w-1/3">
                    <div class="bg-orange-100 dark:bg-orange-900/30 rounded-2xl p-6 text-center">
                        <div class="text-3xl font-bold text-orange-600 dark:text-orange-400 mb-2">Today</div>
                        <div class="text-gray-900 dark:text-white font-semibold">Innovation</div>
                    </div>
                </div>
                <div class="md:w-2/3 text-right">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Leading the Future</h3>
                    <p class="text-gray-600 dark:text-gray-300">Continuing to innovate with AI-powered services, advanced security, and sustainable banking practices.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-primary-600 dark:bg-primary-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                By the Numbers
            </h2>
            <p class="text-xl text-primary-100">
                Our growth reflects the trust our customers place in us
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-bold text-white mb-2">50K+</div>
                <div class="text-primary-100">Active Customers</div>
            </div>
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-bold text-white mb-2">$2.5B</div>
                <div class="text-primary-100">Assets Under Management</div>
            </div>
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-bold text-white mb-2">25</div>
                <div class="text-primary-100">Branch Locations</div>
            </div>
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-bold text-white mb-2">99.9%</div>
                <div class="text-primary-100">Uptime Guarantee</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            Ready to Join Our Family?
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
            Experience the difference of banking with a trusted partner who puts your financial success first.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                <i class="fa-solid fa-user-plus mr-3"></i>
                Open an Account
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-900 dark:text-white font-semibold rounded-2xl transition-all duration-300">
                <i class="fa-solid fa-phone mr-3"></i>
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection 