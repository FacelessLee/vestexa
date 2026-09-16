@extends('emails.email-template')

@section('title', 'Deposit Notification')
@section('subtitle', $deposit->status == 'Processed' ? 'Your deposit has been processed' : 'Your deposit is being processed')
@section('company_name', config('app.name'))

@section('greeting', 'Hello ' . ($foramin ? 'Admin' : $user->name))

@section('content')
@if ($foramin)
    <p>This is to inform you of a successful deposit of {{ $settings->currency . $deposit->amount }} from {{ $user->name }}. {{ $deposit->status == "Processed" ? '' : ' Please login to process it.' }}</p>
@else
    @if ($deposit->status == 'Processed')
        <p>This is to inform you that your deposit of {{ $settings->currency . $deposit->amount }} has been received and confirmed. Your account balance has been credited with the specified amount.</p>
    @else
        <p>Your Crypto Asset Deposit has been recorded successfully and is currently undergoing confirmation. You will receive an automatic notification once your transaction is confirmed on the blockchain network. This usually takes up to 15 minutes.</p>
    @endif
@endif
@endsection

@section('additional_content')
@if (!$foramin && $deposit->status != 'Processed')
    <div class="transaction-details">
        <div class="transaction-details-header">Deposit Details</div>
        <div class="transaction-details-body">
            <div class="transaction-details-row">
                <div class="transaction-details-label">Amount:</div>
                <div class="transaction-details-value">{{ $settings->currency . $deposit->amount }}</div>
            </div>
            <div class="transaction-details-row">
                <div class="transaction-details-label">Date:</div>
                <div class="transaction-details-value">{{ \Carbon\Carbon::parse($deposit->created_at)->toDayDateTimeString() }}</div>
            </div>
            <div class="transaction-details-row">
                <div class="transaction-details-label">Status:</div>
                <div class="transaction-details-value">Pending Confirmation</div>
            </div>
        </div>
    </div>

    <div class="info-box">
        <p><strong>Note:</strong> Please wait while your transaction is being confirmed on the blockchain. This process is automatic and requires no further action from you.</p>
    </div>
@endif

@if (!$foramin && $deposit->status == 'Processed')
    <div class="success-box">
        <p><strong>Success!</strong> Your deposit has been confirmed and your account has been credited.</p>
    </div>
@endif
@endsection

@section('help_text')
<p>If you have any questions about this transaction, please contact our support team for assistance.</p>
@endsection
