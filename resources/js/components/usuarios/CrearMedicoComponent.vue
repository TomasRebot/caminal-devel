<template>
<div id="crear-paciente" class="row ">
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Formulario de creacion de médico.</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left"  @submit.prevent="agregarPaciente">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-apellido">
                            Apellido:
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-9">
                            <input type="text" v-model="form.apellido" id="input-apellido" placeholder="Ingrese el apellido" required class="form-control">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-nombre">
                            Nombre:
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-9">
                            <input type="text" v-model="form.nombre" id="input-nombre" placeholder="Ingrese el nombre" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-dni">
                            Dni:
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-9">
                            <input type="number" v-model="form.dni" id="input-dni" placeholder="Ingrese el dni" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-dni">
                            Matricula:
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-9">
                            <input type="number" v-model="form.matricula" id="input-matricula" placeholder="Ingrese la matricula del médico" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-dni">
                            Preescribe en Caminal:
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                            <div class="radio">
                                <div class="pull-left col-md-2">
                                    <label>
                                        <input type="radio" v-model="form.lugarAtencion" :value="'si'"> Si
                                    </label>
                                </div>
                                <div class="pull-left col-md-2">
                                    <label>
                                        <input type="radio" v-model="form.lugarAtencion" :value="'no'"> No
                                    </label>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-direccion">
                            Direccion:
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-9">
                            <input type="text" v-model="form.direccion" id="input-direccion" placeholder="Ingrese la direccion" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-direccion">
                            Telefono de contacto:
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-9">
                            <input type="number" v-model="form.telefono" id="input-telefono" placeholder="Ingrese un telefono de contacto" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-direccion">
                            E-mail de contacto:
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-9">
                            <input type="email" v-model="form.email" id="input-email" placeholder="Ingrese un email" required class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
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
		name: 'crear-medico',
        props: [],
        mounted() {
        },
		data(){
			return {
                form: {
                    apellido: '',
                    nombre: '',
                    dni: '',
                    direccion: '',
                    telefono: '',
                    email: '',
                    matricula: '',
                    lugarAtencion: 'si',
                },
			}
		},
		methods: {
			agregarPaciente: function(){
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Paciente creado exitosamente',
                    showConfirmButton: false,
                    timer: 1000
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
