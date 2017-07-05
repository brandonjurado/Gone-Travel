<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class flightpayments extends Model
{
    protected $fillable = [
        'user','from' , 'price', 'to', 'startDate', 'endDate'
    ];
}
