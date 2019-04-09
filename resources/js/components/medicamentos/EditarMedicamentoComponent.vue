<template>
	<div    class   = "row" 
            id      = "editar-medicamento"
            :class  = "{ 'animated fadeInLeft'  : true,
                         'animated fadeOutRight' : animacion_salida }"  
            :style  = "{ '-webkit-animation-duration': '1.2s',
                         '-webkit-animation-delay'   : '0.3s', }">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Formulario de edicion de datos de medicamento</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form class="form-horizontal form-label-left" @submit.prevent="editarMedicamento">

                        <p> Ingrese los datos necesarios
                        </p>
                        <span class="section">Informacion</span>

                        <div class="item form-group" v-for= "campo in campos_formulario">
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
                                        @click  = "regresarListaMedicamentos">
                                    Cancelar
                                </button>
                                <button :class="{   'btn btn-success' : habilitarBotonCrear,
                                                    'btn btn-danger'  : !habilitarBotonCrear}">
                                    Editar
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
		name: 'editar-medicamento',
		props: [ 'medicamento' ],
		data(){
            return{
                animacion_salida: false,
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
        mounted(){
        	let c = this.campos_formulario;
            var m = this.medicamento;


            console.log(m)
        	$(c).each(function(index, campo){
                Object.keys(m).some( function( prop ){
                    if (campo.clave == prop) { campo.model = m[prop] }
                    if (prop == 'perfil') {
        				if (campo.clave == 'nombre') {
        					campo.model = m[prop]['nombre'];
    					} else if( campo.clave == 'clasificacion') {
                            campo.model = m[prop]['clasificacion'];
                        }
    				}
        		});
            });
        },
        methods: {
        	editarMedicamento: function(){

        	},
            regresarListaMedicamentos: function(){
                this.animacion_salida = true;
                setTimeout(() => {
                        this.$emit('regresar');
                }, 1200);
            },
        },
        computed: {
        	show(){
        		return this.medicamento ? true : false;
        	},
        	habilitarBotonCrear(){
                var habilitar = true;
                $(this.campos_formulario).each(function(index,campo){
                    if (campo.model.length < 1) {
                        habilitar = false;
                        return false;
                    }
                });
                return habilitar;
            }
        }
	}

</script>