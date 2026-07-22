<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\testimonials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class TestimonialsController extends Controller
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
        $testimonials = testimonials::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        return view('testimonials.index', compact('testimonials', 'username', 'BrandName', 'item','userData'));
    }
    public function create()
    {
        $userData = User::where('id',auth()->user()->id)->first();
        $data['form_title'] = "Add New Testimonials";

        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        if ($item) {
            $username = $item->username;
            $BrandName = $item->BrandName;
        } else {
            $username = ''; 
            $BrandName = '';
        }
        $testimonial = null;
        return view('testimonials.create-edit', compact('data', 'testimonial', 'username', 'BrandName','item','userData'));
    }
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'description' => 'required|string|max:255',
            'auther' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size limit as needed
        ];
    
        // Validate the request data
        $validatedData = $request->validate($rules);
    
        // Create a new testimonial
        $testimonials = new testimonials;
        $testimonials->description = $request->get('description');
        $testimonials->auther = $request->get('auther');
        $testimonials->designation = $request->get('designation');
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalExtension();
            $filepath = "testimonials/" . time() . "." . $filename;
            $path = Storage::disk("public")->put(
                $filepath,
                file_get_contents($request->image)
            );
            $testimonials->image = $filepath;
        }
    
        $testimonials->created_by = auth()->user()->id;
        $testimonials->save();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial has been created successfully.');
    }
    
    public function show(testimonials $testimonials)
    {
        return view('testimonials.show', compact('testimonials'));
    }
    public function edit(testimonials $testimonial)
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
        $data['form_title'] = "Edit Testimonial";
        return view('testimonials.create-edit', compact('testimonial', 'data', 'item', 'username', 'BrandName','userData'));
    }

    public function update(Request $request, Testimonials $testimonial)
{
    $testimonial->description = $request->get('description');
    $testimonial->auther = $request->get('auther');
    $testimonial->designation = $request->get('designation');
    
    if ($request->hasFile('image')) {
        $filename = $request->image->getClientOriginalExtension();
        $filepath = "testimonials/" . time() . "." . $filename;
        $path = Storage::disk("public")->put(
            $filepath,
            file_get_contents($request->image)
        );
        $testimonial->image = $filepath; // Use $testimonial instead of $testimonials
    }

    $testimonial->save();

    return redirect()->route('testimonials.index')->with('success', 'Testimonial has been updated successfully');
}


    public function destroy(testimonials $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial has been deleted successfully'); // Use singular form here
    }
    public function remove_logo_testimonials($slug)
    {
         $testimonials = testimonials::where('id',$slug)->first();
            $testimonials->image = '';
            $testimonials->update();
            return redirect()->back();

    }
}
