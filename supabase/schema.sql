-- ═══════════════════════════════════════════════════════════════════════════
-- VESTEXA FINANCIAL — COMPLETE SUPABASE DATABASE SCHEMA & SEED SCRIPT
-- Paste and Run in Supabase Dashboard -> SQL Editor
-- ═══════════════════════════════════════════════════════════════════════════

-- 1. Create Users Table
CREATE TABLE IF NOT EXISTS public.users (
  id TEXT PRIMARY KEY,
  email TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL,
  full_name TEXT NOT NULL,
  username TEXT,
  account_number TEXT,
  balance NUMERIC(15, 2) NOT NULL DEFAULT 0.00,
  invested_amount NUMERIC(15, 2) DEFAULT 0.00,
  amount_spent NUMERIC(15, 2) DEFAULT 0.00,
  roi NUMERIC(15, 2) DEFAULT 0.00,
  bonus NUMERIC(15, 2) DEFAULT 0.00,
  ref_bonus NUMERIC(15, 2) DEFAULT 0.00,
  signup_bonus_received BOOLEAN DEFAULT FALSE,
  pin TEXT DEFAULT '1234',
  pinstatus INTEGER DEFAULT 1,
  status TEXT DEFAULT 'active',
  kyc_status TEXT DEFAULT 'unverified',
  two_factor_enabled BOOLEAN DEFAULT FALSE,
  is_restricted BOOLEAN DEFAULT FALSE,
  restriction_header TEXT,
  restriction_reason TEXT,
  restricted_at TIMESTAMPTZ,
  restricted_by TEXT,
  restriction_ref TEXT,
  card_number TEXT,
  card_holder_name TEXT,
  card_last4 TEXT DEFAULT '4092',
  card_exp TEXT DEFAULT '12/27',
  address TEXT,
  phone_number TEXT,
  country TEXT DEFAULT 'United States',
  currency TEXT DEFAULT 'USD',
  account_type TEXT DEFAULT 'Private Wealth Tier 1',
  btc_address TEXT,
  eth_address TEXT,
  usdt_address TEXT,
  ssn TEXT,
  id_type TEXT DEFAULT 'drivers_license',
  avatar_url TEXT,
  id_document_url TEXT,
  id_document_back_url TEXT,
  quick_transfer_contacts JSONB DEFAULT '[]'::jsonb,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 2. Create Admins Table
CREATE TABLE IF NOT EXISTS public.admins (
  id TEXT PRIMARY KEY,
  email TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL,
  full_name TEXT NOT NULL,
  role TEXT DEFAULT 'admin',
  is_super_admin BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 3. Create Transactions Table
CREATE TABLE IF NOT EXISTS public.transactions (
  id TEXT PRIMARY KEY,
  user_id TEXT REFERENCES public.users(id) ON DELETE CASCADE,
  type TEXT NOT NULL,
  amount NUMERIC(15, 2) NOT NULL,
  narration TEXT NOT NULL,
  sender_info TEXT NOT NULL,
  date TEXT NOT NULL,
  time TEXT NOT NULL,
  category TEXT NOT NULL,
  status TEXT NOT NULL DEFAULT 'completed',
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 4. Create Investment Plans Table
CREATE TABLE IF NOT EXISTS public.investment_plans (
  id TEXT PRIMARY KEY,
  name TEXT NOT NULL,
  min_amount NUMERIC(15, 2) NOT NULL,
  max_amount NUMERIC(15, 2) NOT NULL,
  roi_percentage NUMERIC(8, 2) NOT NULL,
  roi_interval TEXT NOT NULL,
  duration_days INTEGER NOT NULL,
  type TEXT NOT NULL DEFAULT 'main',
  is_active BOOLEAN DEFAULT TRUE,
  return_capital BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 5. Create User Investments Table
CREATE TABLE IF NOT EXISTS public.user_investments (
  id TEXT PRIMARY KEY,
  user_id TEXT REFERENCES public.users(id) ON DELETE CASCADE,
  plan_id TEXT,
  plan_name TEXT,
  amount NUMERIC(15, 2) NOT NULL,
  roi_percentage NUMERIC(8, 2) NOT NULL,
  roi_interval TEXT NOT NULL,
  status TEXT NOT NULL DEFAULT 'active',
  activated_at TIMESTAMPTZ,
  expires_at TIMESTAMPTZ,
  last_roi_at TIMESTAMPTZ,
  total_earned NUMERIC(15, 2) DEFAULT 0.00,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 6. Create Withdrawals Table
CREATE TABLE IF NOT EXISTS public.withdrawals (
  id TEXT PRIMARY KEY,
  user_id TEXT REFERENCES public.users(id) ON DELETE CASCADE,
  amount NUMERIC(15, 2) NOT NULL,
  method TEXT NOT NULL,
  status TEXT NOT NULL DEFAULT 'pending',
  details TEXT,
  txn_id TEXT NOT NULL,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 7. Create Loans Table
CREATE TABLE IF NOT EXISTS public.loans (
  id TEXT PRIMARY KEY,
  user_id TEXT REFERENCES public.users(id) ON DELETE CASCADE,
  amount NUMERIC(15, 2) NOT NULL,
  purpose TEXT NOT NULL,
  duration TEXT NOT NULL,
  status TEXT NOT NULL DEFAULT 'pending',
  interest_rate NUMERIC(5, 2),
  approved_at TIMESTAMPTZ,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 8. Create Beneficiaries Table
CREATE TABLE IF NOT EXISTS public.beneficiaries (
  id TEXT PRIMARY KEY,
  user_id TEXT REFERENCES public.users(id) ON DELETE CASCADE,
  name TEXT NOT NULL,
  bank_name TEXT NOT NULL,
  account_number TEXT NOT NULL,
  routing_number TEXT,
  swift_code TEXT,
  is_favorite BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 9. Create Notifications Table
CREATE TABLE IF NOT EXISTS public.notifications (
  id TEXT PRIMARY KEY,
  user_id TEXT NOT NULL,
  title TEXT NOT NULL,
  message TEXT NOT NULL,
  type TEXT NOT NULL DEFAULT 'info',
  is_read BOOLEAN DEFAULT FALSE,
  link TEXT,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 10. Create App Settings Table
CREATE TABLE IF NOT EXISTS public.app_settings (
  id TEXT PRIMARY KEY DEFAULT 'default',
  settings JSONB NOT NULL,
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- ═══════════════════════════════════════════════════════════════════════════
-- ROW LEVEL SECURITY (RLS) POLICIES — Enable open read/write for demo platform
-- ═══════════════════════════════════════════════════════════════════════════

ALTER TABLE public.users ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.admins ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.transactions ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.investment_plans ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.user_investments ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.withdrawals ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.loans ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.beneficiaries ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.notifications ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.app_settings ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Allow public full access to users" ON public.users FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to admins" ON public.admins FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to transactions" ON public.transactions FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to investment_plans" ON public.investment_plans FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to user_investments" ON public.user_investments FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to withdrawals" ON public.withdrawals FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to loans" ON public.loans FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to beneficiaries" ON public.beneficiaries FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to notifications" ON public.notifications FOR ALL USING (true) WITH CHECK (true);
CREATE POLICY "Allow public full access to app_settings" ON public.app_settings FOR ALL USING (true) WITH CHECK (true);

-- ═══════════════════════════════════════════════════════════════════════════
-- REALTIME SUBSCRIPTIONS — Enable instant WebSockets for cross-browser sync
-- ═══════════════════════════════════════════════════════════════════════════

DO $$
BEGIN
  ALTER PUBLICATION supabase_realtime ADD TABLE public.users;
EXCEPTION WHEN duplicate_object THEN
  NULL;
END $$;

DO $$
BEGIN
  ALTER PUBLICATION supabase_realtime ADD TABLE public.transactions;
EXCEPTION WHEN duplicate_object THEN
  NULL;
END $$;

DO $$
BEGIN
  ALTER PUBLICATION supabase_realtime ADD TABLE public.notifications;
EXCEPTION WHEN duplicate_object THEN
  NULL;
END $$;

-- ═══════════════════════════════════════════════════════════════════════════
-- SEED INITIAL CORE USERS & DEMO ACCOUNTS
-- ═══════════════════════════════════════════════════════════════════════════

INSERT INTO public.users (
  id, email, password, full_name, username, account_number, balance,
  invested_amount, amount_spent, roi, bonus, ref_bonus, signup_bonus_received,
  pin, pinstatus, status, kyc_status, card_number, card_holder_name, card_last4, card_exp,
  address, phone_number, country, currency, account_type,
  btc_address, eth_address, usdt_address, ssn, id_type, quick_transfer_contacts
) VALUES
(
  'user-stonebridge',
  'stonebridge@vestexa.org',
  'demo1234',
  'Stonebridge Rose',
  'stonebridge',
  'VX-89210041',
  372560.00,
  58000.00,
  4500.00,
  6900.00,
  25.00,
  1250.00,
  TRUE,
  '1234',
  0,
  'active',
  'verified',
  '4532 8901 2345 4092',
  'Stonebridge Rose',
  '4092',
  '12/27',
  '742 Evergreen Terrace, Springfield, OR 97477',
  '+1 (555) 234-5678',
  'United States',
  'USD',
  'Private Wealth Tier 1',
  'bc1q9x37k74x28y5y4h03u821slkdjfs739',
  '0x71C8360f3868662967752b069d300063234582A1',
  'TXv97qj49fK4ZpT78Lkm5Y1p8B6sR7o58e',
  '334-92-6789',
  'drivers_license',
  '[{"id":"contact-sarah","name":"Sarah","initials":"SR","avatarBg":"bg-rose-500/20 text-rose-400"},{"id":"contact-alex","name":"Alex","initials":"AM","avatarBg":"bg-emerald-500/20 text-emerald-400"}]'::jsonb
)
ON CONFLICT (id) DO NOTHING;

INSERT INTO public.users (
  id, email, password, full_name, username, account_number, balance,
  invested_amount, amount_spent, roi, bonus, ref_bonus, signup_bonus_received,
  pin, pinstatus, status, kyc_status, card_number, card_holder_name, card_last4, card_exp,
  address, phone_number, country, currency, account_type,
  btc_address, eth_address, usdt_address, ssn, id_type, quick_transfer_contacts
) VALUES
(
  'user-bill',
  'billodgedn@rockmail.com',
  'Ogden_29',
  'Bill Ogden',
  'billogden',
  'VX-10293847',
  739565.21,
  115000.00,
  8900.00,
  11250.00,
  25.00,
  4500.00,
  TRUE,
  '1392',
  0,
  'active',
  'verified',
  '5412 7522 9018 0877',
  'Bill Ogden',
  '0877',
  '01/27',
  '100 Wall Street, Suite 1400, New York, NY 10005',
  '+1 (555) 876-5432',
  'United States',
  'USD',
  'Corporate Institutional Wealth',
  'bc1q67z9m40x67a9a4e03i999alkdfps928',
  '0x89C9281f3868662967752b069d300063234512B4',
  'TYv88qj49fK4ZpT78Lkm5Y1p8B6sR7o11z',
  '418-05-1234',
  'passport',
  '[{"id":"contact-ogden","name":"Ogden Corp","initials":"OC","avatarBg":"bg-blue-500/20 text-blue-400"},{"id":"contact-robert","name":"Robert","initials":"RM","avatarBg":"bg-purple-500/20 text-purple-400"}]'::jsonb
)
ON CONFLICT (id) DO NOTHING;

-- Seed Admin
INSERT INTO public.admins (id, email, password, full_name, role, is_super_admin)
VALUES ('admin-system', 'admin@vestexa.org', 'admin1234', 'System Admin (Super Admin)', 'super_admin', TRUE)
ON CONFLICT (id) DO NOTHING;

-- Seed Base Investment Plans
INSERT INTO public.investment_plans (id, name, min_amount, max_amount, roi_percentage, roi_interval, duration_days, type, is_active, return_capital)
VALUES
('plan-1', 'Starter Yield Tier', 500, 4999, 2.5, 'daily', 30, 'main', TRUE, TRUE),
('plan-2', 'Balanced Growth Matrix', 5000, 24999, 4.2, 'daily', 60, 'main', TRUE, TRUE),
('plan-3', 'Institutional Alpha Desk', 25000, 250000, 7.8, 'weekly', 90, 'main', TRUE, TRUE),
('plan-4', 'Venture High-Yield Sprint (Promo)', 1000, 15000, 12.0, 'weekly', 21, 'promo', TRUE, TRUE),
('plan-5', 'Crypto Staking & Liquidity Pool', 2500, 100000, 1.8, 'daily', 45, 'main', TRUE, TRUE)
ON CONFLICT (id) DO NOTHING;
