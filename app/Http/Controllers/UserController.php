<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PharIo\Manifest\Email;

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

        return redirect()->route('login')->with('success', 'account created successfully, kindly log in with your details');
    }


    

    //login function
    public function login_user(){

        //dd(request()->all());
        $validation =  request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       if( auth()->attempt( $validation )){

        request()->session()->regenerate();
      return  redirect()->route('loud.index')->with('success', 'You now have access to your account');
       }

       return redirect()->route('login')->withErrors([
        'email' => 'either email or password was incorrect'
       ]);
    }


    public function logout_user(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerate();

        return redirect()->route('login')->with('success', 'You have been logged out');
    }
    
    public function show_users(){
        $user =  user::all();

        return view('includes.searchbar', compact('user'));
    }


    public function show_user(user $user){

        return view('users.show', compact('user'));
    }

    public function edit_user(user $user){
        $editing = true;

        return view('users.show', compact('user', 'editing'));

    }
}
