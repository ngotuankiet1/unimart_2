<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name','images','desc','post_cat','status','create_user'
    ];
}
