<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripStop extends Model
{
    use HasFactory;
    protected $table = 'trip_stops';
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Trip()
    {
        return $this->belongsTo(Trip::class, 'id');
    }


    public function getLocationAttribute()
    {
        return $this->attributes['city'] . '/' . $this->attributes['place'];
    }

    protected $appends = ['location'];
}
