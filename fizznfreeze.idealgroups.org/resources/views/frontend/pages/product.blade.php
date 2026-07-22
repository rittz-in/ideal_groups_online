@extends('frontend.layouts.new-app')

@section('title', 'Fizz & Freeze - Cafe' )

@section('content')
{{-- OLD CODE START --}}
{{-- Previous product page content kept for reference --}}
{{-- OLD CODE END --}}

<!-- Sticky Header -->
<header class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
    <div class="flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('product', ['table' => request('table')]) }}" class="p-2 -ml-2 rounded-full hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="font-bold text-gray-800">{{ $categoryName ?? 'Our Menu' }}</h1>
                <p class="text-xs text-gray-500 table-indicator">No table set</p>
            </div>
        </div>
        <a href="{{ route('cart', ['table' => request('table')]) }}" class="relative p-2 rounded-full hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="cart-badge absolute -top-0.5 -right-0.5 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center" style="display: none;">0</span>
        </a>
    </div>

    <!-- Search Bar -->
    <div class="px-4 mt-2 pb-3">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="live-search"
                   class="w-full pl-10 pr-4 py-3 bg-gray-100 rounded-xl focus:bg-white focus:ring-2 focus:ring-red-900 transition-all"
                   placeholder="Search Food or Beverages...">
        </div>
    </div>

    <!-- Category Pills -->
    <div class="px-4  pb-3 overflow-x-auto hide-scrollbar">
        <div class="flex gap-2" id="category-pills">
            <a href="{{ route('product', ['category' => 'all', 'table' => request('table')]) }}" 
               class="flex-shrink-0 px-4 py-2 rounded-full font-medium text-sm border-2 transition-all
                      {{ !isset($categoryName) || $categoryName == 'Trending' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-red-900 hover:text-primary' }}">
                🔥 Trending
            </a>
            @foreach($categories as $category)
            <a href="{{ route('product', ['category' => $category->name, 'table' => request('table')]) }}" 
               class="flex-shrink-0 px-4 py-2 rounded-full font-medium text-sm border-2 transition-all
                      {{ (isset($categoryName) && $categoryName == $category->name) ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-red-900 hover:text-primary' }}">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
    </div>
</header>

<!-- ── Active Order Banner (shown when table has an ongoing order) ── -->
<div id="active-order-banner"
     class="hidden fixed top-0 left-0 right-0 z-[60] px-4 pt-2">
    <div class="max-w-md mx-auto text-white rounded-2xl shadow-xl px-4 py-3 flex items-center justify-between gap-3"
         style="background: linear-gradient(135deg, #681F32 0%, #a83255 60%, #c94a6e 100%);">
        <div class="flex items-center gap-3 min-w-0">
            <span class="text-2xl flex-shrink-0">📦</span>
            <div class="min-w-0">
                <p class="font-bold text-sm leading-tight" id="active-banner-title">Active Order</p>
                <p class="text-xs opacity-80" id="active-banner-sub"></p>
            </div>
        </div>
        <a id="active-banner-link"
           href="#"
           class="flex-shrink-0 bg-white font-bold text-xs px-3 py-2 rounded-xl whitespace-nowrap transition-colors"
           style="color: #681F32;">
            Track →
        </a>
    </div>
</div>

<!-- Main Content -->
<main class="pt-44 px-4 pb-24">

    <!-- Menu Items -->
    <section id="menu-container">
        @if($products->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">No items found</h3>
                <p class="text-gray-500">Try selecting a different category</p>
                <a href="{{ route('homee') }}" class="mt-4 px-6 py-2 bg-primary text-white rounded-full font-medium">
                    View Trending
                </a>
            </div>
        @else
            <div class="grid gap-4 pt-6" id="products-grid">
                @foreach($products as $product)
                <div class="product-item flex bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all"
                     data-id="{{ $product->id }}"
                     data-name="{{ strtolower($product->name) }}"
                     data-price="{{ $product->discount_price }}"
                     data-image="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('FrontAssets/images/food1.png') }}">
                    
                    <!-- Product Image -->
                    <!-- <a href="{{ route('product-detail', encrypt($product->id)) }}" class="relative w-32 h-32 flex-shrink-0 overflow-hidden"> -->
                        <div class="relative w-32 h-32 flex-shrink-0 overflow-hidden">
                        <img src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('FrontAssets/images/food1.png') }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover"
                             loading="lazy">
                        @if($product->trending)
                        <div class="absolute top-2 left-2 bg-primary text-white text-xs px-2 py-0.5 rounded-full font-medium">
                            🔥 Trending
                        </div>
                        @endif
                    </div>
                    
                    <!-- Product Details -->
                    <div class="flex-1 p-3 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-2">
                                <!-- <a href="{{ route('product-detail', encrypt($product->id)) }}" class="font-semibold text-gray-800 line-clamp-1 hover:text-primary"> -->
                                <div class="font-semibold text-gray-800 line-clamp-1 hover:text-primary">

                                    {{ $product->name }}
                                </div>
                                <span class="text-primary font-bold whitespace-nowrap">₹{{ $product->discount_price }}</span>
                            </div>
                            <p class="text-sm text-gray-500 line-clamp-2 mt-1">{{ $product->description ?? 'Delicious food item' }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center gap-2">
                                @if($product->price != $product->discount_price)
                                <span class="text-xs text-gray-400 line-through">₹{{ $product->price }}</span>
                                @endif
                            </div>
                            <div id="product-actions-{{ $product->id }}" class="product-actions">
                                <button class="quick-add-btn w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center shadow-md hover:bg-secondary transition-colors"
                                        onclick="quickAddToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->discount_price }}, '{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('FrontAssets/images/food1.png') }}')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </section>

</main>

@endsection

@push('scripts')
<script>
    // Initialize dynamic actions on load
    document.addEventListener('DOMContentLoaded', () => {
        refreshAllProductActions();
    });

    function refreshAllProductActions() {
        document.querySelectorAll('.product-actions').forEach(container => {
            const productId = container.id.replace('product-actions-', '');
            renderProductActions(productId);
        });
    }

    function renderProductActions(productId) {
        const container = document.getElementById(`product-actions-${productId}`);
        if (!container) return;

        const cartItem = CartManager.findItemByProductId(productId);
        const productItem = container.closest('.product-item');
        
        // Get data from attributes if available (for newly added items via search/etc)
        const name = productItem.dataset.name;
        const price = productItem.dataset.price;
        const image = productItem.dataset.image;

        if (cartItem) {
            container.innerHTML = `
                <div class="flex items-center gap-2">
                    <button onclick="updateProductListQuantity(${cartItem.cartId}, ${cartItem.quantity - 1}, ${productId})" 
                            class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition-colors text-lg font-bold">
                        −
                    </button>
                    <span class="w-6 text-center font-bold text-gray-800">${cartItem.quantity}</span>
                    <button onclick="updateProductListQuantity(${cartItem.cartId}, ${cartItem.quantity + 1}, ${productId})" 
                            class="w-8 h-8 rounded-full bg-orange-100 text-red-900 flex items-center justify-center hover:bg-orange-200 transition-colors text-lg font-bold">
                        +
                    </button>
                </div>
            `;
        } else {
            // Use dataset attributes to pass to quickAddToCart to handle dynamic content properly
            const escapedName = (name || '').replace(/'/g, "\\'");
            container.innerHTML = `
                <button class="quick-add-btn w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center shadow-md hover:bg-secondary transition-colors"
                        onclick="quickAddToCart(${productId}, '${escapedName}', ${price}, '${image}')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </button>
            `;
        }
    }

    // Quick add to cart
    function quickAddToCart(id, name, price, image) {
        CartManager.addItem({
            id: id,
            name: name,
            price: price,
            image: image
        }, 1);
        renderProductActions(id);
    }

    function updateProductListQuantity(cartId, quantity, productId) {
        CartManager.updateQuantity(cartId, quantity);
        renderProductActions(productId);
    }

    // ── Active Order Banner: silently check if this table has an ongoing order ──
    (function checkTableActiveOrder() {
        const tableNumber = CartManager.tableNumber || '{{ request("table") }}';
        if (!tableNumber) return;

        const STATUS_META = {
            pending:   { label: 'Waiting for confirmation…' },
            confirmed: { label: 'Order confirmed! 🎉' },
            preparing: { label: 'Kitchen is preparing your food 👨‍🍳' },
            ready:     { label: 'Ready to serve! 🔔' },
            served:    { label: 'Enjoy your meal! 🍽️' },
        };

        fetch(`/order/table-active/${encodeURIComponent(tableNumber)}`)
            .then(r => r.json())
            .then(data => {
                if (!data.success) return;

                const banner  = document.getElementById('active-order-banner');
                const title   = document.getElementById('active-banner-title');
                const sub     = document.getElementById('active-banner-sub');
                const link    = document.getElementById('active-banner-link');
                const meta    = STATUS_META[data.status] || { label: 'Order in progress' };

                title.textContent = `Order #${data.order_number.slice(-6)}  ·  ₹${parseFloat(data.total).toFixed(0)}`;
                sub.textContent   = meta.label;
                link.href         = `/track-order?order=${data.order_number}`;

                banner.classList.remove('hidden');

                // Push main content down so banner doesn't overlap header
                document.querySelector('main').style.paddingTop = '11rem';
            })
            .catch(() => { /* swallow silently */ });
    })();

    let searchTimeout;
    const searchInput = document.getElementById('live-search');
    const menuContainer = document.getElementById('menu-container');
    const originalProductsHtml = menuContainer.innerHTML;
    
    searchInput.addEventListener('input', (e) => {
        clearTimeout(searchTimeout);
        const searchTerm = e.target.value.trim();
        
        searchTimeout = setTimeout(() => {
            if (searchTerm.length === 0) {
                menuContainer.innerHTML = originalProductsHtml;
                return;
            }
            
            menuContainer.innerHTML = '<div class="flex flex-col items-center justify-center py-16 text-center"><div class="text-4xl mb-4 animate-bounce">🔍</div><p class="text-gray-500">Searching...</p></div>';
            
            fetch(`{{ route('search-products') }}?q=${encodeURIComponent(searchTerm)}&format=json`)
                .then(response => response.json())
                .then(data => {
                    if (!data.products || data.products.length === 0) {
                        menuContainer.innerHTML = '<div class="flex flex-col items-center justify-center py-16 text-center"><div class="text-6xl mb-4">🔍</div><h3 class="text-xl font-bold text-gray-700 mb-2">No items found</h3><p class="text-gray-500">Try a different search term</p></div>';
                        return;
                    }
                    
                    let html = '<div class="mb-4"><h3 class="text-lg font-bold text-gray-800">🔍 Search Results</h3><p class="text-sm text-gray-500">' + data.products.length + ' item(s) found</p></div><div class="grid gap-4">';
                    
                    data.products.forEach(product => {
                        html += `<div class="product-item flex bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all" 
                                     data-id="${product.id}" 
                                     data-name="${product.name.replace(/"/g, '&quot;')}" 
                                     data-price="${product.discount_price}" 
                                     data-image="${product.image}">`;
                        // html += '<a href="/product-detail/' + product.encrypted_id + '" class="relative w-32 h-32 flex-shrink-0 overflow-hidden">';
                        html += '<a href="#' + product.encrypted_id + '" class="relative w-32 h-32 flex-shrink-0 overflow-hidden">';
                        html += '<img src="' + product.image + '" alt="' + product.name + '" class="w-full h-full object-cover" loading="lazy">';
                        if (product.trending) {
                            html += '<div class="absolute top-2 left-2 bg-red-900 text-white text-xs px-2 py-0.5 rounded-full font-medium">🔥 Popular</div>';
                        }
                        html += '</a>';
                        html += '<div class="flex-1 p-3 flex flex-col justify-between">';
                        html += '<div>';
                        html += '<div class="flex items-start justify-between gap-2">';
                        // html += '<a href="/product-detail/' + product.encrypted_id + '" class="font-semibold text-gray-800 line-clamp-1 hover:text-red-900">' + product.name + '</a>';
                        html += '<a href="#" class="font-semibold text-gray-800 line-clamp-1 hover:text-red-900">' + product.name + '</a>';
                        html += '<span class="text-red-900 font-bold whitespace-nowrap">₹' + product.discount_price + '</span>';
                        html += '</div>';
                        html += '<p class="text-sm text-gray-500 line-clamp-2 mt-1">' + (product.description || 'Delicious food item') + '</p>';
                        html += '<p class="text-xs text-red-900 mt-1">' + product.category_name + '</p>';
                        html += '</div>';
                        html += '<div class="flex items-center justify-between mt-2">';
                        if (product.price != product.discount_price) {
                            html += '<span class="text-xs text-gray-400 line-through">₹' + product.price + '</span>';
                        } else {
                            html += '<span></span>';
                        }
                        html += '<div id="product-actions-' + product.id + '" class="product-actions">';
                        html += '<button class="w-8 h-8 bg-red-900 text-white rounded-full flex items-center justify-center shadow-md hover:bg-red-600 transition-colors" onclick="quickAddToCart(' + product.id + ', \'' + product.name.replace(/'/g, "\\'") + '\', ' + product.discount_price + ', \'' + product.image + '\')">';
                        html += '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>';
                        html += '</button>';
                        html += '</div>';
                        html += '</div></div></div>';
                    });
                    
                    html += '</div>';
                    menuContainer.innerHTML = html;
                    refreshAllProductActions();
                })
                .catch(error => {
                    console.error('Search error:', error);
                    menuContainer.innerHTML = '<div class="flex flex-col items-center justify-center py-16 text-center"><div class="text-6xl mb-4">❌</div><h3 class="text-xl font-bold text-gray-700 mb-2">Search Error</h3><p class="text-gray-500">Please try again</p></div>';
                });
        }, 300);
    });
</script>
@endpush