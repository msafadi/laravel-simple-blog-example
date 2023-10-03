@extends('layouts.admin')

@section('title', __('Posts'))

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{ __('Posts') }}</li>
@endsection

@section('content')

    <div class="d-flex mb-5">
        @can('create', App\Models\Post::class)
        <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-outline-primary">{{ __('Add New Post') }}</a>
        @endcan
        @can('posts.delete')
        <a href="{{ route('admin.posts.trashed') }}" class="ml-1 btn btn-sm btn-outline-danger">{{ __('View Trash') }}</a>
        @endcan
    </div>

    <x-alert type="info" name="success" />

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th></th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Publish Time</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td><img height="50" src="{{ Storage::disk('public')->url($post->featured_image_path) }}" alt=""></td>
                <td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->status }}</td>
                <td>{{ $post->published_at }}</td>
                <td>
                    @can('update', $post)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('delete', $post)
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->withQueryString()->links() }}

@endsection