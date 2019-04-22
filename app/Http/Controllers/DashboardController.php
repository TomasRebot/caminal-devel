<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Profesional;
use App\Medicamento;
use App\Movimiento;
//use DB;
use Carbon\Carbon;
use App\User;
use App\Stock;
use Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::count();
        $stock = Stock::with('medicamento')->get(); //
                                        
       
        $medicamentos_riesgo_stock = $stock->groupBy('id_medicamento')
                                            ->filter(function ($s){
                                                $cant_caminal = 0;
                                                $cant_remediar=0;
                                                $vencimiento = false;
                                                foreach ($s as $value){
                                                    $cant_caminal += $value->stock_caminal;
                                                    $cant_remediar+= $value->stock_remediar;
                                                }
                                                return $cant_caminal < 50 || $cant_caminal < 50;
                                            });
        $medicamentos_riesgo_vencimiento = $stock->filter(function ($s){
                                                       return $s->fecha_vencimiento < Carbon::now()->addDays(35);
                                                    });
        /*$medicamentos_riesgo = $stock->filter(function ($s){
                                    return  $s->stock_caminal < 10 || 
                                            $s->stock_remediar < 10 ||
                                            $s->fecha_vencimiento < Carbon::now()->subDays(15);
                                })->groupBy('id_medicamento');*/
                                
        $total_medicamentos = $stock->groupBy('id_medicamento')->count();
        $unidades_en_stock  = $stock->sum(function($s){ return $s['stock_remediar'] + $s['stock_caminal'];});
        $profesionales  = Profesional::count();
        $pacientes      = Paciente::count();
        $movimientos    = Movimiento::all();
        $entregas       = $movimientos->where('tipo','baja')->count();
        $ingresos       = $movimientos->where('tipo','alta')->count();

       /* $medicamentos_riesgo    = Stock::where('stock_caminal', '<', 50 )
                                        ->orWhere('stock_remediar', '<', 50 )
                                        ->orWhere('fecha_vencimiento', '<', Carbon::now()->subDays(15))
                                        ->with('medicamento')
                                        ->get();
        $total_medicamentos     = Stock::all()
                                        ->groupBy('id_medicamento')
                                        ->count();
        $medicamentos_en_stock  = Stock::where('stock_caminal', '>', 0 ) 
                                        ->where('stock_caminal', '>', 0 )
                                        ->count();
        $unidades_en_stock      = DB::table('stocks')
                                        ->select(DB::raw('sum(stock_remediar + stock_caminal) AS stock_actual'))//4)
                                        ->get();
        $profesionales  = Profesional::count();
        $movimientos    = Movimiento::groupBy('tipo')
                                        ->selectRaw('count(*) as cantidad_total, tipo')
                                        ->get();*/
        return response()->json([
            'total_pacientes'             => $pacientes,    //total pacientes
            'total_profesionales'         => $profesionales, //total medicos
            'total_entregas'              => $entregas, //total de entregas
            'total_ingresos'              => $ingresos, //total de ingresos
            //'medicamentos_en_stock' => $medicamentos_en_stock, // no se :'(
            'medicamentos_riesgo_stock'   => $medicamentos_riesgo_stock, //objecto con medicamentos en riesgo de stock
            'medicamentos_riesgo_vencimiento' => $medicamentos_riesgo_vencimiento->toArray(), 
            'total_medicamentos_riesgo'   => $medicamentos_riesgo_stock->count() + $medicamentos_riesgo_vencimiento->count(), // cantidad de medicamentos en riesgo
            'total_unidades_en_stock'     => $unidades_en_stock, //total de stock de medicamentos
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
