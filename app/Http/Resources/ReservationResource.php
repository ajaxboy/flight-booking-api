<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
          'booking_id' => $this->booking_id,
          'passenger_name' => $this->passenger_name,
          'passenger_email' => $this->passenger_email,
          'reservation_code' => $this->reservation_code,
          'origin' => $this->origin,
          'destination' => $this->destination,
          'airline' => $this->airline,
          'seat' => $this->seat,
          'status' => $this->status,
          'assigned_flight_id' => $this-> assigned_flight_id
        ];
    }
}
