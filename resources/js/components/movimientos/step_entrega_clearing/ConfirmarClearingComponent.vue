<template>
<div class="row" id="confirmar-entrega-component">
	<div class 	= "col-md-12 col-sm-12 col-xs-12 form-group animated fadeInRight">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="StepTitle">Confirmar</h3>
				<div class="clearfix"></div>
			</div>
            <div class="x_content row">
                <br>
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <!-- DATOS DE INSTITUCION -->
                    <div class="x_title">
                        <u><h3>Datos de institucion.</h3></u>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombre">
                            NOMBRE
                        </label>
                        <div id="label-nombre">
                            <label class="form-control"> {{institucion.nombre}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-direccion">
                            DIRECCION
                        </label>
                        <div id="label-direccion">
                            <label class="form-control"> {{institucion.direccion}} </label>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                </div> <!-- FIN DATOS DE INSTITUCION -->                
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> <!-- LISTA DE MEDICAMENTO/OS -->
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Lista de medicamentos</h3>
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
        props: ['institucion' , 'medicamentos'],
		data(){
			return {
			}
		},
	}
</script>