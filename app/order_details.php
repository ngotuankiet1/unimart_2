<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    //
    protected $fillable = [
        'order_id',
        'product_id',
        'product_price',
        'product_qty',
    ];
}
