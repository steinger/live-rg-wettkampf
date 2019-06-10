<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInput()
    {
      $response = $this->json('POST', '/api/event', ['name' => 'Test Event Import over API', 'ranking' => 1]);
      $response
        ->assertStatus(201)
        ->assertJson([
            'name' => 'Test Event Import over API',
        ]);
    }
}
