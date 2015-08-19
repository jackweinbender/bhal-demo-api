<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RootsControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** Testing GET routes **/
    public function testGetRoutes()
    {
        $this->get('/api/v1/roots')
            ->seeJson();
        $this->get('/api/v1/roots/1')
            ->seeJson();
    }

    /** Testing PUT routes **/
    public function testPutRouteWithoutPayload()
    {
      $this->put('/api/v1/roots/1')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $payload['data']['attributes']['root'] = 'ROOT';
      $this->put('/api/v1/roots/1', $payload)
        ->seeJson();
    }

    /** Testing PATCH routes **/
    public function testPatchRouteWithoutPayload()
    {
      $this->patch('/api/v1/roots/1')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithPayload()
    {
      $payload['data']['attributes']['root'] = 'ROOT';
      $this->patch('/api/v1/roots/1', $payload)
        ->seeJson();
    }

    /** Test POST routes **/
    public function testPostRouteWithoutPayload()
    {
      $this->post('/api/v1/roots')
        ->assertResponseStatus(400);
    }
    public function testPostRouteWithPayload()
    {
      $payload['data']['type'] = 'root';
      $payload['data']['attributes'] = array(
        "root" => "TST",
        "rootDisplay" => "tst",
        "homonymNumber" => 15,
      );
      $this->post('/api/v1/roots', $payload)
        ->seeJson();
    }
    /** Test DELETE route **/
    public function testDeleteRoute()
    {
      $this->delete('/api/v1/roots/1')
        ->seeJson(['message'=>"Successfully deleted root with id 1"]);
    }
    public function testDeleteRouteWithBadId()
    {
      $this->delete('/api/v1/roots/randombadid')
        ->seeJson(['message'=>"Unable to delete Root with id randombadid"])
        ->assertResponseStatus(400);
    }
}
