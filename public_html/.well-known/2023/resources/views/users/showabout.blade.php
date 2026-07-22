@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')
<div class="card mb-4">
    <div class="card-header">
        {{ __('About us') }}
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="showabout" enctype="multipart/form-data">
                                @csrf
                                @foreach ( $showabout as $data )

                                <div class="form-group">
                                    <label><strong>About Us:</strong></label>
                                    <textarea class="ckeditor form-control" name="about_us">{{$data->about_us }}</textarea>
                                </div>
                                @endforeach

                                {{-- <div class="form-group text-center">
                                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                                    </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection