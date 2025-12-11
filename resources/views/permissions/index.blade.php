{{-- {{dd($PermissionModel)}} --}}

{{-- <td>{{ $RoleList->id }}</td>
<td>{{ $RoleList->name }}</td> --}}
@extends('layouts.dashboard')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1>Permission Listing</h1>
                <p>Manage Permission</p>
            </div>
            <a href="{{ route('permission.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i>+ Add Permission
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PermissionModel as $PermissionList)
                            <tr>
                                <td>{{$PermissionList->id  }}</td>
                                <td class="fw-bold">{{$PermissionList->name }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('permissions.edit', ['id' => $PermissionList->id]) }}"
                                            class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('permissions.delete', ['id' => $PermissionList->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this Role?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
