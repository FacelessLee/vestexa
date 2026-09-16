@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-8xl mx-auto">
        <!-- Alerts -->
        <x-danger-alert />
        <x-success-alert />
        <x-error-alert />

        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Account Verification',
                'showBackButton' => true,
                'backUrl' => route('dashboard'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400 border border-gray-200 dark:border-gray-600 transition-colors">
                    <i class="fas fa-arrow-left text-xs"></i>
                </a>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Account Verification</h1>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <!-- Content Header -->
            <div class="border-b border-gray-200/50 dark:border-gray-700/50 px-4 lg:px-5 py-3">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-primary-600 dark:text-primary-400 mr-2 text-lg"></i>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Verify Your Identity</h2>
                </div>
            </div>
            
            <!-- Form Content -->
            <div class="p-4 lg:p-5">
                <div class="max-w-6xl mx-auto">
                    <!-- Welcome Message -->
                    @if (Auth::user()->account_verify == 'Verified' or Auth::user()->account_verify == 'Under Review')
                        @if (Auth::user()->account_verify == 'Under Review')
                            <div class="bg-yellow-50/90 dark:bg-yellow-900/20 backdrop-blur-sm border-l-4 border-yellow-400 dark:border-yellow-500 p-4 rounded-r-xl mb-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-triangle text-yellow-400 dark:text-yellow-500 text-lg"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-lg font-medium text-yellow-800 dark:text-yellow-300">Account Under Review</h3>
                                        <div class="mt-2 text-yellow-700 dark:text-yellow-400 text-sm">
                                            <p>Hi {{Auth::user()->name}} {{Auth::user()->lastname}}, your {{$settings->site_name}} internet banking account is currently Under Review. Our team is reviewing your information, and this process typically takes 24-48 hours.</p>
                                            <p class="mt-2">If you have any questions, please contact our customer care team for assistance.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center my-6">
                                <i class="fas fa-hourglass-half text-gray-400 dark:text-gray-500 text-4xl mx-auto mb-3"></i>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Your application is being processed. We'll notify you once the review is complete.</p>
                            </div>
                        @else
                            <div class="bg-green-50/90 dark:bg-green-900/20 backdrop-blur-sm border-l-4 border-green-400 dark:border-green-500 p-4 rounded-r-xl mb-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-green-500 dark:text-green-400 text-lg"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-lg font-medium text-green-800 dark:text-green-300">Account Verified</h3>
                                        <div class="mt-2 text-green-700 dark:text-green-400 text-sm">
                                            <p>Congratulations! Your account has been successfully verified. You now have full access to all features and services.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center my-6">
                                <i class="fas fa-shield-alt text-primary-500 dark:text-primary-400 text-4xl mx-auto mb-3"></i>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Thank you for completing the verification process.</p>
                            </div>
                        @endif
                    @else
                        <!-- Welcome Card -->
                        <div class="bg-white/80 dark:bg-gray-700/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-4 mb-4">
                            <div class="flex items-center mb-4">
                                <div class="h-10 w-10 rounded-full bg-primary-100/80 dark:bg-primary-900/30 backdrop-blur-sm flex items-center justify-center mr-3">
                                    <i class="fas fa-user-check text-primary-600 dark:text-primary-400 text-lg"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Welcome to {{$settings->site_name}}</h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Complete your account verification to access all features</p>
                                </div>
                            </div>
                            
                            <div class="prose prose-sm max-w-none text-gray-600 dark:text-gray-400 mb-4 text-sm">
                                <p class="mb-2"><strong class="text-gray-900 dark:text-white">Dear {{Auth::user()->name}} {{Auth::user()->lastname}} {{Auth::user()->middlename}},</strong></p>
                                
                                <p>Welcome Onboard! {{$settings->site_name}} is the market's most innovative and fastest-growing company in the financial industry. We look forward to working with you to help you get the most out of our financial services and realize your banking goals.</p>
                                
                                <p>Here at {{$settings->site_name}}, we are committed to providing a wide variety of savings, investment, and loan products, all designed to meet your specific needs. Our services are being used by over two million customers around the world.</p>
                                
                                <p>Our excellent customer support team is available 24/7 to help you with any questions. You can contact them at: <a href="mailto:{{$settings->contact_email}}" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">{{$settings->contact_email}}</a>.</p>
                                
                                <p>We need a little more information to complete your registration, including completing the AML/KYC form. Please review our terms and conditions below before proceeding.</p>
                            </div>
                        </div>
                    
                        <!-- Terms and Conditions Card -->
                        <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-file-alt text-primary-600 dark:text-primary-400 mr-2 text-sm"></i>
                                Terms and Conditions
                            </h3>
                            
                            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 h-64 overflow-y-auto text-sm text-gray-700 dark:text-gray-300 mb-4">
                                <p class="mb-4">
                                    Before you can start using our online service you must agree to be bound by the conditions below. You must read the 
                                    conditions before you decide whether to accept them. If you agree to be bound by these conditions, please click the 
                                    I accept button below. If you click on the Decline button, you will not be able to continue your registration for our 
                                    online services. We strongly recommend that you print a copy of these conditions for your reference.
                                </p>
                                
                                <h4 class="font-semibold text-gray-900 dark:text-white mt-4 mb-2">1. DEFINITIONS</h4>
                                <p class="mb-2">In these conditions the following words have the following meanings:</p>
                                <ul class="list-disc pl-6 mb-4 space-y-1">
                                    <li><span class="font-medium">ACCOUNT:</span> any account which you hold and access via our online service.</li>
                                    <li><span class="font-medium">ADDITIONAL SECURITY DETAILS:</span> the additional information you give us to help us identify you including the additional security question you provide yourself.</li>
                                    <li><span class="font-medium">IDENTITY DETAILS:</span> the access code we may provide you with.</li>
                                    <li><span class="font-medium">{{ $settings->site_name }} ACCOUNT NUMBER, PASSWORD and ACCOUNT PIN:</span> you choose to identify yourself when you use our online service.</li>
                                    <li><span class="font-medium">YOU, YOUR and YOURSELF:</span> refer to the person who has entered into this agreement with us.</li>
                                </ul>
                                
                                <h4 class="font-semibold text-gray-900 dark:text-white mt-4 mb-2">2. USING THE ONLINE SERVICE</h4>
                                <ol class="list-alpha pl-6 mb-4 space-y-2">
                                    <li>These conditions apply to your use of our online service and in relation to any accounts. They explain the relationship between you and us in relation to our online service. You should read these conditions carefully to understand how these services work and your and our rights and duties under them. If there is a conflict between these conditions and your account conditions, these conditions will apply. This means that, when you use our online service both sets of conditions will apply unless they contradict each other in which case, the relevant condition in these conditions apply.</li>
                                    <li>If any of your accounts is a joint account, these conditions apply to all of you together and any of you separately. If more than one of you uses our online service you must each choose your own username, password and additional security details.</li>
                                    <li>By registering to use our online service, you accept these conditions and agree that we may communicate with you by e-mail or through our website.</li>
                                    <li>When you use our online service you must follow the instructions we give you from time to time. You are responsible for ensuring that your computer, software and other equipment are capable of being used with our online service.</li>
                                    <li>Our online sites are secure. Disconnection from the Internet or leaving these sites will not automatically log you off. You must always use the log off facility when you are finished and never leave your machine unattended while you are logged in. As a security measure, if you have not used the sites for more than a specified period of time we will ask you to log in again.</li>
                                </ol>
                                
                                <h4 class="font-semibold text-gray-900 dark:text-white mt-4 mb-2">3. WHAT RULES APPLY TO SECURITY?</h4>
                                <ol class="list-alpha pl-6 mb-4 space-y-2">
                                    <li>As part of the registration for our online service you must provide us with identity details before we will allow you to use the services for the first time. You must enter your identity details immediately after signing in, so we can identify you.</li>
                                    <li>Every time you use our online service you must give us your username, your password and the answer to an additional security question.</li>
                                    <li>You can change your username or password online by following the instructions on the screen.</li>
                                    <li>For administration or security reasons, we can require you to choose a new username or change your password before you use (or carry on using) our online service.</li>
                                    <li>You must not write down, store (whether encrypted or otherwise) on your computer or let anyone else know your password, identity details or additional security details, and the fact that they are for use with your accounts.</li>
                                </ol>
                                
                                <h4 class="font-semibold text-gray-900 dark:text-white mt-4 mb-2">4. WHAT IS THE EXTENT OF YOUR LIABILITY?</h4>
                                <ol class="list-alpha pl-6 mb-4 space-y-2">
                                    <li>If you are a victim of online fraud, we guarantee that you won't lose any money on your accounts and will always be reimbursed in full.</li>
                                    <li>Unless you are a victim of fraud you are responsible for all instructions and other information sent using your username, password or additional security details.</li>
                                    <li>You will not be held responsible for any instructions or information sent after you have told us that someone knows your password or additional security details and has used any of them to access our online service.</li>
                                    <li>{{$settings->site_name}} does not accept responsibility for any loss you or anybody else may suffer because any instructions or information you sent us are sent in error, fail to reach us or are distorted unless you have been the victim of fraud.</li>
                                    <li>{{$settings->site_name}} does not accept responsibility for any loss you or anybody else may suffer because any instructions or information we send you fail to reach you or are distorted unless you have been the victim of fraud.</li>
                                </ol>
                                
                                <h4 class="font-semibold text-gray-900 dark:text-white mt-4 mb-2">5. HOW WE CAN CHANGE THESE CONDITIONS</h4>
                                <ol class="list-alpha pl-6 mb-4 space-y-2">
                                    <li>{{$settings->site_name}} may change these conditions for any reason by giving you written notice or publishing the change on our website.</li>
                                    <li>We may send all written notices to you at the last e-mail address you gave us. You must let us know immediately if you change your e-mail address (you can do so online), to make sure that we have your current e-mail address at all times.</li>
                                </ol>
                                
                                <h4 class="font-semibold text-gray-900 dark:text-white mt-4 mb-2">6. GENERAL</h4>
                                <p>{{$settings->site_name}} service is available to you if you are 18 years of age or over.</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3 justify-center sm:justify-start">
                                <a href="{{ route('kycform') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                                    <i class="fas fa-check-circle mr-2 text-xs"></i>
                                    I Accept & Proceed to Verification
                                </a>
                                
                                <a href="{{ route('logout') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-times-circle mr-2 text-gray-500 dark:text-gray-400 text-xs"></i>
                                    Decline
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Support Section -->
        <div class="mt-6 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="p-4 lg:p-5">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-primary-50/80 dark:bg-primary-900/30 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <i class="fas fa-life-ring text-primary-600 dark:text-primary-400 text-lg"></i>
                        </div>
                    </div>
                    <div class="flex-grow text-center md:text-left">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Need help with verification?</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Our support team is available 24/7 to assist you with the verification process. Reach out with any questions.</p>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('support') }}" class="inline-flex items-center justify-center px-4 py-2 border border-primary-600 dark:border-primary-500 rounded-lg shadow-sm text-sm font-medium text-primary-600 dark:text-primary-400 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-primary-50 dark:hover:bg-primary-900/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200">
                            <i class="fas fa-comments mr-2 text-xs"></i>
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection