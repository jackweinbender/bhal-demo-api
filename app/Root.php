<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class Root extends JsonApiModelAbstract
{

    protected $fillable = ['root', 'slug', 'homonym', 'display'];

    public function letter(){

      return $this->belongsTo('App\Letter', 'letter_name', 'name');

    }

    public function attributes(){
      return array(
        'root' => (string) $this->root,
        'slug' => (string) $this->slug,
        'homonym' => (integer) $this->homonym,
        'display' => (string) $this->display,
      );
    }

    public static function boot()
        {
            parent::boot();
            // Do this on every save (create/update)
            static::saving(function($root){
              if($root->homonym != 0 && $root->display != ""){
                $root->slug = $root->display . "-" . $root->homonym;
              } else {
                $root->slug = $root->display;
              }
            });

        }

}
