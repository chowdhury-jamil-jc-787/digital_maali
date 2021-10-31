<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class loginController extends Controller
{
    public function login(Request $request){
        try{
            $request->validate([
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'password'=>'required',
            ]);
            $credentials = request(['phone','password']);
            
            if(!Auth::attempt($credentials)){
                return response()->json([
                    'status_code' =>422,
                    'message' => 'Unathorized',
                ]);
            }
            
            $user = User::where ('phone',$request['phone'])->firstOrFail();
            
            if(!Hash::check($request->password, $user->password,[])){
                return response()->json([
                    'code'=>200,
                    'Message'=>'Successfully Logged In',
                ]);
            }
            $tokenResult = $user->createToken('authToken')->plainTextToken;
             return response()->json([
                    'code'=>200,
                    'Message'=>'Successfully Logged In',
                    'data'=>[
                        'token'=>$tokenResult,
                        'user_data'=>[
                            'id' => Auth::user()->id,
                            'user_name' => Auth::user()->name,
                            'email' => Auth::user()->email,
                            'phone' => Auth::user()->phone,
                            'joining_date' => Auth::user()->created_at,
                        ]
                        
                    ]
                    
                    
                ]);
        }Catch(Exception $error){
              return response()->json([
                'code'=>400/500,
                'message'=>'Login Failed',
                'error'=>$error,
                
            ]);
        }
    }
}
