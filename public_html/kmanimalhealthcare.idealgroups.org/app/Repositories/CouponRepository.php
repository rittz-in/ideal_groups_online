<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\CouponCodes;
use App\Models\Product;


class CouponRepository
{

    public function find($id)
    {
        return CouponCodes::find($id);
    }

    public function create(array $data)
    {
        return CouponCodes::create($data);
    }

    public function update($id, array $data)
    {
        return CouponCodes::find($id)->update($data);
    }

    public function delete($id)
    {
        return CouponCodes::find($id)->delete();
    }

    public function getAll()
    {
        return CouponCodes::all();
    }

    public function getAllProduct()
    {
        return Product::all();
    }



}
