<template>
<div id="crear-proveedor" class="row animated fadeInRight">
    <div class="col-md-8 col-xs-12">
        <div class="x_panel" :style="{'background-color' : regresar ? '#f7ffff' : null}">
            <div class="x_title">
                <h4>Formulario de creacion de instituciones.</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left"  @submit.prevent="agregarProveedor">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-nombre">
                            NOMBRE:
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" v-model="form.nombre" id="input-nombre" placeholder="Ingrese el nombre" required class="form-control">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-razon_social">
                            RAZON SOCIAL:
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" v-model="form.razon_social" id="input-razon_social" placeholder="Ingrese la razon social" required class="form-control">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="input-direccion">
                            DIRECCION:
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" v-model="form.direccion" id="input-direccion" placeholder="Ingrese la direccion" required class="form-control">
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
		name: 'crear-proveedor',
        props: ['regresar'], 
        mounted() {
        },
		data(){
			return {
                form: {
                    nombre: '',
                    razon_social: '',
                    direccion: '',
                },
			}
		},
		methods: {
			agregarProveedor: function(){
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Proveedor creado exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(result=>{
                    if(this.regresar){
                        this.$emit('regresar', this.form);
                    }
                });
			},
			volverInicio: function(){
                if(this.regresar){
                    this.$emit('regresar');
                    return;
                }
                this.$emit('volver-inicio');
            },
		},
		computed:{
        }
	}

</script>