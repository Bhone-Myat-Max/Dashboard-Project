@extends('layouts.dashboard')
{{-- {{dd($users)}} --}}
@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1>Users Listing</h1>
                <p>Manage system users</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Create User
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="fw-bold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td>{{ $user->address ?? '-' }}</td>
                                <td>{{ $user->roles->first() ? $user->roles->first()->name : '-' }}</td>
                                <td>{{ $user->gender ?? '-' }}</td>
                                <td>
                                    @if ($user->status === 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('users.detail', ['id'=> $user->id])}}"  class="btn btn-sm btn-outline-secondary me-3">
                                        View
                                    </a>
                                    <a href="{{ route('users.edit' , ['id'=> $user->id] )}}" class="btn btn-success btn-sm me-3">
                                        Edit
                                    </a>
                                    {{-- Delete button --}}
                                    <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
