<?php

namespace App\Http\Controllers;

use App\Models\Comment;
//use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function add($id, Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'comment' => 'required|max:255'
        ]);

        if($validator->fails() ){
            return $validator->errors();
        }
        
        $body = $request->input('comment');

        $comment = new Comment;

        $comment->comment_body = $body;
        $comment->post_id = $id;
        $comment->user_id = Auth::user()->id;

        $comment->save();

        return redirect()->route('open_post', ['id' => $id]);


    }
}
