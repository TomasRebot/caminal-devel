<template>
<div class="row" id="buscar-proveedor">
    <div class="col-md-12 col-sm-12 col-xs-12" v-if="!mostrar_crear_proveedor">
		<div class="x_panel">
			<div class="x_title">
                <h4 class="StepTitle">Busqueda de proveedor</h4>
				<div class="clearfix"></div>
				<ul class="nav navbar-left panel_toolbox">
					<a class="btn btn-sm btn-success" @click="crearProveedor" >
                        Nuevo
                    </a>
					&nbsp;
					<label> Buscar:
						<input type="search" class="form-control input-sm" v-model="buscar">
					</label>
				</ul>
                <ul class="nav navbar-rigth panel_toolbox">
					<li @click="ocultarListaProveedores()"><a  class="collapse-link" id="ocultar-panel-instituciones"><i class="fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class=""> <!-- se le saco de la clase "table-responsive" -->
					<table class="table table-striped jambo_table bulk_action">
						<thead>
							<tr class="headings">
								<th class="column-title" @click="ordenar_por('nombre')">NOMBRE </th>
								<th class="column-title" @click="ordenar_por('razon_social')">RAZON SOCIAL </th>
								<th class="column-title no-link last" @click="ordenar_por('direccion')">DIRECCION </th>
							</tr>
						</thead>
						<tbody>
							<tr class="even pointer" v-for="(proveedor , key) in getLista" :key="key">
								<td @click="seleccionarProveedor(proveedor)"><a> {{proveedor.nombre}} </a></td>
								<td @click="seleccionarProveedor(proveedor)"><a> {{proveedor.razon_social}} </a></td>
								<td class="last" @click="seleccionarProveedor(proveedor)"><a> {{proveedor.direccion}} </a></td>
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
    <crear-proveedor-component :regresar="true" @regresar="guardarProveedor" v-if="mostrar_crear_proveedor">
    </crear-proveedor-component>
</div>
</template>

<script>


export default {
    name: 'buscar-proveedor',
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
            mostrar_crear_proveedor: false,
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
        crearProveedor:function(){
            const modal = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            });

            modal.fire({
                title: 'Registrar nuevo proveedor',
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
        guardarProveedor: function(proveedor=null){
            if (proveedor!=null) {
                this.form.push(proveedor);
            }
            this.mostrar_crear_proveedor = false;
            this.paginar();
        },
        seleccionarProveedor: function( proveedor ){
            this.$emit('proveedor-seleccionado' , proveedor);
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
        ocultarListaProveedores: function(){
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
                            item.razon_social.toLowerCase().includes(this.buscar.toLowerCase()) ||
                            item.direccion.toLowerCase().includes(this.buscar.toLowerCase())
                })
            }
        },
    },
}

</script>
