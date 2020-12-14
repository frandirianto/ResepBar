<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(Request $request){      
        $request = $request->data;
        
        $user = new User([
            'name' => $request["fullname"],
            'username' => $request{"username"},
            'email' => $request["email"],
            'password' => bcrypt($request["password"])
        ]);

        $user->save();
        
        return response()->json([
            'message' => 'Successfully Registered Account'
        ], 201);
    }

    public function login(Request $request){
        
        $credentials = [
            'email' => $request->data['email'],
            'password' => $request->data['password'],
        ];
        
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        
        else if(Auth::attempt($credentials)){
            $user = Auth::user();
            
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
    }
  
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully Logged Out'
        ]);
    }
  
    public function user(Request $request){
        $data = new UserResource($request->user());
        return response()->json(['data'=>$data],201);
    }
}
