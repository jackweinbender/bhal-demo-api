<?php

use App\User;

class AuthenticationControllerTest extends ApiTestCase
{

  public function testLoginWithoutPayload()
  {
    $this->post('login')
      ->see('You must include both an email address and password')
      ->assertResponseStatus(400);
  }
  public function testLoginWithoutEmail()
  {
    $payload['password'] = 'password';

    $this->post('login', $payload)
      ->see('You must include both an email address and password')
      ->assertResponseStatus(400);
  }
  public function testLoginWithoutPassword()
  {
    $payload['email'] = 'email@email.com';

    $this->post('login', $payload)
      ->see('You must include both an email address and password')
      ->assertResponseStatus(400);
  }
  public function testLoginWithBadEmail()
  {
    $user = factory(User::class)->make();

    $payload = array(
      'email' => 'wrong@wrong.com',
      'password' => $user->password,
    );

    $user->save();

    $this->post('login', $payload)
      ->see('Incorrect Email or Password')
      ->assertResponseStatus(400);
  }
  public function testLoginWithBadPassword()
  {
    $user = factory(User::class)->make();

    $payload = array(
      'email' => $user->email,
      'password' => 'badPassword',
    );

    $user->save();

    $this->post('login', $payload)
      ->see('Incorrect Email or Password')
      ->assertResponseStatus(400);
  }
  public function testLoginWithCredentialsWithPayload()
  {
    $user = factory(User::class)->make();

    $payload = array(
      'email' => $user->email,
      'password' => 'password',
    );

    $user->save();

    $this->post('login', $payload)
      ->see('Logged In Response')
      ->assertResponseOK();
  }
}
