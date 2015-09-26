<?php

use App\RootTag;

class RootTagsControllerTest extends ApiTestCase
{

    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      $root = factory(RootTag::class)->create();

      $this->get('/api/v1/roots/tags')
          ->seeJson()
          ->assertResponseOK();
      $this->get('/api/v1/roots/tags/' . $root->id)
          ->seeJson()
          ->assertResponseOK();
    }

    /** Testing PUT routes **/
    // public function testPutRouteWithoutPayload()
    // {
    //   $root = factory(Root::class)->create();
    //
    //   $this->put('/api/v1/roots/' . $root->id)
    //     ->see('No Data Sent')
    //     ->assertResponseStatus(400);
    // }
    // public function testPutRouteWithoutType()
    // {
    //   $root = factory(Root::class)->create();
    //   $payload['data'] = 'wrong';
    //
    //   $this->put('/api/v1/roots/' . $root->id, $payload)
    //     ->see('No Type Specified')
    //     ->assertResponseStatus(400);
    // }
    // public function testPutRouteWithWrongType()
    // {
    //   $root = factory(Root::class)->create();
    //
    //   $payload['data'] = $root->resourceObject();
    //   $payload['data']['type'] = 'wrong';
    //
    //   $this->put('/api/v1/roots/' . $root->id, $payload)
    //     ->see('Wrong Type Specified')
    //     ->assertResponseStatus(400);
    // }
    // public function testPutRouteWithouAttributes()
    // {
    //   $root = factory(Root::class)->create();
    //
    //   $payload['data'] = $root->resourceObject();
    //   unset($payload['data']['attributes']);
    //
    //   $this->put('/api/v1/roots/' . $root->id, $payload)
    //     ->see('No Attributes sent')
    //     ->assertResponseStatus(400);
    // }
    // public function testPutRouteWithPayload()
    // {
    //   $root = factory(Root::class)->create();
    //
    //   $payload['data'] = $root->resourceObject();
    //
    //   $this->put('/api/v1/roots/' . $root->id, $payload)
    //     ->seeJson()
    //     ->assertResponseOK();
    // }

    /** Testing PATCH routes **/

    // public function testPatchRouteWithPayload()
    // {
    //   $root = factory(Root::class)->create();
    //
    //   $payload['data'] = $root->resourceObject();
    //
    //   $this->patch('/api/v1/roots/' . $root->id, $payload)
    //     ->seeJson()
    //     ->assertResponseOK();
    // }

    /** Test POST routes **/
    // public function testPostRouteWithoutPayload()
    // {
    //   $this->post('/api/v1/roots')
    //     ->assertResponseStatus(400);
    // }
    // public function testPostRouteWithPayload()
    // {
    //   $root = factory(Root::class)->make();
    //
    //   $payload['data'] = $root->resourceObject();
    //
    //   $this->post('/api/v1/roots', $payload)
    //     ->seeJson()
    //     ->assertResponseOK();
    // }
    /** Test DELETE route **/
    // public function testDeleteRoute()
    // {
    //   $root = factory(Root::class)->create();
    //
    //   $this->delete('/api/v1/roots/' . $root->id)
    //     ->seeJson(['message'=>"Successfully deleted Root with id " . $root->id])
    //     ->assertResponseOK();
    // }
    // public function testDeleteRouteWithBadId()
    // {
    //   $this->delete('/api/v1/roots/randombadid')
    //     ->seeJson(['message'=>"Unable to delete Root with id randombadid"])
    //     ->assertResponseStatus(400);
    // }

}
