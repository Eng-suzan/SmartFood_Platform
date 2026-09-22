<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use App\Models\MenuItem;

class Restaurant extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'phone',
        'email',
        'address',
        'opening_time',
        'closing_time',
        'is_open',
        'latitude',
        'longitude',
        'image',
        'status',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
    public function orders(): HasMany
{
    return $this->hasMany(Order::class);
}

    /*
    |--------------------------------------------------------------------------
    | Check if restaurant is open now
    |--------------------------------------------------------------------------
    */
    public function owner()
{
    return $this->belongsTo(User::class, 'owner_id');
}

    public function isOpenNow(): bool
    {
        if (!$this->opening_time || !$this->closing_time) {
            return false;
        }
        

        $now = Carbon::now()->format('H:i');

        $opening = Carbon::parse($this->opening_time)->format('H:i');
        $closing = Carbon::parse($this->closing_time)->format('H:i');

        // Example: 08:00 → 23:00
        if ($opening < $closing) {
            return $now >= $opening && $now < $closing;
        }

        // Example: 08:00 → 03:00
        if ($opening > $closing) {
            return $now >= $opening || $now < $closing;
        }

        // Same opening and closing time = closed
        return false;
    }
}