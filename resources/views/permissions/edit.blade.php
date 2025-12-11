{{-- {{dd($PermissionModel)}} --}}




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
            <form action="{{ route('permissions.update', [$PermissionModel->id]) }}" method="POST">
                @csrf
                  {{-- @method('PUT') --}}
                <div class="card-body">
                    <label for="name" class="form-input-label mb-2">Permission Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $PermissionModel->name }}" name="name" />
                    @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
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
