<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Booking;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$booking = new App\Model\Booking;

$factory->define(Booking::class, function (Faker $faker) use ($booking) {

    //ensure the origin is not the same as the destination
    $origin = $faker->randomElement($booking->airports);
    $destination = $faker->randomElement(array_diff($booking->airports, [$origin]));

    return [
        'user_id' => rand(1, 1000),
        'reservation_time' => $faker->dateTime(),
        'status' => 'active',
        'price' => $faker->randomFloat(2, 90, 500),
        'promo_code' => Str::random(10),
        'tax' => $faker->biasedNumberBetween(2, 8),
        'name' => $faker->name,
        'email' => $faker->email,
        'airline' => $faker->randomElement($booking->airlines),
        'origin' => $origin,
        'destination' => $destination,
        'passengers' => 1
    ];
});