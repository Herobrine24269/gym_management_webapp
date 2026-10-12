<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCore Fee Receipt - {{ $payment->invoice_no ?? 'FC-INV' }}</title>
    <link rel="stylesheet" href="{{ asset('css/fitcore.css') }}">
    <style>
        body {
            background-color: #0b0c10;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            padding: 40px 20px;
        }
        .receipt-card {
            max-width: 720px;
            margin: 0 auto;
            background: #12131a;
            border: 1px solid #33343c;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            position: relative;
        }
        @media print {
            body { background: #ffffff !important; color: #000000 !important; padding: 0 !important; }
            .receipt-card { border: 1px solid #ccc !important; box-shadow: none !important; color: #000000 !important; background: #ffffff !important; }
            .no-print { display: none !important; }
            .badge-print { border: 1px solid #000 !important; color: #000 !important; background: none !important; }
            h1, h2, h3, strong { color: #000000 !important; }
            p, span, td, th { color: #333333 !important; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="max-width: 720px; margin: 0 auto 20px auto; display: flex; justify-content: space-between; align-items: center;">
        <a href="javascript:history.back()" class="btn-secondary" style="font-size: 13px; padding: 8px 16px; text-decoration: none;">
            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
            <span>Back to Dashboard</span>
        </a>
        <button onclick="window.print()" class="btn-primary" style="font-size: 13px; padding: 8px 20px;">
            <span class="material-symbols-outlined" style="font-size: 18px;">print</span>
            <span>Print / Save PDF Receipt</span>
        </button>
    </div>

    <div class="receipt-card">
        <!-- Receipt Header -->
        <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid #33343c; padding-bottom: 24px; margin-bottom: 24px;">
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                    <div style="width: 38px; height: 38px; background: #ff5f1f; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <span class="material-symbols-outlined" style="color: white; font-size: 24px;">fitness_center</span>
                    </div>
                    <h1 style="font-size: 26px; font-family: 'Archivo Narrow', sans-serif; letter-spacing: -0.02em; margin: 0;">FIT<span style="color: #ff5f1f;">CORE</span> GYM</h1>
                </div>
                <p style="font-size: 13px; color: #9a9caf; margin: 0;">1044 Apex Boulevard, Metro Heights, NY</p>
                <p style="font-size: 13px; color: #9a9caf; margin: 2px 0 0 0;">Phone: +1 (800) 555-CORE | Email: billing@fitcore.gym</p>
            </div>

            <div style="text-align: right;">
                <span class="badge badge-success badge-print" style="font-size: 13px; padding: 6px 14px; text-transform: uppercase;">PAID RECEIPT</span>
                <div style="font-size: 16px; font-family: 'Archivo Narrow', sans-serif; margin-top: 10px; font-weight: 700; color: white;">INVOICE #: {{ $payment->invoice_no ?? 'FC-INV-2026-0001' }}</div>
                <div style="font-size: 13px; color: #9a9caf; margin-top: 4px;">Date: {{ $payment->paid_on ? $payment->paid_on->format('M d, Y') : date('M d, Y') }}</div>
            </div>
        </div>

        <!-- Billed To & Payment Method Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 30px; background: #1a1b24; padding: 20px; border-radius: 12px; border: 1px solid #2a2b36;">
            <div>
                <span style="font-size: 11px; text-transform: uppercase; color: #9a9caf; letter-spacing: 0.05em; font-weight: 600;">MEMBER DETAILS</span>
                <h3 style="font-size: 18px; margin: 6px 0 4px 0; color: white;">{{ $payment->membership->user->name ?? 'Member Name' }}</h3>
                <p style="font-size: 13px; color: #9a9caf; margin: 0;">Email: {{ $payment->membership->user->email ?? 'N/A' }}</p>
                <p style="font-size: 13px; color: #9a9caf; margin: 2px 0 0 0;">Phone: {{ $payment->membership->user->phone ?? 'N/A' }}</p>
            </div>

            <div>
                <span style="font-size: 11px; text-transform: uppercase; color: #9a9caf; letter-spacing: 0.05em; font-weight: 600;">PAYMENT METHOD</span>
                <div style="font-size: 16px; margin: 6px 0 4px 0; font-weight: 700; color: #ff5f1f; text-transform: uppercase;">
                    @if(in_array($payment->payment_method, ['jazzcash', 'easypaisa']))
                        🇵🇰 {{ strtoupper($payment->payment_method) }} MOBILE WALLET
                    @elseif($payment->payment_method === 'bank_transfer')
                        🏛️ BANK TRANSFER
                    @elseif($payment->payment_method === 'cash')
                        💵 CASH AT GYM DESK
                    @else
                        💳 CREDIT / DEBIT CARD
                    @endif
                </div>
                <p style="font-size: 13px; color: #9a9caf; margin: 0;">Transaction ID: <strong style="color: white;">{{ $payment->transaction_id ?? 'TRX-1002847' }}</strong></p>
                <p style="font-size: 13px; color: #9a9caf; margin: 2px 0 0 0;">Billing Cycle: <strong style="color: white;">{{ ucfirst($payment->membership->plan_type ?? 'monthly') }}</strong></p>
            </div>
        </div>

        <!-- Line Item Table -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
            <thead>
                <tr style="border-bottom: 2px solid #33343c; text-align: left; font-size: 12px; text-transform: uppercase; color: #9a9caf;">
                    <th style="padding: 10px 0;">Description</th>
                    <th style="padding: 10px 0;">Plan Tier</th>
                    <th style="padding: 10px 0;">Period</th>
                    <th style="padding: 10px 0; text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #22232c; font-size: 14px;">
                    <td style="padding: 16px 0; color: white; font-weight: 600;">FitCore Gym Membership Fee</td>
                    <td style="padding: 16px 0; color: #ff5f1f;">{{ $payment->membership->plan_name ?? 'All-Access Pro' }}</td>
                    <td style="padding: 16px 0; color: #9a9caf;">{{ ucfirst($payment->membership->plan_type ?? 'monthly') }}</td>
                    <td style="padding: 16px 0; text-align: right; color: white; font-weight: 700;">${{ number_format($payment->amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Receipt Total Summary -->
        <div style="display: flex; justify-content: flex-end; margin-bottom: 30px;">
            <div style="width: 260px; background: #1a1b24; padding: 16px; border-radius: 10px; border: 1px solid #2a2b36;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; color: #9a9caf;">
                    <span>Subtotal:</span>
                    <span>${{ number_format($payment->amount, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; color: #9a9caf;">
                    <span>Tax / Service Fee:</span>
                    <span>$0.00</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700; color: white; border-top: 1px solid #33343c; padding-top: 8px;">
                    <span>Total Paid:</span>
                    <span style="color: #22c55e;">${{ number_format($payment->amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Receipt Footer Note -->
        <div style="border-top: 1px solid #33343c; padding-top: 20px; text-align: center; font-size: 12px; color: #9a9caf;">
            Thank you for training with FitCore Gym! This is an official computer-generated receipt.
        </div>
    </div>

</body>
</html>
