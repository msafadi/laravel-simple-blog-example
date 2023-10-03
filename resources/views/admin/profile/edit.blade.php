@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Edit Profile</li>
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

<x-alert type="success" name="success" />

<form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="row">
        <div class="col-md-8">
            <x-form.input name="first_name" label="First Name" :value="$user->profile->first_name" />
            <x-form.input name="last_name" label="Last Name" :value="$user->profile->last_name" />
            <x-form.input type="date" name="birthday" label="Birthday" :value="$user->profile->birthday" />
        </div>
        <div class="col-md-4">

        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection