<?php

namespace App\Repositories;

interface CategoryRepositoryInterface {

    public function getAll(array $select = null);
    public function findById($id);
    public function delete($id);
    public function create(array $data);
    public function update($id, array $data);
    public function getWithParents();
}
