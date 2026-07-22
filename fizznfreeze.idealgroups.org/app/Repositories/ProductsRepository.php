<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Products;

class ProductsRepository
{
    public function find($id)
    {
        return Products::find($id);
    }

    public function create(array $data)
    {
        return Products::create($data);
    }

    public function update($id, array $data)
    {
        $product = Products::find($id);
        return $product->update($data);
    }

    public function delete($id)
    {
        return Products::where('id', $id)->delete();
    }
    public function getAll()
    {
        $data = Products::orderBy('created_at', 'desc')->get();
        
        return $data;
    }

    
}
