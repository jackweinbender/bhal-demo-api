<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Letter;
use App\Root;
use \Input;

class LettersController extends Apiv1Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      // Setup
      $letters = Letter::with('roots')->get();

      return $this->res->collection($letters)->send();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      if(is_numeric($id)){
        $letter = Letter::with(['roots'])->where('id', $id)->firstOrFail();
      } else {
        $letter = Letter::with(['roots'])->findOrFail($id);
      }

      return $this->res->includes(['roots'])->item($letter)->send();
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
      if(Input::get('data.type') != 'letters'){
        return response('Wrong Type Specified', 400);
      }
      if(!Input::has('data.attributes')){
        return response('No Attributes sent', 400);
      }

      // Setup
      $attrs = Input::get('data.attributes');

      // UPDATE
      if(is_numeric($id)){
        $letter = Letter::where('id', $id)->firstOrFail();
      } else {
        $letter = Letter::findOrFail($id);
      }

      $letter->fill($attrs);
      $letter->save();

      return $this->res->item($letter)->send();

    }

    /**
     * Attaches records to a given ($id) Letter model. POST payload needs
     * to include the 'id' and 'type' of the item to be attached to the Letter
     *
     * @param  Request $request
     * @param  String  $id
     * @return JSON of updated letter or bad response
     */
    public function attach(Request $request, $id){
      // Validation
      if(!Input::has('data') || Input::get('data') == []){
        return response('No Data Sent', 400);
      }
      if(!Input::has('data.id') || !Input::has('data.type')){
        return response('Post must include both "type" and "id."', 400);
      }

      // Setup
      $data = Input::get('data');
      $root = Root::find($data['id']);
      $letter = Letter::find($id);

      // The actual association
      $root->letter()->associate($letter)->save();

      // Need to refresh the model to include Roots
      $letter = Letter::with(['roots'])->find($id);

      return $this->res->item($letter)->send();

    }

}
