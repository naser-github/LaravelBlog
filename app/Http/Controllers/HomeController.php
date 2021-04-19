<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();

        return view('home',compact('posts'));
    }

    public function search(Request $request){
        
        $search = $request->input('searching');
        
        $result = Post::where('post_body', $search)->orWhere('post_title', 'like', '%' .$search. '%')->get();

        if( is_null($result) ){
            return view ('search.result', compact('result'));
        }else{
            $result = Tag::where('tag_type', $search)->orWhere('tag_type', 'like', '%' .$search. '%')->get();
            
            if( is_null($result) ){
                return view ('search.result', compact('result'));
            }else{
                $result = "No Result Found";
                
                return view ('search.result', compact('result'));
            }
        }

        
    }
}
 