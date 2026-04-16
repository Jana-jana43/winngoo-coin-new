<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'username',
        'role_id',
        'staff_id',
        'email',
        'password',
        'profile',
        'phone',
        'last_name',
        'status',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
{
    return $this->belongsTo(Role::class, 'role_id');
}

public function hasPermission($module, $action)
{
    return $this->roles
        && $this->roles->permissions()
            ->where('module', $module)
            ->where('permission_name', $action)
            ->wherePivot('is_checked', 1)
            ->exists();
}
}