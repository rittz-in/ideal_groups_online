<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        $username = "Ideal Groups";
        $BrandName = "Customers";
        $users = User::latest()->orderBy('name', 'asc') ->where('role', '!=', 1)->get();
        $datasearch=User::select('users.id', 'dashboards.created_by')
        ->join('dashboards', 'users.id', '=', 'dashboards.created_by')
        ->get();
       
        
        return view('super-admin.index', compact('users', 'item','username', 'BrandName','datasearch','userData'));
    }

    public function create()
    {

        $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        $username = "Ideal Groups";
        $BrandName = "Super Admin";
        $data['form_title'] = "Add New Customers";
        $user = "";
        return view('super-admin.create-edit', compact('data', 'user','item','username','BrandName','userData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'card_no' => 'nullable | regex:/^[^\s]+$/ | unique:users',
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->card_no = $request->get('card_no');
        $user->password = bcrypt($request->get('password'));
        $user->created_by = auth()->user()->id;
        $user->role = ($user->name === 'super admin') ? 1 : 0;
        $user->save();

        return redirect()->route('super-admin.index')->with('success', 'User has been created successfully.');
    }

    public function show(User $user)
    {
        return view('super-admin.show', compact('user'));
    }

    public function edit($user)
    {
     
        $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        $username = "Ideal Groups";   
        $BrandName = "Super Admin";
        $user = User::where('id', $user)->first();
        $data['form_title'] = "Edit Customers";
        return view('super-admin.create-edit', compact('user', 'data','item','username','BrandName','userData'));
    }

    public function update(Request $request, User $super_admin)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $super_admin->id,
        'password' => 'required',
        'card_no' => 'nullable | regex:/^[^\s]+$/ | unique:users,card_no,' . $super_admin->id,
    ]);

    $super_admin->name = $request->get('name');
    $super_admin->email = $request->get('email'); 
    $super_admin->card_no = $request->get('card_no');
    $super_admin->password = bcrypt($request->get('password'));
    $super_admin->save();

    return redirect()->route('super-admin.index')->with('success','User has been Updated successfully.');
}


    public function destroy(User $super_admin)
{
    $super_admin->delete();
    return redirect()->route('super-admin.index')->with('success', 'User has been deleted successfully');
}

}
