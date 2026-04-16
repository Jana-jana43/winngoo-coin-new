<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'title',
        'message',
        'type',
        'audience',
        'medium',
        'scheduled_date',
        'scheduled_time',
        'status',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function getMediumArrayAttribute(): array
    {
        return explode(',', $this->medium);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeSent($query)
    {
        return $query->where('status', 'Sent');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'Failed');
    }

    public function getTypeBadgeClassAttribute(): string
    {
        return match($this->type) {
            'Warning'     => 'bg-warning',
            'Success'     => 'bg-success',
            'Information' => 'bg-info',
            default       => 'bg-secondary',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'Sent'    => 'bg-success',
            'Pending' => 'bg-warning',
            'Failed'  => 'bg-danger',
            default   => 'bg-secondary',
        };
    }
}