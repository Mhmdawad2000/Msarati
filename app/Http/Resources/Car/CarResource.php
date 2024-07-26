<?php

namespace App\Http\Resources\Car;

use App\Http\Resources\Vehicle\VehicleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'car_type' => $this->car_type,
            'car_Number' => $this->car_Number,
            'driver' => collect(['id' => $this->driver->id, 'name' => $this->driver->fname . " " . $this->driver->lname]),
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
        ];
    }
}
