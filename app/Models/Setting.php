<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'group'
    ];

    /**
     * Get value by key
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Set value by key
     */
    public static function set($key, $value, $group = null)
    {
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group
            ]
        );
    }

    /**
     * Get all settings as key-value array
     */
    public static function getAll()
    {
        return self::pluck('value', 'key')->toArray();
    }

    /**
     * Get settings by group (email, platform, etc.)
     */
    public static function getByGroup($group)
    {
        return self::where('group', $group)
                    ->pluck('value', 'key')
                    ->toArray();
    }
}