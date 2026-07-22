@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')
<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">
<div class="pull-right mb-2 d-flex justify-content-end">
    <a class="btn" style="background-color: #BC3A24; color: white;" href="{{ route('services.create') }}"> Add New Service</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        {{ __('Services') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Service Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
                    <tbody>
                        @if($services->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No data found</td>
                        </tr>
                    @else
            @foreach ($services as $service)
            
            <tr>
                <td>{{ $service->service_name }}</td>
                <td>{{ $service->description }}</td>
              
                <td>
                    @if (!empty($service->logo))
                        <img src="{{ Storage::url($service->logo)}}" alt="{{ $service->title }}" width="100">
                    @endif
                </td>
                <td>
                    <form action="{{ route('services.destroy', $service->id) }}" method="Post">
                        <a class="btn" href="{{ route('services.edit', $service->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn click-service"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>

        </table>

    </div>

    <div class="card-footer">
        {{ $services->links() }}
    </div>
</div>
@endsection