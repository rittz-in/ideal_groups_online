<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card p-5">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    @if ($page_data['form_title'] == 'Add New Product')
                                        <h5 class="">Add Product</h5>
                                    @else
                                        <h5 class="">Edit Product</h5>
                                    @endif
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('product.index') }}" class="btn btn-dark btn-primary">
                                        Product List
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



                                @if ($page_data['form_title'] == 'Add New Product')
                                    <form action="{{ route('app-product-store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                    @else
                                        <form action="{{ route('app-product-update', encrypt($product->id)) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                @endif





                                <div class="row">


                                    <div class="mb-3 col-md-12">
                                        <label for="dropdown" class="form-label">Select Category</label>
                                        <select class="form-select" id="category" name="category">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $product != '' ? ($category->id == $product->category_id ? 'selected' : '') : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                            <!-- Add more options as needed -->
                                        </select>

                                        <span class="text-danger">
                                            @error('category')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="dropdown" class="form-label">Select Sub Category</label>
                                        <select class="form-select subParentcategory" id="sub_category"
                                            name="sub_category">
                                            <option value="">Select Sub Category</option>

                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}"
                                                    {{ $product != '' ? ($sub_category->id == $product->sub_cat_id ? 'selected' : '') : '' }}>
                                                    {{ $sub_category->name }}</option>
                                            @endforeach



                                            <!-- Add more options as needed -->
                                        </select>

                                    </div> --}}

                                    <div class="mb-3 col-md-4">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            value="{{ old('product_name') ?? ($product != '' ? $product->product_name : '') }}">
                                        <span class="text-danger">
                                            @error('product_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>




                                    <div class="mb-3 col-md-4">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" id="price" name="price"
                                            value="{{ old('price') ?? ($product != '' ? $product->price : '') }}">
                                        <span class="text-danger">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="discount_price" class="form-label">Discount Price</label>
                                        <input type="text" class="form-control" id="discount_price"
                                            name="discount_price"
                                            value="{{ old('discount_price') ?? ($product != '' ? $product->discount_price : '') }}">

                                    </div>



                                    <div class="mb-3 col-md-12">

                                        <label for="discount_price" class="form-label">Feature Image</label>
                                        <input type="file" class="form-control" id="feature_image"
                                            name="feature_image">
                                        <span class="text-danger">
                                            @error('feature_image')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>




                                    <div class="mb-3 col-md-12">

                                        <label for="discount_price" class="form-label">Product Images</label>
                                        <input type="file" class="form-control" id="product_images"
                                            name="product_images[]" multiple>
                                        <span class="text-danger">
                                            @error('product_images')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-12">


                                        <div class="row">
                                            @if ($productsImages != '')
                                                @foreach ($productsImages as $productsImage)
                                                    <div class="col-md-3 col-sm-3">
                                                        <div class="setHeight">
                                                            <img src="{{ asset(isset($productsImage->images) ? $productsImage->images : old('product_images')) }}"
                                                                alt="" class="blog-image mt-3 pl-2"
                                                                height="auto" width="100%">
                                                        </div>
                                                        <p class="mt-3">
                                                            <a class="btn btn-danger btn-sm removeimage"
                                                                data-toggle='tooltip' data-placement='top'
                                                                title='Delete Images'
                                                                href="{{ route('app-product-photos', ['encrypted_id' => encrypt($productsImage->id)]) }}"
                                                                onclick="return RemoveProductImage('Are you sure you want to remove Product Image', this)"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-x-circle">
                                                                    <circle cx="12" cy="12" r="10">
                                                                    </circle>
                                                                    <line x1="15" y1="9"
                                                                        x2="9" y2="15"></line>
                                                                    <line x1="9" y1="9"
                                                                        x2="15" y2="15"></line>
                                                                </svg></a>
                                                        </p>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                    </div>



                                    <div class="mb-3 col-md-12">
                                        <label for="short_description" class="form-label">Short Description</label>
                                        <textarea class="ckeditor form-control" id="short_description" name="short_description" rows="3">{{ old('short_description') ?? ($product != '' ? $product->short_description : '') }}</textarea>
                                        <span class="text-danger">
                                            @error('short_description')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="ckeditor form-control" id="description" name="description" rows="3">{{ old('description') ?? ($product != '' ? $product->description : '') }}</textarea>
                                        <span class="text-danger">
                                            @error('description')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="dropdown" class="form-label">Product Type</label>
                                        <select class="form-select" id="product_type" name="product_type">

                                            <option value="Simple"
                                                {{ $product != '' && $product->product_type == 'Simple' ? 'selected' : '' }}>
                                                Simple</option>
                                            <option value="Varient"
                                                {{ $product != '' && $product->product_type == 'Varient' ? 'selected' : '' }}>
                                                Varient</option>

                                            <!-- Add more options as needed -->
                                        </select>

                                        <span class="text-danger">
                                            @error('product_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    @if ($product != '' && $product->product_type == 'Varient')
                                        @php
                                            $displayStatus = 'block';
                                        @endphp
                                    @else
                                        @php
                                            $displayStatus = 'none';
                                        @endphp
                                    @endif

                                    <div class="varientNameSection" style="display:{{ $displayStatus }};">
                                        <div class="mt-3 mb-3 col-md-12">
                                            <h5>Product Varients</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="dropdown" class="form-label">Varient Name</label>
                                                    <select class="form-select" id="varient_name"
                                                        name="varient_name">
                                                        <option value="">Select Varient Name</option>
                                                        @foreach ($productVarients as $productVarient)
                                                            @if ($product != '' && $product->product_varient_id == $productVarient->id)
                                                                @php
                                                                    $selected = 'selected';
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $selected = '';
                                                                @endphp
                                                            @endif
                                                            <option value="{{ $productVarient->id }}"
                                                                {{ $selected }}>
                                                                {{ $productVarient->varient_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button"
                                                        class="btn btn-primary varientCreate">Create</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="varientTypeSection" style="display:{{ $displayStatus }};"></div>

                                    @if (!empty($VarientTypeDetails))
                                        @foreach ($VarientTypeDetails as $VarientTypeDetail)
                                            <input type="hidden" id="detailsId" name="detailsId[]"
                                                value="{{ $VarientTypeDetail->detailsId }}">
                                            <div class="row">
                                                <div class="mb-3 col-md-2">
                                                    <label for="dropdown" class="form-label">Varient Type</label>
                                                    <select class="form-select" id="varient_types"
                                                        name="varient_type[]">
                                                        <option value="">Select Varient Type</option>
                                                        <option value="{{ $VarientTypeDetail->id }}" selected>
                                                            {{ $VarientTypeDetail->variant_sizes }}</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-md-2">
                                                    <label for="price" class="form-label">Price</label>
                                                    <input type="text" class="form-control" id="varientPrice"
                                                        name="varientPrice[]" value="{{ $VarientTypeDetail->price }}"
                                                        required>
                                                </div>


                                                <div class="mb-3 col-md-2">
                                                    <label for="price" class="form-label">Discount Price</label>
                                                    <input type="text" class="form-control"
                                                        id="varientDiscountPrice" name="varientDiscountPrice[]"
                                                        value="{{ $VarientTypeDetail->discount_price }}" required>
                                                </div>

                                                <div class="mb-3 col-md-4">
                                                    <label for="VarientImages" class="form-label">Varient
                                                        Images</label>
                                                    <input type="file" class="form-control" id="varient_images"
                                                        name="varient_images[]" value="">
                                                </div>

                                                <div class="mb-3 col-md-2">

                                                    <div class="setHeight">
                                                        <img src="{{ asset($VarientTypeDetail->images) }}"
                                                            alt="" class="blog-image mt-3 pl-2"
                                                            height="auto" width="100%">
                                                    </div>
                                                </div>


                                            </div>
                                        @endforeach
                                    @endif






                                    <div class="mb-3 col-md-3">
                                        <label for="status" class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status"
                                                name="status" checked>
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

<style>
    .varientCreate {
        margin-top: 30px;
    }

    .cke_notifications_area {
        display: none !important;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function RemoveProductImage(message, link) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href = link.href;
            }
        });

        return false;
    }

    $(document).ready(function() {

        $("#product_type").change(function() {
            $val = $(this).val();

            if ($val == 'Varient') {
                $(".varientNameSection").show();
            } else {
                $(".varientNameSection").hide();
            }
        });


        $("#varient_name").change(function() {
            $(".varientTypeSection").hide();
        });



        $("#category").change(function() {
            var catid = $(this).val();


            $.ajax({
                url: '{{ route('app-product-get-subCatParentall', ['id' => 'catid']) }}'
                    .replace(
                        'catid', catid),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('.subParentcategory').html(response);
                },
                error: function(error) {
                    console.error('Error fetching records:', error);
                }
            });

        });


        $(".varientCreate").click(function() {

            var varientId = $("#varient_name").val();

            $.ajax({
                url: '{{ route('app-product-get-varient-types', ['id' => 'varientId']) }}'
                    .replace(
                        'varientId', varientId),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    //$('.subParentcategory').html(response);

                    $(".varientTypeSection").show();
                    $(".varientTypeSection").html(response);

                },
                error: function(error) {
                    console.error('Error fetching records:', error);
                }
            });





        });










    });
</script>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
