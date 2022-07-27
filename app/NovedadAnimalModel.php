<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovedadAnimalModel extends Model
{
    protected $table = 'novedades';

    public function usuarios(){

        return $this->belongsTo('App\User', 'id_reportero', 'id');

    }

        
    public function vacas(){

        return $this->belongsTo('App\VacaModel', 'vaca', 'id_animal');

    }
}
