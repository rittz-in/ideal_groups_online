@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')
<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

<div class="card mb-4">
    <div class="card-header">
        {{ __('Inquiry') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    {{-- <th scope="col">Phone</th> --}}
                    {{-- <th scope="col">Email</th> --}}
                    <th scope="col">Topic</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @if($inquirydata->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No data found</td>
                </tr>
            @else
                @foreach ($inquirydata as $inquiry)
                <tr>
                    <td>{{ $inquiry->name }}</td>
                    {{-- <td>{{ $inquiry->phone }}</td> --}}
                    {{-- <td>{{ $inquiry->email }}</td> --}}
                    <td>{{ $inquiry->topic }}</td>
                    <td>{{ $inquiry->Description }}</td>
                    <td>
                        <form action="{{ route('inquiry.destroy', $inquiry->id) }}" method="Post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn inquiry-delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

    </div>


</div>
@endsection