<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeMainController;
use App\Http\Controllers\InquiryFormController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PageNotFoundController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('dashboards', HomeController::class);
Route::get('/about_us', [AboutUsController::class, 'index'])->name('about_us.index');
Route::post('/about_us', [AboutUsController::class, 'create'])->name('about_us.create');

Route::middleware('auth')->group(function () {


    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

});



Route::prefix('{userId}')->group(function () {

});

Route::get('website/{cardno}', [HomeMainController::class, 'index'])->name('website_url');

Route::resource('links', LinkController::class);


Route::resource('services', ServiceController::class);
Route::get('services/getdata',[ServiceController::class,'getdata'])->name('services.getdata');
Route::resource('inquiry', InquiryController::class);
Route::resource('testimonials', TestimonialsController::class);
Route::resource('payment', PaymentController::class);
Route::resource('contacts', ContactController::class);
Route::resource('videos', VideosController::class);
Route::resource('inquiry-form', InquiryFormController::class);
Route::resource('super-admin', SuperAdminController::class);
Route::resource('home-main', HomeMainController::class);
Route::resource('page-not-found', PageNotFoundController::class);
Route::get('remove_profile_home/{slug?}', [HomeController::class, 'destroy'])->name('member.remove_image_home');
Route::get('remove_profile_service/{slug?}', [ServiceController::class, 'remove_logo_service'])->name('member.remove_image_service');
Route::get('remove_profile_payment/{slug?}', [PaymentController::class, 'remove_logo_payment'])->name('member.remove_image_payment');
Route::get('remove_Banner_image/{slug?}', [HomeController::class, 'banner_remove'])->name('member.remove_Banner_image');
Route::get('remove_profile_testimonials/{slug?}', [TestimonialsController::class, 'remove_logo_testimonials'])->name('member.remove_image_testimonials');
