<?php

namespace App\Http\Controllers;

use App\Models\RespuestasModel;
use Illuminate\Http\Request;

class RespuestasController extends Controller
{
    public function index()
    {
        return RespuestasModel::all();
    }

    public function store(Request $request)
    {
        $respuesta = new RespuestasModel();
        $respuesta->nombre = $request['nombre'];
        $respuesta->gustos = $request['gustos'];
        $respuesta->tipo_desarrollador = $request['tipo_desarrollador'];
        $respuesta->l_js = $request['l_js'];
        $respuesta->l_java = $request['l_java'];
        $respuesta->l_php = $request['l_php'];
        $respuesta->l_python = $request['l_python'];
        $respuesta->save();

        return $respuesta;
    }

    public function show($id)
    {
        return RespuestasModel::find($id);
    }

    public function update(Request $request, $id)
    {
        $respuesta = RespuestasModel::find($id);
        $respuesta->nombre = $request['nombre'];
        $respuesta->gustos = $request['gustos'];
        $respuesta->tipo_desarrollador = $request['tipo_desarrollador'];
        $respuesta->l_js = $request['l_js'];
        $respuesta->l_java = $request['l_java'];
        $respuesta->l_php = $request['l_php'];
        $respuesta->l_python = $request['l_python'];
        $respuesta->save();

        return $respuesta;
    }

    public function destroy($id)
    {
        $respuesta = RespuestasModel::find($id);
        $respuesta->delete();

    }
}
