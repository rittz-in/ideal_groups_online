<?php

namespace App\Repositories;

use App\Models\Table;

class TablesRepository
{
    public function find($id)
    {
        return Table::find($id);
    }

    public function create(array $data)
    {
        return Table::create($data);
    }

    public function update($id, array $data)
    {
        $table = Table::find($id);
        return $table->update($data);
    }

    public function delete($id)
    {
        return Table::where('id', $id)->delete();
    }

    public function getAll()
    {
        return Table::orderBy('created_at', 'desc')->get();
    }
}
