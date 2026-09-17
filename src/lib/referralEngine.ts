import {
  User,
  getUsers,
  getUserById,
  updateUserProfile,
  createTransaction,
  createNotification,
  getAppSettings,
} from './storage';

/**
 * Generates or retrieves a unique referral code for a user
 */
export function getReferralCode(user: User): string {
  if (user.username) {
    return user.username.toUpperCase();
  }
  return `VX-${user.id.slice(-6).toUpperCase()}`;
}

/**
 * Returns the full referral link for the user
 */
export function getReferralLink(user: User): string {
  const code = getReferralCode(user);
  const base = window.location.origin;
  return `${base}/signup?ref=${code}`;
}

/**
 * Grants signup bonus to a newly registered user if not yet received
 */
export function processSignupBonus(userId: string): boolean {
  const user = getUserById(userId);
  const settings = getAppSettings();

  if (!user || user.signupBonusReceived || settings.signupBonus <= 0) {
    return false;
  }

  const bonusAmount = settings.signupBonus;
  updateUserProfile(userId, {
    balance: user.balance + bonusAmount,
    bonus: (user.bonus || 0) + bonusAmount,
    signupBonusReceived: true,
  });

  const now = new Date();
  createTransaction({
    userId,
    type: 'credit',
    amount: bonusAmount,
    narration: 'Welcome Signup Bonus',
    senderInfo: 'Vestexa Welcome Team',
    date: now.toISOString().split('T')[0],
    time: now.toTimeString().slice(0, 5),
    category: 'Bonus',
    status: 'completed',
  }, { skipBalanceUpdate: true });

  createNotification({
    userId,
    title: 'Welcome Bonus Credited!',
    message: `$${bonusAmount.toFixed(2)} welcome bonus has been added to your balance.`,
    type: 'success',
  });

  return true;
}

/**
 * Distributes multi-level referral commissions upon investment purchase
 */
export function processReferralCommission(
  investorId: string,
  investmentAmount: number
): { creditedCount: number; totalBonus: number } {
  const settings = getAppSettings();
  if (!settings.modules.referrals) {
    return { creditedCount: 0, totalBonus: 0 };
  }

  const commissionLevels = settings.referralCommissionLevels || [5, 3, 2, 1, 0.5];
  const investor = getUserById(investorId);
  if (!investor || !investor.referredBy) {
    return { creditedCount: 0, totalBonus: 0 };
  }

  let currentUplineId: string | undefined = investor.referredBy;
  let creditedCount = 0;
  let totalBonus = 0;
  const now = new Date();

  // Traverse upline up to commissionLevels.length levels
  for (let level = 0; level < commissionLevels.length; level++) {
    if (!currentUplineId) break;

    const upline: User | undefined = getUserById(currentUplineId) || getUsers().find(u =>
      u.username?.toLowerCase() === currentUplineId?.toLowerCase() ||
      getReferralCode(u).toLowerCase() === currentUplineId?.toLowerCase()
    );

    if (!upline || upline.id === investorId) break;

    const rate = commissionLevels[level] / 100;
    const commission = investmentAmount * rate;

    if (commission > 0) {
      updateUserProfile(upline.id, {
        balance: upline.balance + commission,
        refBonus: (upline.refBonus || 0) + commission,
      });

      createTransaction({
        userId: upline.id,
        type: 'credit',
        amount: commission,
        narration: `Tier ${level + 1} Referral Commission from ${investor.fullName}`,
        senderInfo: 'Vestexa Affiliate Desk',
        date: now.toISOString().split('T')[0],
        time: now.toTimeString().slice(0, 5),
        category: 'Bonus',
        status: 'completed',
      }, { skipBalanceUpdate: true });

      createNotification({
        userId: upline.id,
        title: `Tier ${level + 1} Referral Commission!`,
        message: `You earned $${commission.toFixed(2)} (${commissionLevels[level]}%) from an investment made by ${investor.fullName}.`,
        type: 'success',
      });

      creditedCount++;
      totalBonus += commission;
    }

    // Move to next tier upline
    currentUplineId = upline.referredBy;
  }

  return { creditedCount, totalBonus };
}

/**
 * Retrieves downline tree and stats for a user
 */
export function getReferralNetwork(userId: string): {
  directReferrals: User[];
  totalDirect: number;
  totalEarned: number;
} {
  const user = getUserById(userId);
  if (!user) return { directReferrals: [], totalDirect: 0, totalEarned: 0 };

  const code = getReferralCode(user).toLowerCase();
  const directReferrals = getUsers().filter(
    u => u.referredBy?.toLowerCase() === userId.toLowerCase() ||
         u.referredBy?.toLowerCase() === code ||
         (user.username && u.referredBy?.toLowerCase() === user.username.toLowerCase())
  );

  return {
    directReferrals,
    totalDirect: directReferrals.length,
    totalEarned: user.refBonus || 0,
  };
}
