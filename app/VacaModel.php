<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacaModel extends Model
{
    protected $table = 'vaca';

    public function vacas()
    {

        return $this->belongsTo('App\VacaModel', 'vaca', 'estado_vaca');
    }
}
