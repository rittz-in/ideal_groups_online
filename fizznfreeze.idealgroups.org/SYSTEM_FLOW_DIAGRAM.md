# UPI Payment Flow Diagram

## 📊 System Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                    UPI PAYMENT SYSTEM                           │
└─────────────────────────────────────────────────────────────────┘

┌────────────────────┐
│  Payment Settings  │
│  (/tables/        │
│   payment-qr)      │
└──────────┬─────────┘
           │
           │ 1. Configure UPI ID & Merchant Name
           │
           ▼
┌───────────────────────────────┐
│   UpiPaymentService.php       │
│                               │
│  - generateUpiUrl()           │
│  - generateQrCode()           │
│  - generateOrderPaymentQr()   │
│  - generateGenericPaymentQr() │
└───────────┬───────────────────┘
            │
            │ 2. Generate QR Code
            │
    ┌───────┴────────┐
    │                │
    ▼                ▼
┌─────────┐    ┌──────────────┐
│ Order   │    │ Dynamic QR   │
│ Payment │    │ Generator    │
└─────────┘    └──────────────┘
```

---

## 🔄 Flow 1: Order Payment

```
[Customer] ──> [Order Created] ──> [View Order Page]
                                          │
                                          │ Staff selects UPI
                                          ▼
                                  [Click "Make Payment"]
                                          │
                                          │ AJAX Call
                                          ▼
                        ┌─────────────────────────────┐
                        │ OrdersController            │
                        │ generateUpiQr()             │
                        └──────────┬──────────────────┘
                                   │
                                   │ Calls
                                   ▼
                        ┌─────────────────────────────┐
                        │ UpiPaymentService           │
                        │ - Get UPI ID from DB        │
                        │ - Create UPI URL            │
                        │ - Generate QR Code          │
                        └──────────┬──────────────────┘
                                   │
                                   │ Returns QR Data
                                   ▼
                        ┌─────────────────────────────┐
                        │ JavaScript displays:        │
                        │ - QR Code Image             │
                        │ - Amount: ₹XXX              │
                        │ - Order: #12345             │
                        │ - UPI ID                    │
                        │ - Merchant Name             │
                        └──────────┬──────────────────┘
                                   │
                   [Customer Scans QR with UPI App]
                                   │
                                   ▼
                        ┌─────────────────────────────┐
                        │ Payment Done Outside System │
                        │ (Google Pay/PhonePe/etc)    │
                        └──────────┬──────────────────┘
                                   │
                      [Staff Confirms Payment Received]
                                   │
                                   ▼
                        ┌─────────────────────────────┐
                        │ Click "Payment Completed"   │
                        └──────────┬──────────────────┘
                                   │
                                   │ AJAX Call
                                   ▼
                        ┌─────────────────────────────┐
                        │ OrdersController            │
                        │ updatePayment()             │
                        │ - Mark as paid              │
                        │ - Set method = 'upi'        │
                        │ - Complete order            │
                        └──────────┬──────────────────┘
                                   │
                                   ▼
                              [Order Paid ✅]
```

---

## 🔄 Flow 2: Dynamic QR Generation

```
[Staff] ──> [Navigate to /tables/payment-qr]
                        │
                        │ View Page
                        ▼
            ┌────────────────────────────┐
            │ Payment QR Management Page │
            │                            │
            │ Left: Generate Dynamic QR  │
            │ Right: Configure Settings  │
            └─────────────┬──────────────┘
                          │
                          │ Enter Amount (optional)
                          ▼
                 [Click "Generate QR Code"]
                          │
                          │ AJAX Call
                          ▼
            ┌─────────────────────────────┐
            │ TablesController            │
            │ generatePaymentQr()         │
            └──────────┬──────────────────┘
                       │
                       │ Calls
                       ▼
            ┌─────────────────────────────┐
            │ UpiPaymentService           │
            │ generateGenericPaymentQr()  │
            │                             │
            │ If amount provided:         │
            │   QR with fixed amount      │
            │ If no amount:               │
            │   QR without amount         │
            └──────────┬──────────────────┘
                       │
                       │ Returns QR Data
                       ▼
            ┌─────────────────────────────┐
            │ JavaScript displays:        │
            │ - QR Code Image             │
            │ - Amount (if set)           │
            │ - UPI Details               │
            │ - Download Button           │
            └──────────┬──────────────────┘
                       │
                       │ Optional
                       ▼
              [Download as PNG]
                       │
                       ▼
              [Print/Display QR]
```

---

## 🗄️ Database Flow

```
┌─────────────────────┐
│ payment_settings    │
│ ─────────────────── │
│ id                  │
│ key                 │  ◄─── 'payment_upi_id'
│ value               │  ◄─── 'yourname@okaxis'
│ created_at          │
│ updated_at          │
└─────────┬───────────┘
          │
          │ Stores:
          │ - payment_upi_id
          │ - payment_merchant_name
          │ - payment_qr_code (optional static image)
          │
          ▼
    [Used by UpiPaymentService]
