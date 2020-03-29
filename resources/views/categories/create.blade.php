@extends('layouts.dashboard')
@section('page')
<div class="card card-default">
    <div class="card-header">Create Category</div>
    <div class="card-body">
        <form action="{{ route('categories.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="Name">
                @error('name')
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Add Category</button>
        </form>
    </div>
</div>

@endsection