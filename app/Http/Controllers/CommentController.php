<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;
use Illuminate\Support\facades\db;

class CommentController extends Controller
{
    //comment place

    public function create_comment($id){
        $comment = request()->validate([
            'comment' => 'required|min:1' 
        ]);

        $comment['user_id'] = auth()->user()->id;


        $submit = comment::create([
            'loud_id' => $id,
            'comments' => $comment['comment'],
            'user_id' => $comment['user_id'],
        ]); 

        return redirect(route('loud.show',$id ))->with('success', 'we see your comment on that Loud!');
    }

    // public function get_comments($id){
    //     $comment = DB::table('comments')->where('loud_id', $id)->get();

    //     return view('single', ['comment' => $comment]);
    // }
}
