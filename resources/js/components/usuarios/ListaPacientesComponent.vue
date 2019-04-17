<template>
<div class="row" id="lista-pacientes">
    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInRight" v-if="!mostrar_frm_crear_paciente && !mostrar_frm_editar_paciente">
		<div class="x_panel">
			<div class="x_title">
                <h3 class="StepTitle">Listado de pacientes</h3>
				<div class="clearfix"></div>
				<ul class="nav navbar-left panel_toolbox">
					<a class="btn btn-sm btn-success" @click="crearPaciente" v-if="'CrearPacienteComponent' in Vue.options.components">Nuevo</a>
					<a id="deleteMultipleUsers" class="btn btn-sm btn-danger" @click="eliminarPaciente" v-if="'EliminarPacienteComponent' in Vue.options.components " >Eliminar</a>
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
                                <th>
									<input type="checkbox" id="check-all" v-model="check_all" @click="seleccionarTodo">
								</th>
								<th class="column-title" @click ="ordenar_por('apellido')">APELLIDO </th>
								<th class="column-title" @click ="ordenar_por('nombres')">NOMBRE </th>
								<th class="column-title no-link last" @click ="ordenar_por('dni')">DNI </th>
                            </tr>
						</thead>
						<tbody>
                            <tr class="even pointer" v-for="(paciente , key) in getLista" :key="key">			
                                <td class="a-center ">
                                    <input type="checkbox" :value="paciente.id" v-model="pacientes_seleccionados">
                                </td>			
								<td @click="editarPaciente(paciente)"><a> {{paciente.apellido}} </a></td>
								<td @click="editarPaciente(paciente)"><a> {{paciente.nombres}} </a></td>
								<td class="last" @click="editarPaciente(paciente)"><a> {{paciente.dni}} </a></td>
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
    <editar-paciente-component :paciente="editar_paciente"  @regresar="guardarPaciente" v-if="mostrar_frm_editar_paciente"></editar-paciente-component>
</div>
</template>

<script>


export default {
    name: 'lista-pacientes',
    props: [],
    mounted(){
        //this.form = r.lista_pacientes.sort(this.sort_by('dni', true, function(a){return a}));
        this.form = [
            {'id':1,'apellido' : 'moreira', 'nombres': 'ezequiel' , 'dni' : 35555555},
                {'id':2,'apellido' : 'tomas', 'nombres': 'tomas' , 'dni' : 333333333}
            ];
        this.datos_filtrados = this.form;
        this.paginar();
    },
    data(){
        return {
            mostrar_frm_crear_paciente: false,
            mostrar_frm_editar_paciente: false,
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
            datos_filtrados: [],
            editar_paciente: false,
            check_all: false, //checkbox para colocar o quitar todos los checks de todos los pacientes para eliminar
			pacientes_seleccionados: [],
        }
    },
    methods: {
        editarPaciente: function(paciente){
            var eliminar_index = null;
            $(this.form).each(function(index,val){
                if (val.dni == paciente.dni) {
                    eliminar_index = index;
                    return false;
                }
            });
            this.form.splice(eliminar_index , 1);
            this.editar_paciente = paciente;
            this.mostrar_frm_editar_paciente = true;
        },
        crearPaciente: function(){
            this.mostrar_frm_crear_paciente = true;            
        },
        guardarPaciente: function(paciente=null){
            if(paciente!=null){
                this.form.push(paciente);    
            } else {
                if(this.mostrar_frm_editar_paciente){
                    this.form.push(this.editar_paciente);  
                }
            }     
            this.paginar();   
            this.mostrar_frm_crear_paciente = false;            
            this.mostrar_frm_editar_paciente = false;   
            this.editar_paciente = false;
        },
        seleccionarTodo: function(){
            /** Para eliminar
            * Selecciona todos los checkbox de los pacientes
            * para eliminarlos
            * @Pepe
            */
            if (this.check_all) {
                this.pacientes_seleccionados = [];
                return;
            }
            this.pacientes_seleccionados = this.form.map(paciente=>{
                return paciente.id;
            })
        },
        eliminarPaciente: function(){
            if (this.pacientes_seleccionados.length < 1) {return;}
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: 'Lista de medicamentos a eliminar:',
                text: this.getListaPacientesEiminar,//"No podra revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    let that = this;
                    $(this.form).each(function(index,paciente){
                        if (that.pacientes_seleccionados.indexOf(paciente.id) != -1) {
                            that.form.splice(index);
                        }
                    });
                    this.pacientes_seleccionados = [];
                    this.paginar();
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
        getListaPacientesEiminar(){
            var texto = '';
            let $this = this;
            var contador = 0;
            $(this.form).each(function(index,paciente){
                contador++;
                if ($this.pacientes_seleccionados.indexOf(paciente.id) != -1) {
                    texto += contador + ") " + paciente.apellido + "...";
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
                    return 	item.apellido.toString().toLowerCase().includes(this.buscar.toLowerCase()) ||
                            item.nombres.toLowerCase().includes(this.buscar.toLowerCase()) ||
                            item.dni.toString().toLowerCase().includes(this.buscar.toLowerCase())
                })
            }
        },
    },
}

</script>