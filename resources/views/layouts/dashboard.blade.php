@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="" class="list-group-item active">Dashboard</a>
                <a href="" class="list-group-item">Posts</a>
                <a href="" class="list-group-item">Categories</a>
                <a href="" class="list-group-item">Users</a>
            </div>
        </div>
        <div class="col-md-9">
            @yield('page')
        </div>
    </div>
</div>
@endsection