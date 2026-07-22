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

        @if($data['form_title'] == "Add New Service")
            <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
                @csrf
                @else
                <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Service Name:</strong>
                                <input type="text" name="service_name" class="form-control" value="{{ old('service_name') ? old('service_name') : ($service ? $service->service_name : '') }}" placeholder="Service Name">
                                @error('service_name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Whatsapp No.</strong>
                                <input type="text" name="whatsapp_no" class="form-control" value="{{ old('whatsapp_no') ? old('whatsapp_no') : ($service ? $service->whatsapp_no : '') }}" placeholder="Whatsapp No.">
                                @error('whatsapp_no')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <textarea name="description" class="form-control" placeholder="Description">{{ old('description') ? old('description') : ($service ? $service->description : '') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Image:</strong>
                                <input type="file" id="logo" class="form-control" name="logo" value="{{  $service ? $service->logo : ''}}">
                                @if ($service && $service->logo)
                                    <img src="{{ Storage::url($service->logo) }}" alt="" width="150">
                                    @if (!empty($service->logo))
                                    <a class="click-service ms-5" href="{{ route('member.remove_image_service', $service->id) }}"><i class="fa-solid fa-trash "></i></a>
                                    @endif
                                @endif
                                @error('logo')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="col-12 mt-2 text-center mb-3">
                        <button type="submit" class="btn Submit_btn">Submit</button>
                    </div>
                </form>
    </div>
</div>
@endsection