<template>
    <div id="dashboard">
        <menulateral-component @cambiar-vista = "cambiarVista"/>
    <div class="right_col" role="main">
        <component :is="vista_actual">
            <!--
                este es un componente dinamico, muy falopero
            -->

        </component>
    </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        name : "dashboard",
        data(){
            return {
                vista_actual : false,
            }
        },
        methods: {
            cambiarVista: function( vista ){
                this.vista_actual = vista;
            }
        }
    }
</script>
