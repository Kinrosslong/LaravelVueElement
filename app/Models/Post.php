<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Post class
 * 这个是post表的Model
 */
class Post extends Model
{   
    // protected $hidden = ['user_id','title'];
    protected $fillable = ['title', 'body', 'user_id'];
}
