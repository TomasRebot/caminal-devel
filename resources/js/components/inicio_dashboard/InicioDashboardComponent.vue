<template>
<div class="container" id="inicio-dashboard">
<div class="col-md-12">
    <div class="row top_tiles">
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                <div class="count">179</div>
                <h3>Cantidad de pacientes</h3>
                <p>Registrados.</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-comments-o"></i></div>
                <div class="count">179</div>
                <h3>Promedio total de entregas</h3>
                <p>Mensuales.</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                <div class="count">179</div>
                <h3>Cantidad de profesionales</h3>
                <p>Registrados.</p>
            </div>
        </div>
        <div class="animated fadeInRight col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count">179</div>
                <h3>Medicamentos recibidos</h3>
                <p>El último mes.</p>
            </div>
        </div>
    </div>
</div>
<div class="x_panel animated fadeInRight">
        <div class="x_title">
        <h3>Proximos medicamentos en limite </h3>
        <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            Aqui figuran los medicamentos con limites proximos de vencimiento o carencia de stock.
        </p>
        <table id="datatable-fixed-header" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable-fixed-header_info">
            <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 141px;">Codigo</th>
                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 234px;">Medicamento</th>
                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 104px;">Stock Remediar</th>
                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 52px;">stock Caminal</th>
                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 102px;">Vencimiento</th>
                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 79px;">Unidades totales en riesgo</th>
            </tr>
            </thead>
            <tbody>
            <tr role="row" class="odd">
                <td class="sorting_1">Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
            </tr><tr role="row" class="even">
                <td class="sorting_1">Angelica Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009/10/09</td>
                <td>$1,200,000</td>
            </tr><tr role="row" class="odd">
                <td class="sorting_1">Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
            </tr><tr role="row" class="even">
                <td class="sorting_1">Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012/10/13</td>
                <td>$132,000</td>
            </tr><tr role="row" class="odd">
                <td class="sorting_1">Brenden Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011/06/07</td>
                <td>$206,850</td>
            </tr><tr role="row" class="even">
                <td class="sorting_1">Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
            </tr><tr role="row" class="odd">
                <td class="sorting_1">Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
            </tr><tr role="row" class="even">
                <td class="sorting_1">Caesar Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011/12/12</td>
                <td>$106,450</td>
            </tr><tr role="row" class="odd">
                <td class="sorting_1">Cara Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011/12/06</td>
                <td>$145,600</td>
            </tr><tr role="row" class="even">
                <td class="sorting_1">Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
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
    computed:{
    }
	}

</script>
