<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
  "prefix" => "auth",
  "namespace" => "Auth"], function(){

  Route::post('login', 'AuthenticationController@loginWithCredentials');

});

/**
 * API Routes
 */
Route::group([
  "prefix" => "api/v1",
  "namespace" => "Apiv1"], function(){

  // Letters
  Route::get('letters', 'LettersController@index');
  Route::get('letters/{id}', 'LettersController@show');
  Route::put('letters/{id}', 'LettersController@update');
  Route::patch('letters/{id}', 'LettersController@update');
  Route::post('letters/{id}', 'LettersController@attach');

  // Root Tags
  Route::get('roots/tags', 'RootTagsController@index');
  Route::post('roots/tags', 'RootTagsController@store');
  Route::get('roots/tags/{id}', 'RootTagsController@show');
  Route::put('roots/tags/{id}', 'RootTagsController@update');
  Route::patch('roots/tags/{id}', 'RootTagsController@update');
  Route::delete('roots/tags/{id}', 'RootTagsController@destroy');

  // Roots
  Route::get('roots', 'RootsController@index');
  Route::post('roots', 'RootsController@store');
  Route::get('roots/{id}', 'RootsController@show');
  Route::put('roots/{id}', 'RootsController@update');
  Route::patch('roots/{id}', 'RootsController@update');
  Route::delete('roots/{id}', 'RootsController@destroy');

  // Etymologies
  Route::get('etymologies', 'EtymologiesController@index');
  Route::post('etymologies', 'EtymologiesController@store');
  Route::get('etymologies/{id}', 'EtymologiesController@show');
  Route::put('etymologies/{id}', 'EtymologiesController@update');
  Route::patch('etymologies/{id}', 'EtymologiesController@update');
  Route::delete('etymologies/{id}', 'EtymologiesController@destroy');

  // Cognates
  Route::get('cognates', 'CognatesController@index');
  Route::post('cognates', 'CognatesController@store');
  Route::get('cognates/{id}', 'CognatesController@show');
  Route::put('cognates/{id}', 'CognatesController@update');
  Route::patch('cognates/{id}', 'CognatesController@update');
  Route::delete('cognates/{id}', 'CognatesController@destroy');

  // Lemmas
  // Route::get('lemmas', 'LemmasController@index');
  Route::get('lemmas/{id}', 'LemmasController@show');

  // Definitions
  // Route::get('definitions', 'DefinitionsController@index');
  Route::get('definitions/{id}', 'DefinitionsController@show');

  Route::get('/', function(){
    return response('BHAL API: The Biblical Hebrew and Aramaic Lexicon API.', 200);
  });
});
