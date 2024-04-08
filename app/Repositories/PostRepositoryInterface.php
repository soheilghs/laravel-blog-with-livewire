<?php

namespace App\Repositories;

interface PostRepositoryInterface {

    public function getAll(array $select = null);
    public function findById($id, array $select = null);
    public function delete($id);
    public function create(array $data);
    public function update($id, array $data);

    public function getWithCategories();
}
