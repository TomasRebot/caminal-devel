<template>
<div class="col-md-12 col-sm-12 col-xs-12" id="configuracion-ingreso">
    <div class="x_panel">
        <div class="x_title">
        <h2>Seleccione modo de ingreso <small>de medicamentos</small></h2>
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
                                <input type="radio"  :value="'proveedor'"> Proveedor
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio"  :value="'clearing'"> Clearing
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
                                <input type="radio" :value="'remediar'" name="optionsRadios2"> Remediar
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" :value="'caminal'" name="optionsRadios2"> Caminal
                            </label>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="actionBar">
                    <a class="buttonPrevious btn btn-primary">
                        Cancelar
                    </a>
                    <a class="buttonNext btn btn-success">
                        Siguiente
                    </a>
                </div>  
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
            modo: '',
        }
    },
    mounted(){
    },
    methods: {
    },
    computed:{      
    }
}
</script>
