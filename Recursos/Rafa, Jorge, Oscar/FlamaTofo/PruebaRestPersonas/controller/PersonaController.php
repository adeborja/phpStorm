<?php
/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 29/11/18
 * Time: 17:44
 */

class PersonaController
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

        $listaLibros = PersonaHandlerModel::getPersona($id);

        if ($listaLibros != null) {

            $code = '200';

        } else {

            //We could send 404 in any case, but if we want more precission,
            //we can send 400 if the syntax of the entity was incorrect...
            if (PersonaHandlerModel::isValid($id)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }

        $response = new Response($code, null, $listaLibros, $request->getAccept());
        $response->generate();





    }

}