<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bus extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Driver()
    {
        return $this->belongsTo(User::class, 'user_driver_id');
    }
    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
