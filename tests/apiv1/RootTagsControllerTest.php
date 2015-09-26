<?php

use App\RootTag;

class RootTagsControllerTest extends ApiTestCase
{

    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      $tag = factory(RootTag::class)->create();

      $this->get('/api/v1/roots/tags')
          ->seeJson()
          ->assertResponseOK();
      $this->get('/api/v1/roots/tags/' . $tag->id)
          ->seeJson()
          ->assertResponseOK();
    }

    /** Testing PUT routes **/
    public function testPutRouteWithoutPayload()
    {
      $tag = factory(RootTag::class)->create();

      $this->put('/api/v1/roots/tags/' . $tag->id)
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutType()
    {
      $tag = factory(RootTag::class)->create();
      $payload['data'] = 'wrong';

      $this->put('/api/v1/roots/tags/' . $tag->id, $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithWrongType()
    {
      $tag = factory(RootTag::class)->create();

      $payload['data'] = $tag->resourceObject();
      $payload['data']['type'] = 'wrong';

      $this->put('/api/v1/roots/tags/' . $tag->id, $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithouAttributes()
    {
      $tag = factory(RootTag::class)->create();

      $payload['data'] = $tag->resourceObject();
      unset($payload['data']['attributes']);

      $this->put('/api/v1/roots/tags/' . $tag->id, $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $tag = factory(RootTag::class)->create();

      $payload['data'] = $tag->resourceObject();

      $this->put('/api/v1/roots/tags/' . $tag->id, $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Testing PATCH routes **/

    public function testPatchRouteWithPayload()
    {
      $tag = factory(RootTag::class)->create();

      $payload['data'] = $tag->resourceObject();

      $this->patch('/api/v1/roots/tags/' . $tag->id, $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Test POST routes **/
    public function testPostRouteWithoutPayload()
    {
      $this->post('/api/v1/roots/tags')
        ->assertResponseStatus(400);
    }
    public function testPostRouteWithPayload()
    {
      $tag = factory(RootTag::class)->make();

      $payload['data'] = $tag->resourceObject();

      $this->post('/api/v1/roots/tags', $payload)
        ->seeJson()
        ->assertResponseOK();
    }
    /** Test DELETE route **/
    public function testDeleteRoute()
    {
      $tag = factory(RootTag::class)->create();

      $this->delete('/api/v1/roots/tags/' . $tag->id)
        ->seeJson(['message'=>"Successfully deleted RootTag with id " . $tag->id])
        ->assertResponseOK();
    }
    public function testDeleteRouteWithBadId()
    {
      $this->delete('/api/v1/roots/tags/randombadid')
        ->seeJson(['message'=>"Unable to delete RootTag with id randombadid"])
        ->assertResponseStatus(400);
    }

}
