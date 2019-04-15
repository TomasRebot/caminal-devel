<template>
<div class="row" id="ingreso-medicamento">
    <configuracion-ingreso-component @modo="guardarModoIngreso" @destino="guardarDestinoIngreso">
    </configuracion-ingreso-component>
</div>
</template>
<script>

	export default{
        name: 'ingreso-medicamento',
        mounted(){
        },
		data(){
			return {
        medicamentos_seleccionados: [],
        step : [
          {mostrar: true}, //pagina 1 del step
          {mostrar: false}, //pagina 2 del step
          {mostrar: false} //pagina 3 del step
        ],
        cliente_seleccionado: false,
        medicamentos_seleccionados: [],
			}
    },
    mounted(){
    },
		methods: {
			volverInicio: function(){
        this.$emit('volver-inicio')
      },
      confirmarEntrega: function(){
      },
      guardarModoIngreso: function(modo){

      },
      guardarDestinoIngreso: function(destino){

      },
      guardarCliente: function(cliente){
        this.cliente_seleccionado = cliente;
        this.cambiarPaginaStep(1);
      },
      guardarMedicamentos: function(lista_medicamentos){
        this.medicamentos_seleccionados = [];
        this.medicamentos_seleccionados = lista_medicamentos;
      },
      cambiarPaginaStep: function(pagina){
        /**
         * en la variable "pagina" nos llega "1" para cambiar de pagina a la siguiente
         * o nos llega "-1" para volver a la pagina anterior
         * si la variable "pagina" es positiva significa que vamos a darle a "siguiente"
         * ... pero si el boton siguiente esta deshabilitado significa que ya estamos en el final
         * si la varialbe "pagina" es negativa significa que le dimos en "anterior"
         * ... pero si el boton anterior esta deshabilitado significa que ya estamos en el inicio 
         */
        if(pagina > 0 && this.deshabilitar_btn_siguiente){ return; } 
        if(pagina < 0 && this.deshabilitar_btn_anterior){ return; }
        var pagina_activa = 0;
                
        /**
         * primero encontramos el index del activo y le sumamos o restamos 1
         * teniendo en "pagina_activa" el index del que debemos poner en tru
         * mientras ponemos todo en false
         */
        $(this.step).each(function(index,val){ 
          if (val.mostrar) {
            pagina_activa = index + pagina;
          }
          val.mostrar = false;
        });
        /**
         * aca con "pagina activa" buscamos el index que coincida y lo ponemos en true
         */
        $(this.step).each(function(index,val){
          if(index == pagina_activa){
            val.mostrar = true;
            return false;
          }
        });
      },
    },
    computed:{
      deshabilitar_confirmar_btn(){
        return !this.step[2].mostrar || !this.cliente_seleccionado || this.medicamentos_seleccionados.length < 1 ? true : false;
      },
      deshabilitar_btn_anterior(){
        return this.step[0].mostrar ? true : false;
      },
      deshabilitar_btn_siguiente(){
        return this.step[2].mostrar ? true : false;
      }
    }
	}

</script>
