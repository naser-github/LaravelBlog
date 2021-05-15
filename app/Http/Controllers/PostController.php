<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostPhoto;
use App\Models\Like;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Response;

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
            'category.*' => 'required|exists:tags,id',
            'images' => '',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:1000',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:1000',
        ],[
            'images.*.required' => 'Please Upload an image',
            'images.mimes' => 'must be a jpeg,png,jpg file',
            'images.max' => 'image size exceeded',
        ]);

        $title = $request->input('title');
        $post_body = $request->input('post_body');
        $categories = $request->input('category');
        $thumbnail = $request->file('thumbnail');
        
        $post = new Post;

        $post->post_title = $title;
        $post->post_body = $post_body;

        if(!empty($thumbnail)){
            $destinationPath = 'posts';
            
            $ext = $thumbnail->getClientOriginalExtension();

            $file_name = uniqid().".".$ext;

            $thumbnail->move($destinationPath, $file_name);
            $post->thumbnail = $file_name;
        }

        $post->save();

        foreach ($categories as $category){
            $tag = Tag::where('id',$category)->first();

            $post->tags()->attach($tag) ;
        }

        $post->users()->attach(Auth::user()->id);

        $photo = new PostPhoto;

        $images = $request->file('images');

        if(request()->hasFile('images')){

            $destinationPath = 'posts';

            foreach($images as $image){
            $ext = $image->getClientOriginalExtension();

            $file_name = uniqid().".".$ext;

            $image->move($destinationPath, $file_name);
            $post->postphotos()->create([
                'photo_name' => $file_name
            ]);

            }
        }

        return redirect()->route('show_post')->with('success','Post Created Successfully');
    }

    public function show(){

        $posts = Post::orderBy('id','Desc')->get();
        // $posts = Post::paginate(2);
        return view ('post.show', compact('posts'));
    }

    public function open($id){

        $post = Post::where('id',$id)->first();

        $tags = Tag::all();

        $comments = Comment::where('post_id',$id)->get();

        return view('post.open', compact('post','tags', 'comments'));
    }

    public function edit($id){

        $post = Post::where('id',$id)->first();
        
        $selected_tags = $post->tags()->pluck('tag_id');
    
        $tags = Tag::all();

        return view('post.edit', compact('post','tags','selected_tags'));
    }

    public function update($id, Request $request){

        request()->validate([
            'title' => 'required|max:255',
            'post_body' => 'required|max:255',
            'category.*' => 'required|exists:tags,id',
            // 'images.*' => 'image|mimes:jpeg,png,jpg|max:1000'
        ],[
            // 'images.mimes' => 'must be a jpeg,png,jpg file',
            // 'images.max' => 'image size exceeded',
        ]);

        $title = $request->input('title');
        $post_body = $request->input('post_body');
        $categories = $request->input('category');


        $post = Post::where('id',$id)->first();

        $post->post_title = $title;
        $post->post_body = $post_body;

        if(request()->hasFile('thumbnail')){

            request()->validate([
                'thumbnail' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            $thumbnail = $request->file('thumbnail');

            if(Storage::exists("posts/$post->thumbnail")){
                Storage::delete("posts/$post->thumbnail");
            }

            $destinationPath = 'posts';
            
            $ext = $thumbnail->getClientOriginalExtension();

            $file_name = uniqid().".".$ext;

            $thumbnail->move($destinationPath, $file_name);
            $post->thumbnail = $file_name;
        }


        $post->save();
        
        $post->tags()->sync($categories);
        return redirect()->route('open_post', ['id' => $id]);
    }

    public function delete($id){

        $post = Post::where('id',$id)->first();

        $users = $post->users;
        $post->users()->detach($users);

        $tags = $post->tags;
        $post->tags()->detach($tags);

        $photos = PostPhoto::where([
            ['posted_photo_id',$id],
            ['posted_photo_type','App\Models\Post']
        ])->get();
        
        if($photos){
            $photos->each->delete();
        }

        $comments = Comment::where('post_id',$id)->get();

        if($comments){
            $comments->each->delete();
        }

        if($post){
            $post->delete();
        }

        return redirect('/post/show');
    }

    public function like($id){
        
        $post = Post::where('id',$id)->first();
        
        $exist = $post->PostLike()->where('user_id',Auth::user()->id)->first();

        if(!empty($exist)){

            $exist->delete();

        }else{
            $post->PostLike()->create([
                'user_id' => Auth::user()->id
            ]);
        }

        return back();
    } 

    public function share($id, Request $request){
        
        $post = Post::whereId($id)->first();
        
        if(!empty($post)){
            $shared_email = $request->input('email');

            $user = User::whereEmail($shared_email)->first();
            
            if(!empty($user)){
                
                $post->users()->attach($user->id);
                
                return back()->with('success','User Added Successfully');

            }else{

                return back()->with('errors','User does not exist');
            }
        }else{
            return back();
        }
        
        
        
        
    }
}
