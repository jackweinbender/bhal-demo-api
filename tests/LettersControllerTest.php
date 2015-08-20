<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LettersControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** Testing GET routes **/
    public function testGetRoutes()
    {
        $this->get('/api/v1/letters')
            ->seeJson();
        $this->get('/api/v1/letters/1')
            ->seeJson();
    }
}
