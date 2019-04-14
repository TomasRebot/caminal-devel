<template>
	<div 	id="buscar-cliente"
			class="col-md-12 col-sm-12 col-xs-12"
			:class  = "{ 'animated fadeInRight'  : ejecutar_animacion_entrada,
						 'animated fadeOutRight' : activarAnimacionSalidaComponentePadre || ejecutar_animacion_salida}"
			:style  = "style_object_animacion">
		<div class="x_panel">
			<div class="x_title">
				<h2>Lista <small>de clientes</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<p class="text-muted font-13 m-b-30">
					Lista completa de clientes, puede buscar por cualquiera de los campos en la barra de "Buscar"
				</p>
				<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
					<div class="row">
						<div class="col-sm-6">
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
											v-for 		= "(campo , key) in key_tabla"
											:key 		= "key">
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
									<tr role="row" class="odd" v-for="(d , key) in getLista" :key="key">
										<td class="sorting_1"> {{ d.apellido }} </td>
										<td> {{d.nombres}} </td>
										<td> {{d.dni}} </td>
										<td> {{d.direccion}} </td>
										<td> {{d.telefono}} </td>
										<td> {{d.celular}} </td>
										<td class="text-center">
											<button type 	= "button"
													class 	= "btn btn-success btn-lg"
													@click 	= "seleccionarCliente(d)">
													<i class="fa fa-check"></i>
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
</template>

<script>


export default {
    name: 'buscar-cliente',
    props: [ 'animacion' ], // si se cambia la vista desde el Dashboard
    mounted(){
        setTimeout(()=>{
            this.ejecutar_animacion_entrada 		= false;
        } , this.animacion.duracion * 1000);

                    //this.form = r.lista_clientes.sort(this.sort_by('dni', true, function(a){return a}));
                    this.form = [
                        {'apellido' : 'moreira', 'nombres': 'ezequiel' , 'dni' : 35555555},
                         {'apellido' : 'tomas', 'nombres': 'tomas' , 'dni' : 333333333}
                        ];
                    this.datos_filtrados = this.form;
                    this.paginar();

    },
    data(){
        return {
            ejecutar_animacion_entrada: true,
            ejecutar_animacion_salida : false,
            style_object_animacion 	  : {
                '-webkit-animation-duration': this.animacion.duracion,
                '-webkit-animation-delay'   : this.animacion.delay,
            },
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
                { 'titulo': 'Apellido' 	, 'key': 'apellido',},
                { 'titulo': 'Nombres' 	, 'key': 'nombres',},
                { 'titulo': 'Dni'		, 'key': 'dni',},
            ],
        }
    },
    methods: {
        seleccionarCliente: function( cliente ){
            this.ejecutar_animacion_salida = true;
            this.$emit('cliente-seleccionado' , cliente);
        },
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
                                                                    if ( campo == 'dni' || campo == 'telefono' ||
                                                                            campo == 'celular') {
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
                    return 	item.apellido.toString().toLowerCase().includes(this.buscar.toLowerCase()) ||
                            item.nombres.toLowerCase().includes(this.buscar.toLowerCase()) ||
                            item.dni.toString().toLowerCase().includes(this.buscar.toLowerCase())
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
