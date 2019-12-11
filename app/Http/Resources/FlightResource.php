<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'flight_number' => $this->flight_number,
            'airline' => $this->airline,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'boarding_time' => $this->boarding_time,
            'arrival_time' => $this->arrival_time,
        ];
    }
}
