@extends('layouts.base')

@section('title', 'Loans & Credit')

@section('content')
<!-- Loans Hero Section -->
<section class="relative py-16 lg:py-20 bg-gradient-to-br from-slate-900 via-primary-900 to-gray-900 dark:from-gray-900 dark:via-primary-900 dark:to-black overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25% 25%, #ffffff 1px, transparent 1px), radial-gradient(circle at 75% 75%, #ffffff 1px, transparent 1px); background-size: 60px 60px; animation: float 20s ease-in-out infinite;"></div>
        </div>
        <div class="absolute top-20 left-20 w-96 h-96 bg-green-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm text-white/90 rounded-full text-sm font-semibold mb-6 border border-white/20">
                <i class="fa-solid fa-hand-holding-dollar mr-2"></i>
                Lending Solutions
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                Loans & Financing
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Competitive rates and flexible terms to help you achieve your financial goals
            </p>
        </div>
    </div>
</section>

<!-- Loan Types Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Loan Options
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Find the perfect loan solution for your personal or business needs
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Home Loans -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-home text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Home Loans</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Competitive mortgage rates for first-time buyers and refinancing.
                </p>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <div class="flex justify-between">
                        <span>Interest Rate:</span>
                        <span class="font-semibold text-blue-600 dark:text-blue-400">From 3.25% APR</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Loan Amount:</span>
                        <span class="font-semibold">Up to $1M</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Term:</span>
                        <span class="font-semibold">15-30 years</span>
                    </div>
                </div>
                <a href="#apply" class="inline-flex items-center text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                    Apply Now <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Auto Loans -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-car text-2xl text-green-600 dark:text-green-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Auto Loans</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Finance your dream car with our competitive auto loan rates.
                </p>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <div class="flex justify-between">
                        <span>Interest Rate:</span>
                        <span class="font-semibold text-green-600 dark:text-green-400">From 2.99% APR</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Loan Amount:</span>
                        <span class="font-semibold">Up to $100K</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Term:</span>
                        <span class="font-semibold">3-7 years</span>
                    </div>
                </div>
                <a href="#apply" class="inline-flex items-center text-green-600 dark:text-green-400 font-semibold hover:text-green-700 dark:hover:text-green-300 transition-colors">
                    Apply Now <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Personal Loans -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-user text-2xl text-purple-600 dark:text-purple-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Personal Loans</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Flexible personal loans for any purpose with quick approval.
                </p>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <div class="flex justify-between">
                        <span>Interest Rate:</span>
                        <span class="font-semibold text-purple-600 dark:text-purple-400">From 5.99% APR</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Loan Amount:</span>
                        <span class="font-semibold">Up to $50K</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Term:</span>
                        <span class="font-semibold">2-7 years</span>
                    </div>
                </div>
                <a href="#apply" class="inline-flex items-center text-purple-600 dark:text-purple-400 font-semibold hover:text-purple-700 dark:hover:text-purple-300 transition-colors">
                    Apply Now <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Business Loans -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-briefcase text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Business Loans</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Grow your business with our flexible commercial lending solutions.
                </p>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <div class="flex justify-between">
                        <span>Interest Rate:</span>
                        <span class="font-semibold text-orange-600 dark:text-orange-400">From 4.25% APR</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Loan Amount:</span>
                        <span class="font-semibold">Up to $5M</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Term:</span>
                        <span class="font-semibold">1-25 years</span>
                    </div>
                </div>
                <a href="#apply" class="inline-flex items-center text-orange-600 dark:text-orange-400 font-semibold hover:text-orange-700 dark:hover:text-orange-300 transition-colors">
                    Apply Now <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Student Loans -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-graduation-cap text-2xl text-teal-600 dark:text-teal-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Student Loans</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Invest in your education with competitive student loan rates.
                </p>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <div class="flex justify-between">
                        <span>Interest Rate:</span>
                        <span class="font-semibold text-teal-600 dark:text-teal-400">From 3.75% APR</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Loan Amount:</span>
                        <span class="font-semibold">Up to $200K</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Term:</span>
                        <span class="font-semibold">5-20 years</span>
                    </div>
                </div>
                <a href="#apply" class="inline-flex items-center text-teal-600 dark:text-teal-400 font-semibold hover:text-teal-700 dark:hover:text-teal-300 transition-colors">
                    Apply Now <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Home Equity -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-house-circle-check text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Home Equity</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Tap into your home's equity for major expenses or investments.
                </p>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    <div class="flex justify-between">
                        <span>Interest Rate:</span>
                        <span class="font-semibold text-red-600 dark:text-red-400">From 4.50% APR</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Loan Amount:</span>
                        <span class="font-semibold">Up to $500K</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Term:</span>
                        <span class="font-semibold">5-30 years</span>
                    </div>
                </div>
                <a href="#apply" class="inline-flex items-center text-red-600 dark:text-red-400 font-semibold hover:text-red-700 dark:hover:text-red-300 transition-colors">
                    Apply Now <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Loan Calculator Section -->
