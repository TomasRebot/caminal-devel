<template>
<div class="row" id="crear-medicamento">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4> Formulario de creacion de nuevo medicamento</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content"> <!-- INICIO FORMULARIO CREACION MEDICAMENTO-->
                <form class="form-horizontal form-label-left" @submit.prevent="agregarMedicamento" novalidate="">
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
                            <input id="label-nombre" class="form-control col-md-7 col-xs-12" v-model="frm.nombre" placeholder="Ingrese el nombre." required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-clasificacion">
                            Clasificación <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="label-clasificacion" class="form-control col-md-7 col-xs-12" v-model="frm.clasificacion" placeholder="Ingrese la clasificacion." required="required" type="text">
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
                        <div class="col-md-6 col-md-offset-3">
                            <button class="btn btn-sm btn-danger" type="button" @click="$emit('regresar')">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-sm btn-success">
                                Crear
                            </button>
                        </div>
                    </div>
                </form> <!-- FIN FORMULARIO CREACION MEDICAMENTO -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: 'crear-medicamento',
        props: [],
        mounted() {
        },
        data(){
            return{
                frm: {
                    codigo: '',
                    nombre: '',
                    clasificacion: '',
                    descripcion: '',
                    cant_blister: '',
                },
            }
        },
        methods: {
            agregarMedicamento: function(){
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Medicamento creado exitosamente',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    this.$emit('regresar')
                });
            },
            volverInicio: function(){
            },
        },
        computed:{
        }
    }
</script>
