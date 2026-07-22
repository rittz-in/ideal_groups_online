@extends('layouts.app')

@section('content')

<div class="card mb-4">
    <div class="card-header">
        {{ __('Dashboard') }}
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-4">
                <label>UserName:</label>
            </div>
            <div class="col-8">
                <input type="text" id="userName" class="form-control" name="userName" placeholder="Enter User Name">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-4">
                <label>Designation:</label>
            </div>
            <div class="col-8">
                <input type="text" id="designation" class="form-control" name="designation" placeholder="Enter Designation">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-4">
                <label>Brand Name:</label>
            </div>
            <div class="col-8">
                <input type="text" id="BrandName" class="form-control" name="BrandName" value="{{ $item->BrandName }}" placeholder="Enter Branch Name">
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-4">
                <label>Phone no.:</label>
            </div>
            <div class="col-8">
                <input type="number" id="phone_no" class="form-control" name="phone_no" placeholder="Enter Phone no.">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-4">
                <label>Email:</label>
            </div>
            <div class="col-8">
                <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-4">
                <label>Website:</label>
            </div>
            <div class="col-8">
                <input type="text" id="website" class="form-control" name="website" placeholder="Enter Website">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-4">
                <label>Address:</label>
            </div>
            <div class="col-8">
                <textarea name="address" form="" class="form-control" placeholder="Enter Address Here.."> </textarea>
            </div>
        </div>

    </div>
</div>
@endsection