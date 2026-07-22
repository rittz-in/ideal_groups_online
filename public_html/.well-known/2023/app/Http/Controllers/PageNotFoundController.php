<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;
use App\Models\Link; 
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PageNotFoundController extends Controller
{
    public function index()
    {
       
        
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        if ($item) {
            $username = $item->username;
            $BrandName = $item->BrandName;
        } else {
            $username = ''; 
            $BrandName = '';
        }
        return view('page-not-found.index', compact('item', 'username', 'BrandName'));
    }
}
