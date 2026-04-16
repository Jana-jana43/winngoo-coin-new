<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
     protected $fillable = [
        'name',
        'iso_code',
        'phone_code',
        'phone_min',
        'phone_max',
        'postal_regex',
    ];
}
