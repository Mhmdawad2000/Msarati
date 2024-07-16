<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\AddTrip;
use App\Http\Requests\Trip\EditTrip;
use App\Http\Traits\GeneralTrait;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    use GeneralTrait;


    ///////////////// Start Admin //////////////////
    public function AddTrip(AddTrip $request)
    {
        $data = $request->validated();
        $trip = Trip::create($data);
        return $this->returnData('Inserted', 'trip', $trip);
    }

    public function EditTrip(EditTrip $request)
    {
        $data = $request->validated();
        $trip = Trip::where('id', $request->id)->first();
        $trip->update($data);
        return $this->returnData('Edited', 'trip', $trip);
    }


    public function GetTripById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trips,id'
        ]);
        $trip = Trip::find($request->id);
        if ($trip) {
            return $this->returnCollection('trip', $trip);
        } else {
            return $this->returnError('The trip not found', 404);
        }
    }

    public function GetAllTrips()
    {
        $trips = Trip::paginate(10);
        return $this->returnCollection('trips', $trips);
    }
}
