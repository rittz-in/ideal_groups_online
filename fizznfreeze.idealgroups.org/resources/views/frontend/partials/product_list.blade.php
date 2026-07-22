@foreach($products as $product)
<li class="product-item" 
    data-id="{{ $product->id }}" 
    data-name="{{ $product->name }}" 
    data-price="{{ $product->discount_price }}"
    data-image="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('FrontAssets/images/food1.png') }}">
    <div class="item-content">
        <div class="item-inner">
            <div class="item-title-row">
                <h6 class="item-title">
                    <a href="{{ route('product-detail', encrypt($product->id)) }}">{{ $product->name }}</a>
                </h6>
                <div class="item-subtitle">{{ $product->description ?? 'Delicious food item' }}</div>
            </div>
            <div class="item-footer">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="price-section">
                        <h6 class="me-2 product-price">₹ {{ $product->discount_price }}</h6>
                        @if($product->price != $product->discount_price)
                        <del class="off-text"><h6>₹ {{ $product->price }}</h6></del>
                        @endif
                    </div>
                </div>    
            </div>
            <div class="cart-controls d-flex align-items-center">
                <div class="dz-stepper me-2">
                    <input class="stepper product-qty" type="text" value="1" min="1" max="10" name="qty_{{ $product->id }}">
                </div>
                <button class="btn btn-sm btn-add-cart" onclick="addToCart(this)">
                    Select
                </button>
            </div>
        </div>
        <div class="item-media media media-90">
            <img src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('FrontAssets/images/food1.png') }}" alt="{{ $product->name }}">
        </div>
    </div>
</li>
@endforeach
@if($products->isEmpty())
<li class="p-4 text-center">No products found.</li>
@endif
