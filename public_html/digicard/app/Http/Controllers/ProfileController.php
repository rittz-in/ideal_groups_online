<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Dashboard;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $userData = User::where('id',auth()->user()->id)->first();
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        $username = "Ideal Groups";
        $BrandName = "Profile";
        return view('auth.profile',compact('item','username','BrandName','userData'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        $username = "Ideal Groups";
        $BrandName = "Profile";
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
