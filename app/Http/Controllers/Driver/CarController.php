<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\Add_Car_Request;
use App\Http\Requests\Car\Edit_Car_Request;
use App\Http\Resources\Car\CarResource;
use App\Http\Resources\PagenateCollection;
use App\Http\Traits\GeneralTrait;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    use GeneralTrait;
    public function AddCar(Add_Car_Request $request)
    {
        $data = $request->validated();
        $car = Car::create($data);
        return $this->returnData('Stored', 'car', new CarResource($car));
    }

    public function EditCar(Edit_Car_Request $request)
    {
        $data = $request->validated();
        $car = Car::with('vehicle')->find($request->id);
        $car->update($data);
        return $this->returnData('Edited', 'car', new CarResource($car));
    }

    public function GetCarById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cars,id'
        ]);
        $car = Car::with('vehicle')->find($request->id);
        if ($car) {
            return $this->returnCollection('car', new CarResource($car));
        } else {
            return $this->returnError('The car not found', 404);
        }
    }

    public function GetAllCars()
    {
        return $this->returnCollection('cars', new PagenateCollection(Car::paginate(10)));
    }
}
