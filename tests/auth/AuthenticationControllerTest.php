<?php

use App\Letter;

class AuthenticationControllerTest extends ApiTestCase
{

  public function testLoginWithCredentialsWithoutPayload()
  {
    $this->post('auth/login')
      ->see('No Payload Provided')
      ->assertResponseStatus(400);
  }
  public function testLoginWithCredentialsWithPayload()
  {
    $this->post('auth/login', $this->getUserPayload())
      ->see('Logged In Response')
      ->assertResponseOK();
  }

  /**
   * Pirate functions
   */
  private function getUserAttributes(){
    return array(
      'email' => $this->fake->email,
      'password' => $this->fake->password,
    );
  }

  private function getUserPayload(){
    return array(
      "data" => $this->getUserAttributes(),
    );
  }
}
