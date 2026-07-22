@extends('frontend.layouts.new-app')

<!-- @section('title', $product->name) -->
@section('title','- Fizz & Freeze ')

@section('content')
{{-- OLD CODE START --}}
{{-- Previous product detail page kept for reference --}}
{{-- OLD CODE END --}}

<!-- Hero Image Section -->
<div class="relative h-72 bg-gray-200">
    <img id="item-image" 
         src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('FrontAssets/images/food1.png') }}" 
         alt="{{ $product->name }}" 
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/30"></div>

    <!-- Back Button -->
    <a href="{{ url()->previous() }}"
       class="absolute top-4 left-4 w-10 h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center shadow-lg z-10">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </a>

    <!-- Cart Button -->
    <a href="{{ route('cart') }}"
       class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center shadow-lg z-10">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <span class="cart-badge absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center" style="display: none;">0</span>
    </a>

    <!-- Image Gallery Dots -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
        <span class="w-2 h-2 rounded-full bg-white"></span>
        <span class="w-2 h-2 rounded-full bg-white/50"></span>
        <span class="w-2 h-2 rounded-full bg-white/50"></span>
    </div>
</div>

<!-- Content -->
<main class="relative -mt-6 bg-white rounded-t-3xl min-h-[60vh] pb-32">
    <div class="px-5 pt-6">
        
        <!-- Title and Price -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                <div class="flex items-center gap-4 mt-2">
                    @if($product->trending)
                    <span class="px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-700">🔥 Popular</span>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold text-red-900">₹{{ $product->discount_price }}</p>
                @if($product->price != $product->discount_price)
                <p class="text-sm text-gray-400 line-through">₹{{ $product->price }}</p>
                @endif
            </div>
        </div>

        <!-- Tags -->
        <div class="flex flex-wrap gap-2 mt-4">
            <span class="px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                {{ $product->category_name ?? 'Food' }}
            </span>
        </div>

        <!-- Description -->
        <div class="mt-6">
            <h3 class="font-semibold text-gray-800 mb-2">Description</h3>
            <p class="text-gray-600 leading-relaxed">{{ $product->description ?? 'A delicious menu item crafted with the finest ingredients. Perfect for any occasion!' }}</p>
        </div>

        <!-- Quantity Selector -->
        <div class="mt-6">
            <h3 class="font-semibold text-gray-800 mb-3">Quantity</h3>
            <div class="flex items-center gap-4">
                <button onclick="decrementQuantity()" 
                        class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition-colors text-xl font-bold">
                    −
                </button>
                <span id="quantity-display" class="w-8 text-center font-bold text-gray-800 text-xl">1</span>
                <button onclick="incrementQuantity()" 
                        class="w-10 h-10 rounded-full bg-orange-100 text-red-900 flex items-center justify-center hover:bg-orange-200 transition-colors text-xl font-bold">
                    +
                </button>
            </div>
        </div>

        <!-- Special Instructions -->
        <!-- <div class="mt-6">
            <h3 class="font-semibold text-gray-800 mb-3">Special Instructions</h3>
            <textarea id="special-instructions" 
                      class="w-full p-4 bg-gray-50 rounded-xl border-2 border-gray-100 focus:border-orange-400 focus:ring-0 transition-colors resize-none"
                      rows="3"
                      placeholder="Any special requests? (e.g., no onions, extra sauce)"></textarea>
        </div> -->

        <!-- Similar Items -->
        @php
            $similarProducts = \App\Models\Products::where('category_name', $product->category_name)
                                                   ->where('id', '!=', $product->id)
                                                   ->where('status', 'active')
                                                   ->take(4)
                                                   ->get();
        @endphp
        @if($similarProducts->count() > 0)
        <div class="mt-8 mb-4">
            <h3 class="font-semibold text-gray-800 mb-3">You Might Also Like</h3>
            <div class="flex gap-4 overflow-x-auto hide-scrollbar pb-2">
                @foreach($similarProducts as $similar)
                <a href="{{ route('product-detail', encrypt($similar->id)) }}" 
                   class="flex-shrink-0 w-36 bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="{{ $similar->product_image ? asset('storage/' . $similar->product_image) : asset('FrontAssets/images/food1.png') }}" 
                         alt="{{ $similar->name }}" 
                         class="w-full h-24 object-cover">
                    <div class="p-2">
                        <h4 class="font-medium text-gray-800 text-sm line-clamp-1">{{ $similar->name }}</h4>
                        <p class="text-red-900 font-bold text-sm">₹{{ $similar->discount_price }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</main>

<!-- Bottom Action Bar -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 p-4 safe-area-inset-bottom z-40">
    <div class="flex items-center gap-4">
        <!-- Quantity Display -->
        <div class="flex items-center gap-2 bg-gray-100 rounded-xl p-1">
            <button onclick="decrementQuantity()" class="w-10 h-10 rounded-lg bg-white text-gray-600 flex items-center justify-center text-xl font-bold shadow-sm">−</button>
            <span id="quantity-display-bottom" class="w-8 text-center font-bold text-gray-800">1</span>
            <button onclick="incrementQuantity()" class="w-10 h-10 rounded-lg bg-white text-red-900 flex items-center justify-center text-xl font-bold shadow-sm">+</button>
        </div>

        <!-- Add to Cart Button -->
        <button onclick="addToCart()"
                class="flex-1 bg-gradient-to-r from-red-500 to-red-500 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>Add to Cart</span>
            <span id="add-price" class="font-bold">₹{{ $product->discount_price }}</span>
        </button>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let quantity = 1;
    const basePrice = {{ $product->discount_price }};

    function updatePrice() {
        const total = basePrice * quantity;
        document.getElementById('add-price').textContent = `₹${total}`;
    }

    function incrementQuantity() {
        if (quantity < 10) {
            quantity++;
            document.getElementById('quantity-display').textContent = quantity;
            document.getElementById('quantity-display-bottom').textContent = quantity;
            updatePrice();
        }
    }

    function decrementQuantity() {
        if (quantity > 1) {
            quantity--;
            document.getElementById('quantity-display').textContent = quantity;
            document.getElementById('quantity-display-bottom').textContent = quantity;
            updatePrice();
        }
    }

    function addToCart() {
        const specialInstructions = document.getElementById('special-instructions')?.value || '';
        
        CartManager.addItem({
            id: {{ $product->id }},
            name: '{{ addslashes($product->name) }}',
            price: basePrice,
            image: '{{ $product->product_image ? asset("storage/" . $product->product_image) : asset("FrontAssets/images/food1.png") }}',
            specialInstructions: specialInstructions
        }, quantity);

        // Reset
        quantity = 1;
        document.getElementById('quantity-display').textContent = '1';
        document.getElementById('quantity-display-bottom').textContent = '1';
        if (document.getElementById('special-instructions')) {
            document.getElementById('special-instructions').value = '';
        }
        updatePrice();
    }
</script>
@endpush