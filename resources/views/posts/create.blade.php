@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection

@section('page')
<div class="card card-default">
    <div class="card-header">
        {{ isset($post) ? 'Edit Post': 'Create Post'}}
    </div>
    <div class="card-body">
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if(isset($post))
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    placeholder="Title" value="{{ isset($post) ? $post->title: '' }}">
                @error('title')
                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" placeholder="Description">{{ isset($post) ? $post->description: '' }}</textarea>
                @error('description')
                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input id="x" type="hidden" name="content" id="content" value="{{ isset($post) ? $post->content: '' }}">
                <trix-editor input="x"></trix-editor>
            </div>
            <div class="form-group">
                <label for="published_at" class="mt-3">Published Date</label>
                <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at"
                    name="published_at" placeholder="" value="{{ isset($post) ? $post->published_at: '' }}">
                @error('published_at')
                <span class="invalid-feedback">{{ $errors->first('published_at') }}</span>
                @enderror
            </div>
            @if (isset($post))
            <div class="form-group">
                <img src="{{$post->image }}" alt="Post image" style="width:100%">
            </div>
            @endif
            <div class="form-group">
                <label for="image" class="mt-3">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                    placeholder="" value="{{ isset($post) ? $post->image: '' }}">
                @error('image')
                <span class="invalid-feedback">{{ $errors->first('image') }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update Post': 'Create Post'}}</button>
        </form>
    </div>
</div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#published_at',{
        enableTime:true
    })
</script>

@endsection