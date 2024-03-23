<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $autos = Location::all();

        return response()->json($autos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'municipio' => 'required',
        ]);

        $locacion = Location::create($request->all());

        return response()->json($locacion, 201);
    }

    public function show($id)
    {
        $locacion = Location::findOrFail($id);

        return response()->json($locacion);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'municipio' => 'required',
        ]);

        $locacion = Location::findOrFail($id);
        $locacion->update($request->all());

        return response()->json($locacion, 200);
    }

    public function destroy($id)
    {
        $locacion = Location::findOrFail($id);
        $locacion->delete();

        return response()->json(null, 204);
    }


}
