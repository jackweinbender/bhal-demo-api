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


Route::get('api/v1/letters', 'LettersController@index');
Route::get('api/v1/letters/{id}', 'LettersController@show');

Route::get('api/v1/roots', 'RootsController@index');
Route::get('api/v1/roots/{id}', 'RootsController@show');

// Route::get('api/v1/lemmas', 'LemmasController@index');
Route::get('api/v1/lemmas/{id}', 'LemmasController@show');

// Route::get('api/v1/definitions', 'DefinitionsController@index');
Route::get('api/v1/definitions/{id}', 'DefinitionsController@show');
