<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function create_user(){
        $validation =  request()->validate([
            'fullname' => 'required|min:3',
            'username' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmation',
           
        ]);
        $data = User::create([
            'fullname' => $validation['fullname'],
            'username' => $validation['username'],
            'email' => $validation['email'],
            'password' => Hash::make($validation['password']),
        ]);

        return view('login')->with('success', 'account created successfully, kindly log in with your details');
    }
    
}
