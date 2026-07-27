<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\AddtoCartController;
use App\Http\Controllers\StressoLiteController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\RazorpayController;

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\ProductVariantController;

use App\Http\Controllers\CouponCodeController;

use App\Http\Controllers\ProductCartController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::get('/', [HomeController::class, 'index'])
    ->middleware('guest')
    ->name('site');
Route::get('/products', [HomeController::class, 'products'])
    ->middleware('guest')
    ->name('products');

Route::get('/products/{slug_url}', [HomeController::class, 'Categoryproducts'])
    ->middleware('guest')
    ->name('categoryProducts');

Route::get('guestId/{guest_id}', [HomeController::class, 'checkGuestId'])->name('app-project-guestId-information');


Route::get('products/productVarientFilters', [HomeController::class, 'productVarientFilters'])->name('app-product-varient-filters');

Route::get('products/details/{product_slug}', [HomeController::class, 'productDetails'])->name('app-product-details');

Route::get('products/prices/{sizeId}/{productId}', [HomeController::class, 'productsizePriceInfo'])->name('app-product-size-price-details');


Route::get('products/tempCartAdd/{productId}/{quntity}/{varientSize}', [ProductCartController::class, 'tempCartAdd'])->name('app-product-add-tempcart-details');


/*========================= Payment===============*/

Route::get('payment/{encrypt_id}', [RazorpayController::class, 'payment_form'])->name('razorpay.payment.form');
Route::post('razorpay-payment', [RazorpayController::class, 'store'])->name('razorpay.payment.store');

Route::post('/payment/process', [RazorpayController::class, 'processPayment'])->name('razorpay.payment.store');
Route::get('/product/success/{orderNumber}', [ProductCartController::class, 'success'])->name('product.success');
/*========================= Payment===============*/




//Route::get('AddtoCart', [AddtoCartController::class, 'AddtoCart'])->name('product.AddtoCart');// Route::get('checkOut', [AddtoCartController::class, 'checkOut'])->name('product.checkOut');


Route::get('cart', [ProductCartController::class, 'ViewTempCart'])->name('app-product-view-tempcart-details');

Route::get('updatecart/{cartId}/{quntity}/{amount}', [ProductCartController::class, 'updateTempCart'])->name('app-update-tempcart-details');

Route::get('removecart/{cartId}', [ProductCartController::class, 'removeTempCart'])->name('app-remove-cart-product');

Route::get('couponcode/{couponCode}/{cartProductIds}/{cartAmountValues}', [ProductCartController::class, 'AddCouponCode'])->name('app-couponcode-details');


Route::get('UserRegistration', [ProductCartController::class, 'UserRegistration'])->name('user-registration');

Route::post('addUserRegistration', [ProductCartController::class, 'AddUserData'])->name('add-user-registration');
Route::post('addUserLogin', [ProductCartController::class, 'AddUserLogin'])->name('add-user-login');
Route::post('addcheckoutDetails', [ProductCartController::class, 'addcheckoutDetails'])->name('add-checkout-details');


Route::get('checkout', [ProductCartController::class, 'checkOut'])->name('product.checkout');
// Route::get('success', [ProductCartController::class, 'success'])->name('product.success');


Route::get('my_orders', [HomeController::class, 'myOrders'])->name('app-product-user-orders');

Route::get('my_profile', [HomeController::class, 'myProfile'])->name('app-product-user-profile');





Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

// Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');

