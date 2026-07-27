<x-app-layout>

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card p-5">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Add Coupon</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('coupon_code.index') }}" class="btn btn-dark btn-primary">
                                        Coupon Lists
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if ($page_data['form_title'] == 'Add New Coupon')
                                    <form action="{{ route('app-coupon_code-store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                    @else
                                        <form action="{{ route('app-coupon_code-update', encrypt($coupon->id)) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                @endif
                                {{-- {{ dd($category) }} --}}
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="name" class="form-label">Coupon Title</label>
                                        <input type="text" class="form-control" id="coupon_title" name="coupon_title"
                                            value="{{ old('coupon_title') ?? ($coupon != '' ? $coupon->coupon_name : '') }}">
                                        <span class="text-danger">
                                            @error('coupon_title')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-5">
                                        <label for="name" class="form-label">Coupon Code</label>
                                        <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                                            value="{{ old('coupon_code') ?? ($coupon != '' ? $coupon->coupon_code : '') }}">
                                        <span class="text-danger">
                                            @error('coupon_code')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 mt-4 col-md-3">
                                        <label for="name" class="form-label"></label>
                                        <button type="button" class="btn btn-primary" id="generateCouponCode">Auto
                                            Generated</button>
                                    </div>


                                    <div class="mb-3 col-md-4">
                                        <label for="parent_id" class="form-label">Coupon Type</label>
                                        <select class="form-select" id="parent_id" name="coupon_type">
                                            <option value="">Select Coupon Type</option>
                                            <option value="Fix"
                                                {{ old('coupon_type') == 'Fix' || ($coupon != '' && $coupon->coupon_type == 'Fix') ? 'selected' : '' }}>
                                                Fix</option>
                                            <option value="Percentage"
                                                {{ old('coupon_type') == 'Percentage' || ($coupon != '' && $coupon->coupon_type == 'Percentage') ? 'selected' : '' }}>
                                                Percentage</option>
                                        </select>

                                        <span class="text-danger">
                                            @error('coupon_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="parent_id" class="form-label">Amount</label>
                                        <input type="text" class="form-control" id="coupon_amount"
                                            name="coupon_amount"
                                            value="{{ old('coupon_amount') ?? ($coupon != '' ? $coupon->amount : '') }}">
                                        <span class="text-danger">
                                            @error('coupon_amount')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="parent_id" class="form-label">Minimum Order Amount</label>
                                        <input type="text" class="form-control" id="minimum_order"
                                            name="minimum_order"
                                            value="{{ old('minimum_order') ?? ($coupon != '' ? $coupon->min_order_amount : '') }}">
                                        <span class="text-danger">
                                            @error('minimum_order')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="parent_id" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            value="{{ old('start_date') ?? ($coupon != '' ? $coupon->start_date : '') }}">
                                        <span class="text-danger">
                                            @error('start_date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="parent_id" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            value="{{ old('end_date') ?? ($coupon != '' ? $coupon->end_date : '') }}">
                                        <span class="text-danger">
                                            @error('coupon_amount')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>


                                    {{-- <div class="mb-3 col-md-12">

                                        <label for="parent_id" class="form-label">Select Product</label>
                                        <select class="form-select multiproducts" id="parent_id" name="product[]"
                                            multiple>
                                            <option value="">Select Products</option>
                                            @foreach ($products as $product)
                                                @php
                                                    $product_selected = '';
                                                    if ($coupon != '') {
                                                        $product_ids = explode(',', $coupon->product_id);
                                                        $product_selected = in_array($product->id, $product_ids)
                                                            ? 'selected'
                                                            : '';
                                                    } else {
                                                        $product_selected = '';
                                                    }
                                                @endphp
                                                <option value="{{ $product->id }}" {{ $product_selected }}>
                                                    {{ $product->product_name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <span class="text-danger">
                                            @error('product')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}
                                    <div class="mb-3 col-md-12">
                                        <label for="parent_id" class="form-label">Select Product</label>
                                        <select class="form-select select2 multiproducts" id="parent_id"
                                            name="product[]" multiple>
                                            <option value="">Select Products</option>
                                            @foreach ($products as $product)
                                                @php
                                                    $product_selected = '';
                                                    if ($coupon != '') {
                                                        $product_ids = explode(',', $coupon->product_id);
                                                        $product_selected = in_array($product->id, $product_ids)
                                                            ? 'selected'
                                                            : '';
                                                    } else {
                                                        $product_selected = '';
                                                    }
                                                @endphp
                                                <option value="{{ $product->id }}" {{ $product_selected }}>
                                                    {{ $product->product_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <span class="text-danger">
                                            @error('product')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>



                                    <div class="mb-3 col-md-12">
                                        <label for="parent_id" class="form-label">Per User Usage</label>
                                        <input type="text" class="form-control" id="end_date"
                                            name="per_user_use"
                                            value="{{ old('per_user_use') ?? ($coupon != '' ? $coupon->per_user_uses : '') }}">
                                        <span class="text-danger">
                                            @error('coupon_amount')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>




                                    <div class="mb-3 col-md-3">
                                        <label for="status" class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status"
                                                name="status" checked
                                                {{ $coupon != '' && $coupon->status == 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">Active</label>
                                        </div>
                                    </div>


                                    <div class="col-dm-6 text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>




{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Products",
            allowClear: true
        });
    });
</script>

<script>
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#start_date').attr('min', maxDate);
        $('#end_date').attr('min', maxDate);
    });





    $(document).ready(function() {
        $('#generateCouponCode').on('click', function() {
            // Generate a random string for the coupon code
            var couponCode = generateCouponCode();
            // Set the generated code to the input field
            $('#coupon_code').val(couponCode);
        });

        function generateCouponCode() {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var length = 8;
            var couponCode = '';
            for (var i = 0; i < length; i++) {
                couponCode += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return couponCode;
        }
    });
</script>
