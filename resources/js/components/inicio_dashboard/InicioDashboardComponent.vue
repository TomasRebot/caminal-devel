<template>
		<div  id="inicio-dashboard"	class 	= "col-md-6 col-sm-6 col-xs-12 animated fadeInRight"
          :style  = "style_object_animacion">
      <div class="x_panel">
        <div class="x_title">
          <h2> SOY EL INICIO <small>Float left</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li>
              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-xs-3">
            <!-- required for floating -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-left">
              <li class="active">
                <a href="#home" data-toggle="tab" aria-expanded="true">Home</a>
              </li>
              <li class="">
                <a href="#profile" data-toggle="tab" aria-expanded="false">Profile</a>
              </li>
              <li class="">
                <a href="#messages" data-toggle="tab" aria-expanded="false">Messages</a>
              </li>
              <li class="">
                <a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a>
              </li>
            </ul>
          </div>
          <div class="col-xs-9">
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="home">
                <p class="lead">Home tab</p>
                <p>
                  Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                  synth. Cosby sweater eu banh mi, qui irure terr.
                </p>
              </div>
              <div class="tab-pane" id="profile">Profile Tab.</div>
              <div class="tab-pane" id="messages">Messages Tab.</div>
              <div class="tab-pane" id="settings">Settings Tab.</div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
</template>

<script>

	export default{
		name: 'inicio-dashboard',
        props: [ 'ejecutarSalida' , 'animacion' ],
		data(){
			return {
				ejecutar_animacion_salida : false,
        style_object_animacion    : {
            '-webkit-animation-duration': this.animacion.duracion,
            '-webkit-animation-delay'   : this.animacion.delay,
        },
			}
		},
        computed:{
            activarAnimacionSalidaComponentePadre(){
                if (this.ejecutarSalida) {
                    return true;
                }
            },
        }
	}

</script>
