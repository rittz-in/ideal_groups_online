<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class VideosController extends Controller
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
        $videos = Videos::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        return view('videos.index', compact('videos', 'username', 'BrandName', 'item','userData'));
    }

    public function create()
    {
        $userData = User::where('id',auth()->user()->id)->first();
        $data['form_title'] = "Add New Video";
        $item = Dashboard::where('created_by', auth()->user()->id)->first();
        if ($item) {
            $username = $item->username;
            $BrandName = $item->BrandName;
        } else {
            $username = ''; 
            $BrandName = '';
        }
        $video = null;
        $videos = Videos::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        return view('videos.create-edit', compact('data', 'video','videos','username', 'BrandName','item','userData'));
    }

    public function store(Request $request)
    {
        // Define validation rules for your input fields
        $rules = [
            'title' => 'required|string|max:255',
            'youtube_link' => 'required|url',
        ];
    
        // Create a validator instance
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    
       
        $video = new Videos();
        $video->title = $request->title;
        $video->youtube_link = $request->youtube_link;
        $video->created_by = auth()->user()->id;
        $video->save();
    
        return redirect()->route('videos.index')->with('success', 'Video has been created successfully.');
    }


    public function show(Videos $video)
    {
        return view('videos.show', compact('video'));
    }
    public function edit(Videos $video)
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
        $data['form_title'] = "Edit Videos";
        return view('videos.create-edit', compact('video', 'data', 'item', 'username', 'BrandName','userData'));
    }
    public function update(Request $request, Videos $video)
    {
        $video->fill($request->post())->save();

        return redirect()->route('videos.index')->with('success', 'Video Has Been updated successfully');
    }
    public function destroy(Videos $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video has been deleted successfully');
    }
}
