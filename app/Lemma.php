<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lemma extends JsonApiModelAbstract
{
  public function letter(){

    return $this->belongsTo('App\Letter', 'letter_name', 'name');

  }

  public function definitions(){

    return $this->hasMany('App\Definition');

  }
}
