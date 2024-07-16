<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyRequest\AcceptRequest;
use App\Http\Requests\MyRequest\AddRequest;
use App\Http\Requests\MyRequest\EditRequest;
use App\Http\Traits\GeneralTrait;
use App\Models\CarTrip;
use App\Models\Request as ModelsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    use GeneralTrait;


    ///////////////// Start Admin //////////////////
    public function AddRequest(AddRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'Waiting';
        $myRequest = ModelsRequest::create($data);
        return $this->returnData('Inserted', 'request', $myRequest);
    }

    public function EditmyRequest(EditRequest $request)
    {
        $data = $request->validated();
        $myRequest = ModelsRequest::where('id', $request->id)->first();
        $myRequest->update($data);
        return $this->returnData('Edited', 'request', $myRequest);
    }


    public function GetRequestById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:requests,id'
        ]);
        $myRequest = ModelsRequest::find($request->id);
        if ($myRequest) {
            return $this->returnCollection('request', $myRequest);
        } else {
            return $this->returnError('The request not found', 404);
        }
    }

    public function AcceptRequest(AcceptRequest $request)
    {
        $request->validated();
        $myrequest = ModelsRequest::find($request->id);
        $myrequest->update(['status' => 'Accepted']);

        $data['request_id'] = $request->id;
        $data['driver_id'] = auth()->user()->id;
        $data['status'] = 'waiting';
        $data['time_start'] = Carbon::now()->fromat('Y-m-i H:i:s');
        $car_trip = CarTrip::create($data);

        return $this->returnData('Accepted', 'car_trip', $car_trip);
    }

    public function GetAllArchivedRequests()
    {
        $Requests = ModelsRequest::where('status', 'Archived')->get();
        return $this->returnCollection('requests', $Requests);
    }

    public function GetAllAcceptedRequests()
    {
        $Requests = ModelsRequest::where('status', 'Accepted')->get();
        return $this->returnCollection('requests', $Requests);
    }
    public function GetAllWaitingRequests()
    {
        $Requests = ModelsRequest::where('status', 'Waiting')->get();
        return $this->returnCollection('requests', $Requests);
    }

    public function GetAllUserRequests()
    {
        $user = auth()->user();
        $myRequests = ModelsRequest::where('user_passenger_id', $user->id)->get()
            ->groupBy('status');
        return $this->returnCollection('requests', $myRequests);
    }
}