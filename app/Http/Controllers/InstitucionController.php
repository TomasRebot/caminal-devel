<?php

namespace App\Http\Controllers;

use App\Institucion;
use Illuminate\Http\Request;
use DB;
class InstitucionController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones = Institucion::whereEstado('activo')->get();
        return response()->json(['instituciones' => $instituciones, 'status' => 200]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $institucion = Institucion::create($request->all());
        if($institucion) return response()->json(['mensaje' => 'institucion creado con exito','status' => 200]);
        return response('something salio mal', 505);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $institucion = Institucion::find($request->id);
        $updated = $institucion->update($request->all());
        if($institucion) return response()->json([ 'mensaje' =>'institucion actualizado con exito', 'status' => 200]);
        return response()->json(['something salio mal', 505, 'institucion' => $institucion]);
    }

    public function changeState(Request $request)
    {
        if($request->id){
            try {
                $ids = [];
                foreach($request->id as $institucionId){
                    array_push($ids , intval($institucionId));
                }
                try {
                    DB::beginTransaction();
                    DB::table('instituciones')->whereIn('id', $ids)->update(['estado' => ($request->operacion === 'eliminar')?'eliminado':'activo']);
                    DB::commit();
                    return response()->json(['status' => 200, 'mensaje'=> ($request->operacion === "eliminar") ? 'instituciones eliminados con exito' : "instituciones restaurados con exito"]);
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
