<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function Buses()
    {
        return $this->hasMany(Bus::class, 'veihcle_id');
    }
    public function Cars()
    {
        return $this->hasMany(Car::class, 'vehicle_id');
    }
}
