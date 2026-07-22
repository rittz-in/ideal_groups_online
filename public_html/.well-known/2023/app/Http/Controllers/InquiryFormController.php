<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InquiryForm;

class InquiryFormController extends Controller
{
    public function index()
    {
        return view('home-main');
    }
    public function store(Request $request)
    {
      
       $cardno = $request->get('cardno');
        $inquiry = new InquiryForm();
        $inquiry->name = $request->input('name');
        $inquiry->phone = $request->input('phone');
        $inquiry->email = $request->input('email');
        $inquiry->topic = $request->input('topic');
        $inquiry->description = $request->input('description');
        $inquiry->created_by = auth()->user()->id;

        $inquiry->save();
    
        return redirect()->route('website_url', ['cardno' => $cardno])->with('success', 'Inquiry has been created successfully.');
}
   
    
}
