<template>
	
	<div class="row">
      	<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              	<div class="x_title">
                    <h2>Formulario de alta de stock </h2>                   
                    <div class="clearfix"></div>
              	</div>


              	<div class="row">
              		<div class="col-sm-4">
              			<p> Detalles del medicamento </p>
                    	<p> Codigo: 			<code>555</code></p>
                    	<p> Nombre: 			<code>Ibuprofeno</code></p>
                    	<p> Clasificacion: 		<code>Analgesico oral</code></p>
                    	<p> Descripcion: 		<code>Comprimido 500mg</code></p>
                    	<p> Cantidad por blister: <code>16</code></p>
              		</div>

              		<div class="col-sm-8">
              			<div class="x_content">
		                    <br>
		                    <form 	id 						= "demo-form2" 
		                    		data-parsley-validate	= "" 
		                    		class 					= "form-horizontal form-label-left"
		                    		@submit.prevent 		= "agregarStock">		                    	

		                      	<div class="form-group" v-for="campo in campos_stock">
		                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" :for="'label-' + campo.clave">
		                        		{{ campo.label }} <span class="required">*</span>
			                        </label>
			                        <div class="col-md-6 col-sm-6 col-xs-12">
			                          	<input 	:type 	= "campo.type" 
			                          			:id 	= "'label-' + campo.clave" 
			                          			v-model = "campo.model"
			                          			required= "required" 
			                          			class 	= "form-control col-md-7 col-xs-12"
			                          			:placeholder = "campo.descripcion" >
			                        </div>
		                      	</div>
			                      	                   
		                      	<div class="ln_solid"></div>
		                      	<div class="form-group">
			                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			                          	<button class="btn btn-primary" type="button">Cancelar</button>
			                          	<button :class="{   'btn btn-success' : habilitarBotonAgregarStock,
                                                    		'btn btn-danger'  : !habilitarBotonAgregarStock}">
                                    		Agregar
                                		</button>
			                        </div>
		                     	</div>

		                    </form>
		          		</div>
              		</div>
              	</div>

            </div>
      	</div>
    </div>

</template>

<script>
	
	export default{
		name: 'agregar-stock',
		data(){
			return {
				campos_stock: [
					//cantidad de stock
                    {   clave   : 'cant' , 
                        model   : '', 
                        label   : 'Cantidad' , 
                        type    : 'number', 
                        descripcion : 'Ingrese la cantidad de stock a ingresar.', 
                        state   : null  } ,
                    //lote correspondiente
                    {   clave     : 'lote' , 
                        model   : '', 
                        label   : 'Lote' , 
                        type    : 'number', 
                        descripcion : 'Ingrese el lote de stock correspondiente.', 
                        state   : null  } ,
                    //fecha vencimiento
                    {   clave     : 'f_vencimiento' , 
                        model   : '', 
                        label   : 'Fecha vencimiento' , 
                        type    : 'date', 
                        descripcion : 'Ingrese la fecha de vencimiento del lote.', 
                        state   : null  } ,
				],
			}
		},
		methods: {
			agregarStock: function(){
				if ( !this.habilitarBotonAgregarStock ) { alert('faltan campos'); return; }
				alert('agregando!')
			},
		},
        computed:{
            habilitarBotonAgregarStock(){
                var habilitar = true;
                $(this.campos_stock).each(function(index,campo){
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