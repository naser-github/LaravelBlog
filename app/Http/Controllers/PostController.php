<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    public function create(){

        $tags = Tag::all();

        return view ('post.create', compact('tags'));
    }

    public function store(Request $request){

        request()->validate([
            'title' => 'required|max:255',
            'post_body' => 'required|max:255',
            'category.*' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:1000'
        ],[
            'images.mimes' => 'must be a jpeg,png,jpg file',
            'images.max' => 'image size exceeded',
        ]);

        $title = $request->input('title');
        $post_body = $request->input('post_body');
        $categories = $request->input('category');

        $post = new Post;

        $post->post_title = $title;
        $post->post_body = $post_body;

        // $post->save();

        // foreach ($categories as $category){
        //     $tag = Tag::where('id',$category)->first();

        //     $post->tags()->attach($tag) ;
        // }

        // $post->users()->attach(Auth::user()->id);



        $images = $request->file('images');
        
        if(request()->hasFile('images')){

            $destinationPath = 'posts';

            foreach($images as $image){
            $ext = $image->getClientOriginalExtension();

            $file_name = uniqid().".".$ext;

            $image->move($destinationPath, $file_name);
            //$post->profile_image = $file_name;
            }
        }
    }
}
