@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('siteassets/css/cart.css') }}">

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
            <div class="py-5 text-center">

            </div>

            <div class="row">


                <div class="col-md-12 order-md-1">





                    <h4 class="mb-3">Registration</h4>
                    <form class="needs-validation" method="post" action="{{ route('add-user-registration') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" id="firstName" name="firstname" placeholder=""
                                    value="{{ old('firstname') }}">
                                <span class="text-danger">
                                    @error('firstname')
                                        {{ $message }}
                                    @enderror
                                </span>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="lastName" name="lastname" placeholder=""
                                    value="{{ old('lastname') }}">
                                <span class="text-danger">
                                    @error('lastname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email">UserName</label>
                                <input type="text" class="form-control" id="email" name="username"
                                    value="{{ old('username') }}">
                                <span class="text-danger">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder=""
                                    value="{{ old('email') }}">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address1" placeholder=""
                                value="{{ old('address1') }}">
                            <span class="text-danger">
                                @error('address1')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Address 2</label>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder=""
                                value="{{ old('address2') }}">

                            <span class="text-danger">
                                @error('address2')
                                    {{ $message }}
                                @enderror
                            </span>

                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100" name="country" id="country">
                                    <option value="">Choose...</option>
                                    <option value="selected">India</option>
                                </select>

                                <span class="text-danger">
                                    @error('country')
                                        {{ $message }}
                                    @enderror
                                </span>

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="state">State</label>
                                <select class="custom-select d-block w-100" id="state" name="state">
                                    <option value="">Choose...</option>
                                    <option value="Gujarat" selected>Gujarat</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Maharastra">Maharastra</option>
                                </select>

                                <span class="text-danger">
                                    @error('state')
                                        {{ $message }}
                                    @enderror
                                </span>

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" placeholder="" name="zip"
                                    value="{{ old('zip') }}">

                                <span class="text-danger">
                                    @error('zip')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="zip">Mobile</label>
                                <input type="text" class="form-control" id="mobile" placeholder="" name="mobile"
                                    value="{{ old('mobile') }}">

                                <span class="text-danger">
                                    @error('mobile')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="zip">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="" value="{{ old('password') }}">
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="zip">Confirm Password</label>
                                <input type="password" class="form-control" id="password" name="confirm_password"
                                    placeholder="">
                                <span class="text-danger">
                                    @error('confirm_password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>





                        </div>


                        <div class="col-md-3"><button class="btn btn-primary btn-lg btn-block checkoutpagebtn"
                                type="submit">Register</button></div>

                    </form>
                </div>
            </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".logintype").click(function() {
                $value = $(this).val();

                if ($value == "Yes") {
                    $(".loginSection").show();
                } else {
                    $(".loginSection").hide();
                }
            });
        });
    </script>
@endsection

<style>
    .loginSection {
        margin: 0;
        padding: 0;
    }
</style>
