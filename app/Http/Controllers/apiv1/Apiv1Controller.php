<?php

namespace App\Http\Controllers\Apiv1;

use App\Http\Controllers\Controller;
use Jackweinbender\LaravelJsonapi\JsonApi;

abstract class Apiv1Controller extends Controller
{
    /**
     * Constructor method; injects JsonApi into all controllers
     * @param JsonApi $jsonApi
     */
    public function __construct(JsonApi $jsonApi){

      $this->res = $jsonApi;

    }
}
