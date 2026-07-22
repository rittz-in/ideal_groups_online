<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

class DataOfAppController extends Controller
{
    public function index()
    {
        $items = Dashboard::first();
        return view('layouts.app', compact('items'));
    }
}
