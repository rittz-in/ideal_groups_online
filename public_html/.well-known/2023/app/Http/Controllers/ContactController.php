<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
       
        $user = auth()->user();
        $checkdata = Contact::where('created_by', $user->id)->first();
        $userData = User::where('id',auth()->user()->id)->first();
        $dashboard = Dashboard::where('username', $user->username)->first();
        $item = Dashboard::first();
        $username = $item->username;
        $BrandName = $item->BrandName;
        $contact = Contact::where('created_by', $user->id)
        ->orderBy('id', 'desc')
        ->paginate(5);
        return view('contact.index', compact('contact', 'username', 'BrandName', 'item','userData','checkdata'));
    }
    public function create()
    {
        $userData = User::where('id',auth()->user()->id)->first();
        $data['form_title'] = "Add New Contact";
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        if ($item) {
            $username = $item->username;
            $BrandName = $item->BrandName;
        } else {
            $username = ''; 
            $BrandName = '';
        }
        $contact = null;
        return view('contact.create-edit', compact('data', 'contact', 'username', 'BrandName','item','userData'));
    }
    public function store(Request $request)
    {
        $contacts = new Contact;
        $contacts->branch_name = $request->get('branch_name');
        $contacts->address = $request->get('address');
        $contacts->phone = $request->get('phone');
        $contacts->email = $request->get('email');
        $contacts->map = $request->get('map');

        $contacts->sunday_to = $request->input('sunday_to');
        $contacts->sunday_from = $request->input('sunday_from');
        $contacts->monday_to = $request->get('monday_to');
        $contacts->monday_from = $request->get('monday_from');
        $contacts->tuesday_to = $request->get('tuesday_to');
        $contacts->tuesday_from = $request->get('tuesday_from');
        $contacts->wednesday_to = $request->get('wednesday_to');
        $contacts->wednesday_from = $request->get('wednesday_from');
        $contacts->thursday_to = $request->get('thursday_to');
        $contacts->thursday_from = $request->get('thursday_from');
        $contacts->friday_to = $request->get('friday_to');
        $contacts->friday_from = $request->get('friday_from');
        $contacts->saturday_to = $request->get('saturday_to');
        $contacts->saturday_From = $request->get('saturday_From');
        if (!empty($request->image)) {
            $filename = $request->image->getClientOriginalExtension();
            $filepath = "contacts/" . time() . "." . $filename;
            $path = Storage::disk("public")->put(
                $filepath,
                file_get_contents($request->image)
            );
            $contacts->image = $filepath;
        }

        $sundayStatus = $request->input('sundayStatus');
        $contacts->time_status = ($sundayStatus == 'open') ? 1 : 0;

        $mondayStatus = $request->input('mondayStatus');
        $contacts->mondayStatus = ($mondayStatus == 'open') ? 1 : 0;

        $Tuesdaystatus = $request->input('Tuesdaystatus');
        $contacts->Tuesdaystatus = ($Tuesdaystatus == 'open') ? 1 : 0;

        $Wednesdaystatus = $request->input('Wednesdaystatus');
        $contacts->Wednesdaystatus = ($Wednesdaystatus == 'open') ? 1 : 0;

        $Thursdaystatus = $request->input('Thursdaystatus');
        $contacts->Thursdaystatus = ($Thursdaystatus == 'open') ? 1 : 0;

        $fridaystatus = $request->input('fridaystatus');
        $contacts->fridaystatus = ($fridaystatus == 'open') ? 1 : 0;

        $Saturdaystatus = $request->input('Saturdaystatus');
        $contacts->Saturdaystatus = ($Saturdaystatus == 'open') ? 1 : 0;

        $contacts->created_by = auth()->user()->id;
        $contacts->save();

        return redirect()->route('contacts.index')->with('success', 'contacts has been created successfully.');
    }
    public function show(Contact $contacts)
    {
        return view('contacts.show', compact('contacts'));
    }
    public function edit(Contact $contact)
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
    $data['form_title'] = "Edit Contact";
    
    return view('contact.create-edit', compact('contact', 'data', 'item', 'username', 'BrandName','userData'));
}

    public function update(Request $request, $id)
{
    $contacts = Contact::findOrFail($id); // Use findOrFail to throw a 404 error if the contact is not found
    
    // Update contact fields
    $contacts->branch_name = $request->input('branch_name');
    $contacts->address = $request->input('address');
    $contacts->phone = $request->input('phone');
    $contacts->email = $request->input('email');
    $contacts->map = $request->input('map');

    // Update working hours
    $contacts->sunday_to = $request->input('sunday_to');
    $contacts->sunday_from = $request->input('sunday_from');
    $contacts->monday_to = $request->input('monday_to');
    $contacts->monday_from = $request->input('monday_from');
    $contacts->tuesday_to = $request->input('tuesday_to');
    $contacts->tuesday_from = $request->input('tuesday_from');
    $contacts->wednesday_to = $request->input('wednesday_to');
    $contacts->wednesday_from = $request->input('wednesday_from');
    $contacts->thursday_to = $request->input('thursday_to');
    $contacts->thursday_from = $request->input('thursday_from');
    $contacts->friday_to = $request->input('friday_to');
    $contacts->friday_from = $request->input('friday_from');
    $contacts->saturday_to = $request->input('saturday_to');
    $contacts->saturday_From = $request->input('saturday_From');

    // Update time status
    $contacts->time_status = ($request->input('sundayStatus') == 'open') ? 1 : 0;
    $contacts->mondayStatus = ($request->input('mondayStatus') == 'open') ? 1 : 0;
    $contacts->Tuesdaystatus = ($request->input('Tuesdaystatus') == 'open') ? 1 : 0;
    $contacts->Wednesdaystatus = ($request->input('Wednesdaystatus') == 'open') ? 1 : 0;
    $contacts->Thursdaystatus = ($request->input('Thursdaystatus') == 'open') ? 1 : 0;
    $contacts->fridaystatus = ($request->input('fridaystatus') == 'open') ? 1 : 0;
    $contacts->Saturdaystatus = ($request->input('Saturdaystatus') == 'open') ? 1 : 0;

    $contacts->save();

    return redirect()->route('contacts.index')->with('success', 'Contact has been updated successfully');
}

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'contact has been deleted successfully');
    }
}
