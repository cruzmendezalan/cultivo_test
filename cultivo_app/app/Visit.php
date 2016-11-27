<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
	// con que tabla se enlazara este modelo
    protected $table = 'visits';

    //Que campos podemos rellenar en forma masiva
    /* *********************************************
    	Cómo es un demo dejaremos todos lo campos rellenables.
    */
    protected $fillable = ['locations_id',
    					   'users_id'];

    public function user()
    {
        return $this->hasOne('App\User',
        					 'users_id');
    }

    public function location()
    {
        return $this->hasOne('App\Location',
        					 'locations_id');
    }
}
