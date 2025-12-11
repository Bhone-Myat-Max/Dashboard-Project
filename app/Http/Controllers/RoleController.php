<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $RoleModel=Role::with('permissions')->get();
        return view('roles.index', compact('RoleModel'));
    }

    #edit
    public function edit($id){
        $permission=Permission::get();
        $RoleModel=Role::with('permissions')->find($id);
        return view('roles.edit', compact('RoleModel','permission'));
    }

    #create
     public function create(){
        $PermissionModel=Permission::get();
       return view('roles.create', compact('PermissionModel'));
    }

     #store

     public function store(Request $request){

        // dd($request->all());

        $Validata= $request->validate([
            'name' => 'required',


        ]);

        $role=Role::Create( [
            'name'=> $request->name,

        ]);
        $role->permissions()->sync($request->permission);
        return redirect()->route('roles.index');


    }

    # update
      public function update(Request $request, $id){

        dd($request->all());

        $RoleModel=Role::find($request->id);
        $RoleModel->update([
            'name'=>$request->name,
        ]);

        $permissions = $request->permission ?? [];
        $RoleModel->syncPermissions($permissions);

        // $role = Role::find($id);
        // // dd($role);
        // $role->update(['name' => $request['name']]);

        // if (isset($request['permissions'])) {
        //     $permissions = Permission::whereIn('id', $request['permissions'])->get();
        //     $role->syncPermissions($permissions);
        // }else{
        //     $role->syncPermissions([]);
        // }

        return redirect()->route('roles.index');
    }

    # delete
    public function delete($id){
        $RoleModel=Role::find($id);
        $RoleModel->delete();
        return redirect()->route('roles.index');
    }
}
