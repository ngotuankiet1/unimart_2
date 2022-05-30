<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    //
    protected $fillable = ['shipping_name', 'shipping_email', 'shipping_address', 'shipping_phone', 'shipping_desc'];
}
