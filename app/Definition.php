<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    public function lemma(){

      return belongsto('App\Lemma');

    }
}
