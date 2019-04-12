<template>	
	<div class="row" id="ingreso-medicamento">
        <div class = "col-md-12 col-sm-12 col-xs-12 form-group" 
            :class  = "{ 'animated fadeInRight'  : ejecutar_animacion_entrada,
                            'animated fadeOutRight' : activarAnimacionSalidaComponentePadre || ejecutar_animacion_salida}"  
            :style  = "style_object_animacion">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ingreso de medicamentos 
                        <small>
                            mediante &nbsp;
                            <select class="" v-model="tipo_ingreso">
                                <option value="proveedor">Proveedor</option>
                                <option value="clearing">Clearing</option>
                            </select>
                        </small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <!-- SELECCION DE  PROVEEDOR-->
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group"  v-if=" tipo_ingreso == 'proveedor'">
                        <div class="x_title">
                            <h3>Seleccion de Proveedor.</h3>
                            <div class="clearfix"></div>
                        </div>
                        <form class="form-horizontal form-label-left" @submit.prevent = "confirmarIngresoProveedor">
                            <div    class = "form-group"
                                    v-for = "(campo , key) in datos_proveedor" :key="key">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    {{ campo.label }}
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <label  class       = "form-control">
                                        {{ campo.model }}
                                    </label>
                                </div>
                            </div>
                            <div    class = "form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    DESTINO DEL STOCK
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <button type  = "button" 
                                            @click  = "cambiarEmpresaDestino('caminal')"
                                            :class = "{'btn btn-round btn-warning': getEstadoBotonCaminal,
                                                        'btn btn-round btn-default': !getEstadoBotonCaminal,}">
                                        CAMINAL
                                    </button>
                                    <button type    = "button" 
                                            @click  = "cambiarEmpresaDestino('remediar')"
                                            :class  = "{'btn btn-round btn-primary': getEstadoBotonRemediar,
                                                        'btn btn-round btn-default': !getEstadoBotonRemediar}">
                                        REMEDIAR
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 text-right">
                                    <button class="btn btn-success" @click="buscarProveedor">
                                        Buscar proveedor
                                    </button>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="button" class="btn btn-primary" @click="volverInicio">
                                        Cancelar
                                    </button>
                                    <button :class="{'btn btn-success' : habilitarBotonConfirmar,
                                                        'btn btn-danger'  : !habilitarBotonConfirmar}">
                                        Confirmar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- FIN SELECCION PROVEEDOR -->
                    <!-- ....................... -->
                    <!-- ....................... -->
                    <!-- SELECCION INSTITUCION POR CLEARING -->
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group" v-if=" tipo_ingreso == 'clearing'">
                        <div class="x_title">
                            <h3>Seleccion de Institucion.</h3>
                            <div class="clearfix"></div>
                        </div>
                        <form class="form-horizontal form-label-left" @submit.prevent = "confirmarIngresoClearing">
                            <div    class = "form-group"
                                    v-for = "(campo , key) in datos_institucion" :key="key">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    {{ campo.label }}
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <label  class       = "form-control">
                                        {{ campo.model }}
                                    </label>
                                </div>
                            </div>
                            <!-- BOTON SELECCION EMPRESA QUE RECIBE STOCK -->
                            <div    class = "form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    DESTINO DEL STOCK
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <button type  = "button" 
                                            @click  = "cambiarEmpresaDestino('caminal')"
                                            :class = "{'btn btn-round btn-warning': getEstadoBotonCaminal,
                                                        'btn btn-round btn-default': !getEstadoBotonCaminal,}">
                                        CAMINAL
                                    </button>
                                    <button type    = "button" 
                                            @click  = "cambiarEmpresaDestino('remediar')"
                                            :class  = "{'btn btn-round btn-primary': getEstadoBotonRemediar,
                                                        'btn btn-round btn-default': !getEstadoBotonRemediar}">
                                        REMEDIAR
                                    </button>
                                </div>
                            </div>
                            <!-- FIN BOTON SELECCION EMPRESA QUE RECIBE STOCK-->
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 text-right">
                                    <button class="btn btn-success" @click="buscarInstitucion">
                                        Buscar institucion
                                    </button>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="button" class="btn btn-primary" @click="volverInicio">
                                        Cancelar
                                    </button>
                                    <button :class="{'btn btn-success' : habilitarBotonConfirmar,
                                                        'btn btn-danger'  : !habilitarBotonConfirmar}">
                                        Confirmar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- FIN INSTITUCION POR CLEARING -->
                    <!-- ....................... -->
                    <!-- ....................... -->
                    <!-- SELECCION DE MEDICAMENTO/OS -->
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2 class="col-md-9">
                                    Lista de medicamentos
                                </h2>
                                <h2 class="col-md-3 text-right">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <h4><i class="fa fa-plus-circle"></i>Agregar</h4>     
                                    </button>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <article class="media event" v-for="(n , key) in 6" :key="key">
                                    <div class="media-body">
                                        <a class="title" href="#">Item One Title ... {{n}}</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <!-- FIN SELECCION MEDICAMENTO/OS -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default{
        name: 'ingreso-medicamento',
        props: [ 'ejecutarSalida' , 'animacion' ], 
        mounted(){
            setTimeout(() => {
                this.ejecutar_animacion_entrada = false;
            }, this.animacion.duracion * 1000);
        },
        data(){
            return {
                ejecutar_animacion_entrada: true,
                ejecutar_animacion_salida : false,
                style_object_animacion    : {
                    '-webkit-animation-duration': this.animacion.duracion,
                    '-webkit-animation-delay'   : this.animacion.delay, 
                },
                //INSTITUCION
                datos_institucion: [
                     //nombre
                    {   clave   : 'nombre' , 
                        model   : '', 
                        label   : 'NOMBRE' , 
                        icono   : ''  } ,
                    //direccion
                    {   clave   : 'direccion' , 
                        model   : '', 
                        label   : 'DIRECCION' , 
                        icono   : ''  } ,
                ],
                //PROVEEDOR
                datos_proveedor: [
                    //nombre
                    {   clave   : 'nombre' , 
                        model   : '', 
                        label   : 'NOMBRE' , 
                        icono   : ''  } ,
                    //razon social
                    {   clave   : 'razon' , 
                        model   : '', 
                        label   : 'RAZON SOCIAL' , 
                        icono   : ''  } ,
                    //direccion
                    {   clave     : 'dni' , 
                        model   : '', 
                        label   : 'DNI' , 
                        icono   : '' } ,
                ],
                tipo_ingreso    : 'proveedor',
                cliente_seleccionado : false,
                medicamentos_seleccionados: [],
                destino_stock   : 'caminal',
            }
        },
        methods: {
            volverInicio: function(){
                this.ejecutar_animacion_salida = true;
                setTimeout(() => {
                    this.$emit('volver-inicio')
                }, this.animacion.duracion * 1000);
            },
            cambiarEmpresaDestino: function(empresa){
                this.destino_stock = empresa;
            },
            buscarProveedor: function(){
                this.ejecutar_animacion_salida = true;
                setTimeout(()=>{ 
                    this.mostrarListaClientes       = true;
                    this.ejecutar_animacion_salida  = false;
                } , this.animacion.duracion * 1000);
            },
            buscarInstitucion: function(){

            },
            confirmarIngresoProveedor: function(){

            },
            confirmarIngresoClearing: function(){

            },
        },
        computed:{
            activarAnimacionSalidaComponentePadre(){
                if (this.ejecutarSalida) {
                    return true;
                }
            },
            habilitarBotonConfirmar(){
                return this.cliente_seleccionado && this.medicamentos_seleccionados.lenght > 1 ? true : false;
            },
            getEstadoBotonCaminal(){
                return (this.destino_stock == 'caminal') ? true : false;
            },
            getEstadoBotonRemediar(){
                return (this.destino_stock == 'remediar') ? true : false;
            },
        }
    }

</script>