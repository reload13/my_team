<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface DatabaseRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
