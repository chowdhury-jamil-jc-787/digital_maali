<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otp;


class SignatureController extends Controller
{
     public function signature(Request $request){
        try{
            
             $request->validate([
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'app_signature_code'=>'required',
            ]);
            $credentials = request(['phone','signature']);
            
            
            
             
                return response()->json([
                    'code'=>200,
                    'success_message'=>'Requested for OTP',
                    'otp_message'=>'generated otp text(generated from server)',
                    
                        'user_data'=>[
    
                            'phone' =>$request->phone,
                            
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
