{{-- {{dd($RoleModel)}} --}}
{{-- {{dd($permission)}} --}}




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

                <p>Edit Roles</p>
            </div>
            {{-- <a href="{{ route('categories.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i>+ Add Role
            </a> --}}




        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('roles.update', [$RoleModel->id]) }}" method="POST">
                @csrf
                    {{-- <input type="hidden" name="id" value="{{ $RoleModel->id }}"> --}}

                {{-- @method('PUT') --}}
                <div class="card-body">
                    <label for="name" class="form-input-label mb-2">Role Name:</label>
                    <input type="text" class="form-control" value="{{ $RoleModel->name }}" name="name" />
                    {{-- @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror --}}
                </div>

                {{-- Permission --}}
                <label class="form-label">Permissions <span class="text-muted">(Optional)</span></label>
                <div class="border rounded p-3" style="max-height: 400px; overflow-y: auto;">
                    @foreach ($permission as $permission_list)
                        <div class="form-check mb-2">
                            <input type="checkbox" name="permission[]" class="form-check-input" value="{{ $permission_list->id }}"
                                {{ $RoleModel->permissions->contains($permission_list->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="">
                                {{ $permission_list->name }}
                            </label>
                        </div>
                    @endforeach


                    {{-- @forelse ($permissions as $permission)
                        <div class="form-check mb-2">

                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No permissions available.
                            <a href="{{ route('permissions.create') }}">Create a permission first</a>.
                        </p>
                    @endforelse --}}
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-primary btn-sm me-2" type="submit">Update</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm"> Back </a>
                </div>
            </form>
        </div>
    </div>
@endsection














{{--


<form action="{{ route('categories.update', [$category->id]) }}" method="POST">
                @csrf
                <div class="card-body">
                    <label for="name" class="form-input-label mb-2">Category Name:</label>
                    <input type="text" class="form-control" value="{{ $category->name }}" name="name" />
                    @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="card-body">
                    <label for="image" class="form-input-label mb-2">Category Image:</label>
                    <img src="{{ asset('categoryImages/' . $category->image) }}" alt="{{ $category->image }}"
                        style="width: 100px; height: auto;">

                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-primary btn-sm me-2" type="submit">Update</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm"> Back </a>
                </div>
            </form> --}}