```

---

## 📡 API Endpoints

```
┌─────────────────────────────────────────────────────────┐
│  GET  /app/orders/generate-upi-qr/{encrypted_id}        │
│  ─────────────────────────────────────────────────────  │
│  Controller: OrdersController@generateUpiQr             │
│  Purpose: Generate QR for specific order                │
│  Input: Encrypted order ID                              │
│  Output: {                                              │
│    success: true,                                       │
│    data: {                                              │
│      upi_id: "...",                                     │
│      merchant_name: "...",                              │
│      amount: 100.00,                                    │
│      order_number: "ORD-12345",                         │
│      upi_url: "upi://pay?...",                          │
│      qr_code: "data:image/png;base64,..."               │
│    }                                                    │
│  }                                                      │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│  POST /app/tables/generate-payment-qr                   │
│  ─────────────────────────────────────────────────────  │
│  Controller: TablesController@generatePaymentQr         │
│  Purpose: Generate dynamic QR with/without amount       │
│  Input: { amount: 100 } (optional)                      │
│  Output: {                                              │
│    success: true,                                       │
│    data: {                                              │
│      upi_id: "...",                                     │
│      merchant_name: "...",                              │
│      amount: 100.00 or null,                            │
│      upi_url: "upi://pay?...",                          │
│      qr_code: "data:image/png;base64,..."               │
│    }                                                    │
│  }                                                      │
└─────────────────────────────────────────────────────────┘
```

---

## 🎨 UI Components

```
┌────────────────────────────────────────────────────────────┐
│  ORDER VIEW PAGE (/app/orders/view/{id})                  │
├────────────────────────────────────────────────────────────┤
│                                                            │
│  Order Details        │  Payment Details                  │
│  ─────────────        │  ────────────────                 │
│  • Items              │  Status: [Unpaid]                 │
│  • Amounts            │  Method: [Cash ▼]                 │
│                       │          [Card  ]                 │
│                       │          [UPI   ] ◄── Select this │
│                       │                                    │
│                       │  [Make Payment] ◄── Click this    │
│                       │                                    │
└────────────────────────────────────────────────────────────┘
                            │
                            │ Click triggers
                            ▼
┌────────────────────────────────────────────────────────────┐
│  MODAL POPUP: UPI Payment                                  │
├────────────────────────────────────────────────────────────┤
│                                                            │
│              ┌─────────────────┐                          │
│              │                 │                          │
│              │   [QR CODE]     │                          │
│              │                 │                          │
│              └─────────────────┘                          │
│                                                            │
│  Amount: ₹100.00                                          │
│  Order: #ORD-12345                                        │
│  UPI ID: restaurant@paytm                                 │
│  Merchant: Your Restaurant                                │
│                                                            │
│  Scan this QR code with any UPI app                       │
│                                                            │
│  [✓ Payment Completed]  [Cancel]                          │
└────────────────────────────────────────────────────────────┘
```

```
┌────────────────────────────────────────────────────────────┐
│  PAYMENT QR PAGE (/app/tables/payment-qr)                 │
├────────────────────────────────────────────────────────────┤
│                                                            │
│  LEFT COLUMN              │  RIGHT COLUMN                  │
│  ────────────             │  ─────────────                 │
│                           │                                │
│  Generate Dynamic UPI QR  │  Current Static QR Code        │
│  ┌──────────────────────┐ │  ┌────────────────────┐       │
│  │ Amount: [____] ₹     │ │  │  [QR Image]        │       │
│  │ [Generate QR Code]   │ │  │  UPI: xxx@bank     │       │
│  └──────────────────────┘ │  │  Name: Restaurant  │       │
│                           │  │  [Delete Static QR]│       │
│  Generated QR Code        │  └────────────────────┘       │
│  ┌──────────────────────┐ │                                │
│  │   [QR Display]       │ │  Upload Custom Static QR       │
│  │   Details shown      │ │  ┌────────────────────┐       │
│  │   [Download QR]      │ │  │ UPI ID: [_______] │       │
│  └──────────────────────┘ │  │ Merchant: [_____] │       │
│                           │  │ File: [Choose]    │       │
│                           │  │ [Save Settings]   │       │
│                           │  └────────────────────┘       │
└────────────────────────────────────────────────────────────┘
```

---

## 🔐 Security

```
Order URLs use encryption:
/app/orders/view/{encrypted_id}
                  └─── decrypt() in controller
                       └─── prevents direct ID access
```

---

## 📦 Package Dependencies

```
composer.json
│
├─ chillerlan/php-qrcode (v5.0) ✅ Already installed
│  └─ Used for QR code generation
│
└─ No additional packages needed!
```

---

## 🧪 Testing Flow

```
1. Setup Phase
   └─> Configure UPI ID
       └─> Configure Merchant Name
           └─> Save Settings ✅

2. Order Payment Test
   └─> Create/View Order
       └─> Select UPI
           └─> Click Make Payment
               └─> Verify QR displays
                   └─> Scan with phone
                       └─> Verify payment details
                           └─> Click Payment Completed ✅

3. Dynamic QR Test
   └─> Go to Payment QR page
       └─> Enter amount (e.g., 100)
           └─> Click Generate
               └─> Verify QR displays
                   └─> Download QR
                       └─> Verify downloaded file ✅

4. Flexible Amount Test
   └─> Go to Payment QR page
       └─> Leave amount empty
           └─> Click Generate
               └─> Verify QR displays without amount
                   └─> Scan and verify customer can enter amount ✅
```

---

## 📊 Success Metrics

```
✅ Order payment with UPI works
✅ QR code generates correctly
✅ Amount is properly formatted
✅ QR is scannable
✅ Dynamic QR generation works
✅ Download functionality works
✅ Settings persist
✅ No syntax errors
✅ No breaking changes
```

---

**All systems operational! 🚀**
