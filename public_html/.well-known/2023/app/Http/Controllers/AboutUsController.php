<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\User;

class AboutUsController extends Controller
{
    public function index()
    {
        $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();

        if ($item) {
            $username = $item->username;
            $BrandName = $item->BrandName;
        } else {
            $username = ''; 
            $BrandName = '';
        }
        $about_us = AboutUs::where('created_by', auth()->user()->id)->first();
        // return view('about_us.index', compact('about_us','username', 'BrandName', 'item'));
        return view('about_us', compact('about_us','item', 'username', 'BrandName','userData'));

    }

    public function create(Request $request)
    {
        
        $data_obj = AboutUs::where('created_by', auth()->user()->id)->count();
        if ($data_obj <= 0) {
            $aboutUs = new AboutUs();
            $aboutUs->about_us = $request->about_us;
            $aboutUs->created_by = auth()->user()->id;
            $aboutUs->save();
            return redirect('about_us')->with('success', 'Customer Has Been Create successfully');;
        } else {
            $affectedRecords = AboutUs::where("created_by", auth()->user()->id)->update([
                "about_us" => $request->about_us,
            ]);
            return redirect()->route('about_us.index')->with('success', 'Customer Has Been Updated successfully');

            // return redirect('showabout',compact('username', 'BrandName', 'item'));
        }
    }

  

    public function store(Request $request)
    {
        // return redirect()->route('companies.index')->with('success', 'Company has been created successfully.');
    }
}
