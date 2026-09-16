@extends('emails.email-template')

@section('title', 'Withdrawal Status Update')
@section('subtitle', $withdrawal->status == 'Processed' ? 'Your withdrawal has been successfully completed' : 'Your withdrawal is being processed')
@section('company_name', $settings->site_name)

@section('greeting', 'Dear ' . ($foramin ? 'Administrator' : $user->name))

@section('content')
<!-- Status Section -->
<div style="text-align: center; margin-bottom: 35px;">
    @if ($withdrawal->status == 'Processed')
    <div style="width: 70px; height: 70px; border-radius: 50%; background: #3B82F6; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <h2 style="font-size: 24px; font-weight: 700; color: #1E40AF; margin: 0 0 8px 0;">Withdrawal Completed</h2>
    <p style="color: #64748B; font-size: 16px; margin: 0;">Your funds have been successfully transferred</p>
    @else
    <div style="width: 70px; height: 70px; border-radius: 50%; background: #60A5FA; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; box-shadow: 0 8px 25px rgba(96, 165, 250, 0.3);">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2V6M12 18V22M4.93 4.93L7.76 7.76M16.24 16.24L19.07 19.07M2 12H6M18 12H22M4.93 19.07L7.76 16.24M16.24 7.76L19.07 4.93" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <h2 style="font-size: 24px; font-weight: 700; color: #1E40AF; margin: 0 0 8px 0;">Processing Withdrawal</h2>
    <p style="color: #64748B; font-size: 16px; margin: 0;">Your request is being processed</p>
    @endif
</div>

<!-- Amount Display -->
<div style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%); border-radius: 12px; padding: 25px; margin: 25px 0; text-align: center; box-shadow: 0 10px 25px rgba(59, 130, 246, 0.2);">
    <div style="color: rgba(255, 255, 255, 0.8); font-size: 13px; font-weight: 500; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px;">Amount</div>
    <div style="color: white; font-size: 28px; font-weight: 700; margin-bottom: 5px;">{{$settings->currency}}{{number_format($withdrawal->amount, 2)}}</div>
    <div style="color: rgba(255, 255, 255, 0.9); font-size: 13px;">{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('M d, Y \a\t g:i A') }}</div>
</div>

@if ($foramin)
<!-- Admin Notification -->
<div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 20px; margin-bottom: 25px;">
    <div style="display: flex; align-items: center; margin-bottom: 12px;">
        <div style="width: 32px; height: 32px; border-radius: 8px; background: #3B82F6; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 style="color: #1E40AF; font-size: 16px; font-weight: 600; margin: 0;">Admin Action Required</h3>
    </div>
    <p style="margin: 0; color: #334155; line-height: 1.6;">{{$user->name}} has requested a withdrawal of <span style="font-weight: 600; color: #1E40AF;">{{$settings->currency}}{{number_format($withdrawal->amount, 2)}}</span> to {{$withdrawal->accountname}} ({{$withdrawal->bankname}}). Please review this transaction.</p>
</div>
@else
    @if ($withdrawal->status == 'Processed')
    <!-- Success Message -->
    <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-left: 4px solid #3B82F6; border-radius: 10px; padding: 20px; margin-bottom: 25px;">
        <h3 style="color: #1E40AF; font-size: 16px; font-weight: 600; margin: 0 0 8px 0;">Transfer Completed</h3>
        <p style="margin: 0; color: #334155; line-height: 1.6;">Your withdrawal of <span style="font-weight: 600; color: #1E40AF;">{{$settings->currency}}{{number_format($withdrawal->amount, 2)}}</span> has been successfully processed and sent to {{$withdrawal->accountname}} at {{$withdrawal->bankname}}.</p>
    </div>
    @else
    <!-- Processing Message -->
    <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-left: 4px solid #60A5FA; border-radius: 10px; padding: 20px; margin-bottom: 25px;">
        <h3 style="color: #1E40AF; font-size: 16px; font-weight: 600; margin: 0 0 8px 0;">Processing Your Request</h3>
        <p style="margin-bottom: 8px; color: #334155; line-height: 1.6;">Your withdrawal of <span style="font-weight: 600; color: #1E40AF;">{{$settings->currency}}{{number_format($withdrawal->amount, 2)}}</span> to {{$withdrawal->accountname}} at {{$withdrawal->bankname}} is being processed.</p>
        <p style="margin: 0; color: #334155;">Expected completion:
        @if($withdrawal->payment_mode == 'International Wire Transfer')
        <span style="font-weight: 600;">2-3 business days</span>
        @else
        <span style="font-weight: 600;">within 1 hour</span>
        @endif
        </p>
    </div>
    @endif
