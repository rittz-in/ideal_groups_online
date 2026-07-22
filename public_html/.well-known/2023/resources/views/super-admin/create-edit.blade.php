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

        @if($data['form_title'] == "Add New Customers")
            <form method="POST" action="{{ route('super-admin.store') }}" enctype="multipart/form-data">
                @csrf
                @else
                <form method="POST" action="{{ route('super-admin.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" value="{{ old('name') ? old('name') : ($user ? $user->name : '') }}" class="form-control" placeholder="name">
                                @error('name')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="Email" name="email" value="{{ old('email') ? old('email') : ($user ? $user->email : '') }}" class="form-control" placeholder="email">
                                @error('email')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="card_no">Card No:</label>
                                <input type="text" name="card_no" value="{{ old('card_no') ? old('card_no') : ($user ? $user->card_no : '') }}" class="form-control" placeholder="card_no">
                                @error('card_no')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" value="{{ old('password') ? old('password') : ($user ? $user->password : '') }}" class="form-control" placeholder="password">
                                @error('password')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-12 mt-2 text-center">
                        <button type="submit" class="btn mb-3 Submit_btn">Submit</button>
                    </div>
                </form>
            </form>
    </div>
</div>
@endsection