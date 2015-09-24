<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class RootTag extends JsonApiModelAbstract
{
  protected $fillable = ['name'];
  protected $modelId = 'root_tag';


  public function roots(){

    return $this->belongsToMany('App\Root');

  }

  public function attributes(){
    return array(
      "name" => $this->name,
    );
  }
}