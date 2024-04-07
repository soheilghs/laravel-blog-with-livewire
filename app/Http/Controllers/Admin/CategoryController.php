<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $this->categoryRepository->create($data);

        return redirect()->route('admin.category.all');
    }

    public function edit($id) {
        $categories = $this->categoryRepository->getAll();
        $cat = $this->categoryRepository->findById($id);

        return view('admin.category.edit',
            compact('categories', 'cat'));
    }
}
