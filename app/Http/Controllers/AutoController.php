<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    public function index()
    {
        $autos = Auto::all();

        return response()->json($autos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'tipo' => 'required',
        ]);

        $auto = Auto::create($request->all());

        return response()->json($auto, 201);
    }

    public function show($id)
    {
        $auto = Auto::findOrFail($id);

        return response()->json($auto);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'tipo' => 'required',
        ]);

        $auto = Auto::findOrFail($id);
        $auto->update($request->all());

        return response()->json($auto, 200);
    }

    public function destroy($id)
    {
        $auto = Auto::findOrFail($id);
        $auto->delete();

        return response()->json(null, 204);
    }

    
}
