<?php

namespace App\Http\Controllers;

use App\Paciente;
use Illuminate\Http\Request;
use DB;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pacientes = Paciente::whereEstado('activo')->get();
        return response()->json(['pacientes' => $pacientes, 'status' => 200]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente = Paciente::create($request->all());
        if($paciente) return response()->json(['mensaje' => 'Paciente creado con exito','status' => 200]);
        return response('something salio mal', 505);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $paciente = Paciente::find($request->id);
        $updated = $paciente->update($request->all());
        if($paciente) return response()->json(['Paciente actualizado con exito', 200, 'paciente' => $paciente]);
        return response()->json(['something salio mal', 505, 'paciente' => $paciente]);
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
