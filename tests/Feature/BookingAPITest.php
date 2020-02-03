<?php

namespace Tests\Feature;

use App\User;
use App\Model\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingAPITest extends TestCase
{
    /** @test */
    public function can_store_new_booking()
    {
        $this->get('booking');

        $booking = factory(Booking::class)->make()->toArray();

        $response = $this->json('POST', '/api/booking', $booking);

        $response->assertStatus(201);
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertArrayHasKey('name', $response->decodeResponseJson('data'));
    }

    /** @test */
    public function can_update_booking()
    {
        $user = factory(User::class)->create();
        $booking = $user->Booking()->first()->toArray();

        $response = $this->put('/api/booking/' . $booking['id'], array_merge($booking, [
            'name' => 'Cj Galindo'
        ]));

        $response->assertStatus(200);
        $this->assertIsArray($response->decodeResponseJson());
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
        $this->assertArrayHasKey('name', $response->decodeResponseJson('data'));
        $this->assertEquals('Cj Galindo', $response->decodeResponseJson('data')['name']);
    }

    /** @test */
    public function can_patch_booking()
    {
       $booking = factory(Booking::class)->create();

       $response = $this->patch('/api/booking/' . $booking->id,  ['name' => 'Cj Galindo']);

       $response->assertStatus(200);
       $this->assertIsArray($response->decodeResponseJson());
       $this->assertArrayHasKey('data', $response->decodeResponseJson());
       $this->assertArrayHasKey('name', $response->decodeResponseJson('data'));
       $this->assertEquals('Cj Galindo', $response->decodeResponseJson('data')['name']);
    }

    /** @test */
    public function can_view_booking()
    {
        factory(Booking::class)->create();

        $response = $this->get('/api/booking');

        $response->assertStatus(200);
        $data = $response->decodeResponseJson();
        $this->assertArrayHasKey('data', $data);
        $this->assertTrue(count($data['data']) > 0);
    }

    /** @test */
    public function can_delete_booking()
    {
        $booking = factory(Booking::class)->create();

        $response = $this->deleteJson('/api/booking/' . $booking->id);
        $response->assertJson(['data' => 'Resource has been deleted']);
    }
}