<section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Loan Calculator
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Estimate your monthly payments with our loan calculator
            </p>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-xl">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Loan Amount</label>
                        <input type="number" id="loanAmount" placeholder="$25,000" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Interest Rate (%)</label>
                        <input type="number" id="interestRate" placeholder="5.99" step="0.01"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Loan Term (years)</label>
                        <input type="number" id="loanTerm" placeholder="5"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>
                    <button onclick="calculateLoan()" 
                            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-xl transition-colors">
                        Calculate Payment
                    </button>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Breakdown</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Monthly Payment:</span>
                            <span id="monthlyPayment" class="font-bold text-primary-600 dark:text-primary-400">$0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Total Interest:</span>
                            <span id="totalInterest" class="font-bold text-gray-900 dark:text-white">$0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Total Payment:</span>
                            <span id="totalPayment" class="font-bold text-gray-900 dark:text-white">$0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Process Section -->
<section id="apply" class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Easy Application Process
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Get approved in minutes with our streamlined application process
            </p>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">1</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Apply Online</h3>
                <p class="text-gray-600 dark:text-gray-300">Complete our secure online application in minutes</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">2</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Quick Review</h3>
                <p class="text-gray-600 dark:text-gray-300">Our team reviews your application within 24 hours</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">3</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Get Approved</h3>
                <p class="text-gray-600 dark:text-gray-300">Receive your approval decision and loan terms</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">4</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Receive Funds</h3>
                <p class="text-gray-600 dark:text-gray-300">Funds deposited directly into your account</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary-600 dark:bg-primary-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
            Ready to Apply for a Loan?
        </h2>
        <p class="text-xl text-primary-100 mb-8">
            Get started with your loan application today and receive a decision within 24 hours
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                <i class="fa-solid fa-file-alt mr-3"></i>
                Apply Now
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-primary-700 hover:bg-primary-800 text-white font-semibold rounded-2xl transition-all duration-300 border-2 border-white/30">
                <i class="fa-solid fa-phone mr-3"></i>
                Speak with Advisor
            </a>
        </div>
    </div>
</section>

<script>
function calculateLoan() {
    const loanAmount = parseFloat(document.getElementById('loanAmount').value) || 0;
    const interestRate = parseFloat(document.getElementById('interestRate').value) || 0;
    const loanTerm = parseFloat(document.getElementById('loanTerm').value) || 0;
    
    if (loanAmount > 0 && interestRate > 0 && loanTerm > 0) {
        const monthlyRate = interestRate / 100 / 12;
        const numberOfPayments = loanTerm * 12;
        
        const monthlyPayment = loanAmount * (monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / 
                              (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
        
        const totalPayment = monthlyPayment * numberOfPayments;
        const totalInterest = totalPayment - loanAmount;
        
        document.getElementById('monthlyPayment').textContent = '$' + monthlyPayment.toFixed(2);
        document.getElementById('totalInterest').textContent = '$' + totalInterest.toFixed(2);
        document.getElementById('totalPayment').textContent = '$' + totalPayment.toFixed(2);
    }
}
</script>
@endsection 