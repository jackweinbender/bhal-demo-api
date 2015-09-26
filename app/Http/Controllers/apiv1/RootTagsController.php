<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RootTag;
use Input;

class RootTagsController extends Apiv1Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = RootTag::get();
        return $this->res->collection($tags)->send();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        $tag = new RootTag;
        $tag->fill(Input::get('data.attributes'));
        $tag->save();

        return $this->res->item($tag)->send();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_numeric($id)){
          $tag = RootTag::with(['roots'])
            ->findOrFail($id);
        } else {
          $tag = RootTag::with(['roots'])
            ->where('name', $id)->firstOrFail();
        }

        return $this->res
          ->includes(['roots'])
          ->item($tag)->send();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Input::has('data')){
          return response('No Data Sent', 400);
        }
        if(!Input::has('data.type')){
          return response('No Type Specified', 400);
        }
        if(Input::get('data.type') != 'roottags'){
          return response('Wrong Type Specified', 400);
        }
        if(!Input::has('data.attributes')){
          return response('No Attributes sent', 400);
        }

        $attrs = Input::get('data.attributes');

        if(is_numeric($id)){
          $tag = RootTag::findOrFail($id);
        } else {
          $tag = RootTag::where('name', $id)->firstOrFail();
        }

        $tag->fill($attrs);
        $tag->save();

        return $this->res->item($tag)->send();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_numeric($id)){
          $root = RootTag::where('id', $id)->first();
        } else {
          $root = RootTag::find($id);
        }

        if($root){
          $root->delete();
          return response(['message'=>"Successfully deleted RootTag with id $id"], 200);
        }

        return response(['message'=>"Unable to delete RootTag with id $id"], 400);
    }
}
