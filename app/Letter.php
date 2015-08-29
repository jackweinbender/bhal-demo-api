<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class Letter extends JsonApiModelAbstract
{

    protected $hidden = array(
      'id',
      'created_at',
      'updated_at'
    );

    protected $fillable = ['letter', 'name', 'transliteration', 'asciitranslit'];
    protected $primaryKey = 'transliteration';
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

    public function attributes(){
      return array(
        'letter' => (string) $this->letter,
        'name' => (string) $this->name,
        'transliteration' => (string) $this->transliteration,
        'asciitranslit' => (string) $this->asciitranslit,
      );
    }
}
