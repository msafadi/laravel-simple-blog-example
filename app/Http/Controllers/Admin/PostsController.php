<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    
    public function index()
    {
        $this->authorize('view-any', Post::class);
        // if (!Gate::allows('posts.view')) {
        //     abort(403);
        // }

        $posts = Post::with(['user'])->paginate(15); // Collection
        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('view', $post);
        // if (!Gate::allows('posts.view')) {
        //     abort(403);
        // }

        return view('admin.posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        // if (Gate::denies('posts.create')) {
        //     abort(403);
        // }
        $categories = Category::orderBy('title')->get();
        return view('admin.posts.create', [
            'categories' => $categories,
        ]);
    }

    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);
        // if (Gate::denies('posts.create')) {
        //     abort(403);
        // }
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
        $post->user_id = Auth::id();
        $post->save();

        $post->categories()->attach($request->input('categories'));

        // prg
        return redirect()
            ->route('admin.posts.index')
            ->with('success', __('Post created.'));
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        //Gate::authorize('posts.update');
        $categories = Category::orderBy('title')->get();

        $selected_categories = $post->categories->pluck('id')->toArray();

        return view('admin.posts.edit', [
            'post' => $post,
            'categories'=>$categories,
            'selected_categories' => $selected_categories,
        ]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        //Gate::authorize('posts.update');

        $old_image = $post->featured_image_path;

        $post->title =  $request->input('title');
        $post->slug = Str::slug($post->title);
        $post->content = $request->input('content');

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image'); // UploadedFile
            $path = $file->store('/images', 'public');
            $post->featured_image_path = $path;
        }

        $post->save();

        $post->categories()->sync($request->input('categories'));

        if ($old_image && $old_image != $post->featured_image_path) {
            Storage::disk('public')->delete($old_image);
        }

        Session::flash('success', 'Post updated');
        return redirect()
            ->route('admin.posts.index');
    }

    public function destroy($id)
    {
        $post = Post::withoutGlobalScope('published')->findOrFail($id);
        $this->authorize('delete', $post);
        // $user = Auth::user();
        // if (!$user->can('posts.delete')) {
        //     abort(403);
        // }

        // Post::destroy($id);
       
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post deleted');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate();
        return view('admin.posts.trashed',[
            'posts' => $posts
        ]);
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $post);
        $post->restore();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post restored');
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $this->authorize('force-delete', $post);
        $post->forceDelete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post deleted forever');
    }
}
