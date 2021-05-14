<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function LikeUser(){
        
        return $this->morphTo();
    }

    public function LikePost(){
            
        return $this->morphTo();
    }
}
