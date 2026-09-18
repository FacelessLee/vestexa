import React, { useState, useEffect } from 'react';
import {
  User,
  AppNotification,
  getUsers,
  getNotifications,
  createNotification,
  deleteNotification,
} from '../../lib/storage';

interface NotificationSenderProps {
  users: User[];
  allowBroadcast?: boolean;
  isDark?: boolean;
}

export const NotificationSender: React.FC<NotificationSenderProps> = ({ users: assignedUsers, allowBroadcast = false, isDark = true }) => {
  const [users, setUsers] = useState<User[]>(assignedUsers);
  const [recentNotifications, setRecentNotifications] = useState<AppNotification[]>([]);
  const [targetUserId, setTargetUserId] = useState<string>(allowBroadcast ? 'all' : assignedUsers[0]?.id || '');
  const [title, setTitle] = useState('');
  const [message, setMessage] = useState('');
  const [type, setType] = useState<AppNotification['type']>('info');
  const [msg, setMsg] = useState('');

  useEffect(() => {
    setUsers(assignedUsers);
    loadNotifications();
  }, [assignedUsers]);

  const loadNotifications = () => {
    // Get all notifications by querying for 'all' + individual users
    const all = getNotifications('all');
    setRecentNotifications(all.slice(0, 20));
  };

  const handleSend = (e: React.FormEvent) => {
    e.preventDefault();
    if (!title.trim() || !message.trim()) return;
    if (!targetUserId || (!allowBroadcast && targetUserId === 'all')) return;

    createNotification({
      userId: targetUserId,
      title: title.trim(),
      message: message.trim(),
      type,
    });

    setMsg(`Notification "${title}" dispatched successfully!`);
    setTitle('');
    setMessage('');
    loadNotifications();
    setTimeout(() => setMsg(''), 4000);
  };

  const handleDelete = (id: string) => {
    deleteNotification(id);
    loadNotifications();
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h2 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-[#0B0F14]'}`}>
          System Broadcast & Direct Alerts
        </h2>
        <p className={`text-xs mt-1 ${isDark ? 'text-gray-400' : 'text-gray-500'}`}>
          Dispatch in-app notifications, regulatory alerts, yield payouts announcements, or direct user messages.
        </p>
      </div>

      {msg && (
        <div className={`p-3.5 rounded-card-lg text-xs flex items-center gap-2 ${
          isDark
            ? 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-400'
            : 'bg-emerald-50 border border-emerald-200 text-emerald-700'
        }`}>
          <span className="material-symbols-outlined text-base">check_circle</span>
          <span>{msg}</span>
        </div>
      )}

      {/* Main Grid */}
      <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {/* Compose Form (Span 5) */}
        <div className={`lg:col-span-5 p-6 rounded-card-xl border transition-all ${
          isDark
            ? 'border-gray-800/80 bg-[#141824]'
            : 'border-[#FEE9E6] bg-white shadow-md'
        }`}>
          <h3 className={`text-lg font-display font-bold mb-4 ${isDark ? 'text-white' : 'text-[#0B0F14]'}`}>
            Compose New Notice
          </h3>

          <form onSubmit={handleSend} className="space-y-4">
            <div>
              <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${
                isDark ? 'text-gray-400' : 'text-gray-600'
              }`}>
                Target Recipient
              </label>
              <select
                value={targetUserId}
                onChange={(e) => setTargetUserId(e.target.value)}
                className={`w-full rounded-card-lg px-4 py-2.5 border text-sm font-bold focus:border-vestexa-coral focus:outline-none transition-colors ${
                  isDark
                    ? 'bg-[#0D1117] border-gray-800 text-white'
                    : 'bg-[#FFF6F5] border-[#FEE9E6] text-gray-900 focus:bg-white'
                }`}
              >
                {allowBroadcast && <option value="all">Broadcast to ALL Platform Users</option>}
                {users.map((u) => (
                  <option key={u.id} value={u.id}>
                    {u.fullName} ({u.email})
                  </option>
                ))}
              </select>
            </div>

            <div>
              <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${
                isDark ? 'text-gray-400' : 'text-gray-600'
              }`}>
                Notice Title
              </label>
              <input
                type="text"
                required
                value={title}
                onChange={(e) => setTitle(e.target.value)}
                placeholder="e.g. Scheduled Network Upgrade"
                className={`w-full rounded-card-lg px-4 py-2.5 border text-sm font-bold focus:border-vestexa-coral focus:outline-none transition-colors ${
                  isDark
                    ? 'bg-[#0D1117] border-gray-800 text-white placeholder:text-gray-600'
                    : 'bg-[#FFF6F5] border-[#FEE9E6] text-gray-900 placeholder:text-gray-400 focus:bg-white'
                }`}
              />
            </div>

            <div>
              <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${
                isDark ? 'text-gray-400' : 'text-gray-600'
              }`}>
                Alert Priority / Type
              </label>
              <div className="grid grid-cols-4 gap-2">
                {(['info', 'success', 'warning', 'danger'] as const).map((t) => (
                  <button
                    key={t}
                    type="button"
                    onClick={() => setType(t)}
                    className={`py-2 rounded-xl text-xs font-bold capitalize transition-all border ${
                      type === t
                        ? 'border-vestexa-coral bg-vestexa-coral/20 text-vestexa-coral'
                        : isDark
                          ? 'border-gray-800 text-gray-400 hover:text-white bg-[#0D1117]'
                          : 'border-gray-200 text-gray-600 hover:text-gray-900 bg-white'
                    }`}
                  >
                    {t}
                  </button>
                ))}
              </div>
            </div>

            <div>
              <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${
                isDark ? 'text-gray-400' : 'text-gray-600'
              }`}>
                Message Body
              </label>
              <textarea
                rows={4}
                required
                value={message}
                onChange={(e) => setMessage(e.target.value)}
                placeholder="Write message details for the user notification feed..."
                className={`w-full rounded-card-lg px-4 py-2.5 border text-sm focus:border-vestexa-coral focus:outline-none transition-colors ${
                  isDark
                    ? 'bg-[#0D1117] border-gray-800 text-white placeholder:text-gray-600'
                    : 'bg-[#FFF6F5] border-[#FEE9E6] text-gray-900 placeholder:text-gray-400 focus:bg-white'
                }`}
              />
            </div>

            <button
              type="submit"
              className="w-full py-3 rounded-full text-xs font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover text-white shadow-pill transition-all"
            >
              Dispatch Notification
            </button>
          </form>
        </div>

        {/* History Feed (Span 7) */}
        <div className={`lg:col-span-7 rounded-card-xl border p-6 flex flex-col justify-between transition-all ${
          isDark
            ? 'border-gray-800/80 bg-[#141824]'
            : 'border-[#FEE9E6] bg-white shadow-md'
        }`}>
          <div>
            <h3 className={`text-lg font-display font-bold mb-4 ${isDark ? 'text-white' : 'text-[#0B0F14]'}`}>
              Recently Dispatched Notices
            </h3>

            <div className="space-y-3">
              {recentNotifications.map((n) => (
                <div
                  key={n.id}
                  className={`p-4 rounded-card-lg border flex items-start justify-between gap-3 transition-colors ${
                    isDark
                      ? 'border-gray-800 bg-[#0D1117]'
                      : 'border-[#FEE9E6] bg-[#FFF6F5]'
                  }`}
                >
                  <div>
                    <div className="flex items-center gap-2 mb-1">
                      <span className={`px-2 py-0.5 rounded text-[10px] font-extrabold uppercase ${
                        n.type === 'success'
                          ? isDark ? 'bg-emerald-500/20 text-emerald-400' : 'bg-emerald-100 text-emerald-700'
                          : n.type === 'danger'
                            ? isDark ? 'bg-red-500/20 text-red-400' : 'bg-red-100 text-red-700'
                            : n.type === 'warning'
                              ? isDark ? 'bg-amber-500/20 text-amber-400' : 'bg-amber-100 text-amber-700'
                              : isDark ? 'bg-blue-500/20 text-blue-400' : 'bg-blue-100 text-blue-700'
                      }`}>
                        {n.type}
                      </span>
                      <h4 className={`font-bold text-sm ${isDark ? 'text-white' : 'text-gray-900'}`}>{n.title}</h4>
                      <span className={`text-[10px] font-mono ${isDark ? 'text-gray-500' : 'text-gray-400'}`}>
                        {n.userId === 'all' ? 'Broadcast' : 'Direct'}
                      </span>
                    </div>
                    <p className={`text-xs ${isDark ? 'text-gray-400' : 'text-gray-600'}`}>{n.message}</p>
                  </div>

                  <button
                    onClick={() => handleDelete(n.id)}
                    className="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-colors shrink-0"
                    title="Delete Notice"
                  >
                    <span className="material-symbols-outlined text-sm">delete</span>
                  </button>
                </div>
              ))}

              {recentNotifications.length === 0 && (
                <div className={`p-8 text-center text-xs ${isDark ? 'text-gray-500' : 'text-gray-400'}`}>
                  No notifications recorded yet.
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
