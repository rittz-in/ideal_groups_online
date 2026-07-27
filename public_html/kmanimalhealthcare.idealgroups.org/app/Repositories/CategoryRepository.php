<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{

    public function find($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        return Category::find($id)->update($data);
    }

    public function delete($id)
    {
        return Category::find($id)->delete();
    }

    public function getAll()
    {
        return Category::all();
    }

    public function getMainCategories()
    {
        return Category::all();
    }

    public function getCategoryName($slug_name)
    {
        return Category::where('slug_url', $slug_name)->first();
    }






}
