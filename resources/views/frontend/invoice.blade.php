<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE #{{ $sale->invoice }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; color: #1a1a2e; background: #fff; padding: 40px; }
        .invoice-box { max-width: 800px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 2px solid #e9ecef; }
        .logo-section img { height: 50px; margin-bottom: 8px; }
        .logo-section p { color: #64748b; font-size: 13px; }
        .invoice-title { text-align: right; }
        .invoice-title h1 { font-size: 28px; color: #ff5b1f; letter-spacing: 2px; }
        .invoice-title p { color: #64748b; font-size: 14px; margin-top: 4px; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .info-box { flex: 1; }
        .info-box h6 { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 8px; }
        .info-box p { font-size: 14px; line-height: 1.6; }
        .info-box strong { color: #1a1a2e; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        thead th { background: #f8fafc; padding: 12px 16px; text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; border-bottom: 2px solid #e9ecef; }
        thead th:last-child, thead th:nth-child(3), thead th:nth-child(4) { text-align: right; }
        tbody td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        tbody td:last-child, tbody td:nth-child(3), tbody td:nth-child(4) { text-align: right; }
        .product-name { font-weight: 600; }
        .product-meta { font-size: 12px; color: #94a3b8; margin-top: 2px; }
        .summary { display: flex; justify-content: flex-end; margin-bottom: 30px; }
        .summary-box { width: 280px; }
        .summary-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 14px; }
        .summary-row.total { border-top: 2px solid #1a1a2e; padding-top: 12px; margin-top: 4px; font-size: 18px; font-weight: 700; }
        .summary-row.total span:last-child { color: #ff5b1f; }
        .footer { text-align: center; padding-top: 30px; border-top: 1px solid #e9ecef; color: #94a3b8; font-size: 13px; }
        .footer p { margin-bottom: 4px; }
        .badge-cod { display: inline-block; background: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .print-btn { position: fixed; bottom: 30px; right: 30px; background: #ff5b1f; color: #fff; border: none; padding: 14px 28px; border-radius: 999px; font-size: 15px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 20px rgba(255,91,31,.4); display: flex; align-items: center; gap: 8px; z-index: 100; }
        .print-btn:hover { background: #e64a0f; }
        @media print {
            body { padding: 0; }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="logo-section">
                @if($company->company_logo)
                    <img src="{{ asset('uploads/company/' . $company->company_logo) }}" alt="{{ $company->company_name }}">
                @endif
                <p>{{ $company->address1 ?? '' }}{{ $company->city ? ', ' . $company->city : '' }}</p>
                <p>{{ $company->phone1 ?? '' }}{{ $company->email1 ? ' | ' . $company->email1 : '' }}</p>
            </div>
            <div class="invoice-title">
                <h1>INVOICE</h1>
                <p><strong>#{{ $sale->invoice }}</strong></p>
                <p>{{ $sale->date ? date('F d, Y', strtotime($sale->date)) : $sale->created_at->format('F d, Y') }}</p>
            </div>
        </div>

        <div class="info-row">
            <div class="info-box">
                <h6>Bill To</h6>
                <p>
                    <strong>{{ $sale->frontendOrderDetail->customer_name ?? $sale->customer->name ?? '' }}</strong><br>
                    {{ $sale->frontendOrderDetail->customer_phone ?? $sale->customer->phone ?? '' }}<br>
                    {{ $sale->frontendOrderDetail->address ?? '' }}<br>
                    {{ $sale->frontendOrderDetail->upazila->name ?? '' }}{{ $sale->frontendOrderDetail->upazila->name && $sale->frontendOrderDetail->district->name ? ', ' : '' }}{{ $sale->frontendOrderDetail->district->name ?? '' }}{{ ($sale->frontendOrderDetail->upazila->name || $sale->frontendOrderDetail->district->name) && $sale->frontendOrderDetail->division->name ? ', ' : '' }}{{ $sale->frontendOrderDetail->division->name ?? '' }}
                </p>
            </div>
            <div class="info-box" style="text-align:right;">
                <h6>Payment</h6>
                <p><span class="badge-cod">Cash on Delivery</span></p>
                @if($sale->frontendOrderDetail->delivery_note)
                    <p style="margin-top:8px;color:#64748b;font-size:13px;">Note: {{ $sale->frontendOrderDetail->delivery_note }}</p>
                @endif
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->saleItems as $item)
                    <tr>
                        <td>
                            <div class="product-name">{{ $item->product->name ?? 'Product' }}</div>
                            @if($item->color || $item->size)
                                <div class="product-meta">
                                    @if($item->color) {{ $item->color->name }} @endif
                                    @if($item->size) / {{ $item->size->name }} @endif
                                </div>
                            @endif
                        </td>
                        <td>{{ $item->sale_qty }}</td>
                        <td>৳ {{ number_format($item->unit_sale, 2) }}</td>
                        <td><strong>৳ {{ number_format($item->total_sale, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div class="summary-box">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>৳ {{ number_format($sale->subtotal, 2) }}</span>
                </div>
                @if($sale->vat_amount > 0)
                    <div class="summary-row">
                        <span>VAT ({{ $sale->vat_percent }}%)</span>
                        <span>৳ {{ number_format($sale->vat_amount, 2) }}</span>
                    </div>
                @endif
                @if($sale->discount_amount > 0)
                    <div class="summary-row">
                        <span>Discount</span>
                        <span>-৳ {{ number_format($sale->discount_amount, 2) }}</span>
                    </div>
                @endif
                <div class="summary-row">
                    <span>Delivery</span>
                    <span>৳ {{ number_format($sale->delivery_charge, 2) }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>৳ {{ number_format($sale->net_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="footer">
            <p><strong>{{ $company->company_name ?? config('app.name') }}</strong></p>
            <p>Thank you for your purchase!</p>
        </div>
    </div>

    <button class="print-btn" onclick="window.print()">
        <i class="bi bi-printer"></i> Print / Save PDF
    </button>
</body>
</html>
