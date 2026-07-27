<?php
namespace App\Services;

use App\Repositories\ProductCartRepository;

class ProductCartService
{
    protected ProductCartRepository $productCartRepository;

    public function __construct(ProductCartRepository $productCartRepository)
    {
        $this->productCartRepository = $productCartRepository;
    }


    public function countCartDetails($id, $productId, $VarientSize)
    {
        $user = $this->productCartRepository->countCartDetail($id, $productId, $VarientSize);
        return $user;
    }




    public function create($UserData)
    {
        $user = $this->productCartRepository->create($UserData);
        return $user;
    }


    public function checkCartDetails($id, $productId)
    {
        $user = $this->productCartRepository->checkCartDetail($id, $productId);
        return $user;
    }

    public function updateCart($id, $UserData)
    {
        $updated = $this->productCartRepository->update($id, $UserData);
        return $updated;
    }


    public function countTotalCartDetails($guestId, $userId, $productId)
    {
        $user = $this->productCartRepository->countTotalCartDetail($guestId, $userId, $productId);
        return $user;
    }


    public function deletetempCartProducts($id)
    {
        $deleted = $this->productCartRepository->deletetempCartProduct($id);
        return $deleted;
    }

    public function checkCouponCode($couponCode, $cartProductIds)
    {
        $deleted = $this->productCartRepository->checkCouponCode($couponCode, $cartProductIds);
        return $deleted;
    }

    public function checkCouponDate($couponCode)
    {
        $deleted = $this->productCartRepository->checkCouponDate($couponCode);
        return $deleted;
    }

    public function checkCouponUses($guestId)
    {
        $deleted = $this->productCartRepository->checkCouponUses($guestId);
        return $deleted;
    }


    public function AddCouponUses($couponData)
    {
        $deleted = $this->productCartRepository->AddCouponUses($couponData);
        return $deleted;
    }


    public function updateCouponUses($guestId, $CouponData)
    {
        $updated = $this->productCartRepository->updateCouponUses($guestId, $CouponData);
        return $updated;
    }



    public function AddUserRegistration($UserData)
    {
        $deleted = $this->productCartRepository->AddUserRegistration($UserData);
        return $deleted;
    }

    public function checkUser($email)
    {
        $deleted = $this->productCartRepository->checkUser($email);
        return $deleted;
    }

    public function getUserData($userId)
    {
        $deleted = $this->productCartRepository->getUserData($userId);
        return $deleted;
    }



    public function AddUserCheckoutData($UserData)
    {
        $deleted = $this->productCartRepository->AddUserCheckoutData($UserData);
        return $deleted;
    }


    public function updateCartDetails($guestId, $cartDetails)
    {
        $updated = $this->productCartRepository->updateCartDetails($guestId, $cartDetails);
        return $updated;
    }


    public function updateOrderDetails($order_number, $orderDetails)
    {
        $updated = $this->productCartRepository->updateOrderDetails($order_number, $orderDetails);
        return $updated;
    }






























    public function getCategoies()
    {
        $user = $this->productCartRepository->getCategoies();
        return $user;
    }

    public function getParentCategoies($id)
    {
        $user = $this->productCartRepository->getParentCategory($id);
        return $user;
    }

    public function getProductVarients()
    {
        $user = $this->productCartRepository->getProductVarient();
        return $user;
    }

    public function getVarientTypeDetails($id)
    {
        $user = $this->productCartRepository->getVarientTypeDetail($id);
        return $user;
    }













    public function addProductImage($UserData)
    {
        $user = $this->productCartRepository->addProductImages($UserData);
        return $user;
    }

    public function addVarientTypeDetails($UserData)
    {
        $user = $this->productCartRepository->addVarientTypeDetail($UserData);
        return $user;
    }








    public function getAllProducts()
    {
        $user = $this->productRepository->getAll();
        return $user;
    }

    public function getProduct($id)
    {
        $User = $this->productRepository->find($id);
        return $User;
    }

    public function getProductImage($id)
    {

        $User = $this->productRepository->getProductImages($id);
        return $User;
    }



    public function deleteProduct($id)
    {
        $deleted = $this->productRepository->delete($id);
        return $deleted;
    }

    public function deleteProductImage($id)
    {
        $deleted = $this->productRepository->deleteProductImage($id);
        return $deleted;
    }



    public function updateVarientTypeDetails($id, $UserData)
    {
        $updated = $this->productRepository->updateVarientTypeDetail($id, $UserData);
        return $updated;
    }




    public function getAllSubCategory($id)
    {
        $useres = $this->productRepository->getAllSubCategory($id);
        return $useres;
    }


    public function getProductVarientType($id)
    {
        $useres = $this->productRepository->getProductVarientTypes($id);
        return $useres;
    }





}
