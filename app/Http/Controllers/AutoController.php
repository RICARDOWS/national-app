<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Inertia\Inertia;
use App\Models\Location;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    public function index()
    {
        $autos = Auto::with(['locations'])->get();

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
            'tipo' => 'required|string|in:camioneta,auto',
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

    //auto location
    public function asignarLocacion(Auto $auto, Location $locacion)
    {
        $auto->locations()->attach($locacion);

        return response()->json(['message' => 'Auto asignado a la locación correctamente'], 200);
    }

    public function autosPorLocacion(Location $location)
    {
        $autos = $location->autos()->get();

        return response()->json($autos);
    }

    public function create(){
        return Inertia::render('Create', [
          ]);
    }

    public function edit($id){
        $auto = Auto::findOrFail($id);
        return Inertia::render(
            'Edit',
            [
                'auto' => $auto
            ]
        );
    }

    public function storeView(Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'tipo' => 'required|string|in:camioneta,auto',
        ]);

        $auto = Auto::create($request->all());

        return redirect()->route('dashboard')->with('message', 'Creacion correcta');
    }


    public function updateView(Request $request, $id)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'tipo' => 'required|string|in:camioneta,auto',
        ]);

        $auto = Auto::findOrFail($id);
        $auto->update($request->all());

        
        return redirect()->route('dashboard')->with('message', 'Actualizacion correcta');
    }

    public function destroyView($id)
    {
        $auto = Auto::findOrFail($id);
        $auto->delete();
        sleep(2);

        return redirect()->route('dashboard')->with('message', 'Borrado Exitosamente');
    }

    
}
