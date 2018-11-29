<?php
/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 29/11/18
 * Time: 17:44
 */

class PersonaHandlerModel
{

    public static function getPersona($id)
    {

        $listaLibros = null;
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $valid = self::isValid($id);


        if ($valid === true || $id == null)
        {
            $query = "SELECT id,Nombre,Edad from alumnos";
            if ($id != null){

                $query = $query . " WHERE id = ?" ;

            }


            $prep_query = $db_connection->prepare($query);

            if ($id != null)
            {
                $prep_query->bind_param('s', $id);

            }


            $prep_query->execute();
            $listaLibros = array();


            $prep_query->bind_result($idPer, $nomb, $edad);
            while ($prep_query->fetch())
            {

                $libro = new PersonaModel($idPer, $nomb, $edad);
                $listaLibros[] = $libro;
            }
//
        }
        $db_connection->close();
        return sizeof($listaLibros) == 1 ? $listaLibros[0] : $listaLibros;

    }


    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }

}