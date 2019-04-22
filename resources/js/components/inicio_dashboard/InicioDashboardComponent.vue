<template>
<div class="container row" id="inicio-dashboard">
<div class="col-md-12">
    <div class="row top_tiles">
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="total-pacientes"></div>
                <div class="count">3554</div>
                <h3>Pacientes</h3>
                <p>Registrados.</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="total-entregas"></div>
                <div class="count">90</div>
                <h3>Movimientos</h3>
                <p>Entregas: 23 Ingresos: 23</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="total-profesionales"></div>
                <div class="count">33</div>
                <h3>Profesionales</h3>
                <p>Registrados.</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="total-medicamentos"></div>
                <div class="count">179</div>
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
            Aqui figuran los medicamentos con limites proximos de vencimiento o carencia de stock.
        </p>
        <table id="datatable-fixed-header table-responsive" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable-fixed-header_info">
            <thead>
            <tr role="row">
                <th>Codigo</th>
                <th>Medicamento</th>
                <th>Stock Remediar</th>
                <th>Stock Caminal</th>
                <th>Fecha vencimiento</th>
                <th >Unidades totales en riesgo</th>
            </tr>
            </thead>
            <tbody>
            <tr role="row" class="odd">
                <td >0853</td>
                <td>Ibupirac 600 x 10 cpr</td>
                <td>60</td>
                <td>22</td>
                <td> <span class="badge badge-md-danger">10/6/2019</span></td>
                <td> <span class="badge badge-xs-danger">8</span></td>
            </tr>
            <tr role="row" class="odd">
                <td >0153</td>
                <td>Amoxidal 500 x 10 cpr</td>
                <td> <span class="badge badge-xs-info">15</span></td>
                <td>60</td>
                <td>10/6/2020</td>
                <td> <span class="badge badge-xs-info">15</span></td>
            </tr>
            <tr role="row" class="odd">
                <td >00098</td>
                <td>Eritromicina / Susp. 200 mg / 5 ml</td>
                <td> 60</td>
                <td> <span class="badge badge-xs-warning">8</span></td>
                <td>10/6/2020</td>
                <td> <span class="badge badge-xs-warning">8</span></td>

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
			}
        },
        mounted(){

        },
        computed:{
        }
	}

</script>
