<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
    
    /*function send()
    {
        $url = "http://66.45.237.70/api.php";
        $number="01623388861";
        $text="Hello Bangladesh";
        $data= array(
            'username'=>"01304962073",
            'password'=>"KXHDFZB4",
            'number'=>"$number",
            'message'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
    }*/
    
    
    
    
    public function insert(Request $request){
       $a = rand(1,10000); 
      $name = $request->$a;
        $name1 = $request->$a;
      DB::insert('insert into otp (phone,code) values(?,?)',[$name,$name1]);
      echo "Record inserted successfully.<br/>";
      echo '<a href = "/insert">Click Here</a> to go back.';
        }
}
