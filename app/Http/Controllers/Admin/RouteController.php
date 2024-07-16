<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    use GeneralTrait;


    ///////////////// Start Admin //////////////////
    public function AddRoute(Request $request)
    {
        $data = $request->validate([
            'start_point_lat' => 'required|numeric',
            'start_point_lang' => 'required|numeric',
            'end_point_lat' => 'required|numeric',
            'end_point_lang' => 'required|numeric'
        ]);
        $Route = Route::create($data);
        return $this->returnData('Inserted', 'route', $Route);
    }

    public function EditRoute(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:routes,id',
            'start_point_lat' => 'required|numeric',
            'start_point_lang' => 'required|numeric',
            'end_point_lat' => 'required|numeric',
            'end_point_lang' => 'required|numeric'
        ]);
        $route = Route::where('id', $request->id)->first();
        $route->update($data);
        return $this->returnData('Edited', 'route', $route);
    }


    public function GetRouteById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:routes,id'
        ]);
        $route = Route::find($request->id);
        if ($route) {
            return $this->returnCollection('Route', $route);
        } else {
            return $this->returnError('The Route not found', 404);
        }
    }

    public function GetAllroutes()
    {
        $routes = Route::paginate(10);
        return $this->returnCollection('routes', $routes);
    }
}