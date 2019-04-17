<template>
<div id="lista-medicamentos" class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 animated fadeInRight" v-if="frm_listar_medicamentos">
		<div class="x_panel">
			<div class="x_title">
				<h4>Listado de medicamentos</h4>
				<div class="clearfix"></div>
				<ul class="nav navbar-left panel_toolbox">
					<a class="btn btn-sm btn-success" @click="crearMedicamentoNuevo" >Nuevo</a>
					<a id="deleteMultipleUsers" class="btn btn-sm btn-danger" @click="eliminarMedicamentos" v-if="'EliminarMedicamentoComponent' in Vue.options.components " >Eliminar</a>
					&nbsp;
					<label> Buscar:
						<input type="search" class="form-control input-sm" v-model="buscar">
					</label>
				</ul>
				<ul class="nav navbar-rigth panel_toolbox">
					<li @click="ocultarListaMedicamentos()"><a  class="collapse-link" id="ocultar-panel-medicamentos"><i class="fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class=""> <!-- se le saco la clase "table-responsive" -->
					<table class="table table-striped jambo_table bulk_action ">
						<thead>
							<tr class="headings">
								<th>
									<input type="checkbox" id="check-all" v-model="check_all" @click="seleccionarTodo">
								</th>
								<th class="column-title" @click ="ordenar_por('codigo')">Codigo </th>
								<th class="column-title" @click ="ordenar_por('perfil','nombre')">Nombre</th>
								<th class="column-title" @click ="ordenar_por('perfil','clasificacion')">Clasificación </th>
								<th class="column-title" @click ="ordenar_por('descripcion')">Descripcion </th>
								<th class="column-title no-link last" @click ="ordenar_por('cant_blister')"><span class="nobr">Cant. por blister</span></th>
								<th class="column-title no-link last"><span class="nobr">Stock Caminal / Remediar / Total</span></th>
								<th class="bulk-actions" colspan="7">
									<a class="antoo" style="color:#fff; font-weight:500;">Usuarios  <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr class="even pointer" v-for="(medicamento ,key) in getLista" :key="key">
								<td class="a-center ">
									<input type="checkbox" :value="medicamento.id" v-model="medicamentos_seleccionados">
								</td>
								<td @click="editarMedicamento(medicamento)"><a> {{medicamento.codigo}} </a></td>
								<td @click="editarMedicamento(medicamento)"><a> {{medicamento.perfil.nombre}} </a></td>
								<td @click="editarMedicamento(medicamento)"><a> {{medicamento.perfil.clasificacion}} </a></td>
								<td @click="editarMedicamento(medicamento)"><a> {{medicamento.descripcion}} </a></td>
								<td class="last"><a><label class='badge badge-success'> {{medicamento.cant_blister}} </label></a>
								<td class="last"><a>
                                    <label class='badge badge-success' style="margin-left:30px!important">30</label>
                                    <label class='badge badge-success' style="margin-left:30px!important">15</label>
                                    <label class='badge badge-success' style="margin-left:30px!important">45</label>

                                </a>
								</td>
							</tr>
						</tbody>
					</table> <!-- BARRA NAVEGACION PAGINAS REGISTROS -->
					<div class="row">
						<div class="col-sm-5">
							<div>
								Pagina <b>{{ paginacion.currentPage }}</b> de <b>{{ paginacion.totalPage }}</b> en {{datos_filtrados.length}} registros.
							</div>
						</div>
						<div class="col-sm-7">
							<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
								<ul class="pagination">
									<li>
										<button @click="paginaAnterior">
											Anterior
										</button>
									</li>
									<li>
										<!--a 	aria-controls="datatable"
											data-dt-idx="1"
											tabindex="0"
											v-for="n in paginacion.totalPage"
											@click="cambiarPagina(n)">
											{{ n }}
										</a-->
									</li>
									<li>
										<button @click="paginaSiguiente">
											Siguiente
										</button>
									</li>
								</ul>
							</div>
						</div>
					</div> <!-- FIN BARRA NAVEGACION PAGINAS REGISTROS -->
				</div>
			</div>
		</div>
	</div>
	<editar-medicamento-component :medicamento="medicamento_a_manipular" @regresar="volverVistaListadoMedicamentos" v-if="frm_editar_medicamento">
	</editar-medicamento-component>

	<crear-medicamento-component  @regresar="volverVistaListadoMedicamentos" v-if="frm_crear_medicamento">
	</crear-medicamento-component>

</div>
</template>

