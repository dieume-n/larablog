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
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>Category Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td><a href="{{ route('categories.edit', $category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection