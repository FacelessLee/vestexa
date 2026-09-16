<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        
        .email-header {
            background: linear-gradient(135deg, #4F46E5 0%, #2D3A8C 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        
        .company-logo {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
        }
        
        .email-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        
        .email-subtitle {
            margin-top: 5px;
            opacity: 0.9;
            font-weight: 400;
        }
        
        .email-body {
            padding: 40px 30px;
            background-color: #ffffff;
        }
        
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .message {
            margin-bottom: 30px;
            color: #555;
        }
        
        .verification-code {
            background-color: #f5f7fa;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            text-align: center;
        }
        
        .code {
            font-family: monospace;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 8px;
            color: #4F46E5;
        }
        
        .expiry-notice {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 30px 0;
            border-radius: 4px;
        }
        
        .help-text {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
        }
        
        .email-footer {
            padding: 20px 30px;
            text-align: center;
            background-color: #f9fafb;
            color: #6b7280;
            font-size: 13px;
            border-top: 1px solid #e5e7eb;
        }
        
        .highlight {
            color: #4F46E5;
            font-weight: 600;
        }
        
        @media screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                width: 100%;
                border-radius: 0;
            }
            
            .email-header, .email-body, .email-footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="company-logo">{{ $settings->site_name }}</div>
            <h1 class="email-title">Verify Your Email</h1>
            <p class="email-subtitle">Please verify your email address to continue</p>
        </div>
        
        <div class="email-body">
            <div class="greeting">Hello {{ $user->name }},</div>
            
            <div class="message">
                <p>Thanks for signing up for {{ $settings->site_name }}! To complete your registration and access all features, please verify your email address by entering the verification code below:</p>
            </div>
            
            <div class="verification-code">
                <p>Your verification code is:</p>
                <div class="code">{{ $code }}</div>
            </div>
            
            <div class="expiry-notice">
                <strong>Important:</strong> This code will expire in {{ $expiration }} minutes for security reasons. If you don't verify your email within this time, you'll need to request a new code.
            </div>
            
            <div class="help-text">
                <p>If you didn't create an account with {{ $settings->site_name }}, please ignore this email or contact our support team if you have any questions.</p>
                <p>This is an automated message, please do not reply to this email.</p>
            </div>
        </div>
        
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
            <p>If you have any questions, please contact <span class="highlight">support@{{ strtolower(str_replace(' ', '', $settings->site_name)) }}.com</span></p>
        </div>
    </div>
</body>
</html> 