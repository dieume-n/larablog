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
        @if (count($categories) === 0)
        <h3>No Category Found</h3>
        @else
        <table class="table">
            <thead>
                <th>Category Name</th>
                <th>Post count</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{$category->posts->count()}}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm"
                            onclick="deleteCategory({{ $category->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="post" id="deleteCategoryForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
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
        let form = document.getElementById('deleteCategoryForm');
        form.action = '/categories/'+ id;
        $('#deleteModal').modal('show');
    }
</script>

@endsection