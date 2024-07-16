<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Route\Add_Route_Request;
use App\Http\Requests\Route\Edit_Route_Request;
use App\Http\Resources\PagenateCollection;
use App\Http\Resources\Route\RouteResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    use GeneralTrait;


    ///////////////// Start Admin //////////////////
    public function AddRoute(Add_Route_Request $request)
    {
        $data = $request->validated();
        $route = Route::create($data);
        return $this->returnData('Inserted', 'route', new RouteResource($route));
    }

    public function EditRoute(Edit_Route_Request $request)
    {
        $data = $request->validated();
        $route = Route::where('id', $request->id)->first();
        $route->update($data);
        return $this->returnData('Edited', 'route', new RouteResource($route));
    }


    public function GetRouteById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:routes,id'
        ]);
        $route = Route::find($request->id);
        if ($route) {
            return $this->returnCollection('Route', new RouteResource($route));
        } else {
            return $this->returnError('The Route not found', 404);
        }
    }

    public function GetAllroutes()
    {
        return $this->returnCollection('routes', new PagenateCollection(Route::paginate(10)));
    }
}