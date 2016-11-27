<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	// con que tabla se enlazara este modelo
    protected $table = 'locations';

    //Que campos podemos rellenar en forma masiva
    /* *********************************************
    	Cómo es un demo dejaremos todos lo campos rellenables.
    */
    protected $fillable = ['nombre',
    					   'latitud',
    					   'longitud',
    					   'admin_id'];

    public function user()
    {
        // belongsTo('Con que modelo se relaciona',
        //			 'clave foranea')

        return $this->belongsTo('App\User','admin_id');
    }

    public function visits(){
    	return $this->hasMany('App\Vist');
    }
}
