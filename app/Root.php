<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class Root extends JsonApiModelAbstract
{

    protected $fillable = ['root', 'rootSlug', 'homonymNumber', 'rootDisplay'];

    public function letter(){

      return $this->belongsTo('App\Letter', 'letter_name', 'name');

    }

    public function attributes(){
      return array(
        'root' => (string) $this->root,
        'root-slug' => (string) $this->rootSlug,
        'homonym-number' => (integer) $this->homonymNumber,
        'root-display' => (string) $this->rootDisplay,
      );
    }

}
