<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\Add_Car_Request;
use App\Http\Requests\Car\Edit_Car_Request;
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
        return $this->returnData('Stored', 'car', $car);
    }

    public function EditCar(Edit_Car_Request $request)
    {
        $data = $request->validated();
        $car = Car::where('id', $request->id);
        $car->update($data);
        return $this->returnData('Edited', 'car', $car);
    }

    public function GetCarById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cars,id'
        ]);
        $car = Car::find($request->id);
        if ($car) {
            return $this->returnCollection('car', $car);
        } else {
            return $this->returnError('The car not found', 404);
        }
    }

    public function GetAllCars()
    {
        $cars = Car::paginate(10);
        return $this->returnCollection('cars', $cars);
    }
}