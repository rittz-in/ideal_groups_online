{{-- Bottom Navigation Component --}}
@php
    $currentRoute = Route::currentRouteName();
@endphp

<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around items-center py-2 px-4 z-40 safe-area-inset-bottom">
    <!-- <a href="{{ route('homee') }}" class="flex flex-col items-center py-2 px-4 {{ $currentRoute == 'homee' ? 'text-primary' : 'text-gray-500 hover:text-primary' }} transition-colors">
        <svg class="w-6 h-6" fill="{{ $currentRoute == 'homee' ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
            @if($currentRoute == 'homee')
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            @else
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            @endif
        </svg>
        <span class="text-xs mt-1">Home</span>
    </a> -->
    
    <a href="{{ route('product', ['category' => 'all']) }}" class="flex flex-col items-center py-2 px-4 {{ str_contains($currentRoute, 'product') ? 'text-primary' : 'text-gray-500 hover:text-primary' }} transition-colors">
        <svg class="w-6 h-6" fill="{{ str_contains($currentRoute, 'product') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <span class="text-xs mt-1">Menu</span>
    </a>
    
    <a href="{{ route('cart') }}" class="flex flex-col items-center py-2 px-4 {{ $currentRoute == 'cart' ? 'text-primary' : 'text-gray-500 hover:text-primary' }} transition-colors relative">
        <svg class="w-6 h-6" fill="{{ $currentRoute == 'cart' ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <span class="cart-badge absolute -top-1 right-2 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center" style="display: none;">0</span>
        <span class="text-xs mt-1">Cart</span>
    </a>
    
    <a href="{{ route('track-order') }}" class="flex flex-col items-center py-2 px-4 {{ $currentRoute == 'track-order' ? 'text-primary' : 'text-gray-500 hover:text-primary' }} transition-colors">
        <svg class="w-6 h-6" fill="{{ $currentRoute == 'track-order' ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
        </svg>
        <span class="text-xs mt-1">Orders</span>
    </a>

    <a href="#" onclick="goToPayment()" class="flex flex-col items-center py-2 px-4 {{ $currentRoute == 'order-payment' ? 'text-primary' : 'text-gray-500 hover:text-primary' }} transition-colors">
        <svg class="w-6 h-6" fill="{{ $currentRoute == 'order-payment' ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <span class="text-xs mt-1">Pay</span>
    </a>
</nav>

<script>
function goToPayment() {
    // Check if there's a last order stored
    const lastOrder = localStorage.getItem('lastOrderNumber');
    if (lastOrder) {
        window.location.href = "{{ url('order/payment') }}/" + lastOrder;
    } else {
        // Redirect to track order page to find orders
        window.location.href = '{{ route("track-order") }}';
    }
}
</script>
