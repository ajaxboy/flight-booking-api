<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 *  API Routing
 */


Route::post('register','AuthController@register');
Route::post('login','AuthController@login');

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



Route::options('{all}', function () {
    $response = Response::make('');

    if(!empty($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], ['http://127.0.0.1:8000'])) {
        $response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
    } else {
        $response->header('Access-Control-Allow-Origin', url()->current());
    }
    $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
    $response->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, PATCH, DELETE');
    $response->header('Access-Control-Allow-Credentials', 'true');
    $response->header('X-Content-Type-Options', 'nosniff');

    return $response;
})->where('all', '.*');