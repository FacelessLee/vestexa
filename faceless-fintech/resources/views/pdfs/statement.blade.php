<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement of Account</title>
    <!-- Add jsPDF and html2canvas libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- SVG Icon Definitions -->
    <style>
        /* SVG Icon Definitions - Lucide Style */
        .icon-definitions {
            display: none;
        }
        
        @page {
            margin: 0;
            size: A4 portrait;
        }
        
        /* Base Styles */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #1a202c;
            font-size: 12px;
            line-height: 1.5;
            background-color: #fff;
        }
        
        * {
            box-sizing: border-box;
        }
        
        .page {
            position: relative;
            width: 100%;
            min-height: 1100px;
            padding: 0;
            overflow: hidden;
        }
        
        /* Print Styles */
        @media print {
            body {
                background-color: white;
            }
            
            .print-button {
                display: none !important;
            }
            
            .pdf-button {
                display: none !important;
            }
            
            .page {
                width: 100%;
                height: 100%;
                position: relative;
                page-break-after: always;
                page-break-inside: avoid;
            }
            
            @page {
                size: A4 portrait;
                margin: 0;
            }
        }
        
        /* Print Button */
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #1e40af;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 9999;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }
        
        .print-button:hover {
            background-color: #1e3a8a;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }
        
        /* PDF Button */
        .pdf-button {
            position: fixed;
            top: 20px;
            right: 140px;
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 9999;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }
        
        .pdf-button:hover {
            background-color: #b91c1c;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }
        
        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 10000;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        .loading-text {
            color: white;
            margin-top: 20px;
            font-size: 16px;
        }
        
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid white;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Icons */
        .icon {
            display: inline-block;
            width: 18px;
            height: 18px;
            stroke-width: 2;
            stroke: currentColor;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
            vertical-align: middle;
            margin-right: 5px;
        }
        
        /* Watermark Styles */
        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.03;
            pointer-events: none;
        }
        
        .watermark-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 150px;
            font-weight: bold;
            color: #000;
            transform-origin: center;
            transform: translate(-50%, -50%) rotate(-30deg);
        }
        
        /* Header Styles */
        .header {
            padding: 30px 40px 20px;
            position: relative;
        }
        
        .logo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .logo {
            height: 50px;
        }
        
        /* Content Containers */
        .container {
            padding: 0 40px;
        }
        
        /* Card Styles */
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }
        
        /* Statement Header */
        .statement-header {
            background: linear-gradient(to right, #1a365d, #2a4365);
            color: white;
            padding: 20px 30px;
            border-radius: 10px 10px 0 0;
        }
        
        .statement-title {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }
        
        .statement-subtitle {
            font-size: 14px;
            opacity: 0.8;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }
        
        /* Account Info */
        .account-info {
            display: flex;
            background-color: #f8fafc;
            padding: 20px 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .account-details {
            flex: 1;
        }
        
        .account-details h3 {
            font-size: 14px;
            color: #4a5568;
            margin: 0 0 10px 0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }
        
        .account-details p {
            margin: 5px 0;
            font-size: 13px;
        }
        
        .account-number {
            font-family: monospace;
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        .statement-period {
            text-align: right;
            flex: 1;
        }
        
        /* Summary Section */
        .summary-section {
            padding: 20px 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .summary-title {
            font-size: 14px;
            font-weight: 600;
            color: #4a5568;
            margin: 0 0 15px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }
        
        .summary-grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .summary-item {
            flex: 1;
            min-width: 200px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        .summary-item-title {
            font-size: 12px;
            color: #718096;
            margin: 0 0 5px 0;
            display: flex;
            align-items: center;
        }
        
        .summary-item-value {
            font-size: 18px;
            font-weight: 700;
            color: #1a202c;
        }
        
        .summary-item-value.credit {
            color: #059669;
        }
        
        .summary-item-value.debit {
            color: #dc2626;
        }
        
        /* Transaction Section */
        .transactions-section {
            padding: 20px 30px;
        }
        
        .transactions-title {
            font-size: 14px;
            font-weight: 600;
            color: #4a5568;
            margin: 0 0 15px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }
        
        /* Table Styles */
        .table-container {
            overflow-x: auto;
        }
        
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 12px;
        }
        
        .table th {
            background-color: #f1f5f9;
            color: #4b5563;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 15px;
            text-align: left;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }
        
        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        .table tr:hover {
            background-color: #f3f4f6;
        }
        
        .credit {
            color: #059669;
            font-weight: 600;
        }
        
        .debit {
            color: #dc2626;
            font-weight: 600;
        }
        
        /* Footer Styles */
        .footer {
            padding: 20px 40px;
            text-align: center;
            color: #6b7280;
            font-size: 11px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
        .footer p {
            margin: 5px 0;
        }
        
        /* Stamp Styles */
        .stamp {
            position: absolute;
            right: 40px;
            bottom: 120px;
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #be123c;
            border-radius: 50%;
            color: #be123c;
            font-weight: bold;
            font-size: 14px;
            transform: rotate(-15deg);
            opacity: 0.7;
            z-index: 10;
        }
        
        .stamp-inner {
            text-align: center;
            line-height: 1.3;
        }
        
        /* QR Code */
        .qr-code {
            position: absolute;
            bottom: 40px;
            left: 40px;
            padding: 10px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            text-align: center;
            font-size: 10px;
        }
        
        .qr-code-img {
            width: 80px;
            height: 80px;
            background-color: #f3f4f6;
            margin: 0 auto 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Page Number */
        .page-number {
            position: absolute;
            bottom: 20px;
            right: 40px;
            font-size: 10px;
            color: #6b7280;
        }
        
        /* Classic Style */
        .classic {
            background-color: white;
        }
        
        .classic .statement-header {
            background: #1e293b;
            color: white;
        }
        
        .classic .card {
            border: 1px solid #cbd5e1;
            box-shadow: none;
        }
        
        .classic .summary-item {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        
        .classic .stamp {
            border: 2px solid #1e40af;
            color: #1e40af;
        }
    </style>
    <script>
        // Initialize jsPDF when loaded
        document.addEventListener('DOMContentLoaded', function() {
            window.jsPDF = window.jspdf.jsPDF;
        });
        
        function printStatement() {
            // Add a class to the body to indicate we're printing
            document.body.classList.add('is-printing');
            
            // Hide the print button before printing
            const printButton = document.querySelector('.print-button');
            const pdfButton = document.querySelector('.pdf-button');
            
            if (printButton) {
                printButton.style.display = 'none';
            }
            if (pdfButton) {
                pdfButton.style.display = 'none';
            }
            
            // Use setTimeout to ensure the button is hidden before printing starts
            setTimeout(function() {
                window.print();
                
                // After printing, show the button again and remove the class
                setTimeout(function() {
                    if (printButton) {
                        printButton.style.display = '';
                    }
                    if (pdfButton) {
                        pdfButton.style.display = '';
                    }
                    document.body.classList.remove('is-printing');
                }, 500);
            }, 100);
        }
        
        function generatePDF() {
            try {
                // Show loading overlay
                const loadingOverlay = document.getElementById('loading-overlay');
                loadingOverlay.style.display = 'flex';
                
                // Hide buttons during PDF generation
                const printButton = document.querySelector('.print-button');
                const pdfButton = document.querySelector('.pdf-button');
                if (printButton) printButton.style.display = 'none';
                if (pdfButton) pdfButton.style.display = 'none';
                
                // Get the statement page element
                const element = document.querySelector('.page');
                
                // Calculate the PDF dimensions (A4)
                const pageWidth = 210; // mm
                const pageHeight = 297; // mm
                
                // Create new jsPDF instance
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });
                
                // Generate PDF
                html2canvas(element, {
                    scale: 2, // Higher scale for better quality
                    useCORS: true,
                    logging: false,
                    allowTaint: true
                }).then(canvas => {
                    // Calculate the ratio to fit the canvas to A4
                    const imgData = canvas.toDataURL('image/png');
                    const imgWidth = pageWidth;
                    const imgHeight = (canvas.height * imgWidth) / canvas.width;
                    
                    // Add the image to the PDF
                    pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                    
                    // Save the PDF
                    pdf.save('account_statement_{{ date('Y-m-d_His') }}.pdf');
                    
                    // Hide loading overlay and show buttons again
                    loadingOverlay.style.display = 'none';
                    if (printButton) printButton.style.display = '';
                    if (pdfButton) pdfButton.style.display = '';
                    
                }).catch(error => {
                    console.error('Error generating PDF:', error);
                    alert('Error generating PDF. Please try again.');
                    
                    // Hide loading overlay and show buttons again on error
                    loadingOverlay.style.display = 'none';
                    if (printButton) printButton.style.display = '';
                    if (pdfButton) pdfButton.style.display = '';
                });
            } catch (e) {
                console.error('PDF generation error:', e);
                alert('Error generating PDF. Please try again.');
                
                // Hide loading overlay on error
                document.getElementById('loading-overlay').style.display = 'none';
            }
        }
    </script>
</head>

<body>
    <!-- SVG Icons for Lucide -->
    <div class="icon-definitions">
        <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0">
            <defs>
                <symbol id="icon-file-text" viewBox="0 0 24 24">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <line x1="10" y1="9" x2="8" y2="9"></line>
                </symbol>
                <symbol id="icon-calendar" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </symbol>
                <symbol id="icon-user" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </symbol>
                <symbol id="icon-credit-card" viewBox="0 0 24 24">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </symbol>
                <symbol id="icon-dollar-sign" viewBox="0 0 24 24">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </symbol>
                <symbol id="icon-plus" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </symbol>
                <symbol id="icon-minus" viewBox="0 0 24 24">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </symbol>
                <symbol id="icon-history" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </symbol>
                <symbol id="icon-mail" viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </symbol>
                <symbol id="icon-phone" viewBox="0 0 24 24">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </symbol>
                <symbol id="icon-check" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </symbol>
                <symbol id="icon-qr-code" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="5" height="5" rx="1"></rect>
                    <rect x="16" y="3" width="5" height="5" rx="1"></rect>
                    <rect x="3" y="16" width="5" height="5" rx="1"></rect>
                    <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                    <path d="M21 21v.01"></path>
                    <path d="M12 7v3a2 2 0 0 1-2 2H7"></path>
                    <path d="M3 12h.01"></path>
                    <path d="M12 3h.01"></path>
                    <path d="M12 16v.01"></path>
                    <path d="M16 12h1"></path>
                    <path d="M21 12v.01"></path>
                </symbol>
                <symbol id="icon-printer" viewBox="0 0 24 24">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </symbol>
                <symbol id="icon-download" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </symbol>
            </defs>
        </svg>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="spinner"></div>
        <div class="loading-text">Generating PDF...</div>
    </div>

    <!-- Print Button (only visible on screen) -->
    <button class="print-button" onclick="printStatement()">
        <svg class="icon" width="16" height="16"><use xlink:href="#icon-printer"/></svg>
        Print Statement
    </button>
    
    <!-- Download PDF Button -->
    <button class="pdf-button" onclick="generatePDF()">
        <svg class="icon" width="16" height="16"><use xlink:href="#icon-download"/></svg>
        Download PDF
    </button>

    <div class="page {{ $statementStyle }}">
        <!-- Watermark -->
        <div class="watermark">
            <div class="watermark-logo">{{ $settings->site_name }}</div>
        </div>
        
        <div class="header">
            <div class="logo-container">
                <div>
                    @if(isset($settings->logo))
                    <img src="{{ asset('storage/app/public/' . $settings->logo) }}" class="logo" alt="Logo">
                    @else
                    <h2 style="margin: 0;">{{ $settings->site_name }}</h2>
                    @endif
                </div>
                <div style="text-align: right; font-size: 12px; color: #4b5563;">
                    <p style="margin: 0;">{{ $settings->address ?? '' }}</p>
                    <p style="margin: 0;">
                        <svg class="icon" width="16" height="16"><use xlink:href="#icon-mail"/></svg>
                        {{ $settings->site_email }}
                    </p>
                    <p style="margin: 0;">
                        <svg class="icon" width="16" height="16"><use xlink:href="#icon-phone"/></svg>
                        {{ $settings->phone ?? '' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <div class="statement-header">
                    <h1 class="statement-title">
                        <svg class="icon" width="22" height="22"><use xlink:href="#icon-file-text"/></svg>
                        Statement of Account
                    </h1>
                    <p class="statement-subtitle">
                        <svg class="icon" width="16" height="16"><use xlink:href="#icon-calendar"/></svg>
                        Generated on {{ now()->format('F d, Y') }}
                    </p>
                </div>
                
                <div class="account-info">
                    <div class="account-details">
                        <h3>
                            <svg class="icon" width="16" height="16"><use xlink:href="#icon-user"/></svg>
                            Account Information
                        </h3>
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Account Number:</strong> <span class="account-number">{{ $user->account_no }}</span></p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Phone:</strong> {{ $user->phone }}</p>
                    </div>
                    <div class="statement-period">
                        <h3>
                            <svg class="icon" width="16" height="16"><use xlink:href="#icon-calendar"/></svg>
                            Statement Period
                        </h3>
                        @if(isset($dateFrom) && isset($dateTo))
                        <p>{{ \Carbon\Carbon::parse($dateFrom)->format('F d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('F d, Y') }}</p>
                        @else
                        <p>All Transactions</p>
                        @endif
                        <h3 style="margin-top: 15px;">
                            <svg class="icon" width="16" height="16"><use xlink:href="#icon-credit-card"/></svg>
                            Account Type
                        </h3>
                        <p>{{ $user->accounttype ?? 'Standard Account' }}</p>
                    </div>
                </div>
                
                <div class="summary-section">
                    <h2 class="summary-title">
                        <svg class="icon" width="16" height="16"><use xlink:href="#icon-dollar-sign"/></svg>
                        Account Summary
                    </h2>
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-item-title">OPENING BALANCE</div>
                            <div class="summary-item-value">{{ $settings->currency }}{{ number_format($openingBalance, 2) }}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-item-title">
                                <svg class="icon" width="14" height="14"><use xlink:href="#icon-plus"/></svg>
                                TOTAL CREDITS
                            </div>
                            <div class="summary-item-value credit">{{ $settings->currency }}{{ number_format($totalCredits, 2) }}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-item-title">
                                <svg class="icon" width="14" height="14"><use xlink:href="#icon-minus"/></svg>
                                TOTAL DEBITS
                            </div>
                            <div class="summary-item-value debit">{{ $settings->currency }}{{ number_format($totalDebits, 2) }}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-item-title">CLOSING BALANCE</div>
                            <div class="summary-item-value">{{ $settings->currency }}{{ number_format($closingBalance, 2) }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="transactions-section">
                    <h2 class="transactions-title">
                        <svg class="icon" width="16" height="16"><use xlink:href="#icon-history"/></svg>
                        Transaction History
                    </h2>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Reference</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $runningBalance = $openingBalance; @endphp
                                
                                @foreach($transactions as $transaction)
                                @php
                                    if($transaction->type == 'Credit') {
                                        $runningBalance += $transaction->amount;
                                        $amountClass = 'credit';
                                        $amountPrefix = '+';
                                        $iconRef = '#icon-plus';
                                    } else {
                                        $runningBalance -= $transaction->amount;
                                        $amountClass = 'debit';
                                        $amountPrefix = '-';
                                        $iconRef = '#icon-minus';
                                    }
                                @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</td>
                                    <td>{{ $transaction->Description }}</td>
                                    <td>{{ $transaction->txn_id }}</td>
                                    <td>
                                        <svg class="icon" width="14" height="14"><use xlink:href="{{ $iconRef }}"/></svg>
                                        {{ $transaction->type }}
                                    </td>
                                    <td>{{ $transaction->status }}</td>
                                    <td class="{{ $amountClass }}">{{ $amountPrefix }} {{ $settings->currency }}{{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ $settings->currency }}{{ number_format($runningBalance, 2) }}</td>
                                </tr>
                                @endforeach
                                
                                @if(count($transactions) == 0)
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 30px;">No transactions found for the selected period.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stamp/Seal -->
        <div class="stamp">
            <div class="stamp-inner">
                <div>
                    <svg width="20" height="20" style="margin: 0 auto; display: block; margin-bottom: 5px;">
                        <use xlink:href="#icon-check"/>
                    </svg>
                    VERIFIED
                </div>
                <div>{{ now()->format('d/m/Y') }}</div>
                <div>{{ $settings->site_name }}</div>
            </div>
        </div>
        
        <!-- QR Code Placeholder -->
        <div class="qr-code">
            <div class="qr-code-img">
                <svg width="60" height="60">
                    <use xlink:href="#icon-qr-code"/>
                </svg>
            </div>
            <div>Scan to verify</div>
        </div>
        
        <div class="footer">
            <p>This statement is automatically generated and does not require a signature.</p>
            <p>Please contact our customer support at {{ $settings->contact_email ?? $settings->site_email }} if you have any questions about this statement.</p>
            <p>All figures are shown in {{ $settings->s_currency }}. This document serves as an official record of your account transactions.</p>
            <p>{{ $settings->site_name }} &copy; {{ date('Y') }} All rights reserved</p>
        </div>
        
        <div class="page-number">Page 1 of 1</div>
    </div>
</body>
</html> 