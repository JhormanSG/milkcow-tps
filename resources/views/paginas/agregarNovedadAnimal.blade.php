@if (isset( Auth::user()->name ))

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Novedad Animal') }}</div>

                <div class="card-body">
                     
                    <form method="POST" action="{{ url('/')}}/novedades">

                        @csrf

                        <div class="form-group row">
                            <label for="tipo_de_novedad" class="col-md-4 col-form-label text-md-right">{{ __('TIPO DE NOVEDAD')}}</label>
                            <div class="col-md-6">
                                <select name="tipo_de_novedad" id="tipo_de_novedad" class="form-control @error('tipo_de_novedad') is-invalid @enderror">
                                    <option value="">Seleccione uno...</option>
                                    <option value="ACCIDENTE">ACCIDENTE</option>
                                    <option value="MUERTE">MUERTE</option>
                                    <option value="OTRO">OTRO..</option>

                                </select>
                                @error('tipo_de_novedad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('DESCRIPCION')}}</label>
                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" require autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('FECHA')}}</label>
                            <div class="col-md-6">
                                <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{'fecha'}" require autocomplete="fecha" autofocus>

                                @error('fecha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vaca" class="col-md-4 col-form-label text-md-right">{{ __('VACA')}}</label>
                            <div class="col-md-6">
                                <select name="Id_animal" id="Id_animal" class="form-control @error('Id_animal') is-invalid @enderror">


                                    <option value="">Seleccione una...</option>

                                    @foreach ($vacas as $vaca)

                                    <option value="{{ $vaca['Id_animal']}}">{{ $vaca['nombre']}}</option>

                                    @endforeach

                                </select>


                                @error('vaca')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_reportero" class="col-md-4 col-form-label text-md-right">{{ __('REPORTERO')}}</label>
                            <div class="col-md-6">
                                <select name="id_reportero" id="id_reportero" class="form-control @error('vaca') is-invalid @enderror">


                                    <option value="">Seleccione uno/a...</option>

                                    @foreach ($usuarios as $usuario)

                                    <option value="{{ $usuario['id']}}">{{ $usuario['name']}}</option>

                                    @endforeach


                                </select>
                                @error('id_reportero')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar')}}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif 