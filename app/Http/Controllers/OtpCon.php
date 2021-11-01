<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otp;

class OtpCon extends Controller
{
    public function check(Request $request){
        $phone = $request->phone;
        $code = $request->code;
        $memberExists = Otp::where('phone', '=', $phone)->first();
        //$otp = Otp::where('code', '=', $code)->first();

        $y = Otp::where('phone', $phone)->value('code');



       
            if ($y === $code) {
               return 11;
                
            }
                else{
                    return response()->json([
                        'code'=>400/500,
                        'message'=>'Otp is wrong',
                    ]);
                    
                }
    
        }
       
    }
