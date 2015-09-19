<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Cognate;
use App\Root;

class CognatesController extends Apiv1Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $input = Input::get('filter');
      if(!$input){

        $cognates = Cognate::get();
        return $this->res->collection($cognates)->send();
      }

      $cognates = Cognate::find(explode(',', $input['id']));
      return $this->res->collection($cognates)->send();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      if(!Input::has('data')){
        return response('No Data Sent', 400);
      }
      if(!Input::has('data.type')){
        return response('No Type Specified', 400);
      }
      if(!Input::has('data.attributes')){
        return response('No Attributes sent', 400);
      }
      if(!Input::has('data.relationships.root')){
        return response('No Relationship sent', 400);
      }
      if(!Input::has('data.relationships.root.data.id')){
        return response('No ID sent', 400);
      }


      $root_id = Input::get('data.relationships.root.data.id');

      if(is_numeric($root_id)){
        $root = Root::findOrFail($root_id);
      } else {
        $root = Root::where('root_slug', $root_id)->firstOrFail();
      }

      $cognate = new Cognate;
      $cognate->fill(Input::get('data.attributes'));

      $root->cognates()->save($cognate);
      $cognate->root;

      return $this->res->item($cognate)->send();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $cognate = Cognate::findOrFail($id);

      return $this->res->item($cognate)->send();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
     public function update(Request $request, $id)
     {
       // Validation
       if(!Input::has('data') || Input::get('data') == []){
         return response('No Data Sent', 400);
       }
       if(!Input::has('data.type')){
         return response('No Type Specified', 400);
       }
       if(Input::get('data.type') != 'cognates'){
         return response('Wrong Type Specified', 400);
       }
       if(!Input::has('data.attributes')){
         return response('No Attributes sent', 400);
       }

       // Setup
       $attrs = Input::get('data.attributes');

       // UPDATE
       if(is_numeric($id)){
         $cognate = Cognate::findOrFail($id);
       } else {
         $cognate = Cognate::where('slug', $id)->firstOrFail();
       }

       $cognate->fill($attrs);
       $cognate->save();

       return $this->res->item($cognate)->send();

     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return Response
      */
     public function destroy($id)
     {
         $cognate = Cognate::find($id);

         if($cognate){
           $cognate->delete();
           return response(['message'=>"Successfully deleted Cognate with id $id"], 200);
         }

         return response(['message'=>"Unable to delete Cognate with id $id"], 400);
     }
}
