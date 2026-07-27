<?php
namespace App\Services;

use App\Repositories\ProductVariantRepository;

class ProductVariantService
{
    protected ProductVariantRepository $productVariantRepository;

    public function __construct(ProductVariantRepository $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }




    public function getCategoies()
    {
        $user = $this->productVariantRepository->getCategoies();
        return $user;
    }

    public function getParentCategoies($id)
    {
        $user = $this->productVariantRepository->getParentCategory($id);
        return $user;
    }




    public function create($UserData)
    {
        $user = $this->productVariantRepository->create($UserData);
        return $user;
    }

    public function addVariantType($UserData)
    {

        $user = $this->productVariantRepository->addVariantType($UserData);
        return $user;
    }




    public function addProductImage($UserData)
    {
        $user = $this->productVariantRepository->addProductImages($UserData);
        return $user;
    }





    public function getAllProductVarients()
    {
        $user = $this->productVariantRepository->getAll();
        return $user;
    }

    public function getProductVarients($id)
    {

        $User = $this->productVariantRepository->getProductVarient($id);
        return $User;
    }

    public function getVarientsTypes($id)
    {

        $User = $this->productVariantRepository->getVarientsType($id);
        return $User;
    }




    public function getProductImage($id)
    {

        $User = $this->productVariantRepository->getProductImages($id);
        return $User;
    }




    public function deleteVarientTypes($id)
    {

        $deleted = $this->productVariantRepository->deleteVarientType($id);
        return $deleted;
    }


    public function deleteProductVarient($id)
    {
        $deleted = $this->productVariantRepository->delete($id);
        return $deleted;
    }

    public function deleteProductImage($id)
    {
        $deleted = $this->productVariantRepository->deleteProductImage($id);
        return $deleted;
    }

    public function updateVarientsTypes($id, $UserData)
    {
        $updated = $this->productVariantRepository->updateVarientsType($id, $UserData);
        return $updated;
    }


    public function updateProductVarient($id, $UserData)
    {
        $updated = $this->productVariantRepository->updateProductVarients($id, $UserData);
        return $updated;
    }








    public function getAllSubCategory($id)
    {
        $useres = $this->productVariantRepository->getAllSubCategory($id);
        return $useres;
    }



}
