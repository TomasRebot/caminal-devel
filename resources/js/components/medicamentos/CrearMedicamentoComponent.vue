<template>
    <div class="row" id="crear-medicamento">
        <agregar-stock-medicamento-component     
                                    v-if            = "agregar_stock" 
                                    :animacion      = "animacion"
                                    :ejecutar-salida= "ejecutarSalida"
                                    @volver-inicio  = "volverInicio"/>


        <div    class   = "col-md-12 col-sm-12 col-xs-12" 
                v-if    = "!agregar_stock"
                :class  = "{ 'animated fadeInRight'  : ejecutar_animacion_entrada,
                             'animated fadeOutRight' : activarAnimacionSalidaComponentePadre || ejecutar_animacion_salida}"  
                :style  = "style_object_animacion">
            <!-- INICIO FORMULARIO CREACION MEDICAMENTO -->
            <div class="x_panel">
                <div class="x_title">
                    <h2> Formulario de creacion de nuevo medicamento</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form class="form-horizontal form-label-left" @submit.prevent="agregarMedicamento" novalidate="">

                        <p> Ingrese los datos necesarios
                        </p>
                        <span class="section">Informacion</span>

                        <div class="item form-group" v-for= "(campo , key) in campos_formulario" :key="key">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" :for="'label-' + campo.label"> 
                                {{ campo.label }} <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  :id         = "'label-' + campo.clave" 
                                        class       = "form-control col-md-7 col-xs-12" 
                                        :name       = "'label-' + campo.clave" 
                                        :placeholder= "campo.descripcion" 
                                        required    = "required" 
                                        :type       = "campo.type"
                                        v-model     = "campo.model">
                                    <span :id="'feedback' + campo.key" v-if="campo.status">
                                        feedback
                                    </span>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button class   = "btn btn-primary" 
                                        type    = "button"
                                        @click  = "volverInicio">
                                    Cancelar
                                </button>
                                <button :class="{   'btn btn-success' : habilitarBotonCrear,
                                                    'btn btn-danger'  : !habilitarBotonCrear}">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <!-- FIN FORMULARIO CREACION MEDICAMENTO -->
        </div>
    </div>
</template>

<script>
    export default {
        name: 'crear-medicamento',
        props: [ 'ejecutarSalida' , 'animacion' ], 
        mounted() {
            setTimeout(() => {
                this.ejecutar_animacion_entrada = false;
            }, this.animacion.duracion * 1000);
        },
        data(){
            return{
                ejecutar_animacion_entrada: true,
                ejecutar_animacion_salida : false,
                style_object_animacion    : {
                    '-webkit-animation-duration': this.animacion.duracion,
                    '-webkit-animation-delay'   : this.animacion.delay, 
                },
                agregar_stock   : false,
                campos_formulario: [
                    //codigo
                    {   clave     : 'codigo' , 
                        model   : '', 
                        label   : 'Codigo' , 
                        type    : 'number', 
                        descripcion : 'Ingrese el codigo de medicamento.', 
                        state   : null  } ,
                    //nombre
                    {   clave     : 'nombre',
                        model   : '', 
                        label   : 'Nombre', 
                        type    : 'text'  , 
                        descripcion: 'Ingrese el nombre.',
                        state: null } ,
                    //clasificacion
                    {   clave     : 'clasificacion',
                        model   : '', 
                        label   : 'Clasificacion', 
                        type    : 'text'  , 
                        descripcion : 'Ingrese la clasificacion.', 
                        state   : null } ,
                    //descripcion
                    {   clave     : 'descripcion',    
                        model   : '', 
                        label   : 'Descripcion', 
                        type    : 'text'  ,
                        descripcion : 'Ingrese su descripcion.' ,
                        state   : null  } ,
                    //cant por blister
                    {   clave     : 'cant_blister',
                        model   : '', 
                        label   : 'Cantidad blister', 
                        type    : 'number', 
                        descripcion : 'Ingrese la cantidad por blister.', 
                        state: null } ,
                ],
            }
        },
        methods: {
            agregarMedicamento: function(){
                //if ( !this.habilitarBotonCrear ) { return; }
                if ( 'AgregarStockMedicamentoComponent' in Vue.options.components ) {
                    this.ejecutar_animacion_salida = true;
                    setTimeout(() => {
                        this.agregar_stock = true 
                    }, this.animacion.duracion * 1000);
                }                    
            },
            volverInicio: function(){
                var a = this.ejecutar_animacion_salida;
                this.ejecutar_animacion_salida = !a ? true : false;
                setTimeout(() => {
                    this.$emit('volver-inicio')
                }, this.animacion.duracion * 1000);
            },
        },
        computed:{
            habilitarBotonCrear(){
                var habilitar = true;
                $(this.campos_formulario).each(function(index,campo){
                    if (campo.model.length < 1) {
                        habilitar = false;
                        return false;
                    }
                });
                return habilitar;
            },
            activarAnimacionSalidaComponentePadre(){
                if (this.ejecutarSalida) {
                    return true;
                }
            },
        }
    }
</script>
