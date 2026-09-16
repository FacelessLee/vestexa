@extends('emails.email-template')

@section('title', 'Investment Plan Completed')
@section('subtitle', 'Your investment cycle has concluded')
@section('company_name', $demo->sender)

@section('greeting', 'Hello ' . $demo->receiver_name)

@section('content')
<p>This is to notify you that your investment plan ({{ $demo->receiver_plan }} plan) has expired and your capital for this plan has been added to your account for withdrawal.</p>
@endsection

@section('additional_content')
<div class="transaction-details">
    <div class="transaction-details-header">Investment Summary</div>
    <div class="transaction-details-body">
        <div class="transaction-details-row">
            <div class="transaction-details-label">Plan:</div>
            <div class="transaction-details-value">{{ $demo->receiver_plan }}</div>
        </div>
        <div class="transaction-details-row">
            <div class="transaction-details-label">Amount:</div>
            <div class="transaction-details-value">{{ $demo->received_amount }}</div>
        </div>
        <div class="transaction-details-row">
            <div class="transaction-details-label">Completion Date:</div>
            <div class="transaction-details-value">{{ $demo->date }}</div>
        </div>
    </div>
</div>

<div class="success-box">
    <p><strong>Success!</strong> Your funds are now available in your account balance and ready for withdrawal or reinvestment.</p>
</div>
@endsection

@section('help_text')
<p>If you want to reinvest or have any questions about your completed investment, please contact our investment advisors for assistance.</p>
@endsection

@section('footer')
If you have any questions, please contact <span class="highlight">support@{{ strtolower(str_replace(' ', '', $demo->sender)) }}.com</span>
@endsection
