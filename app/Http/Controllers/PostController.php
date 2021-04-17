<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;

class PostController extends Controller
{
    public function create($id){

        $tags = Tag::all();
        
        return view ('post.create', compact('tags','id'));
    }
}
