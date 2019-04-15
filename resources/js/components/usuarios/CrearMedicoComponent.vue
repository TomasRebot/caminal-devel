<template>
<div id="crear-medico" class="row animated fadeInRight">
    <div class="col-md-8 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Formulario de creacion de medico. <small>Datos personales</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left"  @submit.prevent="agregarMedico">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-apellido">
                            APELLIDO:
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" v-model="form.apellido" id="input-apellido" placeholder="Ingrese el apellido" required class="form-control">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-nombres">
                            NOMBRES:
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" v-model="form.nombres" id="input-nombres" placeholder="Ingrese el nombre" required class="form-control">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-dni">
                            DNI:
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="number" v-model="form.dni" id="input-dni" placeholder="Ingrese el dni" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-matricula">
                            MATRICULA:
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="number" v-model="form.matricula" id="input-matricula" placeholder="Ingrese la matricula" required class="form-control">
                        </div>
                    </div>                     
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button class="btn btn-primary" type="button" @click="volverInicio">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-success">
                                Crear
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default{
		name: 'crear-medico',
        props: [], 
        mounted() {
        },
		data(){
			return {
                form: {
                    apellido: '',
                    nombres: '',
                    dni: '',
                    matricula: '',
                },
			}
		},
		methods: {
			agregarMedico: function(){
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Medico creado exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                });
			},
			volverInicio: function(){
                this.$emit('volver-inicio');
            },
		},
		computed:{
        }
	}
</script>