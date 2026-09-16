<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: {{ $settings->s_color }};
            color: white;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 5px;
            padding: 15px;
            margin: 20px 0;
            background-color: #fff;
            border: 1px dashed #ccc;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
        .warning {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Two-Factor Authentication</h1>
        </div>
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            
            <p>You are receiving this email because you are attempting to log in to your account at {{ $settings->site_name }}.</p>
            
            <p>Please use the following code to complete your login:</p>
            
            <div class="code">{{ $code }}</div>
            
            <p>This code will expire in {{ $expiration }} minutes.</p>
            
            <div class="warning">
                <strong>Important:</strong> If you did not request this code, please ignore this email and consider changing your password immediately.
            </div>
            
            <p>Thank you,<br>
            The {{ $settings->site_name }} Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
