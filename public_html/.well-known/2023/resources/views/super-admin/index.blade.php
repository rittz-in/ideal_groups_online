@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')
<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">
<div class="pull-right mb-2 d-flex justify-content-end">
    <a class="btn Submit_btn" href="{{ route('super-admin.create') }}">Add New Customers</a>
</div>
{{-- @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif --}}
                
<div class="card mb-4">
    <div class="card-header">
        {{ __('Customers') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Card No</th>
                    <th scope="col">Action</th>
                    <th scope="col">View Website</th>

                </tr>
            </thead>
            <tbody>
                @if($users->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No data found</td>
                </tr>
            @else
                @foreach ($users as $userdata)
                <tr>
                    <td>{{ $userdata->name}}</td>
                    <td>{{ $userdata->email }}</td>
                    <td>{{ $userdata->created_at }}</td>
                    <td>{{ $userdata->card_no }}</td>
                    <td>
                        <form action="{{ route('super-admin.destroy', $userdata->id) }}" method="POST">
                            <a class="btn" href="{{ route('super-admin.edit', $userdata->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete-btn" data-confirm="Are you sure you want to delete this user?"><i class="fa-solid fa-trash"></i></button>

                        </form>
                    </td>

                    <td>
                        @if(!empty($userdata->card_no))
                            <a class="btn" href="{{ route('website_url', $userdata->card_no) }}" target="_blank">
                                <img src="{{ asset('assets/eye.png') }}" height="25" width="25" alt="">
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

    </div>
</div>
@endsection