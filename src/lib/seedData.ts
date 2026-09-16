// Pre-seed demo accounts and banking/investment entities on first load
import {
  isSeeded,
  markSeeded,
  createUserWithId,
  createAdmin,
  getTransactions,
  getInvestmentPlans,
  createInvestmentPlan,
  getUserInvestments,
  createUserInvestment,
  getBeneficiaries,
  createBeneficiary,
  getNotifications,
  createNotification,
  getLoans,
  createLoan,
  getWithdrawals,
  createWithdrawal,
  getAppSettings,
  updateAppSettings,
} from './storage';

export function seedDemoData(): void {
  // Always ensure base plans exist even if users were already seeded
  seedInvestmentPlansIfEmpty();
  seedSettingsIfEmpty();

  if (isSeeded()) return;

  // Preserve any existing transactions in localStorage so admin inputs are never lost
  const existingTxns = getTransactions();

  // ─── Demo Users ───

  const stonebridge = createUserWithId({
    id: 'user-stonebridge',
    email: 'stonebridge@vestexa.com',
    password: 'demo1234',
    fullName: 'Stonebridge Rose',
    username: 'stonebridge',
    accountNumber: 'VX-89210041',
    balance: 372560.00,
    investedAmount: 58000.00,
    amountSpent: 4500.00,
    roi: 6900.00,
    bonus: 25.00,
    refBonus: 1250.00,
    signupBonusReceived: true,
    cardNumber: '4532 8901 2345 4092',
    cardHolderName: 'Stonebridge Rose',
    cardLast4: '4092',
    cardExp: '12/27',
    address: '742 Evergreen Terrace, Springfield, OR 97477',
    phoneNumber: '+1 (555) 234-5678',
    country: 'United States',
    currency: 'USD',
    accountType: 'Private Wealth Tier 1',
    pin: '1234',
    status: 'active',
    kycStatus: 'verified',
    twoFactorEnabled: false,
    btcAddress: 'bc1q9x37k74x28y5y4h03u821slkdjfs739',
    ethAddress: '0x71C8360f3868662967752b069d300063234582A1',
    usdtAddress: 'TXv97qj49fK4ZpT78Lkm5Y1p8B6sR7o58e',
    ssn: '334-92-6789',
    idType: 'drivers_license',
    quickTransferContacts: [
      { id: 'contact-sarah', name: 'Sarah', initials: 'SR', avatarBg: 'bg-rose-500/20 text-rose-400' },
      { id: 'contact-alex', name: 'Alex', initials: 'AM', avatarBg: 'bg-emerald-500/20 text-emerald-400' },
    ],
  });

  const bill = createUserWithId({
    id: 'user-bill',
    email: 'bill.og@vestexa.org',
    password: 'demo1234',
    fullName: 'Bill Ogden',
    username: 'billogden',
    accountNumber: 'VX-10293847',
    balance: 739565.21,
    investedAmount: 115000.00,
    amountSpent: 8900.00,
    roi: 11250.00,
    bonus: 25.00,
    refBonus: 4500.00,
    signupBonusReceived: true,
    cardNumber: '5412 7522 9018 0877',
    cardHolderName: 'Bill Ogden',
    cardLast4: '0877',
    cardExp: '01/27',
    address: '100 Wall Street, Suite 1400, New York, NY 10005',
    phoneNumber: '+1 (555) 876-5432',
    country: 'United States',
    currency: 'USD',
    accountType: 'Corporate Institutional Wealth',
    pin: '4321',
    status: 'active',
    kycStatus: 'verified',
    twoFactorEnabled: true,
    btcAddress: 'bc1q67z9m40x67a9a4e03i999alkdfps928',
    ethAddress: '0x89C9281f3868662967752b069d300063234512B4',
    usdtAddress: 'TYv88qj49fK4ZpT78Lkm5Y1p8B6sR7o11z',
    ssn: '418-05-1234',
    idType: 'passport',
    quickTransferContacts: [
      { id: 'contact-ogden', name: 'Ogden Corp', initials: 'OC', avatarBg: 'bg-blue-500/20 text-blue-400' },
      { id: 'contact-robert', name: 'Robert', initials: 'RM', avatarBg: 'bg-purple-500/20 text-purple-400' },
    ],
  });

  // ─── Demo Admin ───

  createAdmin({
    email: 'admin@vestexa.com',
    password: 'admin1234',
    fullName: 'System Admin (Super Admin)',
    role: 'super_admin',
    isSuperAdmin: true,
  });

  // ─── Seed realistic transactions ───

  const now = new Date();
  const today = now.toISOString().split('T')[0];
  const yesterday = new Date(now.getTime() - 86400000).toISOString().split('T')[0];
  const twoDaysAgo = new Date(now.getTime() - 172800000).toISOString().split('T')[0];
  const threeDaysAgo = new Date(now.getTime() - 259200000).toISOString().split('T')[0];
  const fiveDaysAgo = new Date(now.getTime() - 432000000).toISOString().split('T')[0];
  const oneWeekAgo = new Date(now.getTime() - 604800000).toISOString().split('T')[0];

  const stonebridgeTxns = [
    {
      userId: stonebridge.id,
      type: 'credit' as const,
      amount: 1299.00,
      narration: 'Interest on balance',
      senderInfo: 'Vestexa Treasury',
      date: today,
      time: '14:45',
      category: 'Interest',
      status: 'completed' as const,
    },
    {
      userId: stonebridge.id,
      type: 'credit' as const,
      amount: 800.00,
      narration: 'Maintenance fee refund',
      senderInfo: 'Vestexa Operations',
      date: yesterday,
      time: '09:30',
      category: 'Deposit',
      status: 'completed' as const,
    },
    {
      userId: stonebridge.id,
      type: 'debit' as const,
      amount: 2450.00,
      narration: 'Wire transfer to Goldman Sachs',
      senderInfo: 'Stonebridge Rose',
      date: twoDaysAgo,
      time: '16:22',
      category: 'Wire Transfer',
      status: 'completed' as const,
    },
    {
      userId: stonebridge.id,
      type: 'credit' as const,
      amount: 15000.00,
      narration: 'Dividend payout — AAPL Q3',
      senderInfo: 'Apple Inc. Investor Relations',
      date: threeDaysAgo,
      time: '11:00',
      category: 'Dividend',
      status: 'completed' as const,
    },
    {
      userId: stonebridge.id,
      type: 'credit' as const,
      amount: 58000.00,
      narration: 'Portfolio rebalance settlement',
      senderInfo: 'Vestexa Investment Desk',
      date: fiveDaysAgo,
      time: '08:15',
      category: 'Investment Return',
      status: 'completed' as const,
    },
    {
      userId: stonebridge.id,
      type: 'debit' as const,
      amount: 340.00,
      narration: 'Annual premium card fee',
      senderInfo: 'Vestexa Card Services',
      date: oneWeekAgo,
      time: '00:01',
      category: 'Fee',
      status: 'completed' as const,
    },
  ];

  const billTxns = [
    {
      userId: bill.id,
      type: 'credit' as const,
      amount: 45000.00,
      narration: 'Incoming wire — Ogden Enterprises LLC',
      senderInfo: 'Chase Bank NA / Ogden Enterprises',
      date: today,
      time: '10:12',
      category: 'Wire Transfer',
      status: 'completed' as const,
    },
    {
      userId: bill.id,
      type: 'debit' as const,
      amount: 12800.00,
      narration: 'Real estate escrow deposit',
      senderInfo: 'Bill Ogden',
      date: yesterday,
      time: '14:30',
      category: 'Wire Transfer',
      status: 'completed' as const,
    },
    {
      userId: bill.id,
      type: 'credit' as const,
      amount: 3200.00,
      narration: 'Treasury yield sweep — monthly',
      senderInfo: 'Vestexa Treasury',
      date: twoDaysAgo,
      time: '06:00',
      category: 'Interest',
      status: 'completed' as const,
    },
    {
      userId: bill.id,
      type: 'credit' as const,
      amount: 89750.00,
      narration: 'Sale proceeds — MSFT 500 shares',
      senderInfo: 'Vestexa Brokerage',
      date: threeDaysAgo,
      time: '15:45',
      category: 'Investment Return',
      status: 'completed' as const,
    },
    {
      userId: bill.id,
      type: 'debit' as const,
      amount: 5600.00,
      narration: 'International wire — HSBC London',
      senderInfo: 'Bill Ogden',
      date: fiveDaysAgo,
      time: '13:20',
      category: 'Wire Transfer',
      status: 'completed' as const,
    },
  ];

  const newSeedTxns = [...stonebridgeTxns, ...billTxns].map((t, i) => ({
    ...t,
    id: `seed-${Date.now()}-${i}`,
    createdAt: new Date().toISOString(),
  }));

  const mergedTxns = existingTxns.length > 0 ? existingTxns : newSeedTxns;
  localStorage.setItem('vestexa_transactions', JSON.stringify(mergedTxns));

  // ─── Seed Beneficiaries ───
  seedBeneficiariesIfEmpty();

  // ─── Seed Sample User Investments ───
  seedUserInvestmentsIfEmpty();

  // ─── Seed Sample Notifications ───
  seedNotificationsIfEmpty();

  // ─── Seed Sample Loans ───
  seedLoansIfEmpty();

  // ─── Seed Sample Withdrawals ───
  seedWithdrawalsIfEmpty();

  markSeeded();
}

