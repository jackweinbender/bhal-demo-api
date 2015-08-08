<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

/**
 * TODO: Includes and relationships
 */


class JsonApi
{
    public $data;

    public $included;

    public $meta;

    public function __construct(){



    }

    public function item($model){

      $this->data = $this->makeData($model);

      return $this;
    }

    public function collection(Collection $collection){

      $this->data = $collection->map(function($item){
        return $this->makeData($item);
      })->all();

      return $this;

    }

    public function included(){

    }

    public function send(){

    }

    protected function makeData($model){
      $item = array(
        'id' => $model->getKey(),
        'type' => $model->getModelType(),
        'attributes' => $model->attributes()
      );

      $relationships = $model->getAndMakeRelationships();

      if($relationships){ $item['relationships'] = $relationships; }

      return $item;

    }
}
