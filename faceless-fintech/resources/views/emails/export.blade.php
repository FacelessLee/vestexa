@extends('emails.email-template')

@section('title', 'Transaction Export')
@section('subtitle', 'Your requested data is ready')
@section('company_name', config('app.name'))

@section('greeting', 'Hello ' . $user->name)

@section('content')
<p>You recently requested an export of your transaction data. Your {{ $exportType }} file is attached to this email.</p>
@endsection

@section('additional_content')
<div class="info-box">
    <p><strong>Export Summary:</strong></p>
    <ul style="margin: 10px 0; padding-left: 20px;">
        <li>Format: {{ strtoupper($exportType) }}</li>
        <li>Generated: {{ now()->format('d M Y, H:i') }}</li>
        <li>Contains: Transaction history data</li>
    </ul>
</div>
@endsection

@section('help_text')
<p>If you did not request this export or have any questions, please contact our support team immediately.</p>
@endsection

@section('footer')
Thank you for choosing our services. Best regards, The Support Team.
@endsection 