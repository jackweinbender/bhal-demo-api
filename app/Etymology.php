<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class Etymology extends JsonApiModelAbstract
{

  protected $fillable = ['discussion', 'literature', 'root_id'];

  public function root(){

    return $this->belongsTo('App\Root');

  }

  public function attributes(){
    return array(
      'discussion' => (string) $this->discussion,
      'literature' => (string) $this->literature,
    );
  }

}
