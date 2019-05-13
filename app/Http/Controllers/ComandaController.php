<?php

namespace App\Http\Controllers;

use App\Comanda;
use App\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComandaController extends Controller
{
    public function getAll()
    {
        return Comanda::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'medicament' => 'required|string',
            'cantitate' => 'required|integer',
            'sectie' => 'required|integer'
                    ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 201);
        }

        Comanda::create([
            'medicament' => $request['medicament'],
            'cantitate' => $request['cantitate'],
            'idSectie' => $request['sectie']
        ]);

        return response()->json('success', 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medicament' => ['required', 'string', 'max:255'],
            'cantitate' => ['required', 'integer', 'email', 'max:255',],
        ]);

        $Comanda = Comanda::find($id);
        $Comanda->medicament = $request['medicament'];
        $Comanda->cantitate = $request['cantitate'];


        $Comanda->save();

        return response()->json($Comanda, 200);


    }

    public function status(Request $request){
        $comanda = Comanda::find($request['id']);
        $comanda->status = $request['status'];
        $comanda->save();

        if($request['status'] == 1){
            $med = Medicament::where('nume', '=', $comanda->medicament)->first();

            $var1 = $med->quantity;
            $var2 = $comanda->cantitate;
            $aux = $var1 - $var2;

            $med->quantity = $aux;
            $med->save();
        }

        return response()->json('Status changed!' . $comanda->cantitate);
    }

    public function delete($id){

        $Comanda= Comanda::find($id);
        $Comanda->delete();

        return response()->json('Deleted with succes', 204);

    }
}
