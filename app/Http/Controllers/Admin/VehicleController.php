<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'vehicle_type' => 'required|string',
            'num_passengers' => 'required|numeric|min:1',
            'fual_type'    => 'required|string'
        ]);
        $vehicle = Vehicle::create($data);
        return $this->returnData('Inserted', 'vehicle', $vehicle);
    }

    public function EditVehicle(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:vehicles,id',
            'vehicle_type' => 'required|string',
            'num_passengers' => 'required|numeric|min:1',
            'fual_type'    => 'required|string'
        ]);
        $vehicle = Vehicle::where('id', $request->id)->first();
        $vehicle->update($data);
        return $this->returnData('Edited', 'vehicle', $vehicle);
    }


    public function GetVehicleById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:vehicles,id'
        ]);
        $vehicle = Vehicle::find($request->id);
        if ($vehicle) {
            return $this->returnCollection('vehicle', $vehicle);
        } else {
            return $this->returnError('The vehicle not found', 404);
        }
    }

    public function GetAllVehicles()
    {
        $vehicles = Vehicle::paginate(10);
        return $this->returnCollection('vehicles', $vehicles);
    }
}
