{{-- {{dd($RoleModel)}} --}}
{{-- <td>{{ $RoleList->id }}</td>
<td>{{ $RoleList->name }}</td> --}}
@extends('layouts.dashboard')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1>Role Listing</h1>
                <p>Manage Roles</p>
            </div>
            <a href="{{ route('roles.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i>+ Add Role
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
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($RoleModel as $RoleList)
                            {{-- {{ dd($RoleModel) }} --}}
                            <tr>
                                <td>{{ $RoleList['id'] }}</td>
                                <td class="fw-bold">{{ $RoleList['name'] }}</td>
                                <td class="fw-bold">

                                    @if ($RoleList['permissions']->count() > 0)

                                        <ul class="d-flex">
                                            @foreach ($RoleList['permissions'] as $permission)
                                                <li class="badge bg-success">{{ $permission->name }}</li>
                                            @endforeach
                                        </ul>

                                    @else
                                        <span class="text-danger">No Permissions</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('roles.edit', ['id' => $RoleList->id]) }}"
                                            class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('roles.delete', ['id' => $RoleList->id]) }}" method="POST">
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
