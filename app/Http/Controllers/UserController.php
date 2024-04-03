<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    //
    public function create_user(){
        $validation =  request()->validate([
            'fullname' => 'required|min:3',
            'username' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
           
        ]);
        
        $username = $validation['username'];
        $letter = '@';
        $usernamed = '';
        if(strpos($username,$letter) !== 0){ //this is to check the username to be sure @ exists, if not, add it
            $usernamed = '@'.$username;
        }else{
            $usernamed = $username;
        }
        
        $data = User::create([
            'name' => $validation['fullname'],
            'username' => $usernamed,
            'email' => $validation['email'],
            'password' => Hash::make($validation['password']),
        ]);

        return redirect()->route('user.loginpage')->with('success', 'account created successfully, kindly log in with your details');
    }


    

    //login function
    public function login_user(){
        $validation =  request()->validate([

        ]);
    }
    
}
