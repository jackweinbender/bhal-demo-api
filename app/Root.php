<?php

namespace App;

use App\JsonApi;

class Root extends JsonApi
{
    protected $type = 'root';

    public function letter(){

      return $this->belongsTo('App\Letter', 'letter_name', 'name');

    }

    protected function attributes(){
      return array(
        'root' => (string) $this->root,
        'rootSlug' => (string) $this->rootSlug,
        'homonymNumber' => (integer) $this->homonymNumber,
        'rootDisplay' => (string) $this->rootDisplay,
      );
    }

}
