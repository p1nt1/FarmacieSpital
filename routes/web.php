<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Sectie;
use App\User;

Auth::routes();

Route::group(['middleware' => ['web' ,'auth']], function(){
    Route::get('/', function() {
        if(Auth::user()->farmacist ==0){
            $sectii = Sectie::all();
            $comenzi = \App\Comanda::all();


            foreach ($comenzi as $com){
                $com['sectie'] = $sectii[$com->idSectie-1]->nume;
            }

            return view('medicamentView', compact('comenzi', 'sectii'));


        }
        else{
            $sectii = Sectie::all();
            $comenzi = \App\Comanda::all();
            $medicamente = \App\Medicament::all();


            foreach ($comenzi as $com){
                $com['sectie'] = $sectii[$com->idSectie-1]->nume;
            }

            foreach ($comenzi as $com){
                foreach ($medicamente as $med){
                    if($med['nume'] == $com['medicament']) {
                        $com['quantity'] = $med['quantity'];
                        break;
                    }
                }
            }

            return view('farmacisthome', compact('comenzi', 'sectii'));
        }
    });


});


