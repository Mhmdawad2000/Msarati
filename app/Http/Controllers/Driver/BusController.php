<?php

namespace App\Http\Controllers\Driver;

use App\Models\Bus;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use function Laravel\Prompts\select;
use App\Http\Resources\Bus\BusResource;
use App\Http\Requests\Bus\Add_Bus_Request;

use App\Http\Resources\PagenateCollection;
use App\Http\Requests\Bus\Edit_Bus_Request;

class BusController extends Controller
{
    use GeneralTrait;
    public function Addbus(Add_Bus_Request $request)
    {
        $data = $request->validated();
        $data['user_driver_id'] = auth()->user()->id;
        if (Car::isDriverHaveCar($data['user_driver_id']) || Bus::isDriverHaveBus($data['user_driver_id'])) return $this->returnError('The driver alredy have car or bus.', 422);
        $bus = Bus::create($data);
        return $this->returnData('Stored', 'bus', new BusResource($bus));
    }

    public function Editbus(Edit_Bus_Request $request)
    {
        $data = $request->validated();
        $bus = Bus::with('vehicle')->find($data['id']);
        $bus->update($data);
        return $this->returnData('Edited', 'bus', new BusResource($bus));
    }

    public function GetbusById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:buses,id'
        ]);
        $bus = Bus::with('vehicle')->find($request->id);
        if ($bus) {
            return $this->returnCollection('bus', new BusResource($bus));
        } else {
            return $this->returnError('The bus not found', 404);
        }
    }

    public function GetAllbuses()
    {

        return $this->returnCollection('buses', new PagenateCollection(Bus::paginate(10)));
    }
}
