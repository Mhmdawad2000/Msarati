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
}