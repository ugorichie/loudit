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

    public function create_loud(){
                // dump($_POST);
                // die();
                //$loud = $_POST['loud']; ---> this is to show that we can have POST request on laravel

                        //WAYS TO INSERT INTO THE DB

                        $data = request()->validate([
                    'loud' => 'required|max:300|min:1'

                ]);

                // now we have to catch the id of the person who is logged it, to also save it
                $data['user_id'] = auth()->user()->id; 

                //dd($data);
                //1. Using the MODEL way to insert into the DB --> App\model\loud
                $loud = new loud([
                    'loud' => $data['loud'],      // or request()->get('loud')
                    'user_id' => $data['user_id'],  //save the id of who is logged in, auth() helper function
                ]);

                $loud ->save(); 
                        //OR
                // $loud = loud::create([
                //     'loud' => $data['loud'],
                // ]);
                        //OR
                // Using the QUERY BUILDER METHOD -> support\facades\db
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

    //get louds from the database  1.
       public function get_all_louds(){
       // this is to filter the 'search' option in the dasboard
       $req =  request()->validate([
        'search' => 'nullable|max:50|min:1'
       ]);

       if($req){
        $loud = loud::orderBy('id', 'desc')->where('loud', 'like', '%'. $req['search'].'%' );
       }else{
        $loud = loud::orderBy('id', 'desc');
       }
        return view('home', ["louds" =>$loud->paginate(3)]);
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
        
        //this is to get a single loud but you would be joining tables with 'users' to get name of users
        //we cant use models for here because we are using DB facades
        $louds = DB::table('louds')->where('louds.id',$id)
                ->join('users', 'louds.user_id', '=', 'users.id')
                ->select('louds.*', 'users.name','users.username')
                ->get(); // this is to get a single loud using DB facades / QUERY BUILDER

        $comment = DB::table('comments')->where('loud_id',$id)
                    ->join('users', 'comments.user_id', '=', 'users.id')
                    ->select('comments.*', 'users.name', 'users.username')
                    ->get(); //this is to get comments on a loud using DB facades / QUERY BUILDERS

       return view('single',['louds'=>$louds, 'comments' =>$comment]);

                    //     or 
                    // via ELOQUENT MODEL

            //  return view('single',['louds'=>$id]); --> doesnt work yet


    }


    public function get_single_loud_edit($id){
        $editing = true;
        $louds = DB::table('louds')->where('louds.id',$id)
        ->join('users', 'louds.user_id', '=', 'users.id')
        ->select('louds.*', 'users.name', 'users.username')
        ->get();

        $comment = DB::table('comments')->where('loud_id',$id)
                    ->join('users', 'comments.user_id', '=', 'users.id')
                    ->select('comments.*', 'users.name', 'users.username')
                    ->get(); //this is to get comments on a loud using DB facades / QUERY BUILDERS

        return view('single',['louds'=>$louds,'editing' => $editing, 'comments' =>$comment]);
        
    }



    public function get_single_loud_update( $id){
        
        //VALIDATING THE INPUT VIA REQUEST() helper function
        $data = request()->validate([
            'loud' => 'required|max:300|min:1'
            
        ]);


        //USING QUERY BUILDER METHOD TO UPDATE.
        DB::table('louds')-> where('id',$id)->update([
                'loud' => $data['loud'],
            ]);

        //FETCH IT BACK FOR IT TO BE DISPLAYED
        $louds = DB::table('louds')->where('louds.id',$id)
        ->join('users', 'louds.user_id', '=', 'users.id')
        ->select('louds.*', 'users.name', 'users.userusername')
        ->get();

        // $comment = DB::table('comments')->where('loud_id',$id)->get(); //this is to get comments on a loud using DB facades / QUERY BUILDERS
        $comment = DB::table('comments')->where('loud_id',$id)
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->select('comments.*', 'users.name', 'users.username')
        ->get(); //this is to get comments on a loud using DB facades / QUERY BUILDERS
        
        return view('single', ['louds'=>$louds, 'comments' =>$comment])->with('success','that Loud has been updated successfully');
           
        }

       // $louds = DB::table('louds')->where('id',$id)->get();
        
    }



    



