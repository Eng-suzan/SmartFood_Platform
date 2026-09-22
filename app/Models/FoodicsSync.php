<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodicsSync extends Model
{
    protected $fillable = [
        'restaurant_id',
        'sync_type',
        'status',
        'last_synced_at',
        'error_message',
    ];

    protected $casts = [
        'last_synced_at' => 'datetime',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}