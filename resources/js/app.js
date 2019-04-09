
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default

//aca se agregan las carpetas creadas para los diversos tipos de componentes

const folders = [
     req = require.context('./components/', true, /\.(js|vue)$/i),
     req = require.context('./components/configuracion', true, /\.(js|vue)$/i),
     req = require.context('./components/medicamentos', true, /\.(js|vue)$/i),
     req = require.context('./components/menu_lateral', true, /\.(js|vue)$/i),

];
//se recorre cada carpeta y se incluyen sus archivos correspondientes
folders.forEach(function(req) {
    return req.keys().map(key => { const name = key.match(/\w+/)[0];
        return Vue.component(name, req(key).default)
   });
  });
  //fin de la secuencia

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
      //'index' : index,
    },
    template: '<dashboard-component/>',
});
