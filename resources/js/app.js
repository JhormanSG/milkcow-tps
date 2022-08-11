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
        
        // colorFondo:'',
        // num1: 0,
        // num2: 0,
        // resultado:'',
        // operacion:'',
        fechaNovedad: '',
        nombreVaca: '',
        novedades: [],
        

        totalNovedades: 0,
        novedadesPagina: 6,
        paginasNovedadAnimal: '', 
        paginaActualNovedadAnimal: 1, 
        desdeNovedadAnimal: '',
        hastaNovedadAnimal: '', 
        ocultarMostrarAnteriorNovedadAnimal: '',
        ocultarMostrarSiguienteNovedadAnimal: '', 
        botonesNovedadAnimal: [],
        
    },
    methods:{

        consultaNumeroNovedades: function(){

            axios.get(consultaCantidadNovedades).then((respuesta)=> {

                this.totalNovedades = respuesta.data

                this.paginasNovedadAnimal = Math.ceil(this.totalNovedades / this.novedadesPagina);

            })
        },

        paginar: function(pagina){

            this.paginaActualNovedadAnimal = pagina;

            this.desdeNovedadAnimal = ((this.paginaActualNovedadAnimal - 1) * this.novedadesPagina);
            this.hastaNovedadAnimal = this.paginaActualNovedadAnimal * this.novedadesPagina;

            if(this.paginaActualNovedadAnimal == 1){

                this.ocultarMostrarAnteriorNovedadAnimal = "page-item disabled";

            }else{

                this.ocultarMostrarAnteriorNovedadAnimal = "page-item";

            }


            if(this.paginaActualNovedadAnimal == this.paginasNovedadAnimal){

                this.ocultarMostrarSiguienteNovedadAnimal = "page-item disabled";

            }else{

                this.ocultarMostrarSiguienteNovedadAnimal = "page-item";
            }

            for (i = 0; i <= this.paginasNovedadAnimal; i++){

                if ((i + 1) == this.paginaActualNovedadAnimal){

                    this.botonesNovedadAnimal[i] = "page-item active";

                }else{

                    this.botonesNovedadAnimal[i] = "page-item";
                }

            }
        },

        anterior: function(){

            this.paginaActualNovedadAnimal = this.paginaActualNovedadAnimal - 1;
            this.paginar(this.paginaActualNovedadAnimal);

        },

        siguiente: function(){

            this.paginaActualNovedadAnimal = this.paginaActualNovedadAnimal + 1;
            this.paginar(this.paginaActualNovedadAnimal);

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

                    this.paginasNovedadAnimal = Math.ceil(this.novedades.length / this.novedadesPagina);

                });
            
            }else{
                axios.get('http://127.0.0.1:8000/novedadAnimalBuscar/-').then((respuesta)=>{this.novedades = respuesta.data;
                console.log(this.novedades)

                this.paginasNovedadAnimal = Math.ceil(this.novedades.length / this.novedadesPagina);

                });
            } 
        },


        buscarNovedadesVaca:function(){

            if(this.nombreVaca.length > 0){

                
                axios.get('http://127.0.0.1:8000/novedadAnimalBuscarVaca/'+this.nombreVaca).then((respuesta)=>{
                    this.novedades = respuesta.data;

                    this.paginasNovedadAnimal = Math.ceil(this.novedades.length / this.novedadesPagina);
                });
            
            }else{
                axios.get('http://127.0.0.1:8000/novedadAnimalBuscarVaca/-').then((respuesta)=>{this.novedades = respuesta.data;
                });

                    this.paginasNovedadAnimal = Math.ceil(this.novedades.length / this.novedadesPagina);
            }
        },  
        },

        mounted(){

            this.buscarNovedades()
            //this.buscarNovedadesVaca()

            this.buscarNovedades()
            this.consultaNumeroNovedades()
            this.paginar(1)


            
        }

    

});


