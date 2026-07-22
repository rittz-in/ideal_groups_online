<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class PaymentController extends Controller
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
        $payment = Payment::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        return view('payment.index', compact('payment', 'username', 'BrandName', 'item','userData'));
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
        $data['form_title'] = "Add New Payment";
        $payment = null;
        return view('payment.create-edit', compact('data', 'payment', 'item', 'username', 'BrandName','userData'));
    }
    public function store(Request $request)
{
    // Define validation rules
    $rules = [
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you are allowing image uploads
        'status' => 'required|in:0,1', // Assuming status can only be 0 or 1
    ];

    // Create a custom error message for the status field
    $customMessages = [
        'status.in' => 'The status field must be either 0 or 1.',
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules, $customMessages);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    $payment = new Payment();
    $payment->title = $request->title;
    $payment->status = $request->status; // You don't need to check for 'active' here, since the validation ensures it's either 0 or 1

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $filename = $request->image->getClientOriginalExtension();
            $filepath = "images/" . time() . "." . $filename;
            $path = Storage::disk("public")->put(
                $filepath,
                file_get_contents($request->image)
            );
            $payment->image = $filepath;
    }

    $payment->created_by = auth()->user()->id;
    $payment->save();

    return redirect()->route('payment.index')->with('success', 'Payment has been created successfully.');
}
    public function show(Payment $payment)
    {
        return view('payment.show', compact('payment'));
    }
    public function edit(Payment $payment)
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
        $data['form_title'] = "edit Payment";
        return view('payment.create-edit', compact('payment', 'data', 'item', 'username', 'BrandName','userData'));
    }
    public function update(Request $request, Payment $payment)
    {
        $payment->title = $request->get('title');
        $payment->status = $request->get('status');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filename = $request->image->getClientOriginalExtension();
                $filepath = "images/" . time() . "." . $filename;
                $path = Storage::disk("public")->put(
                    $filepath,
                    file_get_contents($request->image)
                );
                $payment->image = $filepath;
        }
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'payment Has Been updated successfully');
    }
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payment.index')->with('success', 'payment has been deleted successfully');
    }
    public function remove_logo_payment($slug)
    {
         $Payment = Payment::where('id',$slug)->first();
            $Payment->image = '';
            $Payment->update();
            return redirect()->back();

    }
}
