<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \ReflectionClass;

abstract class JsonApiModelAbstract extends Model implements JsonApiModelInterface
{

  /**
   * The 'type' property for the JSON API response object. According to
   * the spec, all objects need them. You can set this manually, or
   * use the sensible default of a lowercase version of the
   * class name in lowercase
   *
   * @var String
   */
  protected $modelType;

  /**
   * Returns attribute array from parent getAttribute function
   * Child class should override to include cast properties
   *
   * @return Array of attributes
   */
  public function attributes(){

    return $this->getAttributes();

  }

  public function getAndMakeRelationships(){
    if($this->getRelations() == []){ return false; }

    $relationships = [];

    foreach ($this->getRelations() as $relation => $related) {
      if($related->isEmpty()){ break; }
      $relationships[$relation] = $this->makeRidObjects($related);
    }

    if($relationships == []){ return false; }

    return $relationships;

  }

  protected function makeRidObjects($collection){

    return $collection->map(function($item){
      return array(
        'id' => $item->getKey(),
        'type' => $item->getModelType(),
      );
    })->all();

  }

  /**
   * Returns the modelType if already set, otherwise sets
   * the proerty and returns it
   *
   * @return String the class name as in lowercase
   */
  public function getModelType(){

    if(isset($this->modelType)){
      return $this->modelType;
    }

    return $this->setModelType();
  }

  /**
   * Sets the modelType property and returns its new value
   *
   * @return String the class name as in lowercase
   */
  protected function setModelType(){

    $this->modelType = $this->getClassName();

    return $this->modelType;

  }

  /**
   * Gets the class name via ReflectionClass::getShortName
   *
   * @return String the class name as in lowercase
   */
  protected function getClassName(){

    $modelClass = new ReflectionClass($this);

    return strtolower($modelClass->getShortName());
  }

}
