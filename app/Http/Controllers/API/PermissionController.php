<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use App\Repositories\Permission\PermissionRepositoryInterface;

class PermissionController extends BaseController
{
    protected $permissionRepository;
    public function __construct(PermissionRepositoryInterface $permissionRepository){
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission=$this->permissionRepository->index();
        $result = PermissionResource::collection($permission);
        return $this->success($result, "Permission Data retrieve success", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Validata= $request->validate([
            'name' => 'required',

        ]);

        $permission = $this->permissionRepository->store($Validata);
        return $this->success($permission, "Permission Data Srore success", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission =$this->permissionRepository->show($id);
        $result = new PermissionResource($permission);
        return $this->success($result, "Permission Data retrieve success", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {



        $permission = $this->permissionRepository->show($id);
        // dd($permission);
        if (!$permission) {
            return $this->error("Permission not found", [], 404);
        }

        $Validata= $request->validate([
            'name' => 'required',

        ]);
        // if ($Validata->fails()) {
        //     return $this->error("Validation Error", $Validata->errors(), 422);
        // }

        $permission->update([

            'name'=>$request->name

        ]);


         return $this->success($permission, "Permission Data Update success", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $permission = $this->permissionRepository->show($id);
        if (!$permission) {
            return $this->error("Permission not found to delete", [], 404);
        }

        $permission->delete();

        return $this->success($permission, "Successfully Delete Permission Data", 200);
    }
}
