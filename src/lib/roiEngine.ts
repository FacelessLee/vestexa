import {
  getUserInvestments,
  updateUserInvestment,
  getInvestmentPlanById,
  getUserById,
  updateUserProfile,
  createTransaction,
  createNotification,
  getAppSettings,
  UserInvestment,
} from './storage';

/**
 * Returns the interval duration in milliseconds.
 * In demo mode, we provide an accelerated calculation option so users can see returns happen live.
 */
function getIntervalMs(interval: string, accelerated = false): number {
  if (accelerated) {
    // 30 seconds for live demo demonstration
    return 30 * 1000;
  }
  switch (interval.toLowerCase()) {
    case 'hourly':
      return 60 * 60 * 1000;
    case 'daily':
      return 24 * 60 * 60 * 1000;
    case 'weekly':
      return 7 * 24 * 60 * 60 * 1000;
    case 'monthly':
      return 30 * 24 * 60 * 60 * 1000;
    default:
      return 24 * 60 * 60 * 1000;
  }
}

export interface RoiAccrualResult {
  processedCount: number;
  totalEarnedAmount: number;
  expiredCount: number;
}

/**
 * Processes automated ROI accruals for active investments.
 * Simulates the cron/task controller from the fintech platform.
 */
export function processRoiAccruals(options: { forceAccelerated?: boolean } = {}): RoiAccrualResult {
  const settings = getAppSettings();
  if (!settings.tradeMode) {
    return { processedCount: 0, totalEarnedAmount: 0, expiredCount: 0 };
  }

  // Check weekend trading restriction
  const isWeekend = [0, 6].includes(new Date().getDay());
  if (isWeekend && !settings.weekendTrading && !options.forceAccelerated) {
    return { processedCount: 0, totalEarnedAmount: 0, expiredCount: 0 };
  }

  const activeInvestments = getUserInvestments().filter(inv => inv.status === 'active');
  const now = new Date();
  const nowTime = now.getTime();

  let processedCount = 0;
  let totalEarnedAmount = 0;
  let expiredCount = 0;

  for (const inv of activeInvestments) {
    const plan = getInvestmentPlanById(inv.planId);
    const user = getUserById(inv.userId);
    if (!user) continue;

    const activatedTime = inv.activatedAt ? new Date(inv.activatedAt).getTime() : new Date(inv.createdAt).getTime();
    const lastAccrualTime = inv.lastRoiAt ? new Date(inv.lastRoiAt).getTime() : activatedTime;

    const intervalMs = getIntervalMs(inv.roiInterval, options.forceAccelerated);
    const timeSinceLast = nowTime - lastAccrualTime;

    // Check if plan has expired
    const durationMs = (plan?.durationDays || 30) * 24 * 60 * 60 * 1000;
    const isExpired = nowTime - activatedTime >= durationMs;

    // Has enough time elapsed for an ROI cycle?
    if (timeSinceLast >= intervalMs && !isExpired) {
      const cycles = Math.min(Math.floor(timeSinceLast / intervalMs), 10); // cap batch catch-up
      const singleCycleEarn = inv.amount * (inv.roiPercentage / 100);
      const cycleEarn = singleCycleEarn * cycles;

      const newTotalEarned = (inv.totalEarned || 0) + cycleEarn;
      const newBalance = user.balance + cycleEarn;
      const newUserRoi = (user.roi || 0) + cycleEarn;

      updateUserInvestment(inv.id, {
        totalEarned: newTotalEarned,
        lastRoiAt: now.toISOString(),
      });

      updateUserProfile(user.id, {
        balance: newBalance,
        roi: newUserRoi,
      });

      createTransaction({
        userId: user.id,
        type: 'credit',
        amount: cycleEarn,
        narration: `ROI Payout — ${inv.planName || 'Investment Plan'} (${inv.roiPercentage}%)`,
        senderInfo: 'Vestexa Yield Engine',
        date: now.toISOString().split('T')[0],
        time: now.toTimeString().slice(0, 5),
        category: 'Interest',
        status: 'completed',
      });

      createNotification({
        userId: user.id,
        title: 'ROI Credited',
        message: `You earned $${cycleEarn.toFixed(2)} from your ${inv.planName || 'Investment'}!`,
        type: 'success',
      });

      processedCount++;
      totalEarnedAmount += cycleEarn;
    }

    // Handle maturity/expiration
    if (isExpired && inv.status === 'active') {
      updateUserInvestment(inv.id, {
        status: 'expired',
      });

      // Capital return if enabled on plan or global settings
      const shouldReturnCapital = plan ? plan.returnCapital : settings.returnCapital;
      if (shouldReturnCapital) {
        updateUserProfile(user.id, {
          balance: user.balance + inv.amount,
          investedAmount: Math.max(0, (user.investedAmount || 0) - inv.amount),
        });

        createTransaction({
          userId: user.id,
          type: 'credit',
          amount: inv.amount,
          narration: `Capital Principal Returned — ${inv.planName || 'Investment Plan'}`,
          senderInfo: 'Vestexa Treasury',
          date: now.toISOString().split('T')[0],
          time: now.toTimeString().slice(0, 5),
          category: 'Investment Return',
          status: 'completed',
        });

        createNotification({
          userId: user.id,
          title: 'Investment Matured',
          message: `Your ${inv.planName || 'Investment'} has reached maturity. $${inv.amount.toFixed(2)} principal returned to balance.`,
          type: 'info',
        });
      }

      expiredCount++;
    }
  }

  return { processedCount, totalEarnedAmount, expiredCount };
}
