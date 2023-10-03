<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
