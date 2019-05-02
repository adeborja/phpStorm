<?php

require_once "Controller.php";

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 2/05/19
 * Time: 10:02
 */
class UsuarioController extends Controller
{
    public function managePostVerb(Request $request)
    {
        //Obtener los parametros mandados en el body
        $usuario = $request->getBodyParameters();

        $filasAfectadas = -1;
        $response = null;
        $code = null;

        //ejecutar el metodo postUsuario en UsuarioHandlerModel.php
        $filasAfectadas = UsuarioHandlerModel::postUsuario($usuario);

        //Segun las filas afectadas, mandamos un codigo u otro
        if($filasAfectadas == 1)
        {
            $code = 200;
        }
        else
        {
            $code = 400;
        }

        //crear la respuesta y generarla (mandarla)
        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();
    }
}