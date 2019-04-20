<template>
<div id="buscar-medicamento" class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 ">
		<div class="x_panel">
			<div class="x_title">
				<h4 class="StepTitle">Busqueda de medicamento</h4>
				<div class="clearfix"></div>
				<ul class="nav navbar-left panel_toolbox">
                    <a class="btn btn-sm btn-success" @click="crearMedicamento" v-if="'CrearMedicamentoComponent' in Vue.options.components">Nuevo</a>
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
				<div class=""> <!-- se saco la clase "table-responsive" -->
					<table class="table table-striped jambo_table bulk_action">
						<thead>
							<tr class="headings">
								<th class="column-title" @click ="ordenar_por('codigo')">CODIGO </th>
								<th class="column-title" @click ="ordenar_por('perfil','nombre')">NOMBRE </th>
								<th class="column-title" @click ="ordenar_por('perfil','clasificacion')">CLASIFICACION </th>
								<th class="column-title" @click ="ordenar_por('descripcion')">DESCRIPCION </th>
								<th class="column-title no-link last" @click ="ordenar_por('cant_blister')"><span class="nobr">CANT. POR BLISTER</span></th>
							</tr>
						</thead>
						<tbody>
							<tr class="even pointer" v-for="(medicamento ,key) in getLista" :key="key">
								<td @click="seleccionarMedicamento(medicamento)"><a> {{medicamento.codigo}} </a></td>
								<td @click="seleccionarMedicamento(medicamento)"><a> {{medicamento.perfil.nombre}} </a></td>
								<td @click="seleccionarMedicamento(medicamento)"><a> {{medicamento.perfil.clasificacion}} </a></td>
								<td @click="seleccionarMedicamento(medicamento)"><a> {{medicamento.descripcion}} </a></td>
								<td @click="seleccionarMedicamento(medicamento)" class="last"><a><div class='badge badge-md-success'> {{medicamento.cant_blister}} </div></a>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="row" v-if="paginacion.totalPage>1"> <!-- BARRA NAVEGACION PAGINAS REGISTROS -->
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
			<div class="clearfix"></div>
			<div class="row"> <!-- LISTA MEDICAMENTOS AGREGADOS -->
				<div class="col-sm-12">
					<p><label> Lista agregados: </label></p>
					<ul>
						<li v-for="(medicamento , key) in getListaMedicamentosSeleccionados" :key="key">
							<a class="btn" @click="editarMedicamentoAgregado(medicamento)"> Nombre: {{medicamento.perfil.nombre}}, Clasificacion: {{medicamento.perfil.clasificacion}}, CANTIDAD: {{medicamento.cantidad_entrega}} </a>
						</li>
					</ul>
				</div>
			</div><!-- FIN LISTA MEDICAMENTOS AGREGADOS -->
		</div>
	</div>
</div>
</template>

