<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->site_name }} | @yield('title')</title>
    <meta name="description" content="Swift and Secure Money Transfer to any UK bank account will become a breeze with {{$settings->site_name}}." />
    <link rel="shortcut icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" />
    
    
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
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Font Awesome 6 Pro -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aquawolf04/font-awesome-pro@5cd1511/css/all.css">
    
    <!-- External Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
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
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        .dark ::-webkit-scrollbar-track {
            background: #374151;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        .dark ::-webkit-scrollbar-thumb {
            background: #6b7280;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
    @stack('styles')
    @laravelPWA
</head>

<body class="bg-background text-foreground">
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
            </div>
        </div>
    </div>
    
    @php
        use Jenssegers\Agent\Agent;
        $agent = new Agent();
        $isMobile = $agent->isMobile();
    @endphp

    <div x-data="{ 
        sidebarOpen: false,
        mobileMenuOpen: false,
        notificationOpen: false,
        userDropdownOpen: false,
        currentRoute: '{{ Route::currentRouteName() }}',
        darkMode: localStorage.getItem('darkMode') === 'true' || false,
        toggleSidebar() { this.sidebarOpen = !this.sidebarOpen; },
        closeSidebar() { this.sidebarOpen = false; },
        isActiveRoute(route) { return this.currentRoute === route; },
        toggleNotifications() { this.notificationOpen = !this.notificationOpen; this.userDropdownOpen = false; },
        toggleUserDropdown() { this.userDropdownOpen = !this.userDropdownOpen; this.notificationOpen = false; },
        closeDropdowns() { this.notificationOpen = false; this.userDropdownOpen = false; },
        toggleDarkMode() { 
            this.darkMode = !this.darkMode; 
            localStorage.setItem('darkMode', this.darkMode);
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        },
        initDarkMode() {
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }" 
    x-init="initDarkMode()"
    @click.away="closeDropdowns()"
    class="min-h-screen bg-gray-50 dark:bg-gray-900">

        @if(!$isMobile)
        <!-- Desktop Layout -->
        <div class="flex h-screen">
            <!-- Desktop Sidebar -->
            <div class="w-72 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-r border-gray-200/50 dark:border-gray-700/50 flex flex-col shadow-xl">
                <!-- Logo Section -->
                <div class="p-6 border-b border-gray-200/50 dark:border-gray-700/50">
                    <div class="flex items-center space-x-3">
                        <div class="w-full">
                            <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name }}" class="h-12 w-auto">
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-6 overflow-y-auto custom-scrollbar">
                    @php
                        $menuItems = [
                            'Main' => [
                                ['route' => 'dashboard', 'icon' => 'fa-solid fa-house', 'label' => 'Dashboard'],
                                ['route' => 'accounthistory', 'icon' => 'fa-solid fa-chart-line', 'label' => 'Transactions'],
                                ['route' => 'cards', 'icon' => 'fa-solid fa-credit-card', 'label' => 'Cards'],
                            ],
                            'Transfers' => [
                                ['route' => 'localtransfer', 'icon' => 'fa-solid fa-paper-plane', 'label' => 'Local Transfer'],
                                ['route' => 'internationaltransfer', 'icon' => 'fa-solid fa-globe', 'label' => 'International'],
                                ['route' => 'deposits', 'icon' => 'fa-solid fa-plus', 'label' => 'Deposit'],
                                ['route' => 'user.swap', 'icon' => 'fa-solid fa-arrows-rotate', 'label' => 'Currency Swap'],
                            ],
                            'Services' => [
                                ['route' => 'loan', 'icon' => 'fa-solid fa-landmark', 'label' => 'Loans'],
                                ['route' => 'irs-refund', 'icon' => 'fa-solid fa-receipt', 'label' => 'Tax Refund'],
                                ['route' => 'grant.index', 'icon' => 'fa-solid fa-hand-holding-dollar', 'label' => 'Grants'],
                            ],
                            'Account' => [
                                ['route' => 'profile', 'icon' => 'fa-solid fa-gear', 'label' => 'Settings'],
                                ['route' => 'support', 'icon' => 'fa-solid fa-headset', 'label' => 'Support'],
                            ]
                        ];
                    @endphp
                                    
                    @foreach($menuItems as $section => $items)
                        <div class="mb-8">
                            <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-4 px-4">{{ $section }}</h3>
                            <div class="space-y-2">
                                @foreach($items as $item)
                                    <a href="{{ route($item['route']) }}" 
                                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-2xl transition-all duration-200 {{ request()->routeIs($item['route']) ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg shadow-primary-500/25' : 'text-gray-600 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-800 hover:text-primary-700 dark:hover:text-primary-400' }}">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-4 {{ request()->routeIs($item['route']) ? 'bg-white/20' : 'bg-gray-100 dark:bg-gray-800 group-hover:bg-primary-100 dark:group-hover:bg-gray-700' }} transition-colors">
                                            <i class="{{ $item['icon'] }} {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400' }} transition-colors"></i>
                                </div>
                                        <span class="font-semibold">{{ $item['label'] }}</span>
                                        @if(request()->routeIs($item['route']))
                                            <div class="ml-auto w-2 h-2 bg-white dark:bg-gray-300 rounded-full"></div>
                            @endif
                                    </a>
                                @endforeach
                        </div>
                    </div>
                    @endforeach
                </nav>

                <!-- User Profile Section -->
                <div class="p-4 border-t border-gray-200/50 dark:border-gray-700/50">
                    <div class="flex items-center space-x-4 p-4 rounded-2xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border border-gray-200/50 dark:border-gray-700/50">
                        <div class="relative">
                             @if(!empty(Auth::user()->profile_photo_path))
            <img src="{{ asset('storage/app/public/photos/'.Auth::user()->profile_photo_path)}}"
                alt="{{ Auth::user()->name }}"
                class="h-10 w-10 rounded-full object-cover border-2 border-primary-100">
        @else
            @php
                $initials = strtoupper(substr(Auth::user()->name, 0, 1) . substr(Auth::user()->lastname, 0, 1));
            @endphp
            <div class="h-10 w-10 rounded-full bg-primary-500 flex items-center justify-center text-white font-bold border-2 border-primary-100">
                {{ $initials }}
            </div>
        @endif
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-600"></div>
                    </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-8 h-8 rounded-xl bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 text-red-500 dark:text-red-400 hover:text-red-600 dark:hover:text-red-300 transition-colors flex items-center justify-center">
                                <i class="fa-solid fa-right-from-bracket text-sm"></i>
                        </button>
                        </form>
            </div>
        </div>
                    </div>
                    
            <!-- Desktop Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Desktop Header -->
                <header class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50 px-6 py-4 shadow-sm relative z-50">
                    <div class="flex items-center justify-between">
                        <!-- Page Title & Breadcrumb -->
                    <div class="flex items-center space-x-4">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                    @yield('page-title', 'Dashboard')
                                </h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    @yield('page-description', 'Welcome back, ' . Auth::user()->name)
                                </p>
                        </div>
                    </div>
                    
                        <!-- Header Actions -->
                    <div class="flex items-center space-x-4">
                            <!-- Dark Mode Toggle -->
                            <button @click="toggleDarkMode()" 
                                    class="w-11 h-11 bg-gray-50 hover:bg-primary-50 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-2xl flex items-center justify-center transition-colors group">
                                <i x-show="!darkMode" class="fa-solid fa-moon text-gray-600 group-hover:text-primary-600 dark:text-gray-300 transition-colors"></i>
                                <i x-show="darkMode" class="fa-solid fa-sun text-yellow-500 group-hover:text-yellow-400 transition-colors"></i>
                            </button>
                            
                            <!-- Notifications -->
                            <div class="relative">
                                <button @click="toggleNotifications()" 
                                        class="relative w-11 h-11 bg-gray-50 hover:bg-primary-50 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-2xl flex items-center justify-center transition-colors group">
                                    <i class="fa-solid fa-bell text-gray-600 group-hover:text-primary-600 dark:text-gray-300 dark:group-hover:text-primary-400 transition-colors"></i>
                                    @php
                                        $unreadNotificationCount = Auth::user()->notifications()->where('is_read', false)->count();
                                    @endphp
                                    @if($unreadNotificationCount > 0)
                                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold">{{ $unreadNotificationCount > 9 ? '9+' : $unreadNotificationCount }}</span>
                                @endif
                            </button>
                            
                                <!-- Notifications Dropdown -->
                                <div x-show="notificationOpen" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-1 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-1 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 z-[99999]">
                                    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                                    <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Notifications</h3>
                                            @php
                                                $unreadCount = Auth::user()->notifications()->where('is_read', false)->count();
                                            @endphp
                                            @if($unreadCount > 0)
                                                <span class="text-xs bg-primary-100 text-primary-700 px-2 py-1 rounded-full font-semibold">{{ $unreadCount }} New</span>
                                            @endif
                                    </div>
                                </div>
                                    <div class="max-h-96 overflow-y-auto custom-scrollbar">
                                        <!-- Notification Items -->
                                    @php
                                        $notifications = Auth::user()->notifications()->latest()->take(5)->get();
                                    @endphp
                                    
                                    @forelse($notifications as $notification)
                                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700 transition-colors cursor-pointer {{ !$notification->is_read ? 'bg-blue-50/30 dark:bg-blue-900/20' : '' }}">
                                            <div class="flex items-start space-x-3">
                                                @php
                                                    $iconClass = 'fa-solid fa-bell';
                                                    $colorClass = 'primary';
                                                    
                                                    switch($notification->type) {
                                                        case 'success':
                                                            $iconClass = 'fa-solid fa-check-circle';
                                                            $colorClass = 'green';
                                                            break;
                                                        case 'warning':
                                                            $iconClass = 'fa-solid fa-exclamation-triangle';
                                                            $colorClass = 'yellow';
                                                            break;
                                                        case 'danger':
                                                            $iconClass = 'fa-solid fa-exclamation-circle';
                                                            $colorClass = 'red';
                                                            break;
                                                        case 'info':
                                                        default:
                                                            $iconClass = 'fa-solid fa-info-circle';
                                                            $colorClass = 'blue';
                                                            break;
                                                    }
                                                @endphp
                                                <div class="w-10 h-10 bg-{{ $colorClass }}-100 dark:bg-{{ $colorClass }}-900/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                                                    <i class="{{ $iconClass }} text-{{ $colorClass }}-600 dark:text-{{ $colorClass }}-400 text-sm"></i>
                                                    </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $notification->title ?? 'Notification' }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">{{ $notification->message ?? 'You have a new notification.' }}</p>
                                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-2 flex items-center">
                                                        <i class="fa-solid fa-clock mr-1"></i>
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                @if(!$notification->is_read)
                                                    <div class="w-2 h-2 bg-primary-500 rounded-full flex-shrink-0 mt-2"></div>
                                                    @endif
                                                </div>
                                            </div>
                                    @empty
                                        <div class="p-6 text-center">
                                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                                <i class="fa-solid fa-bell-slash text-gray-400 dark:text-gray-500 text-xl"></i>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">No notifications yet</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">We'll notify you when something happens</p>
                                        </div>
                                    @endforelse
                                </div>
                                    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                                        <div class="flex items-center justify-between">
                                            <button class="text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                                                Mark all as read
</button>
                                            <a href="{{ route('notifications') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                                                View All Notifications
                                            </a>
                                        </div>
                                </div>
                            </div>
                        </div>

                            <!-- User Dropdown -->
                            <div class="relative">
                                <button @click="toggleUserDropdown()" 
                                        class="flex items-center space-x-3 p-2 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                                    @if(!empty(Auth::user()->profile_photo_path))
            <img src="{{ asset('storage/app/public/photos/'.Auth::user()->profile_photo_path)}}"
                alt="{{ Auth::user()->name }}"
                class="h-10 w-10 rounded-full object-cover border-2 border-primary-100">
        @else
            @php
                $initials = strtoupper(substr(Auth::user()->name, 0, 1) . substr(Auth::user()->lastname, 0, 1));
            @endphp
            <div class="h-10 w-10 rounded-full bg-primary-500 flex items-center justify-center text-white font-bold border-2 border-primary-100">
                {{ $initials }}
            </div>
        @endif
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                    </div>
                                    <i class="fa-solid fa-chevron-down text-gray-400 dark:text-gray-500 text-sm group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors"></i>
                    </button>
                    
                                <!-- User Dropdown Menu -->
                                <div x-show="userDropdownOpen" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-1 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-1 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 z-[99998]">
                                    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                                        <div class="flex items-center space-x-3">
                                            @if(!empty(Auth::user()->profile_photo_path))
            <img src="{{ asset('storage/app/public/photos/'.Auth::user()->profile_photo_path)}}"
                alt="{{ Auth::user()->name }}"
                class="h-10 w-10 rounded-full object-cover border-2 border-primary-100">
        @else
            @php
                $initials = strtoupper(substr(Auth::user()->name, 0, 1) . substr(Auth::user()->lastname, 0, 1));
            @endphp
            <div class="h-10 w-10 rounded-full bg-primary-500 flex items-center justify-center text-white font-bold border-2 border-primary-100">
                {{ $initials }}
            </div>
        @endif
                                            <div>
                                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
        </div>
</div>
                            
                            <!-- KYC Verification Status -->
                                        <div class="mt-3">
                            @if(Auth::user()->account_verify == 'Verified')
                                                <div class="flex items-center justify-center py-2 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-100 dark:border-green-800">
                                                    <span class="text-xs text-green-800 dark:text-green-300 font-semibold flex items-center">
                                                        <i class="fa-solid fa-check-circle text-green-600 dark:text-green-400 mr-2"></i> KYC Verified
                                    </span>
                                </div>
                                            @elseif(Auth::user()->account_verify == 'Under Review')
                                                <div class="flex items-center justify-center py-2 rounded-xl bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-100 dark:border-yellow-800">
                                                    <span class="text-xs text-yellow-800 dark:text-yellow-300 font-semibold flex items-center">
                                                        <i class="fa-solid fa-clock text-yellow-600 dark:text-yellow-400 mr-2"></i> KYC Under Review
                                    </span>
                                </div>
                            @else
                                                <a href="{{ route('account.verify') }}" class="flex items-center justify-center py-2 rounded-xl bg-red-50 dark:bg-red-900/30 border border-red-100 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors">
                                                    <span class="text-xs text-red-800 dark:text-red-300 font-semibold flex items-center">
                                                        <i class="fa-solid fa-exclamation-triangle text-red-600 dark:text-red-400 mr-2"></i> Verify KYC
                                                    </span>
                                                </a>
                            @endif
                        </div>
                    </div>
                                    <div class="p-2">
                                        <a href="{{ route('profile') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                            <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center group-hover:bg-primary-100 dark:group-hover:bg-primary-900/30 transition-colors">
                                                <i class="fa-solid fa-user text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors text-sm"></i>
                    </div>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Profile Settings</span>
                                        </a>
                                        <a href="{{ route('support') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                            <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center group-hover:bg-primary-100 dark:group-hover:bg-primary-900/30 transition-colors">
                                                <i class="fa-solid fa-headset text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors text-sm"></i>
                                </div>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Help & Support</span>
                                        </a>
                                        <div class="border-t border-gray-100 dark:border-gray-700 my-2"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors group">
                                                <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center group-hover:bg-red-200 dark:group-hover:bg-red-900/50 transition-colors">
                                                    <i class="fa-solid fa-right-from-bracket text-red-500 dark:text-red-400 text-sm"></i>
                                </div>
                                                <span class="text-sm font-medium text-red-600 dark:text-red-400">Sign Out</span>
                                            </button>
                                        </form>
                            </div>
                                </div>
                            </div>
                                </div>
                            </div>
                </header>

                <!-- Main Content -->
                <main class="flex-1 bg-gray-50 dark:bg-gray-900 min-h-0">
                    <div class="h-full overflow-y-auto">
                        @yield('content')
                                </div>
                </main>
                            </div>
                                </div>
        @else
        <!-- Mobile Layout -->
        <div class="min-h-screen flex flex-col">
            <!-- Mobile Main Content -->
            <main class="flex-1 pb-20">
                @yield('content')
            </main>

            <!-- Floating Tab Bar Navigation -->
            <div class="fixed bottom-2 left-4 right-4 z-40">
                <div class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 p-2">
                    <div class="flex items-center justify-between">
                        @php
                            $mobileMenuItems = [
                                ['route' => 'accounthistory', 'icon' => 'fa-solid fa-chart-line', 'label' => 'Activity'],
                                ['route' => 'localtransfer', 'icon' => 'fa-solid fa-paper-plane', 'label' => 'Transfer'],
                                ['route' => 'dashboard', 'icon' => 'fa-solid fa-house', 'label' => 'Home'],
                                ['route' => 'cards', 'icon' => 'fa-solid fa-credit-card', 'label' => 'Cards'],
                                ['route' => 'profile', 'icon' => 'fa-solid fa-user', 'label' => 'Profile'],
                            ];
                        @endphp
                        @foreach($mobileMenuItems as $index => $item)
                            @php
                                $isActive = request()->routeIs($item['route']);
                            @endphp
                            <a href="{{ route($item['route']) }}" 
                               class="relative flex-1 flex flex-col items-center justify-center py-3 px-2 rounded-2xl transition-all duration-300 group">
                                
                                @if($isActive)
                                    <!-- Active State -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl shadow-lg"></div>
                                    <div class="relative z-10 flex flex-col items-center">
                                        <div class="w-8 h-8 bg-white/20 dark:bg-white/30 rounded-xl flex items-center justify-center mb-1">
                                            <i class="{{ $item['icon'] }} text-white text-lg"></i>
                                </div>
                                        <span class="text-xs font-semibold text-white">{{ $item['label'] }}</span>
                            </div>
                                @else
                                    <!-- Inactive State -->
                                    <div class="relative z-10 flex flex-col items-center group-hover:scale-110 transition-transform duration-200">
                                        <div class="w-8 h-8 bg-gray-100 dark:bg-gray-800 rounded-xl flex items-center justify-center mb-1 group-hover:bg-primary-100 dark:group-hover:bg-gray-700 transition-colors">
                                            <i class="{{ $item['icon'] }} text-gray-500 dark:text-gray-400 text-lg group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors"></i>
                                </div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">{{ $item['label'] }}</span>
                            </div>
                                @endif
                            </a>
                        @endforeach
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        @endif
    
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
    
    @stack('scripts')
    
    @include('layouts.livechat')
    
</body>
</html>