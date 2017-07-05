<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hotelpayments extends Model
{
    protected $fillable = [
        'user','roomType' , 'price', 'startDate', 'endDate', 'hotel'
    ];
}
