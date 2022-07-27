/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const consultaCantidadNovedades = "http://127.0.0.1:8000/contarNovedades"

const app = new Vue({
    el: '#app',
    data:{
        
        colorFondo:'',
        num1: 0,
        num2: 0,
        resultado:'',
        operacion:'',
        fechaNovedad: '',
        novedades: [],
        nombreVaca: '',

        totalNovedades: 0,
        novedadesPagina: 3,
        paginas: '', 
        paginaActual: 1, 
        desde: '',
        hasta: '', 
        ocultarMostrarAnterior: '',
        ocultarMostrarSiguiente: '', 
        botones: [],
        
    },
    methods:{

        consultaNumeroNovedades: function(){

            axios.get(consultaCantidadNovedades).then((respuesta)=> {

                this.totalNovedades = respuesta.data

                this.paginas = Math.ceil(this.totalNovedades / this.novedadesPagina);

            })
        },

        paginar: function(pagina){

            this.paginaActual = pagina;

            this.desde = ((this.paginaActual - 1) * this.novedadesPagina);
            this.hasta = this.paginaActual * this.novedadesPagina;

            if(this.paginaActual == 1){

                this.ocultarMostrarAnterior = "page-item disabled";

            }else{

                this.ocultarMostrarAnterior = "page-item";

            }


            if(this.paginaActual == this.paginas){

                this.ocultarMostrarSiguiente = "page-item disabled";

            }else{

                this.ocultarMostrarSiguiente = "page-item";
            }

            for (i = 0; i <= this.paginas; i++){

                if ((i + 1) == this.paginaActual){

                    this.botones[i] = "page-item active";

                }else{

                    this.botones[i] = "page-item";
                }

            }
        },

        anterior: function(){

            this.paginaActual = this.paginaActual - 1;
            this.paginar(this.paginaActual);

        },

        siguiente: function(){

            this.paginaActual = this.paginaActual + 1;
            this.paginar(this.paginaActual);

        },

        calcular:function(){

            if(this.operacion == 'suma'){

                this.resultado = parseInt(this.num1) + parseInt(this.num2)
            }
            if(this.operacion == 'resta'){

                this.resultado = parseInt(this.num1) - parseInt(this.num2)
            }
            if(this.operacion == 'multi'){

                this.resultado = parseInt(this.num1) * parseInt(this.num2)
            }
            if(this.operacion == 'div'){

                this.resultado = parseInt(this.num1) / parseInt(this.num2)
            }
        },

        eliminarNovedad: function(id_novedades){

            var eliminar = confirm("¿Esta seguro que quiere eliminar este dato de novedad?");
        
            if(eliminar == true){
        
                axios.delete('http://127.0.0.1:8000/novedades/'+id_novedades).then((respuesta)=>{
        
                console.log(respuesta);
        
                window.location.href = "http://127.0.0.1:8000/novedades/";
        

                
                });
            }
        },

        buscarNovedades:function(){

            if(this.fechaNovedad.length > 0){

                
                axios.get('http://127.0.0.1:8000/novedadAnimalBuscar/'+this.fechaNovedad).then((respuesta)=>{
                    this.novedades = respuesta.data;
                });
            
            }else{
                axios.get('http://127.0.0.1:8000/novedadAnimalBuscar/-').then((respuesta)=>{this.novedades = respuesta.data;
                });
            } 
        },


        buscarNovedadesVaca:function(){

            if(this.nombreVaca.length > 0){

                
                axios.get('http://127.0.0.1:8000/novedadAnimalBuscarVaca/'+this.nombreVaca).then((respuesta)=>{
                    this.novedades = respuesta.data;
                });
            
            }else{
                axios.get('http://127.0.0.1:8000/novedadAnimalBuscarVaca/-').then((respuesta)=>{this.novedades = respuesta.data;
                });
            }
        },  
        },

        mounted(){

            this.buscarNovedades()
            this.buscarNovedadesVaca()

            this.buscarNovedades()
            this.consultaNumeroNovedades()
            this.paginar(1)


            
        }

    

});


