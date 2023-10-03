<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::with('user:id,name', 'categories:id,title')->paginate(2);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image'); // UploadedFile
            $path = $file->store('/images', 'public');
            $post->featured_image_path = $path;
        }

        $post->title =  $request->input('title');
        $post->slug = Str::slug($post->title);
        $post->content = $request->input('content');
        $post->published_at = now();
        $post->user_id = null;
        $post->save();

        $post->categories()->attach($request->input('categories'));

        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Post::with('user', 'categories')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update post
        $post = Post::findOrFail($id);
        //$post->update();
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Post deleted'
        ]);
    }
}
