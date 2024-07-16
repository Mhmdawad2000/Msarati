<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\AddTrip;
use App\Http\Requests\Trip\EditTrip;
use App\Http\Resources\PagenateCollection;
use App\Http\Resources\Trip\TripCollection;
use App\Http\Resources\Trip\TripResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    use GeneralTrait;

    public function AddTrip(AddTrip $request)
    {
        $data = $request->validated();
        $trip = Trip::create($data);
        return $this->returnData('Inserted', 'trip', new TripResource($trip));
    }

    public function EditTrip(EditTrip $request)
    {
        $data = $request->validated();
        $trip = Trip::where('id', $request->id)->first();
        $trip->update($data);
        return $this->returnData('Edited', 'trip', new TripResource($trip));
    }


    public function GetTripById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trips,id'
        ]);
        $trip = Trip::where('id', $request->id)->with('route')->first();
        if ($trip) {
            return $this->returnCollection('trip', new TripResource($trip));
        } else {
            return $this->returnError('The trip not found', 404);
        }
    }

    public function GetAllTrips()
    {
        return $this->returnCollection('trips', new PagenateCollection(Trip::with('route')->paginate(10)));
    }
}
