@extends('layouts.app')
@section('customer_name', isset($username) ? $username : '')
@section('brand_name', isset($BrandName) ? $BrandName : '')
@section('content')


    <link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Dashboard') }}
        </div>
        <form method="POST" action="{{ route('dashboards.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                <div class="col-4">
                    <label>Customer Name:</label>
                </div>
                <div class="col-8">
                    <input type="text" id="userName" class="form-control" name="userName"
                        value="{{ old('userName', $item ? $item->username : '') }}" placeholder="Enter Customer Name">
                    
                    @error('userName')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>


                <div class="row mb-3">
                    <div class="col-4">
                        <label>Designation:</label>
                    </div>
                   <div class="col-8">
                        <input type="text" id="designation" class="form-control" name="designation"
                            value="{{ old('designation', $item ? $item->designation : '') }}" placeholder="Enter Designation">
                        
                        @error('designation')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-4">
                        <label>Brand Name:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="BrandName" class="form-control" name="BrandName"
                            value="{{ old('BrandName', $item ? $item->BrandName : '') }}" placeholder="Enter Brand Name">
                        
                        @error('BrandName')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-4">
                        <label>Phone no.:</label>
                    </div>
                    <div class="col-8">
                        <input type="tel" id="phone_no" class="form-control" name="phone_no"
                            value="{{ old('phone_no', $item ? (string) $item->phone_no : '') }}" placeholder="Enter Phone no.">
                        
                        @error('phone_no')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-4">
                        <label>Email:</label>
                    </div>
                    <div class="col-8">
                        <input type="email" id="email" class="form-control" name="email"
                            value="{{ old('email', $item ? $item->email : '') }}" placeholder="Enter Email">
                        
                        @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-4">
                        <label>Website:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="website" class="form-control" name="website"
                            value="{{ old('website', $item ? $item->website : '') }}" placeholder="Enter Website (e.g., https://example.com)">
                        
                        <small class="form-text text-muted fw-bold">
                            Please enter a URL with <span class="text-danger">"https:// or  http://"</span>
                        </small>

                        @error('website')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                {{-- <div class="row mb-3">
                    <div class="col-4">
                        <label>Address:</label>
                    </div>
                    <div class="col-8">
                        <textarea id="address" class="form-control" name="address" placeholder="Enter Address Here.."> {{ $item ? $item->address : '' }}</textarea>
                        @error('address')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}

                <div class="row mb-3">
                    <div class="col-4">
                        <label>Banner:</label>
                    </div>
                    <div class="col-8">
                        <input type="file" id="banner" class="form-control" name="banner"
                            value="{{ $item ? $item->filename : '' }}">
                        @error('banner')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        @if ($item)
                            <img src="{{ Storage::url($item->banner) }}" alt="" width="150">
                        @endif
                        @if (!empty($item->banner))
                            <a class="click-off ms-5" href="{{ route('member.remove_Banner_image', $item->id) }}"><i
                                    class="fa-solid fa-trash "></i></a>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label>Slogan:</label>
                    </div>
                    <div class="col-8">
                    <input type="text" id="slogan" class="form-control" name="slogan"
                        value="{{ old('slogan', $item ? $item->slogan : '') }}" placeholder="Enter slogan">
                        @error('slogan')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-4">
                        <label for="color" class="form-label">Color:</label>
                    </div>
                    <div class="col-8">
                        <input type="color" class="form-control form-control-color" id="color" name="color"
                            value="{{ $item ? $item->color : '' }}" title="Choose your color">
                    </div>
                </div>



                <div class="row mb-3">
                    <div class="col-4">
                        <label>Logo:</label>
                    </div>
                    <div class="col-8">
                        <input type="file" id="logo" class="form-control" name="logo"
                            value="{{ $item ? $item->filename : '' }}">
                        @error('logo')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($item)
                            <img class="mt-2" src="{{ Storage::url($item->logo) }}" alt="" width="50"
                                height="auto">
                        @endif
                        @if (!empty($item->logo))
                            <a class="click-off ms-5" href="{{ route('member.remove_image_home', $item->id) }}"><i
                                    class="fa-solid fa-trash "></i></a>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" value="submit" class="btn Submit_btn">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
