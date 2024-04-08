<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function __construct(private readonly PostRepositoryInterface $postRepository) { }

    public function index() {
        $posts = $this->postRepository->getAll();
        return view('welcome', compact('posts'));
    }
}
