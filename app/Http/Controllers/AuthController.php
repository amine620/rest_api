<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $req)
    {
        // validate user information
         $req->validate([
             'name'=>'required',
             'email'=>'required|unique:users',
             'password' => 'required|min:8',
         ]);

        //  save user after validation
         $user=new User();
         $user->name=$req->name;
         $user->email=$req->email;
         $user->password = bcrypt($req->password);
         $user->save();

        //  create the token of user
         $token=$user->createToken("myToken")->plainTextToken;

        //  return user info with token to the frontend
         return response()->json([
             'user'=>$user,
             'token'=>$token,
         ]);
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

           return response()->json(['error'=>'error record']);
        }

        $token = $user->createToken("myToken")->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'logged out']);
    }
}
