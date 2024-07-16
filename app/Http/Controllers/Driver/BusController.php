<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Bus;
use App\Http\Requests\Bus\Add_Bus_Request;
use App\Http\Requests\Bus\Edit_Bus_Request;
use Illuminate\Http\Request;

class BusController extends Controller
{
    use GeneralTrait;
    public function Addbus(Add_Bus_Request $request)
    {
        $data = $request->validated();
        $bus = Bus::create($data);
        return $this->returnData('Stored', 'bus', $bus);
    }

    public function Editbus(Edit_Bus_Request $request)
    {
        $data = $request->validated();
        $bus = Bus::where('id', $data->id);
        $bus->update($data);
        return $this->returnData('Edited', 'bus', $bus);
    }

    public function GetbusById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:buses,id'
        ]);
        $bus = Bus::find($request->id);
        if ($bus) {
            return $this->returnCollection('bus', $bus);
        } else {
            return $this->returnError('The bus not found', 404);
        }
    }

    public function GetAllbuses()
    {
        $buss = Bus::paginate(10);
        return $this->returnCollection('buses', $buss);
    }
}
