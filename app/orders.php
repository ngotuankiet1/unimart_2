<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orders extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'shipping_id',
        'customer_id',
        'paymentid',
        'order_total',
        'order_status',
        'order_code'
    ];
}