Route::group(['prefix' => 'app', 'middleware' => 'auth'], function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('/user-profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::put('/user-profile/update', [ProfileController::class, 'update'])->name('users.update');
    Route::get('/users-management', [UserController::class, 'index'])->name('users-management');
    Route::get('/users-getAll', [UserController::class, 'getAll'])->name('app-user-get-all');
    Route::get('/user/edit/{encrypted_id}', [UserController::class, 'edit'])->name('app-user-edit');
    Route::put('user/update/{encrypted_id}', [UserController::class, 'update'])->name('app-user-update');
    Route::get('user/destroy/{encrypted_id}', [UserController::class, 'destroy'])->name('app-user-destroy');
    Route::get('user/add', [UserController::class, 'create'])->name('app-user-add');
    Route::post('user/store', [UserController::class, 'store'])->name('app-user-store');

    /*------------------ Category --------------------------*/

    //Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category', [CategoryController::class, 'index'])->name('categorys.index');
    Route::get('/category-getAll', [CategoryController::class, 'getAll'])->name('app-category-get-all');
    Route::get('category/add', [CategoryController::class, 'create'])->name('app-category-add');
    Route::post('category/store', [CategoryController::class, 'store'])->name('app-category-store');
    Route::get('/category/edit/{encrypted_id}', [CategoryController::class, 'edit'])->name('app-category-edit');
    Route::put('category/update/{encrypted_id}', [CategoryController::class, 'update'])->name('app-category-update');
    Route::get('category/destroy/{encrypted_id}', [CategoryController::class, 'destroy'])->name('app-category-destroy');
    // order
    Route::get('order', [ProductController::class, 'orderIndex'])->name('order.index');
    Route::get('/order-getAll', [ProductController::class, 'getAllOrder'])->name('app-order-get-all');
    Route::get('/order/edit/{encrypted_id}', [ProductController::class, 'editOrder'])->name('app-order-edit');

    // order end
    /*------------------- Product ----------------------------*/

    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product-getAll', [ProductController::class, 'getAll'])->name('app-product-get-all');
    Route::get('product/add', [ProductController::class, 'create'])->name('app-product-add');
    Route::post('product/store', [ProductController::class, 'store'])->name('app-product-store');
    Route::get('/product/edit/{encrypted_id}', [ProductController::class, 'edit'])->name('app-product-edit');
    Route::put('product/update/{encrypted_id}', [ProductController::class, 'update'])->name('app-product-update');
    Route::get('product/destroy/{encrypted_id}', [ProductController::class, 'destroy'])->name('app-product-destroy');

    Route::get('product/image/{encrypted_id}', [ProductController::class, 'RemoveProductImage'])->name('app-product-photos');
    Route::get('product/get_subParentcategory/{id}', [ProductController::class, 'getSubParentCategory'])->name('app-product-get-subCatParentall');


    Route::get('product/get_productVarientTypes/{id}', [ProductController::class, 'getproductVarientTypes'])->name('app-product-get-varient-types');


    /*----------------------- Product Variation --------------------*/

    Route::get('product_variants', [ProductVariantController::class, 'index'])->name('product_variants.index');
    Route::get('/product_variants-getAll', [ProductVariantController::class, 'getAll'])->name('app-product_variants-get-all');
    Route::get('product_variants/add', [ProductVariantController::class, 'create'])->name('app-product_variants-add');
    Route::post('product_variants/store', [ProductVariantController::class, 'store'])->name('app-product_variants-store');
    Route::get('/product_variants/edit/{encrypted_id}', [ProductVariantController::class, 'edit'])->name('app-product_variants-edit');
    Route::put('product_variants/update/{encrypted_id}', [ProductVariantController::class, 'update'])->name('app-product_variants-update');
    Route::get('product_variants/destroy/{encrypted_id}', [ProductVariantController::class, 'destroy'])->name('app-product_variants-destroy');


    /*----------------------  Coupon Code -----------------*/

    Route::get('coupon_code', [CouponCodeController::class, 'index'])->name('coupon_code.index');
    Route::get('/coupon_code-getAll', [CouponCodeController::class, 'getAll'])->name('app-coupon_code-get-all');
    Route::get('coupon_code/add', [CouponCodeController::class, 'create'])->name('app-coupon_code-add');
    Route::post('coupon_code/store', [CouponCodeController::class, 'store'])->name('app-coupon_code-store');
    Route::get('/coupon_code/edit/{encrypted_id}', [CouponCodeController::class, 'edit'])->name('app-coupon_code-edit');
    Route::put('coupon_code/update/{encrypted_id}', [CouponCodeController::class, 'update'])->name('app-coupon_code-update');
    Route::get('coupon_code/destroy/{encrypted_id}', [CouponCodeController::class, 'destroy'])->name('app-coupon_code-destroy');


});

Route::get('/about-us', [AboutusController::class, 'index'])->name('aboutus.index');
Route::get('contact-us', [ContactusController::class, 'index'])->name('contactus.index');
Route::get('stresso-lite', [StressoLiteController::class, 'index'])->name('stresso.index');
Route::get('kmNutonic', [HomeController::class, 'kmNutonic'])->name('product.kmNutonic');
Route::get('imGrosty', [HomeController::class, 'imGrosty'])->name('product.imGrosty');
Route::get('vit-premix-b', [HomeController::class, 'vitPremixB'])->name('product.vit-premix-b');
Route::get('vit-premix-l', [HomeController::class, 'vitPremixL'])->name('product.vit-premix-l');





// Route::get('AddtoCart', [AddtoCartController::class, 'AddtoCart'])->name('product.AddtoCart');
// Route::get('checkOut', [AddtoCartController::class, 'checkOut'])->name('product.checkOut');




//Company start
// Route::get('companies/list', [CompanyController::class, 'index'])->name('app-companies-list');
// Route::get('companies/add', [CompanyController::class, 'create'])->name('app-companies-add');
// Route::post('companies/store', [CompanyController::class, 'store'])->name('app-companies-store');
// Route::get('companies/edit/{encrypted_id}', [CompanyController::class, 'edit'])->name('app-companies-edit');
// Route::put('companies/update/{encrypted_id}', [CompanyController::class, 'update'])->name('app-companies-update');
// Route::get('companies/destroy/{encrypted_id}', [CompanyController::class, 'destroy'])->name('app-companies-destroy');
// Route::get('companies/getAll', [CompanyController::class, 'getAll'])->name('app-companies-get-all');
//Company End