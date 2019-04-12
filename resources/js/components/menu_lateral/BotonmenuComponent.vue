<template>

    <li id="item_menu">
        <a><i class="fa fa-user"></i>{{titulo}}<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li v-for 	= "(item,key) in getItemsSubMenu" 
                :key    = "key">
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
            console.log(this.submenu)
		},
		methods: {
			cambiarVista: function( componente ){
				this.$emit('cambiar-vista' , componente)
			},
        },
        computed: {
            getIcono(){
                return this.icono ? this.icono : 'fa fa-cog';
            },
            getItemsSubMenu(){
                return this.submenu.filter( boton=>{
                    return boton.componente in Vue.options.components;
                });
            }

        }
	}

</script>
