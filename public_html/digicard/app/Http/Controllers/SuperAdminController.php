<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        // Artisan::call('storage:link');
        $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        $username = "Ideal Groups";
        $BrandName = "Customers";
        $users = User::latest()->orderBy('name', 'asc') ->where('role', '!=', 1)->get();
        $datasearch=User::select('users.id', 'dashboards.created_by')
        ->join('dashboards', 'users.id', '=', 'dashboards.created_by')
        ->get();
        if ($request->ajax()) {
            $users = User::latest()->orderBy('name', 'asc')
                ->where('role', '!=', 1)
                ->get();

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a class="btn" href="' . route('super-admin.edit', $user->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>
            <form action="' . route('super-admin.destroy', $user->id) . '" method="POST" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn delete-btn" data-confirm="Are you sure you want to delete this user?"><i class="fa-solid fa-trash"></i></button>
            </form>';
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('Y-m-d H:i:s');
                })
                ->make(true);
        }
        
        return view('super-admin.index', compact('users', 'item','username', 'BrandName','datasearch','userData'));
    }

    public function create()
    {
        // $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        $username = "Ideal Groups";
        $BrandName = "Super Admin";
        $data['form_title'] = "Add New Customers";
        $user = "";
        return view('super-admin.create-edit', compact('data', 'user','item','username','BrandName'));
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
     
        // $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        $username = "Ideal Groups";   
        $BrandName = "Super Admin";
        $user = User::where('id', $user)->first();
        $data['form_title'] = "Edit Customers";
        return view('super-admin.create-edit', compact('user', 'data','item','username','BrandName'));
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
