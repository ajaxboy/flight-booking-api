<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 *  API Routing
 */

Route::apiResource('users','UserController')
    ->only(['index'])
    ->names([
    'index' => 'users.all'
]);

Route::apiResource('flights','FlightController')
    ->only(['index','show','store','update','destroy'])
    ->names([
    'index' => 'flights.all',
    'show' => 'flights.show',
    'store' => 'flights.store',
    'update' => 'flights.update',
    'destroy' => 'flights.destroy'
]);

Route::apiResource('booking','BookingController')
    ->only(['index','show','store','update','destroy'])
    ->names([
    'index' => 'booking.all',
    'show' => 'booking.show',
    'store' => 'booking.store',
    'update' => 'booking.update'
]);

Route::apiResource('reservations','ReservationController')
    ->only(['index','show','store','update','destroy'])
    ->names([
    'index' => 'reservation.all',
    'show' => 'reservation.show',
    'store' => 'reservation.store',
    'update' => 'reservation.update',
    'delete' => 'reservation.destroy'
]);

Route::fallback( function() {
    return response()->json(['error' => 'Invalid Resource Request.'], 404);
})->name('api.404');

