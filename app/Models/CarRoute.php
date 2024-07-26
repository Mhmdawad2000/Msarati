<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRoute extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function Car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
    public function Route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
