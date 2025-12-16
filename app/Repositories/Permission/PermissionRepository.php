<?php

namespace App\Repositories\Permission;

use Spatie\Permission\Models\Permission;
use App\Repositories\Permission\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function index()
    {
        return Permission::get();
    }

     public function store($Validata)
    {

        return Permission::create($Validata);
    }

    public function show($id)
    {
        return Permission::find($id);
    }
}
