@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="/home" class="list-group-item">Dashboard</a>
                <a href="{{ route('posts.index') }}" class="list-group-item">Posts</a>
                <a href="{{ route('categories.index') }}" class="list-group-item">Categories</a>
                <a href="#" class="list-group-item">Users</a>
            </div>
            <div class="list-group mt-3">
                <a href="{{ route('posts.trash') }}" class="list-group-item">Trash Posts</a>
            </div>
        </div>
        <div class="col-md-9">
            @yield('page')
        </div>
    </div>
</div>
@endsection