<?php

class RootsControllerTest extends ApiTestCase
{

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
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutType()
    {
      $payload['data'] = 'wrong';

      $this->put('/api/v1/roots/1', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithWrongType()
    {
      $payload['data']['type'] = 'wrong';

      $this->put('/api/v1/roots/1', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithouAttributes()
    {
      $payload['data']['type'] = 'roots';
      $this->put('/api/v1/roots/1', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $payload['data']['type'] = 'roots';
      $payload['data']['attributes'] = array(
        "root" => "TST",
        "rootDisplay" => "tst",
        "homonymNumber" => 15,
      );
      $this->put('/api/v1/roots/1', $payload)
        ->seeJson();
    }

    /** Testing PATCH routes **/
    public function testPatchRouteWithoutPayload()
    {
      $this->patch('/api/v1/roots/1')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithoutType()
    {
      $payload['data'] = 'wrong';

      $this->patch('/api/v1/roots/1', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithWrongType()
    {
      $payload['data']['type'] = 'wrong';

      $this->patch('/api/v1/roots/1', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithouAttributes()
    {
      $payload['data']['type'] = 'roots';
      $this->patch('/api/v1/roots/1', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithPayload()
    {
      $payload['data']['type'] = 'roots';
      $payload['data']['attributes'] = array(
        "root" => "TST",
        "rootDisplay" => "tst",
        "homonymNumber" => 15,
      );
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
      $payload['data']['type'] = 'roots';
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