@endif
@endsection

@section('additional_content')
@if (!$foramin)
<!-- Transaction Details Table -->
<div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); margin: 30px 0; border: 1px solid #E2E8F0;">
    <div style="background: linear-gradient(90deg, #1E40AF 0%, #3B82F6 100%); color: white; padding: 18px; position: relative;">
        <h3 style="margin: 0; font-size: 16px; font-weight: 600; display: flex; align-items: center;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;">
                <path d="M9 12H15M9 16H15M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H12.5858C12.851 3 13.1054 3.10536 13.2929 3.29289L19.7071 9.70711C19.8946 9.89464 20 10.149 20 10.4142V19C20 20.1046 19.1046 21 18 21H17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Transaction Details
        </h3>
        <p style="margin: 4px 0 0 30px; opacity: 0.8; font-size: 13px;">Reference: #{{$withdrawal->id ?? str_pad($withdrawal->id ?? '001', 6, '0', STR_PAD_LEFT)}}</p>
    </div>

    <!-- Professional Transaction Table -->
    <table style="width: 100%; border-collapse: collapse;">
        <tbody>
            <tr style="background: #FAFBFC;">
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; font-weight: 600; color: #374151; width: 40%;">Account Number</td>
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; color: #1F2937; font-family: monospace; letter-spacing: 0.5px;">{{$withdrawal->accountnumber}}</td>
            </tr>
            <tr style="background: white;">
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; font-weight: 600; color: #374151;">Account Holder</td>
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; color: #1F2937;">{{$withdrawal->accountname}}</td>
            </tr>
            <tr style="background: #FAFBFC;">
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; font-weight: 600; color: #374151;">Bank Name</td>
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; color: #1F2937;">{{$withdrawal->bankname}}</td>
            </tr>
            <tr style="background: white;">
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; font-weight: 600; color: #374151;">Description</td>
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; color: #1F2937;">{{$withdrawal->Description}}</td>
            </tr>
            <tr style="background: #FAFBFC;">
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; font-weight: 600; color: #374151;">Transaction Date</td>
                <td style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0; color: #1F2937;">{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('l, F j, Y \a\t g:i A') }}</td>
            </tr>
            <tr style="background: #EFF6FF;">
                <td style="padding: 18px 20px; border-bottom: 1px solid #BFDBFE; font-weight: 700; color: #1E40AF;">Withdrawal Amount</td>
                <td style="padding: 18px 20px; border-bottom: 1px solid #BFDBFE; color: #1E3A8A; font-weight: 700; font-size: 16px;">{{$settings->currency}}{{number_format($withdrawal->amount, 2)}}</td>
            </tr>
            <tr style="background: #F0F9FF;">
                <td style="padding: 18px 20px; font-weight: 700; color: #1E40AF;">Available Balance</td>
                <td style="padding: 18px 20px; color: #1E3A8A; font-weight: 700; font-size: 16px;">{{$settings->currency}}{{number_format($withdrawal->bal, 2)}}</td>
            </tr>
        </tbody>
    </table>
</div>

@if($withdrawal->payment_mode == 'International Wire Transfer')
<!-- International Transfer Information -->
<div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-left: 4px solid #60A5FA; border-radius: 10px; padding: 20px; margin: 25px 0;">
    <div style="display: flex; align-items: center; margin-bottom: 12px;">
        <div style="width: 32px; height: 32px; border-radius: 8px; background: #3B82F6; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 style="color: #1E40AF; font-size: 16px; font-weight: 600; margin: 0;">International Wire Transfer</h3>
    </div>
    <div style="background: white; border-radius: 8px; padding: 16px;">
        <p style="margin: 0 0 10px 0; color: #334155; line-height: 1.6;">
            <strong>Processing Time:</strong> International transfers typically take 2-3 business days due to correspondent banking networks.
        </p>
        <p style="margin: 0; color: #334155; line-height: 1.6;">
            <strong>Additional Fees:</strong> Intermediary banks may charge fees that will be deducted from the transfer amount.
        </p>
    </div>
