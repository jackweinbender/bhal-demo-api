<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Faker\Factory as Faker;

class ApiTestCase extends TestCase
{

  use DatabaseTransactions;
  use DatabaseMigrations;

  protected $fake;

  public function __construct()
  {
    $this->fake = Faker::create();
  }

}
