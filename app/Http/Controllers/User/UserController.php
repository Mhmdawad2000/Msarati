<?php

namespace App\Http\Controllers\User;

use App\Models\Bus;
use App\Models\Car;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditUserRequest;

class UserController extends Controller
{
    //
    use GeneralTrait;
    public function EditUser(EditUserRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);
        $user->update($data);
        return $this->returnData('Edited', 'user', $user);
    }
    public function GetCountUser()
    {
        $users = User::where('user_type', 'Passenger')->count();
        return $this->returnCollection('count', $users);
    }

    public function GetCountDriver()
    {
        $users = User::where('user_type', 'Driver')->count();
        return $this->returnCollection('count', $users);
    }

    public function GetCountCars()
    {
        $cars = Car::count();
        return $this->returnCollection('count', $cars);
    }
    public function GetCountBuses()
    {
        $buses = Bus::count();
        return $this->returnCollection('count', $buses);
    }
    public function GetCountTrips()
    {
        $trips = Trip::count();
        return $this->returnCollection('count', $trips);
    }
}
