@extends('emails.email-template')

@section('title', '2FA Authentication Code')
@section('subtitle', 'Security verification for your account')
@section('company_name', $demo->sender)

@section('greeting', 'Hello,')

@section('content')
<p>A temporary 2FA (Two-Factor Authentication) code has been requested for your account. Use this code to complete your authentication process.</p>
@endsection

@section('additional_content')
<div class="highlight-box">
    <p>Your authentication code is:</p>
    <div class="code">{{ $demo->message }}</div>
</div>

<div class="notice-box">
    <strong>Important:</strong> This code will expire in 15 minutes. If you didn't request this code, please secure your account immediately.
</div>
@endsection

@section('help_text')
<p>If you didn't request this code, someone may be trying to access your account. Please change your password immediately and contact our support team.</p>
@endsection

@section('footer')
If you have any questions, please contact <span class="highlight">support@{{ strtolower(str_replace(' ', '', $demo->sender)) }}.com</span>
@endsection
