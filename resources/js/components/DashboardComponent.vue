<template>
    <div id="dashboard">
        <menulateral-component @cambiar-vista = "cambiarVista"/>
        <div class="right_col" role="main">
            <component  :is         = "vista_actual" 
                        :animacion  = "detalles_animacion_componentes"
                        :ejecutar-salida    = "ejecutar_salida"
                        @volver-inicio      = "volverInicio">
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
                detalles_animacion_componentes : {
                    duracion: 1.0,
                    delay   : 0.05,
                },
                ejecutar_salida: false,
            }
        },
        methods: {
            cambiarVista: function( vista ){
                var a               = this.detalles_animacion_componentes;
                var tiempo_cambio   = this.vista_actual ? (a.duracion * 1000) : 0;

                this.ejecutar_salida = true;

                setTimeout(()=>{
                    this.ejecutar_salida= false;
                    this.vista_actual   = vista;
                } , tiempo_cambio);   
            },
            volverInicio: function(){
                this.vista_actual = 'InicioDashboardComponent';
            },
        }
    }
</script>
