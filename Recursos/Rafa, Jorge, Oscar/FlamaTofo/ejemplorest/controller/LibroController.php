<?php

require_once "Controller.php";


class LibroController extends Controller
{

    public function manageGetVerb(Request $request)
    {

        $listaLibros = null;
        $id = null;
        $queryString = null;
        $response = null;
        $code = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        if(isset($request->getQueryString()['minpag'])){

            $queryString = $request->getQueryString()['minpag'];

        }

        $listaLibros = LibroHandlerModel::getLibro($id,$queryString);

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

    public function manageDeleteVerb(Request $request)
    {

        $listaLibros = null;
        $id = null;
        $response = null;
        $code = null;


        //if the URI refers to a libro entity, instead of the libro collection
        //Rcogemos la posicion 2 del array
        if (isset($request->getUrlElements()[2])) {

            $id = $request->getUrlElements()[2];
        }

        $listaLibros = LibroHandlerModel::deleteLibro($id);

        if ($listaLibros == null) {

            $code = '204';

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

        $Libro = null;
        $code = null;
        $filas = null;
        $response = null;

        $Libro =(object)$request->getBodyParameters();

        $filas = LibroHandlerModel::postLibro($Libro);
        if($filas == 1){

            $code = 200;

        }else{

            $code = 400;

        }
        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();

    }

    public function managePutVerb(Request $request)
    {

        $Libro = null;
        $code = null;
        $id = null;
        $filas = null;
        $response = null;


         $id = $request->getUrlElements()[2];


        $Libro =(object)$request->getBodyParameters();
        $filas = LibroHandlerModel::putLibro($id,$Libro);

        if($filas == 1){

            $code = 200;

        }else{

            $code = 400;

        }
        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();
    }


}