<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class registerController extends Controller
{
    public function register(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'name'=>'required|string|max:255',
                'email'=>'required|string|email|max:255|unique:users',
                'phone'=>'required|string|max:255|unique:users',
                'password'=>'required|string|min:6|confirmed',
                
                
            ]);
            if($validator->fails()){
                return response([
                    'error' => $validator->errors()->all()
                            ],422);
            }
                



            $phone = $request->phone;
            $code = $request->code;
            $memberExists = Otp::where('phone', '=', $phone)->first();
            //$otp = Otp::where('code', '=', $code)->first();
    
            $y = Otp::where('phone', $phone)->value('code');
    
    
    
           
                if ($y === $code) {
            $request['password']=Hash::make($request['password']);
            $request['remember_token']=Str::random(10);
            $user = User::create($request->toArray());
            
            return response()->json([
                'code'=>200,
                'message'=>'Requested for OTP',
            ]);
            
                    
                }
                    else{
                        return response()->json([
                            'code'=>400/500,
                            'message'=>'Otp is wrong',
                        ]);
                        
                    }












           
            
            
            }
        catch(Exception $error){
            return response()->json([
                'code'=>400/500,
                'message'=>'Failed',
                'error'=>$error,
            ]);
        }
        }
    }

