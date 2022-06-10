<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paymetns extends Model
{
    //
    protected $fillable = [
        'payment_method',
        'payment_status'
    ];

}
