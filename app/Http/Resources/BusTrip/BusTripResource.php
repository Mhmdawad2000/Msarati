<?php

namespace App\Http\Resources\BusTrip;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusTripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'bus_id' => $this->bus_id,
            'trip_id' => $this->trip_id,
            'status' => ucfirst($this->status),
            'time_start' => Carbon::parse($this->time_start)->format('h:i A'),
            'num_passengers' => $this->num_passengers,
        ];
    }
}
