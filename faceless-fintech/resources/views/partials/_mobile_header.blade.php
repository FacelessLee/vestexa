{{--
    Mobile Header Component
    Expects:
    - $title: Page title (optional, defaults to greeting)
    - $showBackButton: Boolean to show back button (optional, defaults to false)
    - $backUrl: URL for back button (optional, defaults to dashboard)
    - $showNotifications: Boolean to show notifications (optional, defaults to true)
    - $showDarkMode: Boolean to show dark mode toggle (optional, defaults to true)
    - $financeUser: User object for profile info
--}}

@php
    $title = $title ?? null;
    $showBackButton = $showBackButton ?? false;
    $backUrl = $backUrl ?? route('dashboard');
    $showNotifications = $showNotifications ?? true;
    $showDarkMode = $showDarkMode ?? true;
@endphp

<div class="lg:hidden" x-data="{ showMobileNotifications: false }">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-2">
            @if($showBackButton)
                <!-- Back Button -->
                <a href="{{ $backUrl }}" class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center backdrop-blur-sm transition-all duration-200 hover:bg-gray-200 dark:hover:bg-gray-700 mr-2">
                    <i class="fa-solid fa-arrow-left text-gray-700 dark:text-gray-300 text-base"></i>
                </a>
            @else
                <!-- Profile Avatar -->
                <img src="{{ $financeUser->avatarUrl }}" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-700">
            @endif
            
            <div>
                @if($title)
                    <!-- Custom Title -->
                    <p class="text-gray-900 dark:text-white font-semibold text-base">{{ $title }}</p>
                @else
                    <!-- Default Greeting -->
                    <p class="text-gray-600 dark:text-gray-400 text-xs" x-text="greeting + ' 👋'"></p>
                    <p class="text-gray-900 dark:text-white font-semibold text-base">{{ explode(' ', $financeUser->name)[0] }} {{ Auth::user()->lastname }}</p>
                @endif
            </div>
        </div>
        
        <div class="flex items-center space-x-2">
            @if($showDarkMode)
                <!-- Dark Mode Toggle -->
                <button @click="toggleDarkMode()" 
                        class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center backdrop-blur-sm transition-all duration-200 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <i x-show="!darkMode" class="fa-solid fa-moon text-gray-700 text-base"></i>
                    <i x-show="darkMode" class="fa-solid fa-sun text-yellow-400 text-base"></i>
                </button>
            @endif
            
            @if($showNotifications)
                <!-- Notifications -->
                <div class="relative">
                    <button @click="showMobileNotifications = !showMobileNotifications" class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center backdrop-blur-sm transition-all duration-200 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <i class="fa-solid fa-bell text-gray-700 dark:text-gray-300 text-base"></i>
                    </button>
                    @php
                        $mobileUnreadCount = Auth::user()->notifications()->where('is_read', false)->count();
                    @endphp
                    @if($mobileUnreadCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 dark:bg-red-600 rounded-full flex items-center justify-center text-xs font-bold text-white animate-pulse">{{ $mobileUnreadCount > 9 ? '9+' : $mobileUnreadCount }}</span>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @if($showNotifications)
        <!-- Mobile Notifications Panel -->
        <div x-show="showMobileNotifications" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 -translate-y-4" 
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0" 
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="fixed inset-0 z-50 bg-black/20 backdrop-blur-sm" 
             @click="showMobileNotifications = false">
            
            <div @click.stop class="absolute top-0 left-0 right-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 text-white rounded-b-3xl shadow-2xl dark:shadow-slate-900/50 max-h-[80vh] overflow-hidden">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b border-white/10 dark:border-white/20">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/10 dark:bg-white/20 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-bell text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Notifications</h3>
                            @php
                                $mobileUnreadNotifications = Auth::user()->notifications()->where('is_read', false)->count();
                            @endphp
                            @if($mobileUnreadNotifications > 0)
                                <p class="text-xs text-white/60">{{ $mobileUnreadNotifications }} new notification{{ $mobileUnreadNotifications > 1 ? 's' : '' }}</p>
                            @else
                                <p class="text-xs text-white/60">All caught up!</p>
                            @endif
                        </div>
                    </div>
                    <button @click="showMobileNotifications = false" class="w-8 h-8 bg-white/10 dark:bg-white/20 rounded-xl flex items-center justify-center hover:bg-white/20 dark:hover:bg-white/30 transition-colors">
                        <i class="fa-solid fa-times text-white text-sm"></i>
                    </button>
                </div>

                <!-- Notifications List -->
                <div class="overflow-y-auto max-h-96 custom-scrollbar">
                    @php
                        $mobileNotifications = Auth::user()->notifications()->latest()->take(8)->get();
                    @endphp
                    
                    @forelse($mobileNotifications as $notification)
                    <div class="p-4 border-b border-white/5 dark:border-white/10 hover:bg-white/5 dark:hover:bg-white/10 transition-colors {{ !$notification->is_read ? 'bg-white/5 dark:bg-white/10' : '' }}">
                        <div class="flex items-start space-x-3">
                            @php
                                $mobileIconClass = 'fa-solid fa-bell';
                                $mobileColorClass = 'primary';
                                
                                switch($notification->type) {
                                    case 'success':
                                        $mobileIconClass = 'fa-solid fa-check-circle';
                                        $mobileColorClass = 'green';
                                        break;
                                    case 'warning':
                                        $mobileIconClass = 'fa-solid fa-exclamation-triangle';
                                        $mobileColorClass = 'yellow';
                                        break;
                                    case 'danger':
                                        $mobileIconClass = 'fa-solid fa-exclamation-circle';
                                        $mobileColorClass = 'red';
                                        break;
                                    case 'info':
                                    default:
                                        $mobileIconClass = 'fa-solid fa-info-circle';
                                        $mobileColorClass = 'blue';
                                        break;
                                }
                            @endphp
                            <div class="w-10 h-10 bg-{{ $mobileColorClass }}-500/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <i class="{{ $mobileIconClass }} text-{{ $mobileColorClass }}-400 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-white">{{ $notification->title ?? 'Notification' }}</p>
                                        <p class="text-xs text-white/70 mt-1 line-clamp-2">{{ $notification->message ?? 'You have a new notification.' }}</p>
                                    </div>
                                    @if(!$notification->is_read)
                                        <div class="w-2 h-2 bg-primary-400 rounded-full flex-shrink-0 mt-2 ml-2"></div>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <p class="text-xs text-white/50 flex items-center">
                                        <i class="fa-solid fa-clock mr-1"></i>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                    @if(!$notification->is_read)
                                        <span class="text-xs bg-primary-500/20 text-primary-300 px-2 py-1 rounded-full font-medium">New</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-white/10 dark:bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-bell-slash text-white/40 dark:text-white/60 text-2xl"></i>
                        </div>
                        <p class="text-white font-semibold mb-1">No notifications yet</p>
                        <p class="text-xs text-white/60 dark:text-white/70">We'll notify you when something happens</p>
                    </div>
                    @endforelse
                </div>
                
                <!-- Footer Actions -->
                @if($mobileNotifications->count() > 0)
                <div class="p-4 border-t border-white/10 dark:border-white/20 bg-white/5 dark:bg-white/10">
                    <div class="flex items-center justify-between">
                        <button class="text-sm font-semibold text-white/70 dark:text-white/80 hover:text-white transition-colors">
                            Mark all as read
                        </button>
                        <a href="{{ route('notifications') }}" class="text-sm font-semibold text-primary-400 dark:text-primary-300 hover:text-primary-300 dark:hover:text-primary-200 transition-colors flex items-center">
                            View All
                            <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endif
</div> 