<?php

use App\Root;
use App\Cognate;

class CognatesControllerTest extends ApiTestCase
{

    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      $root = factory(Root::class)->create();
      $cognates = $root->cognates;
      $this->get('/api/v1/cognates')
          ->seeJson()
          ->assertResponseOK();
      $cognates->each(function($cognate){
        $this->get('/api/v1/cognates/' . $cognate->id)
            ->seeJson()
            ->assertResponseOK();
      });
    }

    /** Testing PUT routes **/
    public function testPutRouteWithoutPayload()
    {

      $this->put('/api/v1/cognates/123')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutType()
    {
      $payload['data'] = 'wrong';

      $this->put('/api/v1/cognates/123', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithWrongType()
    {
      $payload['data']['type'] = 'wrong';

      $this->put('/api/v1/cognates/123', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithouAttributes()
    {
      $payload['data']['type'] = 'cognates';

      $this->put('/api/v1/cognates/123', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $root = factory(Root::class)->create();
      $cognates = $root->cognates;

      $cognates->each(function($cognate){
        $payload['data'] = $cognate->resourceObject();
        $this->put('/api/v1/cognates/' . $cognate->id, $payload)
          ->seeJson()
          ->assertResponseOK();
      });
    }

    /** Testing PATCH routes **/
    public function testPatchRouteWithPayload()
    {
      $root = factory(Root::class)->create();
      $cognates = $root->cognates;

      $cognates->each(function($cognate){
        $payload['data'] = $cognate->resourceObject();
        $this->patch('/api/v1/cognates/' . $cognate->id, $payload)
          ->seeJson()
          ->assertResponseOK();
      });
    }

    /** Test POST routes **/
    public function testPostRouteWithoutPayload()
    {
      $this->post('/api/v1/cognates')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPostRouteWithoutType()
    {
      $payload['data'] = 'wrong';

      $this->post('/api/v1/cognates', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPostRouteWithWrongType()
    {
      $payload['data']['type'] = 'wrong';

      $this->post('/api/v1/cognates', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPostRouteWithouAttributes()
    {
      $payload['data']['type'] = 'cognates';

      $this->post('/api/v1/cognates', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPostRouteWithPayload()
    {
      $root = factory(Root::class)->create();
      $cognates = $root->cognates;

      $cognates->each(function($cognate){
        $payload['data'] = $cognate->resourceObject();
        $payload['data']['relationships']['root']['data'] = $cognate->root->rid();

        $this->post('/api/v1/cognates', $payload)
          ->seeJson()
          ->assertResponseOK();
      });
    }
    
    /** Test DELETE route **/
    public function testDeleteRoute()
    {
      $root = factory(Root::class)->create();
      $cognates = $root->cognates;

      $cognates->each(function($cognate){
        $this->delete('/api/v1/cognates/' . $cognate->id)
          ->seeJson(['message'=>"Successfully deleted Cognate with id " . $cognate->id])
          ->assertResponseOK();
      });
    }
    public function testDeleteRouteWithBadId()
    {
      $this->delete('/api/v1/cognates/randombadid')
        ->seeJson(['message'=>"Unable to delete Cognate with id randombadid"])
        ->assertResponseStatus(400);
    }

}
