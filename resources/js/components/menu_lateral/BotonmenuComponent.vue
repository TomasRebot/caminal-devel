<template>

    <li id="item_menu">
        <a><i class="fa fa-user"></i>{{titulo}}<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li v-for 	= "(item,key) in submenu" :key="key">
                <a 	class 	= ""
                    @click 	= "cambiarVista(item.accion)">
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
            console.log(this.submenu)
		},
		methods: {
			cambiarVista: function( accion ){
				this.$emit('cambiar-vista' , accion)
			}
        },
        computed: {
            getIcono(){
                return this.icono ? this.icono : 'fa fa-cog';
            }
        }
	}

</script>
