@extends('admin.layout')

@section('body')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>Show Role</h2>
        </div>
        <div class="float-end">
            <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 mb-3">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 mb-3">
        <div class="form-group">
            <strong>Permissions:</strong>
            <div>
                @if (!empty($rolePermissions))
                @foreach ($rolePermissions as $v)
                <span class="badge bg-secondary text-light">{{ $v->name }}</span>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
