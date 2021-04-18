<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
