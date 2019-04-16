<template>
<div class="col-md-12 col-sm-12 col-xs-12" id="configuracion-ingreso">
    <div class="x_panel">
        <div class="x_title">
        <h4>Seleccione el origen</h4>
        <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="col-md-6 col-sm-3 col-xs-12 control-label">
                        Seleccione modo de ingreso:
                        <br>
                        <small class="text-navy"></small>
                    </label>
                    <div class="col-md-6 col-sm-9 col-xs-12">
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="configuracion.modo" :value="'proveedor'"> Proveedor
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="configuracion.modo" :value="'clearing'"> Clearing
                            </label>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-md-6 col-sm-3 col-xs-12 control-label">
                        Seleccione destino de ingreso:
                        <br>
                        <small class="text-navy"></small>
                    </label>
                    <div class="col-md-6 col-sm-9 col-xs-12">
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="configuracion.destino" :value="'remediar'"> Remediar
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="configuracion.destino" :value="'caminal'"> Caminal
                            </label>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
</template>

<script>

export default{
    name: 'configuracion-ingreso',
    mounted(){
    },
    data(){
        return {
            configuracion:{
                modo: '',
                destino: ''
            },
        }
    },
    watch:{
        modo: function(){
            this.$emit('configuracion-seleccionada' , this.configuracion);
        },
        destino: function(){
            this.$emit('configuracion-seleccionada' , this.configuracion);
        },
    },
}
</script>
