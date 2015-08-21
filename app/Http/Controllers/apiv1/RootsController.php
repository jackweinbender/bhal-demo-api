<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Root;
use \Input;

class RootsController extends Apiv1Controller
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

        $roots = Root::get();
        return $this->res->collection($roots)->send();
      }

      $roots = Root::find(explode(',', $input['id']));
      return $this->res->collection($roots)->send();
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

        $root = new Root;
        $root->fill(Input::get('data.attributes'));
        $root->save();

        return $this->res->item($root)->send();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->res->item(Root::find($id))->send();
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
        if(!Input::has('data')){
          return response('No Data Sent', 400);
        }
        if(!Input::has('data.type')){
          return response('No Type Specified', 400);
        }
        if(Input::get('data.type') != 'roots'){
          return response('Wrong Type Specified', 400);
        }
        if(!Input::has('data.attributes')){
          return response('No Attributes sent', 400);
        }

        $attrs = Input::get('data.attributes');

        $root = Root::find($id);
          $root->fill($attrs);
        $root->save();

        return $this->res->item($root)->send();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $root = Root::find($id);
        if($root){
          $root->delete();
          return response(['message'=>"Successfully deleted root with id $id"], 200);
        }

        return response(['message'=>"Unable to delete Root with id $id"], 400);
    }
}