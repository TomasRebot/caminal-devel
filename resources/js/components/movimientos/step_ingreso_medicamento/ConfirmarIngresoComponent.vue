<template>
<div class="row" id="confirmar-entrega-component">
	<!--div class 	= "col-md-12 col-sm-12 col-xs-12 form-group animated fadeInRight">
        <div class="x_panel">
            <div class="x_content row">
                <br>
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <-- DATOS DE PROVEEDOR >
                    <div class="x_title">
                        <h3>Datos de proveedor.</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombre">
                            NOMBRE
                        </label>
                        <div id="label-nombre">
                            <label class="form-control"> {{proveedor.nombre}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-razon_social">
                            RAZON SOCIAL
                        </label>
                        <div id="label-razon_social">
                            <label class="form-control"> {{proveedor.razon_social}} </label>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                </div> <!-- FIN DATOS DE PROVEEDOR >                
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <!-- LISTA DE MEDICAMENTO/OS >
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>
                                Lista de medicamentos
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <article class="media event" v-for="(medicamento , key) in medicamentos" :key = "key">
                                <div class="media-body">
                                <a class="title">{{medicamento.perfil.nombre}}</a>
                                <p>Clasificacion: {{medicamento.perfil.clasificacion}}</p>
                                <p>Descripcion: {{medicamento.descripcion}}</p>
                                <p>Cantidad: {{medicamento.cantidad_entrega}}</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div> <!-- FIN LISTA MEDICAMENTO/OS >                
            </div>
        </div>
    </div-->	
</div>
</template>

<script>
	export default {
        name: 'confirmar-entrega-component',
        props: ['proveedor' , 'medicamentos'],
		data(){
			return {
			}
		},
	}
</script>