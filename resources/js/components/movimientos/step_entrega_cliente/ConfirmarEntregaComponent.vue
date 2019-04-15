<template>
<div class="row" id="confirmar-entrega-component">
	<div class 	= "col-md-12 col-sm-12 col-xs-12 form-group animated fadeInRight">
        <div class="x_panel">
            <div class="x_content row">
                <br>
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <!-- DATOS DE CLIENTE -->
                    <div class="x_title">
                        <h3>Datos de cliente.</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="label-apellido">
                            APELLIDO
                        </label>
                        <div id="label-apellido">
                            <label class="form-control"> {{cliente.apellido}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombres">
                            NOMBRES
                        </label>
                        <div id="label-nombres">
                            <label class="form-control"> {{cliente.nombres}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-dni">
                            DNI
                        </label>
                        <div id="label-dni">
                            <label class="form-control"> {{cliente.dni}} </label>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                </div> <!-- FIN DATOS DE CLIENTE -->                
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <!-- LISTA DE MEDICAMENTO/OS -->
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
                </div> <!-- FIN LISTA MEDICAMENTO/OS -->                
            </div>
        </div>
    </div>	
</div>
</template>

<script>
	export default {
        name: 'confirmar-entrega-component',
        props: ['cliente' , 'medicamentos'],
		data(){
			return {
			}
		},
	}
</script>