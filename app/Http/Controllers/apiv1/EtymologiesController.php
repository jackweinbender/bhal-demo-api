<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Etymology;
use App\Root;

class EtymologiesController extends Apiv1Controller
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

        $etymologies = Etymology::get();
        return $this->res->collection($etymologies)->send();
      }

      $etymologies = Etymology::find(explode(',', $input['id']));
      return $this->res->collection($etymologies)->send();
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

      $etymology = new Etymology;
      $etymology->fill(Input::get('data.attributes'));

      $root->etymology()->save($etymology);
      $etymology->root;

      return $this->res->item($etymology)->send();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $etymology = Etymology::findOrFail($id);

      return $this->res->item($etymology)->send();
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
       if(Input::get('data.type') != 'etymologys'){
         return response('Wrong Type Specified', 400);
       }
       if(!Input::has('data.attributes')){
         return response('No Attributes sent', 400);
       }

       // Setup
       $attrs = Input::get('data.attributes');

       // UPDATE
       if(is_numeric($id)){
         $etymology = Etymology::findOrFail($id);
       } else {
         $etymology = Etymology::where('transliteration', $id)->firstOrFail();
       }

       $etymology->fill($attrs);
       $etymology->save();

       return $this->res->item($etymology)->send();

     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return Response
      */
     public function destroy($id)
     {
         $etymology = Etymology::find($id);

         if($etymology){
           $etymology->delete();
           return response(['message'=>"Successfully deleted root with id $id"], 200);
         }

         return response(['message'=>"Unable to delete Etymology with id $id"], 400);
     }
}
