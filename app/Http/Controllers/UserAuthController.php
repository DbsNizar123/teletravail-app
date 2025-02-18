<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    //
    function login(Request $request){
        return "login function";
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
