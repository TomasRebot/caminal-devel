<template>
<div class="row" id="configuracion-ingreso">

<div class="col-md-12 col-sm-12 col-xs-12" >
    <div class="x_panel">
        <div class="x_title">
            <h4>Seleccione el origen y detino de los medicamentos</h4>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="col-md-6 col-sm-3 col-xs-12 control-label">
                        Seleccione el origen de ingreso:
                        <br>
                        <small class="text-navy"></small>
                    </label>
                    <div class="col-md-6 col-sm-9 col-xs-12">
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="configuracion.modo_ingreso" :value="'proveedor'"> Proveedor
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="configuracion.modo_ingreso" :value="'clearing'"> Clearing
                            </label>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-md-6 col-sm-3 col-xs-12 control-label">
                        Seleccione el destino de ingreso:
                        <br>
                        <small class="text-navy"></small>
                    </label>
                    <div class="col-md-6 col-sm-9 col-xs-12">
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="configuracion.destino_ingreso" :value="'remediar'"> <span class="badge badge-md-info">Remediar</span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="configuracion.destino_ingreso" :value="'caminal'"> <span class="badge badge-md-warning">Caminal</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
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
            configuracion: {
                modo_ingreso: 'proveedor',
                destino_ingreso: 'caminal',
            },
        }
    },
    watch:{
        configuracion: {
            handler(val){
                this.$emit('configuracion-seleccionada' , val);
            },
            deep: true
        }
    },
}
</script>
