<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function index(Request $request)
    {
        $pagename['page_title'] = "About Us";
        return view('about-us.list', compact('pagename'));

    }
}
