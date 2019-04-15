<template>
<div class="row" id="crear-medicamento">
    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInRight">
        <div class="x_panel">
            <div class="x_title">
                <h2> Formulario de creacion de nuevo medicamento</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <!-- INICIO FORMULARIO CREACION MEDICAMENTO-->
                <form class="form-horizontal form-label-left" @submit.prevent="agregarMedicamento" novalidate="">
                    <p>Ingrese los datos necesarios</p>
                    <span class="section">Informacion</span>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-CODIGO">
                            CODIGO <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="label-CODIGO" class="form-control col-md-7 col-xs-12" v-model="frm.codigo" placeholder="Ingrese el codigo del medicamento." required="required" type="number">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-NOMBRE">
                            NOMBRE <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="label-NOMBRE" class="form-control col-md-7 col-xs-12" v-model="frm.nombre" placeholder="Ingrese el nombre." required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-CLASIFICACION">
                            CLASIFICACION <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="label-CLASIFICACION" class="form-control col-md-7 col-xs-12" v-model="frm.clasificacion" placeholder="Ingrese la clasificacion." required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-DESCRIPCION">
                            DESCRIPCION <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="label-DESCRIPCION" class="form-control col-md-7 col-xs-12" v-model="frm.descripcion" placeholder="Ingrese la descripcion." required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label-cant-blister">
                            CANTIDAD POR BLISTER <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="label-cant-blister" class="form-control col-md-7 col-xs-12" v-model="frm.cant_blister" placeholder="Ingrese la cantidad por blister." required="required" type="number">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button class="btn btn-primary" type="button" @click="volverInicio">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-success">
                                Crear
                            </button>
                        </div>
                    </div>
                </form>
                <!-- FIN FORMULARIO CREACION MEDICAMENTO -->
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
                    timer: 1500
                });
            },
            volverInicio: function(){
            },
        },
        computed:{
        }
    }
</script>
