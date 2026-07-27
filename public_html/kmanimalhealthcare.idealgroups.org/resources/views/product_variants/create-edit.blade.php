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
                                    @if ($page_data['form_title'] == 'Add New Product Varient')
                                        <h5 class="">Add Product Varient</h5>
                                    @else
                                        <h5 class="">Edit Product Varient</h5>
                                    @endif
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('product_variants.index') }}" class="btn btn-dark btn-primary">
                                        Product varient Lists
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



                                @if ($page_data['form_title'] == 'Add New Product Varient')
                                    <form action="{{ route('app-product_variants-store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                    @else
                                        <form
                                            action="{{ route('app-product_variants-update', encrypt($product_varients->id)) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                @endif


                                <input type="hidden" name="deleted_ids" value="" id="deleted_ids">


                                <div class="row">




                                    <div class="mb-3 col-md-12">
                                        <label for="name" class="form-label">Varient Name</label>
                                        <input type="text" class="form-control" id="variant_name" name="variant_name"
                                            value="{{ old('variant_name') ?? ($product_varients != '' ? $product_varients->varient_name : '') }}">
                                        <span class="text-danger">
                                            @error('product_varient')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>


                                    @if (!empty($varientTypes))
                                        @php
                                            $i = 1;
                                        @endphp

                                        @foreach ($varientTypes as $varientType)
                                            <div class="row praposal_clone" id="dynamic{{ $i }}">
                                                <div class="mb-3 col-md-6">
                                                    <input type="hidden" name="content_index[]" value="">
                                                    <label for="price" class="form-label">Type</label>
                                                    <input type="text" class="form-control" id="varient_type"
                                                        name="varient_type[]" value="{{ $varientType->variant_sizes }}">

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <div class="col-md-2 col-sm-2 mt-4 fv-row">
                                                        <input type="hidden" name="detail_index[]"
                                                            class="deleted_index" value="{{ $varientType->id }}">
                                                        <button type="button" id="{{ $i }}"
                                                            class="btn btn-danger removeBtn remove_dynamic_data">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @else
                                        <div class="mb-3 col-md-6">
                                            <label for="price" class="form-label">Type</label>
                                            <input type="text" class="form-control" id="varient_type"
                                                name="varient_type[]" value="" required>

                                        </div>
                                        <div class="mb-3 col-md-6"></div>
                                    @endif

                                    <div id="add_data"></div>

                                    <div class="col-lg-12 mb-3">
                                        <div class="fv-row">
                                            <button type="button" id="add" class="btn btn-primary ml-3 mb-2">Add
                                                More</button>
                                        </div>
                                    </div>




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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {

        var i = 0;
        $("#add").click(function() {
            var id = $(".praposal_clone").length + 1;
            $("#add_data").append(
                '<div class="row praposal_clone mb-1" id="row' + i + '">' +
                '<div class="mb-3 col-md-6">' +
                '<input type="hidden" name="content_index[]" value="">' +
                '<label for="price" class="form-label">Type</label>' +
                '<input type="text" class="form-control" id="varient_type" name="varient_type[]" required>' +
                '</div>' +
                '<div class="mb-3 col-md-6">' +
                '<div class="col-md-2 col-sm-2 mt-1">' +
                '<input type="hidden" name="detail_index[]" class="deleted_index" value="">' +
                '<button type="button" id="' + i +
                '"  class="btn btn-danger removeBtn remove_data mt-4">Remove</button>' +
                '</div>' +

                '</div>' +

                '</div>');



            i++;
        });

        $(document).on('click', '.remove_data', function() {
            $ids = $(this).attr('id');
            $('#row' + $ids + '').remove();
        });

        let deleted_ids = [];
        $(document).on('click', '.remove_dynamic_data', function() {
            $ids = $(this).attr('id');
            $(this).parents('#dynamic' + $ids + '').remove();

            // // Dhruvil code start
            var id = $(this).parents('.fv-row').find('[name="detail_index[]"]').val();

            deleted_ids.push(id);
            var deletedId = deleted_ids.join(',');

            $("#deleted_ids").val(deletedId);
        });




    });
</script>
