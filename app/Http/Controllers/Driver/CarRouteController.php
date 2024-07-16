<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Route\Add_Car_Route_Request;
use App\Http\Requests\Route\Edit_Car_Route_Request;
use App\Http\Traits\GeneralTrait;
use App\Models\CarRoute;
use Illuminate\Http\Request;

class CarRouteController extends Controller
{
    use GeneralTrait;
    public function AddRouteToCar(Add_Car_Route_Request $request)
    {
        $data = $request->validated();
        CarRoute::create($data);
        return $this->returnAccept('The route added to car successfuly');
    }

    public function EditRouteToCar(Edit_Car_Route_Request $request)
    {
        $data = $request->validated();
        $carroute = CarRoute::find($request->id);
        $carroute->update($data);
        return $this->returnData('Edited', 'car_route', $carroute);
    }


    // public function GetCarRouteById(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:car_routes,id'
    //     ]);
    //     $car_route = CarRoute::find($request->id);
    //     if ($car_route) {
    //         return $this->returnCollection('car_route', $car_route);
    //     } else {
    //         return $this->returnError('The car route not found', 404);
    //     }
    // }
    public function GetAllRouteToCar(Request $request)
    {
        $data = $request->validate([
            'id' => 'exists:cars,id'
        ]);
        $routes = CarRoute::where('car_id', $data['id'])->get();
        return $this->returnCollection('routes', $routes);
    }

    public function GetAllCarsInRoute(Request $request)
    {
        $data = $request->validate([
            'id' => 'exists:routes,id'
        ]);
        $cars = CarRoute::where('route_id', $data['id'])->get();
        return $this->returnCollection('cars', $cars);
    }
}
