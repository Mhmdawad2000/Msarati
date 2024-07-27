<?php

namespace App\Http\Resources\CarRoute;

use App\Http\Resources\Route\RouteResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarRouteResource extends JsonResource
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
            'car_id' => $this->car_id,
            // 'routes'=>RouteResource::collection(),
        ];
    }
}
