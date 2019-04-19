<template>
<div class="row" id="buscar-institucion">
    <div class="col-md-12 col-sm-12 col-xs-12 " v-if="!mostrar_crear_institucion">
		<div class="x_panel">
			<div class="x_title">
                <h4 class="StepTitle">Busqueda de instituciones</h4>
				<div class="clearfix"></div>
				<ul class="nav navbar-left panel_toolbox">
					<a class="btn btn-sm btn-success" @click="crearInstitucion" v-if="'CrearInstitucionComponent' in Vue.options.components">
                        Nuevo
                    </a>
					&nbsp;
					<label> Buscar:
						<input type="search" class="form-control input-sm" v-model="buscar">
					</label>
				</ul>
                <ul class="nav navbar-rigth panel_toolbox">
					<li @click="ocultarListaInstituciones()"><a  class="collapse-link" id="ocultar-panel-instituciones"><i class="fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class=""> <!-- se le saco de la clase "table-responsive" -->
					<table class="table table-striped jambo_table bulk_action">
						<thead>
							<tr class="headings">
								<th class="column-title" @click="ordenar_por('nombre')">NOMBRE INSTITUCION </th>
								<th class="column-title" @click="ordenar_por('direccion')">DIRECCION </th>
								<th class="column-title no-link last" @click="ordenar_por('telefono')">TELEFONO </th>
							</tr>
						</thead>
						<tbody>
							<tr class="even pointer" v-for="(institucion , key) in getLista" :key="key">
								<td @click="seleccionarInstitucion(institucion)"><a> {{institucion.nombre}} </a></td>
								<td @click="seleccionarInstitucion(institucion)"><a> {{institucion.direccion}} </a></td>
								<td class="last" @click="seleccionarInstitucion(institucion)"><a> {{institucion.telefono}} </a></td>
                            </tr>
						</tbody>
					</table> <!-- BARRA NAVEGACION PAGINAS REGISTROS -->
					<div class="row" v-if="paginacion.totalPage>1">
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
    <crear-institucion-component :regresar="true" @regresar="guardarInstitucion" v-if="mostrar_crear_institucion">
    </crear-institucion-component>
</div>
</template>

<script>


export default {
    name: 'buscar-institucion',
    props: [],
    mounted(){
        //this.form = r.lista_clientes.sort(this.sort_by('dni', true, function(a){return a}));
        this.form = [
            {'nombre' : 'moreira', 'direccion': 'coliqueo' , 'telefono' : '505050' , 'razon': '','cuit':''},
                {'nombre' : 'rebot', 'direccion': 'suipacha' , 'telefono': '0800', 'razon': '','cuit':''}
            ];
        this.datos_filtrados = this.form;
        this.paginar();
    },
    data(){
        return {
            mostrar_crear_institucion: false,
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
        }
    },
    methods: {
        crearInstitucion:function(){
            const modal = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            });

            modal.fire({
                title: 'Agregar nueva institucion',
                text: "Ingrese datos de la institucion.",
                type: 'custom icon',
                imageUrl: window.location +"/images/iconos-dashboard/hospital.png",
                imageWidth: 100,
                imageHeight:100,
                width: 500,
                html: `
                       <form class="form-horizontal form-label-left">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-nombre">
                                    NOMBRE:
                                </label>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <input type="text" id="input-nombre" placeholder="Ingrese el nombre" required class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-razon">
                                    RAZON SOCIAL:
                                </label>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <input type="text" id="input-razon" placeholder="Ingrese la razon social" required class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-cuit">
                                    CUIT:
                                </label>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <input type="number" id="input-cuit" placeholder="Ingrese el cuit" required class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-direccion">
                                    DIRECCION:
                                </label>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <input type="text" id="input-direccion" placeholder="Ingrese la direccion" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-telefono">
                                    TELÉFONO:
                                </label>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <input type="text" id="input-telefono" placeholder="Ingrese un teléfono" required class="form-control">
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
                        inputs = { 'nombre' : document.getElementById('input-nombre').value,
                                    'razon' : document.getElementById('input-razon').value,
                                    'cuit' : document.getElementById('input-cuit').value ,
                                    'telefono' : document.getElementById('input-telefono').value ,
                                    'direccion' : document.getElementById('input-direccion').value };

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
                            title: 'Institucion creada exitosamente.',
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
        guardarInstitucion: function(institucion=null){
            if (institucion!=null) {
                this.form.push(institucion);
            }
            this.mostrar_crear_institucion = false;
            this.paginar();
        },
        seleccionarInstitucion: function( institucion ){
            this.$emit('institucion-seleccionada' , institucion);
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
                                                                    if ( campo == 'telefono') {
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
        ocultarListaInstituciones: function(){
            var $BOX_PANEL = $('#ocultar-panel-instituciones').closest('.x_panel'),
                    $ICON = $('#ocultar-panel-instituciones').find('i'),
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
        /** filtrar datos
        * el each toma como grupo de objetos un metodo computado, retorna registros
        * mientras se aplica los filtros y se encuentran coincidencias
        * en caso de no tener filtro retorna todo
        */
        filtrar_datos(){
            if (this.form) {
                return this.form.filter(item => {
                    return 	item.nombre.toString().toLowerCase().includes(this.buscar.toLowerCase()) ||
                            item.direccion.toLowerCase().includes(this.buscar.toLowerCase())
                })
            }
        },
    },
}

</script>
