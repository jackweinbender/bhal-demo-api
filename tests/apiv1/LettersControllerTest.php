<?php

use App\Letter;

class LettersControllerTest extends ApiTestCase
{
    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      $letter = factory(Letter::class)->create();

      $this->get('/api/v1/letters')
          ->seeJson()
          ->assertResponseOk();
      $this->get('/api/v1/letters/' . $letter->id)
          ->seeJson()
          ->assertResponseOk();
    }

    /** No POST routes for Letters **/

    /** Testing PUT routes **/
    public function testPutRouteWithoutPayload()
    {
      $letter = factory(Letter::class)->create();

      $this->put('/api/v1/letters/' . $letter->id)
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithEmptyPayload()
    {
      $letter = factory(Letter::class)->create();

      $this->put('/api/v1/letters/' . $letter->id, [])
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutType()
    {
      $letter = factory(Letter::class)->create();

      $payload['data'] = $letter->resourceObject();
      $payload['data'] = 'wrong';

      $this->put('/api/v1/letters/' . $letter->id, $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithWrongType()
    {
      $letter = factory(Letter::class)->create();

      $payload['data'] = $letter->resourceObject();
      $payload['data']['type'] = 'wrong';

      $this->put('/api/v1/letters/' . $letter->id, $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutAttributes()
    {
      $letter = factory(Letter::class)->create();

      $payload['data'] = $letter->resourceObject();
      unset($payload['data']['attributes']);

      $this->put('/api/v1/letters/' . $letter->id, $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $letter = factory(Letter::class)->create();

      $payload['data'] = $letter->resourceObject();

      $this->put('/api/v1/letters/' . $letter->id, $payload)
        ->seeJson()
        ->assertResponseOk();
    }
    /**
     * Testing PATCH routes
     * Both PATCH and PUT refere to the same Controller
     * function, so I've only included the one test for the
     * PATCH route (to make sure the Route is configured properly).
     * Otherwise, the PUT fucntionality os fully tested above.
     */
    public function testPatchRouteWithPayload()
    {
      $letter = factory(Letter::class)->create();

      $payload['data'] = $letter->resourceObject();

      $this->patch('/api/v1/letters/' . $letter->id, $payload)
        ->seeJson()
        ->assertResponseOk();
    }

}
