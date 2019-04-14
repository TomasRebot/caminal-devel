<template>
	<div 	class 	= "row"
			id 		= "eliminar-medicamento"
        	:class  = "{ 'animated fadeInRight'  : ejecutar_animacion_entrada,
        				 'animated fadeOutRight' : ejecutar_animacion_salida }"
            :style  = "style_object_animacion">

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

                        <div class="item form-group" v-for= "(campo , key) in campos_formulario" :key="key">
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
        props: [ 'medicamento' , 'animacion' ],
        mounted(){
            setTimeout(() => {
                this.ejecutar_animacion_entrada = false;
            }, this.animacion.duracion * 1000);

        	let c = this.campos_formulario;
            var m = this.medicamento;

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
		data(){
            return{
                ejecutar_animacion_entrada: true,
                ejecutar_animacion_salida : false,
                style_object_animacion    : {
                    '-webkit-animation-duration': this.animacion.duracion,
                    '-webkit-animation-delay'   : this.animacion.delay,
                },
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
        methods: {
        	eliminarMedicamento: function(){

        	},
            regresarListaMedicamentos: function(){
            	this.ejecutar_animacion_salida = true;
                /** Efecto de salida de formulario
                * se ejecuta el TimeOut cuando termine la animacion de salida
                * devolviendo a la vista de "Lista de medicamentos"
                * el tiempo de salida se calcula por la duracion de la animacion
                * estalecida
                */
            	setTimeout(() => {
						this.$emit('regresar');
			    }, this.animacion.duracion * 1000);
            },
        },
        computed: {
        	show(){
        		return this.medicamento ? true : false;
        	},
        }
	}

</script>
