<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller {

    public function __construct(private readonly PostRepositoryInterface $postRepository) {

    }

    public function show($id) {
        $post = $this->postRepository->findById($id);
        return view('front.post.show',
            compact('post'));
    }
}
