<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class SendLogoData extends Controller
{
    public function index()
    {
        $item = Dashboard::first();
        $username = $item->username;
        $BrandName = $item->BrandName;
        return view('layouts.app', compact('item', 'username', 'BrandName'));
    }
}
