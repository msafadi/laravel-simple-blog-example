@extends('layouts.admin')

@section('title', 'Edit Post')

@section('breadcrumb')
@parent
<li class="breadcrumb-item">Posts</li>
<li class="breadcrumb-item active">Edit Post</li>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="row">
        <div class="col-md-8">
            <x-form.input name="title" label="Title" :value="$post->title" class="form-control-lg" />

            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea name="content" class="form-control">{{ old('content', $post->content) }}</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}" @checked(in_array($category->id, $selected_categories))>
                    <label class="form-check-label" for="category-{{ $category->id }}">
                        {{ $category->title }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image:</label>
                <div class="border p-1 rounded">
                    <img src="{{ Storage::disk('public')->url($post->featured_image_path) }}" alt="">
                </div>
                <input type="file" name="featured_image" class="form-control">
            </div>
        </div>
    </div>



    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection