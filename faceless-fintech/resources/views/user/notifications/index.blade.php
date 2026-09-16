@extends('layouts.dash2')
@section('title', $title)

@section('content')
<div x-data="{
    showDeleteAllModal: false,
    showDeleteModal: false,
    deleteNotificationId: null,
    markingAllRead: false,
    deletingAll: false
}" class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 lg:p-6">
    <div class="max-w-8xl mx-auto">
        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Notifications',
                'showBackButton' => true,
                'showNotifications' => false,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:block mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                        <i class="fas fa-bell text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Notifications</h1>
                        <p class="text-gray-600 dark:text-gray-400">Manage your account notifications and updates</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex space-x-3">
                    <form action="{{ route('notifications.read.all') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                :disabled="markingAllRead"
                                @click="markingAllRead = true"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600/70 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span x-show="!markingAllRead">Mark All Read</span>
                            <span x-show="markingAllRead" class="flex items-center">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Processing...
                            </span>
                        </button>
                    </form>
                    
                    <button @click="showDeleteAllModal = true"
                            class="inline-flex items-center px-4 py-2 border border-red-300 dark:border-red-600 rounded-xl shadow-sm text-sm font-medium text-red-700 dark:text-red-300 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm hover:bg-red-50 dark:hover:bg-red-600/70 transition-all duration-300">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Delete All
                    </button>
                </div>
            </div>
        </div>

        <!-- Alerts Section -->
        <div class="mb-2">
            <x-danger-alert />
            <x-success-alert />
            <x-error-alert />
        </div>

        <!-- Notifications Container -->
        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            @if(count($notifications) > 0)
                <!-- Mobile Action Buttons (shown only on mobile) -->
                <div class="lg:hidden p-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gray-50/50 dark:bg-gray-800/50">
                    <div class="flex space-x-3">
                        <form action="{{ route('notifications.read.all') }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    :disabled="markingAllRead"
                                    @click="markingAllRead = true"
                                    class="w-full inline-flex items-center justify-center px-3 py-2 rounded-lg text-sm font-medium bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-check-circle mr-2"></i>
                                <span x-show="!markingAllRead">Mark All Read</span>
                                <span x-show="markingAllRead" class="flex items-center">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    Processing...
                                </span>
                            </button>
                        </form>
                        
                        <button @click="showDeleteAllModal = true"
                                class="flex-1 inline-flex items-center justify-center px-3 py-2 rounded-lg text-sm font-medium bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white shadow-md transition-all duration-200">
                            <i class="fas fa-trash-alt mr-2"></i>
                            Delete All
                        </button>
                    </div>
                </div>

                <!-- Notifications List -->
                <div class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                    @foreach($notifications as $notification)
                        <div class="p-4 hover:bg-white/50 dark:hover:bg-gray-700/30 transition-all duration-200 {{ !$notification->is_read ? 'bg-gradient-to-r from-blue-50/50 to-purple-50/50 dark:from-blue-900/20 dark:to-purple-900/20' : '' }}">
                            <div class="flex items-start gap-3">
                                <!-- Notification Icon -->
                                <div class="flex-shrink-0">
                                    <div class="relative">
                                        <div class="flex items-center justify-center h-10 w-10 rounded-lg 
                                            @if($notification->type == 'success') bg-gradient-to-br from-green-400 to-emerald-500 
                                            @elseif($notification->type == 'warning') bg-gradient-to-br from-yellow-400 to-orange-500 
                                            @elseif($notification->type == 'danger') bg-gradient-to-br from-red-400 to-pink-500 
                                            @else bg-gradient-to-br from-blue-400 to-purple-500 @endif
                                            text-white shadow-md">
                                            <i class="fas fa-{{ $notification->icon ?? 'bell' }} text-sm"></i>
                                        </div>
                                        @if(!$notification->is_read)
                                            <div class="absolute -top-1 -right-1 h-3 w-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full border-2 border-white dark:border-gray-800">
                                                <div class="h-full w-full rounded-full bg-gradient-to-r from-blue-400 to-purple-400 animate-pulse"></div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Notification Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                        <div class="flex-1 min-w-0">
                                            @if($notification->title)
                                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                                    {{ $notification->title }}
                                                </h4>
                                            @endif
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                                {{ $notification->message }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-2">
                                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                    <i class="fas fa-calendar-alt mr-1"></i>
                                                    {{ $notification->created_at->format('M d, Y') }}
                                                </div>
                                                <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    {{ $notification->created_at->format('h:i A') }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            @if(!$notification->is_read)
                                                <a href="{{ route('notifications.read', $notification->id) }}" 
                                                   class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white shadow-sm transition-all duration-200">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Read
                                                </a>
                                            @endif
                                            <button @click="deleteNotificationId = {{ $notification->id }}; showDeleteModal = true"
                                                    class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white shadow-sm transition-all duration-200">
                                                <i class="fas fa-trash mr-1"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($notifications->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200/50 dark:border-gray-700/50 bg-gray-50/50 dark:bg-gray-800/50">
                        {{ $notifications->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="py-12 flex flex-col items-center justify-center text-center px-4">
                    <div class="bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 rounded-xl p-4 mb-4">
                        <i class="fas fa-inbox text-3xl text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Notifications Yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm max-w-md">
                        You're all caught up! Notifications will appear here when there are updates related to your account.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete All Confirmation Modal -->
    <div x-show="showDeleteAllModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900/75 backdrop-blur-sm" @click="showDeleteAllModal = false"></div>
            
            <div x-show="showDeleteAllModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl shadow-2xl rounded-2xl border border-white/20 dark:border-gray-700/30">
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-red-400 to-pink-500 rounded-lg text-white">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Delete All Notifications</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">This action cannot be undone</p>
                    </div>
                </div>
                
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                    Are you sure you want to delete all notifications? This will permanently remove all notifications from your account.
                </p>
                
                <div class="flex gap-3">
                    <button @click="showDeleteAllModal = false" 
                            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                        Cancel
                    </button>
                    <form action="{{ route('notifications.destroy.all') }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                :disabled="deletingAll"
                                @click="deletingAll = true"
                                class="w-full px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-show="!deletingAll">Delete All</span>
                            <span x-show="deletingAll" class="flex items-center justify-center">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Deleting...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Single Notification Modal -->
    <div x-show="showDeleteModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900/75 backdrop-blur-sm" @click="showDeleteModal = false"></div>
            
            <div x-show="showDeleteModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl shadow-2xl rounded-2xl border border-white/20 dark:border-gray-700/30">
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-red-400 to-pink-500 rounded-lg text-white">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Delete Notification</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">This action cannot be undone</p>
                    </div>
                </div>
                
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                    Are you sure you want to delete this notification? This action cannot be undone.
                </p>
                
                <div class="flex gap-3">
                    <button @click="showDeleteModal = false" 
                            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                        Cancel
                    </button>
                    <form :action="`{{ route('notifications.destroy', '') }}/${deleteNotificationId}`" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-lg transition-all duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 