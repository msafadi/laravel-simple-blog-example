@extends('layouts.admin')

@section('title', 'Posts')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Posts</li>
@endsection

@section('content')
    <h1>{{ $title }}</h1>

    <ul>
        @foreach ($posts as $post)
        <li>{{ $post }}</li>
        @endforeach
    </ul>
@endsection

@push('styles')
<style>
    body {
        background-color: #000;
    }
</style>
@endpush

@push('scripts')
    <script>
        alert('Welcome')
    </script>
@endpush