<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Location;
use App\User;
use App\Visit;

class DemoCultivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (User::first() == null) {
            //Si no hay usuario inicial se crea uno
           $usuario = User::create(['nombre'       => 'Alan'  ,
                                    'apellido_pat' => 'cruz'  ,
                                    'apellido_mat' => 'mendez',
                                    'email'        => 'cruzmendezalan@gmail.com']);
        }
        

        $locations = Location::all();
        for ($i=0; $i < count($locations); $i++) { 
            $locations[$i]->visitas = Visit::where('locations_id', $locations[$i]->id)->count(); 
        }

        return view('index', compact('locations','visits'));
    }

    public function store(Request $request)
    {
        //
        $visit = Visit::create(['visit_email'  => $request->visit_email,
                                'locations_id' => $request->ubicacion_id]);
        return redirect()->back();
    }   

}
