<?php

namespace Tests\Feature;

use App\Model\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservationAPITest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function can_list_reservations()
    {
        factory(Reservation::class)->create();

        $response = $this->get('api/reservations');

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertTrue(count($response->decodeResponseJson('data')) > 0);
    }

    /** @test */
    public function can_view_reservation()
    {
        $reservation = factory(Reservation::class)->create();

        $response = $this->get('api/reservations/' . $reservation->id);

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertTrue(count($response->decodeResponseJson('data')) > 0);
    }

    /** @test */
    public function can_store_reservation()
    {
        $reservation = factory(Reservation::class)->make();

        $response = $this->postJson('api/reservations', $reservation->toArray());

        $response->assertStatus(201);
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertTrue(count($response->decodeResponseJson()['data']) > 0);

    }

    /** @test */
    public function can_update_reservation()
    {
        $reservation = factory(Reservation::class)->create();

        $new_reservation = factory(Reservation::class)->create([
            'status' => 'cancelled'
        ]);

        $response = $this->putJson('api/reservations/' . $reservation->id, $reservation->toArray());

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $response->assertJsonMissingExact( $new_reservation->toArray());
    }


    /** @test */
    public function can_patch_reservation()
    {
        $reservation = factory(Reservation::class)->create();

        $response = $this->putJson('api/reservations/' . $reservation->id, [
            'passenger_name' => 'Cj Galindo'
        ]);

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertEquals('Cj Galindo', $response->decodeResponseJson('data')['passenger_name']);
    }

    /** @test */
    public function can_delete_reservation()
    {
        $reservation = factory(Reservation::class)->create();

        $response = $this->deleteJson('api/reservations/' . $reservation->id);
        $response->assertOk();
        $response->assertJson(['data' => 'Resource has been deleted']);
    }




}