</div>
@endif

@if ($withdrawal->status != 'Processed')
<!-- Action Buttons -->
<div style="text-align: center; margin: 30px 0;">
    <a href="{{ url('/dashboard/transactions') }}" style="display: inline-block; background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%); color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 0 8px; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">View Transactions</a>
    <a href="{{ url('/dashboard') }}" style="display: inline-block; background: #64748B; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 0 8px;">Dashboard</a>
</div>
@endif

<!-- Security Notice -->
<div style="background: #F1F5F9; border: 1px solid #CBD5E1; border-radius: 8px; padding: 16px; margin: 25px 0;">
    <div style="display: flex; align-items: flex-start;">
        <div style="width: 28px; height: 28px; border-radius: 6px; background: #64748B; display: flex; align-items: center; justify-content: center; margin-right: 10px; flex-shrink: 0;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 12L11 14L15 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div>
            <h4 style="color: #334155; font-size: 14px; font-weight: 600; margin: 0 0 6px 0;">Security Information</h4>
            <p style="color: #475569; font-size: 13px; margin: 0; line-height: 1.5;">This transaction was initiated from a verified device. If you did not authorize this withdrawal, please contact security immediately.</p>
        </div>
    </div>
</div>
@endif
@endsection

@section('help_text')
<div style="background: #F8FAFC; border-radius: 12px; padding: 25px; margin-top: 30px; border: 1px solid #E2E8F0;">
    <div style="display: flex; align-items: center; margin-bottom: 18px;">
        <div style="width: 40px; height: 40px; border-radius: 10px; background: #3B82F6; display: flex; align-items: center; justify-content: center; margin-right: 14px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.09 9C9.3251 8.33167 9.78915 7.76811 10.4 7.40913C11.0108 7.05016 11.7289 6.91894 12.4272 7.03871C13.1255 7.15849 13.7588 7.52152 14.2151 8.06353C14.6713 8.60553 14.9211 9.29152 14.92 10C14.92 12 11.92 13 11.92 13M12 17H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div>
            <h3 style="color: #1E40AF; font-size: 18px; font-weight: 600; margin: 0;">Need Assistance?</h3>
            <p style="color: #64748B; font-size: 14px; margin: 2px 0 0 0;">Our support team is available 24/7</p>
        </div>
    </div>

    <p style="color: #475569; font-size: 15px; line-height: 1.6; margin-bottom: 20px;">If you have any questions about this withdrawal or did not authorize this transaction, please contact our support team immediately.</p>

    <!-- Contact Methods -->
    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
        <!-- Email Contact -->
        <div style="flex: 1; min-width: 180px; background: white; border-radius: 10px; padding: 16px; border: 1px solid #E2E8F0; text-align: center;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #60A5FA; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="L22 6L12 13L2 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h4 style="color: #1E40AF; font-size: 13px; font-weight: 600; margin: 0 0 6px 0;">Email Support</h4>
            <a href="mailto:{{ $settings->contact_email }}" style="color: #3B82F6; font-weight: 500; text-decoration: none; font-size: 13px;">{{ $settings->contact_email }}</a>
        </div>

        <!-- Help Center -->
        <div style="flex: 1; min-width: 180px; background: white; border-radius: 10px; padding: 16px; border: 1px solid #E2E8F0; text-align: center;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #60A5FA; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h4 style="color: #1E40AF; font-size: 13px; font-weight: 600; margin: 0 0 6px 0;">Help Center</h4>
            <a href="{{ url('/help') }}" style="color: #3B82F6; font-weight: 500; text-decoration: none; font-size: 13px;">Visit Help Center</a>
        </div>
    </div>
</div>
@endsection
