<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    protected $guarded = [];
    
    public function photoposts(){

        return $this->morphOne('App\Models\Post', 'posted_photo'); 
    }
}
