@extends('layouts.dashboard')
@section('page')
<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h4>Posts</h4>
            </div>
            <div class="col">
                <a class="btn btn-success float-right" href="{{ route('posts.create')}}">Add Post</a>
            </div>
        </div>
    </div>
    <div class="card-body">


        @if (count($posts) === 0)
        <h3>No Post Found</h3>
        @else
        <table class="table table-hover">
            <thead>
                <th>Title</th>
                <th>Published</th>
                <th>Created</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->published_at }}</td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td class="float-right">
                        @if ($post->trashed())
                        <form action="{{ route('posts.restore', $post->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-info float-right text-white">Restore</button>
                        </form>

                        @else
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info float-right">Edit</a>
                        @endif

                        <form action="{{ route('posts.destroy', $post->id)}}" method="post" class="inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-sm btn-danger">{{ $post->trashed() ? 'Delete': 'Trash'}}</button>
                        </form>

                    </td>
                    <td>

                    </td>
                </tr>
                @endforeach
                <tr>

                </tr>
            </tbody>
        </table>
        @endif

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="post" id="deletePostForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">
                                Are you sure you want to delete this?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                            <button type="submit" class="btn btn-danger">Yes,
                                Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function deleteCategory(id){
        let form = document.getElementById('deletePostForm');
        form.action = '/categories/'+ id;
        $('#deleteModal').modal('show');
    }
</script>

@endsection