<?php

namespace App\Repositories\Role;

use Spatie\Permission\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function index()
    {
        return Role::with('permissions')->get();
    }

    // {
    // public function store($data)
    //     return Product::create($data);
    // }

    public function show($id)
    {
        return Product::find($id);
    }
}
