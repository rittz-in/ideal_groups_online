<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Category;

use App\Models\ProductVarients;
use App\Models\VarientsTypes;

use App\Models\VarientsTypesDetails;



class ProductRepository
{
    public function getProductVarient()
    {
        return ProductVarients::get();
    }


    public function getVarientTypeDetail($id)
    {
        return VarientsTypesDetails::where('product_id', $id)->get();
    }





    public function find($id)
    {
        return Product::find($id);
    }

    public function getProductImages($id)
    {

        return Product_image::where('product_id', $id)->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function addProductImages(array $data)
    {

        return Product_image::create($data);
    }


    public function addVarientTypeDetail(array $data)
    {

        return VarientsTypesDetails::create($data);
    }




    public function update($id, array $data)
    {
        return Product::find($id)->update($data);
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
