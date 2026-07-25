<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Proforma {{ $proforma->proforma_number }}</title>
    <style>
        @page { margin: 40px 50px 100px; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1e293b;
            font-size: 11px;
            line-height: 1.5;
            margin: 0;
        }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; background: #f1f5f9; padding: 10px 8px; font-size: 10px; text-transform: uppercase; color: #475569; letter-spacing: 0.05em; }
        td { padding: 10px 8px; border-bottom: 1px solid #e2e8f0; vertical-align: top; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .header { border-bottom: 2px solid #0f172a; padding-bottom: 20px; margin-bottom: 30px; }
        .header-flex { display: table; width: 100%; }
        .header-cell { display: table-cell; vertical-align: top; }
        .header-cell.right { text-align: right; }
        .logo-image { width: 190px; height: auto; }
        .logo-sub { font-size: 9px; color: #64748b; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 2px; }
        .meta { font-size: 10px; color: #64748b; margin-top: 4px; }
        .meta strong { color: #1e293b; }
        h2 { font-size: 14px; margin: 0 0 6px 0; color: #0f172a; text-transform: uppercase; letter-spacing: 0.05em; }
        .info-grid { display: table; width: 100%; margin-bottom: 26px; }
        .info-cell { display: table-cell; vertical-align: top; width: 50%; }
        .info-block { padding: 12px 14px; background: #f8fafc; border-radius: 4px; }
        .info-block + .info-block { margin-left: 14px; }
        .info-label { font-size: 9px; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; margin-bottom: 4px; }
        .info-name { font-weight: 700; color: #0f172a; font-size: 12px; }
        .info-text { color: #475569; font-size: 10px; }
        .totals { margin-top: 20px; }
        .totals td { border: none; padding: 6px 8px; }
        .totals .label { text-align: right; color: #64748b; }
        .totals .grand { background: #0f172a; color: #fff; font-size: 13px; font-weight: 700; }
        .totals .grand .label { color: #cbd5e1; }
        .terms { margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; }
        .terms-grid { display: table; width: 100%; }
        .terms-cell { display: table-cell; vertical-align: top; padding-right: 14px; }
        .terms h3 { font-size: 10px; text-transform: uppercase; letter-spacing: 0.05em; color: #0f172a; margin: 0 0 6px 0; font-weight: 700; }
        .terms p { margin: 0; color: #475569; white-space: pre-line; }
        .footer { position: fixed; left: 0; right: 0; bottom: -75px; height: 58px; padding-top: 8px; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 9px; }
        .footer-table { width: 100%; }
        .footer-table td { padding: 0; border: none; color: #94a3b8; font-size: 9px; vertical-align: middle; }
        .footer-powered { margin-top: 4px; color: #64748b; font-size: 8px; }
        .footer-qr { width: 50px; height: 50px; }
        .footer-qr-label { margin-top: 2px; color: #64748b; font-size: 8px; }
        .badge { display: inline-block; padding: 2px 8px; background: #0f172a; color: #fff; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; border-radius: 2px; }
    </style>
</head>
<body>

<div class="header">
    <div class="header-flex">
        <div class="header-cell">
            <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('assets/brand/logo-horizontal.svg'))) }}" alt="Cooper Trading" class="logo-image">
            <div class="logo-sub" style="color: #1D2855;">Industrial · Construction · Export</div>
        </div>
        <div class="header-cell right">
            <span class="badge">Proforma Invoice</span>
            <div class="meta" style="margin-top: 8px;">
                <strong>{{ $proforma->proforma_number }}</strong><br>
                Issued: {{ $proforma->issue_date->format('M d, Y') }}<br>
                Valid until: {{ $proforma->validity_date->format('M d, Y') }}
            </div>
        </div>
    </div>
</div>

<div class="info-grid">
    <div class="info-cell">
        <div class="info-block">
            <div class="info-label">From</div>
            <div class="info-name">{{ $app_name ?? 'Cooper Trading' }}</div>
            <div class="info-text">
                Addis Ababa, Ethiopia<br>
                info@cooperatrading.com<br>
                +251 11 123 4567
            </div>
        </div>
    </div>
    <div class="info-cell">
        <div class="info-block">
            <div class="info-label">Bill to</div>
            <div class="info-name">{{ $proforma->quoteRequest->customer_name }}</div>
            @if ($proforma->quoteRequest->company_name)
                <div class="info-text">{{ $proforma->quoteRequest->company_name }}</div>
            @endif
            <div class="info-text">
                {{ $proforma->quoteRequest->email }}<br>
                @if ($proforma->quoteRequest->phone)
                    {{ $proforma->quoteRequest->phone }}
                @endif
            </div>
        </div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 5%;">#</th>
            <th style="width: 50%;">Description</th>
            <th style="width: 10%;" class="text-center">Unit</th>
            <th style="width: 10%;" class="text-right">Qty</th>
            <th style="width: 12%;" class="text-right">Unit price</th>
            <th style="width: 13%;" class="text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proforma->items as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <strong>{{ $item->product_name }}</strong>
                </td>
                <td class="text-center">{{ $item->unit_of_measure }}</td>
                <td class="text-right">{{ number_format($item->quantity, 0) }}</td>
                <td class="text-right">{{ number_format($item->unit_price, 2) }} {{ $currency_symbol ?? 'Br' }}</td>
                <td class="text-right">{{ number_format($item->total_price, 2) }} {{ $currency_symbol ?? 'Br' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table class="totals" style="margin-left: auto; width: 50%;">
    <tr>
        <td class="label">Subtotal</td>
        <td class="text-right" style="width: 35%;">{{ number_format($proforma->subtotal, 2) }} {{ $currency_symbol ?? 'Br' }}</td>
    </tr>
    <tr>
        <td class="label">VAT (15%)</td>
        <td class="text-right">{{ number_format($proforma->vat, 2) }} {{ $currency_symbol ?? 'Br' }}</td>
    </tr>
    <tr class="grand">
        <td class="label">Total</td>
        <td class="text-right">{{ number_format($proforma->total, 2) }} {{ $currency_symbol ?? 'Br' }}</td>
    </tr>
</table>

<div class="terms">
    <div class="terms-grid">
        <div class="terms-cell" style="width: 33%;">
            <h3>Payment terms</h3>
            <p>{{ $proforma->payment_terms }}</p>
        </div>
        <div class="terms-cell" style="width: 33%;">
            <h3>Delivery time</h3>
            <p>{{ $proforma->delivery_time }}</p>
        </div>
        <div class="terms-cell" style="width: 34%;">
            <h3>Bank details</h3>
            <p>{{ $proforma->bank_details }}</p>
        </div>
    </div>
    @if ($proforma->notes)
        <div style="margin-top: 14px;">
            <h3>Notes</h3>
            <p>{{ $proforma->notes }}</p>
        </div>
    @endif
</div>

<div class="footer">
    <table class="footer-table">
        <tr>
            <td>
                <div>{{ $app_name ?? 'Cooper Trading' }} · {{ $proforma->proforma_number }} · Generated {{ now()->format('M d, Y H:i') }}</div>
                <div class="footer-powered">Powered by RCC</div>
            </td>
            <td class="text-right">
                <img src="{{ $verification_qr }}" alt="Verification QR code" class="footer-qr">
                <div class="footer-qr-label">Scan to verify this invoice</div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
