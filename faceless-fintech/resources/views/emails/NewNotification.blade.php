@extends('emails.email-template')

@section('title', isset($subject) ? $subject : 'New Notification')
@section('subtitle', 'Important information about your account')
@section('company_name', config('app.name'))

@section('greeting', ($salutaion ? $salutaion : "Hello") . ' ' . $recipient)

@section('content')
@if ($attachment != null)
    <img src="{{ $message->embed(asset('storage/'. $attachment)) }}" style="max-width: 100%; height: auto; margin-bottom: 20px;">
@endif

{!! $body !!}
@endsection

@section('footer')
If you have any questions, please contact our support team.
@endsection
