<template>
    <div id="dashboard">
        <menulateral-component @cambiar-vista = "cambiarVista"/>
        <div class="right_col" role="main">
            <component :is="vista_actual" @volver-inicio="volverInicio">
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

        },
        name : "dashboard",
        data(){
            return {
                vista_actual : 'InicioDashboardComponent',
            }
        },
        methods: {
            cambiarVista: function( vista ){
                this.vista_actual   = vista;
            },
            volverInicio: function(){
                this.vista_actual = 'InicioDashboardComponent';
            },
        }
    }
</script>
