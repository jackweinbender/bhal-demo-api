<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    public function roots(){

      return $this->hasMany('App\Root', 'letter_name', 'name');

    }
}
