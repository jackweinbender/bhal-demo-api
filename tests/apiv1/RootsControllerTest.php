<?php

use App\Root;

class RootsControllerTest extends ApiTestCase
{

    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      $this->makeRoot();

      $this->get('/api/v1/roots')
          ->seeJson()
          ->assertResponseOK();
      $this->get('/api/v1/roots/1')
          ->seeJson()
          ->assertResponseOK();
    }

    /** Testing PUT routes **/
    public function testPutRouteWithoutPayload()
    {
      $this->makeRoot();

      $this->put('/api/v1/roots/1')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutType()
    {
      $this->makeRoot();
      $payload['data'] = 'wrong';

      $this->put('/api/v1/roots/1', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithWrongType()
    {
      $this->makeRoot();
      $payload = $this->getPayload();
      $payload['data']['type'] = 'wrong';

      $this->put('/api/v1/roots/1', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithouAttributes()
    {
      $this->makeRoot();
      $payload = $this->getPayload();
      unset($payload['data']['attributes']);

      $this->put('/api/v1/roots/1', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $this->makeRoot();
      $payload = $this->getPayload();

      $this->put('/api/v1/roots/1', $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Testing PATCH routes **/
    public function testPatchRouteWithoutPayload()
    {
      $this->makeRoot();

      $this->patch('/api/v1/roots/1')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithoutType()
    {
      $this->makeRoot();
      $payload['data'] = 'wrong';

      $this->patch('/api/v1/roots/1', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithWrongType()
    {
      $this->makeRoot();
      $payload = $this->getPayload();
      $payload['data']['type'] = 'wrong';

      $this->patch('/api/v1/roots/1', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithouAttributes()
    {
      $this->makeRoot();
      $payload = $this->getPayload();
      unset($payload['data']['attributes']);

      $this->patch('/api/v1/roots/1', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithPayload()
    {
      $this->makeRoot();
      $payload = $this->getPayload();

      $this->patch('/api/v1/roots/1', $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Test POST routes **/
    public function testPostRouteWithoutPayload()
    {
      $this->post('/api/v1/roots')
        ->assertResponseStatus(400);
    }
    public function testPostRouteWithPayload()
    {
      $payload = $this->getPayload();

      $this->post('/api/v1/roots', $payload)
        ->seeJson()
        ->assertResponseOK();
    }
    /** Test DELETE route **/
    public function testDeleteRoute()
    {
      $this->makeRoot();

      $this->delete('/api/v1/roots/1')
        ->seeJson(['message'=>"Successfully deleted root with id 1"])
        ->assertResponseOK();
    }
    public function testDeleteRouteWithBadId()
    {
      $this->delete('/api/v1/roots/randombadid')
        ->seeJson(['message'=>"Unable to delete Root with id randombadid"])
        ->assertResponseStatus(400);
    }

    /**
     * Pirate functions
     */

    /**
     * Adds a given number of Roots to the DB.
     *
     * @param  integer $i Number of Roots to be added, defaults to One
     * @return
     */
    protected function makeRoot($i = 1){
      while ($i > 0) {
        $attrs = $this->getAttributes();
        Root::create($attrs);
        $i--;
      }
    }

    /**
     * Provides the class attributes via Faker
     * @return Array of attributes
     */
    protected function getAttributes(){
      return array(
        "root" => $this->fake->word,
        "slug" => $this->fake->word,
        "display" => $this->fake->randomLetter,
        "homonym" => $this->fake->randomNumber([0,1,2]),
      );
    }
    /**
     * Mocks a full payload object for Root
     * @return Array formatted for JSONAPI
     */
    protected function getPayload(){
      return array(
        "data" => array(
          "type" => "roots",
          "attributes" => $this->getAttributes(),
        ),
      );
    }
}
