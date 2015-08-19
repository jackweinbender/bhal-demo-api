<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class Root extends JsonApiModelAbstract
{
    protected $type = 'root';
    protected $fillable = ['root', 'rootSlug', 'homonymNumber', 'rootDisplay'];

    public function letter(){

      return $this->belongsTo('App\Letter', 'letter_name', 'name');

    }

    public function attributes(){
      return array(
        'root' => (string) $this->root,
        'rootSlug' => (string) $this->rootSlug,
        'homonymNumber' => (integer) $this->homonymNumber,
        'rootDisplay' => (string) $this->rootDisplay,
      );
    }

}
