<template>
<div class="container row" id="inicio-dashboard">
<div class="col-md-12">
    <div class="row top_tiles">
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="total-pacientes"></div>
                <div class="count"> {{info.total_pacientes}} </div>
                <h3>Pacientes</h3>
                <p>Registrados.</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="total-entregas"></div>
                <div class="count"> {{ info.total_entregas + info.total_ingresos }} </div>
                <h3>Movimientos</h3>
                <p>Entregas: {{info.total_entregas}} Ingresos: {{info.total_ingresos}}</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="total-profesionales"></div>
                <div class="count"> {{info.total_profesionales}} </div>
                <h3>Profesionales</h3>
                <p>Registrados.</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="total-medicamentos"></div>
                <div class="count"> {{info.total_unidades_en_stock}} </div>
                <h3>Medicamentos</h3>
                <p>En stock.</p>
            </div>
        </div>
    </div>
</div>
<div class="x_panel animated fadeInRight">
        <div class="x_title">
        <h4>Próximos medicamentos en limite
            <span class="badge badge-xs-danger">Próximo a vencer</span>
            <span class="badge badge-xs-warning">Bajo stock en Caminal</span>
            <span class="badge badge-xs-info">Bajo stock en Remediar</span>
        </h4>
        <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            Aqui figuran los medicamentos con limites proximos a carencia de stock.
        </p>
        <table id="datatable-fixed-header table-responsive" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable-fixed-header_info">
            <thead>
            <tr role="row">
                <th>Codigo</th>
                <th>Medicamento</th>
                <th>Stock Remediar</th>
                <th>Stock Caminal</th>
                <th >Unidades totales en riesgo</th>
            </tr>
            </thead>
            <tbody>
                <tr role="row" class="odd" v-for="(medicamento,key) in getListMedicamentosRiesgoStock" :key="key">
                    <td> {{medicamento[0].medicamento.id}} </td>
                    <td> {{medicamento[0].medicamento.nombre}} {{medicamento[0].medicamento.presentacion}} </td>
                    <td> {{getTotalMedicamentosRemediar(medicamento)}} </td>
                    <td> {{getTotalMedicamentoCaminal(medicamento)}} </td>
                    <td> <span class="badge badge-xs-danger"> 0 </span></td>
                </tr>
            </tbody>
        </table>
         <p class="text-muted font-13 m-b-30">
            Aqui figuran los medicamentos con limites proximos a vencer.
        </p>
        <table id="datatable-fixed-header table-responsive" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable-fixed-header_info">
            <thead>
            <tr role="row">
                <th>Codigo</th>
                <th>Medicamento</th>
                <th>Lote</th>
                <th>Stock Remediar</th>
                <th>Stock Caminal</th>
                <th >Fecha vencimiento</th>
            </tr>
            </thead>
            <tbody>
                <tr role="row" class="odd" v-for="(medicamento,key) in getListMedicamentosRiesgoVencimiento" :key="key">
                    <td> {{medicamento.medicamento.id}} </td>
                    <td> {{medicamento.medicamento.nombre}} {{medicamento.medicamento.presentacion}} </td>
                    <td> {{medicamento.lote}} </td>
                    <td> {{medicamento.stock_remediar}} </td>
                    <td> {{medicamento.stock_caminal}} </td>
                    <td> {{medicamento.fecha_vencimiento}} </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
</div>
</template>

<script>

  require('jquery');
	export default{
		name: 'inicio-dashboard',
        props: [],
		data(){
			return {
                info: {
                    total_pacientes: 0,
                    total_profesionales: 0,
                    total_entregas: 0,
                    total_ingresos: 0,
                    medicamentos_riesgo_stock: [],
                    medicamentos_riesgo_vencimiento: [],
                    total_medicamentos_riesgo: 0,
                    total_unidades_en_stock: 0,
                }
			}
        },
        mounted(){
            axios.get('dashboard/listado-general').then(response=>{
                this.info = response.data;       
            });
        },
        methods: {
            getTotalMedicamentoCaminal: function( medicamento ){
                var total = 0; 
                $(medicamento).each(function(index,val){
                    total += val.stock_caminal;
                })
                return total;
            },
            getTotalMedicamentosRemediar: function( medicamento ){
                var total = 0; 
                $(medicamento).each(function(index,val){
                    total += val.stock_remediar;
                })
                return total;
            },
        },
        computed:{
            getListMedicamentosRiesgoStock(){
                return this.info.medicamentos_riesgo_stock;
            },
            getListMedicamentosRiesgoVencimiento(){
                return this.info.medicamentos_riesgo_vencimiento;
            },
        }
	}

</script>
