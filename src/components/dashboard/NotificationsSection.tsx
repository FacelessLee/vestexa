import React, { useState, useEffect } from 'react';
import {
  User,
  AppNotification,
  getNotifications,
  markNotificationRead,
  markAllNotificationsRead,
  deleteNotification,
} from '../../lib/storage';

interface NotificationsSectionProps {
  user: User;
  isDark: boolean;
}

export const NotificationsSection: React.FC<NotificationsSectionProps> = ({
  user,
  isDark,
}) => {
  const [notifications, setNotifications] = useState<AppNotification[]>([]);
  const [filter, setFilter] = useState<'all' | 'unread'>('all');

  useEffect(() => {
    loadNotifications();
  }, [user.id]);

  const loadNotifications = () => {
    setNotifications(getNotifications(user.id));
  };

  const handleMarkRead = (id: string) => {
    markNotificationRead(id);
    loadNotifications();
  };

  const handleMarkAllRead = () => {
    markAllNotificationsRead(user.id);
    loadNotifications();
  };

  const handleDelete = (id: string) => {
    deleteNotification(id);
    loadNotifications();
  };

  const filtered = notifications.filter(n => filter === 'all' || !n.isRead);
  const unreadCount = notifications.filter(n => !n.isRead).length;

  const getTypeStyle = (type: AppNotification['type']) => {
    switch (type) {
      case 'success':
        return {
          icon: 'check_circle',
          bg: 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
        };
      case 'warning':
        return {
          icon: 'warning',
          bg: 'bg-amber-500/10 text-amber-400 border-amber-500/20',
        };
      case 'danger':
        return {
          icon: 'error',
          bg: 'bg-red-500/10 text-red-400 border-red-500/20',
        };
      default:
        return {
          icon: 'info',
          bg: 'bg-blue-500/10 text-blue-400 border-blue-500/20',
        };
    }
  };

  return (
    <div className="space-y-8">
      {/* Header */}
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <div className="flex items-center gap-3">
            <h1 className={`text-3xl sm:text-4xl font-display font-extrabold tracking-tight ${
              isDark ? 'text-white' : 'text-slate-900'
            }`}>
              Notification Center
            </h1>
            {unreadCount > 0 && (
              <span className="px-3 py-1 rounded-full text-xs font-extrabold bg-vestexa-coral text-white shadow-pill">
                {unreadCount} New
              </span>
            )}
          </div>
          <p className={`text-sm mt-1 ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
            Security alerts, system disbursements, dividend announcements, and transaction receipts.
          </p>
        </div>

        {unreadCount > 0 && (
          <button
            onClick={handleMarkAllRead}
            className="px-5 py-2.5 rounded-full font-display text-xs font-bold text-white bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all self-start sm:self-auto flex items-center gap-2"
          >
            <span className="material-symbols-outlined text-base">done_all</span>
            Mark All as Read
          </button>
        )}
      </div>

      {/* Filter Tabs */}
      <div className="flex gap-2">
        <button
          onClick={() => setFilter('all')}
          className={`px-5 py-2 rounded-full text-xs font-bold transition-all ${
            filter === 'all'
              ? 'bg-vestexa-coral text-white shadow-pill'
              : isDark ? 'bg-gray-800 text-gray-400 hover:text-white' : 'bg-slate-100 text-slate-600 hover:text-slate-900'
          }`}
        >
          All Activity ({notifications.length})
        </button>
        <button
          onClick={() => setFilter('unread')}
          className={`px-5 py-2 rounded-full text-xs font-bold transition-all ${
            filter === 'unread'
              ? 'bg-vestexa-coral text-white shadow-pill'
              : isDark ? 'bg-gray-800 text-gray-400 hover:text-white' : 'bg-slate-100 text-slate-600 hover:text-slate-900'
          }`}
        >
          Unread ({unreadCount})
        </button>
      </div>

      {/* Notifications List */}
      <div className="space-y-3">
        {filtered.map((n) => {
          const style = getTypeStyle(n.type);
          return (
            <div
              key={n.id}
              onClick={() => !n.isRead && handleMarkRead(n.id)}
              className={`p-5 rounded-3xl border transition-all cursor-pointer flex items-start gap-4 ${
                !n.isRead
                  ? isDark
                    ? 'bg-[#161B22] border-vestexa-coral/40 shadow-sm'
                    : 'bg-white border-vestexa-coral/40 shadow-sm'
                  : isDark
                    ? 'bg-[#161B22]/60 border-gray-800/80 opacity-75'
                    : 'bg-slate-50/80 border-slate-200'
              }`}
            >
              <div className={`w-10 h-10 rounded-2xl flex items-center justify-center shrink-0 border ${style.bg}`}>
                <span className="material-symbols-outlined text-xl">{style.icon}</span>
              </div>

              <div className="flex-1">
                <div className="flex items-center justify-between gap-2 mb-1">
                  <div className="flex items-center gap-2">
                    <h3 className={`font-display font-bold text-sm ${isDark ? 'text-white' : 'text-slate-900'}`}>
                      {n.title}
                    </h3>
                    {!n.isRead && (
                      <span className="w-2 h-2 rounded-full bg-vestexa-coral" />
                    )}
                  </div>
                  <span className={`text-[11px] font-mono ${isDark ? 'text-gray-400' : 'text-slate-400'}`}>
                    {new Date(n.createdAt).toLocaleDateString()} at {new Date(n.createdAt).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                  </span>
                </div>
                <p className={`text-xs ${isDark ? 'text-gray-300' : 'text-slate-600'} leading-relaxed`}>
                  {n.message}
                </p>
              </div>

              <button
                onClick={(e) => {
                  e.stopPropagation();
                  handleDelete(n.id);
                }}
                className={`p-2 rounded-full transition-colors ${
                  isDark ? 'text-gray-500 hover:text-red-400 hover:bg-red-500/10' : 'text-slate-400 hover:text-red-600 hover:bg-red-50'
                }`}
                title="Delete Notification"
              >
                <span className="material-symbols-outlined text-base">delete</span>
              </button>
            </div>
          );
        })}

        {filtered.length === 0 && (
          <div className={`p-12 text-center rounded-3xl border ${
            isDark ? 'bg-[#161B22] border-gray-800/80' : 'bg-white border-slate-200'
          }`}>
            <span className="material-symbols-outlined text-5xl text-gray-500 mb-3">notifications_off</span>
            <h3 className={`text-base font-display font-bold ${isDark ? 'text-white' : 'text-slate-900'}`}>
              No Notifications
            </h3>
            <p className={`text-xs mt-1 max-w-sm mx-auto ${isDark ? 'text-gray-400' : 'text-slate-500'}`}>
              You're all caught up! New yield events, transfers, and security alerts will appear here.
            </p>
          </div>
        )}
      </div>
    </div>
  );
};
