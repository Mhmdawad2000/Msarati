<?php

namespace App\Http\Resources\Trip;

use App\Http\Resources\Route\RouteResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
            'route_id' => $this->route_id,
            'days' => $this->days,
            'type' => $this->type,
            'time' => $this->time,
            'route' => RouteResource::make($this->whenLoaded('route')),
        ];
    }
}