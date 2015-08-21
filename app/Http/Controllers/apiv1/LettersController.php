<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Letter;
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
      $letter = Letter::with(['roots'])->find($id);

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

        $attrs = Input::get('data.attributes');

        $letter = Letter::find($id);
          $letter->fill($attrs);
        $letter->save();

        return $this->res->item($letter)->send();

    }

}
