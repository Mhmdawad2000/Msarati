<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bus\AddStop;
use App\Http\Requests\Bus\EditStop;
use App\Http\Traits\GeneralTrait;
use App\Models\TripStop;
use Illuminate\Http\Request;

class TripStopController extends Controller
{
    use GeneralTrait;


    ///////////////// Start Admin //////////////////
    public function AddTripStop(AddStop $request)
    {
        $data = $request->validated();
        $trip_Stop = TripStop::create($data);
        return $this->returnData('Inserted', 'trip_Stop', $trip_Stop);
    }

    public function EditTripStop(EditStop $request)
    {
        $data = $request->validated();
        $trip_Stop = TripStop::where('id', $request->id)->first();
        $trip_Stop->update($data);
        return $this->returnData('Edited', 'trip_Stop', $trip_Stop);
    }


    public function GetTripStopById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trip_stops,id'
        ]);
        $trip_Stop = TripStop::find($request->id);
        if ($trip_Stop) {
            return $this->returnCollection('trip_Stop', $trip_Stop);
        } else {
            return $this->returnError('The Trip stop not found', 404);
        }
    }

    public function GetAllTripStops(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trips,id'
        ]);
        $trip_Stops = TripStop::where('trip_id', $request->id)->paginate(10);
        return $this->returnCollection('trip_Stops', $trip_Stops);
    }
}