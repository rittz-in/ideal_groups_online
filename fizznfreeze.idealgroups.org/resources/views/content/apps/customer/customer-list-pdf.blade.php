<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer List</title>
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
        <p style="font-size: 10px; margin-top: 0;">Where Every Bite Tells a Story</p>

        <p style="font-size: 10px; margin-left: 70%;">Generated on: {{ now()->format('d M Y h:i A') }}</p>

        <hr style="border: 1px dashed #ddd; margin: 15px 0;">
        <h3>Customer List</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">Sr. No</th>
                <th>Customer Name</th>
                <th>Mobile Number</th>
                <th>Last Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $index => $customer)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->customer_mobile }}</td>
                <td>{{ $customer->last_order_date ? \Carbon\Carbon::parse($customer->last_order_date)->format('d M Y h:i A') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Customers:</strong> {{ number_format($customers->count()) }}</p>
    </div>
</body>
</html>