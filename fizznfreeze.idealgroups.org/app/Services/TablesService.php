<?php

namespace App\Services;

use App\Repositories\TablesRepository;

class TablesService
{
    protected $tablesRepository;

    public function __construct(TablesRepository $tablesRepository)
    {
        $this->tablesRepository = $tablesRepository;
    }

    public function getAllTables()
    {
        return $this->tablesRepository->getAll();
    }

    public function getTable($id)
    {
        return $this->tablesRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->tablesRepository->create($data);
    }

    public function updateTable($id, array $data)
    {
        return $this->tablesRepository->update($id, $data);
    }

    public function deleteTable($id)
    {
        return $this->tablesRepository->delete($id);
    }
}
