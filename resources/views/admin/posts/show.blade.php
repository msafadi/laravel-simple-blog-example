@extends('layouts.admin')

@section('title', $post->title)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Posts</li>
    <li class="breadcrumb-item active">{{ $post->title }}</li>
@endsection

@section('content')
    <h2>{{ $post->title }}</h2>
    <div class="mt-4">
        {{ $post->content }}
    </div>
@endsection