<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }





    public function getCategoies()
    {
        $user = $this->productRepository->getCategoies();
        return $user;
    }

    public function getParentCategoies($id)
    {
        $user = $this->productRepository->getParentCategory($id);
        return $user;
    }

    public function getProductVarients()
    {
        $user = $this->productRepository->getProductVarient();
        return $user;
    }

    public function getVarientTypeDetails($id)
    {
        $user = $this->productRepository->getVarientTypeDetail($id);
        return $user;
    }









    public function create($UserData)
    {
        $user = $this->productRepository->create($UserData);
        return $user;
    }

    public function addProductImage($UserData)
    {
        $user = $this->productRepository->addProductImages($UserData);
        return $user;
    }

    public function addVarientTypeDetails($UserData)
    {
        $user = $this->productRepository->addVarientTypeDetail($UserData);
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

    public function updateProduct($id, $UserData)
    {
        $updated = $this->productRepository->update($id, $UserData);
        return $updated;
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