export function seedInvestmentPlansIfEmpty(): void {
  const existing = getInvestmentPlans();
  if (existing.length > 0) return;

  const defaultPlans = [
    {
      name: 'Starter Yield Tier',
      minAmount: 500,
      maxAmount: 4999,
      roiPercentage: 2.5,
      roiInterval: 'daily' as const,
      durationDays: 30,
      type: 'main' as const,
      isActive: true,
      returnCapital: true,
    },
    {
      name: 'Balanced Growth Matrix',
      minAmount: 5000,
      maxAmount: 24999,
      roiPercentage: 4.2,
      roiInterval: 'daily' as const,
      durationDays: 60,
      type: 'main' as const,
      isActive: true,
      returnCapital: true,
    },
    {
      name: 'Institutional Alpha Desk',
      minAmount: 25000,
      maxAmount: 250000,
      roiPercentage: 7.8,
      roiInterval: 'weekly' as const,
      durationDays: 90,
      type: 'main' as const,
      isActive: true,
      returnCapital: true,
    },
    {
      name: 'Venture High-Yield Sprint (Promo)',
      minAmount: 1000,
      maxAmount: 15000,
      roiPercentage: 12.0,
      roiInterval: 'weekly' as const,
      durationDays: 21,
      type: 'promo' as const,
      isActive: true,
      returnCapital: true,
    },
    {
      name: 'Crypto Staking & Liquidity Pool',
      minAmount: 2500,
      maxAmount: 100000,
      roiPercentage: 1.8,
      roiInterval: 'daily' as const,
      durationDays: 45,
      type: 'main' as const,
      isActive: true,
      returnCapital: true,
    },
  ];

  for (const p of defaultPlans) {
    createInvestmentPlan(p);
  }
}

