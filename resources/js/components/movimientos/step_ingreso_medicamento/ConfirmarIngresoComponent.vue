<template>
<div class="row" id="confirmar-ingreso">
	<div class 	= "col-md-12 col-sm-12 col-xs-12 form-group animated fadeInRight">
        <div class="x_panel">
            <div class="x_title">
                <h4 class="StepTitle">Confirmar ingreso de stock al sector
                    <span class="badge badge-xs-warning" v-if="configuracion.destino_ingreso=='caminal'" style="color:white;">Caminal</span>
                    <span class="badge badge-xs-info" v-else style="color:white;">Remediar</span>
                </h4>
				<div class="clearfix"></div>
			</div>
           <div class="x_content row">
                <br>
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <!-- DATOS DE INSTITUCION -->
                    <div class="x_title">
                        <u><h4>Datos de institucion.</h4></u>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombre">
                            Nombre
                        </label>
                        <div id="label-nombre">
                            <label class="form-control"> {{proveedor.nombre}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-razon">
                            Razon social
                        </label>
                        <div id="label-razon">
                            <label class="form-control"> {{proveedor.razon}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-cuit">
                        Cuit
                        </label>
                        <div id="label-cuit">
                            <label class="form-control"> {{proveedor.cuit}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-direccion">
                            Direccion
                        </label>
                        <div id="label-direccion">
                            <label class="form-control"> {{proveedor.direccion}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-telefono">
                            Telefono
                        </label>
                        <div id="label-telefono">
                            <label class="form-control"> {{proveedor.telefono}} </label>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                </div>
                <!-- FIN DATOS DE INSTITUCION -->
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <!-- LISTA DE MEDICAMENTO/OS -->
                        <div class="x_title">
                            <h4>Lista de medicamentos</h4>
                            <div class="clearfix"></div>
                        </div>
                        <article class="media event" v-for="(medicamento , key) in medicamentos" :key = "key">
                            <div class="media-body">
                            <a class="title">{{medicamento.perfil.nombre}}</a>
                            <p>Clasificacion: {{medicamento.perfil.clasificacion}}</p>
                            <p>Descripcion: {{medicamento.descripcion}}</p>
                            <p class="badge badge-sm-success">Cantidad: {{medicamento.cantidad_entrega}}</p>
                            </div>
                        </article>
                </div> <!-- FIN LISTA MEDICAMENTO/OS -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
	export default {
        name: 'confirmar-ingreso',
        props: ['configuracion' , 'institucion' , 'proveedor' , 'medicamentos'],
		data(){
			return {
			}
        },
        mounted(){
        },
	}
</script>
