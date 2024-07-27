<?php

namespace App\Http\Resources\Car;

use Illuminate\Http\Request;
use App\Http\Resources\Route\RouteResource;
use App\Http\Resources\Vehicle\VehicleResource;
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
            'car_number' => $this->car_number,
            'driver' => collect(['id' => $this->driver->id, 'name' => $this->driver->fname . " " . $this->driver->lname]),
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
            'details_routes' => RouteResource::collection($this->whenLoaded('DetailsRoutes')),
        ];
    }
}
