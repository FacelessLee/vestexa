{{--
    Mobile Support Widget Partial
    Shows support options, FAQs, and contact methods
    Expects: $settings (for contact info)
--}}

@php
    $supportOptions = [
        [
            'icon' => 'fa-solid fa-message',
            'title' => 'Live Chat',
            'description' => 'Get instant help from our team',
            'action' => 'Start Chat',
            'color' => 'from-blue-500 to-blue-600',
            'bg_color' => 'bg-blue-100 dark:bg-blue-900/30',
            'text_color' => 'text-blue-600 dark:text-blue-400',
            'route' => route('support'),
            'available' => true
        ],
        [
            'icon' => 'fa-solid fa-envelope',
            'title' => 'Email Support',
            'description' => 'Send us a detailed message',
            'action' => 'Send Email',
            'color' => 'from-green-500 to-green-600',
            'bg_color' => 'bg-green-100 dark:bg-green-900/30',
            'text_color' => 'text-green-600 dark:text-green-400',
            'route' => 'mailto:' . ($settings->contact_email ?? 'support@example.com'),
            'available' => true
        ],
        [
            'icon' => 'fa-solid fa-phone',
            'title' => 'Phone Support',
            'description' => 'Call us for urgent matters',
            'action' => 'Call Now',
            'color' => 'from-purple-500 to-purple-600',
            'bg_color' => 'bg-purple-100 dark:bg-purple-900/30',
            'text_color' => 'text-purple-600 dark:text-purple-400',
            'route' => 'tel:' . ($settings->contact_phone ?? '+1-800-SUPPORT'),
            'available' => !empty($settings->contact_phone)
        ]
    ];
    

@endphp

<div class="px-4 mb-4">
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Need Help?</h3>
        <a href="{{ route('support') }}" class="text-xs text-primary-600 dark:text-primary-400 font-medium flex items-center hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            Support Center
            <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
        </a>
    </div>
    
    <!-- Support Options -->
    <div class="grid grid-cols-2 gap-3 mb-4">
        @foreach($supportOptions as $option)
            @if($option['available'])
            <a href="{{ $option['route'] }}" class="block">
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 p-3 hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <div class="text-center">
                        <div class="w-10 h-10 {{ $option['bg_color'] }} rounded-xl flex items-center justify-center mx-auto mb-2">
                            <i class="{{ $option['icon'] }} {{ $option['text_color'] }} text-sm"></i>
                        </div>
                        <h4 class="text-xs font-semibold text-gray-900 dark:text-white mb-1">{{ $option['title'] }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-tight">{{ $option['description'] }}</p>
                    </div>
                </div>
            </a>
            @endif
        @endforeach
    </div>
    
    <!-- Contact Information Card -->
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-white/20 dark:border-gray-700/50 overflow-hidden">
        <!-- Header -->
        <div class="px-4 py-3 bg-gradient-to-r from-primary-50/80 to-blue-50/50 dark:from-gray-900/80 dark:to-gray-800/50 border-b border-primary-100/50 dark:border-gray-700/50">
            <div class="flex items-center">
                <div class="w-6 h-6 bg-primary-500 rounded-lg flex items-center justify-center mr-2">
                    <i class="fa-solid fa-headset text-white text-xs"></i>
                </div>
                <h4 class="text-sm font-bold text-primary-900 dark:text-primary-100">24/7 Support</h4>
            </div>
        </div>
        
        <!-- Contact Footer -->
        <div class="px-4 py-4 bg-gray-50 dark:bg-gray-800/50">
            <div class="text-center">
                <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">We're here to help you anytime</p>
                <div class="flex items-center justify-center space-x-4">
                    <div class="text-center">
                        <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fa-solid fa-clock text-primary-600 dark:text-primary-400 text-xs"></i>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300 font-medium">24/7</p>
                    </div>
                    <div class="text-center">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fa-solid fa-headset text-green-600 dark:text-green-400 text-xs"></i>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300 font-medium">Support</p>
                    </div>
                    <div class="text-center">
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fa-solid fa-bolt text-blue-600 dark:text-blue-400 text-xs"></i>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300 font-medium">Fast</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 