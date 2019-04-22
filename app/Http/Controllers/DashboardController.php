<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Profesional;
use App\Medicamento;
use App\Movimiento;
use DB;
use Carbon\Carbon;
use App\User;
use App\Stock;
use Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::count();
        $medicamentos_riesgo = Stock::where('stock_caminal', '<', 50 )
            ->orWhere('stock_remediar', '<', 50 )
            ->orWhere('fecha_vencimiento', '<', Carbon::now()->subDays(15))->with('medicamento')->get();
        $total_medicamentos = Stock::all()->groupBy('id_medicamento')->count();
        $medicamentos_en_stock =Stock::where('stock_caminal', '>', 0 )->where('stock_caminal', '>', 0 )->count();
        $unidades_en_stock = DB::table('stocks')->select(DB::raw('sum(stock_remediar + stock_caminal) AS stock_actual'))->get();
        $profesionales = Profesional::count();
        $movimientos =  Movimiento::groupBy('tipo')->selectRaw('count(*) as cantidad_total, tipo')->get();
        return response()->json([
            'pacientes' => $pacientes,
            //'medicamentos_riesgo' => $medicamentos_riesgo,
            'pacientes' => $pacientes,
            'movimientos' => $movimientos,
            'profesionales' => $profesionales,
            'medicamentos_en_stock' => $medicamentos_en_stock,
            'medicamentos_riesgo' => $medicamentos_riesgo->count(),
            'unidades_en_stock' => $unidades_en_stock,
        ]);
    }
}
// esta comentada porque puede servir jeje $total_medicamentos = DB::table('stocks')->groupBy('id_medicamento')->select('id_medicamento as medicamento',DB::raw('sum(stock_remediar + stock_caminal) AS stock_actual'))->get();
      // $stock = Stock::where('fecha_vencimiento' ,'<', Carbon::now()->subDays(10))->pluck('fecha_vencimiento');
        // return $stock;
        // $medicamentos_riesgo = Stock::with(["medicamento" => function($q){
        //     $q->where('stocks.stock_caminal', '<', 50 )
        //     ->orWhere('stocks.stock_remediar', '<', 50 )
        //     ->orWhere('stocks.fecha_vencimiento', '<', Carbon::now()->subDays(10) );
        // }])->get();
