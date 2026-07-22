<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use Illuminate\Support\Facades\Storage;


class ServiceController extends Controller
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
        $services = Service::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        return view('services.index', compact('services', 'username', 'BrandName', 'item','userData'));
    }
    public function create()
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
        $data['form_title'] = "Add New Service";
        $service = null;
        return view('services.create-edit', compact('data', 'service', 'item', 'username', 'BrandName','userData'));
    }
    public function store(Request $request)
    {
        $rules = [
            'service_name' => 'required|string|max:255',
            'whatsapp_no' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for logo upload
        ];
    
        
        $validatedData = $request->validate($rules);
    
       
        $service = new Service();
        $service->service_name = $validatedData['service_name'];
        $service->whatsapp_no = $validatedData['whatsapp_no'];
        $service->description = $validatedData['description'];
    
        if ($request->hasFile('logo')) {
           $filename = $request->file('logo')->getClientOriginalName();
            $filepath = 'logo/' . time() . '_' . $filename; 
            $path = Storage::disk("public")->put(
                $filepath,
                file_get_contents($request->logo)
            );
            $service->logo = $filepath;
        }
    
        $service->created_by = auth()->user()->id;
        $service->save();
    
        return redirect()->route('services.index')->with('success', 'Service has been created successfully.');
    }
    
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }
    public function edit(Service $service)
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
        $data['form_title'] = "Edit Services";
        return view('services.create-edit', compact('service', 'data', 'item', 'username', 'BrandName','userData'));
    }
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'whatsapp_no' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        
        $service->fill([
            'service_name' => $request->input('service_name'),
            'whatsapp_no' => $request->input('whatsapp_no'),
            'description' => $request->input('description'),
        ]);
    
        // Check if a new image file is provided
        if ($request->hasFile('logo')) {
            // Delete the old image (if it exists)
            if (!empty($service->logo)) {
                Storage::disk('public')->delete($service->logo);
            }
    
            // Upload the new image
            $filename = $request->file('logo')->getClientOriginalName();
            $filepath = 'logo/' . time() . '_' . $filename; 
            $path = Storage::disk("public")->put(
                $filepath,
                file_get_contents($request->logo)
            );
            $service->logo = $filepath;
        }
    
        $service->save();
    
        return redirect()->route('services.index')->with('success', 'Service has been updated successfully');
    }
    
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service has been deleted successfully');
    }

    public function remove_logo_service($slug)
    {
         $service = Service::where('id',$slug)->first();
            $service->logo = '';
            $service->update();
            return redirect()->back();

    }
}
