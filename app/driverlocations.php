<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class driverlocations extends Model
{
    //
    protected $fillable = [
        'd_latitude', 'd_longitude', 'isOnline', 'U_id'
    ];
}
