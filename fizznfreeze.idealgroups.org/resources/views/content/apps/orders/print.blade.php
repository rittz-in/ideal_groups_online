<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt - {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Courier New', monospace;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background: white;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .logo { margin-bottom: 10px; }
        .logo img { height: 50px; }
        .order-info {
            margin-bottom: 15px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .items { margin: 15px 0; }
        .item {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }
        .item-name { flex: 1; }
        .item-qty { width: 40px; text-align: center; }
        .item-price { width: 70px; text-align: right; }
        .total-section {
            border-top: 2px dashed #000;
            padding-top: 10px;
            margin-top: 15px;
        }
        .total { font-size: 18px; font-weight: bold; }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px dashed #000;
        }
        @page {
            size: auto;
            margin: 0mm;
        }
        @media print {
            body { 
                max-width: 100%; 
                margin: 0;
                padding: 10px;
            }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('assets/img/fizzfavicon.svg') }}" alt="Logo">
        </div>
        <p style="font-weight: bold;">Fizz & Freeze</p>
        <p style="font-size: 14px;">Where Every Bite Tells a Story</p>
        <div style="font-size: 12px; margin-top: 5px; line-height: 1.4;">
            C S SQUARE, Fizz & Freeze<br>
            Shop Number -08 Near Galaxy Hospital,<br>
            Sun Pharma Road, Near Mahraj Chokdi,<br>
            Vadodara - 390012
        </div>
    </div>

    <div class="order-info">
        <div class="row">
            <span>Order #:</span>
            <strong>{{ $order->order_number }}</strong>
        </div>
        <div class="row">
            <span>Date:</span>
            <span>{{ $order->created_at->format('d/m/Y h:i A') }}</span>
        </div>
        <div class="row">
            <span>Table:</span>
            <strong>{{ $order->table_number }}</strong>
        </div>
        <div class="row">
            <span>Customer:</span>
            <span>{{ $order->customer_name }}</span>
        </div>
    </div>

    <div class="divider"></div>

    <div class="items">
        <div class="item" style="font-weight: bold;">
            <span class="item-name">Item</span>
            <span class="item-qty">Qty</span>
            <span class="item-price">Price</span>
        </div>
        <div class="divider"></div>
        @foreach($order->items as $item)
        @if($item->status !== 'cancelled')
        <div class="item">
            <span class="item-name">{{ $item->product_name }}</span>
            <span class="item-qty">{{ $item->quantity }}</span>
            <span class="item-price">₹{{ number_format($item->total, 2) }}</span>
        </div>
        @if($item->special_instructions)
        <div style="font-size: 12px; color: #666; margin-left: 10px;">
            → {{ $item->special_instructions }}
        </div>
        @endif
        @endif
        @endforeach
    </div>

    <div class="total-section">
        <div class="row">
            <span>Subtotal:</span>
            <span>₹{{ number_format($order->subtotal, 2) }}</span>
        </div>
        @if($order->tax > 0)
        <div class="row">
            <span>Tax:</span>
            <span>₹{{ number_format($order->tax, 2) }}</span>
        </div>
        @endif
        @if($order->discount > 0)
        <div class="row">
            <span>Discount:</span>
            <span>-₹{{ number_format($order->discount, 2) }}</span>
        </div>
        @endif
        <div class="divider"></div>
        <div class="row total">
            <span>TOTAL:</span>
            <span>₹{{ number_format($order->total, 2) }}</span>
        </div>
        <div class="row" style="margin-top: 10px;">
            <span>Payment:</span>
            <span>{{ ucfirst($order->payment_status) }} {{ $order->payment_method ? '(' . ucfirst($order->payment_method) . ')' : '' }}</span>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for dining with us!</p>
        <p style="font-size: 12px; margin-top: 10px;">Visit again soon ❤️</p>
    </div>

    <div class="no-print" style="margin-top: 30px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 30px; font-size: 16px; cursor: pointer;">
            🖨️ Print Receipt
        </button>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
