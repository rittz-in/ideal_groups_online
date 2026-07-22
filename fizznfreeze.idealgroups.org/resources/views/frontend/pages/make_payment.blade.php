@extends('frontend.layouts.new-app')

@section('title', 'Fizz & Freeze - Cafe')

@section('content')
    <div class="min-h-screen flex flex-col pb-24">
        @include('frontend.partials.page-header', [
            'backHref' => route('product', ['category' => 'all']),
            'backLabel' => 'Back to Menu',
            'icon' => '💳',
            'title' => 'Make Payment',
            'subtitle' => 'Order #' . $order->order_number,
            'waveColor' => '#f8f9ff',
        ])


        <!-- Content -->
        <div class="flex-1 px-4 -mt-4">
            <div class="max-w-md mx-auto">

                <!-- Order Summary Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <span
                            class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">1</span>
                        Order Summary
                    </h2>

                    <div class="space-y-3 mb-4">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                                <div class="flex items-center">
                                    <span
                                        class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-xs mr-3">{{ $item->quantity }}</span>
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
                        @if ($order->tax > 0)
                            <div class="flex justify-between text-gray-600">
                                <span>Tax</span>
                                <span>₹{{ number_format($order->tax, 2) }}</span>
                            </div>
                        @endif
                        @if ($order->discount > 0)
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
                    <div
                        class="mt-4 p-3 rounded-xl {{ $order->payment_status === 'paid' ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }}">
                        <div class="flex items-center justify-between">
                            <span
                                class="text-sm font-medium {{ $order->payment_status === 'paid' ? 'text-green-700' : 'text-yellow-700' }}">
                                Payment Status
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-sm font-bold {{ $order->payment_status === 'paid' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>

                @if ($order->payment_status !== 'paid')
                    <!-- Payment Method Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                        <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <span
                                class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">2</span>
                            Payment Method
                        </h2>

                        <div class="space-y-3">
                            <label
                                class="flex items-center p-4 border-2 border-primary rounded-xl cursor-pointer bg-red-50 transition-all duration-200"
                                id="cash-option">
                                <input type="radio" name="payment" value="cash" checked class="w-5 h-5 text-primary"
                                    onchange="togglePaymentMethod()">
                                <div class="ml-3">
                                    <p class="font-semibold text-gray-800">Pay at Table</p>
                                    <p class="text-sm text-gray-500">Pay with cash or card when served</p>
                                </div>
                                <span class="ml-auto text-2xl">💵</span>
                            </label>

                            <label
                                class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary transition-all duration-200"
                                id="qr-option-label">
                                <input type="radio" name="payment" value="qr" class="w-5 h-5 text-primary"
                                    onchange="togglePaymentMethod()">
                                <div class="ml-3">
                                    <p class="font-semibold text-gray-800">Pay via QR</p>
                                    <p class="text-sm text-gray-500">Scan and pay now for faster service</p>
                                </div>
                                <span class="ml-auto text-2xl">📱</span>
                            </label>

                            @php
                                $upiId = \App\Models\PaymentSetting::getVal('payment_upi_id', '');
                                $merchantName = \App\Models\PaymentSetting::getVal(
                                    'payment_merchant_name',
                                    'Fizz & Freeze Cafe',
                                );
                            @endphp

                            <!-- QR Scanner Container -->
                            <div id="qr-container" class="hidden animate-fade-in">
                                <div class="bg-gray-50 rounded-2xl p-4 border-2 border-dashed border-gray-200">

                                    <!-- Amount reminder -->
                                    <p class="text-center text-sm text-gray-600 font-medium mb-3">
                                        💰 Amount to pay: <span
                                            class="text-primary font-bold">₹{{ number_format($order->total, 2) }}</span>
                                    </p>

                                    <!-- Scanner viewport -->
                                    <div id="qr-reader" class="rounded-xl overflow-hidden mx-auto"
                                        style="width:100%;max-width:280px;"></div>

                                    <!-- Scanner status -->
                                    <p id="qr-status" class="text-center text-xs text-gray-500 mt-3 animate-pulse">
                                        📷 Point camera at any QR code…
                                    </p>

                                    <!-- Re-scan button (hidden until after first scan) -->
                                    <button id="qr-rescan-btn" onclick="restartScanner()"
                                        class="hidden mt-3 mx-auto flex items-center justify-center gap-1 text-xs text-primary border border-primary rounded-full px-4 py-1.5 active:scale-95 transition-transform">
                                        🔄 Scan Again
                                    </button>
                                </div>

                                <!-- UPI details passed to JS -->
                                <input type="hidden" id="upi-id" value="{{ $upiId }}">
                                <input type="hidden" id="merchant-name" value="{{ $merchantName }}">
                            </div>

                            <!-- Payment App Chooser Bottom-Sheet -->
                            <div id="app-chooser-backdrop" class="fixed inset-0 bg-black/50 z-40 hidden"
                                onclick="closeChooser()"></div>

                            <div id="app-chooser"
                                class="fixed bottom-0 left-0 right-0 bg-white rounded-t-3xl z-50 transform translate-y-full transition-transform duration-300 ease-out shadow-2xl">

                                <div class="max-w-md mx-auto p-6">
                                    <!-- Handle bar -->
                                    <div class="w-10 h-1 bg-gray-300 rounded-full mx-auto mb-5"></div>

                                    <p class="text-center text-gray-500 text-xs mb-1">Pay
                                        ₹{{ number_format($order->total, 2) }} via</p>
                                    <h3 class="text-center text-gray-900 font-bold text-lg mb-5">Choose Payment App</h3>

                                    <!-- App Buttons -->
                                    <div class="space-y-3">

                                        <a id="btn-gpay" href="#" onclick="openApp('gpay'); return false;"
                                            class="flex items-center gap-4 p-4 rounded-2xl border-2 border-gray-100 hover:border-blue-400 active:scale-95 transition-all duration-150 bg-white shadow-sm">
                                            <span class="text-3xl">🟦</span>
                                            <div>
                                                <p class="font-bold text-gray-800">Google Pay</p>
                                                <p class="text-xs text-gray-500">Pay via GPay UPI</p>
                                            </div>
                                            <svg class="ml-auto w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                        <a id="btn-phonepe" href="#" onclick="openApp('phonepe'); return false;"
                                            class="flex items-center gap-4 p-4 rounded-2xl border-2 border-gray-100 hover:border-purple-400 active:scale-95 transition-all duration-150 bg-white shadow-sm">
                                            <span class="text-3xl">🟣</span>
                                            <div>
                                                <p class="font-bold text-gray-800">PhonePe</p>
                                                <p class="text-xs text-gray-500">Pay via PhonePe UPI</p>
                                            </div>
                                            <svg class="ml-auto w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                        <a id="btn-paytm" href="#" onclick="openApp('paytm'); return false;"
                                            class="flex items-center gap-4 p-4 rounded-2xl border-2 border-gray-100 hover:border-blue-300 active:scale-95 transition-all duration-150 bg-white shadow-sm">
                                            <span class="text-3xl">🔵</span>
                                            <div>
                                                <p class="font-bold text-gray-800">Paytm</p>
                                                <p class="text-xs text-gray-500">Pay via Paytm UPI</p>
                                            </div>
                                            <svg class="ml-auto w-5 h-5 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                        <a id="btn-upi" href="#" onclick="openApp('upi'); return false;"
                                            class="flex items-center gap-4 p-4 rounded-2xl border-2 border-gray-100 hover:border-green-400 active:scale-95 transition-all duration-150 bg-white shadow-sm">
                                            <span class="text-3xl">📱</span>
                                            <div>
                                                <p class="font-bold text-gray-800">Any UPI App</p>
                                                <p class="text-xs text-gray-500">BHIM, Amazon Pay & more</p>
                                            </div>
                                            <svg class="ml-auto w-5 h-5 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>

                                    <button onclick="closeChooser()"
                                        class="mt-4 w-full py-3 rounded-2xl border border-gray-200 text-gray-500 text-sm font-medium active:scale-95 transition-transform">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-blue-50 rounded-2xl p-4 border border-blue-200">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-green-800 mb-2">Payment Complete!</h3>
                        <p class="text-green-600">Thank you for your payment.</p>
                        @if ($order->payment_method)
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Back to Menu
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- html5-qrcode library -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        // ─── State ───────────────────────────────────────────────────────────────────
        let html5QrCode = null;
        let scannerRunning = false;

        // ─── Payment method toggle ────────────────────────────────────────────────────
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
                startScanner();
            } else {
                qrContainer.classList.add('hidden');
                cashLabel.classList.add('border-primary', 'bg-red-50');
                cashLabel.classList.remove('border-gray-200');
                qrLabel.classList.remove('border-primary', 'bg-red-50');
                qrLabel.classList.add('border-gray-200');
                stopScanner();
            }
        }

        // ─── Scanner ─────────────────────────────────────────────────────────────────
        function startScanner() {
            if (scannerRunning) return;

            const readerEl = document.getElementById('qr-reader');
            if (!readerEl) return;

            // Clean up any previous instance
            if (html5QrCode) {
                html5QrCode.clear();
                html5QrCode = null;
            }

            html5QrCode = new Html5Qrcode('qr-reader');

            const config = {
                fps: 10,
                qrbox: {
                    width: 220,
                    height: 220
                },
                aspectRatio: 1.0,
                disableFlip: false,
            };

            html5QrCode.start({
                    facingMode: 'environment'
                }, // rear camera
                config,
                onScanSuccess,
                null // suppress verbose scan-failure logs
            ).then(() => {
                scannerRunning = true;
                setStatus('📷 Point camera at any QR code…', true);
            }).catch(err => {
                setStatus('⚠️ Camera access denied. Please allow camera permission.', false);
                console.warn('QR scanner start error:', err);
            });
        }

        function stopScanner() {
            if (!html5QrCode || !scannerRunning) return;
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                html5QrCode = null;
                scannerRunning = false;
            }).catch(() => {});
        }

        function restartScanner() {
            document.getElementById('qr-rescan-btn').classList.add('hidden');
            setStatus('📷 Point camera at any QR code…', true);
            // Stop and restart
            if (html5QrCode && scannerRunning) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                    html5QrCode = null;
                    scannerRunning = false;
                    startScanner();
                }).catch(() => startScanner());
            } else {
                startScanner();
            }
        }

        function onScanSuccess(decodedText) {
            // Pause scanner after first hit
            if (html5QrCode && scannerRunning) {
                html5QrCode.pause();
            }

            setStatus('✅ QR detected! Choose your payment app below.', false);
            document.getElementById('qr-rescan-btn').classList.remove('hidden');

            openChooser();
        }

        function setStatus(msg, pulse) {
            const el = document.getElementById('qr-status');
            if (!el) return;
            el.textContent = msg;
            if (pulse) {
                el.classList.add('animate-pulse');
            } else {
                el.classList.remove('animate-pulse');
            }
        }

        // ─── Payment App Chooser ─────────────────────────────────────────────────────
        function openChooser() {
            document.getElementById('app-chooser-backdrop').classList.remove('hidden');
            // Small delay so the browser paints the element before the transition kicks in
            setTimeout(() => {
                document.getElementById('app-chooser').classList.remove('translate-y-full');
            }, 20);
        }

        function closeChooser() {
            document.getElementById('app-chooser').classList.add('translate-y-full');
            setTimeout(() => {
                document.getElementById('app-chooser-backdrop').classList.add('hidden');
            }, 300);
            // Resume scanner
            if (html5QrCode && scannerRunning) {
                try {
                    html5QrCode.resume();
                } catch (e) {}
            }
        }

        /**
         * Build simple UPI deep links WITHOUT &am= parameter.
         * This avoids the "risky redirect" warning from Google Pay / Paytm.
         *
         * Scheme per app:
         *   Google Pay  → tez://upi/pay?...
         *   PhonePe     → phonepe://pay?...
         *   Paytm       → paytmmp://pay?...
         *   Any UPI     → upi://pay?...
         */
        function openApp(app) {
            const pa = document.getElementById('upi-id').value.trim();
            const pn = encodeURIComponent(document.getElementById('merchant-name').value.trim());
            const tn = encodeURIComponent('Restaurant Order Payment');

            if (!pa) {
                alert('UPI ID not configured. Please contact the restaurant staff.');
                return;
            }

            let url;
            switch (app) {
                case 'gpay':
                    url = `tez://upi/pay?pa=${pa}&pn=${pn}&tn=${tn}&cu=INR`;
                    break;
                case 'phonepe':
                    url = `phonepe://pay?pa=${pa}&pn=${pn}&tn=${tn}&cu=INR`;
                    break;
                case 'paytm':
                    url = `paytmmp://pay?pa=${pa}&pn=${pn}&tn=${tn}&cu=INR`;
                    break;
                default:
                    url = `upi://pay?pa=${pa}&pn=${pn}&tn=${tn}&cu=INR`;
            }

            // Attempt deep link; if app isn't installed the browser just
            // stays on the page without an error — no fallback needed.
            window.location.href = url;
        }

        // ─── Init ────────────────────────────────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', togglePaymentMethod);
    </script>
@endpush
