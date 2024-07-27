<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserBusTrip\Add_User_Bus_Trip;
use App\Http\Requests\UserBusTrip\Edit_User_Bus_Trip;
use App\Http\Traits\GeneralTrait;
use App\Models\UserBusTrip;
use Illuminate\Http\Request;

class UserBusTripController extends Controller
{
    use GeneralTrait;

    public function AddUserBusTrip(Add_User_Bus_Trip $request)
    {
        $data = $request->validated();
        $ubt = UserBusTrip::create($data);
        return $this->returnData('Inserted', 'user_bus_trip', $ubt);
    }

    public function EditUserBusTrip(Edit_User_Bus_Trip $request)
    {
        $data = $request->validated();
        $user_bus_trip = UserBusTrip::where('id', $request->id);
        $user_bus_trip->update($data);
        return $this->returnData('Edited', 'user_bus_trip', $user_bus_trip);
    }

    public function GetUserBusTripById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:user_bus_trips,id'
        ]);
        $user_bus_trip = UserBusTrip::find($request->id);
        if ($user_bus_trip) {
            return $this->returnCollection('user_bus_trip', $user_bus_trip);
        } else {
            return $this->returnError('The user bus trip not found', 404);
        }
    }

    public function GetAllUserBusTrips()
    {
        $user_bus_trips = UserBusTrip::paginate(10);
        return $this->returnCollection('user_bus_trips', $user_bus_trips);
    }
    public  function GetAllUsersToBusTrip(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bus_trips,id'
        ]);
        $users_bus_trip = UserBusTrip::getAllUserToBusTrip($request->id);
        return $this->returnCollection('users', $users_bus_trip);
    }
    public function GetAllBusTripsToUser(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id'
        ]);
        $bus_trips_user = UserBusTrip::getAllBusTripsToUser($request->id);
        return $this->returnCollection('bus_trips', $bus_trips_user);
    }
}
