<?php

use App\Letter;
use App\Root;

class LettersControllerTest extends ApiTestCase
{
    /** Testing GET routes **/
    public function testGetRoutesOK()
    {
      $this->makeLetter();

      $this->get('/api/v1/letters')
          ->seeJson()
          ->assertResponseOk();
      $this->get('/api/v1/letters/a')
          ->seeJson()
          ->assertResponseOk();
    }

    /** No POST routes for Letters **/

    /** Testing PUT routes **/
    public function testPutRouteWithoutPayload()
    {
      $this->makeLetter();

      $this->put('/api/v1/letters/a')
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithEmptyPayload()
    {
      $this->makeLetter();

      $this->put('/api/v1/letters/a', [])
        ->see('No Data Sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutType()
    {
      $this->makeLetter();

      $payload = $this->getPayload();
      $payload['data'] = 'wrong';

      $this->put('/api/v1/letters/a', $payload)
        ->see('No Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithWrongType()
    {
      $this->makeLetter();

      $payload = $this->getPayload();
      $payload['data']['type'] = 'wrong';

      $this->put('/api/v1/letters/a', $payload)
        ->see('Wrong Type Specified')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithoutAttributes()
    {
      $this->makeLetter();

      $payload = $this->getPayload();
      unset($payload['data']['attributes']);

      $this->put('/api/v1/letters/a', $payload)
        ->see('No Attributes sent')
        ->assertResponseStatus(400);
    }
    public function testPutRouteWithPayload()
    {
      $this->makeLetter();

      $this->put('/api/v1/letters/a', $this->getPayload())
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
      $this->makeLetter();

      $this->patch('/api/v1/letters/a', $this->getPayload())
        ->seeJson()
        ->assertResponseOk();
    }

    /**
     * Pirate functions
     */

    /**
     * Adds a given number of Letetrs to the DB.
     *
     * @param  integer $i Number of Letters to be added, defaults to One
     * @return
     */
    protected function makeLetter($i = 1){
      while ($i > 0) {
        $attrs = $this->getAttributes();
        Letter::create($attrs);
        $i--;
      }
    }

    /**
     * Provides the class attributes via Faker
     * @return Array of attributes
     */
    protected function getAttributes(){
      return array(
        "name" => $this->fake->word,
        "asciitranslit" => $this->fake->word,
        "letter" => $this->fake->randomLetter,
        "transliteration" => 'a',
      );
    }

    /**
     * Mocks a full payload object for Letter
     * @return Array formatted for JSONAPI
     */
    protected function getPayload(){
      return array(
        "data" => array(
          "type" => "letters",
          "attributes" => $this->getAttributes(),
        ),
      );
    }
}
