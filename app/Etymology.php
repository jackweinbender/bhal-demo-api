<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etymology extends Model
{

  //protected $fillable = [''];

  public function root(){

    return $this->belongsTo('App\Root');

  }

}