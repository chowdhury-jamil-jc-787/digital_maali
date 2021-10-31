<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Messages extends Controller
{
    function list()
    {
       $data = Http::get('https://api.genderize.io?name=luc')->json();
        //return view('home',['data'=>$data]);
        
        $a = rand(1,10000);
        //{{$data['gender']}}
        
        
        return response()->json([
                    'Messages' =>"skyflora registration code is:".$a.' '.$data['gender'],
                    //'Code' => $a,
                    //'app_signature_code' =>$data['gender'],
                ]);
    }
}
