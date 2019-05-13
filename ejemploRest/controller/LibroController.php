<?php

require_once "Controller.php";


class LibroController extends Controller
{
    public function manageGetVerb(Request $request, $token = null)
    {

        $listaLibros = null;
        $id = null;
        $response = null;
        $code = null;

        //Primero comprobar si el token es valido en caso de haberlo
        /*$token_valido = false;
        $token_decodificado = null;
        if($token != null)
        {
            $token_decodificado = \Firebase\JWT\JWT::decode($token, $key, array('HS256'));

            $fechaToken = $token_decodificado["iat"];
            $fechaActual = strtotime("now");

            if($fechaActual<$fechaToken) $token_valido = true;
        }


        if($token == null || $token_valido)
        {*/
            //if the URI refers to a libro entity, instead of the libro collection
            if (isset($request->getUrlElements()[2])) {
                $id = $request->getUrlElements()[2];
            }


            $listaLibros = LibroHandlerModel::getLibro($id);

            if ($listaLibros != null) {
                $code = '200';

            } else {

                //We could send 404 in any case, but if we want more precission,
                //we can send 400 if the syntax of the entity was incorrect...
                if (LibroHandlerModel::isValid($id)) {
                    $code = '404';
                } else {
                    $code = '400';
                }

            }

            //$header_auth = header("Authorization: Bearer "+$token);
            $header_auth = array( "Authorization" => "Bearer " . $token);

            //$response = new Response($code, null, $listaLibros, $request->getAccept());
            $response = new Response($code, $header_auth, $listaLibros, $request->getAccept());
            $response->generate();
        //}
    }

    public function managePostVerb(Request $request, $token = null)
    {

        //Obtener los parametros mandados en el body
        $libro = $request->getBodyParameters();

        $filasAfectadas = -1;
        $response = null;
        $code = null;

        //ejecutar el metodo postLibro en LibroHandlerModel.php
        $filasAfectadas = LibroHandlerModel::postLibro($libro);

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


    public function manageDeleteVerb(Request $request, $token = null)
    {
        $filasAfectadas = -1;
        $id = null;
        $code = null;
        $response = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        $filasAfectadas = LibroHandlerModel::deleteLibro($id);

        if($filasAfectadas != 0)
        {
            $code = 200;
        }
        else
        {
            if(LibroHandlerModel::isValid($id))
            {
                $code = 404;
            }
            else
            {
                $code = 400;
            }
        }

        $response = new Response($code, null, null, $request->getAccept());

        $response->generate();

    }


    public function managePutVerb(Request $request, $token = null)
    {
        $filasAfectadas = -1;
        $id = null;
        $code = null;
        $response = null;


        $libro = $request->getBodyParameters();

        $filasAfectadas = LibroHandlerModel::putLibro($libro);

        if($filasAfectadas == 1)
        {
            $code = 200;
        }
        else
        {
            $id = $libro->id;

            if(LibroHandlerModel::isValid($id))
            {
                $code = 404;
            }
            else
            {
                $code = 400;
            }
        }

        $response = new Response($code, null, null, $request->getAccept());

        $response->generate();
    }

}