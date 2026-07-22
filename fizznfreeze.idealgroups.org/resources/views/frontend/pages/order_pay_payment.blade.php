@extends('frontend.layouts.new-app')

@section('title', 'Fizz & Freeze - Cafe')

@section('content')
<div class="min-h-screen flex flex-col pb-24">
    @include('frontend.partials.page-header', [
        'backHref'  => route('product', ['category' => 'all']),
        'backLabel' => 'Back to Menu',
        'icon'      => '💳',
        'title'     => 'Make Payment',
        'subtitle'  => 'Order #' . $order->order_number,
        'waveColor' => '#f8f9ff',
    ])


    <!-- Content -->
    <div class="flex-1 px-4 -mt-4">
        <div class="max-w-md mx-auto">
            
            <!-- Order Summary Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">1</span>
                    Order Summary
                </h2>
                
                <div class="space-y-3 mb-4">
                    @foreach($order->items as $item)
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                        <div class="flex items-center">
                            <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-xs mr-3">{{ $item->quantity }}</span>
                            <span class="text-gray-800">{{ $item->product_name }}</span>
                        </div>
                        <span class="font-semibold text-gray-800">₹{{ number_format($item->total, 2) }}</span>
                    </div>
                    @endforeach
                </div>
                
                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->tax > 0)
                    <div class="flex justify-between text-gray-600">
                        <span>Tax</span>
                        <span>₹{{ number_format($order->tax, 2) }}</span>
                    </div>
                    @endif
                    @if($order->discount > 0)
                    <div class="flex justify-between text-green-600">
                        <span>Discount</span>
                        <span>-₹{{ number_format($order->discount, 2) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between text-lg font-bold text-gray-800">
                        <span>Total</span>
                        <span class="text-primary">₹{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <!-- Payment Status Badge -->
                <div class="mt-4 p-3 rounded-xl {{ $order->payment_status === 'paid' ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }}">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium {{ $order->payment_status === 'paid' ? 'text-green-700' : 'text-yellow-700' }}">
                            Payment Status
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm font-bold {{ $order->payment_status === 'paid' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>

            @if($order->payment_status !== 'paid')
            <!-- Payment Method Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">2</span>
                    Payment Method
                </h2>
                
                <div class="space-y-3">
                    <label class="flex items-center p-4 border-2 border-primary rounded-xl cursor-pointer bg-red-50 transition-all duration-200" id="cash-option">
                        <input type="radio" name="payment" value="cash" checked class="w-5 h-5 text-primary" onchange="togglePaymentMethod()">
                        <div class="ml-3">
                            <p class="font-semibold text-gray-800">Pay at Table</p>
                            <p class="text-sm text-gray-500">Pay with cash or card when served</p>
                        </div>
                        <span class="ml-auto text-2xl">💵</span>
                    </label>

                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary transition-all duration-200" id="qr-option-label">
                        <input type="radio" name="payment" value="qr" class="w-5 h-5 text-primary" onchange="togglePaymentMethod()">
                        <div class="ml-3">
                            <p class="font-semibold text-gray-800">Pay via QR</p>
                            <p class="text-sm text-gray-500">Scan and pay now for faster service</p>
                        </div>
                        <span class="ml-auto text-2xl">📱</span>
                    </label>

                    <!-- QR Code Container -->
                    <div id="qr-container" class="hidden animate-fade-in">
                        <div class="bg-gray-50 rounded-2xl p-6 text-center border-2 border-dashed border-gray-200">
                            <!-- Loading state -->
                            <div id="qr-loading" class="py-8">
                                <div class="w-10 h-10 border-4 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-3"></div>
                                <p class="text-sm text-gray-500">Generating QR Code...</p>
                            </div>
                            <!-- QR content (filled by JS) -->
                            <div id="qr-content" class="hidden">
                                <p class="text-sm text-gray-600 mb-3 font-medium" id="qr-scan-text">Scan to Pay</p>
                                <img id="qr-image" src="" alt="UPI QR Code"
                                     class="mx-auto shadow-lg rounded-xl mb-2 border-4 border-white"
                                     style="max-width: 220px; width: 100%;">
                                <p class="text-[10px] text-primary font-bold animate-pulse mt-1">Tap image to pay with UPI App</p>
                                <div class="mt-3 text-left bg-white rounded-xl p-3 border border-gray-200 text-sm space-y-1">
                                    <p><span class="text-gray-500">Amount:</span> <span class="font-bold text-primary" id="qr-amount"></span></p>
                                    <p><span class="text-gray-500">Order:</span> <span class="font-semibold" id="qr-order"></span></p>
                                    <p><span class="text-gray-500">UPI ID:</span> <span class="font-semibold" id="qr-upi"></span></p>
                                    <p><span class="text-gray-500">Merchant:</span> <span class="font-semibold" id="qr-merchant"></span></p>
                                </div>
                                <p class="text-xs text-gray-400 mt-3">Scan with any UPI app to make payment</p>

                                {{-- After paying, customer submits UTR --}}
                                <div id="utr-form" class="mt-4 text-left">
                                    <p class="text-xs font-semibold text-gray-600 mb-1">After payment, enter your UTR / Transaction ID:</p>
                                    <p class="text-[10px] text-gray-400 mb-2">(Open your UPI app → Payment History → copy the 12-digit UTR/Ref No.)</p>
                                    <input id="utr-input" type="text" maxlength="25"
                                           placeholder="e.g. 123456789012"
                                           class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary mb-2">
                                    <p id="utr-error" class="text-xs text-red-500 hidden mb-2"></p>
                                    <button id="utr-submit-btn" onclick="markAsPaid('upi')"
                                            class="w-full bg-green-500 hover:bg-green-600 active:scale-95 transition-all text-white font-bold py-3 px-6 rounded-2xl shadow text-sm">
                                        ✅ I've Paid — Submit
                                    </button>
                                </div>

                                {{-- Success banner (shown after submission) --}}
                                <div id="utr-success" class="hidden mt-4 bg-green-50 border border-green-300 rounded-2xl p-4 text-center">
                                    <div class="text-3xl mb-2">🎉</div>
                                    <p class="text-green-700 font-bold text-sm">Payment Submitted!</p>
                                    <p class="text-green-600 text-xs mt-1">Our staff will verify your payment shortly and confirm your order.</p>
                                    <p class="text-gray-400 text-[10px] mt-2" id="utr-submitted-ref"></p>
                                </div>
                            </div>
                            <!-- Error state -->
                            <div id="qr-error" class="hidden py-6">
                                <p class="text-red-500 font-medium" id="qr-error-msg">Failed to load QR code.</p>
                                <button onclick="showUpiQrCode()" class="mt-3 text-sm text-primary underline">Retry</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-blue-50 rounded-2xl p-4 border border-blue-200">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-blue-700 font-medium">Payment Instructions</p>
                        <p class="text-sm text-blue-600 mt-1">
                            If paying via QR, please show the payment confirmation to our staff. 
                            For cash payments, our staff will collect payment at your table.
                        </p>
                    </div>
                </div>
            </div>
            @else
            <!-- Payment Complete Card -->
            <div class="bg-green-50 rounded-2xl p-6 border border-green-200 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-green-800 mb-2">Payment Complete!</h3>
                <p class="text-green-600">Thank you for your payment.</p>
                @if($order->payment_method)
                <p class="text-sm text-green-500 mt-2">Paid via {{ ucfirst($order->payment_method) }}</p>
                @endif
            </div>
            @endif

        </div>
    </div>

    <!-- Fixed Bottom Button -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 z-50">
        <div class="max-w-md mx-auto">
            <a href="{{ route('product', ['category' => 'all']) }}"
               class="w-full bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 px-6 rounded-2xl shadow-lg flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Back to Menu
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

   
function togglePaymentMethod() {
    const selectedMethod = document.querySelector('input[name="payment"]:checked')?.value;
    const qrContainer = document.getElementById('qr-container');
    const qrLabel = document.getElementById('qr-option-label');
    const cashLabel = document.getElementById('cash-option');

    if (!qrContainer || !qrLabel || !cashLabel) return;

    if (selectedMethod === 'qr') {
        qrContainer.classList.remove('hidden');
        qrLabel.classList.add('border-primary', 'bg-red-50');
        qrLabel.classList.remove('border-gray-200');
        cashLabel.classList.remove('border-primary', 'bg-red-50');
        cashLabel.classList.add('border-gray-200');
        showUpiQrCode();
    } else {
        qrContainer.classList.add('hidden');
        cashLabel.classList.add('border-primary', 'bg-red-50');
        cashLabel.classList.remove('border-gray-200');
        qrLabel.classList.remove('border-primary', 'bg-red-50');
        qrLabel.classList.add('border-gray-200');
    }
}

    function showUpiQrCode() {
        // Reset states
        document.getElementById('qr-loading').classList.remove('hidden');
        document.getElementById('qr-content').classList.add('hidden');
        document.getElementById('qr-error').classList.add('hidden');
        document.getElementById('utr-form').classList.remove('hidden');
        document.getElementById('utr-success').classList.add('hidden');
        document.getElementById('utr-input').value = '';
        document.getElementById('utr-error').classList.add('hidden');
        document.getElementById('utr-submit-btn').disabled = false;

        $.ajax({
            url: "{{ route('order-pay-payment-upi-qr', encrypt($order->id)) }}",
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    displayUpiQrInline(response.data);
                } else {
                    document.getElementById('qr-loading').classList.add('hidden');
                    document.getElementById('qr-error-msg').textContent = response.message || 'Failed to generate QR code.';
                    document.getElementById('qr-error').classList.remove('hidden');
                }
            },
            error: function(xhr) {
                document.getElementById('qr-loading').classList.add('hidden');
                document.getElementById('qr-error-msg').textContent = xhr.responseJSON?.message || 'Failed to generate QR code.';
                document.getElementById('qr-error').classList.remove('hidden');
            }
        });
    }

    function markAsPaid(method) {
        const utrInput = document.getElementById('utr-input');
        const utrError = document.getElementById('utr-error');
        const submitBtn = document.getElementById('utr-submit-btn');
        const utr = utrInput.value.trim();

        // Client-side validation
        utrError.classList.add('hidden');
        if (!utr) {
            utrError.textContent = 'Please enter your UTR / Transaction ID.';
            utrError.classList.remove('hidden');
            utrInput.focus();
            return;
        }
        if (utr.length < 6) {
            utrError.textContent = 'UTR must be at least 6 characters.';
            utrError.classList.remove('hidden');
            return;
        }
        if (!/^[A-Za-z0-9]+$/.test(utr)) {
            utrError.textContent = 'UTR must contain only letters and numbers.';
            utrError.classList.remove('hidden');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';

        $.ajax({
            url: "{{ route('order-confirm-upi-payment', encrypt($order->id)) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                utr_number: utr,
            },
            success: function(response) {
                if (response.success) {
                    document.getElementById('utr-form').classList.add('hidden');
                    document.getElementById('utr-submitted-ref').textContent = 'UTR Ref: ' + utr.toUpperCase();
                    document.getElementById('utr-success').classList.remove('hidden');
                    // Clear the cart after successful payment submission
                    if (typeof CartManager !== 'undefined') {
                        CartManager.clearCart();
                    }
                } else {
                    utrError.textContent = response.message;
                    utrError.classList.remove('hidden');
                    submitBtn.disabled = false;
                    submitBtn.textContent = '✅ I\'ve Paid — Submit';
                }
            },
            error: function(xhr) {
                utrError.textContent = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
                utrError.classList.remove('hidden');
                submitBtn.disabled = false;
                submitBtn.textContent = '✅ I\'ve Paid — Submit';
            }
        });
    }

    function displayUpiQrInline(data) {
        const img = document.getElementById('qr-image');
        img.src = data.qr_code;
        img.onclick = function() {
            window.location.href = `upi://pay?pa=${data.upi_id}&pn=${encodeURIComponent(data.merchant_name)}&am=${parseFloat(data.amount).toFixed(2)}&cu=INR`;
        };
        img.style.cursor = 'pointer';

        document.getElementById('qr-scan-text').textContent = `Scan to Pay ₹${parseFloat(data.amount).toFixed(2)}`;
        document.getElementById('qr-amount').textContent = `₹${parseFloat(data.amount).toFixed(2)}`;
        document.getElementById('qr-order').textContent = `#${data.order_number}`;
        document.getElementById('qr-upi').textContent = data.upi_id;
        document.getElementById('qr-merchant').textContent = data.merchant_name;

        document.getElementById('qr-loading').classList.add('hidden');
        document.getElementById('qr-content').classList.remove('hidden');
    }


</script>
@endpush
