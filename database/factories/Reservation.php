<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) use ($factory)  {

    return [
        // All this info is assigned on the-fly through the user model
        /*'user_id' => $user->id,
        'booking_id' => $booking->id,
        'flight_id' => factory(App\Model\Flight::class),
        'passenger_name' => $user->name,
        'passenger_email' => $user->email,
        'reservation_code' => $booking->promo_code,
        'status' => 'active',
        'airline' => $booking->airline,
        'origin' => $booking->origin,
        'destination' => $booking->destination,
        'price' => $booking->price,
        'tax' => $booking->tax,*/
        'seat' => $faker->numberBetween(1,90) . strtoupper($faker->randomElement()),
        'assigned_flight_id' => $faker->randomNumber()
    ];
});


