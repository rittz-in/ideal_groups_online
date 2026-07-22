@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')
<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">
@if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif
<div class="pull-right mb-2 d-flex justify-content-end">
    <a class="btn" style="background-color: #BC3A24; color: white;" href="{{ route('testimonials.create') }}"> Add New testimonials</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        {{ __('Testimonials') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Author</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @if($testimonials->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No data found</td>
                </tr>
            @else
                @foreach ($testimonials as $testimonial)
                <tr>
                    <td>{{ $testimonial->description}}</td>
                    <td>{{ $testimonial->auther }}</td>
                    <td>{{ $testimonial->designation }}</td>
                    <td><img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->title }}" width="100"></td>
                    <td>
                        <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="Post">
                            <a class="btn" href="{{ route('testimonials.edit', $testimonial->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn click-testimonials"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

    </div>

    <div class="card-footer">
        {{ $testimonials->links() }}
    </div>
</div>
@endsection