<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // protected static function newFactory()
    // {
    //     return TagFactory::new();
    // }
    
    public function posts(){

        return $this->belongsToMany('App\Models\Post');
    }
}
