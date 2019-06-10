<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResultApiTest extends TestCase
{
    /**
    * A basic test example.
    *
    * @return void
    */
    public function testInput()
    {
      $response = $this->json('POST', '/api/result',
        [ 'rgid' => 505001,
          'apparatus_short' => 'RF',
          'startno' => 999,
          'name' => 'Test API',
          'category' => 'P6',
          'competition_type' => 'MK',
          'apparatus' => 'Reif',
          'f_score' => 22.8,
          'd_score' => '10.000',
          'e_score' => '11.950',
          'penalty' => 'Abzug:-0.150'
        ]);
      $response
       ->assertStatus(201)
       ->assertJson([
           'rgid' => 505001,
       ]);
    }
}
