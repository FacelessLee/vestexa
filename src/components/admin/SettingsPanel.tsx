import React, { useState, useEffect } from 'react';
import {
  AppSettings,
  getAppSettings,
  updateAppSettings,
} from '../../lib/storage';

interface SettingsPanelProps {
  isDark?: boolean;
}

export const SettingsPanel: React.FC<SettingsPanelProps> = ({ isDark = true }) => {
  const [settings, setSettings] = useState<AppSettings>(getAppSettings());
  const [msg, setMsg] = useState('');

  useEffect(() => {
    setSettings(getAppSettings());
  }, []);

  const handleSave = (e: React.FormEvent) => {
    e.preventDefault();
    const updated = updateAppSettings(settings);
    setSettings(updated);
    setMsg('System governance and platform settings updated successfully!');
    setTimeout(() => setMsg(''), 4000);
  };

  const handleTierChange = (index: number, val: number) => {
    const nextLevels = [...(settings.referralCommissionLevels || [5, 3, 2, 1, 0.5])];
    nextLevels[index] = val;
    setSettings({
      ...settings,
      referralCommissionLevels: nextLevels,
    });
  };

  const handleModuleToggle = (moduleKey: keyof AppSettings['modules']) => {
    setSettings({
      ...settings,
      modules: {
        ...settings.modules,
        [moduleKey]: !settings.modules[moduleKey],
      },
    });
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h2 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-[#0B0F14]'}`}>
          System Control & Platform Governance
        </h2>
        <p className={`text-xs mt-1 ${isDark ? 'text-gray-400' : 'text-gray-500'}`}>
          Adjust automated trade engines, affiliate commission structures, signup bonuses, and core feature toggles.
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

      <form onSubmit={handleSave} className="space-y-8 max-w-4xl">
        {/* Core Trading & Financial Engines */}
        <div className={`p-6 rounded-card-xl border space-y-5 transition-all ${
          isDark
            ? 'border-gray-800/80 bg-[#141824]'
            : 'border-[#FEE9E6] bg-white shadow-md'
        }`}>
          <h3 className={`text-lg font-display font-bold flex items-center gap-2 ${
            isDark ? 'text-white' : 'text-[#0B0F14]'
          }`}>
            <span className="material-symbols-outlined text-vestexa-coral">memory</span>
            Algorithmic Engine & Settlement Controls
          </h3>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div className={`flex items-center justify-between p-4 rounded-card-lg border transition-colors ${
              isDark ? 'bg-[#0D1117] border-gray-800' : 'bg-[#FFF6F5] border-[#FEE9E6]'
            }`}>
              <div>
                <p className={`text-sm font-bold ${isDark ? 'text-white' : 'text-gray-900'}`}>Automated Trade Mode</p>
                <p className={`text-xs mt-0.5 ${isDark ? 'text-gray-400' : 'text-gray-500'}`}>Enables continuous client ROI yield calculation</p>
              </div>
              <input
                type="checkbox"
                checked={settings.tradeMode}
                onChange={(e) => setSettings({ ...settings, tradeMode: e.target.checked })}
                className="w-5 h-5 rounded text-vestexa-coral focus:ring-vestexa-coral accent-[#F73B20] cursor-pointer"
              />
            </div>

            <div className={`flex items-center justify-between p-4 rounded-card-lg border transition-colors ${
              isDark ? 'bg-[#0D1117] border-gray-800' : 'bg-[#FFF6F5] border-[#FEE9E6]'
            }`}>
              <div>
                <p className={`text-sm font-bold ${isDark ? 'text-white' : 'text-gray-900'}`}>Weekend Trading</p>
                <p className={`text-xs mt-0.5 ${isDark ? 'text-gray-400' : 'text-gray-500'}`}>Allow yield accruals on Saturday & Sunday</p>
              </div>
              <input
                type="checkbox"
                checked={settings.weekendTrading}
                onChange={(e) => setSettings({ ...settings, weekendTrading: e.target.checked })}
                className="w-5 h-5 rounded text-vestexa-coral focus:ring-vestexa-coral accent-[#F73B20] cursor-pointer"
              />
            </div>

            <div className={`flex items-center justify-between p-4 rounded-card-lg border transition-colors ${
              isDark ? 'bg-[#0D1117] border-gray-800' : 'bg-[#FFF6F5] border-[#FEE9E6]'
            }`}>
              <div>
                <p className={`text-sm font-bold ${isDark ? 'text-white' : 'text-gray-900'}`}>Return Capital by Default</p>
                <p className={`text-xs mt-0.5 ${isDark ? 'text-gray-400' : 'text-gray-500'}`}>Auto-refund principal on plan maturity</p>
              </div>
              <input
                type="checkbox"
                checked={settings.returnCapital}
                onChange={(e) => setSettings({ ...settings, returnCapital: e.target.checked })}
                className="w-5 h-5 rounded text-vestexa-coral focus:ring-vestexa-coral accent-[#F73B20] cursor-pointer"
              />
            </div>

            <div className={`flex items-center justify-between p-4 rounded-card-lg border transition-colors ${
              isDark ? 'bg-[#0D1117] border-gray-800' : 'bg-[#FFF6F5] border-[#FEE9E6]'
            }`}>
              <div>
                <p className={`text-sm font-bold ${isDark ? 'text-white' : 'text-gray-900'}`}>Withdrawal Approval Flow</p>
                <p className={`text-xs mt-0.5 ${isDark ? 'text-gray-400' : 'text-gray-500'}`}>Method of handling outbound requests</p>
              </div>
              <select
                value={settings.withdrawalOption}
                onChange={(e: any) => setSettings({ ...settings, withdrawalOption: e.target.value })}
                className={`rounded-xl px-3 py-1.5 border text-xs font-bold focus:outline-none ${
                  isDark ? 'bg-gray-800 border-gray-700 text-white' : 'bg-white border-gray-200 text-gray-900 shadow-sm'
                }`}
              >
                <option value="manual">Manual Review</option>
                <option value="auto">Instant Auto</option>
              </select>
            </div>
          </div>
        </div>

        {/* Fees & Bonuses */}
        <div className={`p-6 rounded-card-xl border space-y-5 transition-all ${
          isDark
            ? 'border-gray-800/80 bg-[#141824]'
            : 'border-[#FEE9E6] bg-white shadow-md'
        }`}>
          <h3 className={`text-lg font-display font-bold flex items-center gap-2 ${
            isDark ? 'text-white' : 'text-[#0B0F14]'
          }`}>
            <span className="material-symbols-outlined text-emerald-400">payments</span>
            Incentives & Transaction Pricing
          </h3>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${
                isDark ? 'text-gray-400' : 'text-gray-600'
              }`}>
                Signup Welcome Bonus ($)
              </label>
              <input
                type="number"
                value={settings.signupBonus}
                onChange={(e) => setSettings({ ...settings, signupBonus: parseFloat(e.target.value) || 0 })}
                className={`w-full rounded-card-lg px-4 py-2.5 border text-sm font-bold focus:border-vestexa-coral focus:outline-none transition-colors ${
                  isDark
                    ? 'bg-[#0D1117] border-gray-800 text-white'
                    : 'bg-[#FFF6F5] border-[#FEE9E6] text-gray-900 focus:bg-white'
                }`}
              />
            </div>

            <div>
              <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${
                isDark ? 'text-gray-400' : 'text-gray-600'
              }`}>
                Transfer Commission Fee (%)
              </label>
              <input
                type="number"
                step="0.1"
                value={settings.commissionFee}
                onChange={(e) => setSettings({ ...settings, commissionFee: parseFloat(e.target.value) || 0 })}
                className={`w-full rounded-card-lg px-4 py-2.5 border text-sm font-bold focus:border-vestexa-coral focus:outline-none transition-colors ${
                  isDark
                    ? 'bg-[#0D1117] border-gray-800 text-white'
                    : 'bg-[#FFF6F5] border-[#FEE9E6] text-gray-900 focus:bg-white'
                }`}
              />
            </div>
          </div>

          <div>
            <label className={`block text-xs font-bold uppercase tracking-wider mb-2 ${
              isDark ? 'text-gray-400' : 'text-gray-600'
            }`}>
              Multi-Tier Referral Commission Percentages (Tier 1 – 5)
            </label>
            <div className="grid grid-cols-5 gap-3">
              {(settings.referralCommissionLevels || [5, 3, 2, 1, 0.5]).map((rate, idx) => (
                <div key={idx} className="text-center">
                  <span className={`text-[10px] font-bold uppercase block mb-1 ${
                    isDark ? 'text-gray-400' : 'text-gray-500'
                  }`}>
                    Tier {idx + 1}
                  </span>
                  <div className="relative">
                    <input
                      type="number"
                      step="0.1"
                      value={rate}
                      onChange={(e) => handleTierChange(idx, parseFloat(e.target.value) || 0)}
                      className={`w-full text-center rounded-xl py-2 border text-xs font-bold text-vestexa-coral focus:outline-none ${
                        isDark ? 'bg-[#0D1117] border-gray-800' : 'bg-[#FFF6F5] border-[#FEE9E6]'
                      }`}
                    />
                    <span className={`absolute right-2 top-2 text-[10px] font-bold ${
                      isDark ? 'text-gray-500' : 'text-gray-400'
                    }`}>%</span>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>

        {/* Feature Modules Toggle */}
        <div className={`p-6 rounded-card-xl border space-y-4 transition-all ${
          isDark
            ? 'border-gray-800/80 bg-[#141824]'
            : 'border-[#FEE9E6] bg-white shadow-md'
        }`}>
          <h3 className={`text-lg font-display font-bold flex items-center gap-2 ${
            isDark ? 'text-white' : 'text-[#0B0F14]'
          }`}>
            <span className="material-symbols-outlined text-purple-400">tune</span>
            Platform Functional Modules
          </h3>

          <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
            {Object.entries(settings.modules).map(([modKey, isEnabled]) => (
              <button
                key={modKey}
                type="button"
                onClick={() => handleModuleToggle(modKey as keyof AppSettings['modules'])}
                className={`p-3.5 rounded-card-lg border text-left transition-all capitalize flex flex-col justify-between h-24 ${
                  isEnabled
                    ? isDark
                      ? 'border-vestexa-coral/50 bg-vestexa-coral/10 text-white'
                      : 'border-vestexa-coral/50 bg-[#FFF6F5] text-gray-900 shadow-sm'
                    : isDark
                      ? 'border-gray-800 bg-[#0D1117] text-gray-500'
                      : 'border-gray-200 bg-gray-50 text-gray-400'
                }`}
              >
                <span className="text-xs font-bold">{modKey}</span>
                <span className={`text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full self-start ${
                  isEnabled
                    ? isDark ? 'bg-emerald-500/20 text-emerald-400' : 'bg-emerald-100 text-emerald-700'
                    : isDark ? 'bg-gray-800 text-gray-500' : 'bg-gray-200 text-gray-600'
                }`}>
                  {isEnabled ? 'Enabled' : 'Disabled'}
                </span>
              </button>
            ))}
          </div>
        </div>

        <button
          type="submit"
          className="px-8 py-3.5 rounded-full text-xs font-bold text-white bg-vestexa-coral hover:bg-vestexa-coral-hover shadow-pill transition-all"
        >
          Save Platform Configuration
        </button>
      </form>
    </div>
  );
};
