@extends('emails.email-template')

@section('title', 'Welcome to ' . $settings->site_name)
@section('subtitle', 'Your Financial Journey Begins Today')
@section('company_name', $settings->site_name)

@section('greeting', 'Welcome, ' . $user->name . ' ' . $user->middlename . ' ' . $user->lastname)

@section('content')
<div style="text-align: center; margin-bottom: 30px;">
    <div style="font-size: 24px; font-weight: 700; color: #4F46E5; margin-bottom: 15px;">Your Account Is Ready</div>
    <p style="font-size: 16px;">We're thrilled to have you join our community of valued customers.</p>
</div>

<div style="background: #EFF6FF; border-radius: 12px; padding: 25px; margin-bottom: 30px;">
    <p style="margin-top: 0;">Thank you for choosing {{ $settings->site_name }} as your trusted financial partner. We are committed to providing exceptional service and innovative banking solutions tailored to your unique financial needs.</p>
    
    <p>Your journey toward financial success begins now, and we're here to support you every step of the way.</p>
</div>
@endsection

@section('additional_content')
<div style="border-left: 4px solid #4F46E5; padding-left: 15px; margin: 30px 0;">
    <h3 style="margin-top: 0; color: #4F46E5; font-size: 18px;">What's Next?</h3>
    <ul style="padding-left: 20px; margin-top: 10px;">
        <li style="margin-bottom: 8px;">Set up account alerts</li>
        <li style="margin-bottom: 8px;">Explore our investment opportunities</li>
        <li style="margin-bottom: 8px;">Schedule a consultation with a financial advisor</li>
    </ul>
</div>

<div class="transaction-details" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 30px;">
    <div class="transaction-details-header" style="background: linear-gradient(90deg, #4F46E5 0%, #6366F1 100%); color: white; padding: 15px; font-size: 16px; font-weight: 600; text-align: center;">
        Your Account Details
    </div>
    <div class="transaction-details-body" style="padding: 20px; background-color: #FAFAFA;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="border-bottom: 1px solid #E5E7EB;">
                <td style="padding: 10px 0; color: #6B7280; width: 40%;">Account Name:</td>
                <td style="padding: 10px 0; font-weight: 500;">{{ $user->name }} {{ $user->middlename }} {{ $user->lastname }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #E5E7EB;">
                <td style="padding: 10px 0; color: #6B7280; width: 40%;">Account Number:</td>
                <td style="padding: 10px 0; font-weight: 700; color: #4F46E5;">{{ $user->usernumber }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #E5E7EB;">
                <td style="padding: 10px 0; color: #6B7280; width: 40%;">Account Type:</td>
                <td style="padding: 10px 0;">{{ $user->accounttype }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #E5E7EB;">
                <td style="padding: 10px 0; color: #6B7280; width: 40%;">Country:</td>
                <td style="padding: 10px 0;">{{ $user->country }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; color: #6B7280; width: 40%;">Created Date:</td>
                <td style="padding: 10px 0;">{{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString() }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="transaction-details" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 30px;">
    <div class="transaction-details-header" style="background: linear-gradient(90deg, #4F46E5 0%, #6366F1 100%); color: white; padding: 15px; font-size: 16px; font-weight: 600; text-align: center;">
        Online Banking Access
    </div>
    <div class="transaction-details-body" style="padding: 20px; background-color: #FAFAFA;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="border-bottom: 1px solid #E5E7EB;">
                <td style="padding: 10px 0; color: #6B7280; width: 40%;">Email:</td>
                <td style="padding: 10px 0;">{{ $user->email }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; color: #6B7280; width: 40%;">Password:</td>
                <td style="padding: 10px 0;">Your chosen password</td>
            </tr>
        </table>
        
    </div>
</div>

<div style="margin-top: 30px; text-align: center;">
    <a href="{{ url('/login') }}" class="btn" style="display: inline-block; background: linear-gradient(90deg, #4F46E5 0%, #6366F1 100%); color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: 600; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">Access Your Account Now</a>
</div>

<div style="margin-top: 40px; background: #FFFBEB; border-left: 4px solid #F59E0B; border-radius: 8px;">
    <div style="padding: 20px;">
        <h3 style="margin-top: 0; color: #B45309; font-size: 16px;">Personalized Support</h3>
        <p style="margin-bottom: 0;">For detailed information about our products or services, please visit our website or contact our dedicated support team at <a href="mailto:{{ $settings->contact_email }}" style="color: #4F46E5; font-weight: 600; text-decoration: none;">{{ $settings->contact_email }}</a>.</p>
    </div>
</div>
@endsection

@section('help_text')
<div style="padding: 20px; background-color: #F9FAFB; border-radius: 8px; margin-top: 40px;">
    <h3 style="margin-top: 0; color: #4B5563; font-size: 16px;">Our Commitment to You</h3>
    <p>{{ $settings->site_name }} is a full-service financial institution with a focus on our community. Our decisions are made locally with your best interests in mind, and we're dedicated to helping you achieve your financial goals.</p>
    
    <div style="margin-top: 20px; text-align: center; padding-top: 20px; border-top: 1px solid #E5E7EB;">
        <p style="color: #4F46E5; font-weight: 600; font-size: 18px;">Thank you for banking with us!</p>
        <p style="margin-bottom: 0;">The {{ $settings->site_name }} Team</p>
    </div>
</div>
@endsection

@section('footer')
© {{ date('Y') }} {{ $settings->site_name }} | All Rights Reserved | Secure Banking Solutions
@endsection