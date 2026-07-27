<?php
namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create($CategoryData)
    {
        $category = $this->categoryRepository->create($CategoryData);
        return $category;
    }

    public function getAllCategory()
    {
        $category = $this->categoryRepository->getAll();
        return $category;
    }

    public function getMainCategory()
    {
        $category = $this->categoryRepository->getMainCategories();
        return $category;
    }

    public function getCategoryNames($slug_name)
    {
        $category = $this->categoryRepository->getCategoryName($slug_name);
        return $category;
    }





    public function getCategory($id)
    {
        $Category = $this->categoryRepository->find($id);
        return $Category;
    }

    public function deleteCategory($id)
    {
        $deleted = $this->categoryRepository->delete($id);
        return $deleted;
    }

    public function updateCategory($id, $CategoryData)
    {
        $updated = $this->categoryRepository->update($id, $CategoryData);
        return $updated;
    }

}
