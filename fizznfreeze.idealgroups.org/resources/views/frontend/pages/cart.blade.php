@extends('frontend.layouts.new-app')

@section('title', 'Fizz & Freeze - Cafe')

@section('content')

@include('frontend.partials.page-header', [
    'backHref'  => route('product', ['category' => 'all', 'table' => request('table')]),
    'backLabel' => 'Back to Menu',
    'icon'      => '🛒',
    'title'     => 'Your Cart',
    'subtitle'  => 'Review your items before ordering',
    'waveColor' => '#ffffff',
])

<!-- Cart info bar (count + clear button) -->
<div class="flex items-center justify-between px-4 py-2 bg-white border-b border-gray-100">
    <p class="text-sm text-gray-500" id="cart-count">0 items</p>
    <button onclick="clearCart()" id="clear-cart-btn"
            class="text-sm font-medium text-red-500 hover:text-red-600 transition-colors hidden">
        Clear All
    </button>
</div>

<!-- Cart Items -->
<main class="px-4 py-4 pb-48">
    <div id="cart-container">
        <!-- Cart items will be rendered here -->
    </div>

    <!-- Add More Items -->
    <div class="mt-4" id="add-more-section" style="display: none;">
        <a href="{{ route('product', ['category' => 'all', 'table' => request('table')]) }}"
           class="flex items-center justify-center gap-2 py-3 border-2 border-dashed border-red-300 rounded-xl text-primary hover:bg-red-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span class="font-medium">Add More Items</span>
        </a>
    </div>

    <!-- Order Notes -->
    <div id="notes-section" class="mt-6" style="display: none;">
        <!-- <h3 class="font-semibold text-gray-800 mb-2">Order Notes</h3>
        <textarea id="order-notes"
                  class="w-full p-4 bg-white rounded-xl border border-gray-200 focus:border-primary focus:ring-0 transition-colors resize-none"
                  rows="2" 
                  placeholder="Any special instructions for your entire order?"></textarea> -->
    </div>

    <!-- Order Summary -->
    <div id="summary-section" class="mt-6" style="display: none;">
        <div class="bg-white rounded-2xl p-4 shadow-sm">
            <h3 class="font-semibold text-gray-800 mb-4">Order Summary</h3>

            <div class="space-y-3 text-sm ">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal</span>
                    <span id="subtotal">₹0</span>
                </div>
                <div class="border-t border-gray-100 pt-2 flex justify-between font-bold text-lg text-gray-800 pb-2 ">
                    <span>Total</span>
                    <span id="total" class="text-primary">₹0</span>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Bottom Action Bar -->
<div id="checkout-bar"
     class="fixed bottom-16 left-0 right-0 bg-white border-t border-gray-100 p-4 safe-area-inset-bottom z-40"
     style="display: none;">
    <div class="flex items-center justify-between mb-3">
        <div>
            <p class="text-sm text-gray-500">Total Amount</p>
            <p class="text-2xl font-bold text-gray-800" id="bottom-total">₹0</p>
        </div>
        <div class="text-right text-sm text-gray-500">
            <span id="bottom-item-count">0 items</span>
        </div>
    </div>
    <button onclick="placeOrder()"
            class="block w-full bg-gradient-to-r from-primary to-secondary text-white text-center font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all">
        Place Order
        <span class="ml-2">→</span>
    </button>
</div>


