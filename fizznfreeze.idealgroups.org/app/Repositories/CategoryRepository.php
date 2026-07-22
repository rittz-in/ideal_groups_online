<?php

namespace App\Repositories;

use App\Models\User;
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
        $category = Category::find($id);
        return $category->update($data);
    }

    public function delete($id)
    {
        return Category::where('id', $id)->delete();
    }
    public function getAll()
    {
        $data = Category::orderBy('created_at', 'desc')->get();
        return $data;
    }

    public function getAllSiteCategory()
    {
        return Category::whereIn('id', Category::role('User')->pluck('id'))->whereNull('deleted_at')->get();

        // return User::role('User')->whereNull('deleted_at')->get();
    }
}
