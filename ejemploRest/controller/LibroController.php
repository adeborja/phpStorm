<?php

require_once "Controller.php";


class LibroController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaLibros = null;
        $id = null;
        $response = null;
        $code = null;

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

        $response = new Response($code, null, $listaLibros, $request->getAccept());
        $response->generate();

    }

    public function managePostVerb(Request $request)
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

}