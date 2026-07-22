@extends('frontend.layouts.new-app')

@section('title', 'Fizz & Freeze - Cafe')

@section('content')
<div class="min-h-screen flex flex-col pb-24">
    @include('frontend.partials.page-header', [
        'backHref'  => route('cart', ['table' => $table]),
        'backLabel' => 'Back to Cart',
        'icon'      => '🧾',
        'title'     => 'Checkout',
        'subtitle'  => 'Complete your order',
        'waveColor' => '#f8f9ff',
    ])


    <!-- Content -->
    <div class="flex-1 px-4 -mt-4">
        <div class="max-w-md mx-auto">
            
            <!-- Customer Details Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">1</span>
                    Your Details
                </h2>
                
                <div class="space-y-4">
                    @if($customerInfo['existing_order'])
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 mb-2 flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-700">
                            You have an active order <strong>#{{ $customerInfo['existing_order']['order_number'] }}</strong>. 
                            New items will be added to this order.
                        </p>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Name *</label>
                        <input type="text" id="customer-name" 
                               class="input-field w-full {{ $customerInfo['name'] ? 'bg-gray-50' : '' }}"
                               value="{{ $customerInfo['name'] }}"
                               placeholder="Enter your name" required
                               {{ $customerInfo['name'] ? 'readonly' : '' }}>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number *</label>
                        <input type="tel" id="customer-mobile" 
                               class="input-field w-full {{ $customerInfo['mobile'] ? 'bg-gray-50' : '' }}"
                               value="{{ $customerInfo['mobile'] }}"
                               placeholder="Enter your mobile number" required
                               {{ $customerInfo['mobile'] ? 'readonly' : '' }}>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Special Instructions (Optional)</label>
                        <textarea id="order-notes" 
                                  class="input-field w-full" 
                                  rows="3"
                                  placeholder="Any special requests?"></textarea>
                    </div>
                </div>
            </div>

            <!-- Table Info Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">2</span>
                    Table Information
                </h2>
                
                <div class="bg-gradient-to-r from-primary to-secondary rounded-xl p-4 text-center text-white">
                    <p class="text-sm opacity-90">Your Table Number</p>
                    <p class="text-4xl font-bold" id="checkout-table-number">--</p>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">3</span>
                    Order Summary
                </h2>
                
                <div id="checkout-items" class="space-y-3 mb-4">
                    <!-- Items will be populated by JS -->
                </div>
                
                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span id="checkout-subtotal">₹0</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold text-gray-800">
                        <span>Total</span>
                        <span id="checkout-total" class="text-primary">₹0</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Fixed Bottom Button -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 z-50">
        <div class="max-w-md mx-auto">
            <button onclick="placeOrder()" 
                    id="place-order-btn"
                    class="w-full bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                <span id="btn-text">Place Order</span>
                <svg id="btn-spinner" class="hidden w-5 h-5 ml-2 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>

                {{-- <button onclick="continueOrder()" 
                    id="place-order-btn"
                    class="w-full bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                <span id="btn-text">Continues</span>
                <svg id="btn-spinner" class="hidden w-5 h-5 ml-2 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button> --}}
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-3xl p-8 max-w-sm mx-4 text-center animate-fade-in">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Order Placed!</h3>
        <p class="text-gray-600 mb-2">Your order has been received.</p>
        <p class="text-lg font-semibold text-primary mb-4" id="order-number-display"></p>
        <p class="text-sm text-gray-500 mb-6">Your food will be served at your table soon.</p>
        <!-- <a href="#" id="make-payment-link" class="block w-full bg-gradient-to-r from-primary to-secondary text-white font-bold py-3 px-6 rounded-xl mb-3">
            Make Payment
        </a> -->
        <a href="{{ route('product', ['category' => 'all']) }}" class="block w-full border-2 border-gray-200 text-gray-700 font-bold py-3 px-6 rounded-xl hover:bg-gray-50">
            Back to Menu
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    loadCheckoutData();
});

function loadCheckoutData() {
    const cart = CartManager.getCart();
    const tableNumber = CartManager.tableNumber || '{{ $table }}';
    
    if (!cart.length) {
        window.location.href = '{{ route("cart") }}';
        return;
    }
    
    // Set table number
    document.getElementById('checkout-table-number').textContent = tableNumber || '--';
    
    // Render cart items
    const itemsContainer = document.getElementById('checkout-items');
    let subtotal = 0;
    
    itemsContainer.innerHTML = cart.map(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        return `
            <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                <div class="flex items-center">
                    <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-xs mr-3">${item.quantity}</span>
                    <span class="text-gray-800">${item.name}</span>
                </div>
                <span class="font-semibold text-gray-800">₹${itemTotal.toFixed(2)}</span>
            </div>
        `;
    }).join('');
    
    document.getElementById('checkout-subtotal').textContent = '₹' + subtotal.toFixed(2);
    document.getElementById('checkout-total').textContent = '₹' + subtotal.toFixed(2);
}

async function placeOrder() {
    const name = document.getElementById('customer-name').value.trim();
    const mobile = document.getElementById('customer-mobile').value.trim();
    const notes = document.getElementById('order-notes').value.trim();
    const tableNumber = CartManager.tableNumber || '{{ $table }}';
    const cart = CartManager.getCart();
    
    // Validation
    if (!name) {
        alert('Please enter your name');
        return;
    }
    
    if (!mobile || mobile.length < 10) {
        alert('Please enter a valid mobile number');
        return;
    }
    
    if (!tableNumber) {
        alert('Table number is missing. Please scan the QR code again.');
        return;
    }
    
    if (!cart.length) {
        alert('Your cart is empty');
        return;
    }
    
    // Show loading state
    const btn = document.getElementById('place-order-btn');
    const btnText = document.getElementById('btn-text');
    const btnSpinner = document.getElementById('btn-spinner');
    btn.disabled = true;
    btnText.textContent = 'Placing Order...';
    btnSpinner.classList.remove('hidden');
    
    try {
        const response = await fetch('{{ route("order-place") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                table_number: tableNumber,
                customer_name: name,
                customer_mobile: mobile,
                notes: notes,
                items: cart.map(item => ({
                    product_id: item.id,
                    quantity: item.quantity,
                    special_instructions: item.instructions || null
                }))
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Clear cart
            CartManager.clearCart();

            // Store order number so track-order page can pick it up
            localStorage.setItem('lastOrderNumber', data.order.order_number);

            // Redirect straight to the tracking page — no manual input needed
            window.location.href = '{{ route("track-order") }}?order=' + data.order.order_number;
        } else {
            throw new Error(data.message || 'Failed to place order');
        }
    } catch (error) {
        alert('Error: ' + error.message);
        btn.disabled = false;
        btnText.textContent = 'Place Order';
        btnSpinner.classList.add('hidden');
    }
}



</script>
@endpush
