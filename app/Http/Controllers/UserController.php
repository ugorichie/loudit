<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Db;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Db;
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

    public function update_user(user $user){
        $validation = request()->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'about' => 'nullable|max:1999',
            'image' => 'image|nullable'
        ]);

        if(isset($validation['image'])){
        // GIVE THE IMAGE A UNIQUE NAME 
            //  $temp = explode( '.' , $_FILES['image']['name']);
            //  $image = round(microtime(true)).'.'.end($temp);   ----> Instead of doing this // we do the below
           

            $temp = request()->file('image')->getClientOriginalExtension();  //this will tell you the picture extention
            $newFileName = round(microtime(true)).'.'.$temp; //this will then rename the pic to something unique
            $validation['image'] = $newFileName;
           
            $imagePath = request()->file('image')->storeAs('public',$newFileName); //save the pic in laravels defined folder

            Storage::disk('public')->delete( $user->image); //this is to delete previous image before uploading new one
            
        }

        $user->update($validation);

        return view('users.show', compact('user'));

    }

    public function getImage( $user){

        $user = DB::table('users')->where('id', $user)->select('image','name')->get();

        if($user !== null){
            return 'storage/' . $user->image;
        }else{
            return "https://api.dicebear.com/6.x/fun-emoji/svg?seed=$user->name";
                
        }
    }
}
