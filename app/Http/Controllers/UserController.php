<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller

{

    protected $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
        {
            $this->UserRepository = $UserRepository;
        }

    public function index()
    {
        $users =  $this->UserRepository->index();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('productImages'), $imageName);

            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $validatedData['status'] = $request->has('status') ? true : false;

        // Hash password if it exists
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $this->UserRepository-> store($validatedData);

        return redirect()->route('users.index');

    }

    # edit function
     public function edit($id){
        $users = $this->UserRepository->show($id);

        return view('users.edit', compact('users'));
     }


     # Update function
     public function update(Request $request){

        // dd($request->all());
        $UserModel = $this->UserRepository->show($request->id);
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
        return redirect()->route('users.index');
    }

    # Delete function
     public function delete($id) {
            $UserModel = $this->UserRepository->show($id);
            $UserModel->delete();

            return redirect()->route('users.index');

        }

    # Show function
     public function detail($id){
        
        $users = $this->UserRepository->show($id);

        return view('users.show', compact('users'));
     }





}
