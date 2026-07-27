@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')
<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

<div class="pull-right mb-2 d-flex justify-content-end">
    @if($checkdata == "")
    <a class="btn" style="background-color: #BC3A24; color: white;" href="{{ route('contacts.create') }}"> Add New Contact</a>
    @endif
</div>
<div class="card mb-4">
    <div class="card-header">
        {{ __('Contact') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Branch name</th>
                    <th scope="col">Branch Address</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($contact as $contacts)
                <tr>
                    <td>{{ $contacts->branch_name}}</td>
                    <td>{{ $contacts->address }}</td>
                    <td>
                        <form action="{{ route('contacts.destroy', $contacts->id) }}" method="Post">
                            <a class="btn" href="{{ route('contacts.edit', $contacts->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn click-contact"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="card-footer">
        {{ $contact->links() }}
    </div>
</div>
@endsection
