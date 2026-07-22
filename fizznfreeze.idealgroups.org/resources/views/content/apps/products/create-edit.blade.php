@extends('layouts/layoutMaster')

@section('title', $page_data['page_title'])

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('page-style')
    {{-- Page Css files --}}
@endsection

@section('content')

    @if ($page_data['form_title'] == 'Add New Product')
        <form action="{{ route('app-products-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        @else
            <form action="{{ route('app-products-update', encrypt($product->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    @endif

    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $page_data['form_title'] }}</h4>
                        <a href="{{ route('app-products-list') }}" class="col-md-2 btn btn-primary float-end">Product List</a>

                        {{-- <h4 class="card-title">{{$page_data['form_title']}}</h4> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-1">
                                <label class="form-label" for="name">
                                    Name</label>
                                <input type="text" id="name" class="form-control" placeholder="name"
                                    name="name" value="{{ old('name') ?? ($product != '' ? $product->name : '') }}">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-1">
                                <label class="form-label" for="name">
                                    Description</label>
                                <textarea type="text" id="name" class="form-control" placeholder="description"
                                    name="description" >{{ old('description') ?? ($product != '' ? $product->description : '') }}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <div class="col-md-6 col-sm-12 mb-1">
                                <label class="form-label" for="category_id">
                                    Category</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ (old('category_id') == $category->id) || ($product != '' && $product->category_name == $category->name) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-1">   
                                <label class="form-label" for="price">
                                    Price</label>
                                <input type="text" id="price" class="form-control" placeholder="price"
                                    name="price"
                                    value="{{ old('price') ?? ($product != '' ? $product->price : '') }}">
                                <span class="text-danger">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-1">   
                                <label class="form-label" for="discount_price">
                                    Discount Price</label>
                                <input type="text" id="discount_price" class="form-control" placeholder="Discount Price"
                                    name="discount_price"
                                    value="{{ old('discount_price') ?? ($product != '' ? $product->discount_price : '') }}">
                                <span class="text-danger">
                                    @error('discount_price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-1">   
                                <label class="form-label" for="product_image">
                                    Product Image</label>
                                <input type="file" id="product_image" class="form-control" placeholder="product_image"
                                    name="product_image"
                                    value="{{ old('product_image') ?? ($product != '' ? $product->product_image : '') }}">
                                <span class="text-danger">
                                    @error('product_image')
                                        {{ $message }}
                                    @enderror
                                </span>
                                @if ($product != '' && $product->product_image)
                                    <div class="mt-2" id="image-container">
                                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image" width="100">
                                        <a href="javascript:void(0)" class="text-danger ms-2" id="delete-image-btn" data-id="{{ encrypt($product->id) }}"><i data-feather="trash-2"></i><i class="fa fa-trash"></i></a>
                                    </div>
                                @endif
                            </div>


                            

                            <div class="col-md-6 col-sm-12 mb-1">
                                <label class="form-label" for="status">
                                    Status</label>
                                <div class="form-check form-check-success form-switch">
                                    <input type="checkbox" name="status" value="active"
                                        {{ $product != '' && $product->status == 'active' ? 'checked' : '' }}
                                        class="form-check-input" id="status" />
                                </div>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <div class="col-md-6 col-sm-12 mb-1">
                                <label class="form-label" for="trending">
                                    Trending</label>
                                <div class="form-check form-check-success form-switch">
                                    <input type="checkbox" name="trending" value="1"
                                        {{ $product != '' && $product->trending ? 'checked' : '' }}
                                        class="form-check-input" id="trending" />
                                </div>
                                <span class="text-danger">
                                    @error('trending')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            
                           
                           
                           
                        </div>

                        <div class="col-12">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary me-1">Submit
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script>
        $(document).ready(function() {
            $('#category_id').select2();
        });

        $(document).on("click", "#delete-image-btn", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this image?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url:  "{{ url('app/products/delete-image') }}/" + id,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                $('#image-container').remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Image has been deletion.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Something went wrong.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
