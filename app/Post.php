<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   
    // protected $hidden = ['user_id','title'];
    /**
     * 允许赋值的字段
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'user_id'];
}
