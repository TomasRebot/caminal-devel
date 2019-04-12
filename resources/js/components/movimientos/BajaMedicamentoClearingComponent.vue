<template>
	<!-- FORMULARIO DE ENTREGA DE MEDICAMENTO A CLIENTE -->
	<div id="baja-medicamento-clearing" class="row">
		<!-- SELECION DE CLIENTE -->
		<div class = "col-md-12 col-sm-12 col-xs-12 form-group"                 
			v-if 	= "!mostrarListaInstituciones"
			:style  = "style_object_animacion"
			:class  = "{ 'animated fadeInRight'  : ejecutar_animacion_entrada,
							'animated fadeOutRight' : activarAnimacionSalidaComponentePadre || ejecutar_animacion_salida}">
			<div class="x_panel">
				<div class="x_title">
					<h2>Entrega de medicamentos <small>por clearing.</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content row">
					<br>
					<!-- BUSQUEDA DE INSTITUCION -->
					<div class="col-md-6 col-sm-12 col-xs-12 form-group">
						<div class="x_title">
							<h3>Seleccion de institucion.</h3>
							<div class="clearfix"></div>
						</div>
						<form class="form-horizontal form-label-left" @submit.prevent = "confirmarEntrega">
							<div 	class = "form-group"
									v-for = "(campo , key) in datos_cliente"
									:key  = "key">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">
									{{ campo.label }}
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<label 	class 		= "form-control">
										{{ campo.model }}
									</label>
								</div>
							</div>


							<div class="form-group">
								<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 text-right">
									<button class="btn btn-success" @click="buscarInstitucion">
										Buscar institucion
									</button>
								</div>
							</div>

							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
									<button type="button" class="btn btn-primary">
										Cancelar
									</button>
									<button :class="{'btn btn-success' : habilitarBotonConfirmar,
														'btn btn-danger'  : !habilitarBotonConfirmar}">
										Confirmar
									</button>
								</div>
							</div>
						</form>
					</div>
					<!-- FIN BUSQUEDA INSTITUCION -->
					<!-- SELECCION DE MEDICAMENTO/OS -->
					<div class="col-md-6  col-sm-12 col-xs-12 form-group">
						<div class="x_panel">
							<div class="x_title">
								<h2 class="col-md-9">
									Lista de medicamentos
								</h2>
								<h2 class="col-md-3 text-right">
									<button type="button" class="btn btn-success btn-sm">
										<h4><i class="fa fa-plus-circle"></i>Agregar</h4>	  
									</button>
								</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<article class="media event" v-for="(n , key) in 6" :key = "key">
									<!--a class="pull-left date">
										<p class="month">April</p>
										<p class="day">23</p>
									</a-->
									<div class="media-body">
									<a class="title" href="#">Item One Title ... {{n}}</a>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</article>
							</div>
						</div>
					</div>
					<!-- FIN SELECCION MEDICAMENTO/OS -->
				</div>
			</div>
		</div>
    </div>
</template>
<script>
	
	export default{
		name: 'baja-medicamento-clearing',
		props: [ 'ejecutarSalida' , 'animacion' ], 
		mounted(){
			setTimeout(()=>{ 
				this.ejecutar_animacion_entrada 		= false;
			} , this.animacion.duracion * 1000);
		},
		data(){
			return {
				ejecutar_animacion_entrada: true,
				ejecutar_animacion_salida : false,
                style_object_animacion    : {
                    '-webkit-animation-duration': this.animacion.duracion,
                    '-webkit-animation-delay'   : this.animacion.delay, 
                },
                mostrarListaInstituciones: false,
                datos_cliente: [
					//nombres institucion
                    {   clave     : 'nombres' , 
                        model   : 'CENTRO MEDICO nº 1515', 
                        label   : 'NOMBRES' , 
                        icono 	: ''  } ,
                    //direccion instuticion
                    {   clave     : 'direccion' , 
                        model   : 'alguna direccion', 
                        label   : 'DIRECCION' , 
                        icono 	: ''} ,
				],
				institucion_seleccionada  : false,
				medicamentos_seleccionados: [],
			}
		},
		methods: {
			volverInicio: function(){
                this.ejecutar_animacion_salida = true;
                setTimeout(() => {
                    this.$emit('volver-inicio')
                }, this.animacion.duracion * 1000);
            },
            buscarInstitucion: function(){
            	return;
            	this.ejecutar_animacion_salida = true;
            	setTimeout(()=>{ 
            		this.mostrarListaInstituciones 		= true;
            		this.ejecutar_animacion_salida 	= false;
            	} , this.animacion.duracion * 1000);
            },
            confirmarEntrega: function(){

            },
            institucionSeleccionada: function(institucion_seleccionada){
            	/** Cliente seleccionado para la entrega
            	* este dato nos llega de la seleccion de la lista de clientes
            	*/
            	this.institucion_seleccionada = institucion_seleccionada;
            	$(this.datos_cliente).each(function(index,campo){
					campo.model = institucion_seleccionada[campo.clave];
            	})
            	setTimeout(()=>{ 
            		this.mostrarListaInstituciones 		= false;
            	} , this.animacion.duracion * 1000);
            }
		},
		computed:{
            activarAnimacionSalidaComponentePadre(){
                if (this.ejecutarSalida) {
                    return true;
                }
            },
            habilitarBotonConfirmar(){
            	return this.institucion_seleccionada && this.medicamentos_seleccionados.lenght > 1 ? true : false;
            }
        }
	}

</script>