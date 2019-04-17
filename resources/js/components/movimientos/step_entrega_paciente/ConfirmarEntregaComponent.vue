<template>
<div class="row" id="confirmar-entrega">
	<div class 	= "col-md-12 col-sm-12 col-xs-12 form-group animated fadeInRight">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="StepTitle">Confirmar</h3>
				<div class="clearfix"></div>
			</div>
            <div class="x_content row">
                <br>
                <!-- DATOS DE PACIENTE -->
                <div class="col-md-6 col-sm-12 col-xs-12 form-group"> 
                    <div class="x_title">
                        <u><h3>Datos de paciente.</h3></u>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="label-apellido">
                            APELLIDO
                        </label>
                        <div id="label-apellido">
                            <label class="form-control"> {{paciente.apellido}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombres">
                            NOMBRES
                        </label>
                        <div id="label-nombres">
                            <label class="form-control"> {{paciente.nombres}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-dni">
                            DNI
                        </label>
                        <div id="label-dni">
                            <label class="form-control"> {{paciente.dni}} </label>
                        </div>
                    </div>
                    <!-- FIN DATOS DE PACIENTE  -->      
                    <div class="ln_solid"></div>
                     <!-- DATOS DE MEDICO -->
                    <div class="x_title">
                        <u><h3>Datos de Medico.</h3></u>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="label-matricula">
                            MATRICULA
                        </label>
                        <div id="label-matricula">
                            <label class="form-control"> {{medico.matricula}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-apellido-medico">
                            APELLIDO
                        </label>
                        <div id="label-apellido-medico">
                            <label class="form-control"> {{medico.apellido}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-nombre-medico">
                            NOMBRE
                        </label>
                        <div id="label-nombre-medico">
                            <label class="form-control"> {{medico.nombres}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="label-medico-dni">
                            DNI
                        </label>
                        <div id="label-medico-dni">
                            <label class="form-control"> {{medico.dni}} </label>
                        </div>
                    </div>
                    <!-- FIN DATOS DE MEDICO -->   
                    <div class="ln_solid"></div>
                </div>  
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
        name: 'confirmar-entrega',
        props: ['paciente' , 'medico' , 'medicamentos'],
		data(){
			return {
			}
		},
	}
</script>