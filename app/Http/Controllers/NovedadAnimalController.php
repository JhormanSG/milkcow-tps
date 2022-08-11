<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\NovedadAnimalModel;
use App\VacaModel;
use App\User;

class NovedadAnimalController extends Controller
{
    public function index()
    {

        $novedades = NovedadAnimalModel::All();

        // return view("paginas.novedadesAnimal", array("novedades"=>$novedades));
        return view("paginas.novedadesAnimal");
    }

    public function agregarNovedadAnimal()
    {

        $vacas = VacaModel::All();
        $usuarios = user::All();

        return view("paginas.agregarNovedadAnimal", array("vacas" => $vacas, "usuarios" => $usuarios));
    }

    public function show($id_novedades)
    {

        $vacas = VacaModel::all();
        $usuarios = User::all();
        $novedadA = NovedadAnimalModel::where("id_novedades", $id_novedades)->get();

        if (count($novedadA) != 0) {

            return view("paginas.editarNovedadAnimal", array("novedadA" => $novedadA, "vacas" => $vacas, "usuarios" => $usuarios));
        } else {

            return view("paginas.editarNovedadAnimal", array("estatus" => 404));
        }
    }

    public function update($id_novedades, Request $request)
    {

        $datos = array(

            "tipo_de_novedad" => $request->input("tipo_de_novedad"),
            "descripcion" => $request->input("descripcion"),
            "fecha" => $request->input("fecha"),
            "vaca" => $request->input("vaca"),
            "id_reportero" => $request->input("id_reportero"),

        );

        if (!empty($datos)) {

            $novedades = NovedadAnimalModel::where('id_novedades', $id_novedades)->update($datos);

            return redirect("/novedades");
        }
    }

    public function destroy($id_novedades, Request $request)
    {

        return $novedades = NovedadAnimalModel::where("id_novedades", $id_novedades)->delete();
    }

    public function store(Request $request)
    {
        $tipo_de_novedad = $request->input("tipo_de_novedad");
        $Id_animal = $request->input("Id_animal");

        $datos = array(

            "tipo_de_novedad" => $tipo_de_novedad,
            "descripcion" => $request->input("descripcion"),
            "fecha" => $request->input("fecha"),
            "vaca" => $Id_animal,
            "id_reportero" => $request->input("id_reportero"),

        );

        if (!empty($datos)) {

            $novedades = NovedadAnimalModel::insert($datos);

            if ($tipo_de_novedad == 'MUERTE') {

               $vaca = VacaModel::where('Id_animal', $Id_animal)->update(['estado_vaca'=>'muerta']);

                
            }

            return redirect("/novedades");
        }
    }
    public function buscarNovedades($fechaNovedad, Request $request)
    {

        // if($request->ajax()){

        if ($fechaNovedad === '-') {

            $novedad = NovedadAnimalModel::join('vaca', 'novedades.vaca', '=', 'vaca.Id_animal')
                ->join('users', 'novedades.id_reportero', '=', 'users.id')
                ->orderBy('id_novedades', 'DESC')
                ->get();

            return $novedad;
        } else {

            $novedad = NovedadAnimalModel::where('fecha', $fechaNovedad)
                ->join('users', 'novedades.id_reportero', '=', 'users.id')
                ->join('vaca', 'novedades.vaca', '=', 'vaca.Id_animal')
                ->orderBy('id_novedades', 'DESC')
                ->get();

            return $novedad;
        }

        //}
    }


    public function buscarNovedadesVaca($nombreVaca, Request $request)
    {

        // if($request->ajax()){

        if ($nombreVaca === '-') {

            $novedad = NovedadAnimalModel::join('vaca', 'novedades.vaca', '=', 'vaca.Id_animal')
                ->join('users', 'novedades.id_reportero', '=', 'users.id')
                ->orderBy('id_novedades', 'DESC')
                ->get();

            return $novedad;
        } else {

            $novedad = NovedadAnimalModel::where('vaca.nombre', 'like', '%' . $nombreVaca . '%')
                ->join('users', 'novedades.id_reportero', '=', 'users.id')
                ->join('vaca', 'novedades.vaca', '=', 'vaca.Id_animal')
                ->orderBy('id_novedades', 'DESC')
                ->get();

            return $novedad;
        }
    }
    //  }

    public function contarNovedades()
    {

        $cantidadNovedades = NovedadAnimalModel::count();

        return $cantidadNovedades;
    }
}
