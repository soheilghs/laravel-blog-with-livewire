<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(private readonly
                                CategoryRepositoryInterface $categoryRepository) {
    }

    public function index() {
        $categories = $this->categoryRepository->getWithParents();
        return view('admin.category.index',
            compact('categories'));
    }

    public function create() {
        $categories = $this->categoryRepository->getAll();

        return view('admin.category.create',
            compact('categories'));
    }

    public function store(Request $request) {
        $data = $this->validateData($request);

        $this->categoryRepository->create($data);

        return redirect()->route('admin.categories.index');
    }

    public function edit($id) {
        $categories = $this->categoryRepository->getAll();
        $category = $this->categoryRepository->findById($id);

        return view('admin.category.edit',
            compact('categories', 'category'));
    }

    public function update(Request $request, $id) {
        $data = $this->validateData($request);

        if ($this->categoryRepository->update($id, $data)) {
            return redirect()->route('admin.categories.index');
        }

        return redirect()->back();
    }

    public function destroy($id) {
        $this->categoryRepository->delete($id);
        return redirect()->route('admin.categories.index');
    }

    private function validateData(Request $request) {
        $rules = [
            'title' => 'required'
        ];

        if ($request->parent) {
            $rules['parent'] = 'integer|gt:0|exists:categories,id';
        }

        $request->validate($rules);

        $data = [
            'title' => $request->title
        ];

        if ($request->parent) {
            $data['parent_id'] = $request->parent;
        }

        return $data;
    }
}
