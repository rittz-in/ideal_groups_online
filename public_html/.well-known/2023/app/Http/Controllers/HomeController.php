<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Link; 
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       if(Auth::user()->role == 1){
            return redirect()->route('super-admin.index');
       }
        
       $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        if ($item) {
            $username = $item->username;
            $BrandName = $item->BrandName;
        } else {
            $username = ''; 
            $BrandName = '';
        }
        return view('dashboards.index', compact('item', 'username', 'BrandName','userData'));
    }

    public function create(Request $request)
    {
        //return view('dashboards.create');
    }


    public function store(Request $request)
{
    
    $data_obj = Dashboard::where('created_by', auth()->user()->id)->count();

    if ($data_obj <= 0) {
        $validated = $request->validate([
            'logo' => 'required', 
            'website' => 'required|url',  
        ]);

        $dashboard = new Dashboard();
        $dashboard->userName = $request->userName;
        $dashboard->designation = $request->designation;
            $dashboard->phone_no = $request->phone_no;
            $dashboard->slogan = $request->slogan;
            $dashboard->email = $request->email;
            $dashboard->BrandName = $request->BrandName;
            $dashboard->website = $request->website;
            $dashboard->address = $request->address;
            $dashboard->color = $request->color;


        if (!empty($request->logo)) {
            $filename = $request->logo->getClientOriginalExtension();
            $filepath = "logo/" . time() . "." . $filename;
            $path = Storage::disk("public")->put($filepath, file_get_contents($request->logo));
            $dashboard->logo = $filepath;
        }

        if (!empty($request->banner)) {
            $bannerFilename = $request->banner->getClientOriginalName();
            $bannerPath = "banner/" . time() . "_" . $bannerFilename;
            Storage::disk("public")->put($bannerPath, file_get_contents($request->banner));
            $dashboard->banner = $bannerPath;
        }

        $dashboard->created_by = auth()->user()->id;
        $dashboard->save();
    } else {
        $validated = $request->validate([
            'website' => 'required|url',
        ]);
        $dashboard = Dashboard::where('created_by', auth()->user()->id)->first();
        $dashboard->userName = $request->userName;
       $dashboard->designation = $request->designation;
            $dashboard->phone_no = $request->phone_no;
            $dashboard->slogan = $request->slogan;
            $dashboard->email = $request->email;
            $dashboard->BrandName = $request->BrandName;
            $dashboard->website = $request->website;
            $dashboard->address = $request->address;
            $dashboard->color = $request->color;

        if (!empty($request->logo)) {
            $filename = $request->logo->getClientOriginalExtension();
            $filepath = "logo/" . time() . "." . $filename;
            $path = Storage::disk("public")->put($filepath, file_get_contents($request->logo));
            $dashboard->logo = $filepath;
        }

        if (!empty($request->banner)) {
            $bannerFilename = $request->banner->getClientOriginalName();
            $bannerPath = "banner/" . time() . "_" . $bannerFilename;
            Storage::disk("public")->put($bannerPath, file_get_contents($request->banner));
            $dashboard->banner = $bannerPath;
        }

        $dashboard->save();
    }

    return redirect()->route('dashboards.index')->with('success', 'Customer Has Been Updated successfully');
}


    public function show(Dashboard $item)
    {
        return view('dashboards.show', compact('item'));
    }

    public function edit(Dashboard $item)
    {
        return view('dashboards.edit', compact('item'));
    }

    public function update(Request $request, Dashboard $item)
    {
        $item->update($request->all());
        return redirect()->route('dashboards.index')->with('success', 'Customer Has Been updated successfully');
    }

    public function destroy(Dashboard $item)
    {
            $item = Dashboard::where('created_by', auth()->user()->id)->first();
            $item->logo = '';
            $item->update();
        return redirect()->route('dashboards.index')->with('success', 'Customer has been deleted successfully');
    }
    public function banner_remove($slug)
    {
        $item = Dashboard::where('id',$slug)->first();
        $item->banner = '';
        $item->update();
        return redirect()->back();
    }
}
