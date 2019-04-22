<?php

namespace App\Http\Controllers;

use App\Profesional;
use Illuminate\Http\Request;
use DB;

class ProfesionalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesionales = Profesional::whereEstado('activo')->get();
        return response()->json(['profesionales' => $profesionales, 'status' => 200]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $profesional = Profesional::create($request->all());
        if($profesional) return response()->json(['mensaje' => 'profesional creado con exito','status' => 200]);
        return response('something salio mal', 505);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profesional = Profesional::find($request->id);
        $updated = $profesional->update($request->all());
        if($profesional) return response()->json([ 'mensaje' =>'Profesional actualizado con exito', 'status' => 200]);
        return response()->json(['something salio mal', 505, 'profesional' => $profesional]);
    }

    public function changeState(Request $request)
    {
        if($request->id){
            try {
                $ids = [];
                foreach($request->id as $profesionalId){
                    array_push($ids , intval($profesionalId));
                }
                try {
                    DB::beginTransaction();
                    DB::table('profesionales')->whereIn('id', $ids)->update(['estado' => ($request->operacion === 'eliminar')?'eliminado':'activo']);
                    DB::commit();
                    return response()->json(['status' => 200, 'mensaje'=> ($request->operacion === "eliminar") ? 'profesionales eliminados con exito' : "profesionales restaurados con exito"]);
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
