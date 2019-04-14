<template>
	<div 	id = "lista-medicamentos" class="row">
		<div 	class="col-md-12 col-sm-12 col-xs-12"
        		:class  = "{ 'animated fadeInRight'  : ejecutar_animacion_entrada,
        				     'animated fadeOutRight' : activarAnimacionSalidaComponentePadre || ejecutar_animacion_salida}"
            	:style  = "style_object_animacion"
         	  	v-if 	= "frm_listar_medicamentos">
	        <div class="x_panel">
	          	<div class="x_title">
	                <h2>Lista <small>Medicamentos</small></h2>
	                <div class="clearfix"></div>
	          	</div>
	          	<div class="x_content">
	                <p class="text-muted font-13 m-b-30">
	                  	Lista completa de medicamentos, puede buscar por cualquiera de los campos en la barra de "Buscar"
	                </p>
	                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
	                	<div class="row">
	                		<div class="col-sm-6">
	                			<div class="dataTables_length" id="datatable_length">
	                    			<label>Por pagina:
	                    				<select name 			= "datatable_length"
	                    						aria-controls 	= "datatable"
	                    						class 			= "form-control input-sm"
	                    						v-model 		= "paginacion.perPage"
	                    						@change 		= "cambiarCantidadPorPagina">
	                    						<option v-for="(n , key) in 5" :value="n*5" :key="key">
												    {{ n*5 }}
											  	</option>
	                    				</select>
	                    			</label>
	                			</div>
	        				</div>

							<div class="col-sm-6">
								<div id="datatable_filter" class="dataTables_filter">
									<label>
											Buscar:
										<input  type 			= "search"
												class 			= "form-control input-sm"
												placeholder 	= ""
												aria-controls	= "datatable"
												v-model			= "buscar">
									</label>
								</div>
							</div>
						</div>
						<!-- TABLA DE REGISTROS -->
						<!-- .................. -->
						<div class="row">
							<div class="col-sm-12">
								<table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
	                  				<thead>
	                  					<tr role="row">
	                  						<th
	                  							class 		= "sorting_asc"
	                  							tabindex 	= "0"
	                  							aria-controls="datatable"
	                  							rowspan 	= "1"
	                  							colspan 	= "1"
	                  							aria-sort 	= "ascending"
	                  							aria-label	= "Name: activate to sort column descending"
	                  							style 		= "width: 264px;"
	                  							v-for 		= "(campo , key) in key_tabla" :key="key">
	                  							<div class="row" @click ="ordenar_por(campo.key , campo.titulo)">
	                  								<div class="col-sm-6">
	                  									{{ campo.titulo }}
	                  								</div>
	                  								<div class="col-sm-6 text-right">
	                  									<i class="fa fa-arrows-v"></i>
	                  								</div>
	                  							</div>
	                  						</th>
	                  					</tr>
	                  				</thead>
	                  				<tbody>
	                  					<tr role="row" class="odd" v-for="(d ,key) in getLista" :key="key">
				                          	<td class="sorting_1"> {{ d.codigo }} </td>
				                          	<td> {{d.perfil.nombre}} </td>
				                          	<td> {{d.perfil.clasificacion}} </td>
				                          	<td> {{d.descripcion}} </td>
				                          	<td> {{d.cant_blister}} </td>
				                          	<td class="text-center">
			                          			<button type 	= "button"
			                          					class 	= "btn btn-warning"
			                          					v-if 	= "'EditarMedicamentoComponent' in Vue.options.components"
			                          					@click 	= "editarMedicamento(d)">
			                          				<i class="fa fa-edit"></i>
			                          			</button>
			                          			&nbsp;
			                          			<button type 	= "button"
			                          					class 	= "btn btn-danger"
			                          					v-if 	= "'EliminarMedicamentoComponent' in Vue.options.components"
			                          					@click 	= "eliminarMedicamento(d)">
			                          				<i class="fa fa-ban"></i>
			                          			</button>
				                          	</td>
				                        </tr>
				                    </tbody>

				                    </table>
	                		</div>
	        			</div>
						<!-- ................... -->
	        			<!-- FIN TABLA REGISTROS -->
	        			<!-- BARRA NAVEGACION PAGINAS REGISTROS -->
	    				<div class="row">
	    					<div class="col-sm-5">
	    						<div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
	    							Pagina <b>{{ paginacion.currentPage }}</b> de <b>{{ paginacion.totalPage }}</b> en {{datos_filtrados.length}} registros.
	    						</div>
							</div>
	    					<div class="col-sm-7">
								<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
									<ul class="pagination">
										<li class="paginate_button previous " id="datatable_previous">
											<button
												aria-controls 	= "datatable"
												data-dt-idx 	= "0"
												tabindex 		= "0"
												@click 			= "paginaAnterior">
												Previous
											</button>
										</li>
										<li class="paginate_button active">
											<!--a 	aria-controls="datatable"
												data-dt-idx="1"
												tabindex="0"
												v-for="n in paginacion.totalPage"
												@click="cambiarPagina(n)">
												{{ n }}
											</a-->
										</li>
										<li class="paginate_button next" id="datatable_next">
											<button
												aria-controls 	= "datatable"
												data-dt-idx 	= "7"
												tabindex 		= "0"
												@click 			= "paginaSiguiente">
												Next
											</button>
										</li>
									</ul>
								</div>
							</div>
						</div>
	        			<!-- ...................................... -->
	        			<!-- FIN BARRA NAVEGACION PAGINAS REGISTROS -->
					</div>
	         	</div>
	    	</div>
	  	</div>
		<editar-medicamento-component
				:medicamento 	= "medicamento_a_manipular"
				@regresar 		= "volverVistaListadoMedicamentos"
				v-if 			= "frm_editar_medicamento"
				:animacion 		= "animacion"
				:class  = "{'animated fadeOutRight' : activarAnimacionSalidaComponentePadre}"
				:style  = "style_object_animacion"/>
		<eliminar-medicamento-component
				:medicamento 	= "medicamento_a_manipular"
				@regresar 		= "volverVistaListadoMedicamentos"
				v-if 			= "frm_eliminar_medicamento"
				:animacion 		= "animacion"
				:class  = "{'animated fadeOutRight' : activarAnimacionSalidaComponentePadre}"
				:style  = "style_object_animacion"/>
  	</div>
