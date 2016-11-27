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
        
        // $usuario = User::create(['nombre'       => 'Alan'  ,
        //                          'apellido_pat' => 'cruz'  ,
        //                          'apellido_mat' => 'mendez',
        //                          'email'        => 'cruzmendezalan@gmail.com']);
        // $user = User::first();
        // $location = Location::create(['nombre'   => 'XLugar',
        //                               'latitud'  => '198212',
        //                               'longitud' => '129182',
        //                               'admin_id' => $user->id]);
        // $location = Location::first();

        // $visit = Visit::create(['locations_id' => $location->id,
        //                         'users_id'     => $user->id]);

        // $visit2 = Visit::create(['locations_id' => $location->id,
        //                         'users_id'     => $user->id]);

        return dd($visit);
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
