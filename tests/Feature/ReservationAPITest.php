<?php

namespace Tests\Feature;

use App\Model\Reservation;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservationAPITest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function can_list_reservations()
    {
        factory(User::class, 10)->create();

        $response = $this->get('api/reservations');

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertTrue(count($response->decodeResponseJson('data')) > 0);
    }

    /** @test */
    public function can_view_reservation()
    {
        $user = factory(User::class)->create();
        $reservation = Reservation::Where('user_id', $user->id)->first();

        $response = $this->get('api/reservations/' . $reservation->id);

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertTrue(count($response->decodeResponseJson('data')) > 0);
    }

    /** @test */
    public function can_store_reservation()
    {
        $user = factory(User::class)->create();
        $reservation_data = $user->Reservation()->first()->toArray();
        $user->Reservation()->first()->delete();
  
        $response = $this->postJson('api/reservations', $reservation_data);

        $response->assertStatus(201);
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertTrue(count($response->decodeResponseJson()['data']) > 0);

    }

    /** 
     * replace a reservation for another
     * @test */
    public function can_update_reservation()
    {
        $user = factory(User::class)->create();
        $reservation = Reservation::Where('user_id', $user->id)->first();

        $user = factory(User::class)->create();
        $new_reservation = Reservation::Where('user_id', $user->id)->first();
        $new_reservation->status = 'cancelled';
        
        $response = $this->putJson('api/reservations/' . $reservation->id, $reservation->toArray());

        $response->assertOk();
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $response->assertJsonMissingExact( $new_reservation->toArray());
    }


    /** @test */
    public function can_patch_reservation()
    {
        $user = factory(User::class)->create();
        $reservation = Reservation::Where('user_id', $user->id)->first();

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
        $user = factory(User::class)->create();
        $reservation = Reservation::Where('user_id', $user->id)->first();

        $response = $this->deleteJson('api/reservations/' . $reservation->id);
        $response->assertOk();
        $response->assertJson(['data' => 'Resource has been deleted']);
    }




}
