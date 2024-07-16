<?php

namespace App\Http\Resources\Route;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
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
            'start_lat' => $this->start_point_lat,
            'start_lang' => $this->start_point_lang,
            'end_lat' => $this->end_point_lat,
            'end_lang' => $this->end_point_lang
        ];
    }
}