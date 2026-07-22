@extends('layouts.app')

@section('customer_name', isset($username) ? $username : '')

@section('brand_name', isset($BrandName) ? $BrandName : '')

@section('content')


<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

<div class="card mb-4">
    <div class="card-header">
        {{ __('Dashboard') }}
    </div>
    
        <div class="card-body">

            <h1 class="not_found_text">Please Fill Your data First</h1>

        </div>
</div>
@endsection