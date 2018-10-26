<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function family(){
        return $this->belongsToMany('App\Family');
    }

    public function post(){
        return $this->belongsToMany('App\Post');
    }
}
