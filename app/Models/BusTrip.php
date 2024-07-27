<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusTrip extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function Bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
    public function Trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
