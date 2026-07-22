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

        @if($data['form_title'] == "Add New Payment")
            <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
                @csrf
                @else
                <form method="POST" action="{{ route('payment.update', $payment->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"><strong>Method:</strong></label>
                                <input type="text" name="title" class="form-control" placeholder="Title Name" value="{{ old('title') ? old('title') : ($payment ? $payment->title : '') }}">
                                @error('title')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Scanner:</strong>
                                <input type="file" id="image" class="form-control" name="image">
                                @error('image')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                               @if ($payment && $payment->image && Storage::disk('public')->exists($payment->image))
                                    <div class="mt-3">
                                        <img src="{{ Storage::url($payment->image) }}" alt="Current Image" width="100">
                                        @if (!empty($payment->image))
                                    <a class="click-payment ms-5" href="{{ route('member.remove_image_payment', $payment->id) }}"><i class="fa-solid fa-trash "></i></a>
                                    @endif
                                    </div>
                                @endif

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status"><strong>Status:</strong></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', optional($payment)->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', optional($payment)->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mt-2 text-center mb-3">
                            <button type="submit" class="btn Submit_btn">Submit</button>
                        </div>
                    </div>
                </form>
    </div>
</div>
@endsection