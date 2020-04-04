<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverLocation extends Model
{
    //
    protected $fillable = [
        'd_latitude', 'd_longitude'
    ];
}
