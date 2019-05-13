<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'medicament'], function(){
    Route::get('all', 'MedicamentController@getAll');
    Route::post('create', 'MedicamentController@create');
    Route::put('update/{id}', 'MedicamentController@update');
    Route::delete('delete/{id}', 'MedicamentController@delete');

});

Route::group(['prefix' => 'comanda'], function(){
    Route::get('all','ComandaController@getAll');
    Route::post('create','ComandaController@create');
    Route::put('update/{id}','ComandaController@update');
    Route::delete('delete/{id}','ComandaController@delete');
    Route::post('status','ComandaController@status');

});

Route::group(['prefix' => 'sectie'], function(){
    Route::get('all','SectieController@getAll');
    Route::post('create','SectieController@create');
    Route::put('update/{id}','SectieController@update');
    Route::delete('delete/{id}','SectieControler@delete');

});