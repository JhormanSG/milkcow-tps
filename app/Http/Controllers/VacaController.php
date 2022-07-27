<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VacaController extends Controller
{
    public function index(){

        $novedades = NovedadAnimalModel::All();

        return view("paginas.novedadesAnimal", array("novedades"=>$novedades));
    }
}
