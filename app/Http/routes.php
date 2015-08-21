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

Route::group(["prefix" => "api/v1"], function(){

  // Letters
  Route::get('letters', 'LettersController@index');
  Route::get('letters/{id}', 'LettersController@show');
  Route::put('letters/{id}', 'LettersController@update');
  Route::patch('letters/{id}', 'LettersController@update');

  // Roots
  Route::get('roots', 'RootsController@index');
  Route::post('roots', 'RootsController@store');
  Route::get('roots/{id}', 'RootsController@show');
  Route::put('roots/{id}', 'RootsController@update');
  Route::patch('roots/{id}', 'RootsController@update');
  Route::delete('roots/{id}', 'RootsController@destroy');

  // Lemmas
  // Route::get('lemmas', 'LemmasController@index');
  Route::get('lemmas/{id}', 'LemmasController@show');

  // Definitions
  // Route::get('definitions', 'DefinitionsController@index');
  Route::get('definitions/{id}', 'DefinitionsController@show');
});
