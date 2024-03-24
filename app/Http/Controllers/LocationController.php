<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locaciones = Location::all();

        return response()->json($locaciones);
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

    public function assignations(){
        $assignations = Location::with(['autos'])->get();

        return response()->json($assignations);
    }

    public function assignationStore(Request $request)
    {
        $request->validate([
            'auto_id' => 'required',
            'location_id' => 'required',
        ]);

        $auto = Auto::findOrFail($request->auto_id);
        $locacion = Location::findOrFail($request->location_id);

        $auto->locations()->attach($locacion);

        return redirect()->route('assignations')->with('message', 'Exito');
    }


}
