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
        $profesionales  = Profesional::count();
        $movimientos    = Movimiento::all();
        $entregas       = $movimientos->where('tipo','baja')->count();
        $ingresos       = $movimientos->where('tipo','alta')->count();

        $stock = Stock::with('medicamento')->get();

        $stock_apto = $stock->where('fecha_vencimiento', '>' , Carbon::now()); //unidades que no se vencieron

        $stock_vencido= $stock->where('fecha_vencimiento', '<=' , Carbon::now()); //stock que ya se vencio


        $total_medicamentos_aptos = $stock_apto->groupBy('id_medicamento')->count(); // total de medicamentos que no se vencieron

        $total_medicamentos_vencidos = $stock_vencido->groupBy('id_medicamento')->count();// total de medicamentos que se vencieron

        $unidades_aptas = $stock_apto->sum(function($stock){
            return $stock['stock_remediar'] + $stock['stock_caminal'];
        }); // cantidad de unidades de pastillitas aptas

        $unidades_vencidas = $stock_vencido->sum(function($stock){
            return $stock['stock_remediar'] + $stock['stock_caminal'];
        }); // cantidad de unidades de pastillitas vencidas


        $medicamentos_con_stock_bajo = $stock_apto->groupBy('id_medicamento')->filter(function ($stock) use($stock_apto){
            $cant_caminal = 0;
            $cant_remediar=0;
            foreach ($stock as  $iterador => $value){
                $cant_caminal += $value->stock_caminal;
                $cant_remediar+= $value->stock_remediar;
                if($iterador === (count($stock)-1))
                {
                    $stock[0]['cantidad_remediar'] = $cant_remediar;
                    $stock[0]['cantidad_caminal'] = $cant_caminal;
                    $stock[0]['cantidad_total'] = $cant_caminal + $cant_remediar;
                }

            }
            return ($cant_remediar < 50)  || ($cant_caminal < 50);
        });


        $medicamentos_con_stock_vencido = $stock_vencido->groupBy('id_medicamento')->filter(function ($stock) use($stock_vencido){
            $cant_caminal = 0;
            $cant_remediar=0;
            foreach ($stock as  $iterador => $value){
                $cant_caminal += $value->stock_caminal;
                $cant_remediar+= $value->stock_remediar;
                if($iterador === (count($stock)-1))
                {
                    $stock[0]['cantidad_remediar'] = $cant_remediar;
                    $stock[0]['cantidad_caminal'] = $cant_caminal;
                    $stock[0]['cantidad_total'] = $cant_caminal + $cant_remediar;
                }

            }
            return ($cant_remediar < 50)  || ($cant_caminal < 50);
        });

        $medicamentos_con_stock_por_vencer = $stock_apto->where('fecha_vencimiento', '<=', Carbon::now()->addDays(11));



        return response()->json([
            'pacientes' =>  $pacientes,
            'profesionales' =>   $profesionales,
            'entregas' =>  $entregas,
            'ingresos' =>  $ingresos,
            'stock_apto' =>  $stock_apto,
            'stock_vencido' =>  $stock_vencido,
            'total_medicamentos' =>  $total_medicamentos_aptos,
            'total_medicamentos_vencidos' =>  $total_medicamentos_vencidos,
            'unidades_aptas' =>  $unidades_aptas,
            'unidades_vencidas' =>  $unidades_vencidas,
            'medicamentos_con_stock_bajo' =>  $medicamentos_con_stock_bajo,
            'medicamentos_con_stock_vencido' =>  $medicamentos_con_stock_vencido,
            'medicamentos_con_stock_por_vencer' =>   $medicamentos_con_stock_por_vencer,
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
        //$stock_apto = Stock::with('medicamento')->where('fecha_vencimiento', '>=' , Carbon::now())->get(); //
