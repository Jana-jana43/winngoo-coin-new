<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMining extends Model
{
    //
     protected $table = 'user_mining';

    protected $fillable = [
        'user_id',
        'coin_type',
        'start_date',
        'end_date',
        'is_active',
        'progress',
        'last_activated_at',
        'next_cycle_activated_at',
          'monthly_due_date',
 'inactive_months',
        'pending_activation',
        'coin_history',
        'current_month'
    ];
    
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coin()
    {
        return $this->belongsTo(Coin::class, 'coin_type', 'name');  
    }
}
