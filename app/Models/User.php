<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes ;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
        'phone',
        'dob',
        'postal_code',
         'otp',  
         'photo',
        'otp_expires_at',
        'is_verified',
         'failed_attempts',
        'locked_until',
          'password_reset_token',
        'password_reset_expires_at',
        'remember_token',
        'email_verified_at',
        'user_code',
        'winngoo_id',
        'wingoo_platform',
        'is_deleted'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_deleted' => 'boolean',
        ];
    }
    
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('not_deleted', function ($query) {
        //     $query->where(function ($q) {
        //         $q->where('is_deleted', false)
        //           ->orWhereNull('is_deleted');
        //     });
        // });

        static::creating(function ($user) {
            // $lastUser = User::latest('id')->first();
            // $number   = $lastUser ? $lastUser->id + 1 : 1;
            // $user->user_code = 'WCU' . str_pad($number, 5, '0', STR_PAD_LEFT);


              $lastUser = User::withTrashed()
            ->orderBy('id', 'desc')
            ->first();

        // generate next number
        $number = $lastUser ? $lastUser->id + 1 : 1;

        // assign user_code
        $user->user_code = 'WCU' . str_pad($number, 5, '0', STR_PAD_LEFT);
        });
    }



    public function country()
{
    return $this->belongsTo(\App\Models\Country::class, 'country_id');
}

public function mining()
{
    return $this->hasOne(UserMining::class, 'user_id');
}
}
