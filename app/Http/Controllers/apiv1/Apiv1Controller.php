<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Jackweinbender\LaravelJsonapi\JsonApi;

abstract class Apiv1Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Constructor method; injects JsonApi into all controllers
     * @param JsonApi $jsonApi
     */
    public function __construct(JsonApi $jsonApi){

      $this->res = $jsonApi;

    }
}