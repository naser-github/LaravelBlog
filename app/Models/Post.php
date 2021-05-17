<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Post extends Model{

    public function tags(){

        return $this->belongsToMany('App\Models\Tag');
    }

    public function users(){

        return $this->belongsToMany('App\Models\User');
    }

    public function postphotos(){
        
        return $this->morphMany('App\Models\PostPhoto', 'posted_photo');
    }

    public function post_comment(){
        
        return $this->hasMany('App\Models\Comment', 'post_id');
    }

    public function PostLike()
    {
        return $this->MorphMany('App\Models\Like', 'likeable');
    }

    public function LikedBy(){
        
        return $this->PostLike()->where('user_id',Auth::user()->id)->exists();
    }

    protected static function boot(){

        parent::boot();

        self::updated(function($post){

            if($post->publish=="true"){
                
                $users = $post->users;

                foreach($users as $user){
                    
                    Mail::raw('Your post has been published',function($message) use($user){
                        $message->to($user->email,$user->name)->subject('Published ');
                    });
                }
            }
        });
    }


}
;