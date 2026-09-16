@extends('emails.email-template')

@section('title', 'New Investment Return')
@section('subtitle', 'Your investment has generated returns')
@section('company_name', $settings->site_name)

@section('greeting', 'Hello ' . $user->name)

@section('content')
<p>This is a notification of a new return on investment (ROI) on your investment account.</p>
@endsection

@section('additional_content')
<div class="transaction-details">
    <div class="transaction-details-header">ROI Details</div>
    <div class="transaction-details-body">
        <div class="transaction-details-row">
            <div class="transaction-details-label">Plan:</div>
            <div class="transaction-details-value">{{ $plan }}</div>
        </div>
        <div class="transaction-details-row">
            <div class="transaction-details-label">Amount:</div>
            <div class="transaction-details-value">{{ $settings->currency }}{{ $amount }}</div>
        </div>
        <div class="transaction-details-row">
            <div class="transaction-details-label">Date:</div>
            <div class="transaction-details-value">{{ $plandate }}</div>
        </div>
    </div>
</div>

<div class="success-box">
    <p><strong>Success!</strong> This amount has been added to your account balance.</p>
</div>
@endsection

@section('help_text')
<p>You can log in to your account to view your updated balance and transaction history.</p>
@endsection
