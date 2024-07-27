<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PagenateCollection;
use App\Http\Resources\Vehicle\VehicleResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    use GeneralTrait;
    ///////////////// Start Admin //////////////////
    public function AddVehicle(Request $request)
    {
        $data = $request->validate([
            'vehicle_type' => 'required|string|in:Bus,Car',
            'num_passengers' => 'required|numeric|min:1',
            'fual_type'    => 'required|string'
        ]);
        $vehicle = Vehicle::create($data);
        return $this->returnData('Inserted', 'vehicle', new VehicleResource($vehicle));
    }

    public function EditVehicle(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:vehicles,id',
            'num_passengers' => 'required|numeric|min:1',
            'fual_type'    => 'required|string'
        ]);
        $vehicle = Vehicle::where('id', $request->id)->first();
        $vehicle->update($data);
        return $this->returnData('Edited', 'vehicle', new VehicleResource($vehicle));
    }


    public function GetVehicleById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:vehicles,id'
        ]);
        $vehicle = Vehicle::find($request->id);
        if ($vehicle) {
            return $this->returnCollection('vehicle', new VehicleResource($vehicle));
        } else {
            return $this->returnError('The vehicle not found', 404);
        }
    }

    public function GetAllVehicles()
    {
        return $this->returnCollection('vehicles', new PagenateCollection(Vehicle::paginate(10)));
    }
}
