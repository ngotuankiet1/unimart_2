<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name', 'price','images','desc','intro','product_cat','status','outstanding','warehouse'
    ];
}
