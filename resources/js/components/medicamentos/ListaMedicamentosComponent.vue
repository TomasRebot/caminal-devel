<template>
	
	<div class="col-md-12 col-sm-12 col-xs-12" id="lista-medicamentos">
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
                    						<option v-for="n in 5" v-bind:value="n*5">
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
                  							v-for 		= "campo in key_tabla">
                  							<div class="row" @click ="ordenar_por(campo.key)">
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
                  					<tr role="row" class="odd" v-for="d in getLista">
			                          	<td class="sorting_1"> {{ d.cell }} </td>
			                          	<td> {{d.email}} </td>
			                          	<td> {{d.gender}} </td>
			                          	<td> {{d.name.first}} </td>
			                          	<td> {{d.phone}} </td>
			                          	<td> {{d.nat}} </td>
			                        </tr>
			                    </tbody>

			                    </table>
                		</div>
        			</div>
    				<div class="row">
    					<div class="col-sm-5">
    						<div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">		
    							Pagina <b>{{ paginacion.currentPage }}</b> de <b>{{ paginacion.totalPage }}</b> en {{datos_filtrados.length}} registros.
    						</div>
						</div>
    					<div class="col-sm-7">
							<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
								<ul class="pagination">
									<li class="paginate_button previous disabled" id="datatable_previous">
										<a 	href 			= "#" 
											aria-controls 	= "datatable" 
											data-dt-idx 	= "0" 
											tabindex 		= "0"
											@click 			= "paginaAnterior">			
											Previous
										</a>
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
										<a 	href 			= "#" 
											aria-controls 	= "datatable" 
											data-dt-idx 	= "7" 
											tabindex 		= "0"
											@click 			= "paginaSiguiente">
											Next
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
         	</div>
    	</div>
  	</div>

</template>

<script>
	
const axios = require('axios');

	export default {
		name: 'lista-medicamentos',
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
					campo 	: '',
					reverse : false,
				},
				buscar: '',
				datos_filtrados: {},
				key_tabla: [
					{ 'titulo': 'Cell' 	, 'key': 'cell',},
					{ 'titulo': 'Email' , 'key': 'email',},
					{ 'titulo': 'Gender', 'key': 'gender',},
					{ 'titulo': 'Name' 	, 'key': 'name',},
					{ 'titulo': 'Phone' , 'key': 'phone',},
					{ 'titulo': 'Nat' 	, 'key': 'nat',},
				],
			}
		},
		mounted(){
			axios.get( 'https://randomuser.me/api/?results=100' )
				.then(response => {
					var r = response.data.results;

					this.form = r.sort(this.sort_by('email', true, function(a){return a.toUpperCase()}));
					this.datos_filtrados = r;
					this.paginar();
			})

		},
		methods: {
			ordenar_por: function( campo ){
				let f = this.sort_fields;

				if ( f.campo == campo ) {
					f.reverse = f.reverse ? false : true;
				} else{
					f.campo 	= campo;
					f.reverse 	= false;
				}

				this.datos_filtrados = this.datos_filtrados.sort(	this.sort_by( 	campo , 
																	this.sort_fields.reverse, 
																	function(a){ 
																		if (f.campo == 'name') {
																			a = a.first;
																		}
																		return a.toUpperCase()}));
				this.paginar();
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
			sort_by:  function(field, reverse, primer){

			   	var key = primer ? 
		       		function(x) {return primer(x[field])} : 
		       		function(x) {return x[field]};

			   	reverse = !reverse ? 1 : -1;

			   	return function (a, b) {
			       return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
		     	} 
			},
			cambiarCantidadPorPagina(){
				this.paginar();
			},
			/*cambiarPagina: function(n){
				this.paginacion.currentPage = n;
			},*/
			paginar: function(){
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
			buscar: function (nuevaBusqueda, viejaBusqueda) {
				this.datos_filtrados =  this.filtrar_datos;
				this.paginar();
		    },
		},
		computed: {
			getLista(){
				if (this.datos_paginados.length > 0 ) { 
					return this.datos_paginados[ this.paginacion.currentPage - 1];
				}
			},
			filtrar_datos(){
				if (this.form) {
			        return this.form.filter(item => {
	        			return 	item.cell.toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.email.toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.gender.toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.name.first.toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.phone.toLowerCase().includes(this.buscar.toLowerCase()) ||
	        					item.nat.toLowerCase().includes(this.buscar.toLowerCase()) 
			      	})
		      	}
			}
		}
	}

</script>