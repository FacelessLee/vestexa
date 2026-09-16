@extends('emails.email-template')

@section('title', 'Withdrawal Approved')
@section('subtitle', 'Your withdrawal request has been processed')
@section('company_name', $settings->site_name)

@section('greeting', 'Hello ' . $user->name . ' ' . $user->l_name)

@section('content')
<p>This is to inform you that your withdrawal request has been approved and processed successfully.</p>
@endsection

@section('additional_content')
<div class="transaction-details">
    <div class="transaction-details-header">Withdrawal Details</div>
    <div class="transaction-details-body">
        <div class="transaction-details-row">
            <div class="transaction-details-label">Amount:</div>
            <div class="transaction-details-value">{{ $settings->currency }}{{ number_format($deposit->amount) }}</div>
        </div>
        <div class="transaction-details-row">
            <div class="transaction-details-label">Payment Method:</div>
            <div class="transaction-details-value">{{ $deposit->payment_mode }}</div>
        </div>
        <div class="transaction-details-row">
            <div class="transaction-details-label">Date:</div>
            <div class="transaction-details-value">{{ \Carbon\Carbon::parse($deposit->created_at)->toDayDateTimeString() }}</div>
        </div>
        <div class="transaction-details-row">
            <div class="transaction-details-label">Status:</div>
            <div class="transaction-details-value">Processed</div>
        </div>
    </div>
</div>

<div class="success-message">
    <p>The funds have been sent to your designated payment method. Please allow some time for the funds to reflect in your account depending on your payment provider's processing time.</p>
</div>
@endsection

@section('help_text')
<p>If you have any questions about this transaction or if you did not receive your funds within the expected timeframe, please contact our support team at <a href="mailto:{{ $settings->contact_email }}" style="color: #4F46E5; text-decoration: none;">{{ $settings->contact_email }}</a>.</p>
@endsection

@section('footer')
{{ $settings->site_name }} - {{ $settings->description }}
@endsection 