<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'categories'])->latest('published_at')->paginate();
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
