@extends('admin.layout')

@section('body')

<div class="row">
    @if (session()->has("success"))
    <div class="alert alert-success">
        {{ session("success") }}
    </div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Error</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <li class="nav-item w-100">
                <form method="GET" action="{{ url('/searchUser') }}" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" name="key" class="form-control" placeholder="Search for a user by email">
                  <button class="btn btn-primary">Search</button>
                </form>
              </li>
            </div>
    </div>
</div>

@isset($users)
    
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="color: #ffffff;">Name</th>
            <th style="color: #ffffff;">Email</th>
            <th style="color: #ffffff;">Status</th>
            <th style="color: #ffffff;" width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td style="color: #ffffff;">{{ $user->name }}</td>
            <td style="color: #ffffff;">{{ $user->email }}</td>
            <td>
                @if ($user->status == 'active')
                <span class="label text-success d-flex">
                    <div class="dot-label bg-success ml-1"></div>{{ $user->status }}
                </span>
                @else
                <span class="label text-danger d-flex">
                    <div class="dot-label bg-danger ml-1"></div>{{ $user->status }}
                </span>
                @endif
            </td>


            <td>
                @can('changeUser-status') 
                <div style="display: inline-block; margin-right: 5px;">
                    <form method="POST" action="{{ url("users/change/$user->id") }}" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            @if ($user->status == 'active')
                                Deactivate
                            @else
                                Activate
                            @endif
                        </button>
                    </form>
                </div>
                @endcan

                @can('delete-user')
                <div style="display: inline-block;">
                    <form action="{{ route('users.delete', $user->id) }}" method="POST">
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
@endisset    

@endsection


