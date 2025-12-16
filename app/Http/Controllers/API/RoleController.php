<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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

    #store
    public function store(Request $request)
    {
        // $validator::make($request->all(),[

        // ]);
          $Validata= $request->validate([
            'name' => 'required',
            'permissions' =>'required',

        ]);
         $role=$this->roleRepository->store( [
            'name'=> $request->name,

        ]);
        $role->permissions()->sync($request->permissions);
        return $this->success($role, "Role data update Success...", 200);


    }

    #show
    public function show(string $id)
    {
        $role = $this->roleRepository->show($id);
        // if(!$id){
        //      throw new \Exception('There is no Role for this ID');
        // }
         return $this->success($role, "Role data Show Success...", 200);
    }

    #Update
    public function update(Request $request, string $id)
    {
        $role = $this->roleRepository->show($id);

        if(!$role) {
            return $this->error("Role not found to Update", [], 404);
        }

         $Validata= $request->validate([
            'name' => 'required',
            'permissions' =>'required',

        ]);

        $role->update([
            'name' => $request->name,
        ]);

         $role->syncPermissions($request->permissions);

         return $this->success($role, "Role data update Success...", 200);


    }

    #delete
    public function destroy(string $id)
    {
        $role = $this->roleRepository->show($id);

        if (!$role) {
            return $this->error("Role not found to delete", [], 404);
        }
        $role->delete();

        return $this->success($role, "Role data Successfully Delete", 200);

    }
}
