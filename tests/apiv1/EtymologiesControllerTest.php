<?php

use App\Root;
use App\Etymology;

class EtymologiesControllerTest extends ApiTestCase
{

    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      $root = factory(Root::class)->create();
      $etymology = factory(Etymology::class)->make();
      $root->etymology()->save($etymology);

      $this->get('/api/v1/etymologies')
          ->seeJson()
          ->assertResponseOK();
      $this->get('/api/v1/etymologies/' . $etymology->id)
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
      $payload['data'] = ['type' => 'etymologys'];

      $this->put('/api/v1/etymologies/123', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $root = factory(Root::class)->create();
      $etymology = factory(Etymology::class)->make();
      $root->etymology()->save($etymology);

      $payload['data'] = $etymology->resourceObject();

      $this->put('/api/v1/etymologies/' . $etymology->id, $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Testing PATCH routes **/
    public function testPatchRouteWithPayload()
    {
      $root = factory(Root::class)->create();
      $etymology = factory(Etymology::class)->make();
      $root->etymology()->save($etymology);

      $payload['data'] = $etymology->resourceObject();

      $this->patch('/api/v1/etymologies/' . $etymology->id, $payload)
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
      $etymology = factory(Etymology::class)->make();

      $payload['data'] = $etymology->resourceObject();
      $payload['data']['relationships']['root']['data'] = $root->rid();

      $this->post('/api/v1/etymologies', $payload)
        ->seeJson()
        ->assertResponseOK();
    }
    /** Test DELETE route **/
    public function testDeleteRoute()
    {
      $root = factory(Root::class)->create();
      $etymology = factory(Etymology::class)->make();
      $root->etymology()->save($etymology);

      $this->delete('/api/v1/etymologies/' . $etymology->id)
        ->seeJson(['message'=>"Successfully deleted root with id " . $etymology->id])
        ->assertResponseOK();
    }
    public function testDeleteRouteWithBadId()
    {
      $this->delete('/api/v1/etymologies/randombadid')
        ->seeJson(['message'=>"Unable to delete Etymology with id randombadid"])
        ->assertResponseStatus(400);
    }

}
