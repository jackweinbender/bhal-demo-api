<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class JsonApi extends Model
{
    // getFillable() // Fillable attributes
    // getKey() // Get PK value

    protected $included = array();

    public function relationships(){

      $relationships = $this->getRelations();

      if($relationships == []){ return false; }

      $rels = array();

      foreach ($relationships as $relName => $relValue) {
        if($relValue->isEmpty()){ continue; }
        $rels[$relName]['data'] = $this->makeRid($relValue);
        $this->included = array_merge($this->included, $this->getIncluded($relValue));
      }

      return $rels;
    }
    public function getIncluded($collection){
      return $collection->map(function($item, $key){
        return $item->toArray();
      })->toArray();
    }
    protected function makeRid($related){
      if(method_exists($related, 'each')){

        $rid = $related->map(function ($item, $key) {
            return array(
              'id' => $item->getKey(),
              'type' => $item->type
            );
        });

        return $rid->all();
      };

      return $related->toArray();

    }

    public function toArray(){

      $item = array(
          'id' => $this->getKey(),
          'type' => $this->type,
          'attributes' => $this->attributes(),
      );

      if($this->relationships() != false){
        $item['relationships'] = $this->relationships();
      }

      return $item;
    }

  public function JsonApize(){

    $jsonApi['data'] = $this->toArray();

    if($this->included != []){
      //dd($this->included);
      $jsonApi['included'] = $this->included;
    }

    return $jsonApi;

  }

}
