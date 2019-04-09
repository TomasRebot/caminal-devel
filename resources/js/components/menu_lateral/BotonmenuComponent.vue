<template>

    <li id="item_menu">
        <a><i class="fa fa-user"></i>{{titulo}}<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li v-for 	= "(item,key) in submenu" 
                :key    = "key" 
                v-if    = "comprobarPermiso(item.componente)">
                <a 	class 	= ""
                    @click 	= "cambiarVista(item.componente)">
                    {{ item.nombre }}
                </a>
            </li>
        </ul>
    </li>

</template>

<script>

	export default{
		name : 'item_menu',
		props: [ 'titulo' , 'submenu', 'icono' ],
		data(){
			return{}
		},
		mounted(){
		},
		methods: {
			cambiarVista: function( componente ){
				this.$emit('cambiar-vista' , componente)
			},
            comprobarPermiso: function( componente ){
                return componente in Vue.options.components ? true : false;
            },
        },
        computed: {
            getIcono(){
                return this.icono ? this.icono : 'fa fa-cog';
            }
        }
	}

</script>
