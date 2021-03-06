

window.axios = require('axios');
window.Vue = require('vue');

require('animate.css/animate.css');

window.Swal = require('sweetalert2');

Vue.mixin({
  data: function() {
    return {
      Vue   : Vue,                  //convertimos la instancia Vue en global
      axios : axios,   
      Swal: Swal,
    }
  }
})

//aca se agregan las carpetas creadas para los diversos tipos de componentes
//pero en permisos recibimos un array de strings con los nombres de los componentes
//a los cuales tenemos autorizacion!
var permisos = [  'DashboardComponent',
                  'PermisoComponent',
                  'RoleComponent',
                  'UsuarioComponent',
                  'AgregarStockComponent',
                  'CrearMedicamentoComponent',
                  'ListaMedicamentosComponent',
                  'BotonmenuComponent',
                  'MenulateralComponent',
                  'EditarMedicamentoComponent',
                  'EliminarMedicamentoComponent',
                  'IngresoMedicamentoComponent',
                  'EntregaMedicamentoComponent',
                  'InicioDashboardComponent',
                  'CrearMedicoComponent',
                  'CrearPacienteComponent',
                  'BajaMedicamentoClearingComponent',
                  'AgregarStockMedicamentoComponent',
                  'CrearProveedorComponent',
                  'CrearInstitucionComponent',
                  'ListaPacientesComponent',
                  'ListaMedicosComponent',
                  'EditarPacienteComponent',
                  'EliminarPacienteComponent',
                  'EditarMedicoComponent',
                  'EliminarMedicoComponent',
                  // a continuacion componentes que se deben agregar si o si
                  'BuscarMedicoComponent',
                  'BuscarInstitucionComponent',
                  'ConfirmarClearingComponent',
                  'BuscarPacienteComponent',
                  'ConfirmarEntregaComponent',
                  'ConfiguracionIngresoComponent',
                  'ConfirmacionIngresoComponent',
                  'BuscarMedicamentoComponent',
                  'BuscarProveedorComponent',
                  'ConfirmarIngresoComponent',
                  ]; //recibidos al loguearse

const folders = [
     req = require.context('./components/', true, /\.(js|vue)$/i),
     req = require.context('./components/inicio_dashboard', true, /\.(js|vue)$/i),
     req = require.context('./components/usuarios', true, /\.(js|vue)$/i),
     req = require.context('./components/configuracion', true, /\.(js|vue)$/i),
     req = require.context('./components/movimientos', true, /\.(js|vue)$/i),
     req = require.context('./components/medicamentos', true, /\.(js|vue)$/i),
     req = require.context('./components/menu_lateral', true, /\.(js|vue)$/i),     
     req = require.context('./components/movimientos/step_entrega_clearing', true, /\.(js|vue)$/i),
     req = require.context('./components/movimientos/step_entrega_paciente', true, /\.(js|vue)$/i),
     req = require.context('./components/movimientos/step_ingreso_medicamento', true, /\.(js|vue)$/i),
     req = require.context('./components/institucion', true, /\.(js|vue)$/i),
     req = require.context('./components/proveedor', true, /\.(js|vue)$/i),

];
//se recorre cada carpeta y se incluyen sus archivos correspondientes

folders.forEach(function(req) {
    return req.keys().map(key => {
        const name = key.match(/\w+/)[0];
        if ( name.indexOf('Component') == -1 ) {return;} //evitamos agregar string que no son componentes
          if ( permisos.indexOf(name) == -1 ) {return;}  //consultamos si el componente existe dentro del array
                                                        //de permisos para renderizarlo
          return Vue.component(name, req(key).default);
   });
  });
//fin de la secuencia


//console.log( 'CrearMedicamentoComponent' in Vue.options.components ? 'existe' : 'no existe' )



const app = new Vue({
    el: '#app',
    components: {
    },
    template: '<dashboard-component/>',
});
