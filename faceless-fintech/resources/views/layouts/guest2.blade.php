<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: false }" x-init="darkMode = localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)" :class="{ 'dark': darkMode }">
<head>
    <title>@yield('title') - {{$settings->site_name}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="apple-mobile-web-app-title" content="{{$settings->site_name}}">
    <meta name="application-name" content="{{$settings->site_name}}">
    <meta name="description" content="Swift and Secure Money Transfer to any UK bank account will become a breeze with {{$settings->site_name}}.">
    <link rel="shortcut icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}">
    
    <!-- Dark mode initialization -->
    <script>
        // Dark mode initialization before page loads
        const isDarkMode = localStorage.getItem('darkMode') === 'true' || 
                          (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
        
        if (isDarkMode) {
            document.documentElement.classList.add('dark');
        }
    </script>
    
    <!-- Tailwind CSS with custom color variables -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: { // Dynamic primary colors from appearance settings
                            50: '{{ isset($appearanceSettings->primary_color_50) ? $appearanceSettings->primary_color_50 : "#f0f9ff" }}',
                            100: '{{ isset($appearanceSettings->primary_color_100) ? $appearanceSettings->primary_color_100 : "#e0f2fe" }}',
                            200: '{{ isset($appearanceSettings->primary_color_200) ? $appearanceSettings->primary_color_200 : "#bae6fd" }}',
                            300: '{{ isset($appearanceSettings->primary_color_300) ? $appearanceSettings->primary_color_300 : "#7dd3fc" }}',
                            400: '{{ isset($appearanceSettings->primary_color_400) ? $appearanceSettings->primary_color_400 : "#38bdf8" }}',
                            DEFAULT: '{{ isset($appearanceSettings->primary_color) ? $appearanceSettings->primary_color : "#0ea5e9" }}',
                            500: '{{ isset($appearanceSettings->primary_color) ? $appearanceSettings->primary_color : "#0ea5e9" }}',
                            600: '{{ isset($appearanceSettings->primary_color_600) ? $appearanceSettings->primary_color_600 : "#0284c7" }}',
                            700: '{{ isset($appearanceSettings->primary_color_700) ? $appearanceSettings->primary_color_700 : "#0369a1" }}',
                            foreground: '{{ isset($appearanceSettings->primary_color_foreground) ? $appearanceSettings->primary_color_foreground : "#ffffff" }}',
                        },
                        secondary: { // Dynamic secondary colors from appearance settings
                            50: '{{ isset($appearanceSettings->secondary_color_50) ? $appearanceSettings->secondary_color_50 : "#f8fafc" }}',
                            100: '{{ isset($appearanceSettings->secondary_color_100) ? $appearanceSettings->secondary_color_100 : "#f1f5f9" }}',
                            200: '{{ isset($appearanceSettings->secondary_color_200) ? $appearanceSettings->secondary_color_200 : "#e2e8f0" }}',
                            300: '{{ isset($appearanceSettings->secondary_color_300) ? $appearanceSettings->secondary_color_300 : "#cbd5e1" }}',
                            400: '{{ isset($appearanceSettings->secondary_color_400) ? $appearanceSettings->secondary_color_400 : "#94a3b8" }}',
                            DEFAULT: '{{ isset($appearanceSettings->secondary_color) ? $appearanceSettings->secondary_color : "#64748b" }}',
                            500: '{{ isset($appearanceSettings->secondary_color) ? $appearanceSettings->secondary_color : "#64748b" }}',
                            600: '{{ isset($appearanceSettings->secondary_color_600) ? $appearanceSettings->secondary_color_600 : "#475569" }}',
                            700: '{{ isset($appearanceSettings->secondary_color_700) ? $appearanceSettings->secondary_color_700 : "#334155" }}',
                            foreground: '{{ isset($appearanceSettings->secondary_color_foreground) ? $appearanceSettings->secondary_color_foreground : "#0f172a" }}',
                        },
                        accent: { // Dynamic accent colors from appearance settings
                            50: '{{ isset($appearanceSettings->accent_color_50) ? $appearanceSettings->accent_color_50 : "#fdf2f8" }}',
                            100: '{{ isset($appearanceSettings->accent_color_100) ? $appearanceSettings->accent_color_100 : "#fce7f3" }}',
                            200: '{{ isset($appearanceSettings->accent_color_200) ? $appearanceSettings->accent_color_200 : "#fbcfe8" }}',
                            300: '{{ isset($appearanceSettings->accent_color_300) ? $appearanceSettings->accent_color_300 : "#f9a8d4" }}',
                            400: '{{ isset($appearanceSettings->accent_color_400) ? $appearanceSettings->accent_color_400 : "#f472b6" }}',
                            DEFAULT: '{{ isset($appearanceSettings->accent_color) ? $appearanceSettings->accent_color : "#ec4899" }}',
                            500: '{{ isset($appearanceSettings->accent_color) ? $appearanceSettings->accent_color : "#ec4899" }}',
                            600: '{{ isset($appearanceSettings->accent_color_600) ? $appearanceSettings->accent_color_600 : "#db2777" }}',
                            700: '{{ isset($appearanceSettings->accent_color_700) ? $appearanceSettings->accent_color_700 : "#be185d" }}',
                            foreground: '{{ isset($appearanceSettings->accent_color_foreground) ? $appearanceSettings->accent_color_foreground : "#ffffff" }}',
                        },
                        background: '{{ isset($appearanceSettings->background_color) ? $appearanceSettings->background_color : "#f8fafc" }}',
                        foreground: '{{ isset($appearanceSettings->foreground_color) ? $appearanceSettings->foreground_color : "#1e293b" }}',
                        card: {
                            DEFAULT: '{{ isset($appearanceSettings->card_color) ? $appearanceSettings->card_color : "#ffffff" }}',
                            foreground: '{{ isset($appearanceSettings->card_foreground_color) ? $appearanceSettings->card_foreground_color : "#1e293b" }}',
                        },
                        muted: {
                            DEFAULT: '{{ isset($appearanceSettings->muted_color) ? $appearanceSettings->muted_color : "#f1f5f9" }}',
                            foreground: '{{ isset($appearanceSettings->muted_foreground_color) ? $appearanceSettings->muted_foreground_color : "#64748b" }}',
                        },
                        border: '{{ isset($appearanceSettings->border_color) ? $appearanceSettings->border_color : "#e2e8f0" }}',
                        input: '{{ isset($appearanceSettings->input_color) ? $appearanceSettings->input_color : "#e2e8f0" }}',
                        ring: '{{ isset($appearanceSettings->ring_color) ? $appearanceSettings->ring_color : "#0ea5e9" }}',
                        
                        // Specific colors from original design for gradients/highlights
                        'gradient-pink-from': '{{ isset($appearanceSettings->gradient_pink_from) ? $appearanceSettings->gradient_pink_from : "#ec4899" }}',
                        'gradient-purple-via': '{{ isset($appearanceSettings->gradient_purple_via) ? $appearanceSettings->gradient_purple_via : "#a855f7" }}',
                        'gradient-indigo-to': '{{ isset($appearanceSettings->gradient_indigo_to) ? $appearanceSettings->gradient_indigo_to : "#4f46e5" }}',
                        
                        'mobile-header-bg': '#1e293b', // Dark slate for mobile top section
                        'mobile-header-text': '#f1f5f9', // Light text for mobile top section
                        
                        'yellow-action': '{{ isset($appearanceSettings->yellow_action) ? $appearanceSettings->yellow_action : "#facc15" }}',
                        'green-positive': '{{ isset($appearanceSettings->green_positive) ? $appearanceSettings->green_positive : "#22c55e" }}',
                        'red-negative': '{{ isset($appearanceSettings->red_negative) ? $appearanceSettings->red_negative : "#ef4444" }}',
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'top': '0 -4px 12px -1px rgba(0,0,0,0.05), 0 -2px 8px -1px rgba(0,0,0,0.03)',
                    },
                    borderRadius: {
                        lg: '0.75rem',
                        xl: '0.75rem', 
                        '2xl': '1rem',
                        '3xl': '1.5rem',
                    },
                    keyframes: {
                        pulse: {
                          '0%, 100%': { transform: 'scale(1)', boxShadow: '0 0 0 0 rgba(14, 165, 233, 0.4)' }, // primary color
                          '50%': { transform: 'scale(1.05)', boxShadow: '0 0 0 10px rgba(14, 165, 233, 0)' },
                        },
                        shine: { 
                          '0%': { transform: 'translateX(-100%) translateY(-100%) rotate(45deg)' },
                          '100%': { transform: 'translateX(100%) translateY(100%) rotate(45deg)' },
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 2.5s infinite',
                        'shine-once': 'shine 1.5s ease-in-out',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aquawolf04/font-awesome-pro@5cd1511/css/all.css">
    
    <!-- External Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @if(isset($appearanceSettings) && $appearanceSettings->custom_css)
    <style>
        {!! $appearanceSettings->custom_css !!}
    </style>
    @endif
    
    @if(isset($appearanceSettings) && $appearanceSettings->disable_animations)
    <style>
        * {
            animation: none !important;
            transition: none !important;
        }
    </style>
    @endif
    
    <style>
        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: theme('colors.background');
            color: theme('colors.foreground');
        }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #e2e8f0; } /* slate-200 */
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 4px; } /* slate-400 */
        ::-webkit-scrollbar-thumb:hover { background: #64748b; } /* slate-500 */

        .dark ::-webkit-scrollbar-track { background: #374151; } /* gray-700 */
        .dark ::-webkit-scrollbar-thumb { background: #6b7280; } /* gray-500 */
        .dark ::-webkit-scrollbar-thumb:hover { background: #9ca3af; } /* gray-400 */

        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; } /* slate-300 */
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; } /* slate-400 */

        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #6b7280; } /* gray-500 */
        .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; } /* gray-400 */

        .shine-effect-container { position: relative; overflow: hidden; }
        .shine-effect {
            position: absolute; top: -50%; left: -50%;
            width: 200%; height: 200%;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0) 100%);
            transform: rotate(45deg); opacity: 0; transition: opacity 0.5s;
        }
        .shine-effect-container:hover .shine-effect { opacity: 1; animation: shine-once 1.5s ease-in-out; }

        .fade-in-section { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .fade-in-section.is-visible { opacity: 1; transform: translateY(0); }

        /* Floating elements animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        .floating-slow {
            animation: floating 6s ease-in-out infinite;
        }
        .floating-slower {
            animation: floating 8s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        /* Interactive elements */
        .input-wrapper {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .input-wrapper:focus-within {
            transform: translateY(-2px);
        }
        
        .input-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 1rem;
            color: #94a3b8;
            transition: color 0.3s ease;
        }
        
        .input-wrapper:focus-within .input-icon {
            color: var(--primary-color);
        }
        
        input:focus + .input-toggle {
            color: var(--primary-color);
        }
        
        .dark .input-icon {
            color: #6b7280;
        }
        
        /* Dark mode toggle button styling */
        .dark-mode-toggle {
            transition: all 0.3s ease;
        }
        
        .dark-mode-toggle:hover {
            transform: scale(1.1);
        }
    </style>
    
    <!-- Ultra Modern Loading Animation -->
    <style>
        .page-loading {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: all .6s cubic-bezier(0.4, 0, 0.2, 1);
            background: {{ isset($appearanceSettings->preloader_background) ? $appearanceSettings->preloader_background : 'radial-gradient(ellipse at center, rgba(14, 165, 233, 0.08) 0%, rgba(255, 255, 255, 0.95) 50%, rgba(255, 255, 255, 1) 100%)' }};
            backdrop-filter: blur(2px);
            visibility: hidden;
            z-index: 9999;
        }
        
        .dark .page-loading {
            background: {{ isset($appearanceSettings->preloader_background_dark) ? $appearanceSettings->preloader_background_dark : 'radial-gradient(ellipse at center, rgba(14, 165, 233, 0.12) 0%, rgba(17, 24, 39, 0.95) 50%, rgba(17, 24, 39, 1) 100%)' }};
        }
        .page-loading.active {
            opacity: 1;
            visibility: visible;
        }
        .page-loading-inner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            transition: all .4s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
        }
        .page-loading.active>.page-loading-inner {
            opacity: 1;
        }
        
        .loading-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            position: relative;
        }
        
        /* Floating particles background */
        .loading-particles {
            position: absolute;
            width: 300px;
            height: 300px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: linear-gradient(45deg, {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0ea5e9' }}, {{ isset($appearanceSettings->gradient_indigo_to) ? $appearanceSettings->gradient_indigo_to : '#6366f1' }});
            border-radius: 50%;
            opacity: 0.6;
            animation: floatParticle 4s ease-in-out infinite;
        }
        
        .particle:nth-child(1) { top: 20%; left: 20%; animation-delay: 0s; }
        .particle:nth-child(2) { top: 80%; left: 80%; animation-delay: 0.5s; }
        .particle:nth-child(3) { top: 60%; left: 20%; animation-delay: 1s; }
        .particle:nth-child(4) { top: 30%; left: 70%; animation-delay: 1.5s; }
        .particle:nth-child(5) { top: 70%; left: 30%; animation-delay: 2s; }
        .particle:nth-child(6) { top: 10%; left: 60%; animation-delay: 2.5s; }
        
        .loading-animation {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            height: 120px;
            margin-bottom: 2rem;
            position: relative;
            filter: drop-shadow(0 0 20px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.2)' : 'rgba(14, 165, 233, 0.2)' }});
        }
        
        /* Outer orbital rings */
        .loading-animation .orbit-ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.2)' : 'rgba(14, 165, 233, 0.2)' }};
            animation: rotateOrbit 8s linear infinite;
        }
        
        .orbit-ring:nth-child(1) {
            width: 100%;
            height: 100%;
            border-top: 2px solid {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0ea5e9' }};
            border-right: 2px solid {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.3)' : 'rgba(14, 165, 233, 0.3)' }};
            animation-duration: 2s;
        }
        
        .orbit-ring:nth-child(2) {
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            border-bottom: 2px solid {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#38bdf8' }};
            border-left: 2px solid {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.3)' : 'rgba(56, 189, 248, 0.3)' }};
            animation-duration: 2.5s;
            animation-direction: reverse;
        }
        
        .orbit-ring:nth-child(3) {
            width: 60%;
            height: 60%;
            top: 20%;
            left: 20%;
            border-top: 2px solid {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0284c7' }};
            border-right: 2px solid {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.3)' : 'rgba(2, 132, 199, 0.3)' }};
            animation-duration: 3s;
        }
        
        /* Inner spinning circles */
        .loading-animation .inner-circle {
            position: absolute;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0ea5e9' }};
            box-shadow: 0 0 10px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.6)' : 'rgba(14, 165, 233, 0.6)' }};
            animation: spinInner 2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        }
        
        .inner-circle:nth-child(4) {
            border-top: 3px solid {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#7dd3fc' }};
            border-right: 3px solid {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.4)' : 'rgba(125, 211, 252, 0.4)' }};
            animation-delay: 0s;
        }
        
        .inner-circle:nth-child(5) {
            border-bottom: 3px solid {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#bae6fd' }};
            border-left: 3px solid {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.4)' : 'rgba(186, 230, 253, 0.4)' }};
            animation-delay: 0.3s;
            animation-direction: reverse;
        }
        
        /* Glowing core with morphing effect */
        .loading-animation .core {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(45deg, {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0ea5e9' }}, {{ isset($appearanceSettings->gradient_indigo_to) ? $appearanceSettings->gradient_indigo_to : '#6366f1' }});
            background-size: 200% 200%;
            box-shadow: 
                0 0 20px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.6)' : 'rgba(14, 165, 233, 0.6)' }},
                0 0 40px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.3)' : 'rgba(14, 165, 233, 0.3)' }},
                inset 0 0 10px rgba(255, 255, 255, 0.3);
            animation: coreGlow 2s ease-in-out infinite, morphCore 4s ease-in-out infinite;
        }
        
        /* Enhanced text with multiple effects */
        .page-loading .text {
            font-weight: 700;
            letter-spacing: 0.1em;
            margin-top: 1.5rem;
            font-size: 1.1rem;
            position: relative;
            background: linear-gradient(90deg, {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0284c7' }}, {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0ea5e9' }}, {{ isset($appearanceSettings->gradient_indigo_to) ? $appearanceSettings->gradient_indigo_to : '#6366f1' }}, {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0ea5e9' }}, {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0284c7' }});
            background-size: 300% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textShimmer 3s linear infinite;
            text-shadow: 0 0 30px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.3)' : 'rgba(14, 165, 233, 0.3)' }};
        }
        
        .page-loading .text::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, transparent, {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.1)' : 'rgba(14, 165, 233, 0.1)' }}, transparent);
            border-radius: 4px;
            z-index: -1;
            animation: textGlow 2s ease-in-out infinite alternate;
        }
        
        /* Subtitle with fade effect */
        .page-loading .subtitle {
            font-size: 0.75rem;
            color: {{ isset($appearanceSettings->muted_foreground_color) ? $appearanceSettings->muted_foreground_color : '#64748b' }};
            font-weight: 500;
            margin-top: 0.5rem;
            letter-spacing: 0.05em;
            animation: subtitleFade 2s ease-in-out infinite;
        }
        
        /* Progress indicator */
        .loading-progress {
            width: 200px;
            height: 2px;
            background: {{ isset($appearanceSettings->muted_color) ? $appearanceSettings->muted_color : '#f1f5f9' }};
            border-radius: 1px;
            margin-top: 1.5rem;
            overflow: hidden;
            position: relative;
        }
        
        .loading-progress::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, {{ isset($appearanceSettings->preloader_accent_color) ? $appearanceSettings->preloader_accent_color : '#0ea5e9' }}, transparent);
            animation: progressSlide 2s ease-in-out infinite;
        }
        
        /* Keyframe animations */
        @keyframes floatParticle {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.6; }
            50% { transform: translateY(-20px) rotate(180deg); opacity: 1; }
        }
        
        @keyframes rotateOrbit {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes spinInner {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
        }
        
        @keyframes coreGlow {
            0% { 
                transform: translate(-50%, -50%) scale(0.8); 
                box-shadow: 
                    0 0 20px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.6)' : 'rgba(14, 165, 233, 0.6)' }},
                    0 0 40px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.3)' : 'rgba(14, 165, 233, 0.3)' }},
                    inset 0 0 10px rgba(255, 255, 255, 0.3);
            }
            100% {
                transform: translate(-50%, -50%) scale(1.2); 
                box-shadow: 
                    0 0 30px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.8)' : 'rgba(14, 165, 233, 0.8)' }},
                    0 0 60px {{ isset($appearanceSettings->preloader_accent_color) ? 'rgba(' . implode(', ', sscanf(str_replace('#', '', $appearanceSettings->preloader_accent_color), '%02x%02x%02x')) . ', 0.4)' : 'rgba(14, 165, 233, 0.4)' }},
                    inset 0 0 15px rgba(255, 255, 255, 0.5);
            }
        }
        
        @keyframes morphCore {
            0%, 100% { border-radius: 50%; background-position: 0% 50%; }
            25% { border-radius: 40%; background-position: 100% 50%; }
            50% { border-radius: 30%; background-position: 0% 50%; }
            75% { border-radius: 40%; background-position: 100% 50%; }
        }
        
        @keyframes textShimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes textGlow {
            0% { opacity: 0.3; }
            100% { opacity: 0.7; }
        }
        
        @keyframes subtitleFade {
            0%, 100% { opacity: 0.5; transform: translateY(0px); }
            50% { opacity: 1; transform: translateY(-2px); }
        }
        
        @keyframes progressSlide {
            0% { left: -100%; }
            50% { left: 0%; }
            100% { left: 100%; }
        }
    </style>
    @laravelPWA
