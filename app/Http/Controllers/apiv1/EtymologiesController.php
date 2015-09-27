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
}
