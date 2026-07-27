@if ($VarientType['type'] == 'VarientType')


    @foreach ($getProductVarientTypes as $getProductVarientType)
        <div class="row">
            <div class="mb-3 col-md-3">
                <label for="dropdown" class="form-label">Varient Type</label>
                <select class="form-select" id="varient_types" name="varient_type[]">
                    <option value="">Select Varient Type</option>
                    <option value="{{ $getProductVarientType->id }}" selected>
                        {{ $getProductVarientType->variant_sizes }}</option>
                </select>
            </div>

            <div class="mb-3 col-md-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="varientPrice" name="varientPrice[]" value=""
                    required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="price" class="form-label">Discount Price</label>
                <input type="text" class="form-control" id="varientDiscountPrice" name="varientDiscountPrice[]"
                    value="" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="VarientImages" class="form-label">Varient Images</label>
                <input type="file" class="form-control" id="varient_images" name="varient_images[]">
            </div>
        </div>
    @endforeach



@endif