</head>

<body class="font-sans bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex min-h-screen">
    <!-- Ultra Modern Page Loader -->
    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="loading-container">
                <!-- Floating particles background -->
                <div class="loading-particles">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>
                
                <!-- Main loading animation -->
                <div class="loading-animation">
                    <!-- Outer orbital rings -->
                    <div class="orbit-ring"></div>
                    <div class="orbit-ring"></div>
                    <div class="orbit-ring"></div>
                    
                    <!-- Inner spinning circles -->
                    <div class="inner-circle"></div>
                    <div class="inner-circle"></div>
                    
                    <!-- Morphing glowing core -->
                    <div class="core"></div>
                </div>
                
                <!-- Enhanced text with effects -->
                <div class="text">{{ $settings->site_name }}</div>
                <div class="subtitle">Secure Banking Platform</div>
                
                <!-- Progress indicator -->
                <div class="loading-progress"></div>
            </div>
        </div>
    </div>
    
    <!-- Dark Mode Toggle - Floating button -->
    <div class="fixed top-4 right-4 z-50">
        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                class="dark-mode-toggle p-3 rounded-2xl bg-white/80 dark:bg-gray-800/80 text-gray-700 dark:text-gray-300 shadow-lg hover:shadow-xl border border-gray-200/50 dark:border-gray-700/50 backdrop-blur-xl transition-all duration-300 hover:scale-110"
                :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
            <i class="fa-solid fa-sun h-5 w-5" x-show="darkMode"></i>
            <i class="fa-solid fa-moon h-5 w-5" x-show="!darkMode"></i>
        </button>
    </div>
    
    <!-- Main Content -->
    <div class="w-full">
        @yield('content')
    </div>
    
    <!-- Enhanced Page Loading Animation -->
    <script>
        window.onload = function() {
            const preloader = document.querySelector('.page-loading');
            
            // Add a slight delay to make loading animation more noticeable
            setTimeout(function() {
                preloader.classList.remove('active');
                setTimeout(function() {
                    preloader.remove();
                }, 500);
            }, 800);
        };
    </script>
    
    <!-- Additional Scripts -->
    @yield('scripts')
</body>
</html>