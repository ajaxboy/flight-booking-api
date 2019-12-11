<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Reservation;
use App\Model\Booking;
use App\User;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) use ($factory)  {

    $user = factory(User::class)->create();
    $booking = factory(Booking::class)->create([
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email
    ]);

    return [
        'user_id' => $user->id,
        'booking_id' => $booking->id,
        'flight_id' => factory(App\Model\Flight::class),
        'passenger_name' => $user->name,
        'passenger_email' => $user->email,
        'reservation_code' =>  $booking->promo_code,
        'status' => 'active',
        'airline' => $booking->airline,
        'origin' => $booking->origin,
        'destination' => $booking->destination,
        'price' => $booking->price,
        'tax' => $booking->tax,
        'seat' => $faker->numberBetween(1,90) . strtoupper($faker->randomElement()),
        'assigned_flight_id' => $faker->randomNumber()
    ];
});