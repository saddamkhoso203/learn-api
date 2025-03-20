<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    function login(Request $request){
        $user = User::where("email",$request-> email)->first();
      if(!$user ||  !Hash::check($request->password,$user->password)){
        return ['result'=> "user not found","success"=>false];
      }
      $success['token']=$user->createToken("My App")->plainTextToken;
      $success['name']=$user->name;
      return['success'=>"true", 'result'=>$success, "message"=>"User created Successfully" ];
    }


    
    function signup(Request $request){
 
        $input=$request->all();
       
        $request['password']=bcrypt($request['passsword']);
        $user=User::create($input);
        $success['token']=$user->createToken("My App")->plainTextToken;
        $success['name']=$user->name;
        return['success'=>"true", 'result'=>$success, "message"=>"User created Successfully" ];
    }
    }