function seedSettingsIfEmpty(): void {
  getAppSettings(); // Initializes default if missing
}

function seedBeneficiariesIfEmpty(): void {
  if (getBeneficiaries('user-stonebridge').length === 0) {
    createBeneficiary({
      userId: 'user-stonebridge',
      name: 'Sarah Jenkins',
      bankName: 'JPMorgan Chase Bank',
      accountNumber: '4820199204',
      routingNumber: '021000021',
      swiftCode: 'CHASUS33',
      isFavorite: true,
    });
    createBeneficiary({
      userId: 'user-stonebridge',
      name: 'Alex Morgan',
      bankName: 'Wells Fargo Bank, N.A.',
      accountNumber: '9182304918',
      routingNumber: '121000248',
      swiftCode: 'WFBIUS6S',
      isFavorite: false,
    });
  }

  if (getBeneficiaries('user-bill').length === 0) {
    createBeneficiary({
      userId: 'user-bill',
      name: 'Ogden Holdings Escrow LLC',
      bankName: 'Bank of America, N.A.',
      accountNumber: '8891024510',
      routingNumber: '026009593',
      swiftCode: 'BOFAUS3N',
      isFavorite: true,
    });
  }
}

function seedUserInvestmentsIfEmpty(): void {
  const existing = getUserInvestments();
  if (existing.length > 0) return;

  const plans = getInvestmentPlans();
  const balancedPlan = plans.find(p => p.name.includes('Balanced')) || plans[0];
  const alphaPlan = plans.find(p => p.name.includes('Institutional')) || plans[1] || plans[0];

  if (balancedPlan) {
    createUserInvestment({
      userId: 'user-stonebridge',
      planId: balancedPlan.id,
      planName: balancedPlan.name,
      amount: 30000,
      roiPercentage: balancedPlan.roiPercentage,
      roiInterval: balancedPlan.roiInterval,
      status: 'active',
      activatedAt: new Date(Date.now() - 5 * 86400000).toISOString(),
      lastRoiAt: new Date(Date.now() - 86400000).toISOString(),
    });
  }

  if (alphaPlan) {
    createUserInvestment({
      userId: 'user-bill',
      planId: alphaPlan.id,
      planName: alphaPlan.name,
      amount: 75000,
      roiPercentage: alphaPlan.roiPercentage,
      roiInterval: alphaPlan.roiInterval,
      status: 'active',
      activatedAt: new Date(Date.now() - 14 * 86400000).toISOString(),
      lastRoiAt: new Date(Date.now() - 3 * 86400000).toISOString(),
    });
  }
}

function seedNotificationsIfEmpty(): void {
  if (getNotifications('user-stonebridge').length === 0) {
    createNotification({
      userId: 'user-stonebridge',
      title: 'Portfolio Optimization Complete',
      message: 'Your Balanced Growth Matrix plan generated $1,260 in automated yield this week.',
      type: 'success',
    });
    createNotification({
      userId: 'user-stonebridge',
      title: 'Security Verification Verified',
      message: 'Your Level 3 KYC documents were verified by compliance desk.',
      type: 'info',
    });
  }

  if (getNotifications('user-bill').length === 0) {
    createNotification({
      userId: 'user-bill',
      title: 'Corporate Dividend Credit',
      message: 'Incoming corporate yield of $11,250 has been settled to your treasury account.',
      type: 'success',
    });
  }
}

function seedLoansIfEmpty(): void {
  if (getLoans('user-stonebridge').length === 0) {
    createLoan({
      userId: 'user-stonebridge',
      amount: 25000,
      purpose: 'Venture Capital Commercial Expansion',
      duration: '12 Months',
      status: 'approved',
      interestRate: 4.8,
    });
  }
}

function seedWithdrawalsIfEmpty(): void {
  if (getWithdrawals('user-stonebridge').length === 0) {
    createWithdrawal({
      userId: 'user-stonebridge',
      amount: 5000,
      method: 'Crypto (BTC Transfer)',
      status: 'approved',
      details: 'Recipient: bc1q9x37k74x28y5y4h03u821slkdjfs739',
      txnId: 'TXN-9812401',
    });
  }
}
