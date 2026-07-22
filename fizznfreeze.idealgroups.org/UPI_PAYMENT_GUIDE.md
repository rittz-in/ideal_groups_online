# UPI QR Code Payment System

## Overview
This system implements UPI (Unified Payments Interface) QR code-based payments for the restaurant order management system. Customers can scan QR codes to make payments directly through their UPI apps.

## Features Implemented

### 1. Order Payment with UPI QR Code
**Location:** `http://127.0.0.1:8001/app/orders/view/{order_id}`

When viewing an order with unpaid status:
- Select "UPI" as the payment method
- Click "Make Payment"
- A QR code will be generated with:
  - Order amount
  - Order number
  - Merchant UPI ID
  - Merchant name
- Customer scans the QR code with any UPI app (Google Pay, PhonePe, Paytm, etc.)
- After payment, click "Payment Completed" to mark the order as paid

### 2. Dynamic QR Code Generation
**Location:** `http://127.0.0.1:8001/app/tables/payment-qr`

This page allows you to:
- **Generate Dynamic UPI QR Codes** with or without fixed amounts
  - With Amount: Customer pays the exact specified amount
  - Without Amount: Customer can enter any amount
- **Upload Static QR Code Images** (optional)
- **Configure UPI Settings**:
  - UPI ID (VPA) - e.g., yourname@okaxis
  - Merchant Name - e.g., Your Restaurant Name

## Setup Instructions

### 1. Configure UPI Settings
1. Go to `http://127.0.0.1:8001/app/tables/payment-qr`
2. In the "Upload Custom Static QR Code" section:
   - Enter your **UPI ID (VPA)** - This is your merchant UPI address
   - Enter your **Merchant Name** - Your restaurant or business name
3. Click "Save Settings"

### 2. Usage Scenarios

#### Scenario A: Order Payment
1. Create an order in the system
2. Go to Order View page
3. Select "UPI" as payment method
4. Click "Make Payment"
5. Show the generated QR code to the customer
6. Customer scans and completes payment
7. Click "Payment Completed" button

#### Scenario B: General Payment Collection
1. Go to Payment QR page
2. Enter amount (optional)
3. Click "Generate QR Code"
4. Show QR to customer
5. Customer scans and pays
6. Download QR code if needed for display

## Technical Details

### Files Created/Modified

**New Files:**
- `app/Services/UpiPaymentService.php` - Core UPI QR generation service

**Modified Files:**
- `routes/web.php` - Added UPI payment routes
- `app/Http/Controllers/apps/OrdersController.php` - Added generateUpiQr() method
- `app/Http/Controllers/apps/TablesController.php` - Added generatePaymentQr() method
- `resources/views/content/apps/orders/view.blade.php` - Updated payment UI
- `resources/views/content/apps/tables/payment-qr.blade.php` - Enhanced QR generation page

### API Endpoints

**Generate Order Payment QR:**
```
GET /app/orders/generate-upi-qr/{encrypted_id}
```

**Generate Dynamic Payment QR:**
```
POST /app/tables/generate-payment-qr
Body: { amount: number (optional) }
```

### UPI URL Format
The system generates UPI deep links in the standard format:
```
upi://pay?pa={UPI_ID}&pn={MERCHANT_NAME}&am={AMOUNT}&cu=INR&tn={NOTE}
```

### QR Code Library
Uses `chillerlan/php-qrcode` (already installed) for generating QR codes.

## Testing

### Test the Order Payment Flow:
1. Ensure UPI settings are configured
2. Create a test order
3. Go to order view page
4. Select UPI payment method
5. Click "Make Payment"
6. Verify QR code displays with correct details
7. Test with a real UPI app (optional)

### Test Dynamic QR Generation:
1. Go to payment-qr page
2. Generate QR with amount (e.g., 100)
3. Verify QR displays correctly
4. Generate QR without amount
5. Download QR code

## Important Notes

1. **UPI ID Configuration**: The system requires a valid UPI ID to be configured in the payment settings before generating QR codes.

2. **QR Code Formats**:
   - With Amount: Payment apps will show pre-filled amount
   - Without Amount: Customer can enter any amount

3. **Payment Verification**: The system currently uses manual verification (staff confirms payment received). For automatic verification, you would need to integrate with a payment gateway API.

4. **Currency**: Currently set to INR (Indian Rupees). Modify in UpiPaymentService if needed.

## Future Enhancements

- Integration with payment gateway for automatic payment verification
- Payment status webhook handling
- Payment history tracking
- Multi-currency support
- QR code customization (colors, logo)

## Support

For issues or questions, check:
- UPI ID is correctly configured
- Browser console for JavaScript errors
- Laravel logs: `storage/logs/laravel.log`
