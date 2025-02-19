<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    //
     function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return ['result'=>"user not found", "success"=>false];
        }
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;
        return ['result'=>$success,'msg'=>"user register successfully"];
    }


    function signup(Request $request){
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $succes['token'] = $user->createToken('myApp')->plainTextToken;
        $user['name']= $user->name;
        return ['succes'=>true, "result"=>$succes, "msg"=>"user register successfully "];
    }
}