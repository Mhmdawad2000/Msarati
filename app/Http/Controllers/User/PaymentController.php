<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\AddPayment;
use App\Http\Traits\GeneralTrait;
use App\Models\CarTrip;
use App\Models\Payment;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use GeneralTrait;
    public function AddPayment(AddPayment $request)
    {
        $data = $request->validated();

        $passenger = User::find(auth()->user()->id);

        $car_trip = CarTrip::find($request->car_trip_id);
        $driver = User::find($car_trip->user_driver_id);

        $passenger->balance =  $passenger->balance - $data['amount'];
        $driver->balance =  $driver->balance + $data['amount'];
        $driver->save();
        $passenger->save();


        $data['status'] = 'Archived';
        $data['method'] = 'QR';

        $car_trip->status = 'Archived';
        $car_trip->save();

        $the_request = ModelsRequest::find($car_trip->request_id);
        $the_request->status = 'Archived';
        $the_request->save();

        $payment = Payment::create($data);
        return $this->returnData('Paid', 'payment', $payment);
    }

    public function GetAllPayments()
    {
        $payments = Payment::paginate(10);
        return $this->returnCollection('payments', $payments);
    }
}