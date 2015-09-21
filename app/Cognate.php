<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class cognate extends JsonApiModelAbstract
{
  protected $modelType = 'cognates';
  protected $fillable = ['name', 'abbr', 'slug', 'description'];

  public function root(){

    return $this->belongsTo('App\Root');

  }

  public function attributes(){
    return array(
      'slug' => (string) $this->slug,
      'name' => (string) $this->name,
      'abbr' => (string) $this->abbr,
      'description' => (string) $this->description,
    );
  }

}
