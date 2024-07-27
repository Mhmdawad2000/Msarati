<?php

namespace App\Http\Controllers\User;

use App\Models\Bus;
use App\Models\Car;
use App\Models\Trip;
use App\Models\User;
use App\Models\BusTrip;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditUserRequest;

class UserController extends Controller
{
    //
    use GeneralTrait;
    public function GetMyInfo()
    {

        return $this->returnData('Edited', 'user', auth()->user());
    }
    public function EditUser(EditUserRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);
        $user->update($data);
        return $this->returnData('Edited', 'user', $user);
    }
    public function GetCountUser()
    {
        $count = User::where('user_type', 'Passenger')->count();
        return $this->returnCollection('count', $count);
    }

    public function GetCountDriver()
    {
        $count = User::where('user_type', 'Driver')->count();
        return $this->returnCollection('count', $count);
    }

    public function GetCountCars()
    {
        $count = Car::count();
        return $this->returnCollection('count', $count);
    }
    public function GetCountBuses()
    {
        $count = Bus::count();
        return $this->returnCollection('count', $count);
    }
    public function GetCountTrips()
    {
        $count = Trip::count();
        return $this->returnCollection('count', $count);
    }

    public function GetCountArchivedBusTrips()
    {
        $count = BusTrip::where('status' . 'Archived')->count();
        return $this->returnCollection('count', $count);
    }
    public function GetCountActiveBusTrips()
    {
        $count = BusTrip::where('status' . 'Active')->count();
        return $this->returnCollection('count', $count);
    }
}
