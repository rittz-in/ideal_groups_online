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

         @if($data['form_title'] == "Add New Video")
            <form method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data">
                @csrf
                @else
                <form method="POST" action="{{ route('videos.update', $video->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"><strong>Title:</strong></label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title') ? old('title') : ($video ? $video->title : '') }}">
                                @error('title')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube_link"><strong>Video Link:</strong></label>
                                <input type="text" name="youtube_link" class="form-control" id="youtube_link" placeholder="Video Link" value="{{ old('youtube_link') ? old('youtube_link') : ($video ? $video->youtube_link : '') }}">
                                @error('youtube_link')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mt-2 text-center">
                            <button type="submit" class="btn mb-3 Submit_btn">Submit</button>
                        </div>
                </form>
    </div>
</div>
</div>
@endsection