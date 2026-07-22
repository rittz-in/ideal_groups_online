@extends('layouts.app')

@section('customer_name', $username)

@section('brand_name', $BrandName)

@section('content')
<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">
<div class="card mb-4">
    <div class="card-header">
        {{ __('Links') }}
    </div>
    <form method="POST" action="{{ route('links.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-4">
                    <label>Facebook:</label>
                </div>
                <div class="col-8">
                    <input type="text" id="facebook" class="form-control" name="facebook" placeholder="Enter Facebook Link" value="{{ $links->facebook ?? '' }}">
                    @error('facebook')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label>Instagram:</label>
                </div>
                <div class="col-8">
                    <input type="text" id="instagram" class="form-control" name="instagram" placeholder="Enter instagram Link" value="{{ $links->instagram ?? '' }}">
                    @error('instagram')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label>Twitter:</label>
                </div>
                <div class="col-8">
                    <input type="text" id="twitter" class="form-control" name="twitter" placeholder="Enter twitter Link" value="{{ $links->twitter ?? '' }}">
                    @error('twitter')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label>Linkedin:</label>
                </div>
                <div class="col-8">
                    <input type="text" id="linkedin" class="form-control" name="linkedin" placeholder="Enter linkedin Link" value="{{ $links->linkedin ?? '' }}">
                    @error('linkedin')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label>Youtube:</label>
                </div>
                <div class="col-8">
                    <input type="text" id="youtube" class="form-control" name="youtube" placeholder="Enter youtube Link" value="{{ $links->youtube ?? '' }}">
                    @error('youtube')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-4">
                    <label>Pinterest:</label>
                </div>
                <div class="col-8">
                    <input type="text" id="pinterest" class="form-control" name="pinterest" placeholder="Enter pinterest Link"  value="{{ $links->pinterest ?? '' }}">
                    @error('pinterest')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn Submit_btn">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection