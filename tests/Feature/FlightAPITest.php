<?php

namespace Tests\Feature;

use App\Model\Reservation;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Model\Flight;

class FlightAPITest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function can_view_flights()
    {
        $user = factory(User::class, 10)->create();
        $response = $this->get('api/flights');

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertTrue(count($response->decodeResponseJson(['data'])) > 0);
    }

    /** @test */
    public function can_store_flight()
    {
        $user = factory(User::class)->create();
        $reservation = Reservation::Where('user_id', $user->id)->first();
        $flight = Flight::find($reservation->flight_id);
     
        $response = $this->json('POST', 'api/flights', $flight->toArray());

        $response->assertStatus(201);
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertTrue(count($response->decodeResponseJson(['data'])) > 0);
    }

    /** @test */
    public function can_update_flight()
    {
        $user = factory(User::class)->create();
        $reservation = Reservation::Where('user_id', $user->id)->first();
        $flight = Flight::find($reservation->flight_id);

        $flight->flight_number = 999;

        $response = $this->json('PUT','api/flights/' . $flight->id, $flight->toArray());

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $response->assertJson(['data' => $flight->toArray()]);
    }

    /** @test */
    public function can_patch_flight()
    {
        $user = factory(User::class)->create();
        $reservation = Reservation::Where('user_id', $user->id)->first();
        $flight = Flight::find($reservation->flight_id);

        $response = $this->patchJson('api/flights/' . $flight->id, [
            'flight_number' => 777
        ]);

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());

        $this->assertTrue($response->decodeResponseJson('data')['flight_number'] === 777);
    }

    /** @test */
    public function can_delete_fight()
    {
        $user = factory(User::class)->create();
        $reservation = Reservation::Where('user_id', $user->id)->first();
        $flight = Flight::find($reservation->flight_id);

        $response = $this->deleteJson('api/flights/' . $flight->id);

        $response->assertOk();

        $response->assertJson(['data' => 'Resource has been deleted']);

    }
}
