<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_gudavi;


class LoginController extends Controller
{

    public function login($email, $pass){

    $users=  User_gudavi::all();
    $confirm_email=false;
    $confrim_password=false;

  
        
    foreach ($users as $user) 
    {
        if($user->email === $email){
            $confirm_email=true;
            $id= $user->id;
            $users_pass=  User_gudavi::find($id);

            if($users_pass->password === $pass){
                $confirm_email=true;
                return response()->json([
                    'respuesta' => '1'
                ]);


                
            }else{
                return response()->json([
                    'respuesta' => '0'
                ]);
            }   
        }
        return response()->json([
                    'respuesta' => '3'
                ]);
       

    }

    }
}
