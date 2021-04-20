<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\PostPhoto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){

        return view('admin.user', [
            'users' => DB::table('users')->paginate(10)
        ]);
        
        return view ('admin.user', compact('users') );
    }

    public function ban($id){

        $user = User::where('id',$id)->first();

        $posts = $user->user_posts;

        foreach ($posts as $post){
            $post = Post::where('id',$post->id)->first();

            $tags = $post->tags;
            $post->tags()->detach($tags);
    
            $photos = PostPhoto::where([
                ['posted_photo_id',$post->id],
                ['posted_photo_type','App\Models\Post']
            ])->get();
            
            if(!empty($photos)){
                $photos->each->delete();
            }
            
            if(!empty($post->post_comment) ){
                $post->post_comment->each->delete();
            }

            if(!empty($post) ){
                $post->delete();
            }

        }

        $user->user_posts()->detach($posts);

        if(!empty($user->comment)){
            $user->comment->each->delete();
        }

        if(!empty($user->profile) ){
            $user->profile->delete();
        }

        $user->delete();

        return back();
    }

    public function role($id){
     
        $user = User::where('id',$id)->first();

        if( $user->role_id == 1)
            $user->role_id = 3;
        else
            $user->role_id = 1;

        $user->save();

        return back();
    }
}

