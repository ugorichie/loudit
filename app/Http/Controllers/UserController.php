<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create_user(){
        request()->validate([
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
           
        ]);
    }
    
}
