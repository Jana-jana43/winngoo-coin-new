<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $fillable = [
        'name',
        'type',
        'image',
        'image2',
        'mining_period',
        'description',
        'status',
    ];
    public function mining()
{
    return $this->hasMany(UserMining::class, 'coin_type', 'name');
}
}