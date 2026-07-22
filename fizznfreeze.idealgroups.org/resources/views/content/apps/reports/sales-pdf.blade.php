<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .summary { margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            @if($logoBase64)
                <img src="{{ $logoBase64 }}" alt="Logo" style="height: 50px;">
            @endif
        </div>
        <h2 style="margin: 5px 0;">Fizz & Freeze</h2>
        <p style="font-size: 14px; margin-top: 0;">Where Every Bite Tells a Story</p>
        <!-- <div style="font-size: 11px; margin-top: 5px; color: #555;">
            C S SQUARE, Fizz & Freeze<br>
            Shop Number -08 Near Galaxy Hospital,<br>
            Sun Pharma Road, Near Mahraj Chokdi,<br>
            Vadodara - 390012
        </div> -->
        <hr style="border: 1px dashed #ddd; margin: 15px 0;">
        <h3>Sales Report</h3>
        <p> {{ ucfirst($filter_type) }} 
           @if($filter_type == 'custom') ({{ $start_date }} to {{ $end_date }}) @endif
           <br/> Category: {{ ucfirst($category) }}
        </p>
        <p>Generated on: {{ now()->format('d M Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->order_number }}</td>
                <td>{{ $row->customer_name }}</td>
                <td>{{ $row->product_name }}</td>
                <td>{{ number_format($row->price, 2) }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ number_format($row->total, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Quantity:</strong> {{ number_format($total_qty) }}</p>
        <p><strong>Total Sales:</strong> {{ number_format($total_sales, 2) }}</p>
    </div>
</body>
</html>
