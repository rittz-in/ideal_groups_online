<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\User;

class LinkController extends Controller
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
        $links = Link::first();
        $currentUserId = auth()->user()->id; 

        $links = Link::where('created_by', $currentUserId)->first();

        return view('links.index', compact('item', 'username', 'BrandName','links','userData'));
    }

    public function create(Request $request)
    {
        //return view('dashboards.create');
    }


    public function store(Request $request)
{
    $data_obj = Link::where('created_by', auth()->user()->id)->count();
   

    if ($data_obj <= 0) {
        $validated = $request->validate([
             'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'pinterest' => 'nullable|url',
         
        ]);

        $dashboard = new Link($validated);
        $dashboard->created_by = auth()->user()->id;
        $dashboard->save();
        return redirect()->route('links.index')->with('success', 'Links Has Been Added successfully');
    } else {
        $dashboard = Link::where('created_by', auth()->user()->id)->first();
        $validated = $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'pinterest' => 'nullable|url',
        ]);

        $dashboard->update($validated);
    }

    return redirect()->route('links.index')->with('success', 'Links Has Been Updated successfully');
}



    public function show(Link $item)
    {
        return view('links.show', compact('item'));
    }

    public function edit(Link $item)
    {
        return view('links.edit', compact('item'));
    }

    public function update(Request $request, Link $item)
    {
        $validated = $request->validate([
           'facebook' => 'nullable|url',
             'instagram' => 'nullable|url',
             'twitter' => 'nullable|url',
             'linkedin' => 'nullable|url',
             'youtube' => 'nullable|url',
             'pinterest' => 'nullable|url',
         
           
        ]);
    
        $item->update($validated);
        return redirect()->route('links.index')->with('success', 'Links Has Been updated successfully');
    }

    public function destroy(Link $item)
    {
        $item->delete();
        return redirect()->route('links.index')->with('success', 'Links has been deleted successfully');
    }
}
