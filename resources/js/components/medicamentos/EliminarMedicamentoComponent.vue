<template>
	<div 	class 	= "row"
			id 		= "eliminar-medicamento" 
        	:class  = "{ 'animated fadeInLeft'  : true,
        				 'animated fadeOutRight' : animacion_salida }"  
            :style  = "{ '-webkit-animation-duration': '1.2s',
                     	 '-webkit-animation-delay'   : '0.3s', }">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Eliminar medicamento </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form class="form-horizontal form-label-left" @submit.prevent="eliminarMedicamento">

                        <p> Medicamento
                        </p>
                        <span class="section">Informacion:</span>

                        <div class="item form-group" v-for= "campo in campos_formulario">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                                {{ campo.label }} <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                            	<label 	class = "form-control col-md-7 col-xs-12">
                            		{{ campo.contenido }}
                        		</label>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button class   = "btn btn-primary" 
                                        @click  = "regresarListaMedicamentos">
                                    Cancelar
                                </button>
                                <button class="btn btn-danger">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	
	export default{
		name: 'eliminar-medicamento',
		props: [ 'medicamento' ],
		data(){
            return{
            	animacion_salida: false,
                campos_formulario: [
                    //codigo
                    {   clave     	: 'codigo' , 
                        label   	: 'Codigo' , 
                        contenido   : '' } ,
                    //nombre
                    {   clave     	: 'nombre',
                        label   	: 'Nombre', 
                        contenido   : '' } ,
                    //clasificacion
                    {   clave     	: 'clasificacion',
                        label   	: 'Clasificacion', 
                        contenido   : '' } ,
                    //descripcion
                    {   clave     	: 'descripcion',    
                        label   	: 'Descripcion', 
                        contenido   : '' } ,
                    //cant por blister
                    {   clave     	: 'cant_blister',
                        label   	: 'Cantidad blister', 
                        contenido   : '' } ,
                ],
            }
        },
        mounted(){
        	let c = this.campos_formulario;
            var m = this.medicamento;

            console.log('estamos en el frm eliminar')

        	$(c).each(function(index, campo){
                Object.keys(m).some( function( prop ){
                    if (campo.clave == prop) { campo.contenido = m[prop] }
                    if (prop == 'perfil') {
        				if (campo.clave == 'nombre') {
        					campo.contenido = m[prop]['nombre'];
    					} else if( campo.clave == 'clasificacion') {
                            campo.contenido = m[prop]['clasificacion'];
                        }
    				}
        		});
            });
        },
        methods: {
        	eliminarMedicamento: function(){

        	},
            regresarListaMedicamentos: function(){
            	this.animacion_salida = true;
            	setTimeout(() => {
						this.$emit('regresar');
			    }, 1200);
            },
        },
        computed: {
        	show(){
        		return this.medicamento ? true : false;
        	},
        }
	}

</script>