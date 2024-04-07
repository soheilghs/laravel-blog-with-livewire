<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
    implements CategoryRepositoryInterface {

    public function getAll() {
        return Category::all();
    }

    public function findById($id) {
        return Category::findOrFail($id);
    }

    public function delete($id) {

    }

    public function create(array $data) {
        Category::create($data);
    }

    public function update($id, array $data) {
        return Category::whereId($id)->update($data);
    }

    public function getWithParents() {
        return Category::with('parent')->get();
    }
}
