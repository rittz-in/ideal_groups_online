<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Link;
use App\Models\Service;
use App\Models\Videos;
use App\Models\Payment;
use App\Models\testimonials;
use App\Models\User;

class HomeMainController extends Controller
{
    public function index($card_no = '')
{
    $userData = User::where('card_no', $card_no)->first();

    if (empty($userData)) {
        // Return a 404 error message when user data is not found
        abort(404, 'Website is Not Available');
    }

    // $userData = User::where('card_no', $card_no)->first();
   
    $test_user = Dashboard::where('created_by', $userData->id)->first();
    
    // Check if $userData is empty or null
    // if (empty($userData)) {
    //     abort(404); 
    // }

    if (empty($card_no)) {
        // Return a 404 error message when card_no is not set
        abort(404, 'Website is Not Available');
    }

    if($test_user != "")
    {
       
    // Rest of your code to load data when $userData is valid
   
    $loggedInUserId = $userData->id;
    $item = Dashboard::where('created_by', $loggedInUserId)->first();
    $username = $item->username;
  
    $BrandName = $item->BrandName;

    $color = Dashboard::where('created_by', $loggedInUserId)->first();

    $data = [
        'aboutFront' => AboutUs::where('created_by', $loggedInUserId)->first(),
        'serviceFronts' => Service::where('created_by', $loggedInUserId)->get(),
        'contactFront' => Contact::where('created_by', $loggedInUserId)->first(),
        'videoFront' => Videos::where('created_by', $loggedInUserId)->get(),
        'paymentFront' => Payment::where('created_by', $loggedInUserId)->get(),
        'testimonials' => testimonials::where('created_by', $loggedInUserId)->get(),
    ];
    $color = Dashboard::where('created_by', $loggedInUserId)->first();
    if (!$color) {
        // Handle the case where $color is null, for example, by setting a default color.
        $color = (object) ['color' => '#BC3A25'];
    }
    
    $links = Link::where('created_by', $loggedInUserId)->first();
    return view('home-main', compact('data', 'loggedInUserId', 'item', 'color', 'username', 'BrandName', 'userData','links','card_no','test_user'));
}
else{
    $username = "";
    $BrandName = "";
    return view('home-main',compact('username','BrandName','test_user'));
}

    
}

}
