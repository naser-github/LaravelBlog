<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostPhoto;

use Illuminate\Http\Request;
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
            'category.*' => 'required|exists:tags,id',
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:1000'
        ],[
            'images.*.required' => 'Please Upload an image',
            'images.mimes' => 'must be a jpeg,png,jpg file',
            'images.max' => 'image size exceeded',
        ]);

        $title = $request->input('title');
        $post_body = $request->input('post_body');
        $categories = $request->input('category');

        $post = new Post;

        $post->post_title = $title;
        $post->post_body = $post_body;

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
}
