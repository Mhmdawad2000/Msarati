<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bus\AddStop;
use App\Http\Requests\Bus\EditStop;
use App\Http\Resources\PagenateCollection;
use App\Http\Resources\TripStop\TripStopResource;
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
        return $this->returnData('Inserted', 'trip_Stop', new TripStopResource($trip_Stop));
    }

    public function EditTripStop(EditStop $request)
    {
        $data = $request->validated();
        $trip_Stop = TripStop::where('id', $request->id)->first();
        $trip_Stop->update($data);
        return $this->returnData('Edited', 'trip_Stop', new TripStopResource($trip_Stop));
    }


    public function GetTripStopById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trip_stops,id'
        ]);
        $trip_Stop = TripStop::where('id', $request->id)->with('trip')->first();
        if ($trip_Stop) {
            return $this->returnCollection('trip_Stop', new TripStopResource($trip_Stop));
        } else {
            return $this->returnError('The Trip stop not found', 404);
        }
    }

    public function GetAllTripStops(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trips,id'
        ]);
        return $this->returnCollection('trip_Stops', new PagenateCollection(TripStop::where('trip_id', $request->id)->with('trip')->paginate(10)));
    }
}