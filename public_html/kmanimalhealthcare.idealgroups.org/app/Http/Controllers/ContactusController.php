<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function index(Request $request)
    {
        $pagename['page_title'] = "Contact Us";
        return view('contact-us.list', compact('pagename'));

    }
}
