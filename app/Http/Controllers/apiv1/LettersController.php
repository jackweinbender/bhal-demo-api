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
        $letter = Letter::with(['roots'])->findOrFail($id);
      } else {
        $letter = Letter::with(['roots'])->where('transliteration', $id)->firstOrFail();
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
      // Setup
      $attrs = Input::get('data.attributes');

      // UPDATE
      if(is_numeric($id)){
        $letter = Letter::findOrFail($id);
      } else {
        $letter = Letter::where('transliteration', $id)->firstOrFail();
      }

      $letter->fill($attrs);
      $letter->save();

      return $this->res->item($letter)->send();

    }

}
