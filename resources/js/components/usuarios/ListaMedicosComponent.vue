<template>
<div class="row" id="lista-medicos">
    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInRight" v-if="!mostrar_frm_crear_medico && !mostrar_frm_editar_medico">
		<div class="x_panel">
			<div class="x_title">
                <h4 class="StepTitle">Listado de profesionales</h4>
				<div class="clearfix"></div>
				<ul class="nav navbar-left panel_toolbox">
					<a class="btn btn-sm btn-success" @click="crearMedico" v-if="'CrearMedicoComponent' in Vue.options.components">Nuevo</a>
					<a id="deleteMultipleUsers" class="btn btn-sm btn-danger" @click="eliminarMedico" v-if="'EliminarMedicoComponent' in Vue.options.components " >Eliminar</a>
					&nbsp;
					<label> Buscar:
						<input type="search" class="form-control input-sm" v-model="buscar">
					</label>
				</ul>
                <ul class="nav navbar-rigth panel_toolbox">
					<li @click="ocultarListaMedicos()"><a  class="collapse-link" id="ocultar-panel-medicos"><i class="fa fa-chevron-up"></i></a>
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
                                <th class="column-title" @click ="ordenar_por('matricula')">MATRICULA</th>
								<th class="column-title" @click ="ordenar_por('apellido')">APELLIDO </th>
								<th class="column-title" @click ="ordenar_por('nombres')">NOMBRE </th>
								<th class="column-title no-link last" @click ="ordenar_por('dni')">DNI </th>
                            </tr>
						</thead>
						<tbody>
                            <tr class="even pointer" v-for="(medico , key) in getLista" :key="key">
                                <td class="a-center ">
                                    <input type="checkbox" :value="medico.id" v-model="medicos_seleccionados">
                                </td>
								<td @click="editarMedico(medico)"><a> {{medico.matricula}} </a></td>
								<td @click="editarMedico(medico)"><a> {{medico.apellido}} </a></td>
								<td @click="editarMedico(medico)"><a> {{medico.nombres}} </a></td>
								<td class="last" @click="editarMedico(medico)"><a> {{medico.dni}} </a></td>
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
    <crear-medico-component @regresar="guardarMedico" v-if="mostrar_frm_crear_medico"></crear-medico-component>
    <editar-medico-component @regresar="guardarMedico" :medico="editar_medico"  v-if="mostrar_frm_editar_medico"></editar-medico-component>
</div>
</template>

<script>


export default {
    name: 'lista-medicos',
    props: [],
    mounted(){
        //this.form = r.lista_medicos.sort(this.sort_by('dni', true, function(a){return a}));
        this.form = [
            {'id':1, 'matricula':55, 'apellido' : 'moreira', 'nombre': 'ezequiel' , 'dni' : 35555555},
                {'id':2, 'matricula':99,'apellido' : 'tomas', 'nombre': 'tomas' , 'dni' : 333333333}
            ];
        this.datos_filtrados = this.form;
        this.paginar();
    },
    data(){
        return {
            mostrar_frm_crear_medico: false,
            mostrar_frm_editar_medico: false,
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
            editar_medico: false,
            check_all: false, //checkbox para colocar o quitar todos los checks de todos los medicos para eliminar
			medicos_seleccionados: [],
        }
    },
    methods: {
        editarMedico: function(medico){
            var eliminar_index = null;
            $(this.form).each(function(index,val){
                if (val.dni == medico.dni) {
                    eliminar_index = index;
                    return false;
                }
            });
            this.form.splice(eliminar_index , 1);
            this.editar_medico = medico;
            this.mostrar_frm_editar_medico = true;
        },
        crearMedico: function(){
            this.mostrar_frm_crear_medico = true;
        },
        guardarMedico: function(medico=null){
            if(medico!=null){
                this.form.push(medico);
            } else {
                if(this.mostrar_frm_editar_medico){
                    this.form.push(this.editar_medico);
                }
            }
            this.paginar();
            this.mostrar_frm_crear_medico = false;
            this.mostrar_frm_editar_medico = false;
            this.editar_medico = false;
        },
        seleccionarTodo: function(){
            /** Para eliminar
            * Selecciona todos los checkbox de los medicos
            * para eliminarlos
            * @Pepe
            */
            if (this.check_all) {
                this.medicos_seleccionados = [];
                return;
            }
            this.medicos_seleccionados = this.form.map(medico=>{
                return medico.id;
            })
        },
        eliminarMedico: function(){
            if (this.medicos_seleccionados.length < 1) {return;}
            const modalEliminar = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            })

            modalEliminar.fire({
                title: 'Lista de medicos a eliminar:',
                text: this.getListaMedicosEiminar,//"No podra revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    let that = this;
                    this.medicos_seleccionados.forEach(id_eliminar=>{
                        $(that.form).each(function(index,medico){
                            if (id_eliminar == medico.id) {
                                that.form.splice(index , 1);
                                return false;
                            }
                        });
                    });
                    this.medicos_seleccionados = [];
                    this.check_all = false; // destildamos el "marcar todo" para eliminar
                    this.paginar();
                    modalEliminar.fire(
                        'Eliminado',
                        'Los medicos fueron eliminados.',
                        'success'
                    );
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    modalEliminar.fire(
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
                                                                    if ( campo == 'dni' || campo == 'matricula' ||
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
        ocultarListaMedicos: function(){
            var $BOX_PANEL = $('#ocultar-panel-medicos').closest('.x_panel'),
                    $ICON = $('#ocultar-panel-medicos').find('i'),
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
        getListaMedicosEiminar(){
            var texto = '';
            let $this = this;
            var contador = 0;
            $(this.form).each(function(index,medico){
                contador++;
                if ($this.medicos_seleccionados.indexOf(medico.id) != -1) {
                    texto += contador + ") " + medico.apellido + "...";
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
