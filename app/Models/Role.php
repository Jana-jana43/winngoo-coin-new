<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['rolename', 'status'];

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permission', 
            'role_id',         
            'permission_id'    
        )->withPivot('is_checked')
         ->withTimestamps();
    }
}
