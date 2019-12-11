<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Flight;
use Faker\Generator as Faker;

$booking = new \App\Model\Booking;

$factory->define(Flight::class, function (Faker $faker) use ($booking) {

    //ensure the origin is not the same as the destination
    $origin = $faker->randomElement($booking->airports);
    $destination = $faker->randomElement(array_diff($booking->airports, [$origin]));

    return [
        'flight_number' => $faker->numberBetween(150, 1500),
        'airline' =>  $faker->randomElement($booking->airlines),
        'origin' => $origin,
        'destination' => $destination,
        'boarding_time' => $faker->dateTimeBetween('30 days','90 days'),
        'arrival_time' => $faker->dateTimeBetween('31 days','32 days'),
    ];
});
