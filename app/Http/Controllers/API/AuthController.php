<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    public function login(Request $request)

   {
    dd($request->all());
     try {
        $credentials = $request->only(['email', 'password']);
        if (!JWTAuth::attempt($credentials)) {
            return $this->error("Your Email & Password is wrong!", null, 401);
        }

        $user = User::where('email', $credentials['email'])->first();

        $payload = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'status' => $user->status,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'address' => $user->address,
        ];
        $token = JWTAuth::customClaims($payload)->attempt(['email'=> $user->email, 'password'=>$credentials['password']]);

        return $this->success($token,"User Login Success", 200);

    } catch (Exception $e) {
         return $this->error("YSomething went wrong!", null, 500);
    }
   }
}
