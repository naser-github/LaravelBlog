<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add($id, Request $request)
    {
        request()->validate([
            'comment' => 'required|max:255'
        ]);
        
        $body = $request->input('comment');

        $comment = new Comment;

        $comment->comment_body = $body;
        $comment->post_id = $id;
        $comment->user_id = Auth::user()->id;

        $comment->save();

        return back();


    }
}
