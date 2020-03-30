@extends('layouts.dashboard')
@section('page')
<div class="card card-default">
    <div class="card-header">
        {{ isset($category) ? 'Edit Category': 'Create Category'}}
    </div>
    <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store')}}"
            method="POST">
            @csrf
            @if(isset($category))
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="Name" value="{{ isset($category) ? $category->name: '' }}">
                @error('name')
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                @enderror
            </div>
            <button type="submit"
                class="btn btn-success">{{ isset($category) ? 'Update Category': 'Add Category'}}</button>
        </form>
    </div>
</div>

@endsection