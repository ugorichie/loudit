<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use App\Models\loud;

class loudController extends Controller
{
    //

    public function create_loud(Request $request){
                // dump($_POST);
                // die();
                //$loud = $_POST['loud']; ---> this is to show that we can have POST request on laravel

                        //WAYS TO INSERT INTO THE DB

                        $data = $request->validate([
                    'loud' => 'required|max:300|min:1'

                ]);

                //1. Using the MODEL way to insert into the DB --> App\model\loud
                $loud = new loud([
                    'loud' => $data['loud']      // or request()->get('loud')
                ]);
                $loud ->save(); 
                        //OR
                // $loud = loud::create([
                //     'loud' => $data['loud'],
                // ]);
                        //OR
                // Using the QUERY STRING METHOD -> support\facades\db
                    // $submit = DB::table('louds')->insert([
                    //     'loud' => $data['loud'],
                    //    // 'likes' => 3
                    // ]);

                  //  return view('home');
            if($loud){

                return redirect()->route('home')-> with('success', 'Loud was created successfully');
            }else{
                return view('home');
            }

    }
}
