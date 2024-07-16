<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusTrip\Add_Bus_Trip;
use App\Http\Requests\BusTrip\Edit_Bus_Trip;
use App\Http\Traits\GeneralTrait;
use App\Models\BusTrip;
use App\Models\UserBusTrip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusTripController extends Controller
{
    use GeneralTrait;
    public function AddBusTrip(Add_Bus_Trip $request)
    {
        $data = $request->validated();
        $data['status'] = 'Active';
        $data['time_start'] = Carbon::now()->format('H:i');
        $data['num_passengers'] = 0;
        $bus_trip = BusTrip::create($data);
        return $this->returnData('Stored', 'bus_trip', $bus_trip);
    }

    public function AddBusTripToArchive(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bus_trips,id'
        ]);
        $bus_trip = BusTrip::find($request->id);
        $data['status'] = 'Archived';
        $data['num_passengers'] = UserBusTrip::where('bus_trip_id', $bus_trip->id)->count();
        $bus_trip->update($data);
        return $this->returnData('Edited', 'bus_trip', $bus_trip);
    }

    public function EditBusTrip(Edit_Bus_Trip $request)
    {
        $data = $request->validated();
        $bus_trip = BusTrip::find($request->id);
        $bus_trip->update($data);
        return $this->returnData('Edited', 'bus_trip', $bus_trip);
    }

    public function GetBusTripById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bus_trips,id'
        ]);
        $bus_trip = BusTrip::find($request->id);
        if ($bus_trip) {
            return $this->returnCollection('bus_trip', $bus_trip);
        } else {
            return $this->returnError('The bus_trip not found', 404);
        }
    }

    public function GetAllTheTripsToBus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:buses,id'
        ]);
        $bus_trips = BusTrip::where('bus_id', $request->id)->get()->paginate(10);
        return $this->returnCollection('bus_trips', $bus_trips);
    }
}