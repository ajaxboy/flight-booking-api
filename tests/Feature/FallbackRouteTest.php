<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FallbackRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function missing_api_routes_should_return_a_json_404()
    {
        //$this->withoutExceptionHandling();

        $response = $this->get('/api/booking/888888888');

        $response->assertStatus(404);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJson([
            'error' => 'Resource not found'
        ]);
    }
}
