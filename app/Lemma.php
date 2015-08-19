<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class Lemma extends JsonApiModelAbstract
{
  public function letter(){

    return $this->belongsTo('App\Letter', 'letter_name', 'name');

  }

  public function definitions(){

    return $this->hasMany('App\Definition');

  }
}
