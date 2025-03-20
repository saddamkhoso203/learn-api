<?php

namespace App\Http\Controllers;

use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function list()
    {
        return User::all();
    }
    function AddUser(Request $request)
    {

        $rule = array(
            "name" => "required |min:2 |max:20",
            "email" => "required |email",
            "password" => "required |min:8 |max:20",
        );
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return $validator->errors();
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            if ($user->save()) {
                return ['result' => 'user added'];
            } else {
                return ['result' => 'user  didnt added'];
            }
        }
    }


    function UpdateUser(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        //   $user->password = $request->password;
        if ($user->save) {
            return ['result' => 'user updated'];
        } else {
            return ['result' => 'user not updated'];
        }
    }




    function DeleteUser($id)
    {



        $user = User::destroy($id);
        if ($user) {
            return ['result' => 'user deleted'];

        } else {
            return ['result' => 'user not deleted'];
        }
    }

    function SearchUser($name)
    {
        $user = User::where("name", "Like", "%$name%")->get();
        if ($user) {
            return ['result' => $user];

        } else {
            return ['result' => 'no record founded'];
        }

    }

}

