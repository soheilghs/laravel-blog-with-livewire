<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
    implements PostRepositoryInterface {

    public function getAll(array $select = null) {
        if (empty($select)) {
            return Post::all();
        }

        return Post::select($select)->get();
    }

    public function findById($id, array $select = null) {
        if (!empty($select)) {
            return Post::findOrFail($id, $select);
        }

        return Post::findOrFail($id);
    }

    public function delete($id) {
        Post::destroy($id);
    }

    public function create(array $data) {
        Post::create($data);
    }

    public function update($id, array $data) {
        return Post::whereId($id)->update($data);
    }

    public function getWithCategories() {
        return Post::with('category:id,title')->get();
    }
}
