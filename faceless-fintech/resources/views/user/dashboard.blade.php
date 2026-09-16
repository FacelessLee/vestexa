@extends('layouts.dash2')

@php
    $financeUser = (object)[
        'name' => Auth::user()->name,
        'avatarUrl' => !empty(Auth::user()->profile_photo_path) 
            ? $settings->site_address . '/storage/app/public/photos/' . Auth::user()->profile_photo_path 
            : '/placeholder.svg?width=40&height=40',
    ];
    $walletBalance = (object)[
        'amount_raw' => Auth::user()->account_bal,
        'currency' => Auth::user()->s_curr,
        'cardLastFour' => substr(Auth::user()->usernumber, -4) ?? '1289',
        'expiry' => '05/24',
        'card_type_logo_url' => '/placeholder.svg?width=60&height=40'
    ];
    $recentTransactions = collect()
        ->merge($withdrawals ?? collect())
        ->merge($deposits ?? collect())
        ->sortByDesc('created_at')
        ->take(5)
        ->map(function ($item) {
            $isCredit = isset($item->type) 
                ? $item->type == 'Credit' 
                : (isset($item->transaction_type) ? $item->transaction_type == 'deposit' : true);
            return (object)[
                'id' => $item->id . ($item->txn_id ?? ''),
                'type' => $isCredit ? 'credit' : 'debit',
                'icon_fa' => $isCredit ? 'fa-solid fa-arrow-down-left' : 'fa-solid fa-arrow-up-right',
                'name' => $item->description 
                    ?? ($item->payment_method ?? ($item->type ?? 'Transaction')),
                'date' => \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i'),
                'amount_formatted' => ($isCredit ? '+' : '-') 
                    . Auth::user()->s_curr 
                    . number_format($item->amount, 2, '.', ','),
                'color_class' => $isCredit ? 'text-green-positive' : 'text-red-negative',
                'bg_class' => $isCredit ? 'bg-green-positive/10' : 'bg-red-negative/10',
            ];
        });
    $activityChartLabels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"];
    $activityChartData = [1200, 1900, 1500, 2200, 1800, 2500, 2000];
    $mobileBalanceRaw = $walletBalance->amount_raw;
@endphp

@section('title', $title)

@section('content')
<div x-data="{ 
    showBankAccount: false, 
    showSendMoney: false,
    showReceiveModal: false,
    showMobileMenu: false,
    showMobileNotifications: false,
    greeting: '',
    currentDate: '',
    balanceVisible: true,
    toggleBalance() {
        this.balanceVisible = !this.balanceVisible;
        localStorage.setItem('balanceVisible', this.balanceVisible);
    },
    updateTime() {
        const now = new Date();
        if (now.getHours() < 12) { this.greeting = 'Good Morning'; } 
        else if (now.getHours() < 18) { this.greeting = 'Good Afternoon'; } 
        else { this.greeting = 'Good Evening'; }
        const options = { weekday: 'long', month: 'long', day: 'numeric' };
        this.currentDate = now.toLocaleDateString(undefined, options);
    }
}" x-init="
    updateTime();
    setInterval(() => updateTime(), 60000);
    balanceVisible = localStorage.getItem('balanceVisible') === null 
        ? true 
        : localStorage.getItem('balanceVisible') === 'true';
">
    <x-danger-alert />
    <x-success-alert />

    {{-- Include Mobile View --}}
    @include('partials.dashboard.mobile_view', [
        'financeUser' => $financeUser,
        'walletBalance' => $walletBalance,
        'recentTransactions' => $recentTransactions,
        'quickTransferContacts' => $quickTransferContacts,
        'monthly_deposits' => $monthly_deposits ?? 0,
        'monthly_expenses' => $monthly_expenses ?? 0,
        'cards' => $cards ?? collect(),
        'settings' => $settings,
        'btc_rate' => $btc_rate ?? 0,
    ])

    {{-- Include Desktop Left Section --}}
    @include('partials.dashboard.desktop_left', [
        'monthly_deposits' => $monthly_deposits ?? 0,
        'monthly_expenses' => $monthly_expenses ?? 0,
        'total_volume' => $total_volume ?? 0,
        'cards' => $cards ?? collect(),
        'settings' => $settings,
        'walletBalance' => $walletBalance,
        'btc_rate' => $btc_rate ?? 0,
    ])

    {{-- Include Desktop Right Section --}}
    @include('partials.dashboard.desktop_right', [
        'recentTransactions' => $recentTransactions,
        'settings' => $settings,
        'total_deposited_pending' => $total_deposited_pending ?? 0,
        'total_withdrawal_pending' => $total_withdrawal_pending ?? 0,
        'total_withdrawal' => $total_withdrawal ?? 0,
        'deposited' => $deposited ?? 0,
        'limit' => Auth::user()->limit,
        'currency_symbol' => Auth::user()->s_curr,
    ])

    {{-- Modals --}}
    @include('partials._bank_account_modal', ['settings' => $settings, 'user' => Auth::user()])
    @include('partials._send_money_modal')
    @include('partials._receive_btc_modal', ['btc_address' => Auth::user()->btc_address])
</div>

<script>
function dashboardQuickTransfer() {
    return {
        beneficiaries: [],
        loading: false,

        async loadBeneficiaries() {
            this.loading = true;
            try {
                const response = await fetch('/dashboard/beneficiaries/get?favorites=true&limit=10', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();
                if (data.success) {
                    this.beneficiaries = data.beneficiaries;
                }
            } catch (error) {
                console.error('Error loading beneficiaries:', error);
            } finally {
                this.loading = false;
            }
        },

        async selectBeneficiary(beneficiary) {
            try {
                // Increment usage count
                await fetch(`/dashboard/beneficiaries/${beneficiary.id}/data`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                });

                // Redirect to appropriate transfer page based on beneficiary type
                if (beneficiary.type === 'local') {
                    window.location.href = `/dashboard/localtransfer?beneficiary=${beneficiary.id}`;
                } else if (beneficiary.type === 'international') {
                    const method = beneficiary.method_type ? `&method=${encodeURIComponent(beneficiary.method_type)}` : '';
                    window.location.href = `/dashboard/internationaltransfer?beneficiary=${beneficiary.id}${method}`;
                }
            } catch (error) {
                console.error('Error selecting beneficiary:', error);
                // Fallback: just redirect to transfer page
                if (beneficiary.type === 'local') {
                    window.location.href = '/dashboard/localtransfer';
                } else {
                    window.location.href = '/dashboard/internationaltransfer';
                }
            }
        }
    }
}
</script>
@endsection