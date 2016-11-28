<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Location;
use App\User;
use App\Visit;

class LocationsController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        for ($i=0; $i < count($locations); $i++) { 
            $locations[$i]->visitas = Visit::where('locations_id', $locations[$i]->id)->count(); 
        }
        return view('locaciones_admin', compact('locations'));
    }

    public function store(Request $request)
    {
        // TODO: validar datos antes de inseertarlos
        $user = User::first();
        if ($user != null) {
            Location::create(['nombre'   => $request->nombre_locacion,
                              'latitud'  => $request->latitud_locacion,
                              'longitud' => $request->longitud_locacion,
                              'admin_id' => $user->id]);
        }
        
        return redirect()->back();
    }
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();
        return redirect()->back();
    }
}
