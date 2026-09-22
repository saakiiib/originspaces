<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'SolaimanLipi', 'Kalpurush', Arial, sans-serif; color: #000; background: #fff; padding: 20px; font-size: 14px; }
        .invoice { max-width: 700px; margin: 0 auto; border: 2px solid #000; }
        
        /* Header */
        .header { text-align: center; padding: 15px 20px; border-bottom: 2px solid #000; }
        .logo { margin-bottom: 10px; }
        .logo img { max-height: 80px; }
        .company-name { font-size: 22px; font-weight: bold; }
        .company-address { font-size: 12px; margin-top: 5px; }
        .company-phone { font-size: 12px; }
        
        /* Invoice Info */
        .invoice-info { display: flex; justify-content: space-between; padding: 10px 20px; border-bottom: 1px solid #000; font-size: 13px; }
        .invoice-info div { flex: 1; }
        
        /* Customer Info */
        .customer-info { padding: 10px 20px; border-bottom: 1px solid #000; font-size: 13px; }
        .customer-info .row { display: flex; margin-bottom: 3px; }
        .customer-info .label { width: 100px; font-weight: bold; }
        
        /* Table */
        .items-table { width: 100%; border-collapse: collapse; }
        .items-table th { background: #f0f0f0; padding: 8px 10px; text-align: left; font-size: 13px; border-bottom: 2px solid #000; border-left: none; border-right: none; }
        .items-table td { padding: 8px 10px; border-bottom: 1px solid #000; font-size: 13px; border-left: none; border-right: none; }
        .items-table tr:last-child td { border-bottom: none; }
        .items-table th:last-child, .items-table td:last-child { text-align: right; }
        .items-table th:nth-child(2), .items-table td:nth-child(2) { text-align: center; width: 60px; }
        .items-table th:nth-child(3), .items-table td:nth-child(3) { text-align: right; width: 100px; }
        
        /* Summary */
        .summary { padding: 10px 20px; border-top: 2px solid #000; }
        .summary-row { display: flex; justify-content: space-between; padding: 3px 0; font-size: 13px; }
        .summary-row.total { font-weight: bold; font-size: 16px; border-top: 1px solid #000; margin-top: 5px; padding-top: 8px; }
        
        /* Signature */
        .signature-section { display: flex; justify-content: space-between; padding: 20px; border-top: 1px solid #000; }
        .signature-box { text-align: center; width: 45%; }
        .signature-line { border-top: 1px solid #000; margin-top: 60px; padding-top: 5px; font-size: 12px; }
        
        /* Footer */
        .footer { text-align: center; padding: 10px 20px; border-top: 2px solid #000; font-size: 11px; }
        .footer .thanks { font-weight: bold; margin-bottom: 3px; }
        
        /* Print */
        @media print {
            body { padding: 0; }
            .invoice { border: 1px solid #000; }
            .no-print { display: none; }
        }
        
        .print-btn { display: block; margin: 20px auto; padding: 10px 30px; background: #000; color: #fff; border: none; font-size: 14px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="invoice">
        <!-- Header -->
        <div class="header">
            @if($company->company_logo)
                <div class="logo">
                    <img src="{{ asset('uploads/company/' . $company->company_logo) }}" alt="{{ $company->company_name }}">
                </div>
            @endif
            <div class="company-name">{{ $company->company_name ?? 'কোম্পানির নাম' }}</div>
            <div class="company-address">{{ $company->address1 ?? '' }}{{ $company->address2 ? ', ' . $company->address2 : '' }}</div>
            <div class="company-phone">মোবাইল: {{ $company->phone1 ?? '' }}@if($company->phone2) | {{ $company->phone2 }}@endif</div>
            @if($company->email1)
                <div class="company-phone">ইমেইল: {{ $company->email1 }}</div>
            @endif
        </div>
        
        <!-- Invoice Info -->
        <div class="invoice-info">
            <div>
                <strong>ইনভয়েস নম্বর:</strong> {{ $order->order_number }}
            </div>
            <div style="text-align: right;">
                <strong>তারিখ:</strong> {{ $order->created_at->format('d/m/Y') }}
            </div>
        </div>
        
        <!-- Customer Info -->
        <div class="customer-info">
            <div class="row">
                <span class="label">নাম:</span>
                <span>{{ $order->customer_name }}</span>
            </div>
            <div class="row">
                <span class="label">মোবাইল:</span>
                <span>{{ $order->customer_phone }}</span>
            </div>
            <div class="row">
                <span class="label">ঠিকানা:</span>
                <span>{{ $order->address }}, {{ $order->upazila->name ?? '' }}, {{ $order->district->name ?? '' }}, {{ $order->division->name ?? '' }}</span>
            </div>
        </div>
        
        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>পণ্যের নাম</th>
                    <th>পরিমাণ</th>
                    <th>একক মূল্য</th>
                    <th>মোট</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'পণ্য' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>৳ {{ number_format($item->price, 2) }}</td>
                    <td>৳ {{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Summary -->
        <div class="summary">
            <div class="summary-row">
                <span>উপমোট:</span>
                <span>৳ {{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="summary-row">
                <span>ডেলিভারি চার্জ:</span>
                <span>৳ {{ number_format($order->delivery_fee, 2) }}</span>
            </div>
            <div class="summary-row total">
                <span>সর্বমোট:</span>
                <span>৳ {{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
        
        <!-- Payment Method -->
        <div style="padding: 10px 20px; border-top: 1px solid #000; font-size: 13px;">
            <strong>পেমেন্ট মেথড:</strong> ক্যাশ অন ডেলিভারি (COD)
        </div>
        
        <!-- Signature -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-line">ক্রেতার স্বাক্ষর</div>
            </div>
            <div class="signature-box">
                <div class="signature-line">বিক্রেতার স্বাক্ষর / সিল</div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="thanks">ধন্যবাদ!</div>
            <div>{{ $company->company_name ?? '' }}</div>
        </div>
    </div>
    
    <button class="print-btn no-print" onclick="window.print()">প্রিন্ট / সেভ করুন</button>
</body>
</html>
