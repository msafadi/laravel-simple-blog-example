@extends('layouts.admin')

@section('title', 'Create New Post')

@section('breadcrumb')
@parent
<li class="breadcrumb-item">Posts</li>
<li class="breadcrumb-item active">Create Post</li>
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

<form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-8">
            <x-form.input name="title" label="Title" class="form-control-lg" />

            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea name="content"
                    class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
                    <label class="form-check-label" for="category-{{ $category->id }}">
                        {{ $category->title }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image:</label>
                <input type="file" name="featured_image"
                    class="form-control @error('featured_image') is-invalid @enderror">
                @error('featured_image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection