<template>
<div id="panel-lateral">

<div class="col-md-3 left_col" >
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title"><i class="fa fa-plus-square"></i> <span> Farmacia </span></a>
      </div>
      <div class="clearfix"></div>
      <!-- menu aprofile quick info -->
      <div class="profile clearfix">
        <div class="profile_pic">
        </div>
        <div class="profile_info">
          <span>Bienvenido,</span>
          <h2>Usuario</h2>
        </div>
      </div>
      <!--  //datos del usuario autentificado y -->
      <br />
      <br />
      <!-- items menu lateral -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
            <!-- item del menu -->
            <botonmenu-component
                v-for     = "(boton , key) in botonesPanel"
                :titulo   = "boton.titulo"
                :submenu  = "boton.submenu"
                :key      = "key"
                @cambiar-vista = "showView"
                v-if      = "comprobarPermiso(boton.submenu)">
            </botonmenu-component>
            <!-- /item del menu
                v-if      = "comprobarPermisos(boton.submenu)" -->
          </ul>
        </div>
      </div>
      <!-- /items menu lateral menu -->

      <!-- footer del menu-->
      <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="fa fa-home" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="fa fa-refresh" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
          <span class="fa fa-eye-slash" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
          <span class="fa fa-power-off" aria-hidden="true"></span>
        </a>
      </div>
      <!-- /footer del menu -->
    </div>
  </div>

  <!-- top menu, perfil y notificaciones -->
  <div class="top_nav">
    <div class="nav_menu" >
      <nav>
        <div class="nav toggle" >
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <ul class="nav navbar-nav navbar-right" >
            <li class="">
                <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="" alt="">
                    <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Perfil</a></li>
                    <li>
                    <a href="javascript:;">
                        <span class="badge bg-red pull-right">PRO</span>
                        <span>Configuracion</span>
                    </a>
                    </li>
                    <li>
                    <a href="javascript:;">
                        <span class="badge bg-red pull-right">PDF</span>
                        <span>Ayuda</span>
                    </a>
                    </li>
                    <li><a href="">
                    <i class="fa fa-sign-out pull-right"></i> Cerrar sesion</a><form id="logout-form" action="" method="POST" style="display: none;">

                    </form>
                    </li>
                </ul>
            </li>
        </ul>
      </nav>
    </div>
  </div>
  </div>
</template>

<script>



  export default{
    name: 'panel-lateral',
    components: {
      //  'btn-opcion-vista' : btnViewButton,
    },
    mounted(){
    },
    data(){
      return {
        botonesPanel: [
          { 'titulo' : 'Medicamentos' , 'submenu' : [ {  'nombre': 'Crear'      , 'componente' : 'CrearMedicamentoComponent' },
                                                      {  'nombre': 'Lista'      , 'componente' : 'ListaMedicamentosComponent'},],
          },
          { 'titulo' : 'Configuracion' , 'submenu' : [{  'nombre' : 'Usuarios'  , 'componente' :  'UsuarioComponent' },
                                                      {  'nombre' : 'Roles'     , 'componente' : 'RoleComponent'},
                                                      {  'nombre' : 'Permisos'  , 'componente' : 'PermisoComponent'},],
          },
        ],
      }
    },
    methods: {
      showView: function( vista ){
        this.$emit('cambiar-vista' , vista);
      },
      ocultarPanel: function(){
          $("body").toggleClass("sidebar-toggled");
          $(".sidebar").toggleClass("toggled");
          if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
          };
      },
      comprobarPermiso: function( submenu ){

        return  submenu.some( function(menu) {
                    return menu.componente in Vue.options.components;
                });
        
        //return componente in Vue.options.components ? true : false;
      },
    },
  }

</script>

