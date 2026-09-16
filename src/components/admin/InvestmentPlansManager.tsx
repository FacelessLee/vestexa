import React, { useState, useEffect } from 'react';
import {
  InvestmentPlan,
  getInvestmentPlans,
  createInvestmentPlan,
  updateInvestmentPlan,
  deleteInvestmentPlan,
} from '../../lib/storage';

interface InvestmentPlansManagerProps {
  formatCurrency: (amount: number) => string;
  isDark?: boolean;
}

export const InvestmentPlansManager: React.FC<InvestmentPlansManagerProps> = ({
  formatCurrency,
  isDark = true,
}) => {
  const [plans, setPlans] = useState<InvestmentPlan[]>([]);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [editingPlan, setEditingPlan] = useState<InvestmentPlan | null>(null);

  // Form State
  const [name, setName] = useState('');
  const [minAmount, setMinAmount] = useState('500');
  const [maxAmount, setMaxAmount] = useState('50000');
  const [roiPercentage, setRoiPercentage] = useState('3.5');
  const [roiInterval, setRoiInterval] = useState<'hourly' | 'daily' | 'weekly' | 'monthly'>('daily');
  const [durationDays, setDurationDays] = useState('30');
  const [type, setType] = useState<'main' | 'promo'>('main');
  const [returnCapital, setReturnCapital] = useState(true);
  const [isActive, setIsActive] = useState(true);
  const [msg, setMsg] = useState('');

  useEffect(() => {
    loadPlans();
  }, []);

  const loadPlans = () => {
    setPlans(getInvestmentPlans());
  };

  const openCreateModal = () => {
    setEditingPlan(null);
    setName('');
    setMinAmount('500');
    setMaxAmount('50000');
    setRoiPercentage('3.5');
    setRoiInterval('daily');
    setDurationDays('30');
    setType('main');
    setReturnCapital(true);
    setIsActive(true);
    setIsModalOpen(true);
  };

  const openEditModal = (plan: InvestmentPlan) => {
    setEditingPlan(plan);
    setName(plan.name);
    setMinAmount(plan.minAmount.toString());
    setMaxAmount(plan.maxAmount.toString());
    setRoiPercentage(plan.roiPercentage.toString());
    setRoiInterval(plan.roiInterval);
    setDurationDays(plan.durationDays.toString());
    setType(plan.type);
    setReturnCapital(plan.returnCapital);
    setIsActive(plan.isActive);
    setIsModalOpen(true);
  };

  const handleSave = (e: React.FormEvent) => {
    e.preventDefault();
    if (!name.trim()) return;

    const payload = {
      name: name.trim(),
      minAmount: parseFloat(minAmount) || 100,
      maxAmount: parseFloat(maxAmount) || 10000,
      roiPercentage: parseFloat(roiPercentage) || 1.0,
      roiInterval,
      durationDays: parseInt(durationDays, 10) || 30,
      type,
      returnCapital,
      isActive,
    };

    if (editingPlan) {
      updateInvestmentPlan(editingPlan.id, payload);
      setMsg(`Updated portfolio plan "${payload.name}"`);
    } else {
      createInvestmentPlan(payload);
      setMsg(`Created new portfolio plan "${payload.name}"`);
    }

    setIsModalOpen(false);
    loadPlans();
    setTimeout(() => setMsg(''), 4000);
  };

  const handleDelete = (id: string, planName: string) => {
    if (window.confirm(`Permanently delete investment plan "${planName}"?`)) {
      deleteInvestmentPlan(id);
      loadPlans();
      setMsg(`Plan "${planName}" removed`);
      setTimeout(() => setMsg(''), 4000);
    }
  };

  const handleToggleStatus = (plan: InvestmentPlan) => {
    updateInvestmentPlan(plan.id, { isActive: !plan.isActive });
    loadPlans();
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h2 className={`text-2xl font-display font-bold ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
            Algorithmic Investment Portfolios
          </h2>
          <p className={`text-xs mt-1 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
            Configure return schedules, duration locks, and minimum capital brackets
          </p>
        </div>

        <button
          onClick={openCreateModal}
          className="px-5 py-2.5 rounded-full text-xs font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover text-white shadow-pill flex items-center gap-2 self-start sm:self-auto"
        >
          <span className="material-symbols-outlined text-base">add</span>
          Create New Plan
        </button>
      </div>

      {msg && (
        <div className={`p-3.5 rounded-card-lg border text-xs flex items-center gap-2 ${
          isDark ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : 'bg-emerald-50 border-emerald-200 text-emerald-800'
        }`}>
          <span className="material-symbols-outlined text-base">check_circle</span>
          <span>{msg}</span>
        </div>
      )}

      {/* Plans Table */}
      <div className={`rounded-card-xl border overflow-hidden shadow-xl ${
        isDark ? 'bg-[#141824] border-white/10' : 'bg-white border-vestexa-peach-border shadow-card'
      }`}>
        <div className="overflow-x-auto">
          <table className="w-full text-left text-sm">
            <thead className={`text-xs uppercase font-bold tracking-wider border-b ${
              isDark ? 'bg-gray-900/50 text-gray-400 border-gray-800' : 'bg-vestexa-peach text-jeton-orange-900/60 border-vestexa-peach-border'
            }`}>
              <tr>
                <th className="px-6 py-4">Plan Name</th>
                <th className="px-6 py-4">ROI Yield</th>
                <th className="px-6 py-4">Min – Max Deposit</th>
                <th className="px-6 py-4">Duration</th>
                <th className="px-6 py-4">Type</th>
                <th className="px-6 py-4">Capital Return</th>
                <th className="px-6 py-4">Status</th>
                <th className="px-6 py-4 text-right">Actions</th>
              </tr>
            </thead>
            <tbody className={`divide-y ${isDark ? 'divide-gray-800/60 text-gray-200' : 'divide-neutral-200 text-neutral-700'}`}>
              {plans.map((p) => (
                <tr key={p.id} className={`transition-colors ${isDark ? 'hover:bg-gray-800/30' : 'hover:bg-neutral-50'}`}>
                  <td className={`px-6 py-4 font-bold flex items-center gap-2 ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
                    <span className="material-symbols-outlined text-vestexa-coral text-base">monitoring</span>
                    {p.name}
                  </td>
                  <td className="px-6 py-4 font-mono font-bold text-emerald-500 dark:text-emerald-400">
                    {p.roiPercentage}% / {p.roiInterval}
                  </td>
                  <td className="px-6 py-4 font-mono text-xs">
                    {formatCurrency(p.minAmount)} – {formatCurrency(p.maxAmount)}
                  </td>
                  <td className="px-6 py-4 text-xs font-semibold">
                    {p.durationDays} Days
                  </td>
                  <td className="px-6 py-4">
                    <span className={`px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase ${
                      p.type === 'promo'
                        ? 'bg-amber-500/20 text-amber-600 dark:text-amber-300 border border-amber-500/30'
                        : isDark ? 'bg-gray-800 text-gray-300' : 'bg-vestexa-peach text-neutral-700 border border-vestexa-peach-border'
                    }`}>
                      {p.type}
                    </span>
                  </td>
                  <td className="px-6 py-4 text-xs">
                    {p.returnCapital ? (
                      <span className="text-emerald-500 dark:text-emerald-400 font-bold flex items-center gap-1">
                        <span className="material-symbols-outlined text-sm">check</span> Yes
                      </span>
                    ) : (
                      <span className={isDark ? 'text-gray-400' : 'text-jeton-orange-900/40'}>No</span>
                    )}
                  </td>
                  <td className="px-6 py-4">
                    <button
                      onClick={() => handleToggleStatus(p)}
                      className={`px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider ${
                        p.isActive
                          ? 'bg-emerald-500/10 text-emerald-500 dark:text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/20'
                          : isDark
                            ? 'bg-gray-800 text-gray-400 border border-gray-700 hover:bg-gray-700'
                            : 'bg-vestexa-peach text-jeton-orange-900/50 border border-vestexa-peach-border hover:bg-[#F73B20]/10'
                      }`}
                    >
                      {p.isActive ? 'Active' : 'Disabled'}
                    </button>
                  </td>
                  <td className="px-6 py-4 text-right">
                    <div className="flex items-center justify-end gap-2">
                      <button
                        onClick={() => openEditModal(p)}
                        className={`p-1.5 rounded-lg transition-colors ${
                          isDark ? 'hover:bg-gray-800 text-gray-400 hover:text-white' : 'hover:bg-[#F73B20]/5 text-jeton-orange-900/50 hover:text-jeton-orange-900'
                        }`}
                        title="Edit Plan"
                      >
                        <span className="material-symbols-outlined text-base">edit</span>
                      </button>
                      <button
                        onClick={() => handleDelete(p.id, p.name)}
                        className={`p-1.5 rounded-lg transition-colors ${
                          isDark ? 'hover:bg-red-500/10 text-gray-400 hover:text-red-400' : 'hover:bg-red-50 text-jeton-orange-900/50 hover:text-red-600'
                        }`}
                        title="Delete Plan"
                      >
                        <span className="material-symbols-outlined text-base">delete</span>
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      {/* Plan Modal (Create / Edit) */}
      {isModalOpen && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
          <div className={`w-full max-w-lg rounded-card-xl border p-6 sm:p-8 shadow-2xl relative ${
            isDark ? 'border-white/10 bg-[#141824] text-white' : 'border-vestexa-peach-border bg-white text-jeton-orange-900'
          }`}>
            <button
              onClick={() => setIsModalOpen(false)}
              className={`absolute top-6 right-6 p-1.5 rounded-full ${
                isDark ? 'hover:bg-gray-800 text-gray-400 hover:text-white' : 'hover:bg-[#F73B20]/5 text-jeton-orange-900/40 hover:text-jeton-orange-900'
              }`}
            >
              <span className="material-symbols-outlined text-lg">close</span>
            </button>

            <h3 className={`text-xl font-display font-bold mb-4 ${isDark ? 'text-white' : 'text-jeton-orange-900'}`}>
              {editingPlan ? 'Edit Portfolio Plan' : 'Create Investment Plan'}
            </h3>

            <form onSubmit={handleSave} className="space-y-4">
              <div>
                <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
                  Portfolio Name
                </label>
                <input
                  type="text"
                  required
                  value={name}
                  onChange={(e) => setName(e.target.value)}
                  placeholder="e.g. Quantitative Macro Yield"
                  className={`w-full rounded-card-lg px-4 py-2.5 text-sm font-bold border focus:border-vestexa-coral focus:outline-none ${
                    isDark ? 'bg-[#0B0F14] border-gray-800 text-white' : 'bg-neutral-50 border-vestexa-peach-border text-jeton-orange-900'
                  }`}
                />
              </div>

              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
                    Min Deposit ($)
                  </label>
                  <input
                    type="number"
                    value={minAmount}
                    onChange={(e) => setMinAmount(e.target.value)}
                    className={`w-full rounded-card-lg px-4 py-2.5 text-sm font-bold border focus:border-vestexa-coral focus:outline-none ${
                      isDark ? 'bg-[#0B0F14] border-gray-800 text-white' : 'bg-neutral-50 border-vestexa-peach-border text-jeton-orange-900'
                    }`}
                  />
                </div>
                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
                    Max Deposit ($)
                  </label>
                  <input
                    type="number"
                    value={maxAmount}
                    onChange={(e) => setMaxAmount(e.target.value)}
                    className={`w-full rounded-card-lg px-4 py-2.5 text-sm font-bold border focus:border-vestexa-coral focus:outline-none ${
                      isDark ? 'bg-[#0B0F14] border-gray-800 text-white' : 'bg-neutral-50 border-vestexa-peach-border text-jeton-orange-900'
                    }`}
                  />
                </div>
              </div>

              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
                    ROI Rate (%)
                  </label>
                  <input
                    type="number"
                    step="0.1"
                    value={roiPercentage}
                    onChange={(e) => setRoiPercentage(e.target.value)}
                    className={`w-full rounded-card-lg px-4 py-2.5 text-sm font-bold border focus:border-vestexa-coral focus:outline-none ${
                      isDark ? 'bg-[#0B0F14] border-gray-800 text-white' : 'bg-neutral-50 border-vestexa-peach-border text-jeton-orange-900'
                    }`}
                  />
                </div>
                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
                    Accrual Frequency
                  </label>
                  <select
                    value={roiInterval}
                    onChange={(e: any) => setRoiInterval(e.target.value)}
                    className={`w-full rounded-card-lg px-4 py-2.5 text-sm font-bold border focus:border-vestexa-coral focus:outline-none ${
                      isDark ? 'bg-[#0B0F14] border-gray-800 text-white' : 'bg-neutral-50 border-vestexa-peach-border text-jeton-orange-900'
                    }`}
                  >
                    <option value="hourly">Hourly</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                  </select>
                </div>
              </div>

              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
                    Duration (Days)
                  </label>
                  <input
                    type="number"
                    value={durationDays}
                    onChange={(e) => setDurationDays(e.target.value)}
                    className={`w-full rounded-card-lg px-4 py-2.5 text-sm font-bold border focus:border-vestexa-coral focus:outline-none ${
                      isDark ? 'bg-[#0B0F14] border-gray-800 text-white' : 'bg-neutral-50 border-vestexa-peach-border text-jeton-orange-900'
                    }`}
                  />
                </div>
                <div>
                  <label className={`block text-xs font-bold uppercase tracking-wider mb-1.5 ${isDark ? 'text-gray-400' : 'text-jeton-orange-900/60'}`}>
                    Plan Category
                  </label>
                  <select
                    value={type}
                    onChange={(e: any) => setType(e.target.value)}
                    className={`w-full rounded-card-lg px-4 py-2.5 text-sm font-bold border focus:border-vestexa-coral focus:outline-none ${
                      isDark ? 'bg-[#0B0F14] border-gray-800 text-white' : 'bg-neutral-50 border-vestexa-peach-border text-jeton-orange-900'
                    }`}
                  >
                    <option value="main">Standard Portfolio</option>
                    <option value="promo">Promo / Limited Sprint</option>
                  </select>
                </div>
              </div>

              <div className="flex items-center gap-6 pt-2">
                <label className={`flex items-center gap-2 text-xs font-semibold cursor-pointer ${isDark ? 'text-gray-300' : 'text-neutral-700'}`}>
                  <input
                    type="checkbox"
                    checked={returnCapital}
                    onChange={(e) => setReturnCapital(e.target.checked)}
                    className="rounded text-vestexa-coral"
                  />
                  Return Principal Upon Maturity
                </label>

                <label className={`flex items-center gap-2 text-xs font-semibold cursor-pointer ${isDark ? 'text-gray-300' : 'text-neutral-700'}`}>
                  <input
                    type="checkbox"
                    checked={isActive}
                    onChange={(e) => setIsActive(e.target.checked)}
                    className="rounded text-vestexa-coral"
                  />
                  Live &amp; Active
                </label>
              </div>

              <div className="flex gap-3 pt-4">
                <button
                  type="button"
                  onClick={() => setIsModalOpen(false)}
                  className={`flex-1 py-3 rounded-full text-xs font-bold transition-colors ${
                    isDark ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' : 'bg-vestexa-peach text-neutral-700 hover:bg-[#F73B20]/10 border border-vestexa-peach-border'
                  }`}
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  className="flex-1 py-3 rounded-full text-xs font-bold bg-vestexa-coral hover:bg-vestexa-coral-hover text-white shadow-pill"
                >
                  {editingPlan ? 'Save Changes' : 'Publish Plan'}
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};
