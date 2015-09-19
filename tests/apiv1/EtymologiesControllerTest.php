<?php

use App\Root;
use App\Etymology;

class EtymologiesControllerTest extends ApiTestCase
{

    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      // Etymologies are auto-created with Roots
      $root = factory(Root::class)->create();

      $this->get('/api/v1/etymologies')
          ->seeJson()
          ->assertResponseOK();
      $this->get('/api/v1/etymologies/' . $root->etymology->id)
          ->seeJson()
          ->assertResponseOK();
    }

    /** Testing PUT routes **/
    public function testPutRouteWithoutPayload()
    {

      $this->put('/api/v1/etymologies/123')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutType()
    {
      $payload['data'] = 'wrong';

      $this->put('/api/v1/etymologies/123', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithWrongType()
    {
      $payload['data']['type'] = 'wrong';

      $this->put('/api/v1/etymologies/123', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithouAttributes()
    {
      $payload['data'] = ['type' => 'etymologies'];

      $this->put('/api/v1/etymologies/123', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $root = factory(Root::class)->create();

      $payload['data'] = $root->etymology->resourceObject();

      $this->put('/api/v1/etymologies/' . $root->etymology->id, $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Testing PATCH routes **/
    public function testPatchRouteWithPayload()
    {
      $root = factory(Root::class)->create();

      $payload['data'] = $root->etymology->resourceObject();

      $this->patch('/api/v1/etymologies/' . $root->etymology->id, $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Test POST routes **/
    public function testPostRouteWithoutPayload()
    {
      $this->post('/api/v1/etymologies')
        ->assertResponseStatus(400);
    }
    public function testPostRouteWithPayload()
    {
      $root = factory(Root::class)->create();

      $payload['data'] = $root->etymology->resourceObject();
      $payload['data']['relationships']['root']['data'] = $root->rid();

      $this->post('/api/v1/etymologies', $payload)
        ->seeJson()
        ->assertResponseOK();
    }
    /** Test DELETE route **/
    public function testDeleteRoute()
    {
      $root = factory(Root::class)->create();

      $this->delete('/api/v1/etymologies/' . $root->etymology->id)
        ->seeJson(['message'=>"Successfully deleted Etymology with id " . $root->etymology->id])
        ->assertResponseOK();
    }
    public function testDeleteRouteWithBadId()
    {
      $this->delete('/api/v1/etymologies/randombadid')
        ->seeJson(['message'=>"Unable to delete Etymology with id randombadid"])
        ->assertResponseStatus(400);
    }

}
