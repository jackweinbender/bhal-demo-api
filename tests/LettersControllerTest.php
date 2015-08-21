<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LettersControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** Testing GET routes **/
    public function testGetRoutes()
    {
        $this->get('/api/v1/letters')
            ->seeJson();
        $this->get('/api/v1/letters/1')
            ->seeJson();
    }

    /** Testing PATCH routes **/
    public function testPatchRouteWithoutPayload()
    {
      $this->patch('/api/v1/letters/2')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithoutType()
    {
      $payload['data'] = 'wrong';

      $this->patch('/api/v1/letters/2', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithWrongType()
    {
      $payload['data']['type'] = 'wrong';

      $this->patch('/api/v1/letters/2', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithoutAttributes()
    {
      $payload['data']['type'] = 'letters';
      $this->patch('/api/v1/letters/2', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithPayload()
    {
      $payload['data']['type'] = 'letters';
      $payload['data']['attributes'] = array(
        "name" => "nameTest",
      );
      $this->patch('/api/v1/letters/2', $payload)
        ->seeJson();
    }
}
