<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use App\Models\loud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redis;

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

                return redirect()->route('loud.index')-> with('success', 'YES O! that your idea was LOUD');
            }else{
                return redirect()->route('loud.index')-> with('success', 'sorry, Idea not LOUD ENOUGH');
            }

    }

    //get louds from the database
    public function get_all_louds(){
       // $loud = loud::all();
       
        return view('home', ["louds" => loud::orderBy('id', 'desc')->paginate(3)]);
        //orderBy is a function to order results, works on eloquent models, but not collections ##readUp
        //paginate() function is to sectionalize the results 
    }


    public function delete_loud(loud $id){
        // $loud = loud::where('id',$id)->firstOrfail();
        // // dump($loud );
        // // die();
        // $loud->delete();
        $id->delete();

        return redirect()->route('loud.index')-> with('success', 'that idea! not LOUD anymore');

    }

    public function get_single_loud($id){
        $louds = DB::table('louds')->where('id',$id)->get();
        return view('single',['louds'=>$louds]);
        

                    //     or 
                    // via ELOQUENT MODEL

            //  return view('single',['louds'=>$id]); --> doesnt work yet

    }

    


}
