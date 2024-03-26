<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\loud;

class dashboard extends Controller
{
    
    // another way to seed into DB using MODEls
    public function index(){
        // $loud = new loud([
        //     'loud' => 'as it should be',
        //     'likes' => 2,
        // ]);

        // $loud -> save();
        // return view('home');
    }
}
