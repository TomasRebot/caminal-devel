<template>
<div id="crear-paciente" class="row animated fadeInRight">
    <div class="col-md-8 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Formulario de creacion de pacientes. <small>Datos personales</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left"  @submit.prevent="agregarPaciente">
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
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button class="btn btn-sm btn-danger" type="button" @click="volver">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-sm btn-success">
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
		name: 'crear-paciente',
        props: [], 
        mounted() {
        },
		data(){
			return {
                form: {
                    apellido: '',
                    nombres: '',
                    dni: '',
                },
			}
		},
		methods: {
			agregarPaciente: function(){
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Paciente creado exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(result=>{
                    this.$emit('regresar', this.form);
                });
			},
			volver: function(){
                this.$emit('regresar');
                return;
            },
		},
		computed:{
        }
	}

</script>