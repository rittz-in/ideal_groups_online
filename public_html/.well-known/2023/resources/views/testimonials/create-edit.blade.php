@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<div class="card mb-4">
    <div class="card-header">
      {{$data['form_title']}}
    </div>

    <div class="card-body">

        @if($data['form_title'] == "Add New Testimonials")
            <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
                @csrf
                @else
                <form method="POST" action="{{ route('testimonials.update', $testimonial->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description"><strong>Description:</strong></label>
                                <textarea name="description" class="form-control" placeholder="description">{{ old('description') ? old('description') : ($testimonial ? $testimonial->description : '') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="auther"><strong>Author:</strong></label>
                                <input type="text" name="auther" value="{{ old('auther') ? old('auther') : ($testimonial ? $testimonial->auther : '') }}" class="form-control" placeholder="auther">
                                @error('auther')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image"><strong>Profile</strong></label>
                                <input type="file" id="image" class="form-control" name="image">
                                @error('image')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror

                                @if($testimonial && $testimonial->image)

                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Testimonial Image" class="img-thumbnail" width="100">
                                    @if (!empty($testimonial->image))
                                    <a class="click-testimonials ms-5" href="{{ route('member.remove_image_testimonials', $testimonial->id) }}"><i class="fa-solid fa-trash"></i></a>
                                    @endif
									
                                    @error('auther')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                            @endif
                            
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="designation"><strong>Designation</strong></label>
                                <input type="text" name="designation" value="{{ old('designation') ? old('designation') : ($testimonial ? $testimonial->designation : '') }}" class="form-control" placeholder="designation">
                                @error('designation')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-12 mt-2 text-center">
                        <button type="submit" class="btn Submit_btn">Submit</button>
                    </div>
                </form>
    </div>
</div>
@endsection