<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable=['name'];

    public function user(){
        return $this->hasMany('App\User');
    }

    public function post(){
        return $this->hasMany('App\Post');
    }
}