<script>

	export default {
		name: 'buscar-medicamento',
		props: [],
		mounted(){
			var datos = [
				{'codigo': 200,
				'perfil': {'nombre':'ibuprofeno','clasificacion':'analgesico'},
				'descripcion': 'comprimido 500mg',
				'cant_blister': '50',
				'stock': {'cantidad':50}},
				{'codigo': 300,
				'perfil': {'nombre':'amoxicilina','clasificacion':'antibiotico'},
				'descripcion': 'comprimido 1500mg',
				'cant_blister': '45',
				'stock': {'cantidad':30}},
				];
			this.form = datos
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
				medicamentos_seleccionados: [],
				recargar: true, //recarga lista de medicamentos agregado cuando se actualiza
			}
		},
		methods: {
             crearMedicamento: function(){
                const modal = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false,
                });

                modal.fire({
                    title: 'Agregar un nuevo medicamento',
                    text: "Ingrese datos personales.",
                    type: 'custom icon',
                    imageUrl: window.location +"/images/iconos-dashboard/medicamento.png",
                    imageWidth: 100,
                    imageHeight:100,
                    width: 400,
                    html:  `
                            <form class="form-horizontal form-label-left">
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-codigo">
                                        CÓDIGO:
                                    </label>
                                    <div class="col-md-8 col-sm-9 col-xs-9">
                                        <input type="text" id="input-codigo" placeholder="Ingrese codigo de medicamento" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-nombre">
                                        NOMBRE:
                                    </label>
                                    <div class="col-md-8 col-sm-9 col-xs-9">
                                        <input type="text" id="input-nombre" placeholder="Ingrese el nombre" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-clasificacion">
                                        CLASIFICACION:
                                    </label>
                                    <div class="col-md-8 col-sm-9 col-xs-9">
                                        <input type="text" id="input-clasificacion" placeholder="Ingrese la clasificacion" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-descripcion">
                                        DESCRIPCIÓN:
                                    </label>
                                    <div class="col-md-8 col-sm-9 col-xs-9">
                                        <input type="text" id="input-descripcion" placeholder="Ingrese una descripcion" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-cantidadBlister">
                                        CANTIDAD X BLISTER:
                                    </label>
                                    <div class="col-md-8 col-sm-9 col-xs-9">
                                        <input type="number" id="input-cantidadBlister" placeholder="Ingrese la cantidad x blister" class="form-control">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                            </form>
                            `,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Crear',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    preConfirm: (form)=>{
                            var inputs = new Object();
                            inputs = { 'codigo' : document.getElementById('input-codigo').value,
                                        'nombre' : document.getElementById('input-nombre').value,
                                        'clasificacion' : document.getElementById('input-clasificacion').value,
                                        'descripcion' : document.getElementById('input-descripcion').value,
                                        'cantidadBlister' : document.getElementById('input-cantidadBlister').value };

                            Object.keys(inputs).forEach(function(key) {
                                if(inputs[key].length == 0){
                                    Swal.showValidationMessage(
                                        `Error: campos sin completar`
                                    );
                                }
                                return false;
                            });
                            return inputs;
                        },
                    }).then((result) => {
                        if (result.value) {
                            modal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Medicamento creado exitosamente.',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            this.form.push(result.value);
                            this.paginar();
                        } else if (result.dismiss === Swal.DismissReason.cancel){
                            modal.fire({
                                position: 'center',
                                title: 'Cancelado',
                                type: 'error',
                                showConfirmButton: false,
                                timer: 700
                            });
                        }
                    });
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
			seleccionarMedicamento: function(agregar_medicamento){
				Swal.fire({
					title: 'Ingrese la cantidad a entregar',
					input: 'number',
					inputValue: '',
					showCancelButton: true,
					confirmButtonText: 'Agregar',
					reverseButtons: true,
					inputValidator: (value) => {
						if (!value) {
							return 'Debe ingresar la cantidad'
						} else {
							let that = this;
							agregar_medicamento['cantidad_entrega']=value;
							this.medicamentos_seleccionados.push(agregar_medicamento);
							$(this.form).each(function(index,medicamento){
									if(medicamento.codigo == agregar_medicamento.codigo){
										that.form.splice(index,1);
										that.paginar();
									}
								})
							this.$emit('medicamentos-seleccionados',this.medicamentos_seleccionados);
						}
					}
				});
			},
			editarMedicamentoAgregado: function(editar_medicamento){
				Swal.fire({
					title: 'Editar cantidad medicamento agregado',
					text: editar_medicamento.perfil.nombre,
					input: 'number',
					inputValue: '',
					customClass: {
						confirmButton: 'btn btn-success',
						cancelButton: 'btn btn-danger'
					},
					buttonsStyling: false,
					showCancelButton: true,
					cancelButtonText: 'Quitar',
					confirmButtonText: 'Confirmar',
					reverseButtons: true,
					inputValidator: (value) => {
						if (!value) {
							return 'Debe ingresar la cantidad'
						} else {
							$(this.medicamentos_seleccionados).each(function(index,medicamento){
								if(medicamento.codigo == editar_medicamento.codigo){
									medicamento.cantidad_entrega = value;
								}
							});
							this.recargar = false;
							this.$nextTick(()=>{
								this.recargar = true
							});
							this.$emit('medicamentos-seleccionados',this.medicamentos_seleccionados);
						}
					}
				}).then((result) => {
					if (result.dismiss === Swal.DismissReason.cancel) {
						let that = this;
						this.form.push(editar_medicamento);
						$(this.medicamentos_seleccionados).each(function(index,medicamento){
							if(medicamento.codigo == editar_medicamento.codigo){
									that.medicamentos_seleccionados.splice(index,1);
							}
						});
						this.paginar();
					}
				});
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
			getListaMedicamentosSeleccionados(){
				return this.recargar ? this.medicamentos_seleccionados : null;
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
