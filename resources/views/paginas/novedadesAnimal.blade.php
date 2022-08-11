@extends('layouts.app')

@section('content')
<div class="container">

    <div class="form-group col-md-4">

        <h3>Buscar Novedad (Por fecha)</h3>
        <input v-model="fechaNovedad" type="date" class="form-control" v-on:change="buscarNovedades">
        <h3>Buscar Novedad (Nom. vaca)</h3>
        <input v-model="nombreVaca" type="text" class="form-control" v-on:keyup="buscarNovedadesVaca">

    </div>

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('NOVEDADES ANIMALES') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOVEDAD</th>
                                <th>DESCRIPCIÓN</th>
                                <th>FECHA</th>
                                <th>VACA</th>
                                <th>REPORTERO</th>
                                @auth
                                <th colspan="2">ACCIONES</th>
                                @endauth
                            </tr>
                        </thead>


                        <tbody>

                            <tr v-for="(novedad, index) in novedades" v-show="index >= desdeNovedadAnimal && index < hastaNovedadAnimal">
                                <td>@{{novedad.id_novedades}}</td>
                                <td>@{{novedad.tipo_de_novedad}}</td>
                                <td>@{{novedad.descripcion}}</td>
                                <td>@{{novedad.fecha}}</td>
                                <td>@{{novedad.nombre}}</td>
                                <td>@{{novedad.name}}</td>
                                @auth
                                <td> 
                                <div class="btn-group">
                                        <a class="btn btn-primary" v-bind:href="'http://127.0.0.1:8000/novedades/'+novedad.id_novedades">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        @if(Auth::user()->type_user == 'Instructor')
                                        <a class="btn btn-danger" href="#" v-on:click="eliminarNovedad(novedad.id_novedades)">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                        @endif
                                    </div>
                                    </td>
                                @endauth
                            </tr>


                        </tbody>


                    </table>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li v-bind:class="ocultarMostrarAnteriorNovedadAnimal">
                                <a v-on:click="anterior" class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <li v-for="(pagina, index) in paginasNovedadAnimal" v-bind:class="botonesNovedadAnimal[index]">                                 
                                <a class="page-link" href="#" v-on:click="paginar(pagina)">@{{pagina}}</a>
                            </li>

                            <li v-if="paginasNovedadAnimal == 1" class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>

                            <li v-else v-bind:class="ocultarMostrarSiguienteNovedadAnimal">
                                <a v-on:click="siguiente" class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection