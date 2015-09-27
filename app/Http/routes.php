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
  Route::put('letters/{id}', [
    'middleware' => 'apiValidation:letters',
    'uses' =>'LettersController@update',
    ]);
  Route::patch('letters/{id}', [
    'middleware' => 'apiValidation:letters',
    'uses' =>'LettersController@update',
    ]);

  // Root Tags
  Route::get('roots/tags', 'RootTagsController@index');
  Route::get('roots/tags/{id}', 'RootTagsController@show');
  Route::post('roots/tags', [
    'middleware' => 'apiValidation:roottags',
    'uses' => 'RootTagsController@store',
  ]);
  Route::put('roots/tags/{id}', [
    'middleware' => 'apiValidation:roottags',
    'uses' => 'RootTagsController@update',
  ]);
  Route::patch('roots/tags/{id}', [
    'middleware' => 'apiValidation:roottags',
    'uses' => 'RootTagsController@update',
  ]);
  Route::delete('roots/tags/{id}', 'RootTagsController@destroy');

  // Roots
  Route::get('roots', 'RootsController@index');
  Route::get('roots/{id}', 'RootsController@show');
  Route::post('roots', [
    'middleware' => 'apiValidation:roots',
    'uses' => 'RootsController@store',
    ]);
  Route::put('roots/{id}', [
    'middleware' => 'apiValidation:roots',
    'uses' => 'RootsController@update',
  ]);
  Route::patch('roots/{id}', [
    'middleware' => 'apiValidation:roots',
    'uses' => 'RootsController@update',
  ]);
  Route::delete('roots/{id}', 'RootsController@destroy');

  // Etymologies
  Route::get('etymologies', 'EtymologiesController@index');
  Route::get('etymologies/{id}', 'EtymologiesController@show');
  Route::put('etymologies/{id}', [
    'middleware' => 'apiValidation:etymologies',
    'uses' => 'EtymologiesController@update',
  ]);
  Route::patch('etymologies/{id}', [
    'middleware' => 'apiValidation:etymologies',
    'uses' => 'EtymologiesController@update',
  ]);

  // Cognates
  Route::get('cognates', 'CognatesController@index');
  Route::get('cognates/{id}', 'CognatesController@show');
  Route::post('cognates', [
    'middleware' => 'apiValidation:cognates',
    'uses' => 'CognatesController@store',
  ]);
  Route::put('cognates/{id}', [
    'middleware' => 'apiValidation:cognates',
    'uses' => 'CognatesController@update',
  ]);
  Route::patch('cognates/{id}', [
    'middleware' => 'apiValidation:cognates',
    'uses' => 'CognatesController@update',
  ]);
  Route::delete('cognates/{id}', 'CognatesController@destroy');

  // Lemmas
  // Route::get('lemmas', 'LemmasController@index');
  // Route::get('lemmas/{id}', 'LemmasController@show');

  // Definitions
  // Route::get('definitions', 'DefinitionsController@index');
  // Route::get('definitions/{id}', 'DefinitionsController@show');

  Route::get('/', function(){
    return response('BHAL API: The Biblical Hebrew and Aramaic Lexicon API.', 200);
  });
});
