<template>
<div class="col-md-12 col-sm-12 col-xs-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h4> Formulario de edicion de datos de medicamento</h4>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- INICIO FORMULARIO EDITAR MEDICAMENTO -->
            <form class="form-horizontal form-label-left" @submit.prevent="editarMedicamento">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-codigo">
                        Código <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="label-codigo" class="form-control col-md-7 col-xs-12" v-model="frm.codigo" placeholder="Ingrese el codigo del medicamento." required="required" type="text">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-nombre">
                        Nombre <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="label-nombre" class="form-control col-md-7 col-xs-12" v-model="frm.perfil.nombre" placeholder="Ingrese el nombre." required="required" type="text">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-clasificacion">
                        Clasificación <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="label-clasificacion" class="form-control col-md-7 col-xs-12" v-model="frm.perfil.clasificacion" placeholder="Ingrese la clasificacion." required="required" type="text">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-descripcion">
                        Descripción <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="label-descripcion" class="form-control col-md-7 col-xs-12" v-model="frm.descripcion" placeholder="Ingrese la descripcion." required="required" type="text">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-cant-blister">
                        Cantidad por blister <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="label-cant-blister" class="form-control col-md-7 col-xs-12" v-model="frm.cant_blister" placeholder="Ingrese la cantidad por blister." required="required" type="number">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <button class="btn btn-sm btn-danger" @click="regresarListaMedicamentos">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-sm btn-success">
                            guardar
                        </button>
                    </div>
                </div>
            </form>
            <!-- FIN FORMULARIO EDITAR MEDICAMENTO -->
        </div>
    </div>
</div>
</template>

<script>

	export default{
		name: 'editar-medicamento',
        props: [ 'medicamento' ],
        mounted(){
           this.frm = this.medicamento;
           console.log(this.medicamento)
           console.log('-----------------')
           console.log(this.frm)
        },
		data(){
            return{
                frm: {
                    codigo: '',
                    descripcion: '',
                    cant_blister: '',
                    perfil: {nombre: '', clasificacion: ''},
                },
            }
        },
        methods: {
        	editarMedicamento: function(){

        	},
            regresarListaMedicamentos: function(){
                this.$emit('regresar');
            },
        },
        computed: {
        }
	}

</script>
