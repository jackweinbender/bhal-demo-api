<?php

use App\Etymology;

class EtymologiesControllerTest extends ApiTestCase
{

    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      $this->makeEtymology();

      $this->get('/api/v1/etymologies')
          ->seeJson()
          ->assertResponseOK();
      $this->get('/api/v1/etymologies/1')
          ->seeJson()
          ->assertResponseOK();
    }

    /** Testing PUT routes **/
    public function testPutRouteWithoutPayload()
    {
      $this->makeEtymology();

      $this->put('/api/v1/etymologies/1')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutType()
    {
      $this->makeEtymology();
      $payload['data'] = 'wrong';

      $this->put('/api/v1/etymologies/1', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithWrongType()
    {
      $this->makeEtymology();
      $payload = $this->getPayload();
      $payload['data']['type'] = 'wrong';

      $this->put('/api/v1/etymologies/1', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithouAttributes()
    {
      $this->makeEtymology();
      $payload = $this->getPayload();
      unset($payload['data']['attributes']);

      $this->put('/api/v1/etymologies/1', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $this->makeEtymology();
      $payload = $this->getPayload();

      $this->put('/api/v1/etymologies/1', $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Testing PATCH routes **/
    public function testPatchRouteWithoutPayload()
    {
      $this->makeEtymology();

      $this->patch('/api/v1/etymologies/1')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithoutType()
    {
      $this->makeEtymology();
      $payload['data'] = 'wrong';

      $this->patch('/api/v1/etymologies/1', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithWrongType()
    {
      $this->makeEtymology();
      $payload = $this->getPayload();
      $payload['data']['type'] = 'wrong';

      $this->patch('/api/v1/etymologies/1', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithouAttributes()
    {
      $this->makeEtymology();
      $payload = $this->getPayload();
      unset($payload['data']['attributes']);

      $this->patch('/api/v1/etymologies/1', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPatchRouteWithPayload()
    {
      $this->makeEtymology();
      $payload = $this->getPayload();

      $this->patch('/api/v1/etymologies/1', $payload)
        ->seeJson()
        ->assertResponseOK();
    }

    /** Test POST routes **/
    public function testPostRouteWithoutPayload()
    {
      $this->post('/api/v1/etymologies')
        ->assertResponseStatus(400);
    }
    // public function testPostRouteWithPayload()
    // {
    //   $payload = $this->getPayload();
    //
    //   $this->post('/api/v1/etymologies', $payload)
    //     ->seeJson()
    //     ->assertResponseOK();
    // }
    // /** Test DELETE route **/
    // public function testDeleteRoute()
    // {
    //   $this->makeEtymology();
    //
    //   $this->delete('/api/v1/etymologies/1')
    //     ->seeJson(['message'=>"Successfully deleted root with id 1"])
    //     ->assertResponseOK();
    // }
    // public function testDeleteRouteWithBadId()
    // {
    //   $this->delete('/api/v1/etymologies/randombadid')
    //     ->seeJson(['message'=>"Unable to delete Root with id randombadid"])
    //     ->assertResponseStatus(400);
    // }

    /**
     * Pirate functions
     */

    /**
     * Adds a given number of Roots to the DB.
     *
     * @param  integer $i Number of Roots to be added, defaults to One
     * @return
     */
    protected function makeEtymology($i = 1){
      while ($i > 0) {
        $attrs = $this->getAttributes();
        Etymology::create($attrs);
        $i--;
      }
    }

    /**
     * Provides the class attributes via Faker
     * @return Array of attributes
     */
    protected function getAttributes(){
      return array(
        "discussion" => $this->fake->paragraph(3),
        "literature" => $this->fake->paragraph(2),
        "root_id" => 1,
      );
    }
    /**
     * Mocks a full payload object for Root
     * @return Array formatted for JSONAPI
     */
    protected function getPayload(){
      return array(
        "data" => array(
          "type" => "etymologys",
          "attributes" => $this->getAttributes(),
          "relationships" => array(
            "root" => array(
              "data" => array(
                "id" => "1"
              ),
            ),
          ),
        ),
      );
    }
}
