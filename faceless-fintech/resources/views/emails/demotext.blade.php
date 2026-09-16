@extends('emails.email-template')

@section('title', 'Welcome to ' . $demo->sender)
@section('subtitle', 'Your registration is complete')
@section('company_name', $demo->sender)

@section('greeting', 'Hello')

@section('content')
<p>Your registration is successful and we are really excited to welcome you to {{ $demo->sender }} community!</p>
@endsection

@section('additional_content')
<div class="info-box">
    <p>Your system generated password: <strong>{{ $demo->password }}</strong></p>
    <p>Please change this password to your preferred one when you first log in.</p>
</div>
@endsection

@section('help_text')
<p>If you need any help, do not hesitate to reach out to us at <a href="mailto:{{ $demo->contact_email }}" style="color: #4F46E5; text-decoration: none;">{{ $demo->contact_email }}</a>.</p>
@endsection

@section('footer')
{{ $demo->sender }}
@endsection

