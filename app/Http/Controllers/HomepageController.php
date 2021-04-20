<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function home(){

        $posts = Post::orderBy('id','Desc')->get();
        
        return view ('before_login.homepage', compact('posts'));
    }

    public function show(){
        
        
    }
}
