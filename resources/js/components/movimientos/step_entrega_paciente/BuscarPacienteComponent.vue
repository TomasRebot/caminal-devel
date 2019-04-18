<template>
<div class="row" id="buscar-paciente">
    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInRight" v-if="!mostrar_frm_crear_paciente">
		<div class="x_panel">
			<div class="x_title">
                <h3 class="StepTitle">Busqueda de paciente</h3>
				<div class="clearfix"></div>
				<ul class="nav navbar-left panel_toolbox">
					<a class="btn btn-sm btn-success" @click="crearPaciente" v-if="'CrearPacienteComponent' in Vue.options.components">Nuevo</a>
					&nbsp;
					<label> Buscar: 
						<input type="search" class="form-control input-sm" v-model="buscar">
					</label>
				</ul>
                <ul class="nav navbar-rigth panel_toolbox">
					<li @click="ocultarListaPacientes()"><a  class="collapse-link" id="ocultar-panel-pacientes"><i class="fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class=""> <!-- se le saco de la clase "table-responsive" -->
					<table class="table table-striped jambo_table bulk_action">
						<thead>
							<tr class="headings">
								<th class="column-title" @click ="ordenar_por('apellido')">APELLIDO </th>
								<th class="column-title" @click ="ordenar_por('nombre')">NOMBRE </th>
								<th class="column-title no-link last" @click ="ordenar_por('dni')">DNI </th>
                            </tr>
						</thead>
						<tbody>
							<tr class="even pointer" v-for="(paciente , key) in getLista" :key="key">						
								<td @click="seleccionarPaciente(paciente)"><a> {{paciente.apellido}} </a></td>
								<td @click="seleccionarPaciente(paciente)"><a> {{paciente.nombre}} </a></td>
								<td class="last" @click="seleccionarPaciente(paciente)"><a> {{paciente.dni}} </a></td>
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
    <crear-paciente-component :regresar="true" @regresar="guardarPaciente" v-if="mostrar_frm_crear_paciente"></crear-paciente-component>
</div>
</template>

<script>


export default {
    name: 'buscar-paciente',
    props: [],
    mounted(){
        //this.form = r.lista_pacientes.sort(this.sort_by('dni', true, function(a){return a}));
        this.form = [
            {'apellido' : 'moreira', 'nombre': 'ezequiel' , 'dni' : 35555555},
                {'apellido' : 'tomas', 'nombre': 'tomas' , 'dni' : 333333333}
            ];
        this.datos_filtrados = this.form;
        this.paginar();
    },
    data(){
        return {
            mostrar_frm_crear_paciente: false,
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
        seleccionarPaciente: function(paciente){
            this.$emit('paciente-seleccionado' , paciente);
        },
        crearPaciente: function(){
            const modal = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            });
            
            modal.fire({
                title: 'Crear nuevo paciente',
                text: "Ingrese datos personales.",
                type: 'warning',
                html:  `
                        <form class="form-horizontal form-label-left">
                            <div class="ln_solid"></div>  
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-apellido">
                                    APELLIDO:
                                </label>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <input type="text" id="input-apellido" placeholder="Ingrese el apellido" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-nombre">
                                    NOMBRE:
                                </label>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <input type="text" id="input-nombre" placeholder="Ingrese el nombre" required class="form-control">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-3 col-xs-3" for="input-dni">
                                    DNI:
                                </label>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <input type="number" id="input-dni" placeholder="Ingrese el dni" required class="form-control">
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
                        inputs = { 'apellido' : document.getElementById('input-apellido').value,
                                    'nombre' : document.getElementById('input-nombre').value,
                                    'dni' : document.getElementById('input-dni').value };
                        
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
                            position: 'top-end',
                            type: 'success',
                            title: 'Paciente creado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.form.push(result.value);
                        this.paginar();
                    } else if (result.dismiss === Swal.DismissReason.cancel){
                        modal.fire({
                            position: 'top-end',
                            title: 'Cancelado',
                            type: 'error',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });         
        },
        guardarPaciente: function(paciente=null){
            if(paciente!=null){
                this.form.push(paciente);    
            }     
            this.paginar();   
            this.mostrar_frm_crear_paciente = false;   
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
        ocultarListaPacientes: function(){
            var $BOX_PANEL = $('#ocultar-panel-pacientes').closest('.x_panel'),
                    $ICON = $('#ocultar-panel-pacientes').find('i'),
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
                    return 	item.apellido.toString().toLowerCase().includes(this.buscar.toLowerCase()) ||
                            item.nombre.toLowerCase().includes(this.buscar.toLowerCase()) ||
                            item.dni.toString().toLowerCase().includes(this.buscar.toLowerCase())
                })
            }
        },
    },
}

</script>