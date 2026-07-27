@extends('layouts.guest')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>



@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Registration</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">User</a></li>
                    <li><a class="active">Registration</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->
    <section class=" bg-gradient-faded-light    ">
        <div class="container">
            <div class="row mt-3">
                <h4 class="mb-3">My Orders</h4>


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quntity</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Total</th>
                            <th scope="col">Paymement Type</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><img class="img-fluid imagePhoto"
                                        src="{{ asset($order->ProductImage) }}"></th>
                                <th scope="col">{{ $order->ProductName }}</th>
                                <th scope="col">{{ $order->quntity }}</th>
                                <th scope="col">₹{{ $order->amount }}</th>
                                <th scope="col">₹{{ $order->quntity * $order->amount }}</th>
                                <th scope="col">{{ $order->order_type }}</th>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

<style>
    .imagePhoto {
        width: 100px;
        height: 100px;
    }
</style>
