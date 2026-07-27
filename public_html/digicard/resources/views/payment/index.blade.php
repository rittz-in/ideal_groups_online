@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')
<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

<div class="pull-right mb-2 d-flex justify-content-end">
    <a class="btn " style="background-color: #BC3A24; color: white;" href="{{ route('payment.create') }}"> Add New Payment</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        {{ __('Payment') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Method</th>
                    <th scope="col">Scanner</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @if($payment->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No data found</td>
                </tr>
            @else
                @foreach ($payment as $payment)
                <tr>
                    <td>{{ $payment->title }}</td>
                    @if ($payment)
                    <td><img src="{{ Storage::URL($payment->image) }}" alt="{{ $payment->title }}" width="100"></td>
                @else
                    <td>No payment information available</td>
                @endif
                
                   
                    <td>
                        <form action="{{ route('payment.destroy', $payment->id) }}" method="Post">
                            <a class="btn " href="{{ route('payment.edit', $payment->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn click-payment"><i class="fa-solid fa-trash"></i></button>
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