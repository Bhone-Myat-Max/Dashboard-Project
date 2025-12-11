<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
       $PermissionModel = Permission::get();
     return view('permissions.index', compact('PermissionModel'));
    }

    #edit

    public function edit($id){
         $PermissionModel=Permission::find($id);
        return view('roles.edit', compact('PermissionModel'));
    }

   public function update(Request $request){

         $Validata= $request->validate([
            'name' => 'required',

        ]);

        $PermissionModel=Permission::find($Validata->id);
        $PermissionModel->update([
            'name'=>$request->name

        ]);

        return redirect()->route('permissions.index');
    }


    public function create(){
       return view('permissions.create');
    }
    public function store(Request $request){

        $Validata= $request->validate([
            'name' => 'required',

        ]);

      Permission::create($Validata);
     return redirect()->route('permissions.index');
    }

    public function delete($id){
        $PermissionModel = Permission::find($id);
        $PermissionModel->delete();

        return redirect()->route('permissions.index');
    }
}
