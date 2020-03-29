@extends('layouts.dashboard')
@section('page')
<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h4>Categories</h4>
            </div>
            <div class="col">
                <a class="btn btn-success float-right" href="{{ route('categories.create')}}">Add Category</a>
            </div>
        </div>
    </div>
</div>
@endsection