<template>
	<div id="crear-cliente" class="row">
		<div class="col-md-8 col-xs-12"
				:class  = "{ 'animated fadeInRight'  : ejecutar_animacion_entrada,
                             'animated fadeOutRight' : activarAnimacionSalidaComponentePadre || ejecutar_animacion_salida}"  
                :style  = "style_object_animacion">
            <div class="x_panel">
              	<div class="x_title">
                    <h2>Formulario de creacion de cliente. <small>Datos personales</small></h2>
                    <div class="clearfix"></div>
              	</div>
              	<div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left"  @submit.prevent="agregarCliente">
						<div class="form-group" v-for = "(campo , key) in campos_cliente" :key="key">
							<label class="control-label col-md-3 col-sm-3 col-xs-3">
								{{campo.label}}
							</label>
							<div class="col-md-9 col-sm-9 col-xs-9">
							  <input 	:type 		 = "campo.type" 
							  			:id 		 = "'input-' + campo.clave"
							  			:placeholder = "campo.descripcion"
							  			required
							  			class 	 	 = "form-control">
							  <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
							</div>
						</div>                      
                      	<div class="ln_solid"></div>
                  		<div class="form-group">
	                        <div class="col-md-9 col-md-offset-3">
	                        	<button class 	= "btn btn-primary" 
	                          			type  	= "button"
	                          			@click	= "volverInicio">
		                          		Cancelar
	                          	</button>
                          		<!--button class="btn btn-primary" @click = "volverInicio">Cancelar</button-->
                      			<button type="submit" class="btn btn-success">Crear</button>
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
		name: 'crear-cliente',
        props: [ 'ejecutarSalida' , 'animacion' ], 
        mounted() {
            setTimeout(() => {
                this.ejecutar_animacion_entrada = false;
            }, this.animacion.duracion * 1000);
        },
		data(){
			return {
                ejecutar_animacion_entrada: true,
				ejecutar_animacion_salida : false,
                style_object_animacion    : {
                    '-webkit-animation-duration': this.animacion.duracion,
                    '-webkit-animation-delay'   : this.animacion.delay, 
                },
                campos_cliente: [
					//cantidad de stock
                    {   clave   : 'apellido' , 
                        model   : '', 
                        label   : 'Apellido' , 
                        type    : 'text', 
                        descripcion : 'Ingrese el apellido', 
                        icono 	: '',
                        state   : null  } ,
                    //lote correspondiente
                    {   clave     : 'nombres' , 
                        model   : '', 
                        label   : 'Nombres' , 
                        type    : 'text', 
                        descripcion : 'Ingrese el/los nombres.', 
                        icono 	: '',
                        state   : null  } ,
                    //fecha vencimiento
                    {   clave     : 'email' , 
                        model   : '', 
                        label   : 'Email' , 
                        type    : 'email', 
                        descripcion : 'Ingrese el email.', 
                        icono 	: '',
                        state   : null  } ,
                         //fecha vencimiento
                    {   clave     : 'telefono' , 
                        model   : '', 
                        label   : 'Telefono' , 
                        type    : 'number', 
                        descripcion : 'Ingrese el telefono.', 
                        icono 	: '',
                        state   : null  } ,
				],
			}
		},
		methods: {
			agregarCliente: function(){

			},
			volverInicio: function(){
                this.ejecutar_animacion_salida = true;
                setTimeout(() => {
                    this.$emit('volver-inicio')
                }, this.animacion.duracion * 1000);
            },
		},
		computed:{
            activarAnimacionSalidaComponentePadre(){
                if (this.ejecutarSalida) {
                    return true;
                }
            },
        }
	}

</script>