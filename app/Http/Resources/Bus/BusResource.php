<?php

namespace App\Http\Resources\Bus;

use App\Http\Resources\Vehicle\VehicleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
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
            'model' => $this->model,
            'color' => $this->color,
            'bus_type' => $this->bus_type,
            'bus_Number' => $this->bus_Number,
            'driver' => collect(['id' => $this->driver->id, 'name' => $this->driver->fname . " " . $this->driver->lname]),
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
        ];
    }
}
