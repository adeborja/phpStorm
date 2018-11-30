<?php

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 30/11/18
 * Time: 11:07
 */
require_once "Controller.php";

class CapituloController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaCapitulos = null;
        $id = null;
        $response = null;
        $code = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        if(isset($request->getQueryString()['titulo'])){

            $queryString = $request->getQueryString()['titulo'];

        }


        $listaCapitulos = CapituloHandlerModel::getCapitulo($id, $queryString);

        if ($listaCapitulos != null) {
            $code = '200';

        } else {

            //We could send 404 in any case, but if we want more precission,
            //we can send 400 if the syntax of the entity was incorrect...
            if (CapituloHandlerModel::isValid($id)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }

        $response = new Response($code, null, $listaCapitulos, $request->getAccept());
        $response->generate();

    }

    public function managePostVerb(Request $request)
    {

        //Obtener los parametros mandados en el body
        $capitulo = $request->getBodyParameters();

        $filasAfectadas = -1;
        $response = null;
        $code = null;

        //ejecutar el metodo postLibro en LibroHandlerModel.php
        $filasAfectadas = CapituloHandlerModel::postCapitulo($capitulo);

        //Segun las filas afectadas, mandamos un codigo u otro
        if($filasAfectadas == 1)
        {
            $code = 201;
        }
        else
        {
            $code = 400;
        }

        //crear la respuesta y generarla (mandarla)
        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();

    }


    public function manageDeleteVerb(Request $request)
    {
        $filasAfectadas = -1;
        $id = null;
        $code = null;
        $response = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        $filasAfectadas = CapituloHandlerModel::deleteCapitulo($id);

        if($filasAfectadas != 0)
        {
            $code = 204;
        }
        else
        {
            if(CapituloHandlerModel::isValid($id))
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


    public function managePutVerb(Request $request)
    {
        $filasAfectadas = -1;
        $id = null;
        $code = null;
        $response = null;


        $capitulo = $request->getBodyParameters();

        $filasAfectadas = CapituloHandlerModel::putCapitulo($capitulo);

        if($filasAfectadas == 1)
        {
            $code = 204;
        }
        else
        {
            $id = $capitulo->id;

            if(CapituloHandlerModel::isValid($id))
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