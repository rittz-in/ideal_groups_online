<?php
namespace App\Services;

use App\Repositories\CouponRepository;

class CouponService
{
    protected CouponRepository $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function create($CategoryData)
    {
        $category = $this->couponRepository->create($CategoryData);
        return $category;
    }


    public function getAllProducts()
    {
        $category = $this->couponRepository->getAllProduct();
        return $category;
    }



    public function getAllCoupons()
    {
        $category = $this->couponRepository->getAll();
        return $category;
    }

    public function getCoupon($id)
    {
        $Category = $this->couponRepository->find($id);
        return $Category;
    }

    public function deleteCoupon($id)
    {
        $deleted = $this->couponRepository->delete($id);
        return $deleted;
    }

    public function updateCoupon($id, $CategoryData)
    {
        $updated = $this->couponRepository->update($id, $CategoryData);
        return $updated;
    }

}
