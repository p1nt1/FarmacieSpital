<?php

namespace App\Http\Controllers;

use App\Sectie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectieController extends Controller
{
    public function getAll()
    {
        return Sectie::all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nume' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 201);
        }

        Sectie::create(['nume' => $request['nume']]);

        return response()->json('Added with success', 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nume' => 'required',
        ]);

        $Sectie = Sectie::find($id);
        $Sectie->nume = $request['nume'];
        $Sectie->save();

        return response()->json($Sectie, 200);


    }

    public function delete($id){

        $Sectie= Sectie::find($id);
        $Sectie->delete();

        return response()->json('Deleted with succes', 204);

    }
}
