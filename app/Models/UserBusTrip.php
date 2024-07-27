<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\BusTrip\SubBusTripResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use function PHPUnit\Framework\isEmpty;

class UserBusTrip extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function getAllUserToBusTrip($id)
    {
        $allUsers = collect();
        $users = self::select('user_passenger_id')->where('bus_trip_id', $id)->get();
        foreach ($users as $Id) {
            $allUsers->push(User::select('id', 'user_type', 'fname', 'lname', 'phone',)->find($Id));
        }
        return $allUsers;
    }
    public static function getAllBusTripsToUser($id)
    {
        $allActiveBusTrips = collect();
        $allArchivedBusTrips = collect();
        $bus_trips = self::where('user_passenger_id', $id)->pluck('bus_trip_id');
        foreach ($bus_trips as $Id) {
            $item = BusTrip::find($Id);
            $item->status == 'Active' ? $allActiveBusTrips->push(SubBusTripResource::make($item)) : $allArchivedBusTrips->push(SubBusTripResource::make($item));
        }
        return ['active' => $allActiveBusTrips, 'archived' => $allArchivedBusTrips];
    }
}
