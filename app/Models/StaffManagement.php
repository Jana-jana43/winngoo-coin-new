<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffManagement extends Model
{
    protected $table = 'staff_management';

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
{
    return $this->belongsTo(Role::class, 'role_id');
}
}
