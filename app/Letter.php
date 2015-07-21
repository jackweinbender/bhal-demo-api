<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{

    /**
     * Letter hasMany Roots
     * @return App\Root
     */
    public function roots(){

      return $this->hasMany('App\Root', 'letter_name', 'name');

    }

    /**
     * Letter hasMany Lemmata
     * @return App\Lemma
     */
    public function lemmas(){

      return $this->hasMany('App\Lemma', 'letter_name', 'name');

    }
}