</template>

<script>


	export default {
		name: 'lista-medicamentos',
		props: [ 'ejecutarSalida' , 'animacion' ], // si se cambia la vista desde el Dashboard
		mounted(){
            setTimeout(() => {
                this.ejecutar_animacion_entrada = false;
            }, this.animacion.duracion * 1000);
			axios.get( 'administracion/medicamentos/').then(
				response => {
					var r = response.data;
					if (r.success) {
						this.form = r.lista_medicamentos.sort(this.sort_by('codigo', true, function(a){return a}));
						this.datos_filtrados = this.form;
						this.paginar();
				}
			})
		},
		data(){
			return {
				ejecutar_animacion_entrada: true,
				ejecutar_animacion_salida : false,
				style_object_animacion 	  : {
					'-webkit-animation-duration': this.animacion.duracion,
                    '-webkit-animation-delay'   : this.animacion.delay,
				},
				//vistas
				frm_listar_medicamentos : true,
				frm_editar_medicamento 	: false,
				frm_eliminar_medicamento: false,
				//fin vistas
				form: [],
				paginacion: {
					currentPage	: 1,
					perPage 	: 5,
					index 		: 0,
					totalPage 	: 0,
				},
				datos_paginados: [],
				sort_fields : {
					campo 	: 'codigo',
					reverse : false,
				},
				buscar: '',
				datos_filtrados: {},
				key_tabla: [
					{ 'titulo': 'Codigo' 			, 'key': 'codigo',},
					{ 'titulo': 'Nombre' 			, 'key': 'perfil',},
					{ 'titulo': 'Clasificacion'		, 'key': 'perfil',},
					{ 'titulo': 'Descripcion' 		, 'key': 'descripcion',},
					{ 'titulo': 'Cant. blister' 	, 'key': 'cant_blister',},
					{ 'titulo': 'Accion' 			, 'key': 'accion',},
				],
				medicamento_a_manipular: false, // para pasar a la vista de edicion o para eliminarlo
			}
		},
		methods: {
			ordenar_por: function( campo , segundo_campo ){
				if( campo.toLowerCase() == 'accion' ){ return; }
				let f = this.sort_fields;

				if ( f.campo == campo ) {
					f.reverse = f.reverse ? false : true;
				} else{
					f.campo 	= campo;
					f.reverse 	= false;
				}
				// aca no preguntar, la funcion para ordenar por campo fue extraida de internet
				// y modificada infimamente
				this.datos_filtrados = this.datos_filtrados.sort(	this.sort_by( 	campo ,
																	this.sort_fields.reverse,
																	function(a){
																		if (segundo_campo.toLowerCase() == 'nombre') {
																			a = a.nombre;
																		} else if(segundo_campo.toLowerCase() == 'clasificacion'){
																			a = a.clasificacion;
																		}
																		if ( campo == 'codigo' || campo == 'cant_blister') {
																			return a;
																		}
																		return a.toUpperCase()
																	})
																);
				this.paginar();
			},
			sort_by:  function(field, reverse, primer){
			   	var key = primer ?
		       		function(x) {return primer(x[field])} :
		       		function(x) {return x[field]};

			   	reverse = !reverse ? 1 : -1;

			   	return function (a, b) {
			       return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
		     	}
			},
			paginaAnterior: function(){
				if (this.paginacion.currentPage > 1) {
					this.paginacion.currentPage--;
				}
			},
			paginaSiguiente: function(){
				if ( this.paginacion.currentPage != this.paginacion.totalPage ) {
					this.paginacion.currentPage++;
				}
			},
			cambiarCantidadPorPagina(){
				/** Recarga la tabla con la nueva division de registros por pagina.
				* renderiza la cantidad de registros que se selecciono para mostrar
				*/
				this.paginar();
			},
			/*cambiarPagina: function(n){
				this.paginacion.currentPage = n;
			},*/
			paginar: function(){
				/** Como este plantilla tiene una version vieja de boostrap.
			 	* debemos paginar a mano! =D
				* "datos_paginados" contiene los registros divididos en grupos de arrays
				* "datos_filtrados" tiene todos los elementos organizados por el filtro
				* en caso de no tener filtro aplicado estan ordenados por defecto por codigo
				* -----------------
				* se comienza a dividir los registros en el Each y a guardar en datos_paginados
				*/
				let $this 	= this;
				let $p 		= this.paginacion;

				this.datos_paginados 		= [];
				this.paginacion.currentPage = 1;
				$p.index 		= 0;
				$p.totalPage 	= Math.ceil(this.datos_filtrados.length / $p.perPage);

				var arr = new Array();

				$(this.datos_filtrados).each(function(index,val){
					if ( index < ($p.index + $p.perPage) ) {
						arr.push(val)
					} else {
						$this.datos_paginados.push( arr )
						arr = [];
						arr.push(val)
						$p.index = index;
					}
					if ( index == ($this.datos_filtrados.length-1)) {
						$this.datos_paginados.push( arr )
					}

				});
			},
			editarMedicamento: function( medicamento ){
				/** Vista de edicion de medicamento
				* cambiamos a la vista para editar
				* un medicamento seleccionado
				* en "activarAnimacion" pasamos el true
				* para activar la animacion de salida,
				* y el nombre de la vista que queremos mostrar
				*/
				this.medicamento_a_manipular 	= medicamento;
				this.activarAnimacion('editar')
			},
			eliminarMedicamento: function( medicamento ){
				/** Vista para eliminar un medicamento
				* cambiamos a la vista para editar
				* un medicamento seleccionado
				*/
				this.medicamento_a_manipular 	= medicamento;
				this.activarAnimacion('eliminar')
			},
			volverVistaListadoMedicamentos: function(){
				/** Vista de listado de medicamentos
				* se apreto en regresar en algun de los otros
				* formularios ('editar','eliminar')
				* y regresamos a la lista
				*/
				this.ejecutar_animacion_salida  = false;
				this.medicamento_a_manipular 	= false;
				this.frm_editar_medicamento 	= false;
      			this.frm_eliminar_medicamento 	= false;

				this.ejecutar_animacion_entrada = true;
				this.frm_listar_medicamentos 	= true;
				setTimeout(() => {
					this.ejecutar_animacion_entrada = false;
				}, this.animacion.duracion * 1000);
			},
			activarAnimacion: function(vista){
				this.ejecutar_animacion_salida  = true;

				setTimeout(() => {
						this.frm_listar_medicamentos 		= false;
			      		if ( vista == 'editar') {
							this.frm_editar_medicamento 	= true;
			      		} else if ( vista == 'eliminar'){
			      			this.frm_eliminar_medicamento 	= true;
			      		}
			    }, this.animacion.duracion * 1000);
			}
		},
		watch:{
			buscar: function () {
				this.datos_filtrados =  this.filtrar_datos;
				this.paginar();
		    },
		},
		computed: {
			getLista(){
				return this.datos_paginados[ this.paginacion.currentPage - 1];
			},
			/** filtrar datos
			* el each toma como grupo de objetos un metodo computado, retorna registros
			* mientras se aplica los filtros y se encuentran coincidencias
			* en caso de no tener filtro retorna todo
			*/
			filtrar_datos(){
				if (this.form) {
			        return this.form.filter(item => {
	        			return 	item.codigo.toString().toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.perfil.nombre.toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.perfil.clasificacion.toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.descripcion.toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.cant_blister.toString().toLowerCase().includes(this.buscar.toLowerCase())
			      	})
		      	}
			},
			activarAnimacionSalidaComponentePadre(){
				if (this.ejecutarSalida) {
					return true;
				}
			}
		}
	}

</script>
