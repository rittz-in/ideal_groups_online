<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutFrontController extends Controller
{
    public function index()
    {

        $aboutFront = AboutUs::all();
        return view('home-main', compact('aboutFront'));
    }
}
