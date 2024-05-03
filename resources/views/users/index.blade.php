@extends('admin.layout')

@section('body')

<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
           
            <div class="row">
                @if (session()->has("success"))
                <div class="alert alert-success">
                    {{ session("success") }}
                </div>
            @endif
                <div class="col-lg-12 margin-tb mb-4">
                    <div class="pull-left">
                        <h2>Admin Management
                            <div class="float-end">
                                @can('add-admins')
                                    <a class="btn btn-success" href="{{ route('users.create') }}"> Add New Admin</a>
                                @endcan
                            </div>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style="text-align: center;">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Name </th>
                                <th class="wd-20p border-bottom-0">Email </th>
                                <th class="wd-15p border-bottom-0">Status </th>
                                <th class="wd-15p border-bottom-0">Role </th>
                                <th class="wd-10p border-bottom-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
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
                                    @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                    @endif
                                </td>

                                <td>
                                    @can('edit-admins')                                        
                                    <div style="display: inline-block; margin-right: 5px;">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info" title="Edit">
                                            <i class="las la-pen"></i>Edit
                                        </a>
                                    </div>
                                    @endcan

                                    @can('delete-admins')
                                        
                                    <div style="display: inline-block;">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="las la-trash"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                    @endcan
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
