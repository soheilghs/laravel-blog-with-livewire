<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller {

    public function __construct(private readonly PostRepositoryInterface     $postRepository,
                                private readonly CategoryRepositoryInterface $categoryRepository) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $posts = $this->postRepository->getWithCategories();
        return view('admin.post.index',
            compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = $this->categoryRepository
            ->getAll(['id', 'title']);
        return view('admin.post.create',
            compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $this->validateData($request);

        if ($request->hasfile('image')) {
            $filename = $this->uploadImage($request);
            $data['image'] = $filename;
        }

        $this->postRepository->create($data);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $categories = $this->categoryRepository
            ->getAll(['id', 'title']);
        $post = $this->postRepository->findById($id);

        return view('admin.post.edit',
            compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $data = $this->validateData($request, true);

        if ($request->hasfile('image')) {
            $this->deleteImage($id);
            $filename = $this->uploadImage($request);
            $data['image'] = $filename;
        }

        $this->postRepository->update($id, $data);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->deleteImage($id);
        $this->postRepository->delete($id);
        return redirect()->route('admin.posts.index');
    }

    private function validateData(Request $request, $update = false) {
        $rules = [
            'title' => 'required',
            'body' => 'required|string|min:15',
            'category' => 'required|integer|gt:0|exists:categories,id'
        ];

        $rules['image'] = [Rule::requiredIf(!$update), 'image'];

        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category
        ];

        return $data;
    }

    private function uploadImage(Request $request) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('uploads/posts/', $filename);
        return $filename;
    }

    private function deleteImage($id) {
        $image = $this->postRepository
            ->findById($id, ['image'])->image;
        $image = public_path("uploads/posts/$image");
        File::delete($image);
    }
}
