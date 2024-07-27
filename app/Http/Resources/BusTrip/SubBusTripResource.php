<?php

namespace App\Http\Resources\BusTrip;

use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Resources\Bus\BusResource;
use App\Http\Resources\Trip\TripResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubBusTripResource extends JsonResource
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
            'trip' => new TripResource(Trip::find($this->trip_id)),
            'bus' => new BusResource(Bus::find($this->bus_id)),
            'time_start' => Carbon::parse($this->time_start)->format('h:i A')
        ];
    }
}
