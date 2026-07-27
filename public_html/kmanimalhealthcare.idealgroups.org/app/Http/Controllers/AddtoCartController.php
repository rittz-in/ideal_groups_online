<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddtoCartController extends Controller
{
    public function AddtoCart(Request $request)
    {

        return view('product.add-to-cart');

    }

    public function checkOut(Request $request)
    {

        return view('product.checkout');

    }
}