<!-- User Info Modal -->
<div id="order-info-modal" class="fixed inset-0 z-50 hidden overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeOrderInfoModal()"></div>
    <div class="bg-white rounded-3xl w-full max-w-sm mx-auto shadow-2xl relative z-10 overflow-hidden p-6 transform transition-all">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Get in touch with us for latest updates</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" id="user-name" 
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                       placeholder="Enter your name">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number</label>
                <input type="tel" id="user-mobile" 
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                       placeholder="Enter mobile number">
            </div>
            <button onclick="confirmOrderInfo()" 
                    class="w-full bg-primary text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all mt-2">
                Continue
            </button>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="fixed inset-0 z-50 hidden overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeModalAndRedirect()"></div>
    
    <!-- Modal Content -->
    <div class="bg-white rounded-3xl w-full max-w-sm mx-auto shadow-2xl relative z-10 overflow-hidden transform transition-all">
        <div class="p-6">
            <!-- Icon and Title -->
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Order Placed!</h2>
                <p class="text-gray-500 text-sm">Thank you, <span id="modal-user-name" class="font-bold text-gray-800"></span>!</p>
            </div>
            
            <!-- Bill Summary -->
            <div class="bg-gray-50 rounded-2xl p-4 mb-6">
                <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Your Bill</span>
                    <span id="modal-table-number" class="text-sm font-bold text-primary">Table --</span>
                </div>
                
                <!-- Items List -->
                <div id="modal-bill-items" class="space-y-3 mb-4 max-h-48 overflow-y-auto pr-1">
                    <!-- Items will be injected here -->
                </div>
                
                <!-- Totals -->
                <div class="border-t border-dashed border-gray-300 pt-3 space-y-2">
                    <div class="flex justify-between text-sm font-bold text-gray-800">
                        <span>Grand Total</span>
                        <span id="modal-total-amount" class="text-primary">₹0</span>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="space-y-3">
                <button onclick="closeModalAndRedirect()" 
                        class="block w-full bg-primary text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all">
                    Done
                </button>
                <a href="{{ route('product', ['category' => 'all']) }}"
                   class="block w-full bg-gray-100 text-gray-600 text-center font-bold py-4 rounded-xl hover:bg-gray-200 transition-all">
                    Go to Menu
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        renderCart();
    });

    function renderCart() {
        const container = document.getElementById('cart-container');
        const cart = CartManager.cart;

        if (cart.length === 0) {
            // Show empty state
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-20 text-center">
    <div class="text-8xl mb-6 animate-bounce-slow">🛒</div>
    <h3 class="text-2xl font-bold text-gray-700 mb-3">Your cart is empty</h3>
    <p class="text-gray-500 mb-6 max-w-xs">Browse our delicious menu and add some items!</p>
    
    <a href="{{ route('product', ['category' => 'all']) }}" 
       class="bg-[#4C0014] text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-[#35000E] hover:shadow-xl transition-all">
        View Menu
    </a>
</div>
            `;

            // Hide sections
            document.getElementById('add-more-section').style.display = 'none';
            document.getElementById('notes-section').style.display = 'none';
            document.getElementById('summary-section').style.display = 'none';
            document.getElementById('checkout-bar').style.display = 'none';
            document.getElementById('clear-cart-btn').classList.add('hidden');
            return;
        }

        // Show sections
        document.getElementById('add-more-section').style.display = 'block';
        document.getElementById('notes-section').style.display = 'block';
        document.getElementById('summary-section').style.display = 'block';
        document.getElementById('checkout-bar').style.display = 'block';
        document.getElementById('clear-cart-btn').classList.remove('hidden');

        // Render cart items
        let html = '<div class="space-y-4">';

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;

            html += `
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <div class="flex gap-4">
                        <!-- Image -->
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-semibold text-gray-800 line-clamp-1">${item.name}</h3>
                                <button onclick="removeItem(${item.cartId})" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            
                            ${item.specialInstructions ? `
                                <p class="text-xs text-gray-500 mt-1 italic">"${item.specialInstructions}"</p>
                            ` : ''}
                            
                            <!-- Price and Quantity -->
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center gap-2">
                                    <button onclick="updateQuantity(${item.cartId}, ${item.quantity - 1})" 
                                            class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    <span class="w-8 text-center font-semibold text-gray-800">${item.quantity}</span>
                                    <button onclick="updateQuantity(${item.cartId}, ${item.quantity + 1})" 
                                            class="w-8 h-8 rounded-full bg-red-100 text-red-900 flex items-center justify-center hover:bg-red-200 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </button>
                                </div>
                                <span class="font-bold text-red-900">₹${itemTotal}</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        container.innerHTML = html;

        // Update summary
        updateSummary();
    }

    function updateSummary() {
        const itemCount = CartManager.getItemCount();
        const subtotal = CartManager.getSubtotal();
        const total = CartManager.getTotal();

        const setText = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
        setText('cart-count',     `${itemCount} item${itemCount !== 1 ? 's' : ''}`);
        setText('subtotal',        `₹${subtotal.toFixed(0)}`);
        setText('total',           `₹${total.toFixed(0)}`);
        setText('bottom-total',    `₹${total.toFixed(0)}`);
        setText('bottom-item-count', `${itemCount} item${itemCount !== 1 ? 's' : ''}`);
    }

    function updateQuantity(cartId, quantity) {
        CartManager.updateQuantity(cartId, quantity);
        renderCart();
    }

    function removeItem(cartId) {
        CartManager.removeItem(cartId);
        renderCart();
    }

    function clearCart() {
        Swal.fire({
            title: 'Clear Cart?',
            text: 'Are you sure you want to remove all items from your cart?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#440012',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, clear it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                CartManager.clearCart();
                renderCart();
                Swal.fire({
                    title: 'Cleared!',
                    text: 'Your cart has been cleared.',
                    icon: 'success',
                    confirmButtonColor: '#440012'
                });
            }
        });
    }

    function placeOrder() {
        const tableNumber = CartManager.tableNumber;
        if (!tableNumber) {
            alert('Please set your table number first!');
            window.location.href = '{{ route("homee") }}';
            return;
        }

        // Redirect to checkout page
        window.location.href = '/checkout/' + tableNumber;
    }

    function closeOrderInfoModal() {
        document.getElementById('order-info-modal').classList.add('hidden');
        document.getElementById('order-info-modal').classList.remove('flex');
    }

    function confirmOrderInfo() {
        const name = document.getElementById('user-name').value.trim();
        const mobile = document.getElementById('user-mobile').value.trim();

        if (!name || !mobile) {
            alert('Please enter both name and mobile number');
            return;
        }

        if (mobile.length < 10) {
            alert('Please enter a valid mobile number');
            return;
        }

        // Hide info modal
        closeOrderInfoModal();

        // Show success modal with bill
        showSuccessModal(name);
    }

    function showSuccessModal(userName) {
        const tableNumber = CartManager.tableNumber;
        const total = CartManager.getTotal().toFixed(0);
        const cart = CartManager.cart;

        // Set Header Info
        document.getElementById('modal-user-name').textContent = userName;
        document.getElementById('modal-table-number').textContent = `Table ${tableNumber}`;
        document.getElementById('modal-total-amount').textContent = `₹${total}`;

        // Build Bill Items List
        const billItemsContainer = document.getElementById('modal-bill-items');
        let billHtml = '';
        
        cart.forEach(item => {
            billHtml += `
                <div class="flex justify-between items-start text-sm">
                    <div class="flex-1 pr-4">
                        <p class="font-medium text-gray-800">${item.name}</p>
                        <p class="text-xs text-gray-500">Qty: ${item.quantity} × ₹${item.price}</p>
                    </div>
                    <span class="font-bold text-gray-800">₹${item.quantity * item.price}</span>
                </div>
            `;
        });
        
        billItemsContainer.innerHTML = billHtml;

        // Show Modal
        document.getElementById('success-modal').classList.remove('hidden');
        document.getElementById('success-modal').classList.add('flex');
        
        // Clear cart after showing modal data
        CartManager.clearCart();
        renderCart();
    }

    function closeModalAndRedirect() {
        document.getElementById('success-modal').classList.add('hidden');
        document.getElementById('success-modal').classList.remove('flex');
        window.location.href = '{{ route("homee") }}';
    }
    
</script>
@endpush
