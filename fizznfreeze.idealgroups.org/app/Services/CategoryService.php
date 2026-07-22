<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;

class CategoryService

{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function create($data)
    {
        $category = $this->categoryRepository->create($data);
        return $category;
    }
    public function getAllCategory()
    {
        $categories = $this->categoryRepository->getAll();
        return $categories;
    }
    public function getCategory($id)
    {
        $category = $this->categoryRepository->find($id);
        return $category;
    }
    public function deleteCategory($id)
    {
        $deleted = $this->categoryRepository->delete($id);
        return $deleted;
    }
    public function updateCategory($id, $data)
    {
        $updated = $this->categoryRepository->update($id, $data);
        return $updated;
    }

    public function getAllSiteCategory()
    {
        $categories = $this->categoryRepository->getAllSiteCategory();
        return $categories;
    }   
}
