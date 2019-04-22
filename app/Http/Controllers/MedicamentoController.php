<?php

namespace App\Http\Controllers;

use App\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicamentos = Medicamento::with('stocks')->get();
        return response()->json(['medicamentos' => $medicamentos, 'status' => 200]);
    }
    public function changeState(Request $request)
    {
        if($request->id){
            try {
                $ids = [];
                foreach($request->id as $pacienteId){
                    array_push($ids , intval($pacienteId));
                }
                try {
                    DB::beginTransaction();
                    DB::table('pacientes')->whereIn('id', $ids)->update(['estado' => ($request->operacion === 'eliminar')?'eliminado':'activo']);
                    DB::commit();
                    return response()->json(['status' => 200, 'mensaje'=> ($request->operacion === "eliminar") ? 'Pacientes eliminados con exito' : "Pacientes restaurados con exito"]);
                    // tudo bom
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['status' => 409, 'mensaje'=> 'Han ocurrido errores, intente nuevamente mas tarde']);
                    // quebrou
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json("error de integridad");
            }
        }else{
            return response()->json("si no me mandas nada que queres que elimine");
        }
    }
}
