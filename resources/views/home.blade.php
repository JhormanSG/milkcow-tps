@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    <label for="">Color</label>
                    <input type="text" name="" id="" v-model="colorFondo" >
                    <input type="text" style="width: 30px" v-bind:style="{'background-color': colorFondo}" readonly>


                    <div class="card-body">

                    <p>Operaciones Matematicas</p>
                        <label for="">Digite el primer numero</label>
                        <input type="text" name="" id="" v-model="num1" v-on:keyup="calcular">
                        <label for="">Digite el segundo numero</label>
                        <input type="text" name="" id="" v-model="num2"  v-on:keyup="calcular">
                        <br>
                        <label for="">Operacion:</label>
                        <select name="" id="" v-model="operacion" v-on:change="calcular">
                        <option value="">Selecione uno...</option>
                        <option value="suma">Sumar</option>
                        <option value="resta">Restar</option>
                        <option value="multi">Multiplicar</option>
                        <option value="div">Dividir</option>
                        </select>
                        <p>El resultado de la operacion es = @{{ resultado }}</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
