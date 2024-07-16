<?php

namespace App\Http\Resources\TripStop;

use App\Http\Resources\Trip\TripResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripStopResource extends JsonResource
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
            'trip_id' => $this->trip_id,
            'city' => $this->city,
            'place' => $this->place,
            'lat' => $this->lat,
            'lang' => $this->lat,
            'time' => $this->time,
            'trip' => new TripResource($this->whenLoaded('trip')),
        ];
    }
}
