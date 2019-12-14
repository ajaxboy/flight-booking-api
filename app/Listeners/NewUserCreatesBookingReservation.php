<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Model\Booking;
use App\Model\Flight;
use App\Model\Reservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewUserCreatesBookingReservation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {

        $booking = factory(Booking::class)->create([
            'user_id' => $event->user->id,
            'name' => $event->user->name,
            'email' => $event->user->email
        ]);


        factory(Reservation::class)->create([
            'user_id' => $event->user->id,
            'booking_id' => $booking->id,
            'flight_id' => factory(Flight::class),
            'passenger_name' => $event->user->name,
            'passenger_email' => $event->user->email,
            'reservation_code' => $booking->promo_code,
            'status' => 'active',
            'airline' => $booking->airline,
            'origin' => $booking->origin,
            'destination' => $booking->destination,
            'price' => $booking->price,
            'tax' => $booking->tax
        ]);


    }
}
