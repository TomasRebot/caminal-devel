<template>
<div id="panel-lateral">
  <div class="col-md-3 left_col" >
      <div class="left_col scroll-view">
        <div class="profile clearfix" style="margin-top:25px!important">
            <div class="profile_pic">
            <img :src="Logotipo" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
            <span>Bienvenido,</span>
            <h2>Usuario</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- menu aprofile quick info -->
        <!--  //datos del usuario autentificado y -->
        <br />
        <br />
        <!-- items menu lateral -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>Gestión de farmacia</h3>
            <ul class="nav side-menu">
              <!-- item del menu -->
              <botonmenu-component
                  v-for     = "(boton , key) in getItemsMenu"
                  :titulo   = "boton.titulo"
                  :submenu  = "boton.submenu"
                  :key      = "key"
                  :icono = "boton.icono"
                  @cambiar-vista = "showView">
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
                  <a class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <img src="" alt="">
                      Jhon Snow
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
                      <li><a href="/logaut">
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
        Logotipo : window.location+ "/images/iconos-dashboard/userprofile.png",
        botonesPanel: [
          { 'titulo' : 'Medicamentos' , "icono": "fa fa-plus-square", 'submenu' : [
                                                      {'nombre': 'Lista'      , 'componente' : 'ListaMedicamentosComponent'},],
          },
          { 'titulo' : 'Operaciones'  ,"icono":"fa fa-folder" ,'submenu' : [
                                                      {'nombre': 'Entrega a paciente'   , 'componente' :'EntregaMedicamentoComponent'},
                                                      {'nombre': 'Entrega por clearing', 'componente' :'BajaMedicamentoClearingComponent'},
                                                      {'nombre': 'Ingreso medicamentos', 'componente' : 'IngresoMedicamentoComponent'}],
          },
          { 'titulo' : 'Usuarios'     , "icono":"fa fa-users",'submenu' : [
                                                      {'nombre': 'Lista pacientes', 'componente': 'ListaPacientesComponent'},
                                                      {'nombre': 'Lista profesionales' , 'componente': 'ListaMedicosComponent'}],
          },
          { 'titulo' : 'Configuracion' , "icono":"fa fa-cogs",'submenu' : [
                                                      {'nombre' : 'Usuarios'  , 'componente' :  'UsuarioComponent' },
                                                      {'nombre' : 'Roles'     , 'componente' : 'RoleComponent'},
                                                      {'nombre' : 'Permisos'  , 'componente' : 'PermisoComponent'},],
          },
        ],
      }
    },
    methods: {
      showView: function( vista ){
        this.$emit('cambiar-vista' , vista);
      },
      comprobarPermiso: function( submenu ){
        return  submenu.some( function(menu) {
                    return menu.componente in Vue.options.components;
                });
      },
    },
    computed:{
      getItemsMenu(){
        return this.botonesPanel.filter( boton=>{
          return boton.submenu.some( menu=>{
            return menu.componente in Vue.options.components;
          })
        });
      },
    },
  }

</script>

