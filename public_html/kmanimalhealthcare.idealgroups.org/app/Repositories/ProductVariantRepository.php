<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Category;


use App\Models\ProductVarients;
use App\Models\VarientsTypes;


class ProductVariantRepository
{

    public function getProductVarient($id)
    {
        return ProductVarients::where('id', $id)->first();
    }

    public function getVarientsType($id)
    {
        return VarientsTypes::where('varient_id', $id)->get();
    }



    public function getProductImages($id)
    {

        return Product_image::where('product_id', $id)->get();
    }

    public function create(array $data)
    {
        return ProductVarients::create($data);
    }

    public function addVariantType(array $data)
    {


        return VarientsTypes::create($data);
    }





    public function addProductImages(array $data)
    {

        return Product_image::create($data);
    }




    public function update($id, array $data)
    {
        return ProductVarients::find($id)->update($data);
    }

    public function updateVarientsType($id, array $data)
    {
        return VarientsTypes::find($id)->update($data);
    }


    public function updateProductVarients($id, array $data)
    {

        return ProductVarients::find($id)->update($data);
    }









    public function delete($id)
    {
        return ProductVarients::find($id)->delete();
    }

    public function deleteVarientType($id)
    {

        return VarientsTypes::find($id)->delete();
    }




    public function deleteProductImage($id)
    {
        return Product_image::find($id)->delete();
    }



    public function getAll()
    {

        return ProductVarients::query();
    }

    public function getCategoies()
    {
        return Category::whereNull('parent_id')->query();
    }

    public function getParentCategory($id)
    {

        return Category::where('parent_id', $id)->get();
    }



    public function getAllSubCategory($id)
    {

        return Category::where('parent_id', $id)->get();


    }





}
