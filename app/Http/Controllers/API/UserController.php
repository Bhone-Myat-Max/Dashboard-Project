<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends BaseController
{

      protected $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
        {
            $this->UserRepository = $UserRepository;
        }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =$this->UserRepository->index();
        return $this->success($user, "User Data retrieve success", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $Validata= $request->validate([
            'name' => 'required',
            'email' =>'required',
            'address' =>'required',
            'phone' =>'required',
            'gender' =>'required',
            'password' => 'required|min:6',

        ]);
            $Validata['password'] = bcrypt($Validata['password']);

        if ($Validata->fails()) {
            return $this->error("Validation Error", $Validata->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('productImages'), $imageName);

        }

        $Validata['status'] = $request->has('status') ? true : false;

        $user =$this->UserRepository->store([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'status' => $request->status,
            'password' => $request->password,
            'image' => $imageName,

        ]);

        $user->assignRole($request->roles);
        // dd($user->all());

        return $this->success($user, "User Data Store success", 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user =$this->UserRepository->show($id);
        return $this->success($user, "User Data show success", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

         $Validata= $request->validate([
            'name' => 'required',
            'email' =>'required',
            'address' =>'required',
            'phone' =>'required',
            'gender' =>'required',
            'password' => 'required|min:6',

        ]);
            $Validata['password'] = bcrypt($Validata['password']);

        // if ($Validata->fails()) {
        //     return $this->error("Validation Error", $Validata->errors(), 422);
        // }

        $UserModel = $this->UserRepository->show($id);
        $UserModel->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            'gender'=> $request->gender,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'status'=> $request->has('status') ? true : false,
        ]);

         if (isset($UserModel['password'])) {
            $UserModel['password'] = bcrypt($UserModel['password']);
        }

        $UserModel->syncRoles($request->role);
        return $this->success($UserModel, "User Data update success", 200);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user =$this->UserRepository->show($id);
        if(!$user){

            return $this->error("User not found to delete", [], 404);

        }
        $user->delete();
        return $this->success($user, "User Data delete success", 200);
    }
}
