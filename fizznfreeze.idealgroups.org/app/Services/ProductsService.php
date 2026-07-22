<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\ProductsRepository;

class ProductsService

{
    protected ProductsRepository $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }
    public function create($data)
    {
        $product = $this->productsRepository->create($data);
        return $product;
    }
    public function getAllProducts()
    {
        $products = $this->productsRepository->getAll();
        return $products;
    }
    public function getProducts($id)
    {
        $product = $this->productsRepository->find($id);
        return $product;
    }
    public function deleteProducts($id)
    {
        $deleted = $this->productsRepository->delete($id);
        return $deleted;
    }
    public function updateProducts($id, $data)
    {
        $updated = $this->productsRepository->update($id, $data);
        return $updated;
    }

    
}
