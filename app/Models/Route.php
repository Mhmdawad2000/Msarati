<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function Trips()
    {
        return $this->hasMany(Trip::class, 'trip_id');
    }
    public function CarRoutes()
    {
        return $this->hasMany(CarRoute::class, 'route_id');
    }
    public function DetailsCar()
    {
        return $this->belongsToMany(Car::class, 'car_routes');
    }
}
