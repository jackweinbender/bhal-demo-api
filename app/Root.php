<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Root extends Model
{
    public function letter(){

      return $this->belongsTo('App\Letter', 'letter_name', 'name');

    }
}
