<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Category;

use App\Models\ProductVarients;
use App\Models\VarientsTypes;

use App\Models\VarientsTypesDetails;
use App\Models\TempAddcart;
use App\Models\CouponCodes;
use App\Models\UsesCouponCode;

use App\Models\OrderDetail;







class ProductCartRepository
{


    public function create(array $data)
    {
        //dd($data, "kbc");
        return TempAddcart::create($data);
    }



    public function countCartDetail($id, $productId, $VarientSize)
    {
        if ($VarientSize == NULL) {
            return TempAddcart::where(['guest_id' => $id, 'product_id' => $productId, 'order_status' => 'Pending'])->count();

        } else {
            return TempAddcart::where(['guest_id' => $id, 'product_id' => $productId, 'variant_size' => $VarientSize, 'order_status' => 'Pending'])->count();
        }

    }


    public function checkCartDetail($id, $productId)
    {
        //dd($data, "kbc");
        return TempAddcart::where(['guest_id' => $id, 'product_id' => $productId, 'order_status' => 'Pending'])->first();
    }

    public function update($id, array $data)
    {
        return TempAddcart::find($id)->update($data);
    }


    public function countTotalCartDetail($guestId, $userId, $productId)
    {
        if ($guestId != '') {
            $where = ['guest_id' => $guestId];
        } else {
            $where = ['user_id' => $userId];
        }
        //dd($data, "kbc");
        return TempAddcart::where($where)->where(['product_id' => $productId, 'order_status' => 'Pending'])->count();
    }


    public function checkCouponCode($couponCode, $cartProductIds)
    {



        return CouponCodes::where('coupon_code', $couponCode)->first();
    }

    // public function checkCouponCode($couponCode, $cartProductIds)
    // {

    //     $productIds = explode(",", $cartProductIds);
    //     $checkCoupon = CouponCodes::where('coupon_code', $couponCode)
    //         ->whereIn('product_id', $productIds)
    //         ->get();
    //     return $checkCoupon;
    // }


    public function checkCouponDate($couponCode)
    {
        $date = date("Y-m-d");
        return CouponCodes::where('coupon_code', $couponCode)->whereDate('start_date', '<=', $date)->whereDate('end_date', '>=', $date)->first();
    }

    public function checkCouponUses($guestId)
    {
        return UsesCouponCode::where('user_id', $guestId)->count();
    }

    public function AddCouponUses($couponData)
    {
        return UsesCouponCode::create($couponData);
    }

    public function updateCouponUses($guestId, $couponData)
    {
        return UsesCouponCode::where('user_id', $guestId)->update($couponData);
    }







    public function AddUserRegistration($UserData)
    {
        return User::create($UserData);
    }

    public function checkUser($email)
    {
        return User::where('email', $email)->first();
    }

    public function getUserData($userId)
    {
        return User::where('id', $userId)->first();
    }

    public function AddUserCheckoutData($UserData)
    {
        return OrderDetail::create($UserData);
    }


    public function updateCartDetails($guestId, $cartDetails)
    {
        return TempAddcart::where('guest_id', $guestId)->update($cartDetails);
    }


    public function updateOrderDetails($order_number, $orderDetails)
    {
        return OrderDetail::where('order_number', $order_number)->update($orderDetails);
    }
































    public function getProductVarient()
    {
        return TempAddcart::get();
    }


    public function getVarientTypeDetail($id)
    {
        return TempAddcart::where('product_id', $id)->get();
    }





    public function find($id)
    {
        return TempAddcart::find($id);
    }

    public function getProductImages($id)
    {

        return TempAddcart::where('product_id', $id)->get();
    }



    public function addProductImages(array $data)
    {

        return TempAddcart::create($data);
    }


    public function addVarientTypeDetail(array $data)
    {

        return TempAddcart::create($data);
    }


    public function deletetempCartProduct($id)
    {

        return TempAddcart::find($id)->delete();
    }












    public function updateVarientTypeDetail($id, array $data)
    {


        return VarientsTypesDetails::find($id)->update($data);
    }



    public function delete($id)
    {
        return Product::find($id)->delete();
    }





    public function deleteProductImage($id)
    {
        return Product_image::find($id)->delete();
    }



    public function getAll()
    {
        return Product::all();
    }

    public function getCategoies()
    {
        return Category::whereNull('parent_id')->get();
    }

    public function getParentCategory($id)
    {

        return Category::where('parent_id', $id)->get();
    }

    // public function getProductVarient($id)
    // {

    //     return Category::where('parent_id', $id)->get();
    // }




    public function getAllSubCategory($id)
    {

        return Category::where('parent_id', $id)->get();


    }


    public function getProductVarientTypes($id)
    {

        return VarientsTypes::where('varient_id', $id)->get();


    }






}
