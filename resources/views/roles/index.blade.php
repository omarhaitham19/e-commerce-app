@extends('admin.layout')

@section('body')
<div class="row">
    @if (session()->has("success"))
    <div class="alert alert-success">
        {{ session("success") }}
    </div>
@endif
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2 style="color: #ffffff;">Role Management</h2>
        </div>
        <div class="float-end">
            @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th style="color: #ffffff;">Name</th>
            <th style="color: #ffffff;" width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $key => $role)
        <tr>
            <td style="color: #ffffff;">{{$loop->iteration}}</td>
            <td style="color: #ffffff;">{{ $role->name }}</td>
            <td>
                <div style="display: inline-block; margin-right: 5px;">
                    @can('role-show')                       
                    <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                    @endcan
                </div>
                <div style="display: inline-block; margin-right: 5px;">
                    @can('role-edit')
                    <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    @endcan
                </div>
                <div style="display: inline-block;">
                    @can('role-delete')
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endcan               
                </div>
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>

{!! $roles->render() !!}
@endsection