<script>

	export default {
		name: 'lista-medicamentos',
		props: [],
		mounted(){
			var datos = [
				{'id': 1,
				'codigo': 200,
				'perfil': {'nombre':'ibuprofeno','clasificacion':'analgesico'},
				'descripcion': 'comprimido 500mg',
				'cant_blister': '50',
				'stock': {'cantidad':50}},
				{'id':2,
				'codigo': 300,
				'perfil': {'nombre':'amoxicilina','clasificacion':'antibiotico'},
				'descripcion': 'comprimido 1500mg',
				'cant_blister': '45',
				'stock': {'cantidad':30}},
			];
			this.form = datos;
			this.datos_filtrados = this.form;
			this.paginar();
			/*axios.get( 'administracion/medicamentos/').then(
				response => {
					var r = response.data;
					if (r.success) {
						this.form = r.lista_medicamentos.sort(this.sort_by('codigo', true, function(a){return a}));
						this.datos_filtrados = this.form;
						this.paginar();
					}
				}
			);*/
		},
		data(){
			return {
				//vistas
				frm_listar_medicamentos : true,
                frm_editar_medicamento 	: false,
                frm_crear_medicamento : false,
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
				medicamento_a_manipular: false, // para pasar a la vista de edicion
				check_all: false, //checkbox para colocar o quitar todos los checks de todos los medicamentos para eliminar
				medicamentos_seleccionados: [], //para eliminar
			}
		},
		methods: {
            crearMedicamentoNuevo : function (){
                this.frm_listar_medicamentos = false;
                this.frm_crear_medicamento = true;
            },
			ordenar_por: function(campo , segundo_campo = null){
				let f = this.sort_fields;

				if ( f.campo == campo ) {
					f.reverse = f.reverse ? false : true;
				} else{
					f.campo 	= campo;
					f.reverse 	= false;
				}
				// aca no preguntar, la funcion para ordenar por campo fue extraida de internet
				// y modificada infimamente
				this.datos_filtrados = this.datos_filtrados.sort(
					this.sort_by(campo , this.sort_fields.reverse, function(a){
						if (segundo_campo == 'nombre') {
							a = a.nombre;
						} else if(segundo_campo == 'clasificacion'){
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
				this.frm_listar_medicamentos 	= false;
				this.frm_editar_medicamento 	= true;
			},
			seleccionarTodo: function(){
				/** Para eliminar
				* Selecciona todos los checkbox de los medicamentos
				* para eliminarlos
				* @Pepe
				*/
				if (this.check_all) {
					this.medicamentos_seleccionados = [];
					return;
				}
				this.medicamentos_seleccionados = this.form.map(medicamento=>{
					return medicamento.id;
				})
			},
			eliminarMedicamentos: function(){
				if (this.medicamentos_seleccionados.length < 1) {return;}
				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-success',
						cancelButton: 'btn btn-danger'
					},
					buttonsStyling: false,
				})

				swalWithBootstrapButtons.fire({
					title: 'Lista de medicamentos a eliminar:',
					text: this.getListaMedicamentosEiminar,//"No podra revertir esto!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Si, eliminar!',
					cancelButtonText: 'No, cancelar!',
					reverseButtons: true
				}).then((result) => {
					if (result.value) {
						swalWithBootstrapButtons.fire(
						'Eliminado',
						'Los medicamentos fueron eliminados.',
						'success'
						)
					} else if (
						// Read more about handling dismissals
						result.dismiss === Swal.DismissReason.cancel
					) {
						swalWithBootstrapButtons.fire(
						'Cancelado',
						'Proceso de eliminacion cancelado',
						'error'
						)
					}
				});
			},
			volverVistaListadoMedicamentos: function(){
				/** Vista de listado de medicamentos
				* se apreto en regresar en algun de los otros
				* formularios ('editar','eliminar')
				* y regresamos a la lista
				*/
				this.medicamento_a_manipular 	= false;
				this.frm_editar_medicamento 	= false;
				this.frm_listar_medicamentos 	= true;
                this.frm_crear_medicamento 	    = false;

			},
			ocultarListaMedicamentos: function(){
					var $BOX_PANEL = $('#ocultar-panel-medicamentos').closest('.x_panel'),
							$ICON = $('#ocultar-panel-medicamentos').find('i'),
							$BOX_CONTENT = $BOX_PANEL.find('.x_content');
					// fix for some div with hardcoded fix class
					if ($BOX_PANEL.attr('style')) {
							$BOX_CONTENT.slideToggle(200, function(){
									$BOX_PANEL.removeAttr('style');
							});
					} else {
							$BOX_CONTENT.slideToggle(200);
							$BOX_PANEL.css('height', 'auto');
					}
					$ICON.toggleClass('fa-chevron-up fa-chevron-down');
			},
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
			getListaMedicamentosEiminar(){
				var texto = '';
				let $this = this;
				var contador = 0;
				$(this.form).each(function(index,medicamento){
					contador++;
					if ($this.medicamentos_seleccionados.indexOf(medicamento.id) != -1) {
						texto += contador + ") " + medicamento.perfil.nombre + "...";
					}
				})
				return texto;
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
		}
	}

</script>
