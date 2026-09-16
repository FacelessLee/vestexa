<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Email Notification')</title>
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
        
        .highlight-box {
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
        
        .notice-box {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 30px 0;
            border-radius: 4px;
        }
        
        .success-box {
            background-color: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 30px 0;
            border-radius: 4px;
        }
        
        .info-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 30px 0;
            border-radius: 4px;
        }
        
        .warning-box {
            background-color: #fff7ed;
            border-left: 4px solid #f97316;
            padding: 15px;
            margin: 30px 0;
            border-radius: 4px;
        }
        
        .error-box {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 15px;
            margin: 30px 0;
            border-radius: 4px;
        }
        
        .transaction-details {
            margin: 20px 0;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .transaction-details-header {
            background-color: #f9fafb;
            padding: 10px 15px;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .transaction-details-body {
            padding: 15px;
        }
        
        .transaction-details-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .transaction-details-row:last-child {
            border-bottom: none;
        }
        
        .transaction-details-label {
            font-weight: 500;
            color: #6b7280;
        }
        
        .transaction-details-value {
            font-weight: 600;
            text-align: right;
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
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4F46E5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 15px 0;
            text-align: center;
        }
        
        .btn:hover {
            background-color: #4338ca;
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
            
            .transaction-details-row {
                flex-direction: column;
            }
            
            .transaction-details-value {
                text-align: left;
                margin-top: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="company-logo">@yield('company_name', 'Company Name')</div>
            <h1 class="email-title">@yield('title', 'Email Notification')</h1>
            <p class="email-subtitle">@yield('subtitle', '')</p>
        </div>
        
        <div class="email-body">
            <div class="greeting">@yield('greeting', 'Hello,')</div>
            
            <div class="message">
                @yield('content')
            </div>
            
            @yield('additional_content')
            
            @hasSection('help_text')
            <div class="help-text">
                @yield('help_text')
            </div>
            @endif
        </div>
        
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} @yield('company_name', 'Company Name'). All rights reserved.</p>
            <p>@yield('footer', 'If you have any questions, please contact our support team.')</p>
        </div>
    </div>
</body>
</html> 