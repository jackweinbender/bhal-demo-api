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
            // Do this on every create
            static::created(function($root){
              // Make and Attach a new Etymology record.
              // This is a 1-1 relationship.
              $ety = new Etymology;
              $root->etymology()->save($ety);
            });

            // Do this on every save (create or update)
            static::saving(function($root){
              // Make sure that roots w/o homonyms don't use
              // dasherized root_slugs
              if($root->homonym_number != 0 && $root->display != ""){
                $root->root_slug = $root->display . "-" . $root->homonym_number;
              } else {
                $root->root_slug = $root->display;
              }
            });

        }

}
