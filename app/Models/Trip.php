<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',

    ];


    public function getDaysAttribute($days)
    {
        return json_decode($days);
    }

    public function setDaysAttribute($days)
    {
        $data  = json_decode($days, true);
        $this->attributes['days'] =  json_encode($data);
    }

    public function Route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
    public function TripStops()
    {
        return $this->hasMany(TripStop::class, 'id');
    }
}
