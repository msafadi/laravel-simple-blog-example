@extends('layouts.admin')

@section('title', 'Trashed Posts')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Posts</li>
@endsection

@section('content')

    <div class="d-flex mb-5">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-dark">Posts</a>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th></th>
                <th>Title</th>
                <th>Status</th>
                <th>Delete Time</th>
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
                <td>{{ $post->status }}</td>
                <td>{{ $post->deleted_at }}</td>
                <td>
                    <form action="{{ route('admin.posts.restore', $post->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-primary">Resore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.posts.force-delete', $post->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete Forever</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->withQueryString()->links() }}

@endsection