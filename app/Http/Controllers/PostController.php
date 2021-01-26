<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function index() {
        $data = [
            'posts' => Post::select('title', 'author')->get()
        ];
        return view('guest.posts.index', $data);
    }
}
