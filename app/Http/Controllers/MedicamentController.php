<?php

namespace App\Http\Controllers;

use App\Medicament;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class MedicamentController extends Controller
{
    public function getAll()
    {
        return Medicament::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nume' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 201);
        }

        Medicament::create(['nume' => $request['nume']]);

        return response()->json('Added with success', 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nume' => 'required',
        ]);

        $medicament = Medicament::find($id);
        $medicament->nume = $request['nume'];
        $medicament->save();

        return response()->json($medicament, 200);


    }

    public function delete($id){

        $medicament= Medicament::find($id);
        $medicament->delete();

        return response()->json('Deleted with succes', 204);

    }

}
