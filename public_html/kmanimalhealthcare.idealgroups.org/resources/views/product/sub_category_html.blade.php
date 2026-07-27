@if ($catType['cate_type'] == 'Sub Category')

    @foreach ($getSubParentCategories as $getSubParentCategory)
        <option value="{{ $getSubParentCategory->id }}">{{ $getSubParentCategory->name }}</option>
    @endforeach

@endif

@if ($catType['cate_type'] == '')
    <option value="">Select Sub Category</option>
@endif
