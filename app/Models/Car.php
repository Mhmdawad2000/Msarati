<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function Driver()
    {
        return $this->belongsTo(User::class, 'user_driver_id');
    }
    public function Routes()
    {
        return $this->hasMany(CarRoute::class, 'car_id');
    }
    public function DetailsRoutes()
    {
        return $this->belongsToMany(Route::class, 'car_routes');
    }

    public static function isDriverHaveCar($id)
    {
        return self::where('user_driver_id', $id)->first() == null ? 0 : 1;
    }
}
