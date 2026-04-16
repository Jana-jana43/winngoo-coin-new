<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsCondition extends Model
{
        protected $table = 'terms_and_conditions';

    protected $fillable = [
        'content'
    ];

}
