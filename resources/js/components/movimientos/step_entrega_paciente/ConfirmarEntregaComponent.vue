<template>
<div class="row" id="confirmar-entrega">
	<div class 	= "col-md-12 col-sm-12 col-xs-12 form-group ">
        <div class="x_panel">
            <div class="x_title">
                <h4 class="StepTitle">Finalizar entrega</h4>
				<div class="clearfix"></div>
			</div>
            <div class="x_content row">
                <br>
                <!-- DATOS DE PACIENTE -->
                <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                    <div class="x_title">
                        <u><h4>Datos de paciente.</h4></u>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="label-apellido">
                            Apellido
                        </label>
                        <div id="label-apellido">
                            <label class="form-control"> {{paciente.apellido}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombres">
                            Nombre
                        </label>
                        <div id="label-nombres">
                            <label class="form-control"> {{paciente.nombre}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-dni">
                            Dni
                        </label>
                        <div id="label-dni">
                            <label class="form-control"> {{paciente.dni}} </label>
                        </div>
                    </div>
                    <!-- FIN DATOS DE PACIENTE  -->
                    <div class="ln_solid"></div>
                     <!-- DATOS DE MEDICO -->
                    <div class="x_title">
                        <u><h4>Datos de Medico.</h4></u>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombre">
                            Nombre
                        </label>
                        <div id="label-nombre">
                            <label class="form-control"> {{medico.nombre}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-apellido-medico">
                            Apellido
                        </label>
                        <div id="label-apellido-medico">
                            <label class="form-control"> {{medico.apellido}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombre-medico">
                            Matriculo
                        </label>
                        <div id="label-matricula-medico">
                            <label class="form-control"> {{medico.matricula}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-medico-dni">
                            Dni
                        </label>
                        <div id="label-medico-dni">
                            <label class="form-control"> {{medico.dni}} </label>
                        </div>
                    </div>
                    <!-- FIN DATOS DE MEDICO -->
                    <div class="ln_solid"></div>
                </div>
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
        name: 'confirmar-entrega',
        props: ['paciente' , 'medico' , 'medicamentos'],
		data(){
			return {
			}
		},
	}
</script>
