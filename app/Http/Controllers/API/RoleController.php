<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleController extends BaseController
{

    protected $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository){
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = $this->roleRepository->index();
        return $this->success($role, "Role data retrieve Success...", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = $this->roleRepository->show($id);
         return $this->success($role, "Role data Show Success...", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
