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
    public function index(){
        
        $posts = Post::orderBy('id','Desc')->paginate(7);
        
        return view('home',compact('posts'));
    }

    public function search(Request $request){
        
        $search = $request->input('searching');
        
        $result = Post::where('post_body', $search)->orWhere('post_title', 'like', '%' .$search. '%')->orderBy('id','Desc')->get();
        
        if( !empty($result[0]) ){
            return view ('search.result', compact('result'));
        }else{
            // $result = Tag::where('tag_type', $search)->orWhere('tag_type', 'like', '%' .$search. '%')->orderBy('id','Desc')->get();
            
            // if( !empty($result[0]) ){
            //     return view ('search.result', compact('result'));
            // }else{
                $result = "No Result Found";
                
                return view ('search.result', compact('result'));
            // }
        }        
    }

    public function show($id){
        
        return redirect()->route('open_post', ['id' => $id]);
    }
}
 