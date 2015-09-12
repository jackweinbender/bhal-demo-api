<?php

namespace App;

use Jackweinbender\LaravelJsonapi\JsonApiModelAbstract;
use Jackweinbender\LaravelJsonapi\JsonApi;

class Root extends JsonApiModelAbstract
{

    protected $fillable = ['root', 'homonym_number', 'display', 'basic_definition', 'historical_root'];
    protected $modelId = 'root_slug';


    public function letter(){

      return $this->belongsTo('App\Letter', 'letter_id', 'id');

    }

    public function etymology(){

      return $this->hasOne('App\Etymology', 'root_id', 'id');

    }

    public function attributes(){
      return array(
        'root' => (string) $this->root,
        'historical_root' => (string) $this->historical_root,
        'root_slug' => (string) $this->root_slug,
        'homonym_number' => (integer) $this->homonym_number,
        'display' => (string) $this->display,
        'basic_definition' => (string) $this->basic_definition
      );
    }

    public static function boot()
        {
            parent::boot();
            // Do this on every save (create/update)
            static::saving(function($root){
              if($root->homonym_number != 0 && $root->display != ""){
                $root->root_slug = $root->display . "-" . $root->homonym_number;
              } else {
                $root->root_slug = $root->display;
              }
            });

        }

}
