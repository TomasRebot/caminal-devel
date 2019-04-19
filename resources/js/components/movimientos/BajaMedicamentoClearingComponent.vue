<template>
<div class="row" id="baja-medicamento-clearing">
  <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInRight">
    <div class="x_panel">
      <div class="x_title">
        <h4>Entrega de medicamentos por clearing</h4>
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> <!-- Smart Wizard -->
        <p>Pasos para entregar medicamentos.</p>
        <div id="wizard" class="form_wizard wizard_horizontal">
          <ul class="wizard_steps anchor">
            <li>
              <a :class="{'disabled':!step[0].mostrar,'selected':step[0].mostrar}">
                <span class="step_no">1</span>
                <span class="step_descr">
                  Institucion<br>
                  <small>Seleccion de institucion</small>
                </span>
              </a>
            </li>
            <li>
              <a :class="{'disabled':!step[1].mostrar,'selected':step[1].mostrar}">
                <span class="step_no">2</span>
                <span class="step_descr">
                    Medicamento<br>
                    <small>Seleccion de medicamento</small>
                </span>
              </a>
            </li>
            <li>
              <a :class="{'disabled':!step[2].mostrar,'selected':step[2].mostrar}">
                <span class="step_no">3</span>
                <span class="step_descr">
                    Final<br>
                    <small>Confirmar entrega</small>
                </span>
              </a>
            </li>
          </ul>
          <div class="" style=""> <!-- se le saco "stepContainer" de la clase y el style "height: 281px;" -->
            <div id="step-1" class="content" :style="{'display': step[0].mostrar?'block':'none'}">
              <!--h2 class="StepTitle">Busqueda de instituciones</h2-->
              <buscar-institucion-component @institucion-seleccionada="guardarInstitucion" v-if="step[0].mostrar">
              </buscar-institucion-component>
            </div>
            <div id="step-2" class="content" :style="{'display': step[1].mostrar?'block':'none'}">
              <!--h2 class="StepTitle">Busqueda de medicamento</h2-->
			        <buscar-medicamento-component @medicamentos-seleccionados="guardarMedicamentos" v-if="step[1].mostrar">
              </buscar-medicamento-component>
            </div>
            <div id="step-3" class="content" :style="{'display': step[2].mostrar?'block':'none'}">
              <!--h2 class="StepTitle">Confirmar</h2-->
              <confirmar-clearing-component :institucion="institucion_seleccionada" :medicamentos="medicamentos_seleccionados">
              </confirmar-clearing-component>
            </div>
          </div>
          <div class="actionBar">
            <a class="buttonFinish btn btn-sm btn-success" :class="{'buttonDisabled': deshabilitar_confirmar_btn}" @click="confirmarEntrega">
              Confirmar
            </a>
            <a class="buttonPrevious btn btn-sm btn-danger" :class="{'buttonDisabled': deshabilitar_btn_anterior}" @click="cambiarPaginaStep(-1)">
              Anterior
            </a>
            <a class="buttonNext btn btn-sm btn-primary" :class="{'buttonDisabled': deshabilitar_btn_siguiente}" @click="cambiarPaginaStep(1)">
              Siguiente
            </a>
          </div>
        </div> <!-- End SmartWizard Content -->
      </div>
    </div>
  </div>
</div>
</template>
<script>

export default{
	name: 'baja-medicamento-clearing',
	mounted(){
	},
	data(){
		return {
			step : [
				{mostrar: true}, //pagina 1 del step
				{mostrar: false}, //pagina 2 del step
				{mostrar: false} //pagina 3 del step
			],
			institucion_seleccionada: false,
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
        alert('revisa la consola del navegador!')
        var datos = new Object();
        datos['institucion'] = this.institucion_seleccionada;
        datos['medicamentos'] = this.medicamentos_seleccionados;
        console.log(datos);
      },
      guardarInstitucion: function(institucion){
        this.institucion_seleccionada = institucion;
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
        return !this.step[2].mostrar || !this.institucion_seleccionada || this.medicamentos_seleccionados.length < 1 ? true : false;
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
