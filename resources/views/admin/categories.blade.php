@extends('admin.layout')

@section('body')

<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2 style="color: #ffffff;">Category Management</h2>
        </div>
        <div class="float-end">
            @can('add-category')
            <a class="btn btn-success" href="{{ url('categories/create') }}">Create New Category</a>
            @endcan
        </div>
    </div>
</div>



<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th style="color: #ffffff;">Name</th>
            <th style="color: #ffffff;">Description</th>
            <th style="color: #ffffff;" width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td style="color: #ffffff;">{{$loop->iteration}}</td>
            <td style="color: #ffffff;">{{ $category->name }}</td>
            <td style="color: #ffffff;">{{ $category->desc }}</td>

            <td>
                @can('edit-category') 
                <div style="display: inline-block; margin-right: 5px;">
                    <a class="btn btn-primary" href="{{ url("categories/edit/$category->id") }}">Edit</a>
                </div>
                @endcan

                @can('delete-category')
                <div style="display: inline-block;">
                    <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                @endcan

            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
{{$categories->links()}}

@endsection


