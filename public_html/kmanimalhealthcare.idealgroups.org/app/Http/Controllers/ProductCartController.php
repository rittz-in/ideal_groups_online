<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\CreateFrontUserRegistration;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\ProductCartService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

use App\Models\Product;
use App\Models\Category;
use App\Models\TempAddcart;

use App\Models\ProductVarients;
use App\Models\VarientsTypes;
use App\Models\VarientsTypesDetails;
use App\Models\UsesCouponCode;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class ProductCartController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;

    protected ProductCartService $productCartService;

    public function __construct(CategoryService $categoryService, ProductService $productService, ProductCartService $productCartService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;

        $this->productCartService = $productCartService;

        View::share('categories', $this->categoryService->getMainCategory());

    }

    public function tempCartAdd($productId, $quntity, $varientSize, Request $request)
    {


        $guestId = $request->session()->get('guestId');
        $ProductId = $productId;
        $Quantity = $quntity;

        if ($varientSize == NULL) {
            $VarientSize = NULL;
        } else {

            $VarientSize = $varientSize;
        }



        $checkProductType = DB::table('products')->where(['id' => $ProductId])->first();
        if ($checkProductType->product_type == 'Simple') {
            if ($checkProductType->discount_price != '') {
                $productPrice = $checkProductType->discount_price;
            } else {
                $productPrice = $checkProductType->price;
            }



        } else {

            $checkPrice = DB::table('varients_types_details')->where(['product_id' => $ProductId, 'varient_type_id' => $VarientSize])->first();

            if ($checkPrice->discount_price != '') {
                $productPrice = $checkPrice->discount_price;
            } else {
                $productPrice = $checkPrice->price;
            }
        }

        $totalPrice = $Quantity * $productPrice;

        // $where = ['guest_id' => $guestId, 'product_id' => $ProductId, 'variant_size' => $VarientSize, 'order_status', 'Pending'];

        $countCart = $this->productCartService->countCartDetails($guestId, $ProductId, $VarientSize);


        if ($countCart == 0) {
            $TempCartData['guest_id'] = $guestId;
            $TempCartData['product_id'] = $ProductId;
            $TempCartData['variant_size'] = $VarientSize;
            $TempCartData['quntity'] = $Quantity;
            $TempCartData['amount'] = $productPrice;
            $TempCartData['total_amount'] = $totalPrice;
            $TempCartData['order_status'] = "Pending";
            $CartData = $this->productCartService->create($TempCartData);

        } else {

            $checkDetails = $this->productCartService->checkCartDetails($guestId, $ProductId);
            $id = $checkDetails->id;
            $TempCartData['guest_id'] = $guestId;
            $TempCartData['product_id'] = $ProductId;
            $TempCartData['variant_size'] = $VarientSize;
            $TempCartData['quntity'] = $Quantity;
            $TempCartData['amount'] = $productPrice;
            $TempCartData['total_amount'] = $totalPrice;
            $TempCartData['order_status'] = "Pending";

            $CartData = $this->productCartService->updateCart($id, $TempCartData);
        }

        $countTotalCart = $this->productCartService->countTotalCartDetails($guestId, $userId = '', $productId);

        return response()->json(['success' => 'success', 'TotalCart' => $countTotalCart]);


    }

    public function ViewTempCart(Request $request)
    {

        $pagename['page_title'] = "Cart Details";


        $guestId = $request->session()->get('guestId');

        $viewCarts = DB::table('temp_addcarts')
            ->leftJoin('products', 'temp_addcarts.product_id', '=', 'products.id')
            ->leftJoin('varients_types', 'temp_addcarts.variant_size', '=', 'varients_types.id')
            ->select('temp_addcarts.*', 'products.product_name as productName', 'products.featured_image as productImage', 'varients_types.variant_sizes as variantSize')
            ->where('temp_addcarts.guest_id', '=', $guestId)
            ->where('temp_addcarts.order_status', '=', 'Pending')
            ->whereNull('temp_addcarts.deleted_at')
            ->get();



        $countCartPoducts = DB::table('temp_addcarts')->where('guest_id', $guestId)->where('order_status', 'Pending')->whereNull('deleted_at')->count();

        return view('product.add-to-cart', compact('pagename', 'viewCarts', 'countCartPoducts'));

    }

    public function updateTempCart($cartid, $quntity, $amount)
    {
        $cartId = $cartid;
        $Quntity = $quntity;
        $Amount = $amount;

        $totalAmount = $Quntity * $Amount;

        $updateTempCart['quntity'] = $Quntity;
        $updateTempCart['total_amount'] = $totalAmount;

        $CartData = $this->productCartService->updateCart($cartId, $updateTempCart);

        return response()->json(['success' => 'success', 'TotalAmount' => $totalAmount]);

    }

    public function removeTempCart($cardId)
    {
        $RemoveCartData = $this->productCartService->deletetempCartProducts($cardId);

        return redirect()->route("app-product-view-tempcart-details")->with('success', 'Product Deleted Successfully');
    }

    public function checkOut(Request $request)
    {

        $pagename['page_title'] = "checkout";



        $guestId = $request->session()->get('guestId');

        $userId = $request->session()->get('userId');


        $viewCarts = DB::table('temp_addcarts')
            ->leftJoin('products', 'temp_addcarts.product_id', '=', 'products.id')
            ->leftJoin('varients_types', 'temp_addcarts.variant_size', '=', 'varients_types.id')
            ->select('temp_addcarts.*', 'products.product_name as productName', 'products.featured_image as productImage', 'varients_types.variant_sizes as variantSize')
            ->where('temp_addcarts.guest_id', '=', $guestId)
            ->where('temp_addcarts.order_status', '=', 'Pending')
            ->whereNull('temp_addcarts.deleted_at')
            ->get();




        if ($userId != '') {

            $userData = $this->productCartService->getUserData($userId);
        } else {
            $userData = '';
        }



        $checkCouponCode = DB::table('uses_coupon_codes')->where('user_id', '=', $guestId)->first();


        $countCartPoducts = DB::table('temp_addcarts')->where('guest_id', $guestId)->where('order_status', 'Pending')->whereNull('deleted_at')->count();


        return view('product.checkout', compact('pagename', 'viewCarts', 'checkCouponCode', 'userData', 'countCartPoducts'));

    }

    public function AddCouponCode($couponcode, $cartproductIds, $itemTotalprice, Request $request)
    {
        $couponCode = $couponcode;
        $cartProductIds = $cartproductIds;
        $itemTotalPrice = $itemTotalprice;

        $CouponInfo = $this->productCartService->checkCouponCode($couponCode, $cartProductIds);


        if (empty($CouponInfo)) {
            return response()->json(['error' => 'error', 'message' => "Inalid Coupon Code"]);
        } else {
            $dbProductId = explode(",", $CouponInfo->product_id);
            $productIds = explode(",", $cartProductIds);

            $availableId = array_intersect($productIds, $dbProductId);

            if (!empty($availableId)) {

                $startDate = $CouponInfo->start_date;
                $endDate = $CouponInfo->end_date;
                $minimumOrder = $CouponInfo->min_order_amount;
                $couponType = $CouponInfo->coupon_type;
                $couponAmount = $CouponInfo->amount;

                $couponDate['start_date'] = $startDate;
                $couponDate['end_date'] = $endDate;

                $CheckCouponDate = $this->productCartService->checkCouponDate($couponCode);
                if (empty($CheckCouponDate)) {
                    return response()->json(['error' => 'error', 'message' => "Expired Coupon Code Validity"]);
                } else {

                    if ($itemTotalPrice <= $minimumOrder) {
                        return response()->json(['error' => 'error', 'message' => "Order Required Minimum ₹$minimumOrder"]);
                    } else {
                        if ($couponType == "Percentage") {
                            $finalAmount = ($itemTotalPrice * $couponAmount) / 100;
                            $message = "flat $couponAmount% Off";
                        } else {
                            $finalAmount = $couponAmount;
                            $message = "flat ₹$couponAmount off";
                        }

                        $guestId = $request->session()->get('guestId');

                        $codeDetails['user_id'] = $guestId;
                        $codeDetails['coupon_code'] = $couponCode;
                        $codeDetails['coupon_type'] = $couponType;
                        $codeDetails['coupon_amount'] = $couponAmount;

                        $checkUsesCode = $this->productCartService->checkCouponUses($guestId);

                        if (empty($checkUsesCode)) {

                            $insertData = $this->productCartService->AddCouponUses($codeDetails);
                        } else {


                            $updateData = $this->productCartService->updateCouponUses($guestId, $codeDetails);
                        }


                        return response()->json(['success' => 'success', 'message' => $message, 'TotalAmount' => $finalAmount]);


                    }
                }

            } else {
                return response()->json(['error' => 'error', 'message' => "Invalid Coupon Code For this Product"]);
            }
        }



    }


    public function UserRegistration()
    {
        $pagename['page_title'] = "Registration";

        return view('user.front_user_registration', compact('pagename'));
    }

    public function AddUserData(CreateFrontUserRegistration $request)
    {
        try {
            $UserData['firstname'] = $request->get('firstname');
            $UserData['lastname'] = $request->get('lastname');
            $UserData['name'] = $request->get('username');
            $UserData['email'] = $request->get('email');
            $UserData['phone'] = $request->get('mobile');
            $UserData['address'] = $request->get('address1');
            $UserData['address2'] = $request->get('address2');
            $UserData['country'] = $request->get('country');
            $UserData['state'] = $request->get('state');
            $UserData['zip'] = $request->get('zip');
            $UserData['password'] = Hash::make($request->get('password'));
            $UserData['status'] = "0";
            $UserData['is_admin'] = "0";

            $insertUserData = $this->productCartService->AddUserRegistration($UserData);

            $userId = $insertUserData->id;

            $storeUserId = $request->session()->put('userId', $userId);




            if (!empty($insertUserData)) {
                return redirect()->route("product.checkout")->with('success', 'User Registration Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Adding User Registration');
            }


        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("product.checkout")->with('error', 'Error while adding User Registration');
        }

    }

    public function AddUserLogin(Request $request)
    {
        try {
            $email = $request->get('user_email');

            $password = $request->get('user_password');

            $GetUserData = $this->productCartService->checkUser($email);


            if (empty($GetUserData)) {
                return redirect()->route("product.checkout")->with('error', 'Email Address is not exits.');
            } else {
                $tablePassword = $GetUserData->password;

                if (Hash::check($password, $tablePassword)) {

                    $userId = $GetUserData->id;

                    $storeUserId = $request->session()->put('userId', $userId);
                    return redirect()->route("product.checkout");

                } else {
                    return redirect()->route("product.checkout")->with('error', 'Invalid Email Address Or Password.');
                }

            }


        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("product.checkout")->with('error', 'Error while adding User Registration');
        }
    }

    public function addcheckoutDetails(Request $request)
    {
        // dd($request->all());
        try {




            $guestId = $request->session()->get('guestId');

            if ($request->session()->get('userId') != '') {

                $userId = $request->session()->get('userId');

                $checkoutDetails['user_id'] = $userId;
            }

            $userId = $request->session()->get('userId');

            $paymentMethod = $request->get('paymentMethod');

            if ($paymentMethod == "cash") {
                $checkoutDetails['order_status'] = "Completed";
            }

            $checkoutDetails['guest_id'] = $guestId;
            $checkoutDetails['total_amount'] = $request->get('totalAmount');
            $checkoutDetails['order_type'] = $paymentMethod;
            $checkoutDetails['fname'] = $request->get('firstname');
            $checkoutDetails['lname'] = $request->get('lastname');
            $checkoutDetails['username'] = $request->get('username');
            $checkoutDetails['email'] = $request->get('email');
            $checkoutDetails['mobile'] = $request->get('mobile');
            $checkoutDetails['address1'] = $request->get('address');
            $checkoutDetails['address2'] = $request->get('address2');
            $checkoutDetails['country'] = $request->get('country');
            $checkoutDetails['state'] = $request->get('state');
            $checkoutDetails['zip'] = $request->get('zip');
            $isChecked = $request->has('differentShipping');
            $checkoutDetails['differentShipping'] = $isChecked;



            $differentShipping = $request->get('differentShipping');

            if ($differentShipping == "yes") {
                $checkoutDetails['s_fname'] = $request->get('s_firstname');
                $checkoutDetails['s_lname'] = $request->get('s_lastname');
                $checkoutDetails['s_username'] = $request->get('s_username');
                $checkoutDetails['s_email'] = $request->get('s_email');
                $checkoutDetails['s_mobile'] = $request->get('s_mobile');
                $checkoutDetails['s_address1'] = $request->get('s_address1');
                $checkoutDetails['s_address2'] = $request->get('s_address2');
                $checkoutDetails['s_country'] = $request->get('s_country');
                $checkoutDetails['s_state'] = $request->get('s_state');
                $checkoutDetails['s_zip'] = $request->get('s_zip');
            }

            $AddUserCheckoutData = $this->productCartService->AddUserCheckoutData($checkoutDetails);
            if ($AddUserCheckoutData) {
                $orderSequenceNumber = $AddUserCheckoutData->id;
                $deliveryCode = $AddUserCheckoutData->order_type == "cash" ? "001" : "002";
                $orderNumber = $this->generateOrderNumber($deliveryCode, $orderSequenceNumber);

                // Save order number back to the checkout record
                $AddUserCheckoutData->order_number = $orderNumber;
                $AddUserCheckoutData->save();

                // dd($orderNumber);
            }

            // dd($AddUserCheckoutData);

            $userId = $request->session()->get('userId');

            if ($paymentMethod == "cash") {

                $cartDetails['user_id'] = $userId;
                $cartDetails['order_status'] = "Completed";
                $updateCartDetails = $this->productCartService->updateCartDetails($guestId, $cartDetails);

                $userGuestId = $guestId;
                $userEmailAddress = $request->get('email');

                $this->sendProductInvoice('Product Invoice', [$userGuestId], $other = $userEmailAddress);

                $this->sendAdminEmail('Admin Email', [$userGuestId], $other = $userEmailAddress);

                return redirect()->route("product.success", ['orderNumber' => $orderNumber]);
            }
            if ($paymentMethod == "online") {
                $encrypt_id = Crypt::encrypt($AddUserCheckoutData->id);

                // $decryptedText = Crypt::decrypt($encrypt_id);
                return redirect()->route('razorpay.payment.form', ['encrypt_id' => $encrypt_id]);
            }

        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("product.checkout")->with('error', 'Error while adding User Registration');
        }

    }
    public function generateOrderNumber($deliveryCode, $orderSequenceNumber)
    {
        $companyCode = "KM";
        $orderDate = Carbon::now()->format('dmy');
        return $companyCode . "-" . $orderDate . "-" . $deliveryCode . "-" . $orderSequenceNumber;
    }

    public function success(Request $request)
    {
        // dd($request->all());

        $pagename['page_title'] = "Success";

        $guestId = $request->session()->get('guestId');
        $order_number = $request->orderNumber;

        $cartDetails['guest_id'] = $guestId;
        $cartDetails['order_status'] = "Completed";
        $updateCartDetails = $this->productCartService->updateCartDetails($guestId, $cartDetails);



        $orderDetails['order_status'] = "Completed";
        $updateOrderDetails = $this->productCartService->updateOrderDetails($order_number, $orderDetails);





        $countCartPoducts = DB::table('temp_addcarts')->where('guest_id', $guestId)->where('order_status', 'Pending')->whereNull('deleted_at')->count();

        $checkCartPoducts = DB::table('order_details')->where('order_number', $order_number)->first();

        $userGuestId = $checkCartPoducts->guest_id;
        $userEmailAddress = $checkCartPoducts->email;

        $this->sendProductInvoice('Product Invoice', [$userGuestId], $other = $userEmailAddress);

        $this->sendAdminEmail('Admin Email', [$userGuestId], $other = $userEmailAddress);

        return view('product.success', compact('pagename', 'countCartPoducts', 'order_number'));
    }

}
