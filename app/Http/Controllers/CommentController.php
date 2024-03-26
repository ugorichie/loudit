<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;

class CommentController extends Controller
{
    //comment place

    public function create_comment($id){
        $comment = request()->validate([
            'comment' => 'required|min:1' 
        ]);

        $submit = comment::create([
            'loud_id' => $id,
            'comments' => $comment['comment'],
        ]); 

        return redirect(route('loud.show',$id ))->with('success', 'we see your comment on that Loud!');
    }
}
